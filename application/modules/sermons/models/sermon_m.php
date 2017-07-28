<?php

    class Sermon_m extends MY_Model
    {

         function __construct()
         {
              // Call the Model constructor
              parent::__construct();
              $this->db_set();
         }

         function create($data)
         {
              $this->db->insert('sermons', $data);
              return $this->db->insert_id();
         }

         function find($id)
         {
              return $this->db->where(array('id' => $id))->get('sermons')->row();
         }

         function exists($id)
         {
              return $this->db->where(array('id' => $id))->count_all_results('sermons') > 0;
         }

         function count()
         {

              return $this->db->count_all_results('sermons');
         }

         function update_attributes($id, $data)
         {
              return $this->db->where('id', $id)->update('sermons', $data);
         }

         function populate($table, $option_val, $option_text)
         {
              //$this-populate('$table','$name','$id')

              $query = $this->db->select('*')->order_by($option_text)->get($table);
              $dropdowns = $query->result();
              $options = array();
              foreach ($dropdowns as $dropdown)
              {
                   $options[$dropdown->$option_val] = $dropdown->$option_text;
              }
              return $options;
         }

         function get_users()
         {

              $this->select_all_key('users');

              //$results = $this->db->select('users')->get('users')->result(); db not encrypted
              $results = $this->db->get('users')->result();

              $res = array();

              foreach ($results as $r)
              {

                   $res[$r->id] = $r->first_name . ' ' . $r->last_name;
              }

              return $res;
         }

         function delete($id)
         {
              return $this->db->delete('sermons', array('id' => $id));
         }

         /**
          * Setup DB Table Automatically
          * 
          */
         function db_set()
         {
              $this->db->query(" 
	CREATE TABLE IF NOT EXISTS  sermons (
	id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
	service_date  INT(11), 
	title  varchar(256)  DEFAULT '' NOT NULL, 
	service_leader  varchar(256)  DEFAULT '' NOT NULL, 
	first_service  varchar(256)  DEFAULT '' NOT NULL, 
	second_service  varchar(256)  DEFAULT '' NOT NULL, 
	pastor_on_duty  varchar(32)  DEFAULT '' NOT NULL, 
	sermon_theme  text  , 
	description  text  , 
	upload_sermon  varchar(256)  DEFAULT '' NOT NULL, 
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
              $query = $this->db->get('sermons', $limit, $offset);

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
    