<?php

    class Sms_m extends MY_Model
    {

         function __construct()
         {
              // Call the Model constructor
              parent::__construct();
              $this->db_set();
         }

         function create($data)
         {
              $this->db->insert('sms', $data);
              return $this->db->insert_id();
         }

         //MEMBER GROUPS

         function get_members_groups($id)
         {

              return $this->db->where('group_id', $id)->get('member_groups')->result();
         }

         //UPDATE SMS COUNTER
         function update_counter($data)
         {
              return $this->update_key_data(1, 'sms_counter', $data);
         }

//GET SMS COUNTER DATA
         function get_counter_balance()
         {
              $this->select_all_key('sms_counter');
              return $this->db->where(array('id' => 1))->get('sms_counter')->row();
         }

         /**
          * Send Sms
          * 
          * @param string $phone
          * @param string $message
          * 
          * @return resource The Response Object
          */
         function send_sms($phone, $message)
         {
              $this->load->library('Req');
              $this->load->library('Fone');
              if (empty($phone))
              {
                   return FALSE;
              }

              $coma = ',';
              $pos = strpos($phone, $coma);

              if ($pos >= 0)
              {
                   $data = explode(',', $phone);
                   $phone = $data[0];
              }

              $from = 'KEYPAD';
              $userid = '632';
              $util = \libphonenumber\PhoneNumberUtil::getInstance();
              $no = $util->parse($phone, 'KE', null, true);
              $req = FALSE;


              $is_valid = $util->isValidNumber($no);
              if ($is_valid == 1)
              {
                   $code = $no->getcountryCode();
                   $nat = $no->getNationalNumber();
                   $phone = $code . $nat;

                   $url = 'http://197.248.4.47/smsapi/submit.php';
                   $stamp = date('YmdHis');
                   $json = '{
                                "AuthDetails": [{
                                        "UserID": "' . $userid . '",
                                        "Token": "' . md5('keypad123') . '",
                                        "Timestamp": "' . $stamp . '"
                                }],
                                "MessageType": ["2"],
                                "BatchType": ["0"],
                                "SourceAddr": ["' . $from . '"],
                                "MessagePayload": [
                                {
                                          "Text":"' . $message . '"  
                                }],
                                "DestinationAddr": [
                                {
                                        "MSISDN": "' . $phone . '",
                                        "LinkID": ""
                                }]
                           }';

                   if (!$sock = @fsockopen('www.example.com', 80))
                   {
                        return FALSE;
                   }

                   $parts = array(
                           'source' => $from,
                           'dest' => $phone,
                           'relay' => $message,
                           'created_on' => time(),
                           'created_by' => $this->ion_auth->get_user()->id
                   );
                   // $this->log_text($parts);
                   $headers = array('Content-Type' => 'application/json');
                   return $this->req->post($url, $headers, $json);
              }

              return $req;
         }

         function send_sms_old($phone, $message)
         {
              $this->load->library('Req');
              $this->load->library('Fone');
              if (empty($phone))
              {
                   return FALSE;
              }

              $from = 'EASY-TEXT';
              $userid = '416';
              $util = \libphonenumber\PhoneNumberUtil::getInstance();
              $no = $util->parse($phone, 'KE', null, true);
              $req = FALSE;

              $is_valid = $util->isValidNumber($no);
              if ($is_valid == 1)
              {
                   $code = $no->getcountryCode();
                   $nat = $no->getNationalNumber();
                   $phone = $code . $nat;

                   $url = 'http://197.248.4.47/smsapi/submit.php';
                   $stamp = date('YmdHis');
                   $json = '{
                                "AuthDetails": [{
                                        "UserID": "' . $userid . '",
                                        "Token": "' . md5('mshamba123') . '",
                                        "Timestamp": "' . $stamp . '"
                                }],
                                "MessageType": ["2"],
                                "BatchType": ["0"],
                                "SourceAddr": ["' . $from . '"],
                                "MessagePayload": [
                                {
                                          "Text":"' . $message . '"  
                                }],
                                "DestinationAddr": [
                                {
                                        "MSISDN": "' . $phone . '",
                                        "LinkID": ""
                                }]
                           }';

                   $headers = array('Content-Type' => 'application/json');
                   return $this->req->post($url, $headers, $json);
              }

              return $req;
         }

         //GET ALL MEMBERS

         function all_members()
         {
              $this->select_all_key('members');
              return $this->db->get('members')->result();
         }

         function all_staff()
         {
              $this->select_all_key('users');
              return $this->db->get('users')->result();
         }

