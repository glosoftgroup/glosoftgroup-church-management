<?php

    class Emails_m extends MY_Model
    {

         function __construct()
         {
              // Call the Model constructor
              parent::__construct();
              $this->db_set();
         }

         /**
          * Setup DB Table Automatically
          * 
          */
         function db_set()
         {
              $this->db->query(" 
	CREATE TABLE IF NOT EXISTS  emails (
	id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
	`subject` BLOB ,
	`sent_to` BLOB,
	`cc` BLOB,
	`description` BLOB,
	`attachment` BLOB,
	`type` BLOB,
	`status` BLOB,
	`created_by` BLOB,
	`modified_by` BLOB,
	`created_on` BLOB,
	`modified_on` BLOB
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8; ");

              $this->db->query(" 
	CREATE TABLE IF NOT EXISTS  email_templates (
	id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
	`title` VARCHAR(250) NULL DEFAULT NULL,
	`slug` VARCHAR(250) NULL DEFAULT NULL,
	`description` TEXT NULL,
	`content` TEXT NULL,
	`status` ENUM('draft','live') NOT NULL DEFAULT 'draft' COLLATE 'utf8_unicode_ci',
	`created_by` INT(11) NULL DEFAULT NULL,
	`created_on` INT(11) NULL DEFAULT NULL,
	`modified_on` INT(11) NULL DEFAULT NULL,
	`modified_by` INT(11) NULL DEFAULT NULL
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8; ");

              $this->db->query(" 
	CREATE TABLE IF NOT EXISTS  email_templates (
	id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
	`members_id` VARCHAR(256) NOT NULL DEFAULT '',
	`email_id` TEXT NULL,
	`created_by` INT(11) NULL DEFAULT NULL,
	`modified_by` INT(11) NULL DEFAULT NULL,
	`created_on` INT(11) NULL DEFAULT NULL,
	`modified_on` INT(11) NULL DEFAULT NULL
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8; ");
         }

         function create($data)
         {
              $this->insert_key_data('emails', $data);
              return $this->db->insert_id();
         }

         function insert_member($data)
         {
              $this->db->insert('email_recipients', $data);
              return $this->db->insert_id();
         }

// Get applicant Email address	



         function find($id)
         {
              $this->select_all_key('emails');
              $query = $this->db->get_where('emails', array('id' => $id));
              return $query->row();
         }

         function exists($id)
         {
              $query = $this->db->get_where('emails', array('id' => $id));
              $result = $query->result();

              if ($result)
                   return TRUE;
              else
                   return FALSE;
         }

         function count()
         {

              return $this->db->count_all_results('emails');
         }

         function update_attributes($id, $data)
         {
              return $this->update_key_data($id, 'emails', $data);
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
              $query = $this->db->delete('emails', array('id' => $id));

              return $query;
         }

         function paginate_all($limit, $page)
         {
              $offset = $limit * ( $page - 1);

              $this->select_all_key('emails');

              $this->db->order_by('id', 'desc');
              $query = $this->db->get('emails', $limit, $offset);

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
    