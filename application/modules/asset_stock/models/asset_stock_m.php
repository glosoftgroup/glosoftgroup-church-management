<?php

    class Asset_stock_m extends MY_Model
    {

         function __construct()
         {
              // Call the Model constructor
              parent::__construct();
              $this->db_set();
         }

         function create($data)
         {
              $this->db->insert('asset_stock', $data);
              return $this->db->insert_id();
         }

         function suppliers()
         {
              $this->db->order_by('id', 'desc');
              $this->db->where('address_book', 'suppliers');
              $query = $this->db->get('address_book');

              $result = array();

              foreach ($query->result() as $row)
              {
                   $result[$row->id] = $row->contact_person . ' [' . $row->phone . ']';
              }


              return $result;
         }

         function find($id)
         {
              return $this->db->where(array('id' => $id))->get('asset_stock')->row();
         }

         function exists($id)
         {
              return $this->db->where(array('id' => $id))->count_all_results('asset_stock') > 0;
         }

         function count()
         {

              return $this->db->count_all_results('asset_stock');
         }

         function update_attributes($id, $data)
         {
              return $this->db->where('id', $id)->update('asset_stock', $data);
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
              return $this->db->delete('asset_stock', array('id' => $id));
         }

         /**
          * Setup DB Table Automatically
          * 
          */
         function db_set()
         {
              $this->db->query(" 
	CREATE TABLE IF NOT EXISTS  asset_stock (
	id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
	date  INT(11), 
	supplier  varchar(32)  DEFAULT '' NOT NULL, 
	item  varchar(32)  DEFAULT '' NOT NULL, 
	quantity  varchar(256)  DEFAULT '' NOT NULL, 
	unit_price  varchar(256)  DEFAULT '' NOT NULL, 
	total  varchar(256)  DEFAULT '' NOT NULL, 
	person_responsible  varchar(32)  DEFAULT '' NOT NULL, 
	file  varchar(256)  DEFAULT '' NOT NULL, 
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
              $query = $this->db->get('asset_stock', $limit, $offset);

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
    