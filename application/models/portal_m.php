<?php

    class Portal_m extends MY_Model
    {

         function __construct()
         {
              // Call the Model constructor
              parent::__construct();
              $this->db_set();
         }

         /**
          * Fetch Low Stock Items
          * 
          * @param type $threshold
          * @return object
          */
         function fetch_low_stock($threshold)
         {
              return $this->db->where('stock <', $threshold)
                                        ->get('products')
                                        ->result();
         }

         function fetch_all_users()
         {
              $this->select_all_key('users');
              return $this->db->where($this->dx('active') . '=1', NULL, FALSE)
                                        ->get('users')
                                        ->result();
         }

         public function get_notes($user = 0, $limit = 15)
         {
              $user = (empty($user)) ? $this->ion_auth->get_user()->id : $user;
              return $this->db->where('to_user', $user)
                                        ->order_by('id', 'desc')
                                        ->limit($limit)
                                        ->get('notifications')
                                        ->result();
         }

         function fetch_settings()
         {
              return $this->db->get('settings')->row();
         }

         function key_exists($key)
         {
              $this->select_all_key(lang('active'));
              return $this->db->where($this->dx('license') . " = '" . $key . "'", NULL, FALSE)
                                        ->count_all_results(lang('active')) > 0;
         }

         function save_key($data)
         {
              if (!$this->key_exists($data['license']))
              {
                   $this->update_key_all(lang('active'), array('status' => 0));
                   $this->insert_key_data(lang('active'), $data);
              }
         }

         //count All Members
         function count_members()
         {
              return $this->db->count_all_results('members');
         }

         //count All Visitors
         function count_visitors()
         {
              return $this->db->count_all_results('visitors');
         }

         //count All Sunday School
         function count_sSchool()
         {
              return $this->db->count_all_results('sunday_school');
         }

         //count All hbcs
         function count_hbcs()
         {
              return $this->db->count_all_results('hbcs');
         }

         function count_ministries()
         {
              return $this->db->count_all_results('ministries');
         }

         function count_users()
         {
              return $this->db->count_all_results('users');
         }

         function get_settings()
         {
              return $this->db->get('settings')->result();
         }

         function collection_log($data)
         {
              $this->insert_key_data('collections_log', $data);
              return $this->db->insert_id();
         }

         function fetch_keys()
         {
              $this->select_all_key(lang('active'));
              return $this->db->get(lang('active'))
                                        ->result();
         }

         function get_collection_logs()
         {
              $this->select_all_key('collections_log');
              return $this->db->order_by('created_on', 'DESC')->get('collections_log')->result();
         }

         function get_active_key()
         {
              $this->select_all_key(lang('active'));
              return $this->db->where($this->dx('status') . '=1', NULL, FALSE)
                                        ->get(lang('active'))
                                        ->row();
         }

         /**
          * Setup DB Table Automatically [collection log and settings ]
          * 
          */
         function db_set()
         {
              $this->db->query("
		CREATE TABLE IF NOT EXISTS collections_log (
			id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
			collection_id BLOB,
			type BLOB,
			amount BLOB,
			created_by BLOB ,
			modified_by BLOB ,
			created_on BLOB ,
			modified_on BLOB
		)ENGINE=InnoDB  DEFAULT CHARSET=utf8;");
              $this->db->query(" 
	CREATE TABLE IF NOT EXISTS  member_groups (
	id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
	member_id  INT(11), 
	group_id  INT(11), 
	created_by INT(11), 
	modified_by INT(11), 
	created_on INT(11) , 
	modified_on INT(11) 
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8; ");
              $this->db->query(" 
	CREATE TABLE IF NOT EXISTS  settings (
	id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
	date  INT(11), 
	name  varchar(256)  DEFAULT '' NOT NULL, 
	address  text  , 
	county  varchar(256)  DEFAULT '' NOT NULL, 
	town  varchar(256)  DEFAULT '' NOT NULL, 
	phone  varchar(256)  DEFAULT '' NOT NULL, 
	other_phones  varchar(256)  DEFAULT '' NOT NULL, 
	email  varchar(256)  DEFAULT '' NOT NULL, 
	sender_id  varchar(256)  DEFAULT '' NOT NULL, 
	sms_initial  varchar(256)  DEFAULT '' NOT NULL, 
	member_code_initial  varchar(256)  DEFAULT '' NOT NULL, 
	file  varchar(256)  DEFAULT '' NOT NULL, 
	created_by INT(11), 
	modified_by INT(11), 
	created_on INT(11) , 
	modified_on INT(11) 
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8; ");
              $check = $this->get_settings();
              if (empty($check))
              {
                   $this->db->query("
		INSERT INTO `settings` (`id`, `date`, `name`, `address`, `county`, `town`, `phone`, `other_phones`, `email`,`sender_id`, `sms_initial`, `member_code_initial`, `file`, `created_by`, `modified_by`, `created_on`, `modified_on`) VALUES
		(1, 1325624400, 'Smart Church', 'Box 12548', 'Nairobi', 'Nairobi', '(072) 134-1214', '0205285243/07213584587', 'info@smartchurch.com','KEYPAD', 'Hello', 'SC', 'logo.png', 1, NULL, 1422976879, NULL) ");
              }
         }

         //Sum Contributions
         function sum_offerings()
         {
              return $this->db->select('sum(' . $this->dx('amount') . ') as total', FALSE)
                                        ->where_in("DATE_FORMAT(FROM_UNIXTIME(" . $this->dx('date') . "),'%m-%Y')", date('m-Y'), FALSE)
                                        ->get('offerings')
                                        ->row();
         }

         //Sum Contributions
         function sum_tithes()
         {
              return $this->db->select('sum(' . $this->dx('totals') . ') as total', FALSE)
                                        ->where_in("DATE_FORMAT(FROM_UNIXTIME(" . $this->dx('date') . "),'%m-%Y')", date('m-Y'), FALSE)
                                        ->get('tithes')
                                        ->row();
         }

         //Sum Contributions
         function sum_thanks()
         {
              return $this->db->select('sum(' . $this->dx('totals') . ') as total', FALSE)
                                        ->where_in("DATE_FORMAT(FROM_UNIXTIME(" . $this->dx('date') . "),'%m-%Y')", date('m-Y'), FALSE)
                                        ->get('thanks_giving')
                                        ->row();
         }

//Sum Contributions
         function sum_support()
         {
              return $this->db->select('sum(' . $this->dx('totals') . ') as total', FALSE)
                                        ->where_in("DATE_FORMAT(FROM_UNIXTIME(" . $this->dx('date') . "),'%m-%Y')", date('m-Y'), FALSE)
                                        ->get('ministry_support')
                                        ->row();
         }

//Sum Contributions
         function sum_seeds()
         {
              return $this->db->select('sum(' . $this->dx('totals') . ') as total', FALSE)
                                        ->where_in("DATE_FORMAT(FROM_UNIXTIME(" . $this->dx('date') . "),'%m-%Y')", date('m-Y'), FALSE)
                                        ->get('seed_planting')
                                        ->row();
         }

         //Sum Contributions
         function sum_others()
         {
              return $this->db->select('sum(' . $this->dx('totals') . ') as total', FALSE)
                                        ->where_in("DATE_FORMAT(FROM_UNIXTIME(" . $this->dx('date') . "),'%m-%Y')", date('m-Y'), FALSE)
                                        ->get('other_contributions')
                                        ->row();
         }

         //Sum Contributions
         function offerings_bar()
         {
              $this->select_all_key('offerings');
              return $this->db->where_in("DATE_FORMAT(FROM_UNIXTIME(" . $this->dx('date') . "),'%m-%Y')", date('m-Y'), FALSE)
                                        ->get('offerings')
                                        ->result();
         }

         //Sum Contributions
         function tithes_bar()
         {
              $this->select_all_key('tithes');
              return $this->db->where_in("DATE_FORMAT(FROM_UNIXTIME(" . $this->dx('date') . "),'%m-%Y')", date('m-Y'), FALSE)
                                        ->get('tithes')
                                        ->result();
         }

         //Sum Contributions
         function thanks_bar()
         {
              $this->select_all_key('thanks_giving');
              return $this->db->where_in("DATE_FORMAT(FROM_UNIXTIME(" . $this->dx('date') . "),'%m-%Y')", date('m-Y'), FALSE)
                                        ->get('thanks_giving')
                                        ->result();
         }

         //Sum Contributions
         function seeds_bar()
         {
              $this->select_all_key('seed_planting');
              return $this->db->where_in("DATE_FORMAT(FROM_UNIXTIME(" . $this->dx('date') . "),'%m-%Y')", date('m-Y'), FALSE)
                                        ->get('seed_planting')
                                        ->result();
         }

         //Sum Contributions
         function support_bar()
         {
              $this->select_all_key('ministry_support');
              return $this->db->where_in("DATE_FORMAT(FROM_UNIXTIME(" . $this->dx('date') . "),'%m-%Y')", date('m-Y'), FALSE)
                                        ->get('ministry_support')
                                        ->result();
         }

         //Sum Contributions
         function others_bar()
         {
              $this->select_all_key('other_contributions');
              return $this->db->where_in("DATE_FORMAT(FROM_UNIXTIME(" . $this->dx('date') . "),'%m-%Y')", date('m-Y'), FALSE)
                                        ->get('other_contributions')
                                        ->result();
         }

         //Sum Contributions
         function tithes_chart()
         {
              $this->select_all_key('tithes');
              return $this->db->select($this->dx('totals'), FALSE)->where_in("DATE_FORMAT(FROM_UNIXTIME(" . $this->dx('date') . "),'%Y')", date('Y'), FALSE)->get('tithes')->result();
         }

         //Sum Contributions
         function offerings_chart()
         {
              $this->select_all_key('offerings');
              return $this->db->select($this->dx('amount'), FALSE)->where_in("DATE_FORMAT(FROM_UNIXTIME(" . $this->dx('date') . "),'%Y')", date('Y'), FALSE)->get('offerings')->result();
         }

         //Sum Contributions
         function thanks_chart()
         {
              $this->select_all_key('thanks_giving');
              return $this->db->select($this->dx('totals'), FALSE)->where_in("DATE_FORMAT(FROM_UNIXTIME(" . $this->dx('date') . "),'%Y')", date('Y'), FALSE)->get('thanks_giving')->result();
         }

         //Sum Contributions
         function support_chart()
         {
              $this->select_all_key('ministry_support');
              return $this->db->select($this->dx('totals'), FALSE)->where_in("DATE_FORMAT(FROM_UNIXTIME(" . $this->dx('date') . "),'%Y')", date('Y'), FALSE)->get('ministry_support')->result();
         }

         //Sum Contributions
         function seeds_chart()
         {
              $this->select_all_key('seed_planting');
              return $this->db->select($this->dx('totals'), FALSE)->where_in("DATE_FORMAT(FROM_UNIXTIME(" . $this->dx('date') . "),'%Y')", date('Y'), FALSE)->get('seed_planting')->result();
         }

         //Sum Contributions
         function others_chart()
         {
              $this->select_all_key('other_contributions');
              return $this->db->select($this->dx('totals'), FALSE)->where_in("DATE_FORMAT(FROM_UNIXTIME(" . $this->dx('date') . "),'%Y')", date('Y'), FALSE)->get('other_contributions')->result();
         }

         //fetch Events
         function fetch_events()
         {
              return $this->db->where('status', 1)->get('events')->result();
         }

         //fetch Meetings
         function fetch_meetings()
         {
              return $this->db->where('status', 1)->get('meetings')->result();
         }

         function count_events()
         {
              return $this->db->count_all_results('events');
         }

         function count_meetings()
         {
              return $this->db->count_all_results('meetings');
         }

         function count_my_sms($id)
         {
              return $this->db->where('recipient', $id)->count_all_results('sms');
         }

         function get_member_groups($id)
         {
              return $this->db->where('member_id', $id)->get('member_groups')->result();
         }

         //GET SMS COUNTER DATA
         function get_counter_balance()
         {
              $this->select_all_key('sms_counter');
              return $this->db->where(array('id' => 1))->get('sms_counter')->row();
         }

         function get_sms()
         {
              //$this->select_all_key('sms');
              $sms = $this->db->order_by('created_on', 'DESC')->limit(10)->get('sms')->result();
              return $sms;
         }

         function count_sms()
         {
              return $this->db->count_all_results('sms');
         }

         //Overdue Pending Pledges
         function pending()
         {
              $this->db->where('status', 1);
              $this->db->order_by('id', 'desc');
              return $this->db->where('expected_pay_date <' . time())->limit(10)->get('pledges')->result();
         }

         function count_overdue_pledges()
         {
              $this->db->where('status', 1);
              return $this->db->where('expected_pay_date <' . time())->count_all_results('pledges');
         }

         function get_tasks()
         {
              return $this->db->where('status', 'Ongoing')->order_by('created_on', 'DESC')->limit(10)->get('task_manager')->result();
         }

         function count_tasks()
         {
              return $this->db->where('status', 'ongoing')->count_all_results('task_manager');
         }

         //SMS Purchase History   
         function purchase_hostory()
         {
              $this->select_all_key('current');
              return $this->db->order_by('created_on', 'DESC')->get('current')->result();
         }

         function create_member($data)
         {
              $this->insert_key_data('members', $data);
              return $this->db->insert_id();
         }

         //Mobile App
         function all_announcements()
         {
              $this->db->order_by('id', 'desc');
              $this->db->where('status', 1);
              $query = $this->db->get('announcements');
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

         //Mobile App
         function all_events()
         {
              $this->db->order_by('id', 'desc');
              $this->db->where('status', 1);
              $query = $this->db->get('events');
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

         //Meetings
         function all_meetings()
         {
              $this->db->order_by('id', 'desc');
              $this->db->where('status', 1);
              $query = $this->db->get('meetings');
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

         //Meetings
         function all_sermons()
         {
              $this->db->order_by('id', 'desc');
              // $this->db->where('status', 1);
              $query = $this->db->get('sermons');
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

         //Meetings
         function all_videos()
         {
              $this->db->order_by('id', 'desc');
              // $this->db->where('status', 1);
              $query = $this->db->get('video_sermons');
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

         //
         function all_hbcs()
         {
              $this->db->order_by('id', 'desc');
              // $this->db->where('status', 1);
              $query = $this->db->get('hbcs');
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

         //
         function all_ministries()
         {
              $this->db->order_by('id', 'desc');
              // $this->db->where('status', 1);
              $query = $this->db->get('ministries');
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

         function find_member($id)
         {
              $this->select_all_key('members');
              return $this->db->where(array('id' => $id))->get('members')->row();
         }

         function create_sms($data)
         {
              $this->db->insert('sms', $data);
              return $this->db->insert_id();
         }

         function post_prayers($data)
         {
              $this->db->insert('prayer_requests', $data);
              return $this->db->insert_id();
         }

         //UPDATE SMS COUNTER
         function update_counter($data)
         {
              return $this->update_key_data(1, 'sms_counter', $data);
         }

         function update_member($id, $data)
         {
              return $this->update_key_data($id, 'members', $data);
              // return  $this->db->where('id', $id) ->update('members', $data);
         }

    }
    