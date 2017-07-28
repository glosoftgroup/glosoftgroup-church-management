<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends Public_Controller
{

        function __construct()
        {
                parent::__construct();
                $this->load->model('settings_m');
        }

        /**
         * DB Backup
         * 
         */
        function backup()
        {
                $this->load->library('Dump');
                $dump = new Ifsnop\Mysqldump\Mysqldump($this->db->database, $this->db->username, $this->db->password);
                @mkdir(FCPATH . 'uploads/dump', 777, TRUE);
                $dump->start(FCPATH . 'uploads/dump/' . date('d_M_Y_H_i') . '.sql');

                $this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Backup Complete'));
                redirect('admin');
        }

        /**
         * Process any New Files as CRON
         * 
         */
        function file_parser()
        {
                $path = realpath(FCPATH . '/uploads/sync/');
                $dir = new RecursiveDirectoryIterator($path, RecursiveDirectoryIterator::SKIP_DOTS);
                $iterator = new RecursiveIteratorIterator($dir, RecursiveIteratorIterator::LEAVES_ONLY);
                $i = 0;
                $fs = 0;
                $f = 0;
                foreach ($iterator as $file)
                {
                        $fs++;
                        if ($this->settings_m->not_processed($file->getfileName()))
                        {
                                $f++;
                                $fst = $file->getPathname();
                                $fnm = $file->getfileName();
                                $string = file_get_contents($fst);
                                $tsql = explode("||", $string);
                                $len = count($tsql);

                                foreach ($tsql as $q)
                                {
                                        if (!empty($q))
                                        {
                                                $i++;
                                                //echo '<pre>';
                                                //print_r($q);
                                                //echo '<br></pre>';
                                                $sqst = str_replace('MD5', MD5, $q);
                                                $this->settings_m->execute($sqst);
                                        }
                                }

                                //log transaction
                                $log = array(
                                    'filename' => $fnm,
                                    'length' => $len,
                                    'processed' => $i,
                                    'created_on' => time(),
                                    'created_by' => 999,
                                );
                                $this->settings_m->log_processed_file($log);
                        }
                }
                $out = ['total_files' => $fs, 'has_processed' => $f, 'queries' => $i];
                echo '<pre>';
                print_r($out);
                echo '</pre>';
        }

        /**
         * Handle Files Sent via API
         */
        function file_api()
        {
                $resp = array();
                $cam = '';
                if (isset($_POST['cam']))
                {
                        $cam = $_POST['cam'];
                }
                if (isset($_POST['file']))
                {
                        $encoded = $_POST['file'];
                        $decoded = base64_decode($encoded);
                        if (file_exists(FCPATH . '/uploads/sync/pk_' . date('H_j-M_Y') . '.dat'))
                        {
                                $resp = array('status' => 202, 'message' => 'File Already Exists. Try in the Next Hour.');
                        }
                        else
                        {
                                @mkdir(FCPATH . 'uploads/sync/', 777, TRUE);
                                $atom = file_put_contents(FCPATH . '/uploads/sync/pk_' . date('H_j-M_Y') . '.dat', $decoded);
                                if ($atom)
                                {
                                        $resp = array('status' => 200, 'message' => 'Upload Successful (' . $atom . ' bytes)');
                                }
                                else
                                {
                                        $resp = array('status' => 201, 'message' => 'Unable To init Upload File on Server');
                                }
                        }
                }
                else
                {
                        $resp = array('status' => 300, 'message' => 'NO Post');
                }
                echo json_encode($resp);
        }

        /**
         * The Core of the Sync Webservice
         * 
         * @return boolean
         */
        function upload()
        {
                $this->load->library('Dump');
                $dump = new Ifsnop\Mysqldump\Mysqldump($this->db->database, $this->db->username, $this->db->password);
                $rows = $this->log_m->fetch_sync();
                if (!count($rows))
                {
                        echo json_encode(array('status' => 000, 'message' => 'No Data to Send. Everything Uptodate', 'time' => date('d M Y H:i')));
                        return FALSE;
                }

                $batch = array();
                $rids = array();
                $str = '';

                foreach ($rows as $row)
                {
                        if ($row->flag == 3 || $row->flag == 4)
                        {
                                $rids[$row->sn_table][] = array('table' => $row->sn_table, 'flag' => $row->flag, 'id' => $row->row_id, 'field' => $row->col, 'value' => $row->val, 'log_id' => $row->id);
                        }
                        else
                        {
                                $rids[$row->sn_table][] = array('table' => $row->sn_table, 'flag' => $row->flag, 'id' => $row->row_id, 'log_id' => $row->id);
                        }
                }
                foreach ($rids as $tbl => $arr)
                {
                        $buck = array();
                        $flags = array();
                        foreach ($arr as $dat)
                        {
                                $update = array();
                                $obj = (object) $dat;
                                //check bucket to avoid duplicate statements
                                if ((in_array($obj->id, $buck)) && (in_array($obj->flag, $flags)))
                                {
                                        $batch[] = $obj->log_id;
                                        continue;
                                }
                                $enc = FALSE;
                                $dump->init($obj->table);
                                if ($dump->has_blobs($obj->table))
                                {
                                        $enc = TRUE;
                                }
                                $actual = $this->log_m->fetch_rec($obj->table, $obj->id, $enc);
                                if ($obj->flag == 3 || $row->flag == 4)
                                {
                                        $update['field'] = $obj->field;
                                        $update['value'] = $obj->value;
                                }
                                $str .= $this->make_sql_string($obj->table, $actual, $obj->flag, $obj->id, $update);

                                $batch[] = $obj->log_id;
                                $buck[] = $obj->id;
                                $flags[] = $obj->flag;
                        }
                }
                $fstry = rtrim($str, '||' . PHP_EOL);
                $post = array('file' => base64_encode($fstry));
                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL, $this->config->item('remote_path'));
                curl_setopt($curl, CURLOPT_TIMEOUT, 30);
                curl_setopt($curl, CURLOPT_POST, 1);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
                $response = curl_exec($curl);
                curl_close($curl);

                if ($response)
                {
                        $rest = json_decode(preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $response), true);
                        if (isset($rest['status']) && $rest['status'] == 200)
                        {
                                $this->log_m->set_sent($batch);
                        }
                        echo json_encode($rest);
                }
                else
                {
                        echo json_encode(array('status' => 000, 'message' => 'No Response. Check Internet Connection', 'time' => date('d M Y H:i')));
                }
        }

        /**
         * Generate Actual SQl String 
         * 
         * @param string $table
         * @param object $row
         * @param int $flag
         * @param int $id
         * @param array $spec
         * @return string
         */
        public function make_sql_string($table, $row, $flag, $id = 0, $spec = array())
        {
                $this->load->library('Dump');
                $dump = new Ifsnop\Mysqldump\Mysqldump($this->db->database, $this->db->username, $this->db->password);

                $sl = chr(13) . chr(10);
                $onlyOnce = true;
                $stmt = '';

                $dump->init($table);
                $cols = $dump->extract_cols($table);
                unset($cols[0]); //remove id column

                $colst = implode(",", $cols);
                $fnstr = '`' . str_replace(',', '`,`', $colst) . '`';
                $md5 = MD5;
                $vals = $dump->escape_custom($table, $row, $cols, $md5, $this->db->conn_id);

                if ($flag == 1)
                {
                        if ($onlyOnce)
                        {
                                $stmt .= $sl . "INSERT INTO `$table`  (" . $fnstr . ") " . $sl . "VALUES (" . implode(",", $vals) . ")";
                                $onlyOnce = false;
                        }
                        else
                        {
                                $stmt .= ',' . $sl . "(" . implode(",", $vals) . ")";
                        }
                }
                elseif ($flag == 2 && $id)//update normal
                {
                        $stmt .= $this->get_enc_update_str($id, $table, $row, FALSE);
                        $stmt .= '  ||' . PHP_EOL;
                }
                elseif ($flag == 3 && !empty($spec))
                {
                        $rc = (object) $spec;
                        $stmt .= "UPDATE `$table` as s, (SELECT id, AES_DECRYPT($rc->field,SHA2('MD5',512)) as $rc->field ";
                        $stmt .= "FROM `$table` WHERE id= $id ) AS p ";
                        $stmt .= $sl . "SET s.$rc->field = AES_ENCRYPT(p.$rc->field + $rc->value,SHA2('MD5',512))";
                        $stmt .= " WHERE s.id = p.id ";
                        $stmt .= "AND s.id= $id ";

                        $stmt .= '  ||' . PHP_EOL;
                }
                elseif ($flag == 4 && $id)
                {
                        $rc = (object) $spec;
                        if (!empty($rc->field))
                        {
                                $stmt .= "DELETE FROM `$table` WHERE {$rc->field}= {$id}    ||" . PHP_EOL;
                        }
                        else
                        {
                                $stmt .= "DELETE FROM `$table` WHERE id= {$id}    ||" . PHP_EOL;
                        }
                }
                else
                {
                        //   
                }

                if (!$onlyOnce)
                {
                        $stmt .= ';' . $sl . "||";
                        $stmt .= PHP_EOL;
                }

                return $stmt;
        }

        /**
         * Return Update Query String
         * 
         * @param type $id
         * @param type $table
         * @param type $data
         * @return boolean
         */
        public function get_enc_update_str($id, $table, $data)
        {
                $this->load->library('Dump');
                $dump = new Ifsnop\Mysqldump\Mysqldump($this->db->database, $this->db->username, $this->db->password);
                $dump->init($table);
                $query = '';
                //encrypt data
                if ($data && count($data))
                {
                        $query .= 'update ' . $table . ' set ';
                        $j = 1;
                        $arrdata = (array) $data;
                        $md5 = MD5;
                        foreach ($arrdata as $ky => $var)
                        {
                                $esc_var = $dump->escape_custom_field($table, $ky, $var, $md5, $this->db->conn_id);
                                $query .= ' ' . $ky . ' = ' . $esc_var;

                                if ($j == count($arrdata))
                                {
                                        break;
                                }
                                $query .= ', ';
                                $j++;
                        }
                        $query .= ' where id= ' . $id;
                }
                return $query;
        }

        /**
         * Remove Files older than 2 weeks
         * as Cron
         */
        function dir_clean_up()
        {
                $path = realpath(FCPATH . '/uploads/sync/');
                $dir = new RecursiveDirectoryIterator($path, RecursiveDirectoryIterator::SKIP_DOTS);
                $iterator = new RecursiveIteratorIterator($dir, RecursiveIteratorIterator::LEAVES_ONLY);

                foreach ($iterator as $file)
                {
                        $fst = $file->getPathname();

                        $last_mod = $file->getMTime();

                        if ((time() - $last_mod) > (14 * 24 * 3600))
                        {
                                unlink($fst);
                        }
                }
        }

        function write_file($file, $content)
        {
                $fp = fopen($file, 'w');
                fwrite($fp, $content);
                fclose($fp);
                chmod($file, 0775);
                return true;
        }

}
