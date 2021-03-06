<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    class Email_templates_m extends MY_Model
    {

         protected $_table = 'email_templates';

         function __construct()
         {
              $this->load->dbforge();
              $this->install();
         }

         function install()
         {
              $this->db->query("
		create table if not exists email_templates(
id int not null auto_increment primary key,
					`title` varchar(250),
										`slug` varchar(250),
										`description` text,
										`content` text,
					
`status` enum('draft','live') collate utf8_unicode_ci NOT NULL default 'draft',
created_by int,
created_on int,
modified_on int,
modified_by int
)
		");
         }

         function uninstall()
         {
              if ($this->dbforge->drop_table('email_templates'))
              {
                   return TRUE;
              }
              else
              {
                   return FALSE;
              }
         }

         function template($slug, $fields)
         {
              $data = '';
              $this->db->where(array('slug' => $slug));
              $d = $this->db->get('email_templates')->row();
              if ($d)
              {
                   $data = $d->content;
              }


              foreach ($fields as $k => $v)
              {

                   $data = preg_replace('/\[' . $k . '\]/', $v, $data);
              }
              return $data;
         }

         function get_all()
         {
              $this->db->order_by('created_on', 'DESC');
              return $this->db->get('email_templates')->result();
         }

         function get($id)
         {
              $this->db->where(array('id' => $id));
              return $this->db->get('email_templates')->row();
         }

         function get_by_slug($slug)
         {
              $this->db->where(array('slug' => $slug));
              return $this->db->get('email_templates')->row();
         }

         function get_many_by($params = array())
         {
              // Is a status set?
              if (!empty($params['status']))
              {
                   // If it's all, then show whatever the status
                   if ($params['status'] != 'all')
                   {
                        // Otherwise, show only the specific status
                        $this->db->where('status', $params['status']);
                   }
              }

              // Nothing mentioned, show live only (general frontend stuff)
              else
              {
                   $this->db->where('status', 'live');
              }

              // By default, dont show future email_templates
              if (!isset($params['show_future']) || (isset($params['show_future']) && $params['show_future'] == FALSE))
              {
                   $this->db->where('created_on <=', time());
              }

              // Limit the results based on 1 number or 2 (2nd is offset)
              //echo print_r($params); die;
              if (isset($params['limit']) && is_array($params['limit']))
                   $this->db->limit($params['limit'][0], $params['limit'][1]);
              elseif (isset($params['limit']))
                   $this->db->limit($params['limit']);

              return $this->get_all();
         }

         function count_by($params = array())
         {
              // Is a status set?
              if (!empty($params['status']))
              {
                   // If it's all, then show whatever the status
                   if ($params['status'] != 'all')
                   {
                        // Otherwise, show only the specific status
                        $this->db->where('status', $params['status']);
                   }
              }

              // Nothing mentioned, show live only (general frontend stuff)
              else
              {
                   $this->db->where('status', 'live');
              }

              return $this->db->count_all_results('email_templates');
         }

         function update($id, $input)
         {

              return parent::update($id, $input);
         }

         function publish($id = 0)
         {
              return parent::update($id, array('status' => 'live'));
         }

         function check_exists($field, $value = '', $id = 0)
         {
              if (is_array($field))
              {
                   $params = $field;
                   $id = $value;
              }
              else
              {
                   $params[$field] = $value;
              }
              $params['id !='] = (int) $id;

              return parent::count_by($params) == 0;
         }

    }
    