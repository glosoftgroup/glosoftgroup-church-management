<?php

    class Visitors_m extends MY_Model
    {

         function __construct()
         {
              // Call the Model constructor
              parent::__construct();
              $this->db_set();
         }

         function create($data)
         {
              $this->db->insert('visitors', $data);
              return $this->db->insert_id();
         }

         function find($id)
         {
              return $this->db->where(array('id' => $id))->get('visitors')->row();
         }

         function exists($id)
         {
              return $this->db->where(array('id' => $id))->count_all_results('visitors') > 0;
         }

         function count()
         {

              return $this->db->count_all_results('visitors');
         }

         function update_attributes($id, $data)
         {
              return $this->db->where('id', $id)->update('visitors', $data);
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
              return $this->db->delete('visitors', array('id' => $id));
         }

         /**
          * Setup DB Table Automatically
          * 
          */
         function db_set()
         {
              $this->db->query(" 
	CREATE TABLE IF NOT EXISTS  visitors (
	id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
	visit_date  INT(11), 
	first_name  varchar(256)  DEFAULT '' NOT NULL, 
	last_name  varchar(256)  DEFAULT '' NOT NULL, 
	gender  varchar(256)  DEFAULT '' NOT NULL, 
	phone  varchar(256)  DEFAULT '' NOT NULL, 
	email  varchar(256)  DEFAULT '' NOT NULL, 
	county  varchar(256)  DEFAULT '' NOT NULL, 
	location  varchar(256)  DEFAULT '' NOT NULL, 
	directed_by  varchar(256)  DEFAULT '' NOT NULL, 
	interested_in_membership INT(1) NOT NULL, 
	saved INT(1) NOT NULL, 
	baptised INT(1) NOT NULL, 
	know_more INT(1) NOT NULL, 
	ministries_interest INT(1) NOT NULL, 
	come_back INT(1) NOT NULL, 
	additionals  text  , 
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
              $query = $this->db->get('visitors', $limit, $offset);

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
    