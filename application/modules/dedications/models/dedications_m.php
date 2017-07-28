<?php

    class Dedications_m extends MY_Model
    {

         function __construct()
         {
              // Call the Model constructor
              parent::__construct();
              $this->db_set();
         }

         function create($data)
         {
              $this->db->insert('dedications', $data);
              return $this->db->insert_id();
         }

         function insert_paro($data)
         {
              $this->db->insert('cfd_parents', $data);
         }

         function find($id)
         {
              return $this->db->where(array('id' => $id))->get('dedications')->row();
         }

         function get_parents($id)
         {
              return $this->db->where(array('child_id' => $id))->get('cfd_parents')->result();
         }

         function get_mmparents($id, $id2)
         {

              $res = $this->db->select('members.id, members.first_name,members.last_name,members.phone1 as phone, members.email, members.address')
                           ->where_in('id', array($id, $id2))
                           ->get('members')
                           ->result();

              return $res;
         }

         function exists($id)
         {
              return $this->db->where(array('id' => $id))->count_all_results('dedications') > 0;
         }

         function count()
         {

              return $this->db->count_all_results('dedications');
         }

         function update_attributes($id, $data)
         {
              return $this->db->where('id', $id)->update('dedications', $data);
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
              return $this->db->delete('dedications', array('id' => $id));
         }

         /**
          * Setup DB Table Automatically
          * 
          */
         function db_set()
         {
              $this->db->query(" 
	CREATE TABLE IF NOT EXISTS  dedications (
	id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
	date  INT(11), 
	child_id  INT(11), 
	first_name  varchar(256)  DEFAULT '' NOT NULL, 
	middle_name  varchar(256)  DEFAULT '' NOT NULL, 
	last_name  varchar(256)  DEFAULT '' NOT NULL, 
	gender  varchar(256)  DEFAULT '' NOT NULL, 
	dob  INT(11), 
	status  INT(11), 
	location  varchar(256)  DEFAULT '' NOT NULL, 
	country  varchar(256)  DEFAULT '' NOT NULL, 
	city  varchar(256)  DEFAULT '' NOT NULL, 
	expected_dedication_date  INT(11), 
	service_type  varchar(256)  DEFAULT '' NOT NULL, 
	description  text  , 
	type INT(11), 
	mother INT(11), 
	father INT(11), 
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
              $query = $this->db->get('dedications', $limit, $offset);

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
    