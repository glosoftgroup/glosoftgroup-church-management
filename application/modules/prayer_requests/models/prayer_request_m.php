<?php

    class Prayer_request_m extends MY_Model
    {

         function __construct()
         {
              // Call the Model constructor
              parent::__construct();
              $this->db_set();
         }

         function create($data)
         {
              $this->db->insert('prayer_requests', $data);
              return $this->db->insert_id();
         }

         function find($id)
         {
              return $this->db->where(array('id' => $id))->get('prayer_requests')->row();
         }

         function exists($id)
         {
              return $this->db->where(array('id' => $id))->count_all_results('prayer_requests') > 0;
         }

         function count()
         {

              return $this->db->count_all_results('prayer_requests');
         }

         function update_attributes($id, $data)
         {
              return $this->db->where('id', $id)->update('prayer_requests', $data);
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
              return $this->db->delete('prayer_requests', array('id' => $id));
         }

         /**
          * Setup DB Table Automatically
          * 
          */
         function db_set()
         {
              $this->db->query(" 
	CREATE TABLE IF NOT EXISTS  prayer_requests (
	id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
	request_date  INT(11), 
	phone_number  varchar(256)  DEFAULT '' NOT NULL, 
	first_name  varchar(256)  DEFAULT '' NOT NULL, 
	second_name  varchar(256)  DEFAULT '' NOT NULL, 
	address  varchar(256)  DEFAULT '' NOT NULL, 
	membership  varchar(32)  DEFAULT '' NOT NULL, 
	prayer_request  text  , 
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
              $query = $this->db->get('prayer_requests', $limit, $offset);

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
    