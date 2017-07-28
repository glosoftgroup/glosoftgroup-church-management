<?php

    class Offerings_m extends MY_Model
    {

         function __construct()
         {
              // Call the Model constructor
              parent::__construct();
              $this->db_set();
         }

         function create($data)
         {
              $this->insert_key_data('offerings', $data);
              return $this->db->insert_id();
         }

         //This count Purchases
         function todays()
         {
              return $this->db->select("sum(" . $this->dx('amount') . ") as total", FALSE)->where("DATE_FORMAT(FROM_UNIXTIME(" . $this->dx('date') . "),'%d')=" . date('d'), NULL, FALSE)->get('offerings')->row();
         }

         //This count Purchases
         function months()
         {
              return $this->db->select('sum(' . $this->dx('amount') . ') as total', FALSE)->where("DATE_FORMAT(FROM_UNIXTIME(" . $this->dx('date') . "),'%m')=" . date('m'), NULL, FALSE)->get('offerings')->row();
         }

         //This count Purchases
         function years()
         {
              return $this->db->select('sum(' . $this->dx('amount') . ') as total', FALSE)->where("DATE_FORMAT(FROM_UNIXTIME(" . $this->dx('date') . "),'%Y')=" . date('Y'), NULL, FALSE)->get('offerings')->row();
         }

//This count Purchases
         function total_collection()
         {
              return $this->db->select('sum(' . $this->dx('amount') . ') as total', FALSE)->get('offerings')->row();
         }

         function find($id)
         {
              $this->select_all_key('offerings');
              return $this->db->where(array('id' => $id))->get('offerings')->row();
         }

         function get_banks()
         {

              $results = $this->db->get('bank_accounts')->result();

              $res = array();

              foreach ($results as $r)
              {
                   $res[$r->id] = $r->bank_name . ' (' . $r->account_number . ')';
              }

              return $res;
         }

         function exists($id)
         {
              return $this->db->where(array('id' => $id))->count_all_results('offerings') > 0;
         }

         function count()
         {

              return $this->db->count_all_results('offerings');
         }

         function update_attributes($id, $data)
         {
              return $this->update_key_data($id, 'offerings', $data);
              //return  $this->db->where('id', $id) ->update('offerings', $data);
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
              return $this->db->delete('offerings', array('id' => $id));
         }

         /**
          * Setup DB Table Automatically
          * 
          */
         function db_set()
         {
              $this->db->query(" 
	CREATE TABLE IF NOT EXISTS  offerings (
	id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
	date  INT(11), 
	amount  varchar(256)  DEFAULT '' NOT NULL, 
	treasurer  varchar(32)  DEFAULT '' NOT NULL, 
	confirmed_by  varchar(32)  DEFAULT '' NOT NULL, 
	bank_deposited  varchar(32)  DEFAULT '' NOT NULL, 
	description  text  , 
	status INT(11), 
	created_by INT(11), 
	modified_by INT(11), 
	created_on INT(11) , 
	modified_on INT(11) 
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8; ");
         }

         function paginate_all($limit, $page)
         {
              $offset = $limit * ( $page - 1);

              $this->select_all_key('offerings');

              $this->db->order_by('id', 'desc');
              // $this->db->where('status', 1);
              $query = $this->db->where($this->dx('status') . '=1', NULL, FALSE)->get('offerings', $limit, $offset);

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

         function voided($limit, $page)
         {
              $offset = $limit * ( $page - 1);

              $this->select_all_key('offerings');

              $this->db->order_by('id', 'desc');
              $query = $this->db->where($this->dx('status') . '=0', NULL, FALSE)->get('offerings', $limit, $offset);

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
    