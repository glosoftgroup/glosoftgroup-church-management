<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    class Admin extends Admin_Controller
    {

         function __construct()
         {
              parent::__construct();
              /* $this->template->set_layout('default');
                $this->template->set_partial('sidebar','partials/sidebar.php')
                -> set_partial('footer', 'partials/footer.php')-> set_partial('top', 'partials/top.php'); */
              if (!$this->ion_auth->logged_in())
              {
                   redirect('admin/login');
              }
              $this->load->model('seed_planting_m');
              $this->load->model('sms/sms_m');
              $this->load->library('sms_gateway');
         }

         /**
          * Module Index
          *
          */
         public function index()
         {
              $config = $this->set_paginate_options();  //Initialize the pagination class
              $this->pagination->initialize($config);
              $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 1;
              $data['seed_planting'] = $this->seed_planting_m->paginate_all($config['per_page'], $page);
              //create pagination links
              $data['links'] = $this->pagination->create_links();
              $data['updType'] = 'edit';
              //page number  variable
              $data['page'] = $page;
              $data['per'] = $config['per_page'];
              $data['banks'] = $this->seed_planting_m->get_banks();
              $data['users'] = $this->ion_auth->list_users();
              $data['members'] = $this->ion_auth->get_members();

              $data['todays'] = $this->seed_planting_m->todays()->total;
              $data['months'] = $this->seed_planting_m->months()->total;
              $data['years'] = $this->seed_planting_m->years()->total;
              //load view
              $this->template->title(' Seed Planting ')->build('admin/list', $data);
         }

         /**
          * Module Index
          *
          */
         public function voided()
         {
              $config = $this->set_paginate_options();  //Initialize the pagination class
              $this->pagination->initialize($config);
              $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 1;
              $data['seed_planting'] = $this->seed_planting_m->voided($config['per_page'], $page);
              //create pagination links
              $data['links'] = $this->pagination->create_links();
              //page number  variable
              $data['page'] = $page;
              $data['per'] = $config['per_page'];
              $data['banks'] = $this->seed_planting_m->get_banks();
              $data['users'] = $this->ion_auth->list_users();
              $data['members'] = $this->ion_auth->get_members();
              //load view
              $this->template->title(' Seed Planting ')->build('admin/voided', $data);
         }

         /**
          * Add New Seed Planting 
          *
          * @param $page
          */
         function create($page = NULL)
         {
              //create control variables
              $data['updType'] = 'create';
              $data['page'] = ( $this->uri->segment(4) ) ? $this->uri->segment(4) : $page;
              //Rules for validation
              $this->form_validation->set_rules($this->validation());
              //validate the fields of form
              if ($this->form_validation->run())
              {         //Validation OK!
                   $settings = $this->settings;
                   $initial = $settings->sms_initial;
                   $user = $this->ion_auth->get_user();
                   $form_data = array(
                           'date' => strtotime($this->input->post('date')),
                           //'member' => $this->input->post('member'), 
                           //'amount' => $this->input->post('amount'), 
                           'bank' => $this->input->post('bank'),
                           'treasurer' => $this->input->post('treasurer'),
                           'confirmed_by' => $this->input->post('confirmed_by'),
                           'description' => $this->input->post('description'),
                           'created_by' => $user->id,
                           'created_on' => time()
                   );
                   $ok = $this->seed_planting_m->create($form_data);
                   $this->sync->log_new('seed_planting', array($ok));
                   $length = $this->input->post('amount');
                   $size = count($length);

                   $totals = 0;
                   for ($i = 0; $i < $size; ++$i)
                   {
                        $member = $this->input->post('member');
                        $amount = $this->input->post('amount');
                        $type = $this->input->post('type');
                        $insert_tithe = array(
                                'tithe_id' => $ok,
                                'member_id' => $member[$i],
                                'amount' => $amount[$i],
                                'type' => $type[$i],
                                'status' => 1,
                                'created_by' => $user->id,
                                'created_on' => time()
                        );
                        //Insert Members Tithe
                        $dt = $this->seed_planting_m->insert_seed_planting($insert_tithe);
                        $this->sync->log_new('members_seed_planting', array($dt));
                        //Update Totals
                        $totals += (float) $amount[$i];
                        //*********************SMS Givers ***********************
                        $bal = $this->sms_m->get_counter_balance();
                        if (!$bal->balance == 0)
                        {
                             $member = $this->sms_m->get_member($member[$i]);
                             $gtype = refNo() . '/' . date('m/y', time());
                             $country_code = '254';
                             $ph = $member->phone1;
                             $fname = $member->first_name;
                             $cha = array('(', ')', '-', ' ');
                             $sp = array('', '', '');
                             $recipient = str_replace($cha, $sp, $ph);
                             $new_number = substr_replace($recipient, '+' . $country_code, 0, ($recipient[0] == '0'));
                             $message = $initial . ' ' . $fname . ', Confirmed your Seed of ' . number_format($amount[$i]) . ' has been received. May you be blessed';

                             $this->sms_gateway->sendMessage($new_number, $message, $from);
                             $form_data = array(
                                     'recipient' => $member->id,
                                     'status' => 1,
                                     'message' => $message,
                                     'sent_to' => 'church member',
                                     'group_type' => $gtype,
                                     'created_by' => $user->id,
                                     'created_on' => time()
                             );
                             $this->sms_m->create($form_data);
                             //Update SMS counter table
                             $tt = ($bal->balance - 1);
                             $sms = array(
                                     'balance' => $tt,
                                     'modified_by' => $user->id,
                                     'modified_on' => time());
                             $this->sms_m->update_counter($sms);
                        }
                   }
                   $update_totals = array(
                           'totals' => $totals,
                   );
                   $this->seed_planting_m->update_attributes($ok, $update_totals);
                   if ($ok) // the information has therefore been successfully saved in the db
                   {
                        $log = array(
                                'collection_id' => $ok,
                                'amount' => $totals,
                                'type' => 'seed_planting',
                                'created_by' => $user->id,
                                'created_on' => time());
                        $this->portal_m->collection_log($log);
                        //print_r($message.'/'.$new_number);die;
                        $this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Seed Planting ' . lang('web_create_success')));
                   }
                   else
                   {
                        $this->session->set_flashdata('error', array('type' => 'error', 'text' => 'Seed Planting ' . lang('web_create_failed')));
                   }
                   redirect('admin/seed_planting/');
              }
              else
              {
                   $get = new StdClass();
                   foreach ($this->validation() as $field)
                   {
                        $fn = $field['field'];
                        $get->$fn = set_value($fn);
                   }
                   $data['result'] = $get;
                   $data['banks'] = $this->seed_planting_m->get_banks();
                   $data['users'] = $this->ion_auth->list_users();
                   $data['members'] = $this->ion_auth->get_members();
                   //load the view and the layout
                   $this->template->title('Add Seed Planting ')->build('admin/create', $data);
              }
         }

         function view_members($id = FALSE, $page = 0)
         {
              if (!$id)
              {
                   $this->session->set_flashdata('error', array('type' => 'warning', 'text' => lang('web_object_not_exist')));
                   redirect('admin/seed_planting/');
              }
              if (!$this->seed_planting_m->exists($id))
              {
                   $this->session->set_flashdata('error', array('type' => 'warning', 'text' => lang('web_object_not_exist')));
                   redirect('admin/seed_planting');
              }
              $config = $this->set_paginate_options();  //Initialize the pagination class
              $this->pagination->initialize($config);
              $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 1;
              $data['seed_planting'] = $this->seed_planting_m->get_all();
              //create pagination links
              $data['links'] = $this->pagination->create_links();
              //page number  variable
              $data['page'] = $page;
              $data['per'] = $config['per_page'];
              $data['post'] = $this->seed_planting_m->find($id);
              //redirect if no $id
              $data['members_seed_planting'] = $this->seed_planting_m->get_seed_planting($id);
              $data['banks'] = $this->seed_planting_m->get_banks();
              $data['users'] = $this->ion_auth->list_users();
              $data['members'] = $this->ion_auth->get_members();
              //load the view and the layout
              $this->template->title('Seed Planting per Members ')->build('admin/view', $data);
         }

         /**
          * Edit  Seed Planting 
          *
          * @param $id
          * @param $page
          */
         function edit($id = FALSE, $page = 0)
         {
              //redirect if no $id
              if (!$id)
              {
                   $this->session->set_flashdata('error', array('type' => 'warning', 'text' => lang('web_object_not_exist')));
                   redirect('admin/seed_planting/');
              }
              if (!$this->seed_planting_m->exists($id))
              {
                   $this->session->set_flashdata('error', array('type' => 'warning', 'text' => lang('web_object_not_exist')));
                   redirect('admin/seed_planting');
              }
              //search the item to show in edit form
              $get = $this->seed_planting_m->find($id);

              //Rules for validation
              $this->form_validation->set_rules($this->validation());
              //create control variables
              $data['updType'] = 'edit';
              $data['page'] = $page;
              if ($this->form_validation->run())  //validation has been passed
              {
                   $user = $this->ion_auth->get_user();
                   // build array for the model
                   $form_data = array(
                           'date' => strtotime($this->input->post('date')),
                           'bank' => $this->input->post('bank'),
                           //'totals' => $this->input->post('totals'), 
                           'treasurer' => $this->input->post('treasurer'),
                           'confirmed_by' => $this->input->post('confirmed_by'),
                           'description' => $this->input->post('description'),
                           'modified_by' => $user->id,
                           'modified_on' => time());

                   //find the item to update
                   $done = $this->seed_planting_m->update_attributes($id, $form_data);
                   // the information has therefore been successfully saved in the db
                   if ($done)
                   {
                        $this->sync->log_update('seed_planting', $id, $form_data);
                        $this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Seed Planting ' . lang('web_edit_success')));
                        redirect("admin/seed_planting/");
                   }
                   else
                   {
                        $this->session->set_flashdata('error', array('type' => 'error', 'text' => $done->errors->full_messages()));
                        redirect("admin/seed_planting/");
                   }
              }
              else
              {
                   foreach (array_keys($this->validation()) as $field)
                   {
                        if (isset($_POST[$field]))
                        {
                             $get->$field = $this->form_validation->$field;
                        }
                   }
              }
              $data['result'] = $get;
              $data['banks'] = $this->seed_planting_m->get_banks();
              $data['users'] = $this->ion_auth->list_users();
              $data['members'] = $this->ion_auth->get_members();
              //load the view and the layout
              $this->template->title('Edit Seed Planting ')->build('admin/edit', $data);
         }

         function void($id)
         {
              //redirect if its not correct
              if (!$id)
              {
                   $this->session->set_flashdata('error', array('type' => 'warning', 'text' => lang('web_object_not_exist')));
                   redirect('admin/seed_planting');
              }
              //search the item to delete
              if (!$this->seed_planting_m->exists_mem_tithe($id))
              {
                   $this->session->set_flashdata('error', array('type' => 'warning', 'text' => lang('web_object_not_exist')));
                   redirect('admin/seed_planting');
              }
              $user = $this->ion_auth->get_user();
              // build array for the model
              $th = $this->seed_planting_m->get_single_tithe($id);
              $get = $this->seed_planting_m->find($th->tithe_id);
              $totals = ($get->totals) - ($th->amount);

              $update_totals = array(
                      'totals' => $totals,
                      'modified_by' => $user->id,
                      'modified_on' => time()
              );
              $this->seed_planting_m->update_attributes($th->tithe_id, $update_totals);
              $this->sync->log_update('seed_planting', $th->tithe_id, $update_totals);

              $form_data = array(
                      'status' => 0,
                      'modified_by' => $user->id,
                      'modified_on' => time());
              $done = $this->seed_planting_m->update_mem_seed_planting($id, $form_data);
              // the information has therefore been successfully saved in the db
              if ($done)
              {
                   $this->sync->log_update('members_seed_planting', $id, $form_data);
                   $this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Seed Planting ' . lang('web_edit_success')));
                   redirect("admin/seed_planting/view_members/" . $th->tithe_id);
              }
              else
              {
                   $this->session->set_flashdata('error', array('type' => 'error', 'text' => $done->errors->full_messages()));
                   redirect("admin/seed_planting/");
              }
         }

         function delete($id = NULL, $page = 1)
         {
              //filter & Sanitize $id
              $id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;
              //redirect if its not correct
              if (!$id)
              {
                   $this->session->set_flashdata('error', array('type' => 'warning', 'text' => lang('web_object_not_exist')));
                   redirect('admin/seed_planting');
              }
              //search the item to delete
              if (!$this->seed_planting_m->exists($id))
              {
                   $this->session->set_flashdata('error', array('type' => 'warning', 'text' => lang('web_object_not_exist')));
                   redirect('admin/seed_planting');
              }
              //delete the item
              if ($this->seed_planting_m->delete($id) == TRUE)
              {
                   $this->sync->log_delete('seed_planting', $id);
                   $this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Seed Planting ' . lang('web_delete_success')));
              }
              else
              {
                   $this->session->set_flashdata('error', array('type' => 'error', 'text' => lang('web_delete_failed')));
              }
              redirect("admin/seed_planting/");
         }

         /**
          * Generate Validation Rules
          *
          * @return array()
          */
         private function validation()
         {
              $config = array(
                      array(
                              'field' => 'date',
                              'label' => 'Date',
                              'rules' => 'required|xss_clean'),
                      array(
                              'field' => 'member',
                              'label' => 'Member',
                              'rules' => ''),
                      array(
                              'field' => 'amount',
                              'label' => 'Amount',
                              'rules' => ''),
                      array(
                              'field' => 'type',
                              'label' => 'Type',
                              'rules' => ''),
                      array(
                              'field' => 'bank',
                              'label' => 'Bank',
                              'rules' => 'xss_clean'),
                      array(
                              'field' => 'treasurer',
                              'label' => 'Treasurer',
                              'rules' => 'required|xss_clean'),
                      array(
                              'field' => 'confirmed_by',
                              'label' => 'Confirmed By',
                              'rules' => 'required|xss_clean'),
                      array(
                              'field' => 'description',
                              'label' => 'Description',
                              'rules' => 'trim|xss_clean|min_length[0]|max_length[500]'),
              );
              $this->form_validation->set_error_delimiters("<br /><span class='error'>", '</span>');
              return $config;
         }

         /**
          * Generate Pagination Config
          *
          * @return array()
          */
         private function set_paginate_options()
         {
              $config = array();
              $config['base_url'] = site_url() . 'admin/seed_planting/index/';
              $config['use_page_numbers'] = TRUE;
              $config['per_page'] = 10;
              $config['total_rows'] = $this->seed_planting_m->count();
              $config['uri_segment'] = 4;
              $config['first_link'] = lang('web_first');
              $config['first_tag_open'] = "<li>";
              $config['first_tag_close'] = '</li>';
              $config['last_link'] = lang('web_last');
              $config['last_tag_open'] = "<li>";
              $config['last_tag_close'] = '</li>';
              $config['next_link'] = FALSE;
              $config['next_tag_open'] = "<li>";
              $config['next_tag_close'] = '</li>';
              $config['prev_link'] = FALSE;
              $config['prev_tag_open'] = "<li>";
              $config['prev_tag_close'] = '</li>';
              $config['cur_tag_open'] = '<li class="active">  <a href="#">';
              $config['cur_tag_close'] = '</a></li>';
              $config['num_tag_open'] = "<li>";
              $config['num_tag_close'] = '</li>';
              $config['full_tag_open'] = '<ul class="pagination pagination-centered">';
              $config['full_tag_close'] = '</ul>';
              //$choice = $config["total_rows"] / $config["per_page"];
              //$config["num_links"] = round($choice);
              return $config;
         }

    }
    