<?php

    class Hbc_meeting_m extends MY_Model
    {

         function __construct()
         {
              // Call the Model constructor
              parent::__construct();
              $this->db_set();
         }

         function create($data)
         {
              $this->db->insert('hbc_meetings', $data);
              return $this->db->insert_id();
         }

         function find($id)
         {
              return $this->db->where(array('id' => $id))->get('hbc_meetings')->row();
         }

         function exists($id)
         {
              return $this->db->where(array('id' => $id))->count_all_results('hbc_meetings') > 0;
         }

//check if HBC is existing
         function exists_hbc($id)
         {
              return $this->db->where(array('id' => $id))->count_all_results('hbcs') > 0;
         }

         //get all members of this hbc in array
         function get_hbc_members($id)
         {

              $res = $this->db->where('hbc_id', $id)->get('members')->result();
              $rows = array();
              foreach ($res as $r)
              {
                   $rows [$r->id] = $r->first_name . ' ' . $r->last_name;
              }
              return $rows;
         }

         function count()
         {

              return $this->db->count_all_results('hbc_meetings');
         }

         function update_attributes($id, $data)
         {
              return $this->db->where('id', $id)->update('hbc_meetings', $data);
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
              return $this->db->delete('hbc_meetings', array('id' => $id));
         }

         /**
          * Setup DB Table Automatically
          * 
          */
         function db_set()
         {
              $this->db->query(" 
	CREATE TABLE IF NOT EXISTS  hbc_meetings (
	id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
	date INT(11), 
	hbc  varchar(32)  DEFAULT '' NOT NULL, 
	host  varchar(256)  DEFAULT '' NOT NULL, 
	hosts_phone_no  varchar(256)  DEFAULT '' NOT NULL, 
	
	house_number  varchar(256)  DEFAULT '' NOT NULL, 
	service_leader  varchar(32)  DEFAULT '' NOT NULL, 
	preacher  varchar(256)  DEFAULT '' NOT NULL, 
	brief_description  text  , 
	created_by INT(11), 
	modified_by INT(11), 
	created_on INT(11) , 
	modified_on INT(11) 
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8; ");
         }

         function paginate_all($limit, $page)
         {
              $offset = $limit * ( $page - 1);

              $this->db->order_by('id', 'desc');
              $query = $this->db->get('hbc_meetings', $limit, $offset);

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

         function meetings($limit, $page, $id)
         {
              $offset = $limit * ( $page - 1);

              $this->db->order_by('id', 'desc');
              $this->db->where('hbc', $id);
              $query = $this->db->get('hbc_meetings')->result();
              return $query;
         }

    }
    