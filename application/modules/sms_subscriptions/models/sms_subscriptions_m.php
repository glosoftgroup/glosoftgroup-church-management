<?php

    class Sms_subscriptions_m extends MY_Model
    {

         function __construct()
         {
              // Call the Model constructor
              parent::__construct();
              $this->db_set();
         }

         function create($data)
         {
              $this->db->insert('sms_subscriptions', $data);
              return $this->db->insert_id();
         }

         function find($id)
         {
              return $this->db->where(array('id' => $id))->get('sms_subscriptions')->row();
         }

         function exists($id)
         {
              return $this->db->where(array('id' => $id))->count_all_results('sms_subscriptions') > 0;
         }

         function exists_mem($mem)
         {
              return $this->db->where(array('member' => $mem))->count_all_results('sms_subscriptions') > 0;
         }

         function count()
         {

              return $this->db->count_all_results('sms_subscriptions');
         }

         function update_attributes($id, $data)
         {
              return $this->db->where('id', $id)->update('sms_subscriptions', $data);
         }

         function update_member($id, $data)
         {
              return $this->db->where('member', $id)->update('sms_subscriptions', $data);
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
              return $this->db->delete('sms_subscriptions', array('id' => $id));
         }

         /**
          * Setup DB Table Automatically
          * 
          */
         function db_set()
         {
              $this->db->query(" 
	CREATE TABLE IF NOT EXISTS  sms_subscriptions (
	id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
	member  varchar(32)  DEFAULT '' NOT NULL, 
	bible_quotes  varchar(32)  DEFAULT '' NOT NULL, 
	daily_inspirations  varchar(32)  DEFAULT '' NOT NULL, 
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

              $this->db->order_by('id', 'desc');
              $query = $this->db->get('sms_subscriptions', $limit, $offset);

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
    