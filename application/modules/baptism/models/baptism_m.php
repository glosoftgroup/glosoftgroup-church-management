<?php

    class Baptism_m extends MY_Model
    {

         function __construct()
         {
              // Call the Model constructor
              parent::__construct();
              $this->db_set();
         }

         function create($data)
         {
              $this->db->insert('baptism', $data);
              return $this->db->insert_id();
         }

         function find($id)
         {
              return $this->db->where(array('id' => $id))->get('baptism')->row();
         }

         function exists($id)
         {
              return $this->db->where(array('id' => $id))->count_all_results('baptism') > 0;
         }

         function count()
         {

              return $this->db->count_all_results('baptism');
         }

         function update_attributes($id, $data)
         {
              return $this->db->where('id', $id)->update('baptism', $data);
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
              return $this->db->delete('baptism', array('id' => $id));
         }

         /**
          * Setup DB Table Automatically
          * 
          */
         function db_set()
         {
              $this->db->query(" 
	CREATE TABLE IF NOT EXISTS  baptism (
	id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
	date  INT(11), 
	type  INT(11), 
	status  INT(11), 
	member  varchar(32)  DEFAULT '' NOT NULL, 
	ff_name  varchar(256)  DEFAULT '' NOT NULL, 
	fl_name  varchar(256)  DEFAULT '' NOT NULL, 
	father_religion  varchar(256)  DEFAULT '' NOT NULL, 
	father_phone  varchar(256)  DEFAULT '' NOT NULL, 
	father_email  varchar(256)  DEFAULT '' NOT NULL, 
	father_address  text  , 
	mf_name  varchar(256)  DEFAULT '' NOT NULL, 
	ml_name  varchar(256)  DEFAULT '' NOT NULL, 
	mother_religion  varchar(256)  DEFAULT '' NOT NULL, 
	mother_phone  varchar(256)  DEFAULT '' NOT NULL, 
	mother_email  varchar(256)  DEFAULT '' NOT NULL, 
	mother_address  text  , 
	gff_name  varchar(256)  DEFAULT '' NOT NULL, 
	gfl_name  varchar(256)  DEFAULT '' NOT NULL, 
	gf_age  varchar(256)  DEFAULT '' NOT NULL, 
	gf_phone  varchar(256)  DEFAULT '' NOT NULL, 
	gf_address  text  , 
	gmf_name  varchar(256)  DEFAULT '' NOT NULL, 
	gml_name  varchar(256)  DEFAULT '' NOT NULL, 
	gm_age  varchar(256)  DEFAULT '' NOT NULL, 
	gm_phone  varchar(256)  DEFAULT '' NOT NULL, 
	gm_address  varchar(256)  DEFAULT '' NOT NULL, 
	description  text  , 
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
              $query = $this->db->get('baptism', $limit, $offset);

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
    