<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    class Sync
    {

         private $ci;

         public function __construct()
         {
              $this->ci = & get_instance();
              $this->ci->load->model('log_m');
              $this->ci->load->library('ion_auth');
              $this->user = $this->ci->ion_auth->get_user();
              
              
         }

         /**
          * Log Newly added IDS
          * 
          * @param string $table
          * @param array $ids
          */
         function log_new($table, $ids)
         {
              foreach ($ids as $id)
              {
                   $new = array(
                           'sn_table' => $table,
                           'row_id' => $id,
                           'sent' => 0,
                           'flag' => 1,
                           'created_by' => $this->ci->user->id,
                           'created_on' => time()
                   );
                   $this->ci->log_m->put_log($new);
              }
         }

         /**
          * Update Table Column add the specified Value
          *  
          * @param string $table
          * @param int $id
          * @param array $data
          * @param boolean $increment Whether the Update will Increment Existing Value rather than Replace
          * @param boolean $add Whether the Update will Increment or decrement Existing Value 
          */
         function log_update($table, $id, $data, $increment = FALSE, $add = TRUE)
         {
              foreach ($data as $key => $value)
              {
                   $log = array(
                           'sn_table' => $table,
                           'row_id' => $id,
                           'col' => $key,
                           'val' => $value,
                           'sent' => 0,
                           'flag' => $increment ? 3 : 2,
                           'created_by' => $this->user->id,
                           'created_on' => time()
                   );
                   $this->ci->log_m->put_log($log);
              }
         }

         /**
          * Log Deleted Record
          * 
          * @param type $table
          * @param type $id
          */
         function log_delete($table, $id, $col = FALSE)
         {
              $new = array(
                      'sn_table' => $table,
                      'row_id' => $id,
                      'sent' => 0,
                      'flag' => 4,
                      'col' => $col,
                      'created_by' => $this->user->id,
                      'created_on' => time()
              );
              $this->ci->log_m->put_log($new);
         }

    }
    