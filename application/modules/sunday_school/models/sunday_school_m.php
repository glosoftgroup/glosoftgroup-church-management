<?php

    class Sunday_school_m extends MY_Model
    {

         function __construct()
         {
              // Call the Model constructor
              parent::__construct();
              $this->db_set();
         }

         function create($data)
         {
              $this->db->insert('sunday_school', $data);
              return $this->db->insert_id();
         }

         function insert_paro($data)
         {
              $this->db->insert('ss_parents', $data);
              return $this->db->insert_id();
         }

         //get all children in array
         function get_childen()
         {
              $res = $this->db->get('sunday_school')->result();
              $rows = array();
              foreach ($res as $r)
              {
                   $rows [$r->id] = $r->first_name . ' ' . $r->last_name;
              }
              return $rows;
         }

         function find($id)
         {
              return $this->db->where(array('id' => $id))->get('sunday_school')->row();
         }

         function get_ssparent($id)
         {
              return $this->db->where(array('child_id' => $id))->get('ss_parents')->row();
         }

         function ss_parent($id)
         {
              return $this->db->where(array('child_id' => $id))->get('ss_parents')->result();
         }

         function get_single_parent($id)
         {
              return $this->db->where(array('id' => $id))->get('members')->row();
         }

         function get_parent($id)
         {
              return $this->db->where(array('id' => $id))->get('members')->result();
         }

         function exists($id)
         {
              return $this->db->where(array('id' => $id))->count_all_results('sunday_school') > 0;
         }

         function count()
         {
              return $this->db->count_all_results('sunday_school');
         }

         function update_attributes($id, $data)
         {
              return $this->db->where('id', $id)->update('sunday_school', $data);
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
              return $this->db->delete('sunday_school', array('id' => $id));
         }

         /**
          * Setup DB Table Automatically
          * 
          */
         function db_set()
         {
              $this->db->query(" 
	CREATE TABLE IF NOT EXISTS  sunday_school (
	id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
	date_joined  INT(11), 
	parent_id  INT(11), 
	type  INT(11), 
	first_name  varchar(256)  DEFAULT '' NOT NULL, 
	relationship  varchar(256)  DEFAULT '' NOT NULL, 
	last_name  varchar(256)  DEFAULT '' NOT NULL, 
	dob  INT(11), 
	gender  varchar(256)  DEFAULT '' NOT NULL, 
	home_phone  varchar(256)  DEFAULT '' NOT NULL, 
	baptised  varchar(256)  DEFAULT '' NOT NULL, 
	confirmed  varchar(256)  DEFAULT '' NOT NULL, 
	how_joined  varchar(256)  DEFAULT '' NOT NULL, 
	residential  varchar(256)  DEFAULT '' NOT NULL, 
	special_interest  text  , 
	strengths  text  , 
	weaknesses  text  , 
	health  text  , 
	passport  varchar(256)  DEFAULT '' NOT NULL, 
	additionals  text  , 
	created_by INT(11), 
	modified_by INT(11), 
	created_on INT(11) , 
	modified_on INT(11) 
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8; ");
         }

         function ss_parent_details()
         {

              $res = $this->db->get('ss_parents')->result();
              $rr = array();

              foreach ($res as $r)
              {
                   $rr[$r->child_id] = $r->first_name . ' ' . $r->last_name;
              }

              return $rr;
         }

         function paginate_all($limit, $page)
         {
              $offset = $limit * ( $page - 1);

              $this->db->order_by('id', 'desc');
              $query = $this->db->get('sunday_school', $limit, $offset);

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
    