<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    class Admin extends Admin_Controller
    {

         function __construct()
         {
              parent::__construct();

              if (!$this->ion_auth->logged_in())
              {
                   redirect('admin/login');
              }
              $this->load->model('sms_m');
              $this->load->library('sms_gateway');
         }

         /**
          * Module Index
          *
          */
         public function index()
         {
              redirect('admin/sms/compose');
              $config = $this->set_paginate_options();  //Initialize the pagination class
              $this->pagination->initialize($config);

              $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 1;

              $data['sms'] = $this->sms_m->paginate_all($config['per_page'], $page);

              //create pagination links
              $data['links'] = $this->pagination->create_links();

              $data['mms'] = $this->ion_auth->get_member();
              $data['staff'] = $this->ion_auth->list_users();
              $data['mins'] = $this->sms_m->populate('ministries', 'id', 'name');
              $data['hbs'] = $this->sms_m->populate('hbcs', 'id', 'name');

              $data['updType'] = 'create';
              //page number  variable
              $data['page'] = $page;
              $data['per'] = $config['per_page'];
              $data['bal'] = $this->sms_m->get_counter_balance();
              //load view
              $this->template->title(' Sms ')->build('admin/list', $data);
         }

         public function my_sms($id)
         {

              $config = $this->set_paginate_options();  //Initialize the pagination class
              $this->pagination->initialize($config);

              $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 1;

              $data['sms'] = $this->sms_m->my_sms($config['per_page'], $page, $id);

              //create pagination links
              $data['links'] = $this->pagination->create_links();

              $data['mms'] = $this->ion_auth->get_member();
              $data['staff'] = $this->ion_auth->list_users();
              $data['mins'] = $this->sms_m->populate('ministries', 'id', 'name');
              $data['hbs'] = $this->sms_m->populate('hbcs', 'id', 'name');


              $data['updType'] = 'create';
              //page number  variable
              $data['page'] = $page;
              $data['per'] = $config['per_page'];
              $data['bal'] = $this->sms_m->get_counter_balance();
              //load view
              $this->template->title(' Sms ')->build('admin/list', $data);
         }

         function compose($page = NULL)
         {
              $config = $this->set_paginate_options();  //Initialize the pagination class
              $this->pagination->initialize($config);
              $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 1;

              $data['sms'] = $this->sms_m->paginate_all($config['per_page'], $page);

              //create pagination links
              $data['links'] = $this->pagination->create_links();

              $data['mms'] = $this->ion_auth->get_member();
              $data['staff'] = $this->ion_auth->list_users();
              $data['mins'] = $this->sms_m->populate('ministries', 'id', 'name');
              $data['hbs'] = $this->sms_m->populate('hbcs', 'id', 'name');

              $get = new StdClass();
              foreach ($this->validation() as $field)
              {
                   $fn = $field['field'];
                   $get->$fn = set_value($fn);
              }

              $data['result'] = $get;


              $data['updType'] = 'create';
              //page number  variable
              $data['page'] = $page;
              $data['per'] = $config['per_page'];
              $data['bal'] = $this->sms_m->get_counter_balance();
              $data['groups'] = $this->sms_m->get_custom_groups();

              //load the view and the layout
              $this->template->title('Add Sms ')->build('admin/compose', $data);
         }

         /**
          * Add New Sms 
          *
          * @param $page
          */
         function create($page = NULL)
         {
              //SMS Counter balance
              $bal = $this->sms_m->get_counter_balance();

              if ($bal->balance == 0)
              {
                   $this->session->set_flashdata('error', array('type' => 'error', 'text' => 'Sorry your sms account is zero (0). Kindly purchase more SMSs to be able to send message <span style="color:#000"> [ Call 020 524 5283 / 0721341214 or Email sales@mshamba.net ]</span>'));
                   redirect('admin/sms');
              }

              $data['page'] = ( $this->uri->segment(4) ) ? $this->uri->segment(4) : $page;
              //Rules for validation
              $this->form_validation->set_rules($this->validation());

              //validate the fields of form
              if ($this->form_validation->run())
              {         //Validation OK!
                   $settings = $this->settings;
                   $from = $settings->sender_id;
                   $initial = $settings->sms_initial;

                   //SET GROUP TYPES
                   $user = $this->ion_auth->get_user();
                   $gtype = refNo() . '/' . date('m/y', time());
                   $country_code = '254';

                   //Get Message Length
                   $messge_lenght = strlen($this->input->post('message'));
                   $total_ded = 0;

                   //************START SENDING SMS **********************//				

                   if ($this->input->post('send_to') == 'all members')
                   {
                        //all members
                        $all_members = $this->sms_m->all_members();

                        //Computing counter
                        $mem_counter = count($all_members);

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

                        //Check SMS Balance
                        if ($total_ded > $bal->balance)
                        {
                             $this->session->set_flashdata('error', array('type' => 'error', 'text' => 'Sorry Your SMS balance is less than numbers of recipient kindly purchase more SMSs<span style="color:#000"> [ Call 020 524 5283 / 0721341214 or Email sales@mshamba.net ]</span>'));
                             redirect('admin/sms/create');
                        }
                        else
                        {
                             foreach ($all_members as $am)
                             {
                                  $form_data = array(
                                          'recipient' => $am->id,
                                          'status' => 1,
                                          'message' => $this->input->post('message'),
                                          'sent_to' => $this->input->post('send_to'),
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

                                  $new_number = substr_replace($recipient, '+' . $country_code, 0, ($recipient[0] == '0'));
                                  $message = $initial . ' ' . $am->first_name . ', ' . $this->input->post('message');

                                  $this->sms_m->send_sms($recipient, $message);
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
                   elseif ($this->input->post('send_to') == 'church member')
                   {
                        $member = $this->sms_m->get_member($this->input->post('member'));
                        $form_data = array(
                                'recipient' => $member->id,
                                'status' => 1,
                                'message' => $this->input->post('message'),
                                'sent_to' => $this->input->post('send_to'),
                                'group_type' => $gtype,
                                'created_by' => $user->id,
                                'created_on' => time()
                        );

                        $ok = $this->sms_m->create($form_data);
                        $this->sync->log_new('sms', array($ok));
                        $ph = $member->phone1;
                        $cha = array('(', ')', '-', ' ');
                        $sp = array('', '', '');
                        $recipient = str_replace($cha, $sp, $ph);

                        $new_number = substr_replace($recipient, '+' . $country_code, 0, ($recipient[0] == '0'));
                        $message = $initial . ' ' . $member->first_name . ', ' . $this->input->post('message');

                        $this->sms_m->send_sms($recipient, $message);

                        //Update SMS counter table
                        $tt = ($bal->balance - 1);
                        $form_data = array(
                                'balance' => $tt,
                                'modified_by' => $user->id,
                                'modified_on' => time());

                        $this->sms_m->update_counter($form_data);
                   }
                   elseif ($this->input->post('send_to') == 'multiple members')
                   {
                        $mems = array();
                        $mems = $this->input->post('members');
                        $mem_counter = count($mems);

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

                        //Check SMS Balance
                        if ($total_ded > $bal->balance)
                        {
                             $this->session->set_flashdata('error', array('type' => 'error', 'text' => 'Sorry Your SMS balance is less than numbers of recipient kindly purchase more SMSs<span style="color:#000"> [ Call 020 524 5283 / 0721341214 or Email sales@mshamba.net ]</span>'));
                             redirect('admin/sms/create');
                        }
                        else
                        {
                             foreach ($mems as $m)
                             {
                                  $member = $this->sms_m->get_member($m);
                                  $form_data = array(
                                          'recipient' => $member->id,
                                          'status' => 1,
                                          'message' => $this->input->post('message'),
                                          'sent_to' => $this->input->post('send_to'),
                                          'group_type' => $gtype,
                                          'created_by' => $user->id,
                                          'created_on' => time()
                                  );

                                  $ok = $this->sms_m->create($form_data);
                                  $this->sync->log_new('sms', array($ok));
                                  $ph = $member->phone1;
                                  $cha = array('(', ')', '-', ' ');
                                  $sp = array('', '', '');
                                  $recipient = str_replace($cha, $sp, $ph);

                                  $message = $initial . ' ' . $member->first_name . ', ' . $this->input->post('message');
                                  $this->sms_m->send_sms($recipient, $message);

                                  //Update SMS counter table
                                  $tt = ($bal->balance - $total_ded);
                                  $form_data = array(
                                          'balance' => $tt,
                                          'modified_by' => $user->id,
                                          'modified_on' => time());

                                  $this->sms_m->update_counter($form_data);
                             }
                        }
                   }
                   elseif ($this->input->post('send_to') == 'all staff')
                   {

                        //all members
                        $all_staff = $this->sms_m->all_staff();

                        //Computing counter
                        $mem_counter = count($all_staff);

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

                        //Check SMS Balance
                        if ($total_ded > $bal->balance)
                        {
                             $this->session->set_flashdata('error', array('type' => 'error', 'text' => 'Sorry Your SMS balance is less than numbers of recipient kindly purchase more SMSs<span style="color:#000"> [ Call 020 524 5283 / 0721341214 or Email sales@mshamba.net ]</span>'));
                             redirect('admin/sms/create');
                        }
                        else
                        {
                             foreach ($all_staff as $am)
                             {
                                  $form_data = array(
                                          'recipient' => $am->id,
                                          'status' => 1,
                                          'message' => $this->input->post('message'),
                                          'sent_to' => $this->input->post('send_to'),
                                          'group_type' => $gtype,
                                          'created_by' => $user->id,
                                          'created_on' => time()
                                  );

                                  $ok = $this->sms_m->create($form_data);
                                  $this->sync->log_new('sms', array($ok));
                                  $ph = $am->phone;
                                  $cha = array('(', ')', '-', ' ');
                                  $sp = array('', '', '');
                                  $recipient = str_replace($cha, $sp, $ph);
                                  $message = 'Dear ' . $am->first_name . ', ' . $this->input->post('message');

                                  $this->sms_m->send_sms($recipient, $message);
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
                   //*************SEND SMS TO STAFF MEMBER*************************/
                   elseif ($this->input->post('send_to') == 'staff member')
                   {
                        $u = $this->ion_auth->get_user($this->input->post('staff'));
                        $form_data = array(
                                'recipient' => $u->id,
                                'status' => 1,
                                'message' => $this->input->post('message'),
                                'sent_to' => $this->input->post('send_to'),
                                'group_type' => $gtype,
                                'created_by' => $user->id,
                                'created_on' => time()
                        );

                        $ok = $this->sms_m->create($form_data);
                        $this->sync->log_new('sms', array($ok));
                        $ph = $u->phone;
                        $cha = array('(', ')', '-', ' ');
                        $sp = array('', '', '');
                        $recipient = str_replace($cha, $sp, $ph);
                        $message = $initial . ' ' . $u->first_name . ', ' . $this->input->post('message');

                        $this->sms_m->send_sms($recipient, $message);

                        //Update SMS counter table

                        $tt = ($bal->balance - 1);
                        $form_data = array(
                                'balance' => $tt,
                                'modified_by' => $user->id,
                                'modified_on' => time());

                        $this->sms_m->update_counter($form_data);
                   }

                   //******* SEND TO MINISTRY **********************************
                   elseif ($this->input->post('send_to') == 'ministry')
                   {
                        $get_ministry_members = $this->sms_m->get_min_members($this->input->post('ministry'));

                        //Computing counter
                        $mem_counter = count($get_ministry_members);

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

                        //Check SMS Balance
                        if ($total_ded > $bal->balance)
                        {
                             $this->session->set_flashdata('error', array('type' => 'error', 'text' => 'Sorry Your SMS balance is less than numbers of recipient kindly purchase more SMSs<span style="color:#000"> [ Call 020 524 5283 / 0721341214 or Email sales@mshamba.net ]</span>'));
                             redirect('admin/sms/create');
                        }
                        else
                        {

                             foreach ($get_ministry_members as $am)
                             {
                                  $member_details = $this->ion_auth->get_single_member($am->member_id);

                                  $form_data = array(
                                          'recipient' => $am->member_id,
                                          'status' => 1,
                                          'message' => $this->input->post('message'),
                                          'sent_to' => $this->input->post('send_to'),
                                          'group_type' => $gtype,
                                          'created_by' => $user->id,
                                          'created_on' => time()
                                  );

                                  $ok = $this->sms_m->create($form_data);
                                  $this->sync->log_new('sms', array($ok));

                                  $ph = $member_details->phone1;
                                  $cha = array('(', ')', '-', ' ');
                                  $sp = array('', '', '');
                                  $recipient = str_replace($cha, $sp, $ph);
                                  $message = $initial . ' ' . $member_details->first_name . ', ' . $this->input->post('message');

                                  $this->sms_m->send_sms($recipient, $message);
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

                   //**************SEND TO HBC **********************
                   elseif ($this->input->post('send_to') == 'hbc')
                   {
                        $get_hbc_members = $this->sms_m->get_hbc_members($this->input->post('hbc'));

                        //Computing counter
                        $mem_counter = count($get_hbc_members);

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

                        if (!empty($get_hbc_members))
                        {

                             //Check SMS Balance
                             if ($total_ded > $bal->balance)
                             {
                                  $this->session->set_flashdata('error', array('type' => 'error', 'text' => 'Sorry Your SMS balance is less than numbers of recipient kindly purchase more SMSs<span style="color:#000"> [ Call 020 524 5283 / 0721341214 or Email sales@mshamba.net ]</span>'));
                                  redirect('admin/sms/create');
                             }
                             else
                             {
                                  foreach ($get_hbc_members as $am)
                                  {
                                       $form_data = array(
                                               'recipient' => $am->id,
                                               'status' => 1,
                                               'message' => $this->input->post('message'),
                                               'sent_to' => $this->input->post('send_to'),
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
                                       $message = $initial . ' ' . $am->first_name . ', ' . $this->input->post('message');

                                       $this->sms_m->send_sms($recipient, $message);
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
                   }

                   /*                    * ***********SEND SMS TO STAFF MEMBER************************ */
                   elseif ($this->input->post('send_to') == 'group')
                   {

                        $grp = $this->input->post('group');

                        $members = $this->sms_m->get_members_groups($grp);
                        $mem_counter = count($members);

                        //Check SMS Balance
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

                        //Check SMS Balance
                        if ($total_ded > $bal->balance)
                        {
                             $this->session->set_flashdata('error', array('type' => 'error', 'text' => 'Sorry Your SMS balance is less than numbers of recipient kindly purchase more SMSs<span style="color:#000"> [ Call 020 524 5283 / 0721341214 or Email sales@mshamba.net ]</span>'));
                             redirect('admin/sms/create');
                        }
                        else
                        {

                             foreach ($members as $m)
                             {
                                  $member = $this->sms_m->get_member($m->member_id);

                                  $form_data = array(
                                          'recipient' => $m->member_id,
                                          'status' => 1,
                                          'message' => $this->input->post('message'),
                                          'sent_to' => $this->input->post('send_to'),
                                          'group_type' => $gtype,
                                          'created_by' => $user->id,
                                          'created_on' => time()
                                  );

                                  $ok = $this->sms_m->create($form_data);
                                  $this->sync->log_new('sms', array($ok));

                                  $ph = $member->phone1;
                                  $cha = array('(', ')', '-', ' ');
                                  $sp = array('', '', '');
                                  $recipient = str_replace($cha, $sp, $ph);
                                  $message = $initial . ' ' . $am->first_name . ', ' . $this->input->post('message');

                                  $this->sms_m->send_sms($recipient, $message);
                             }

                             //Update SMS counter table

                             $tt = ($bal->balance - $total_ded);

                             $bal_data = array(
                                     'balance' => $tt,
                                     'modified_by' => $user->id,
                                     'modified_on' => time());

                             $this->sms_m->update_counter($bal_data);
                        }
                   }

                   if ($ok) // the information has therefore been successfully saved in the db
                   {
                        $this->session->set_flashdata('message', array('type' => 'success', 'text' => 'SMS Was Successfully Sent'));
                   }
                   else
                   {
                        $this->session->set_flashdata('error', array('type' => 'error', 'text' => 'Sorry SMS could not be sent!!'));
                   }

                   redirect('admin/sms/compose');
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
                   $data['members'] = $this->ion_auth->get_member();
                   $data['staff'] = $this->ion_auth->list_users();
                   $data['ministries'] = $this->sms_m->populate('ministries', 'id', 'name');
                   $data['hbcs'] = $this->sms_m->populate('hbcs', 'id', 'name');
                   $data['groups'] = $this->sms_m->get_custom_groups();

                   $data['updType'] = 'create';
                   //page number  variable
                   $data['page'] = $page;
                   $data['bal'] = $this->sms_m->get_counter_balance();

                   //load the view and the layout
                   $this->template->title('Add Sms ')->build('admin/create', $data);
              }
         }

         /**
          * Edit  Sms 
          *
          * @param $id
          * @param $page
          */
         function edit_removed($id = FALSE, $page = 0)
         {
              //redirect if no $id
              if (!$id)
              {
                   $this->session->set_flashdata('message', array('type' => 'warning', 'text' => lang('web_object_not_exist')));
                   redirect('admin/sms/');
              }
              if (!$this->sms_m->exists($id))
              {
                   $this->session->set_flashdata('message', array('type' => 'warning', 'text' => lang('web_object_not_exist')));
                   redirect('admin/sms');
              }
              //search the item to show in edit form
              $get = $this->sms_m->find($id);

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
                           'recipient' => $this->input->post('recipient'),
                           'status' => $this->input->post('status'),
                           'message' => $this->input->post('message'),
                           'modified_by' => $user->id,
                           'modified_on' => time());

                   $done = $this->sms_m->update_attributes($id, $form_data);

                   // the information has therefore been successfully saved in the db
                   if ($done)
                   {
                        $this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Sms ' . lang('web_edit_success')));
                        redirect("admin/sms/");
                   }
                   else
                   {
                        $this->session->set_flashdata('error', array('type' => 'error', 'text' => $done->errors->full_messages()));
                        redirect("admin/sms/");
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
              //load the view and the layout
              $this->template->title('Edit Sms ')->build('admin/create', $data);
         }

         function delete($id = NULL, $page = 1)
         {
              //filter & Sanitize $id
              $id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;

              //redirect if its not correct
              if (!$id)
              {
                   $this->session->set_flashdata('message', array('type' => 'warning', 'text' => lang('web_object_not_exist')));

                   redirect('admin/sms');
              }

              //search the item to delete
              if (!$this->sms_m->exists($id))
              {
                   $this->session->set_flashdata('message', array('type' => 'warning', 'text' => lang('web_object_not_exist')));
                   redirect('admin/sms');
              }

              //delete the item
              if ($this->sms_m->delete($id) == TRUE)
              {
                   $this->session->set_flashdata('message', array('type' => 'sucess', 'text' => 'Sms ' . lang('web_delete_success')));
              }
              else
              {
                   $this->session->set_flashdata('error', array('type' => 'error', 'text' => lang('web_delete_failed')));
              }

              redirect("admin/sms/");
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
                              'field' => 'send_to',
                              'label' => 'Sent To',
                              'rules' => 'required|xss_clean'),
                      array(
                              'field' => 'status',
                              'label' => 'Status',
                              'rules' => ''),
                      array(
                              'field' => 'message',
                              'label' => 'Message',
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
              $config['base_url'] = site_url() . 'admin/sms/index/';
              $config['use_page_numbers'] = TRUE;
              $config['per_page'] = 10000000000000;
              $config['total_rows'] = $this->sms_m->count();
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
    