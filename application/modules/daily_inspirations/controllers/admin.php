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
              $this->load->model('daily_inspiration_m');
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

              $data['daily_inspirations'] = $this->daily_inspiration_m->paginate_all($config['per_page'], $page);

              //create pagination links
              $data['links'] = $this->pagination->create_links();
              $data['updType'] = 'edit';

              //page number  variable
              $data['page'] = $page;
              $data['per'] = $config['per_page'];

              //load view
              $data['leader'] = $this->daily_inspiration_m->get_users();
              $this->template->title(' Daily Inspirations ')->build('admin/list', $data);
         }

         /**
          * Add New Daily Inspirations 
          *
          * @param $page
          */
         function create($page = NULL)
         {
              //create control variables
              $data['updType'] = 'create';
              $form_data_aux = array();
              $data['page'] = ( $this->uri->segment(4) ) ? $this->uri->segment(4) : $page;

              //Rules for validation
              $this->form_validation->set_rules($this->validation());

              //validate the fields of form
              if ($this->form_validation->run())
              {         //Validation OK!
                   $user = $this->ion_auth->get_user();
                   $form_data = array(
                           'title' => $this->input->post('title'),
                           'message' => $this->input->post('message'),
                           'status' => $this->input->post('status'),
                           'created_by' => $user->id,
                           'created_on' => time()
                   );

                   $ok = $this->daily_inspiration_m->create($form_data);

                   if ($ok) // the information has therefore been successfully saved in the db
                   {
                        $this->sync->log_new('daily_inspirations', array($ok));
                        //SMS Counter balance
                        $bal = $this->sms_m->get_counter_balance();

                        if ($this->input->post('status') == 1)
                        {
                             $bq_subscribers = $this->daily_inspiration_m->get_di_subsribers();
                             $mem_counter = count($bq_subscribers);

                             if ($messge_lenght < 160)
                             {
                                  $total_ded = $mem_counter;
                             }
                             elseif ($messge_lenght > 160)
                             {
                                  $total_ded = ($mem_counter * 2);
                             }
                             elseif ($messge_lenght > 320)
                             {
                                  $total_ded = ($mem_counter * 3);
                             }
                             elseif ($messge_lenght > 480)
                             {
                                  $total_ded = ($mem_counter * 4);
                             }

                             if ($total_ded > $bal->balance)
                             {
                                  $this->session->set_flashdata('error', array('type' => 'error', 'text' => 'Sorry your sms account is zero (0). Kindly purchase more SMSs to be able to send to subscribers <span style="color:#000"> [ Call 020 524 5283 / 0721341214 or Email sales@mshamba.net ]</span>'));
                                  redirect('admin/sms');
                             }
                             else
                             {
                                  $gtype = refNo() . '/' . date('m/y', time());
                                  $country_code = '254';

                                  foreach ($bq_subscribers as $am)
                                  {
                                       $member = $this->sms_m->get_member($am->member);
                                       $form_data = array(
                                               'recipient' => $member->id,
                                               'status' => 1,
                                               'message' => $this->input->post('message'),
                                               'sent_to' => 'church member',
                                               'group_type' => $gtype,
                                               'created_by' => $user->id,
                                               'created_on' => time()
                                       );

                                       $ok = $this->sms_m->create($form_data);

                                       $ph = $member->phone1;
                                       $cha = array('(', ')', '-', ' ');
                                       $sp = array('', '', '');
                                       $recipient = str_replace($cha, $sp, $ph);

                                       //$new_number = substr_replace($recipient, '+'.$country_code, 0, ($recipient[0] == '0'));
                                       $message = $this->input->post('message');
                                       $settings = $this->portal_m->fetch_settings();
                                       $from = $settings->sender_id;

                                       $this->sms_m->send_sms($recipient, $message);
                                       //$this->sms_gateway->sendMessage($new_number, $message,$from);
                                  }

                                  //Update SMS counter table

                                  $tt = ($bal->balance - $total_ded);
                                  $form_data = array(
                                          'balance' => $tt,
                                          'modified_by' => $user->id,
                                          'modified_on' => time());

                                  $this->sms_m->update_counter($form_data);
                             }
                        }




                        $this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Daily Inspirations ' . lang('web_create_success')));
                   }
                   else
                   {
                        $this->session->set_flashdata('error', array('type' => 'error', 'text' => 'Daily Inspirations ' . lang('web_create_failed')));
                   }

                   redirect('admin/daily_inspirations/');
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
                   $data['leader'] = $this->daily_inspiration_m->get_users();
                   //$users = $this->daily_inspiration_m->get_users();
                   //$data['users']=$users;
                   //load the view and the layout
                   $this->template->title('Add Daily Inspirations ')->build('admin/create', $data);
              }
         }

         /**
          * Edit  Daily Inspirations 
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
                   redirect('admin/daily_inspirations/');
              }
              if (!$this->daily_inspiration_m->exists($id))
              {
                   $this->session->set_flashdata('error', array('type' => 'warning', 'text' => lang('web_object_not_exist')));
                   redirect('admin/daily_inspirations');
              }
              //search the item to show in edit form
              $get = $this->daily_inspiration_m->find($id);
              
              $form_data_aux = array();
              $files_to_delete = array();
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
                           'title' => $this->input->post('title'),
                           'message' => $this->input->post('message'),
                           'status' => $this->input->post('status'),
                           'modified_by' => $user->id,
                           'modified_on' => time());

                   //add the aux form data to the form data array to save
                   $form_data = array_merge($form_data_aux, $form_data);

                   //find the item to update

                   $done = $this->daily_inspiration_m->update_attributes($id, $form_data);

                   // the information has therefore been successfully saved in the db
                   if ($done)
                   {
                        $this->sync->log_update('daily_inspirations', $id, $form_data);
                        $this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Daily Inspirations ' . lang('web_edit_success')));
                        redirect("admin/daily_inspirations/");
                   }
                   else
                   {
                        $this->session->set_flashdata('error', array('type' => 'error', 'text' => $done->errors->full_messages()));
                        redirect("admin/daily_inspirations/");
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
              $data['leader'] = $this->daily_inspiration_m->get_users();
              //load the view and the layout
              $this->template->title('Edit Daily Inspirations ')->build('admin/create', $data);
         }

         function delete($id = NULL, $page = 1)
         {
              //filter & Sanitize $id
              $id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;

              //redirect if its not correct
              if (!$id)
              {
                   $this->session->set_flashdata('error', array('type' => 'warning', 'text' => lang('web_object_not_exist')));

                   redirect('admin/daily_inspirations');
              }

              //search the item to delete
              if (!$this->daily_inspiration_m->exists($id))
              {
                   $this->session->set_flashdata('error', array('type' => 'warning', 'text' => lang('web_object_not_exist')));

                   redirect('admin/daily_inspirations');
              }

              //delete the item
              if ($this->daily_inspiration_m->delete($id) == TRUE)
              {
                   $this->sync->log_delete('daily_inspirations', $id);
                   $this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Daily Inspirations ' . lang('web_delete_success')));
              }
              else
              {
                   $this->session->set_flashdata('error', array('type' => 'error', 'text' => lang('web_delete_failed')));
              }

              redirect("admin/daily_inspirations/");
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
                              'field' => 'title',
                              'label' => 'Title',
                              'rules' => 'required|trim|xss_clean|min_length[0]|max_length[60]'),
                      array(
                              'field' => 'message',
                              'label' => 'Message',
                              'rules' => 'required|trim|xss_clean|min_length[0]|max_length[500]'),
                      array(
                              'field' => 'status',
                              'label' => 'Posted By',
                              'rules' => 'required|xss_clean'),
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
              $config['base_url'] = site_url() . 'admin/daily_inspirations/index/';
              $config['use_page_numbers'] = TRUE;
              $config['per_page'] = 10;
              $config['total_rows'] = $this->daily_inspiration_m->count();
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
    