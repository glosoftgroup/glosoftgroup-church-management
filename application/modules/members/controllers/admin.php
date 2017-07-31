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
              $this->load->model('members_m');
              $this->load->model('sms/sms_m');
              $this->load->library('sms_gateway');
         }

         function add_members()
         {

              $members = array(
                      array(// row #158
                              'date_joined' => 1309640400,
                              'hbc_id' => 0,
                              'title' => 'Mr.',
                              'member_code' => '',
                              'first_name' => 'GODFFREY',
                              'last_name' => 'OGUTU FAMILY',
                              'gender' => 'Male',
                              'dob' => 1420318800,
                              'phone1' => '(073) 465-4757',
                              'phone2' => '',
                              'email' => 'godfreyo@nrbmiracleland.org',
                              'country' => 'Kenya',
                              'county' => 'Kisumu',
                              'location' => 'THIKA',
                              'address' => '',
                              'marital_status' => 'married',
                              'member_status' => 'active',
                              'passport' => '',
                              'occupation' => 'doctor',
                              'employer' => '',
                              'how_joined' => 'baptised',
                              'baptised' => 'yes',
                              'confirmed' => 'yes',
                              'description' => '',
                              'created_by' => 1,
                              'modified_by' => NULL,
                              'created_on' => 1426692675,
                              'modified_on' => NULL,
                      ),
              );
              foreach ($members as $mem)
              {
                   $ok = $this->members_m->create($mem);
              }
              if ($ok)
              {
                   $this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Members ' . lang('web_create_success')));
              }
              else
              {
                   $this->session->set_flashdata('error', array('type' => 'error', 'text' => 'Members ' . lang('web_create_failed')));
              }

              redirect('admin/members/');
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

              $members = $this->members_m->paginate_all($config['per_page'], $page);
              if ($members)
              {
                   foreach ($members as $mm)
                   {

                        $usr_groups = $this->portal_m->get_member_groups($mm->id);

                        $glist = array();

                        foreach ($usr_groups as $grp)
                        {
                             $glist[] = $grp->group_id;
                        }


                        $gs = $this->members_m->populate('groups', 'id', 'description');

                        $data['groups_list'] = $gs;
                        $sl = array();
                        $sl = isset($_POST['groups']) ? $_POST['groups'] : $glist;


                        $data['selected'] = $sl;
                   }
              }

              $data['members'] = $members;

              //create pagination links
              $data['links'] = $this->pagination->create_links();

              //page number  variable
              $data['page'] = $page;
              $data['per'] = $config['per_page'];
              $data['groups'] = $this->members_m->populate('groups', 'id', 'description');

              $data['ministries'] = $this->members_m->populate('ministries', 'id', 'name');
              $data['hbcs'] = $this->members_m->populate('hbcs', 'id', 'name');

              //load view
              $this->template->title(' Members ')->build('admin/list', $data);
         }

         /**
          * Add To Group  Members 
          *
          * @param $id
          * @param $page
          */
         function add_groups($id = FALSE)
         {

              //redirect if no $id
              if (!$id)
              {
                   $this->session->set_flashdata('message', array('type' => 'warning', 'text' => lang('web_object_not_exist')));
                   redirect('admin/members/');
              }
              if (!$this->members_m->exists($id))
              {
                   $this->session->set_flashdata('message', array('type' => 'warning', 'text' => lang('web_object_not_exist')));
                   redirect('admin/members');
              }

              // the information has therefore been successfully saved in the db

              $user = $this->ion_auth->get_user();
              $memG = $this->input->post('member_groups');
              if (isset($memG))
              {

                   foreach ($memG as $mg)
                   {
                        $gdata = array(
                                'member_id' => $id,
                                'group_id' => $mg,
                                'modified_by' => $user->id,
                                'modified_on' => time()
                        );
                        if (!$this->members_m->exists_mg($id, $mg))
                        {
                             $done = $this->members_m->insert_gm($gdata);
                             $this->sync->log_new('member_groups', array($ok));
                        }
                   }
              }
              if ($done)
              {
                   $this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Members ' . lang('web_edit_success')));
                   redirect("admin/members/");
              }
              else
              {
                   $this->session->set_flashdata('error', array('type' => 'error', 'text' => $done->errors->full_messages()));
                   redirect("admin/members/");
              }
         }

         function upload_members()
         {

              $file = $_FILES['csv']['tmp_name'];

              $handler = fopen($file, "r");

              $i = 0;

              while (($fileop = fgetcsv($handler, 1000, ",")) !== false)
              {
                   $i++;

                   $names = $fileop[0];
                   $dob = $fileop[1];
                   $gender = $fileop[2];
                   $address = $fileop[3];
                   $id_no = $fileop[4];
                   $phone = $fileop[5];
                   $email = $fileop[6];
                   $education_level = $fileop[7];
                   $marital_status = $fileop[8];
                   $occupation = $fileop[9];
                   //$employer    = $fileop[10];
                   $location = $fileop[10];



                   $nms = explode(' ', $names);
                   $fname = $nms[0];
                   if (!empty($nms[3]))
                   {
                        $lname = $nms[1] . ' ' . $nms[2] . ' ' . $nms[3];
                   }
                   elseif (!empty($nms[2]))
                   {
                        $lname = $nms[1] . ' ' . $nms[2];
                   }
                   else
                   {
                        $lname = $nms[1];
                   }




                   $full_code = 'SMBC/0' . date('y') . '/00' . $i;

                   $user = $this->ion_auth->get_user();
                   $form_data = array(
                           'first_name' => $fname,
                           'last_name' => $lname,
                           'gender' => $gender,
                           'address' => $address,
                           'id_no' => $id_no,
                           'county' => $address,
                           'member_status' => 'Active',
                           'phone1' => $phone,
                           'email' => $email,
                           'education_level' => $education_level,
                           'marital_status' => $marital_status,
                           'occupation' => $occupation,
                           //'employer' => $employer, 
                           'dob' => strtotime($dob),
                           'location' => $location,
                           'date_joined' => time(),
                           'member_code' => $full_code,
                           'created_by' => $user->id,
                           'created_on' => time()
                   );

                   $ok = $this->members_m->create($form_data);
              }

              if ($ok) // the information has therefore been successfully saved in the db
              {
                   $this->session->set_flashdata('message', array('type' => 'success', 'text' => lang('web_create_success')));
              }
              else
              {
                   $this->session->set_flashdata('message', array('type' => 'error', 'text' => lang('web_create_failed')));
              }

              redirect('admin/members/');
         }

         function upload_members_()
         {

              $file = $_FILES['csv']['tmp_name'];

              $handler = fopen($file, "r");

              $i = 0;

              while (($fileop = fgetcsv($handler, 1000, ",")) !== false)
              {
                   $i++;

                   $names = $fileop[0];
                   $phone = $fileop[1];
                   $nms = explode(' ', $names);
                   $fname = $nms[0];
                   if (!empty($nms[3]))
                   {
                        $lname = $nms[1] . ' ' . $nms[2] . ' ' . $nms[3];
                   }
                   else
                   {
                        $lname = $nms[1] . ' ' . $nms[2];
                   }


                   $full_code = 'FPM/0' . date('y') . '/00' . $i;

                   $user = $this->ion_auth->get_user();
                   $form_data = array(
                           'first_name' => $fname,
                           'last_name' => $lname,
                           'phone1' => '0' . $phone,
                           'date_joined' => time(),
                           'member_code' => $full_code,
                           'created_by' => $user->id,
                           'created_on' => time()
                   );

                   $ok = $this->members_m->create($form_data);


                   //*********************SMS NEW MEMBER ***********************

                   $bal = $this->sms_m->get_counter_balance();

                   if (!$bal->balance == 0)
                   {
                        $gtype = refNo() . '/' . date('m/y', time());
                        $country_code = '254';

                        $new_number = substr_replace($phone, '+' . $country_code, 0, ($phone[0] == '0'));
                        $message = 'Praise the Lord ' . $fname . ', we thank you for being part of FPM.Your Membership Number is ' . $full_code . '.For More Info 0729611319.FROM FAMILY PENTECOSTAL MINISTRIES';

                        //$this->sms_gateway->sendMessage($new_number, $message);
                        $this->sms_m->send_sms($phone, $message);

                        $form_data = array(
                                'recipient' => $ok,
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

              if ($ok) // the information has therefore been successfully saved in the db
              {
                   $this->session->set_flashdata('message', array('type' => 'success', 'text' => lang('web_create_success')));
              }
              else
              {
                   $this->session->set_flashdata('message', array('type' => 'error', 'text' => lang('web_create_failed')));
              }

              redirect('admin/members/');
         }

         /**
          * Add New Members 
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
                   $settings = $this->portal_m->fetch_settings();
                   $from = $settings->sender_id;
                   $mem_code = $settings->member_code_initial;

                   $file = '';
                   if (!empty($_FILES['file']['name']))
                   {
                        $this->load->library('files_uploader');
                        $upload_data = $this->files_uploader->upload('file');
                        $file = $upload_data['file_name'];
                   }

                   $user = $this->ion_auth->get_user();
                   $form_data = array(
                           'date_joined' => strtotime($this->input->post('date_joined')),
                           'title' => $this->input->post('title'),
                           'first_name' => $this->input->post('first_name'),
                           'last_name' => $this->input->post('last_name'),
                           'gender' => $this->input->post('gender'),
                           'dob' => strtotime($this->input->post('dob')),
                           'id_no' => $this->input->post('id_no'),
                           'education_level' => $this->input->post('education_level'),
                           'phone1' => $this->input->post('phone1'),
                           'phone2' => $this->input->post('phone2'),
                           'passport' => $file,
                           'hbc_id' => $this->input->post('hbc_id'),
                           'email' => $this->input->post('email'),
                           'country' => $this->input->post('country'),
                           'county' => $this->input->post('county'),
                           'location' => $this->input->post('location'),
                           'address' => $this->input->post('address'),
                           'marital_status' => $this->input->post('marital_status'),
                           'member_status' => $this->input->post('member_status'),
                           'occupation' => $this->input->post('occupation'),
                           'employer' => $this->input->post('employer'),
                           'how_joined' => $this->input->post('how_joined'),
                           'baptised' => $this->input->post('baptised'),
                           'confirmed' => $this->input->post('confirmed'),
                           'description' => $this->input->post('description'),
                           'created_by' => $user->id,
                           'created_on' => time()
                   );

                   $ok = $this->members_m->create($form_data);

                   if ($ok) // the information has therefore been successfully saved in the db
                   {
                        $this->sync->log_new('members', array($ok));
                        $ref = "";
                        if ($ok < 10)
                        {
                             $ref = "00";
                        }
                        elseif ($ok > 9 && $ok < 99)
                        {
                             $ref = "0";
                        }
                        elseif ($ok > 99)
                        {
                             $ref = "";
                        }
                        $full_code = $mem_code . '-' . $ref . '' . $ok;
                        $update_code = array(
                                'member_code' => $full_code
                        );

                        $this->members_m->update_attributes($ok, $update_code);
                        $this->sync->log_update('members', $ok, $update_code);
                        if ($this->input->post('first_name1') !== " ")
                        {
                             $relative_details = array(
                                     'member_id' => $ok,
                                     'first_name' => $this->input->post('first_name1'),
                                     'last_name' => $this->input->post('last_name1'),
                                     'gender' => $this->input->post('gender1'),
                                     'phone' => $this->input->post('phone'),
                                     'type' => $this->input->post('type1'),
                                     'location' => $this->input->post('location1'),
                                     'relationship' => $this->input->post('relationship1'),
                                     'email' => $this->input->post('email1'),
                                     'additionals' => $this->input->post('additionals'),
                                     'created_by' => $user->id,
                                     'created_on' => time()
                             );
                             $rr = $this->members_m->create_relative($relative_details);
                             $this->sync->log_new('relatives', array($rr));
                        }

                        if ($this->input->post('ministries') !== " ")
                        {
                             $mnt = $this->input->post('ministries');
                             foreach ($mnt as $m)
                             {

                                  $ministries_recs = array(
                                          'member_id' => $ok,
                                          'ministry_id' => $m,
                                          'created_by' => $user->id,
                                          'created_on' => time()
                                  );

                                  $min = $this->members_m->insert_ministries($ministries_recs);
                                  $this->sync->log_new('member_ministries', array($min));
                             }
                        }

                        //*********************SMS NEW MEMBER ***********************

                        $bal = $this->sms_m->get_counter_balance();

                        if (!$bal->balance == 0)
                        {
                             $gtype = refNo() . '/' . date('m/y', time());

                             $ph = $this->input->post('phone1');
                             $fname = $this->input->post('first_name');
                             $cha = array('(', ')', '-', ' ');
                             $sp = array('', '', '');
                             $recipient = str_replace($cha, $sp, $ph);

                             //$new_number = substr_replace($recipient, '+'.$country_code, 0, ($recipient[0] == '0'));
                             $message = 'Hi ' . $fname . ', we thank you for choosing to become a member of our church. Your Membership Code is ' . $full_code;

                             //$this->sms_gateway->sendMessage($new_number, $message,$from);
                             $this->sms_m->send_sms($recipient, $message);

                             $form_data = array(
                                     'recipient' => $ok,
                                     'status' => 1,
                                     'message' => $message,
                                     'sent_to' => 'church member',
                                     'group_type' => $gtype,
                                     'created_by' => $user->id,
                                     'created_on' => time()
                             );

                             $sm = $this->sms_m->create($form_data);
                             $this->sync->log_new('asset_category', array($sm));
                             //Update SMS counter table

                             $tt = ($bal->balance - 1);
                             $sms = array(
                                     'balance' => $tt,
                                     'modified_by' => $user->id,
                                     'modified_on' => time());

                             $this->sms_m->update_counter($sms);
                        }

                        $this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Members ' . lang('web_create_success')));
                   }
                   else
                   {
                        $this->session->set_flashdata('error', array('type' => 'error', 'text' => 'Members ' . lang('web_create_failed')));
                   }

                   redirect('admin/members/');
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
                   $data['ministries'] = $this->members_m->populate('ministries', 'id', 'name');
                   $data['hbcs'] = $this->members_m->populate('hbcs', 'id', 'name');

                   //load the view and the layout
                   $this->template->title('Add Members ')
                        ->set_layout('wizard')
                        ->build('admin/create', $data);

              }
         }

         function update_mems()
         {
              $members = $this->members_m->members();
              $i = 0;
              foreach ($members as $mm)
              {
                   $i++;
                   $form_data = array(
                           'member_code' => 'NMLWC-0' . $i,
                   );

                   $this->members_m->update_attributes($mm->id, $form_data);
              }
              redirect('admin/members/');
         }

         //Search for member function
         function search()
         {
              $id = $this->input->post('mem_id');

              if (!empty($id))
              {
                   redirect('admin/members/profile/' . $id);
              }
              else
              {
                   $this->session->set_flashdata('error', array('type' => 'warning', 'text' => lang('web_object_not_exist')));
                   redirect('admin/members');
              }
         }

         /**
          * View  Members 
          *
          * @param $id
          * @param $page
          */
         function profile($id = FALSE)
         {
              if (!$id)
              {
                   $this->session->set_flashdata('error', array('type' => 'warning', 'text' => lang('web_object_not_exist')));
                   redirect('admin/members/');
              }
              if (!$this->members_m->exists($id))
              {
                   $this->session->set_flashdata('error', array('type' => 'warning', 'text' => lang('web_object_not_exist')));
                   redirect('admin/members');
              }

              $get = $this->members_m->find($id);
              $data['sms'] = $this->members_m->get_messages($id);
              $data['p'] = $get;
              $data['pid'] = $get;
              $data['mm'] = $this->members_m->member_ministries($id);
              $data['result'] = $get;
              $data['updType'] = 'edit';

              $data['mini'] = $this->members_m->ministry_details();
              $data['my_hbc'] = $this->members_m->get_hbc_details();

              $data['hbcs'] = $this->members_m->populate('hbcs', 'id', 'name');
              $data['leader'] = $this->ion_auth->get_member();
              $data['relatives'] = $this->members_m->get_realtive($id);
              $relatives = $this->members_m->get_realtive($id);
              $data['member_ministries'] = $this->members_m->get_ministries($id);
              $data['ministries'] = $this->members_m->populate('ministries', 'id', 'name');

              $data['get_member_groups'] = $this->members_m->get_member_groups($id);

              $data['all_members'] = $this->members_m->get_all_members();
              $data['groups'] = $this->members_m->populate('groups', 'id', 'description');

              /////////CONTRIBUTIONS
              $data['tithes'] = $this->members_m->member_tithe($id);
              $data['tg'] = $this->members_m->member_thanks_giving($id);

              ///MEMBER Pledges		 
              $pl = $this->members_m->member_pledges($id);

              foreach ($pl as $pp)
              {
                   $paid = $this->members_m->total_paid($pp->id);
                   $pp->paid = $paid;
              }
              $data['pl'] = $pl;
              ///Other Variables		 
              $data['ms'] = $this->members_m->member_msupport($id);
              $data['sp'] = $this->members_m->member_mseeds($id);
              $data['oc'] = $this->members_m->member_mocontributions($id);

              $post_r = new StdClass();
              foreach ($this->validation() as $field)
              {
                   $post_r->$field['field'] = set_value($field['field']);
              }
              $data['post'] = $post_r;

              //load the view and the layout
              $this->template->title(' Member Profile')->build('admin/profile', $data);
         }

         /**
          * Edit  Members 
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
                   redirect('admin/members/');
              }
              if (!$this->members_m->exists($id))
              {
                   $this->session->set_flashdata('error', array('type' => 'warning', 'text' => lang('web_object_not_exist')));
                   redirect('admin/members');
              }
              //search the item to show in edit form
              $get = $this->members_m->find($id);
              $relatives = $this->members_m->get_realtive($id);
              $data['member_ministries'] = $this->members_m->get_ministries($id);

              //Rules for validation
              $this->form_validation->set_rules($this->validation());

              //create control variables
              $data['updType'] = 'edit';
              $data['page'] = $page;

              if ($this->form_validation->run())  //validation has been passed
              {
                   $data['members_m'] = $this->members_m->find($id);

                   $file = '';

                   if (!empty($_FILES['file']['name']))
                   {
                        $this->load->library('files_uploader');
                        $upload_data = $this->files_uploader->upload('file');
                        $file = $upload_data['file_name'];
                   }
                   else
                   {
                        $file = $get->passport;
                   }
                   $user = $this->ion_auth->get_user();
                   // build array for the model
                   $form_data = array(
                           'date_joined' => strtotime($this->input->post('date_joined')),
                           'title' => $this->input->post('title'),
                           'first_name' => $this->input->post('first_name'),
                           'last_name' => $this->input->post('last_name'),
                           'gender' => $this->input->post('gender'),
                           'dob' => strtotime($this->input->post('dob')),
                           'id_no' => $this->input->post('id_no'),
                           'education_level' => $this->input->post('education_level'),
                           'phone1' => $this->input->post('phone1'),
                           'phone2' => $this->input->post('phone2'),
                           'passport' => $file,
                           'email' => $this->input->post('email'),
                           'hbc_id' => $this->input->post('hbc_id'),
                           'country' => $this->input->post('country'),
                           'county' => $this->input->post('county'),
                           'location' => $this->input->post('location'),
                           'address' => $this->input->post('address'),
                           'marital_status' => $this->input->post('marital_status'),
                           'member_status' => $this->input->post('member_status'),
                           'occupation' => $this->input->post('occupation'),
                           'employer' => $this->input->post('employer'),
                           'how_joined' => $this->input->post('how_joined'),
                           'baptised' => $this->input->post('baptised'),
                           'confirmed' => $this->input->post('confirmed'),
                           'description' => $this->input->post('description'),
                           'modified_by' => $user->id,
                           'modified_on' => time());

                   $done = $this->members_m->update_attributes($id, $form_data);

                   // the information has therefore been successfully saved in the db
                   if ($done)
                   {
                        $this->sync->log_update('members', $id, $form_data);
                        if ($this->input->post('first_name1') !== "")
                        {
                             $relative_details = array(
                                     'member_id' => $id,
                                     'first_name' => $this->input->post('first_name1'),
                                     'last_name' => $this->input->post('last_name1'),
                                     'gender' => $this->input->post('gender1'),
                                     'phone' => $this->input->post('phone'),
                                     'type' => $this->input->post('type1'),
                                     'location' => $this->input->post('location1'),
                                     'relationship' => $this->input->post('relationship1'),
                                     'email' => $this->input->post('email1'),
                                     'additionals' => $this->input->post('additionals'),
                                     'created_by' => $user->id,
                                     'created_on' => time()
                             );
                             $rel = $this->members_m->create_relative($relative_details);
                             $this->sync->log_new('relatives', array($rel));
                        }

                        if ($this->input->post('ministries') !== " ")
                        {
                             $mnt = $this->input->post('ministries');
                             foreach ($mnt as $m)
                             {
                                  $ministries_recs = array(
                                          'member_id' => $id,
                                          'ministry_id' => $m,
                                          'created_by' => $user->id,
                                          'created_on' => time()
                                  );

                                  $mm = $this->members_m->insert_ministries($ministries_recs);
                                  $this->sync->log_new('member_ministries', array($mm));
                             }
                        }

                        $this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Members ' . lang('web_edit_success')));
                        if ($page == 01)
                        {
                             redirect("admin/members/profile/" . $id);
                        }
                        else
                        {

                             redirect("admin/members/");
                        }
                   }
                   else
                   {
                        $this->session->set_flashdata('error', array('type' => 'error', 'text' => $done->errors->full_messages()));
                        redirect("admin/members/");
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

              $post_r = new StdClass();

              foreach ($this->validation() as $field)
              {
                   $post_r->$field['field'] = set_value($field['field']);
              }

              $data['post'] = $post_r;

              $data['ministries'] = $this->members_m->populate('ministries', 'id', 'name');
              $data['hbcs'] = $this->members_m->populate('hbcs', 'id', 'name');
              $data['leader'] = $this->ion_auth->get_member();

              $data['relatives'] = $relatives;
              //load the view and the layout
              $this->template->title('Edit Members ')->build('admin/edit', $data);
         }

         function delete($id = NULL, $page = 1)
         {
              $files_to_delete = array();

              //filter & Sanitize $id
              $id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;

              //redirect if its not correct
              if (!$id)
              {
                   $this->session->set_flashdata('error', array('type' => 'warning', 'text' => lang('web_object_not_exist')));
                   redirect('admin/members');
              }

              //search the item to delete
              if (!$this->members_m->exists($id))
              {
                   $this->session->set_flashdata('error', array('type' => 'warning', 'text' => lang('web_object_not_exist')));
                   redirect('admin/members');
              }

              $members_m = $this->members_m->find($id);
              //Save the files into array to delete after
              array_push($files_to_delete, $members_m->passport);
              //delete the item
              if ($this->members_m->delete($id) == TRUE)
              {
                   $this->sync->log_delete('members', $id);
                   $this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Members ' . lang('web_delete_success')));

                   //delete the old images
                   foreach ($files_to_delete as $index)
                   {
                        if (is_file(FCPATH . 'uploads/files/' . $index))
                             unlink(FCPATH . 'uploads/files/' . $index);
                   }
              }
              else
              {
                   $this->session->set_flashdata('error', array('type' => 'error', 'text' => lang('web_delete_failed')));
              }

              redirect("admin/members/");
         }

         function remove_ministry($id = NULL, $page = NULL)
         {
              $files_to_delete = array();
              //filter & Sanitize $id
              $id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;
              //redirect if its not correct
              if (!$id)
              {
                   $this->session->set_flashdata('error', array('type' => 'warning', 'text' => lang('web_object_not_exist')));

                   redirect('admin/members');
              }

              //search the item to delete
              if (!$this->members_m->exists_mministry($id))
              {
                   $this->session->set_flashdata('error', array('type' => 'warning', 'text' => lang('web_object_not_exist')));
                   redirect('admin/members');
              }

              //delete the item
              if ($this->members_m->delete_mministry($id) == TRUE)
              {
                   $this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Members ' . lang('web_delete_success')));
              }
              else
              {
                   $this->session->set_flashdata('error', array('type' => 'error', 'text' => lang('web_delete_failed')));
              }

              if ($page == 105)
                   redirect("admin/members/profile/" . $id);
              elseif ($page == 1001)
                   redirect("admin/members/edit/" . $id);
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
                              'field' => 'date_joined',
                              'label' => 'Date Joined',
                              'rules' => 'required|xss_clean'),
                      array(
                              'field' => 'title',
                              'label' => 'Title',
                              'rules' => 'xss_clean'),
                      array(
                              'field' => 'first_name',
                              'label' => 'First Name',
                              'rules' => 'required|trim|xss_clean|min_length[0]|max_length[60]'),
                      array(
                              'field' => 'last_name',
                              'label' => 'Last Name',
                              'rules' => 'required|trim|xss_clean|min_length[0]|max_length[60]'),
                      array(
                              'field' => 'gender',
                              'label' => 'Gender',
                              'rules' => 'required|xss_clean'),
                      array(
                              'field' => 'dob',
                              'label' => 'Dob',
                              'rules' => 'required|xss_clean'),
                      array(
                              'field' => 'id_no',
                              'label' => 'ID Number',
                              'rules' => 'xss_clean'),
                      array(
                              'field' => 'education_level',
                              'label' => 'Education Level',
                              'rules' => 'xss_clean'),
                      array(
                              'field' => 'phone1',
                              'label' => 'Phone1',
                              'rules' => 'required|trim|xss_clean|min_length[0]|max_length[60]'),
                      array(
                              'field' => 'phone2',
                              'label' => 'Phone2',
                              'rules' => 'trim|xss_clean|min_length[0]|max_length[60]'),
                      array(
                              'field' => 'email',
                              'label' => 'Email',
                              'rules' => 'trim|xss_clean|min_length[0]|max_length[60]'),
                      array(
                              'field' => 'country',
                              'label' => 'Country',
                              'rules' => 'required|xss_clean'),
                      array(
                              'field' => 'county',
                              'label' => 'County',
                              'rules' => 'required|xss_clean'),
                      array(
                              'field' => 'location',
                              'label' => 'Location',
                              'rules' => 'trim|xss_clean|min_length[0]|max_length[60]'),
                      array(
                              'field' => 'address',
                              'label' => 'Address',
                              'rules' => 'trim|xss_clean|min_length[0]|max_length[500]'),
                      array(
                              'field' => 'marital_status',
                              'label' => 'Marital Status',
                              'rules' => 'required|xss_clean'),
                      array(
                              'field' => 'member_status',
                              'label' => 'Member Status',
                              'rules' => 'required|xss_clean'),
                      array(
                              'field' => 'occupation',
                              'label' => 'Occupation',
                              'rules' => 'xss_clean'),
                      array(
                              'field' => 'phone',
                              'label' => 'Phone',
                              'rules' => 'xss_clean'),
                      array(
                              'field' => 'employer',
                              'label' => 'Employer',
                              'rules' => 'trim|xss_clean|min_length[0]|max_length[60]'),
                      array(
                              'field' => 'how_joined',
                              'label' => 'How Joined',
                              'rules' => 'required|xss_clean'),
                      array(
                              'field' => 'baptised',
                              'label' => 'Baptised',
                              'rules' => 'required|xss_clean'),
                      array(
                              'field' => 'hbc_id',
                              'label' => 'HBC',
                              'rules' => 'xss_clean'),
                      array(
                              'field' => 'confirmed',
                              'label' => 'Confirmed',
                              'rules' => 'required|xss_clean'),
                      array(
                              'field' => 'description',
                              'label' => 'Description',
                              'rules' => 'trim|xss_clean|min_length[0]|max_length[500]'),
                      //Member Ministries
                      array(
                              'field' => 'ministry_id',
                              'label' => 'Ministry',
                              'rules' => 'xss_clean'),
                      //Details of Relative
                      array(
                              'field' => 'first_name1',
                              'label' => 'First Name',
                              'rules' => 'xss_clean'),
                      array(
                              'field' => 'last_name1',
                              'label' => 'Last Name',
                              'rules' => 'xss_clean'),
                      array(
                              'field' => 'gender1',
                              'label' => 'Gender',
                              'rules' => 'xss_clean'),
                      array(
                              'field' => 'location1',
                              'label' => 'Location',
                              'rules' => 'xss_clean'),
                      array(
                              'field' => 'type1',
                              'label' => 'Gender',
                              'rules' => 'xss_clean'),
                      array(
                              'field' => 'relationship1',
                              'label' => 'Relationship',
                              'rules' => 'xss_clean'),
                      array(
                              'field' => 'email1',
                              'label' => 'Email',
                              'rules' => 'xss_clean'),
                      array(
                              'field' => 'additionals',
                              'label' => 'Additional Info',
                              'rules' => 'xss_clean'),
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
              $config['base_url'] = site_url() . 'admin/members/index/';
              $config['use_page_numbers'] = TRUE;
              $config['per_page'] = 100000000000000;
              $config['total_rows'] = $this->members_m->count();
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

         private function set_upload_options($controller, $field)
         {
              //upload an image options
              $config = array();
              if ($field == 'passport')
              {
                   $config['upload_path'] = FCPATH . 'uploads/' . $controller . '/files/';
                   $config['allowed_types'] = 'pdf';
                   $config['max_size'] = '2048';
                   $config['encrypt_name'] = TRUE;
              }
              //create controller upload folder if not exists
              if (!is_dir($config['upload_path']))
              {
                   mkdir(FCPATH . "uploads/$controller/", 777, TRUE);
                   mkdir(FCPATH . "uploads/$controller/thumbs/", 777, TRUE);
              }

              return $config;
         }

    }
    