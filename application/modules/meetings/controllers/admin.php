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
              $this->load->model('meetings_m');
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

              $data['meetings'] = $this->meetings_m->paginate_all($config['per_page'], $page);

              //create pagination links
              $data['links'] = $this->pagination->create_links();

              //page number  variable
              $data['page'] = $page;
              $data['per'] = $config['per_page'];

              //load view
              $this->template->title(' Meetings ')->build('admin/list', $data);
         }

         /**
          * Add New Meetings 
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

              $data['bal'] = $this->sms_m->get_counter_balance();

              //validate the fields of form
              if ($this->form_validation->run())
              {
                   //Validation OK!
                   $bal = $this->sms_m->get_counter_balance();
                   $gtype = refNo() . '/' . date('m/y', time());
                   $country_code = '254';

                   $user = $this->ion_auth->get_user();

                   $others = $this->input->post('ministry');
                   if ($this->input->post('guests') == 'hbc')
                   {
                        $others = $this->input->post('hbc');
                   }

                   if ($this->input->post('sms_alert') == 0)
                   {

                        $form_data = array(
                                'title' => $this->input->post('title'),
                                'start_date' => strtotime($this->input->post('start_date')),
                                'end_date' => strtotime($this->input->post('end_date')),
                                'venue' => $this->input->post('venue'),
                                'importance' => $this->input->post('importance'),
                                'guests' => $this->input->post('guests'),
                                'others' => $others,
                                'status' => $this->input->post('status'),
                                'sms_alert' => $this->input->post('sms_alert'),
                                'description' => $this->input->post('description'),
                                'created_by' => $user->id,
                                'created_on' => time()
                        );

                        $ok = $this->meetings_m->create($form_data);
                        $this->sync->log_new('meetings', array($ok));
                   }
                   else
                   {

                        //************START SENDING SMS To all members **********************//				

                        if ($this->input->post('guests') == 'all members')
                        {
                             //all members
                             $all_members = $this->sms_m->all_members();

                             //Computing counter
                             $mem_counter = count($all_members);


                             //Check SMS Balance
                             if ($mem_counter > $bal->balance)
                             {

                                  $this->session->set_flashdata('error', array('type' => 'error', 'text' => 'Sorry Your SMS balance is less than numbers of recipient kindly purchase more SMSs<span style="color:#000"> [ Call 020 524 5283 / 0721341214 or Email sales@mshamba.net ]</span>'));

                                  redirect('admin/meetings/create');
                             }
                             else
                             {


                                  $meeting = array(
                                          'title' => $this->input->post('title'),
                                          'start_date' => strtotime($this->input->post('start_date')),
                                          'end_date' => strtotime($this->input->post('end_date')),
                                          'venue' => $this->input->post('venue'),
                                          'importance' => $this->input->post('importance'),
                                          'guests' => $this->input->post('guests'),
                                          'others' => $others,
                                          'status' => $this->input->post('status'),
                                          'sms_alert' => $this->input->post('sms_alert'),
                                          'description' => $this->input->post('description'),
                                          'created_by' => $user->id,
                                          'created_on' => time()
                                  );

                                  $ok = $this->meetings_m->create($meeting);
                                  $this->sync->log_new('meetings', array($ok));
                                  foreach ($all_members as $am)
                                  {
                                       $form_data = array(
                                               'recipient' => $am->id,
                                               'status' => 1,
                                               'message' => $this->input->post('description'),
                                               'sent_to' => $this->input->post('guests'),
                                               'group_type' => $gtype,
                                               'created_by' => $user->id,
                                               'created_on' => time()
                                       );

                                       $ks = $this->sms_m->create($form_data);
                                       $this->sync->log_new('sms', array($ks));

                                       $ph = $am->phone1;
                                       $cha = array('(', ')', '-', ' ');
                                       $sp = array('', '', '');
                                       $recipient = str_replace($cha, $sp, $ph);

                                       $settings = $this->settings;
                                       $initial = $settings->sms_initial;
                                       //$new_number = substr_replace($recipient, '+'.$country_code, 0, ($recipient[0] == '0'));
                                       $message = $this->input->post('description');

                                       $this->sms_m->send_sms($recipient, $message);
                                  }


                                  //Update SMS counter table

                                  $tt = ($bal->balance - $mem_counter);
                                  $form_data = array(
                                          'balance' => $tt,
                                          'modified_by' => $user->id,
                                          'modified_on' => time());

                                  $this->sms_m->update_counter($form_data);
                             }
                        }

                        //**************END MEMBERS**************
                        //**************TO ALL STAFF**************
                        elseif ($this->input->post('guests') == 'all staff')
                        {

                             //all members
                             $all_staff = $this->sms_m->all_staff();

                             //Computing counter
                             $mem_counter = count($all_staff);


                             //Check SMS Balance
                             if ($mem_counter > $bal->balance)
                             {

                                  $this->session->set_flashdata('error', array('type' => 'error', 'text' => 'Sorry Your SMS balance is less than numbers of recipient kindly purchase more SMSs<span style="color:#000"> [ Call 020 524 5283 / 0721341214 or Email sales@mshamba.net ]</span>'));
                                  redirect('admin/meetings/create');
                             }
                             else
                             {


                                  $meeting = array(
                                          'title' => $this->input->post('title'),
                                          'start_date' => strtotime($this->input->post('start_date')),
                                          'end_date' => strtotime($this->input->post('end_date')),
                                          'venue' => $this->input->post('venue'),
                                          'importance' => $this->input->post('importance'),
                                          'guests' => $this->input->post('guests'),
                                          'others' => $others,
                                          'status' => $this->input->post('status'),
                                          'sms_alert' => $this->input->post('sms_alert'),
                                          'description' => $this->input->post('description'),
                                          'created_by' => $user->id,
                                          'created_on' => time()
                                  );

                                  $ok = $this->meetings_m->create($meeting);
                                  $this->sync->log_new('meetings', array($ok));


                                  foreach ($all_staff as $am)
                                  {
                                       $form_data = array(
                                               'recipient' => $am->id,
                                               'status' => 1,
                                               'message' => $this->input->post('description'),
                                               'sent_to' => $this->input->post('guests'),
                                               'group_type' => $gtype,
                                               'created_by' => $user->id,
                                               'created_on' => time()
                                       );

                                       $kks = $this->sms_m->create($form_data);
                                       $this->sync->log_new('sms', array($kks));
                                       $ph = $am->phone;
                                       $cha = array('(', ')', '-', ' ');
                                       $sp = array('', '', '');
                                       $recipient = str_replace($cha, $sp, $ph);

                                       //$new_number = substr_replace($recipient, '+'.$country_code, 0, ($recipient[0] == '0'));
                                       $message = $this->input->post('description');
                                       $from = "M-SHAMBA";

                                       $this->sms_m->send_sms($recipient, $message);
                                  }

                                  //Update SMS counter table

                                  $tt = ($bal->balance - $mem_counter);
                                  $form_data = array(
                                          'balance' => $tt,
                                          'modified_by' => $user->id,
                                          'modified_on' => time());

                                  $this->sms_m->update_counter($form_data);
                             }
                        }

                        //**************TO MINISTRY**************
                        elseif ($this->input->post('guests') == 'ministry')
                        {

                             $mim = $this->meetings_m->get_min($this->input->post('ministry'));
                             $get_ministry_members = $this->sms_m->get_min_members($mim->id);

                             //print_r($get_ministry_members);die;
                             //Computing counter
                             $mem_counter = count($get_ministry_members);


                             //Check SMS Balance
                             if ($mem_counter > $bal->balance)
                             {

                                  $this->session->set_flashdata('error', array('type' => 'error', 'text' => 'Sorry Your SMS balance is less than numbers of recipient kindly purchase more SMSs<span style="color:#000"> [ Call 020 524 5283 / 0721341214 or Email sales@mshamba.net ]</span>'));
                                  redirect('admin/sms/create');
                             }
                             else
                             {
                                  $meeting = array(
                                          'title' => $this->input->post('title'),
                                          'start_date' => strtotime($this->input->post('start_date')),
                                          'end_date' => strtotime($this->input->post('end_date')),
                                          'venue' => $this->input->post('venue'),
                                          'importance' => $this->input->post('importance'),
                                          'guests' => $this->input->post('guests'),
                                          'others' => $others,
                                          'status' => $this->input->post('status'),
                                          'sms_alert' => $this->input->post('sms_alert'),
                                          'description' => $this->input->post('description'),
                                          'created_by' => $user->id,
                                          'created_on' => time()
                                  );

                                  $ok = $this->meetings_m->create($meeting);
                                  $this->sync->log_new('meetings', array($ok));

                                  foreach ($get_ministry_members as $am)
                                  {

                                       $member_details = $this->ion_auth->get_single_member($am->member_id);
                                       $form_data = array(
                                               'recipient' => $am->member_id,
                                               'status' => 1,
                                               'message' => $this->input->post('description'),
                                               'sent_to' => $this->input->post('guests'),
                                               'group_type' => $gtype,
                                               'created_by' => $user->id,
                                               'created_on' => time()
                                       );

                                       $ok = $this->sms_m->create($form_data);
                                       if ($ok)
                                       {
                                            $this->sync->log_new('sms', array($ok));
                                       }
                                       $ph = $member_details->phone1;
                                       $cha = array('(', ')', '-', ' ');
                                       $sp = array('', '', '');
                                       $recipient = str_replace($cha, $sp, $ph);

                                       //$new_number = substr_replace($recipient, '+'.$country_code, 0, ($recipient[0] == '0'));
                                       $message = $this->input->post('description');
                                       $from = "M-SHAMBA";

                                       $this->sms_m->send_sms($recipient, $message);
                                  }
                                  //Update SMS counter table

                                  $tt = ($bal->balance - $mem_counter);
                                  $form_data = array(
                                          'balance' => $tt,
                                          'modified_by' => $user->id,
                                          'modified_on' => time());

                                  $this->sms_m->update_counter($form_data);
                             }
                        }


                        //**************TO HBC**************
                        //**************SEND TO HBC **********************
                        elseif ($this->input->post('guests') == 'hbc')
                        {

                             $hbc = $this->meetings_m->get_hbc($this->input->post('hbc'));
                             $get_hbc_members = $this->sms_m->get_hbc_members($hbc->id);

                             //Computing counter
                             $mem_counter = count($get_hbc_members);

                             if (!empty($get_hbc_members))
                             {
                                  //Check SMS Balance
                                  if ($mem_counter > $bal->balance)
                                  {
                                       $this->session->set_flashdata('error', array('type' => 'error', 'text' => 'Sorry Your SMS balance is less than numbers of recipient kindly purchase more SMSs<span style="color:#000"> [ Call 020 524 5283 / 0721341214 or Email sales@mshamba.net ]</span>'));
                                       redirect('admin/sms/create');
                                  }
                                  else
                                  {
                                       $meeting = array(
                                               'title' => $this->input->post('title'),
                                               'start_date' => strtotime($this->input->post('start_date')),
                                               'end_date' => strtotime($this->input->post('end_date')),
                                               'venue' => $this->input->post('venue'),
                                               'importance' => $this->input->post('importance'),
                                               'guests' => $this->input->post('guests'),
                                               'others' => $others,
                                               'status' => $this->input->post('status'),
                                               'sms_alert' => $this->input->post('sms_alert'),
                                               'description' => $this->input->post('description'),
                                               'created_by' => $user->id,
                                               'created_on' => time()
                                       );

                                       $ok = $this->meetings_m->create($meeting);
                                       $this->sync->log_new('meetings', array($ok));

                                       foreach ($get_hbc_members as $am)
                                       {

                                            $form_data = array(
                                                    'recipient' => $am->id,
                                                    'status' => 1,
                                                    'message' => $this->input->post('description'),
                                                    'sent_to' => $this->input->post('guests'),
                                                    'group_type' => $gtype,
                                                    'created_by' => $user->id,
                                                    'created_on' => time()
                                            );

                                            $ok = $this->sms_m->create($form_data);
                                            $this->sync->log_new('sms', array($ok));
                                            $ph = $am->phone1;
                                            $cha = array('(', ')', '-', ' ');
                                            $sp = array('', '', '');
                                            $recipient = str_replace($cha, $sp, $ph);

                                            //$new_number = substr_replace($recipient, '+'.$country_code, 0, ($recipient[0] == '0'));
                                            $message = $this->input->post('description');
                                            $from = "M-SHAMBA";
                                            //print_r($new_number);die;
                                            $this->sms_m->send_sms($recipient, $message);
                                       }

                                       //Update SMS counter table

                                       $tt = ($bal->balance - $mem_counter);
                                       $form_data = array(
                                               'balance' => $tt,
                                               'modified_by' => $user->id,
                                               'modified_on' => time());

                                       $this->sms_m->update_counter($form_data);

                                       $ph = $am->phone1;
                                       $cha = array('(', ')', '-', ' ');
                                       $sp = array('', '', '');
                                       $recipient = str_replace($cha, $sp, $ph);

                                       //$new_number = substr_replace($recipient, '+'.$country_code, 0, ($recipient[0] == '0'));
                                       $message = $this->input->post('message');
                                       $from = "M-SHAMBA";
                                       $this->sms_m->send_sms($recipient, $message);
                                  }
                             }
                        }



                        if ($ok) // the information has therefore been successfully saved in the db
                        {
                             $this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Meetings ' . lang('web_create_success')));
                        }
                        else
                        {
                             $this->session->set_flashdata('error', array('type' => 'error', 'text' => 'Meetings ' . lang('web_create_failed')));
                        }
                   }

                   redirect('admin/meetings/');
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
                   $data['ministries'] = $this->meetings_m->populate('ministries', 'name', 'name');
                   $data['hbcs'] = $this->meetings_m->populate('hbcs', 'name', 'name');
                   //load the view and the layout
                   $this->template->title('Add Meetings ')->build('admin/create', $data);
              }
         }

         /**
          * Edit  Meetings 
          *
          * @param $id
          * @param $page
          */
         function edit($id = FALSE, $page = 0)
         {

              //redirect if no $id
              if (!$id)
              {
                   $this->session->set_flashdata('message', array('type' => 'warning', 'text' => lang('web_object_not_exist')));
                   redirect('admin/meetings/');
              }
              if (!$this->meetings_m->exists($id))
              {
                   $this->session->set_flashdata('message', array('type' => 'warning', 'text' => lang('web_object_not_exist')));
                   redirect('admin/meetings');
              }
              //search the item to show in edit form
              $get = $this->meetings_m->find($id);
              //Rules for validation
              $this->form_validation->set_rules($this->validation());

              //create control variables
              $data['updType'] = 'edit';
              $data['page'] = $page;

              if ($this->form_validation->run())  //validation has been passed
              {
                   $user = $this->ion_auth->get_user();

                   if ($this->input->post('guests') == 'ministry')
                   {
                        $others = $this->input->post('ministry');
                   }
                   if ($this->input->post('guests') == 'hbc')
                   {
                        $others = $this->input->post('hbc');
                   }

                   // build array for the model
                   $form_data = array(
                           'title' => $this->input->post('title'),
                           'start_date' => strtotime($this->input->post('start_date')),
                           'end_date' => strtotime($this->input->post('end_date')),
                           'venue' => $this->input->post('venue'),
                           'importance' => $this->input->post('importance'),
                           'guests' => $this->input->post('guests'),
                           'others' => $others,
                           'status' => $this->input->post('status'),
                           'sms_alert' => $this->input->post('sms_alert'),
                           'description' => $this->input->post('description'),
                           'modified_by' => $user->id,
                           'modified_on' => time());

                   $done = $this->meetings_m->update_attributes($id, $form_data);

                   // the information has therefore been successfully saved in the db
                   if ($done)
                   {
                        $this->sync->log_update('meetings', $id, $form_data);

                        $this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Meetings ' . lang('web_edit_success')));
                        redirect("admin/meetings/");
                   }
                   else
                   {
                        $this->session->set_flashdata('error', array('type' => 'error', 'text' => $done->errors->full_messages()));
                        redirect("admin/meetings/");
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
              $data['ministries'] = $this->meetings_m->populate('ministries', 'name', 'name');
              $data['hbcs'] = $this->meetings_m->populate('hbcs', 'name', 'name');
              //load the view and the layout
              $this->template->title('Edit Meetings ')->build('admin/create', $data);
         }

         function delete($id = NULL, $page = 1)
         {
              //filter & Sanitize $id
              $id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;

              //redirect if its not correct
              if (!$id)
              {
                   $this->session->set_flashdata('message', array('type' => 'warning', 'text' => lang('web_object_not_exist')));

                   redirect('admin/meetings');
              }

              //search the item to delete
              if (!$this->meetings_m->exists($id))
              {
                   $this->session->set_flashdata('message', array('type' => 'warning', 'text' => lang('web_object_not_exist')));
                   redirect('admin/meetings');
              }

              //delete the item
              if ($this->meetings_m->delete($id) == TRUE)
              {
                   $this->sync->log_delete('meetings', $id);
                   $this->session->set_flashdata('message', array('type' => 'sucess', 'text' => 'Meetings ' . lang('web_delete_success')));
              }
              else
              {
                   $this->session->set_flashdata('error', array('type' => 'error', 'text' => lang('web_delete_failed')));
              }

              redirect("admin/meetings/");
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
                              'field' => 'start_date',
                              'label' => 'Start Date',
                              'rules' => 'required|xss_clean'),
                      array(
                              'field' => 'end_date',
                              'label' => 'End Date',
                              'rules' => 'required|xss_clean'),
                      array(
                              'field' => 'venue',
                              'label' => 'Venue',
                              'rules' => 'required|trim|xss_clean|min_length[0]|max_length[60]'),
                      array(
                              'field' => 'importance',
                              'label' => 'Importance',
                              'rules' => 'required|trim|xss_clean|min_length[0]|max_length[60]'),
                      array(
                              'field' => 'guests',
                              'label' => 'Guests',
                              'rules' => 'required|xss_clean'),
                      array(
                              'field' => 'status',
                              'label' => 'status',
                              'rules' => 'required|xss_clean'),
                      array(
                              'field' => 'sms_alert',
                              'label' => 'Sms Alert',
                              'rules' => 'required|xss_clean'),
                      array(
                              'field' => 'description',
                              'label' => 'Description',
                              'rules' => 'required|trim|xss_clean|min_length[0]|max_length[500]'),
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
              $config['base_url'] = site_url() . 'admin/meetings/index/';
              $config['use_page_numbers'] = TRUE;
              $config['per_page'] = 10;
              $config['total_rows'] = $this->meetings_m->count();
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
    