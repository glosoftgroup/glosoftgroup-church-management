<?php

    class Thanks_giving_m extends MY_Model
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
              return $this->db->select("sum(" . $this->dx('totals') . ") as total", FALSE)->where("DATE_FORMAT(FROM_UNIXTIME(" . $this->dx('date') . "),'%d')=" . date('d'), NULL, FALSE)->get('thanks_giving')->row();
         }

         //This count Purchases
         function months()
         {
              return $this->db->select('sum(' . $this->dx('totals') . ') as total', FALSE)->where("DATE_FORMAT(FROM_UNIXTIME(" . $this->dx('date') . "),'%m')=" . date('m'), NULL, FALSE)->get('thanks_giving')->row();
         }

         //This count Purchases
         function years()
         {
              return $this->db->select('sum(' . $this->dx('totals') . ') as total', FALSE)->where("DATE_FORMAT(FROM_UNIXTIME(" . $this->dx('date') . "),'%Y')=" . date('Y'), NULL, FALSE)->get('thanks_giving')->row();
         }

         //This count Purchases
         function total_collection()
         {
              return $this->db->select('sum(' . $this->dx('totals') . ') as total', FALSE)->get('thanks_giving')->row();
         }

         function create($data)
         {
              $this->insert_key_data('thanks_giving', $data);
              return $this->db->insert_id();
         }

         function insert_thanks_giving($data)
         {
              $this->db->insert('members_thanks_giving', $data);
              return $this->db->insert_id();
         }

         function get_all()
         {
              $this->select_all_key('thanks_giving');
              return $this->db->get('thanks_giving')->result();
         }

         function find($id)
         {
              $this->select_all_key('thanks_giving');
              return $this->db->where(array('id' => $id))->get('thanks_giving')->row();
         }

         function get_member_giving($id)
         {
              return $this->db->where(array('id' => $id))->get('members_thanks_giving')->row();
         }

         function get_thanks_giving($id)
         {
              return $this->db->where(array('tithe_id' => $id, 'status' => 1))->get('members_thanks_giving')->result();
         }

         function get_single_tithe($id)
         {
              return $this->db->where(array('id' => $id, 'status' => 1))->get('members_thanks_giving')->row();
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
              return $this->db->where(array('id' => $id))->count_all_results('thanks_giving') > 0;
         }

         function exists_mem_tithe($id)
         {
              return $this->db->where(array('id' => $id))->count_all_results('members_thanks_giving') > 0;
         }

         function count()
         {

              return $this->db->count_all_results('thanks_giving');
         }

         function update_attributes($id, $data)
         {
              return $this->update_key_data($id, 'thanks_giving', $data);
         }

         function update_mem_thanks_giving($id, $data)
         {

              return $this->db->where('id', $id)->update('members_thanks_giving', $data);
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
              return $this->db->delete('thanks_giving', array('id' => $id));
         }

         /**
          * Setup DB Table Automatically
          * 
          */
         function db_set()
         {
              $this->db->query(" 
	CREATE TABLE IF NOT EXISTS  thanks_giving (
	id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
	date  INT(11), 
	totals  FlOAT, 
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
		CREATE TABLE IF NOT EXISTS members_thanks_giving (
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
              $this->select_all_key('thanks_giving');
              $this->db->order_by('id', 'desc');
              $query = $this->db->get('thanks_giving', $limit, $offset);

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
              $query = $this->db->get('members_thanks_giving', $limit, $offset);

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
    