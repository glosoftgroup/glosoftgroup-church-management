<?php

    class Log_m extends MY_Model
    {

         function __construct()
         {
              // Call the Model constructor
              parent::__construct();
         }

         /**
          * Log Changes
          * 
          * @param type $data
          * @return type
          */
         function put_log($data)
         {
              return $this->insert_key_data('new_log', $data);
         }

         /**
          * Fetch Sync Targets
          * 
          */
         function fetch_sync()
         {
              $this->select_all_key('new_log');
              return $this->db->where($this->dx('sent') . '=0', NULL, FALSE)->get('new_log')->result();
         }

         /**
          * Fetch Row by ID
          * @param type $table
          * @param type $id
          * @param boolean $enc Whether we need to decrypt contents
          * @return type
          */
         function fetch_rec($table, $id, $enc = FALSE)
         {
              if ($enc)
              {
                   $this->select_all_key($table);
              }
              $eres = $this->db->where('id', $id)->get($table)->row();
              unset($eres->id);

              return $eres;
         }

         /**
          * Mark Rows as sent
          * 
          * @param array $ids
          */
         function set_sent($ids)
         {
              foreach ($ids as $id)
              {
                   $this->update_key_data($id, 'new_log', array('sent' => 1));
              }
         }

    }
    