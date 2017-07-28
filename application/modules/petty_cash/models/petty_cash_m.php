<?php

    class Petty_cash_m extends MY_Model
    {

         function __construct()
         {
              // Call the Model constructor
              parent::__construct();
              $this->db_set();
         }

         function create($data)
         {
              $this->db->insert('petty_cash', $data);
              return $this->db->insert_id();
         }

         //This count Purchases
         function todays()
         {
              return $this->db->select('sum(amount) as total')->where("DATE_FORMAT(FROM_UNIXTIME(date),'%d')", date('d'))->where('status', 1)->get('petty_cash')->row();
         }

         //This count Purchases
         function months()
         {
              return $this->db->select('sum(amount) as total')->where("DATE_FORMAT(FROM_UNIXTIME(date),'%m-%Y')", date('m-Y'))->where('status', 1)->get('petty_cash')->row();
         }

         //This count Purchases
         function years()
         {
              return $this->db->select('sum(amount) as total')->where("DATE_FORMAT(FROM_UNIXTIME(date),'%Y')", date('Y'))->where('status', 1)->get('petty_cash')->row();
         }

         function find($id)
         {
              return $this->db->where(array('id' => $id))->get('petty_cash')->row();
         }

         function last_id()
         {
              return $this->db->order_by('id', 'DESC')->limit(1)->get('petty_cash')->row();
         }

         function exists($id)
         {
              return $this->db->where(array('id' => $id))->count_all_results('petty_cash') > 0;
         }

         function count()
         {

              return $this->db->count_all_results('petty_cash');
         }

         function update_attributes($id, $data)
         {
              return $this->db->where('id', $id)->update('petty_cash', $data);
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
              return $this->db->delete('petty_cash', array('id' => $id));
         }

         /**
          * Setup DB Table Automatically
          * 
          */
         function db_set()
         {
              $this->db->query(" 
	CREATE TABLE IF NOT EXISTS  petty_cash (
	id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
	date  INT(11), 
	item  INT(11), 
	status  INT(11), 
	voucher_number  varchar(256)  DEFAULT '' NOT NULL, 
	amount  varchar(256)  DEFAULT '' NOT NULL, 
	authorised_by  varchar(32)  DEFAULT '' NOT NULL, 
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
              $query = $this->db->get('petty_cash', $limit, $offset);

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

         function by_item($limit, $page, $id)
         {


              $offset = $limit * ( $page - 1);
              $this->db->where('item', $id);
              $this->db->order_by('id', 'desc');

              $query = $this->db->get('petty_cash');
              //print_r($id);die;
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
    