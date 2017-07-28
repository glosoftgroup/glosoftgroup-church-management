<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends Admin_Controller
{

        function __construct()
        {
                parent::__construct();
                if (!$this->ion_auth->logged_in())
                {
                        redirect('admin/login');
                }
                $this->load->model('settings_m');
        }

        /**
         * Module Index
         *
         */
        public function index()
        {
                $id = 1;
                $page = NULL;
                $data['page'] = ( $this->uri->segment(4) ) ? $this->uri->segment(4) : $page;
                //redirect if no $id
                if (!$id)
                {
                        $this->session->set_flashdata('message', array('type' => 'warning', 'text' => lang('web_object_not_exist')));
                        redirect('admin/settings/');
                }
                if (!$this->settings_m->exists($id))
                {
                        $this->session->set_flashdata('message', array('type' => 'warning', 'text' => lang('web_object_not_exist')));
                        redirect('admin/settings');
                }
                //search the item to show in edit form
                $get = $this->settings_m->find($id);

                //Rules for validation
                $this->form_validation->set_rules($this->validation());

                //create control variables
                $data['updType'] = 'edit';
                $data['page'] = $page;
                if ($this->form_validation->run())  //validation has been passed
                {
                        $user = $this->ion_auth->get_user();
                        $file = '';

                        if (!empty($_FILES['file']['name']))
                        {
                                $this->load->library('files_uploader');
                                $upload_data = $this->files_uploader->upload('file');
                                $file = $upload_data['file_name'];
                        }
                        else
                        {

                                $file = $get->file;
                        }

                        // build array for the model
                        $form_data = array(
                            'date' => strtotime($this->input->post('date')),
                            'name' => $this->input->post('name'),
                            'address' => $this->input->post('address'),
                            'county' => $this->input->post('county'),
                            'town' => $this->input->post('town'),
                            'phone' => $this->input->post('phone'),
                            'other_phones' => $this->input->post('other_phones'),
                            'email' => $this->input->post('email'),
                            'sender_id' => $this->input->post('sender_id'),
                            'sms_initial' => $this->input->post('sms_initial'),
                            'member_code_initial' => $this->input->post('member_code_initial'),
                            'file' => $file,
                            'modified_by' => $user->id,
                            'modified_on' => time());

                        $done = $this->settings_m->update_attributes($id, $form_data);

                        // the information has therefore been successfully saved in the db
                        if ($done)
                        {
                                $this->sync->log_update('settings', $id, $form_data);
                                $this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Settings ' . lang('web_edit_success')));
                                redirect("admin/settings/");
                        }
                        else
                        {
                                $this->session->set_flashdata('error', array('type' => 'error', 'text' => $done->errors->full_messages()));
                                redirect("admin/settings/");
                        }
                }
                else
                {
                        foreach (array_keys($this->validation()) as $field)
                        {
                                if (isset($_POST[$field]))
                                {
                                        $get->$field = $this->form_validation->$field;
                                }
                        }
                }
                $data['result'] = $get;
                //load the view and the layout
                $this->template->title('Church Settings ')->build('admin/create', $data);
        }

        public function index_reloaded()
        {
                redirect('admin/settings/create');

                $config = $this->set_paginate_options();  //Initialize the pagination class
                $this->pagination->initialize($config);
                $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 1;
                $data['settings'] = $this->settings_m->paginate_all($config['per_page'], $page);

                //create pagination links
                $data['links'] = $this->pagination->create_links();

                //page number  variable
                $data['page'] = $page;
                $data['per'] = $config['per_page'];

                //load view
                $this->template->title(' Settings ')->build('admin/list', $data);
        }

        /**
         * Add New Settings 
         *
         * @param $page
         */
        function create($page = NULL)
        {
                //create control variables
                $data['updType'] = 'create';
                $data['page'] = ( $this->uri->segment(4) ) ? $this->uri->segment(4) : $page;

                //Rules for validation
                $this->form_validation->set_rules($this->validation());

                //validate the fields of form
                if ($this->form_validation->run())
                {         //Validation OK!
                        $file = '';
                        if (!empty($_FILES['file']['name']))
                        {
                                $this->load->library('files_uploader');
                                $upload_data = $this->files_uploader->upload('file');
                                $file = $upload_data['file_name'];
                        }

                        $user = $this->ion_auth->get_user();
                        $form_data = array(
                            'date' => strtotime($this->input->post('date')),
                            'name' => $this->input->post('name'),
                            'address' => $this->input->post('address'),
                            'county' => $this->input->post('county'),
                            'town' => $this->input->post('town'),
                            'phone' => $this->input->post('phone'),
                            'other_phones' => $this->input->post('other_phones'),
                            'email' => $this->input->post('email'),
                            'sender_id' => $this->input->post('sender_id'),
                            'sms_initial' => $this->input->post('sms_initial'),
                            'member_code_initial' => $this->input->post('member_code_initial'),
                            'file' => $file,
                            'created_by' => $user->id,
                            'created_on' => time()
                        );

                        $ok = $this->settings_m->create($form_data);

                        if ($ok) // the information has therefore been successfully saved in the db
                        {
                                $this->sync->log_new('settings', array($ok));
                                $this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Settings ' . lang('web_create_success')));
                        }
                        else
                        {
                                $this->session->set_flashdata('error', array('type' => 'error', 'text' => 'Settings ' . lang('web_create_failed')));
                        }

                        redirect('admin/settings/');
                }
                else
                {
                        $get = new StdClass();
                        foreach ($this->validation() as $field)
                        {
                                $fn = $field['field'];
                                $get->$fn = set_value($fn);
                        }

                        $data['result'] = $get;
                        //load the view and the layout
                        $this->template->title('Church Settings')->build('admin/create', $data);
                }
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
         * Edit  Settings 
         *
         * @param $id
         * @param $page
         */
        function edit($id = FALSE, $page = 0)
        {
                //redirect if no $id
                if (!$id)
                {
                        $this->session->set_flashdata('message', array('type' => 'warning', 'text' => lang('web_object_not_exist')));
                        redirect('admin/settings/');
                }
                if (!$this->settings_m->exists($id))
                {
                        $this->session->set_flashdata('message', array('type' => 'warning', 'text' => lang('web_object_not_exist')));
                        redirect('admin/settings');
                }
                //search the item to show in edit form
                $get = $this->settings_m->find($id);
                $this->form_validation->set_rules($this->validation());

                //create control variables
                $data['updType'] = 'edit';
                $data['page'] = $page;

                if ($this->form_validation->run())  //validation has been passed
                {
                        $user = $this->ion_auth->get_user();
                        $file = '';
                        if (!empty($_FILES['file']['name']))
                        {
                                $this->load->library('files_uploader');
                                $upload_data = $this->files_uploader->upload('file');
                                $file = $upload_data['file_name'];
                        }
                        else
                        {
                                $file = $get->file;
                        }

                        // build array for the model
                        $form_data = array(
                            'date' => strtotime($this->input->post('date')),
                            'name' => $this->input->post('name'),
                            'address' => $this->input->post('address'),
                            'county' => $this->input->post('county'),
                            'town' => $this->input->post('town'),
                            'phone' => $this->input->post('phone'),
                            'other_phones' => $this->input->post('other_phones'),
                            'email' => $this->input->post('email'),
                            'sender_id' => $this->input->post('sender_id'),
                            'sms_initial' => $this->input->post('sms_initial'),
                            'member_code_initial' => $this->input->post('member_code_initial'),
                            'file' => $file,
                            'modified_by' => $user->id,
                            'modified_on' => time());

                        //find the item to update
                        $done = $this->settings_m->update_attributes($id, $form_data);

                        // the information has therefore been successfully saved in the db
                        if ($done)
                        {
                                $this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Settings ' . lang('web_edit_success')));
                                redirect("admin/settings/");
                        }
                        else
                        {
                                $this->session->set_flashdata('error', array('type' => 'error', 'text' => $done->errors->full_messages()));
                                redirect("admin/settings/");
                        }
                }
                else
                {
                        foreach (array_keys($this->validation()) as $field)
                        {
                                if (isset($_POST[$field]))
                                {
                                        $get->{$field} = $this->form_validation->{$field};
                                }
                        }
                }
                $data['result'] = $get;
                //load the view and the layout
                $this->template->title('Edit Settings ')->build('admin/create', $data);
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
         * @todo Run Ajax Requests only
         * @return boolean
         */
        function upload()
        {
                $this->load->library('Dump');
                $dump = new Ifsnop\Mysqldump\Mysqldump($this->db->database, $this->db->username, $this->db->password);

                $rows = $this->log_m->fetch_sync();
                if (!count($rows))
                {
                        echo json_encode(array('status' => 000, 'message' => 'No Data to Send. Everything Uptodate'));
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

                $POST_DATA = array(
                    'file' => base64_encode($fstry)
                );
                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL, base_url('settings/file_api'));
                curl_setopt($curl, CURLOPT_TIMEOUT, 30);
                curl_setopt($curl, CURLOPT_POST, 1);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $POST_DATA);
                $response = curl_exec($curl);
                curl_close($curl);
                echo '<pre>';
                print_r($response);
                echo '</pre>';
                die();
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
                        echo json_encode(array('status' => 000, 'message' => 'No Response. Check Internet Connection'));
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

        function delete($id = NULL, $page = 1)
        {
                redirect('admin/settings');
                //filter & Sanitize $id
                $id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;

                //redirect if its not correct
                if (!$id)
                {
                        $this->session->set_flashdata('message', array('type' => 'warning', 'text' => lang('web_object_not_exist')));

                        redirect('admin/settings');
                }

                //search the item to delete
                if (!$this->settings_m->exists($id))
                {
                        $this->session->set_flashdata('message', array('type' => 'warning', 'text' => lang('web_object_not_exist')));

                        redirect('admin/settings');
                }

                //delete the item
                if ($this->settings_m->delete($id) == TRUE)
                {
                        $this->session->set_flashdata('message', array('type' => 'sucess', 'text' => 'Settings ' . lang('web_delete_success')));
                }
                else
                {
                        $this->session->set_flashdata('error', array('type' => 'error', 'text' => lang('web_delete_failed')));
                }

                redirect("admin/settings/");
        }

        /**
         * Generate Validation Rules
         *
         * @return array()
         */
        private function validation()
        {
                $config = array(
                    array(
                        'field' => 'date',
                        'label' => 'Date',
                        'rules' => 'required|xss_clean'),
                    array(
                        'field' => 'name',
                        'label' => 'Name',
                        'rules' => 'required|trim|xss_clean|min_length[0]|max_length[60]'),
                    array(
                        'field' => 'address',
                        'label' => 'Address',
                        'rules' => 'trim|xss_clean|min_length[0]|max_length[500]'),
                    array(
                        'field' => 'county',
                        'label' => 'County',
                        'rules' => 'required|trim|xss_clean|min_length[0]|max_length[60]'),
                    array(
                        'field' => 'town',
                        'label' => 'Town',
                        'rules' => 'trim|xss_clean|min_length[0]|max_length[60]'),
                    array(
                        'field' => 'phone',
                        'label' => 'Phone',
                        'rules' => 'required|trim|xss_clean|min_length[0]|max_length[60]'),
                    array(
                        'field' => 'sender_id',
                        'label' => 'Sender id',
                        'rules' => 'required|trim|xss_clean|min_length[0]|max_length[60]'),
                    array(
                        'field' => 'other_phones',
                        'label' => 'Other Phones',
                        'rules' => 'trim|xss_clean|min_length[0]|max_length[60]'),
                    array(
                        'field' => 'email',
                        'label' => 'Email',
                        'rules' => 'trim|xss_clean|min_length[0]|max_length[60]'),
                    array(
                        'field' => 'sms_initial',
                        'label' => 'Sms Initial',
                        'rules' => 'trim|xss_clean|min_length[0]|max_length[60]'),
                    array(
                        'field' => 'member_code_initial',
                        'label' => 'Member Code Initial',
                        'rules' => 'required|trim|xss_clean|min_length[0]|max_length[60]'),
                    array(
                        'field' => 'file',
                        'label' => 'File',
                        'rules' => 'trim|xss_clean|min_length[0]|max_length[60]'),
                );
                $this->form_validation->set_error_delimiters("<br /><span class='error'>", '</span>');
                return $config;
        }

        /**
         * Generate Pagination Config
         *
         * @return array()
         */
        private function set_paginate_options()
        {
                $config = array();
                $config['base_url'] = site_url() . 'admin/settings/index/';
                $config['use_page_numbers'] = TRUE;
                $config['per_page'] = 10;
                $config['total_rows'] = $this->settings_m->count();
                $config['uri_segment'] = 4;

                $config['first_link'] = lang('web_first');
                $config['first_tag_open'] = "<li>";
                $config['first_tag_close'] = '</li>';
                $config['last_link'] = lang('web_last');
                $config['last_tag_open'] = "<li>";
                $config['last_tag_close'] = '</li>';
                $config['next_link'] = FALSE;
                $config['next_tag_open'] = "<li>";
                $config['next_tag_close'] = '</li>';
                $config['prev_link'] = FALSE;
                $config['prev_tag_open'] = "<li>";
                $config['prev_tag_close'] = '</li>';
                $config['cur_tag_open'] = '<li class="active">  <a href="#">';
                $config['cur_tag_close'] = '</a></li>';
                $config['num_tag_open'] = "<li>";
                $config['num_tag_close'] = '</li>';
                $config['full_tag_open'] = '<ul class="pagination pagination-centered">';
                $config['full_tag_close'] = '</ul>';
                //$choice = $config["total_rows"] / $config["per_page"];
                //$config["num_links"] = round($choice);

                return $config;
        }

}
