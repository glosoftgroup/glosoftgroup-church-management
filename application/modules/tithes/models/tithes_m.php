<?php

    class Tithes_m extends MY_Model
    {

         function __construct()
         {
              // Call the Model constructor
              parent::__construct();
              $this->db_set();
         }

         //This count Purchases
         function todays()
         {
              return $this->db->select("sum(" . $this->dx('totals') . ") as total", FALSE)->where("DATE_FORMAT(FROM_UNIXTIME(" . $this->dx('date') . "),'%d')=" . date('d'), NULL, FALSE)->get('tithes')->row();
         }

         //This count Purchases
         function months()
         {
              return $this->db->select('sum(' . $this->dx('totals') . ') as total', FALSE)->where("DATE_FORMAT(FROM_UNIXTIME(" . $this->dx('date') . "),'%m')=" . date('m'), NULL, FALSE)->get('tithes')->row();
         }

         //This count Purchases
         function years()
         {
              return $this->db->select('sum(' . $this->dx('totals') . ') as total', FALSE)->where("DATE_FORMAT(FROM_UNIXTIME(" . $this->dx('date') . "),'%Y')=" . date('Y'), NULL, FALSE)->get('tithes')->row();
         }

//This count Purchases
         function total_collection()
         {
              return $this->db->select('sum(' . $this->dx('totals') . ') as total', FALSE)->get('tithes')->row();
         }

         function create($data)
         {
              $this->insert_key_data('tithes', $data);
              return $this->db->insert_id();
         }

         function insert_tithes($data)
         {
              $this->db->insert('members_tithe', $data);
              return $this->db->insert_id();
         }

         function get_conts()
         {
               return $this->db->get('members_tithe')->result();
         }

         function get_all()
         {
              $this->select_all_key('tithes');
              return $this->db->get('tithes')->result();
         }

         function find($id)
         {
              $this->select_all_key('tithes');
              return $this->db->where(array('id' => $id))->get('tithes')->row();
         }

         function get_member_giving($id)
         {
              return $this->db->where(array('id' => $id))->get('members_tithe')->row();
         }

         function get_tithes($id)
         {
              return $this->db->where(array('tithe_id' => $id, 'status' => 1))->get('members_tithe')->result();
         }

         function get_single_tithe($id)
         {
              return $this->db->where(array('id' => $id, 'status' => 1))->get('members_tithe')->row();
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
              return $this->db->where(array('id' => $id))->count_all_results('tithes') > 0;
         }

         function exists_mem_tithe($id)
         {
              return $this->db->where(array('id' => $id))->count_all_results('members_tithe') > 0;
         }

         function count()
         {

              return $this->db->count_all_results('tithes');
         }

         function update_attributes($id, $data)
         {
              return $this->update_key_data($id, 'tithes', $data);
              //return  $this->db->where('id', $id) ->update('tithes', $data);
         }

         function update_mem_tithes($id, $data)
         {
              return $this->db->where('id', $id)->update('members_tithe', $data);
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
              return $this->db->delete('tithes', array('id' => $id));
         }

         /**
          * Setup DB Table Automatically
          * 
          */
         function db_set()
         {
              $this->db->query(" 
	CREATE TABLE IF NOT EXISTS  tithes (
	id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
	date  INT(11), 
	member  varchar(32)  DEFAULT '' NOT NULL, 
	amount  varchar(256)  DEFAULT '' NOT NULL, 
	bank  varchar(32)  DEFAULT '' NOT NULL, 
	treasurer  varchar(32)  DEFAULT '' NOT NULL, 
	confirmed_by  varchar(32)  DEFAULT '' NOT NULL, 
	description  text  , 
	created_by INT(11), 
	modified_by INT(11), 
	created_on INT(11) , 
	modified_on INT(11) 
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8; ");

              $this->db->query("
		CREATE TABLE IF NOT EXISTS members_tithe (
			id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
			member_id INT(11),
			tithe_id INT(11),
			type VARCHAR(256) DEFAULT '' NOT NULL,
			amount FLOAT NULL DEFAULT NULL,
			created_by INT(11) ,
			status INT(11) ,
			modified_by INT(11) ,
			created_on INT(11) ,
			modified_on INT(11)
		
		)ENGINE=InnoDB  DEFAULT CHARSET=utf8;");
         }

         function paginate_all($limit, $page)
         {
              $offset = $limit * ( $page - 1);

              $this->select_all_key('tithes');

              $this->db->order_by('id', 'desc');

              $query = $this->db->get('tithes', $limit, $offset);

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

              $this->db->where('status', 0);
              $this->db->order_by('id', 'desc');
              $query = $this->db->get('members_tithe', $limit, $offset);

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
    