<?php

    class Settings_m extends MY_Model
    {

         function __construct()
         {
              // Call the Model constructor
              parent::__construct();
              $this->db_set();
         }

         function create($data)
         {
              $this->db->insert('settings', $data);
              return $this->db->insert_id();
         }

         function find($id)
         {
              return $this->db->where(array('id' => $id))->get('settings')->row();
         }

         function exists($id)
         {
              return $this->db->where(array('id' => $id))->count_all_results('settings') > 0;
         }

         function count()
         {
              return $this->db->count_all_results('settings');
         }

         /**
          * Run SQL 
          * 
          * @param string $str
          * @return int
          */
         function execute($str)
         {
              return $this->db->query($str);
         }

         /**
          * Check if File has been Processed by CRON
          * 
          * @param string $file
          * @return boolean TRUE if file does not exist
          */
         function not_processed($file)
         {
              return $this->db->where($this->dx('filename') . "='" . $file . "'", NULL, FALSE)->count_all_results('processed_files') < 1;
         }

         /**
          * Log Data
          * @param array $data
          * @return boolean
          */
         function log_processed_file($data)
         {
              return $this->insert_key_data('processed_files', $data);
         }

         function update_attributes($id, $data)
         {
              return $this->db->where('id', $id)->update('settings', $data);
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
              return $this->db->delete('settings', array('id' => $id));
         }

         /**
          * Setup DB Table Automatically
          * 
          */
         function db_set()
         {
              $this->db->query(" 
	CREATE TABLE IF NOT EXISTS  settings (
	id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
	date  INT(11), 
	name  varchar(256)  DEFAULT '' NOT NULL, 
	address  text  , 
	county  varchar(256)  DEFAULT '' NOT NULL, 
	town  varchar(256)  DEFAULT '' NOT NULL, 
	phone  varchar(256)  DEFAULT '' NOT NULL, 
	other_phones  varchar(256)  DEFAULT '' NOT NULL, 
	email  varchar(256)  DEFAULT '' NOT NULL, 
	sender_id  varchar(256)  DEFAULT '' NOT NULL, 
	sms_initial  varchar(256)  DEFAULT '' NOT NULL, 
	member_code_initial  varchar(256)  DEFAULT '' NOT NULL, 
	file  varchar(256)  DEFAULT '' NOT NULL, 
	created_by INT(11), 
	modified_by INT(11), 
	created_on INT(11) , 
	modified_on INT(11) 
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8; ");

              $check = $this->get_all();

              if (empty($check))
              {

                   $this->db->query("
		INSERT INTO `settings` (`id`, `date`, `name`, `address`, `county`, `town`, `phone`, `other_phones`, `email`, `sms_initial`, `member_code_initial`, `file`, `created_by`, `modified_by`, `created_on`, `modified_on`) VALUES
		(1, 1325624400, 'Smart Church', 'Box 12548', 'Nairobi', 'Umoja', '(072) 134-1214', '0205285243/07213584587', 'info@smartchurch.com', 'Hello', 'SC', 'logo3.png', 1, NULL, 1422976879, NULL) ");
              }
         }

         function get_all()
         {

              return $this->db->get('settings')->result();
         }

         function paginate_all($limit, $page)
         {
              $offset = $limit * ( $page - 1);

              $this->db->order_by('id', 'desc');
              $query = $this->db->get('settings', $limit, $offset);

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
    