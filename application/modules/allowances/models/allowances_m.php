<?php

    class Allowances_m extends MY_Model
    {

         function __construct()
         {
              // Call the Model constructor
              parent::__construct();
              $this->db_set();
         }

         /**
          * Setup DB Table Automatically
          * 
          */
         function db_set()
         {
              $this->db->query(" 
					CREATE TABLE IF NOT EXISTS  allowances (
					id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
					name  varchar(256)  DEFAULT '' NOT NULL, 
					amount  varchar(256)  DEFAULT '' NOT NULL, 
					created_by INT(11), 
					modified_by INT(11), 
					created_on INT(11) , 
					modified_on INT(11) 
					) ENGINE=InnoDB  DEFAULT CHARSET=utf8; ");
         }

         function create($data)
         {
              $this->db->insert('allowances', $data);
              return $this->db->insert_id();
         }

         function find($id)
         {
              return $this->db->where(array('id' => $id))->get('allowances')->row();
         }

         function exists($id)
         {
              return $this->db->where(array('id' => $id))->count_all_results('allowances') > 0;
         }

         function count()
         {

              return $this->db->count_all_results('allowances');
         }

         function update_attributes($id, $data)
         {
              return $this->db->where('id', $id)->update('allowances', $data);
         }

         function populate($table, $option_val, $option_text)
         {
              $query = $this->db->select('*')->order_by($option_text)->get($table);
              $dropdowns = $query->result();

              foreach ($dropdowns as $dropdown)
              {
                   $options[$dropdown->$option_val] = $dropdown->$option_text;
              }
              return $options;
         }

         function delete($id)
         {
              return $this->db->delete('allowances', array('id' => $id));
         }

         function paginate_all($limit, $page)
         {
              $offset = $limit * ( $page - 1);

              $this->db->order_by('id', 'desc');
              $query = $this->db->get('allowances', $limit, $offset);

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
    