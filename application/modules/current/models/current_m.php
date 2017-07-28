<?php

    class Current_m extends MY_Model
    {

         function __construct()
         {
              // Call the Model constructor
              parent::__construct();
              $this->db_set();
         }

         function create($data)
         {
              $this->insert_key_data('current', $data);
              return $this->db->insert_id();
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

         function find($id)
         {
              $this->select_all_key('current');
              return $this->db->where(array('id' => $id))->get('current')->row();
         }

         function exists($id)
         {
              return $this->db->where(array('id' => $id))->count_all_results('current') > 0;
         }

         function count()
         {

              return $this->db->count_all_results('current');
         }

         function update_attributes($id, $data)
         {
              return $this->db->where('id', $id)->update('current', $data);
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
              return $this->db->delete('current', array('id' => $id));
         }

         /**
          * Setup DB Table Automatically
          * 
          */
         function db_set()
         {
              $this->db->query(" 
	CREATE TABLE IF NOT EXISTS  current (
	id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
	date  BLOB, 
	total  BLOB, 
	created_by BLOB, 
	modified_by BLOB, 
	created_on BLOB , 
	modified_on BLOB 
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8; ");
         }

         function paginate_all($limit, $page)
         {
              $offset = $limit * ( $page - 1);

              $this->select_all_key('current');

              $this->db->order_by('id', 'desc');
              $query = $this->db->get('current', $limit, $offset);

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
    