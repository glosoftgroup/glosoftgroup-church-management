<?php

    class Salaries_m extends MY_Model
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
                                   CREATE TABLE IF NOT EXISTS  salaries (
                                   id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
                                   employee varchar(256)  DEFAULT '' NOT NULL,
                                   salary_method varchar(256)  DEFAULT '' NOT NULL,
                                   basic_salary FLOAT NULL DEFAULT NULL,
                                   nhif FLOAT NULL DEFAULT NULL,
                                   bank_account_no varchar(256)  DEFAULT '' NOT NULL,
                                   bank_name varchar(256)  DEFAULT '' NOT NULL,
                                   nhif_no varchar(256)  DEFAULT '' NOT NULL,
                                   nssf_no varchar(256)  DEFAULT '' NOT NULL,
                                   created_by INT(11) ,
                                   modified_by INT(11) ,
                                   created_on INT(11) ,
                                   modified_on INT(11) 
                                   ) ENGINE=InnoDB  DEFAULT CHARSET=utf8; ");

              $this->db->query(" 
                                   CREATE TABLE IF NOT EXISTS  employee_deductions (
                                   id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
                                   `salary_id` INT(11) NULL DEFAULT NULL,
                                   `deduction_id` INT(11) NULL DEFAULT NULL,
                                   `created_by` INT(11) NULL DEFAULT NULL,
                                   `modified_by` INT(11) NULL DEFAULT NULL,
                                   `created_on` INT(11) NULL DEFAULT NULL,
                                   `modified_on` INT(11) NULL DEFAULT NULL
                                   ) ENGINE=InnoDB  DEFAULT CHARSET=utf8; ");

              $this->db->query(" 
                                   CREATE TABLE IF NOT EXISTS  employee_allowances (
                                   id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
                                   `salary_id` INT(11) NULL DEFAULT NULL,
                                   `allowance_id` INT(11) NULL DEFAULT NULL,
                                   `created_by` INT(11) NULL DEFAULT NULL,
                                   `modified_by` INT(11) NULL DEFAULT NULL,
                                   `created_on` INT(11) NULL DEFAULT NULL,
                                   `modified_on` INT(11) NULL DEFAULT NULL
                                   ) ENGINE=InnoDB  DEFAULT CHARSET=utf8; ");
         }

         function create($data)
         {
              $this->db->insert('salaries', $data);
              return $this->db->insert_id();
         }

         //Insert Deductions
         function insert_deducs($data)
         {
              $this->db->insert('employee_deductions', $data);
              return $this->db->insert_id();
         }

         function get_emp_deductions($id)
         {
              return $this->db->where('salary_id', $id)->get('employee_deductions')->result();
         }

         function get_emp_allowances($id)
         {
              return $this->db->where('salary_id', $id)->get('employee_allowances')->result();
         }

         //Insert Deductions
         function insert_allws($data)
         {
              $this->db->insert('employee_allowances', $data);
              return $this->db->insert_id();
         }

         //List Deductions
         function list_deductions()
         {

              $results = $this->db->get('deductions')->result();
              $arr = array();

              foreach ($results as $r)
              {

                   $arr[$r->id] = $r->name . ' - KES ' . number_format($r->amount, 2);
              }

              return $arr;
         }

         //List Allowances
         function list_allowances()
         {

              $results = $this->db->get('allowances')->result();
              $arr = array();

              foreach ($results as $r)
              {

                   $arr[$r->id] = $r->name . ' - KES ' . number_format($r->amount, 2);
              }

              return $arr;
         }

         function find($id)
         {
              return $this->db->where(array('id' => $id))->get('salaries')->row();
         }

         function get_all()
         {
              return $this->db->order_by('created_on', 'DESC')->get('salaries')->result();
         }

         //Get Employee deductions
         function get_deductions($id)
         {
              return $this->db->where(array('salary_id' => $id))->get('employee_deductions')->result();
         }

         //Get Employee allowances
         function get_allowance($id)
         {
              return $this->db->where(array('salary_id' => $id))->get('employee_allowances')->result();
         }

         function exists($id)
         {
              return $this->db->where(array('id' => $id))->count_all_results('salaries') > 0;
         }

         function exists_employee($id)
         {
              return $this->db->where(array('employee' => $id))->count_all_results('salaries') > 0;
         }

         function count()
         {

              return $this->db->count_all_results('salaries');
         }

         function update_attributes($id, $data)
         {
              return $this->db->where('id', $id)->update('salaries', $data);
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
              return $this->db->delete('salaries', array('id' => $id));
         }

         function delete_deductions($id)
         {
              return $this->db->delete('employee_deductions', array('salary_id' => $id));
         }

         function delete_allowances($id)
         {
              return $this->db->delete('employee_allowances', array('salary_id' => $id));
         }

         function paginate_all($limit, $page)
         {
              $offset = $limit * ( $page - 1);

              $this->db->order_by('id', 'desc');
              $query = $this->db->get('salaries', $limit, $offset);

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
    