<?php

    class Expenses_m extends MY_Model
    {

         function __construct()
         {
              // Call the Model constructor
              parent::__construct();
              $this->db_set();
         }

         function create($data)
         {
              $this->db->insert('expenses', $data);
              return $this->db->insert_id();
         }

         function find($id)
         {
              return $this->db->where(array('id' => $id))->get('expenses')->row();
         }

         //This count Purchases
         function todays()
         {
              return $this->db->select('sum(amount) as total')->where("DATE_FORMAT(FROM_UNIXTIME(date),'%d')", date('d'))->where('status', 1)->get('expenses')->row();
         }

         //This count Purchases
         function months()
         {
              return $this->db->select('sum(amount) as total')->where("DATE_FORMAT(FROM_UNIXTIME(date),'%m-%Y')", date('m-Y'))->where('status', 1)->get('expenses')->row();
         }

         //This count Purchases
         function years()
         {
              return $this->db->select('sum(amount) as total')->where("DATE_FORMAT(FROM_UNIXTIME(date),'%Y')", date('Y'))->where('status', 1)->get('expenses')->row();
         }

         function exists($id)
         {
              return $this->db->where(array('id' => $id))->count_all_results('expenses') > 0;
         }

         function count()
         {

              return $this->db->count_all_results('expenses');
         }

         function update_attributes($id, $data)
         {
              return $this->db->where('id', $id)->update('expenses', $data);
         }

         function populate($table, $option_val, $option_text)
         {
              $query = $this->db->select('*')->order_by('id', 'DESC')->get($table);
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
              return $this->db->delete('expenses', array('id' => $id));
         }

         /**
          * Setup DB Table Automatically
          * 
          */
         function db_set()
         {
              $this->db->query(" 
	CREATE TABLE IF NOT EXISTS  expenses (
	id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
	date  INT(11), 
	status  INT(11), 
	item  varchar(32)  DEFAULT '' NOT NULL, 
	category  varchar(32)  DEFAULT '' NOT NULL, 
	amount  varchar(256)  DEFAULT '' NOT NULL, 
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
              $query = $this->db->get('expenses', $limit, $offset);

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

//By Item View
         function by_item($limit, $page, $id)
         {
              $offset = $limit * ( $page - 1);

              $this->db->where('item', $id);
              $this->db->order_by('id', 'desc');
              $query = $this->db->get('expenses');

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

         function by_category($limit, $page, $id)
         {
              $offset = $limit * ( $page - 1);

              $this->db->where('category', $id);
              $this->db->order_by('id', 'desc');
              $query = $this->db->get('expenses');

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
    