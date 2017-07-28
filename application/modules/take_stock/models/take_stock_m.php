<?php

    class Take_stock_m extends MY_Model
    {

         function __construct()
         {
              // Call the Model constructor
              parent::__construct();
              $this->db_set();
         }

         function create($data)
         {
              $this->db->insert('take_stock', $data);
              return $this->db->insert_id();
         }

         function get_items()
         {
              $result = $this->db->select('asset_stock.item, asset_items.id,asset_items.name as nam')
                           ->join('asset_stock', 'asset_stock.item=asset_items.id')
                           ->get('asset_items')
                           ->result();

              $rr = array();
              foreach ($result as $r)
              {
                   $rr[$r->item] = $r->nam;
              }

              return $rr;
         }

         function find($id)
         {
              return $this->db->where(array('id' => $id))->get('take_stock')->row();
         }

         function exists($id)
         {
              return $this->db->where(array('id' => $id))->count_all_results('take_stock') > 0;
         }

         function count()
         {

              return $this->db->count_all_results('take_stock');
         }

         function update_attributes($id, $data)
         {
              return $this->db->where('id', $id)->update('take_stock', $data);
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
              return $this->db->delete('take_stock', array('id' => $id));
         }

         /**
          * Setup DB Table Automatically
          * 
          */
         function db_set()
         {
              $this->db->query(" 
	CREATE TABLE IF NOT EXISTS  take_stock (
	id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
	date  INT(11), 
	asset_name  varchar(32)  DEFAULT '' NOT NULL, 
	remaining_stock  varchar(256)  DEFAULT '' NOT NULL, 
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
              $query = $this->db->get('take_stock', $limit, $offset);

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
    