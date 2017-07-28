<?php

    class Advance_salary_m extends MY_Model
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
					CREATE TABLE IF NOT EXISTS  advance_salary (
					id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
					employee  varchar(256)  DEFAULT '' NOT NULL, 
					advance_date  INT(11), 
					amount  varchar(256)  DEFAULT '' NOT NULL, 
					comment  text  DEFAULT '' NOT NULL, 
					status INT(11), 
					created_by INT(11), 
					modified_by INT(11), 
					created_on INT(11) , 
					modified_on INT(11) 
					) ENGINE=InnoDB  DEFAULT CHARSET=utf8; ");
         }

         function create($data)
         {
              $this->db->insert('advance_salary', $data);
              return $this->db->insert_id();
         }

         //List Employees
         //Head Teachers	
         public function list_employees()
         {

              $results = $this->db->get('salaries')->result();

              $arr4 = array();

              foreach ($results as $res)
              {
                   $user = $this->ion_auth->get_user($res->employee);

                   $arr4[$res->employee] = $user->first_name . ' ' . $user->last_name;
              }

              return $arr4;
         }

         function find($id)
         {
              return $this->db->where(array('id' => $id))->get('advance_salary')->row();
         }

         function exists($id)
         {
              return $this->db->where(array('id' => $id))->count_all_results('advance_salary') > 0;
         }

         function count()
         {

              return $this->db->count_all_results('advance_salary');
         }

         function update_attributes($id, $data)
         {
              return $this->db->where('id', $id)->update('advance_salary', $data);
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
              return $this->db->delete('advance_salary', array('id' => $id));
         }

         function paginate_all($limit, $page)
         {
              $offset = $limit * ( $page - 1);

              $this->db->order_by('id', 'desc');
              $query = $this->db->get('advance_salary', $limit, $offset);

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
    