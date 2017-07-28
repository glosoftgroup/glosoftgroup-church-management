<?php

    class Members_m extends MY_Model
    {

         function __construct()
         {
              // Call the Model constructor
              parent::__construct();
              $this->db_set();
         }

         function create($data)
         {
              $this->insert_key_data('members', $data);
              return $this->db->insert_id();
         }

         //Insert Member To Member Groups
         function insert_gm($data)
         {
              $this->db->insert('member_groups', $data);
              return $this->db->insert_id();
         }

         function create_relative($data)
         {
              $this->db->insert('relatives', $data);
              return $this->db->insert_id();
         }

         function members()
         {
              $this->select_all_key('members');
              return $this->db->get('members')->result();
         }

         function exists_mg($mem, $gp)
         {
              return $this->db->where(array('member_id' => $mem, 'group_id' => $gp))->count_all_results('member_groups') > 0;
         }

         //get all members in array
         function get_all_members()
         {
              $this->select_all_key('members');
              $res = $this->db->get('members')->result();
              $rows = array();
              foreach ($res as $r)
              {
                   $rows [$r->id] = $r->first_name . ' ' . $r->last_name;
              }
              return $rows;
         }

         function insert_ministries($data)
         {
              $this->db->insert('member_ministries', $data);
              return $this->db->insert_id();
         }

         function find($id)
         {
              $this->select_all_key('members');
              return $this->db->where(array('id' => $id))->get('members')->row();
         }

         function member_ministries($id)
         {
              return $this->db->where(array('member_id' => $id))->get('member_ministries')->result();
         }

         //Get Member SMSs
         function get_messages($id)
         {
              return $this->db->where(array('recipient' => $id))->order_by('created_on', 'DESC')->get('sms')->result();
         }

         function member_tithe($id)
         {
              return $this->db->where(array('member_id' => $id, 'status' => 1))->order_by('created_on', 'DESC')->get('members_tithe')->result();
         }

         function member_thanks_giving($id)
         {
              return $this->db->where(array('member_id' => $id, 'status' => 1))->order_by('created_on', 'DESC')->get('members_thanks_giving')->result();
         }

         function member_msupport($id)
         {
              return $this->db->where(array('member_id' => $id, 'status' => 1))->order_by('created_on', 'DESC')->get('members_ministry_support')->result();
         }

         function member_mseeds($id)
         {
              return $this->db->where(array('member_id' => $id, 'status' => 1))->order_by('created_on', 'DESC')->get('members_seed_planting')->result();
         }

         function member_mocontributions($id)
         {
              return $this->db->where(array('member_id' => $id, 'status' => 1))->order_by('created_on', 'DESC')->get('members_other_contributions')->result();
         }

         function member_pledges($id)
         {
              return $this->db->where(array('member' => $id))->where('status !=0')->order_by('created_on', 'DESC')->get('pledges')->result();
         }

         function total_paid($id)
         {
              return $this->db->select('sum(amount) as total')->where(array('pledge_id' => $id))->get('paid_pledges')->row();
         }

         function get_hbc_details()
         {

              $res = $this->db->get('hbcs')->result();
              $rr = array();
              foreach ($res as $r)
              {

                   $rr[$r->id] = '<tr><td>Name: </td><td><a>' . $r->name . '</a></td></tr>
			<tr><td> Estate: </td><td><a>' . $r->estate . '</a></td></tr>
			<tr><td>Meeting Day:</td><td><a>' . ucwords($r->meeting_day) . '</a></td>';
              }
              return $rr;
         }

         //Populate Ministries
         function ministry_details()
         {

              $res = $this->db->get('ministries')->result();
              $rr = array();
              foreach ($res as $r)
              {

                   $rr[$r->id] = '
			<tr><td> Name: </td><td><a>' . ucwords($r->name) . '</a></td></tr>
			<tr><td>Phone:</td><td><a>' . $r->mobile . '</a></td>';
              }
              return $rr;
         }

         //Get Relatives

         function get_realtive($id)
         {
              return $this->db->where(array('member_id' => $id))->get('relatives')->result();
         }

         //Get Ministries
         function get_ministries($id)
         {
              $results = $this->db->select('ministries.name,ministries.telephone,ministries.mobile,ministries.email,ministries.leader,ministries.id,member_ministries.ministry_id, member_ministries.member_id,member_ministries.id as mmid')
                           ->where(array('member_id' => $id))
                           ->join('ministries', 'ministries.id=member_ministries.ministry_id')
                           ->get('member_ministries')
                           ->result();

              return $results;
         }

         //Get Ministries
         function get_member_groups($id)
         {
              $results = $this->db
                           ->where(array('member_id' => $id))
                           ->get('member_groups')
                           ->result();

              return $results;
         }

         function exists($id)
         {
              return $this->db->where(array('id' => $id))->count_all_results('members') > 0;
         }

         function exists_mministry($id)
         {
              return $this->db->where(array('id' => $id))->count_all_results('member_ministries') > 0;
         }

         function count()
         {

              return $this->db->count_all_results('members');
         }

         function update_attributes($id, $data)
         {

              return $this->update_key_data($id, 'members', $data);
              // return  $this->db->where('id', $id) ->update('members', $data);
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
              return $this->db->delete('members', array('id' => $id));
         }

         function delete_mministry($id)
         {
              return $this->db->delete('member_ministries', array('id' => $id));
         }

         /**
          * Setup DB Table Automatically
          * 
          */
         function db_set()
         {
              $this->db->query(" 
	CREATE TABLE IF NOT EXISTS  members (
	id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
	date_joined  INT(11), 
	title  varchar(32)  DEFAULT '' NOT NULL, 
	first_name  varchar(256)  DEFAULT '' NOT NULL, 
	last_name  varchar(256)  DEFAULT '' NOT NULL, 
	gender  varchar(32)  DEFAULT '' NOT NULL, 
	dob  INT(11), 
	hbc_id  INT(11), 
	phone1  varchar(256)  DEFAULT '' NOT NULL, 
	phone2  varchar(256)  DEFAULT '' NOT NULL, 
	email  varchar(256)  DEFAULT '' NOT NULL, 
	country  varchar(32)  DEFAULT '' NOT NULL, 
	county  varchar(32)  DEFAULT '' NOT NULL, 
	location  varchar(256)  DEFAULT '' NOT NULL, 
	address  text  , 
	marital_status  varchar(32)  DEFAULT '' NOT NULL, 
	member_status  varchar(32)  DEFAULT '' NOT NULL, 
	passport  varchar(256)  DEFAULT '' NOT NULL, 
	occupation  varchar(32)  DEFAULT '' NOT NULL, 
	employer  varchar(256)  DEFAULT '' NOT NULL, 
	how_joined  varchar(32)  DEFAULT '' NOT NULL, 
	baptised  varchar(32)  DEFAULT '' NOT NULL, 
	confirmed  varchar(32)  DEFAULT '' NOT NULL, 
	description  text  , 
	created_by INT(11), 
	modified_by INT(11), 
	created_on INT(11) , 
	modified_on INT(11) 
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8; 

");

              $this->db->query(" 

	CREATE TABLE IF NOT EXISTS relatives (
	id INT(11) NOT NULL AUTO_INCREMENT,
	member_id INT(11) NOT NULL DEFAULT '0',
	first_name VARCHAR(256) NOT NULL DEFAULT '',
	last_name VARCHAR(256) NOT NULL DEFAULT '',
	member_code VARCHAR(256) NOT NULL DEFAULT '',
	gender VARCHAR(32) NOT NULL DEFAULT '',
	type VARCHAR(32) NOT NULL DEFAULT '',
	relationship VARCHAR(32) NOT NULL DEFAULT '',
	phone VARCHAR(256) NOT NULL DEFAULT '',
	location VARCHAR(256) NOT NULL DEFAULT '',
	email VARCHAR(256) NOT NULL DEFAULT '',
	additionals TEXT NULL,
	created_by INT(11) NULL DEFAULT NULL,
	modified_by INT(11) NULL DEFAULT NULL,
	created_on INT(11) NULL DEFAULT NULL,
	modified_on INT(11) NULL DEFAULT NULL,
	PRIMARY KEY (id)
)ENGINE=InnoDB  DEFAULT CHARSET=utf8; 


");
         }

         function paginate_all($limit, $page)
         {
              $offset = $limit * ( $page - 1);
              $this->select_all_key('members');

              $this->db->order_by('id', 'desc');
              $query = $this->db->get('members', $limit, $offset);

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
    