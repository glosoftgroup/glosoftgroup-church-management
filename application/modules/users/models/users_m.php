<?php

    class Users_m extends MY_Model
    {

         function __construct()
         {
              // Call the Model constructor
              parent::__construct();
         }

         function create($data)
         {
              $this->db->insert('users', $data);
              return $this->db->insert_id();
         }

         function find($id)
         {
              $query = $this->db->get_where('users', array('id' => $id));
              return $query->row();
         }

         function my_tasks()
         {

              return $this->db->get('task_manager')->result();
         }

         function count_tasks()
         {

              return $this->db->count_all_results('task_manager');
         }

         function exists($id)
         {
              $query = $this->db->get_where('users', array('id' => $id));
              $result = $query->result();

              if ($result)
                   return TRUE;
              else
                   return FALSE;
         }

         function count()
         {
              return $this->db->count_all_results('users');
         }

         function update_attributes($id, $data)
         {
              $this->db->where('id', $id);
              $query = $this->db->update('users', $data);

              return $query;
         }

         function populate($table, $option_val, $option_text)
         {
              $dropdowns = $this->db->select('*')
                                        ->order_by($option_text)
                                        ->get($table)->result();

              foreach ($dropdowns as $dropdown)
              {
                   $options[$dropdown->$option_val] = $dropdown->$option_text;
              }
              return $options;
         }

         function delete($id)
         {
              if ($id < 10)
              {
                   return FALSE;
              }
              $query = $this->db->delete('users', array('id' => $id));
              return $query;
         }

         function search_list($keyword)
         {
              $this->db->limit(10, 0);

              $this->db->_protect_identifiers = FALSE;
              $this->db->order_by($this->dx('users.first_name'), 'ASC', FALSE);
              $this->db->order_by($this->dx('users.last_name'), 'ASC', FALSE);
              $this->db->_protect_identifiers = TRUE;

              if (isset($keyword) && !empty($keyword))
              {
                   $sSearch = trim($this->db->escape_like_str($keyword));
                   $this->db->or_like('CONVERT(' . $this->dx('users.first_name') . " USING 'latin1') ", $sSearch, 'both', FALSE);
                   $this->db->or_like('CONVERT(' . $this->dx('users.last_name') . " USING 'latin1') ", $sSearch, 'both', FALSE);
                   $this->db->or_like('CONVERT(CONCAT(' . $this->dx('users.first_name') . '," ",' . $this->dx('users.last_name') . ')' . " USING 'latin1') ", $sSearch, 'both', FALSE);
              }

              // Select Data
              $this->db->select(' SQL_CALC_FOUND_ROWS now()', FALSE);
              $this->select_all_key('users');
              $this->db->select('id,' . $this->dxa('first_name') . ' , ' . $this->dxa('last_name') . ' ,' . $this->dxa('email') . ' ,' . $this->dxa('bio'), FALSE);
              $this->db->where($this->dx('active') . ' = 1', NULL, FALSE);
              $rResult = $this->db->get('users')->result();

              return $rResult;
         }

         /**
          * Connect Two Users
          * 
          * @param type $from
          * @param type $to
          */
         function make_connection($from, $to)
         {
              if (!$this->connection_exists($from, $to))
              {
                   $conn = array(
                           'from_user' => $from,
                           'to_user' => $to,
                           'confirmed' => 0,
                           'created_by' => 1,
                           'created_on' => time(),
                   );
                   $this->db->insert('connections', $conn);
                   $ok = $this->db->insert_id();
                   if ($ok)
                   {
                        //send Notification
                        $nof = array(
                                'from_user' => $from,
                                'to_user' => $to,
                                'seen' => 0,
                                'ref' => $ok,
                                'title' => 'Sent You a Connection Request',
                                'created_by' => 1,
                                'created_on' => time(),
                        );
                        $this->db->insert('notifications', $nof);
                        return $this->db->insert_id();
                   }
              }
              return FALSE;
         }

         /**
          * Check if Already Connected
          * 
          * @param type $from
          * @param type $to
          * @return type
          */
         function connection_exists($from, $to)
         {
              return $this->db->where('from_user', $from)
                                        ->where('to_user', $to)
                                        ->count_all_results('connections') > 0;
         }

         public function get_notes($user = 0, $limit = 15)
         {
              $user = (empty($user)) ? $this->ion_auth->get_user()->id : $user;
              return $this->db->where('to_user', $user)
                                        ->order_by('id', 'desc')
                                        ->limit($limit)
                                        ->get('notifications')
                                        ->result();
         }

         function paginate_all($limit, $page)
         {
              $offset = $limit * ( $page - 1);
              $this->select_all_key('users');
              $this->db->order_by('id', 'desc');
              $query = $this->db->get('users', $limit, $offset);

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
    