//Ministry Members
         function get_min_members($id)
         {
              return $this->db->where(array('ministry_id' => $id))->get('member_ministries')->result();
         }

         //Ministry Members
         function get_member($id)
         {
              $this->select_all_key('members');
              return $this->db->where(array('id' => $id))->get('members')->row();
         }

//HBC Members
         function get_hbc_members($id)
         {
              $this->select_all_key('members');
              return $this->db->where(array('hbc_id' => $id))->get('members')->result();
         }

         //GET CUSTOM GROUPS

         function get_custom_groups()
         {

              $gp = $this->populate('groups', 'id', 'description');

              $res = $this->db->group_by('group_id')->get('member_groups')->result();
              $rr = array();

              foreach ($res as $r)
              {
                   $rr[$r->group_id] = $gp[$r->group_id];
              }

              return $rr;
         }

         function find($id)
         {
              return $this->db->where(array('id' => $id))->get('sms')->row();
         }

         function by_group($id)
         {
              return $this->db->where(array('group_type' => $id))->get('sms')->result();
         }

         function exists($id)
         {
              return $this->db->where(array('id' => $id))->count_all_results('sms') > 0;
         }

         function count()
         {

              return $this->db->count_all_results('sms');
         }

         function update_attributes($id, $data)
         {
              return $this->db->where('id', $id)->update('sms', $data);
         }

         function populate($table, $option_val, $option_text)
         {
              $query = $this->db->select('*')->order_by($option_text)->get($table);
              $dropdowns = $query->result();
              $options = array();
              foreach ($dropdowns as $dropdown)
              {
                   $options[$dropdown->$option_val] = $dropdown->$option_text;
              }
              return $options;
         }

         function delete($id)
         {
              return $this->db->delete('sms', array('id' => $id));
         }

         /**
          * Setup DB Table Automatically
          * 
          */
         function db_set()
         {
              $this->db->query(" 
	CREATE TABLE IF NOT EXISTS  sms (
	id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
	recipient  varchar(32)  DEFAULT '' NOT NULL, 
	status  INT(11), 
	cost  INT(11), 
	group_type   varchar(32)  DEFAULT '' NOT NULL, 
	sent_to   varchar(32)  DEFAULT '' NOT NULL, 
	message  text  , 
	created_by INT(11), 
	modified_by INT(11), 
	created_on INT(11) , 
	modified_on INT(11) 
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8; ");

              $this->db->query(" 
	CREATE TABLE IF NOT EXISTS  sms_counter (
	id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
	sent  BLOB, 
	balance  BLOB,
	created_by BLOB, 
	modified_by BLOB, 
	created_on BLOB , 
	modified_on BLOB 
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8; 
	");

              $cc = $this->db->where(array('id' => 1))->get('sms_counter')->row();
              if (empty($cc))
              {
                   $this->db->query(" 
		INSERT INTO `sms_counter` (`id`, `sent`, `balance`, `created_by`, `modified_by`, `created_on`, `modified_on`) VALUES
		(1, '0', '0', 1, NULL, 1421242519, NULL)
		");
              }
         }

         function paginate_all($limit, $page)
         {
              $offset = $limit * ( $page - 1);


              $this->db->order_by('id', 'desc');
              $this->db->group_by('group_type');
              $query = $this->db->get('sms', $limit, $offset);

              $result = array();

              foreach ($query->result() as $row)
              {
                   $result[] = $row;
              }

              if ($result)
              {
                   return $result;
              }
              else
              {
                   return FALSE;
              }
         }

         function my_sms($limit, $page, $id)
         {
              $offset = $limit * ( $page - 1);


              $this->db->order_by('id', 'desc');
              $this->db->where('recipient', $id);
              $query = $this->db->get('sms', $limit, $offset);

              $result = array();

              foreach ($query->result() as $row)
              {
                   $result[] = $row;
              }

              if ($result)
              {
                   return $result;
              }
              else
              {
                   return FALSE;
              }
         }

    }
    