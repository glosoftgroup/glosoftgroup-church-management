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
              $this->load->model('pledges_m');
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

              $pledges = $this->pledges_m->paginate_all($config['per_page'], $page);
              $data['pledges'] = $pledges;

              //create pagination links
              $data['links'] = $this->pagination->create_links();

              //page number  variable
              $data['page'] = $page;
              $data['per'] = $config['per_page'];
              $data['users'] = $this->ion_auth->list_users();
              $data['banks'] = $this->pledges_m->get_banks();
              if ($pledges)
              {
                   foreach ($pledges as $pp)
                   {

                        $paid = $this->pledges_m->total_paid($pp->id);
                        $pp->paid = $paid;
                   }
              }

              $data['members'] = $this->ion_auth->get_members();
              //load view
              $this->template->title(' Pledges ')->build('admin/list', $data);
         }

         public function paid()
         {
              $config = $this->set_paginate_options();  //Initialize the pagination class
              $this->pagination->initialize($config);

              $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 1;

              $data['pledges'] = $this->pledges_m->paid($config['per_page'], $page);

              //create pagination links
              $data['links'] = $this->pagination->create_links();

              //page number  variable
              $data['page'] = $page;
              $data['per'] = $config['per_page'];
              $data['users'] = $this->ion_auth->list_users();
              $data['members'] = $this->ion_auth->get_members();
              $data['banks'] = $this->pledges_m->get_banks();
              //load view
              $this->template->title('Paid Pledges ')->build('admin/paid', $data);
         }

         public function voided()
         {
              $config = $this->set_paginate_options();  //Initialize the pagination class
              $this->pagination->initialize($config);

              $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 1;

              $data['pledges'] = $this->pledges_m->voided($config['per_page'], $page);

              //create pagination links
              $data['links'] = $this->pagination->create_links();

              //page number  variable
              $data['page'] = $page;
              $data['per'] = $config['per_page'];
              $data['users'] = $this->ion_auth->list_users();
              $data['members'] = $this->ion_auth->get_members();
              //load view
              $this->template->title('Voided Pledges ')->build('admin/voided', $data);
         }

         public function pending()
         {
              $config = $this->set_paginate_options();  //Initialize the pagination class
              $this->pagination->initialize($config);

              $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 1;

              $pledges = $this->pledges_m->pending($config['per_page'], $page);

              foreach ($pledges as $pp)
              {

                   $paid = $this->pledges_m->total_paid($pp->id);
                   $pp->paid = $paid;
              }

              $data['pledges'] = $pledges;
              $data['banks'] = $this->pledges_m->get_banks();

              //create pagination links
              $data['links'] = $this->pagination->create_links();

              //page number  variable
              $data['page'] = $page;
              $data['per'] = $config['per_page'];
              $data['users'] = $this->ion_auth->list_users();
              $data['members'] = $this->ion_auth->get_members();
              //load view
              $this->template->title(' Pending Pledges ')->build('admin/list', $data);
         }

         /**
          * Add New Pledges 
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
                   $user = $this->ion_auth->get_user();
                   $form_data = array(
                           'date' => strtotime($this->input->post('date')),
                           'title' => $this->input->post('title'),
                           'others' => $this->input->post('others'),
                           'member' => $this->input->post('member'),
                           'amount' => $this->input->post('amount'),
                           'expected_pay_date' => strtotime($this->input->post('expected_pay_date')),
                           'status' => 1,
                           'remarks' => $this->input->post('remarks'),
                           'created_by' => $user->id,
                           'created_on' => time()
                   );

                   $ok = $this->pledges_m->create($form_data);

                   if ($ok) // the information has therefore been successfully saved in the db
                   {
                        $this->sync->log_new('pledges', array($ok));
                        $this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Pledges ' . lang('web_create_success')));
                   }
                   else
                   {
                        $this->session->set_flashdata('error', array('type' => 'error', 'text' => 'Pledges ' . lang('web_create_failed')));
                   }

                   redirect('admin/pledges/');
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
                   $data['users'] = $this->ion_auth->list_users();
                   $data['members'] = $this->ion_auth->get_members();
                   //load the view and the layout
                   $this->template->title('Add Pledges ')->build('admin/create', $data);
              }
         }

         //RECORD PLEDGE PAYMENT

         function payment($id)
         {
              //redirect if no $id
              if (!$id)
              {
                   $this->session->set_flashdata('error', array('type' => 'warning', 'text' => lang('web_object_not_exist')));
                   redirect('admin/pledges/');
              }
              if (!$this->pledges_m->exists($id))
              {
                   $this->session->set_flashdata('error', array('type' => 'warning', 'text' => lang('web_object_not_exist')));
                   redirect('admin/pledges');
              }
              //search the item to show in edit form
              $get = $this->pledges_m->find($id);
              $bal = ($get->amount) - ($this->input->post('amount'));

              $user = $this->ion_auth->get_user();
              $form_data = array(
                      'pledge_id' => $id,
                      'date' => time(),
                      'amount' => $this->input->post('amount'),
                      'bank' => $this->input->post('bank'),
                      'remarks' => $this->input->post('remarks'),
                      'transaction_no' => $this->input->post('transaction_no'),
                      'payment_method' => $this->input->post('payment_method'),
                      'balance' => $bal,
                      'status' => 1,
                      'created_by' => $user->id,
                      'created_on' => time()
              );

              $pd = $this->pledges_m->insert_payment($form_data);
              $this->sync->log_new('paid_pledges', array($pd));
              $status = $get->status;
              if ($bal == 0)
              {
                   $status = 2;
              }
              // build array for the model
              $form_update = array(
                      'amount' => $bal,
                      'status' => $status,
                      'modified_by' => $user->id,
                      'modified_on' => time());

              $done = $this->pledges_m->update_attributes($id, $form_update);
              $this->sync->log_update('pledges', $id, $form_update);
              // the information has therefore been successfully saved in the db
              if ($done)
              {
                   //Update Logs
                   $log = array(
                           'collection_id' => $done,
                           'amount' => $this->input->post('amount'),
                           'type' => 'pledges',
                           'created_by' => $user->id,
                           'created_on' => time());

                   $col = $this->portal_m->collection_log($log);
                   $this->sync->log_new('collections_log', array($col));
                   //*********************SMS Givers ***********************

                   $sms_bal = $this->sms_m->get_counter_balance();

                   if (!$sms_bal->balance == 0)
                   {
                        $member = $this->sms_m->get_member($get->member);
                        $gtype = refNo() . '/' . date('m/y', time());
                        $country_code = '254';

                        $ph = $member->phone1;
                        $fname = $member->first_name;
                        $amt = $this->input->post('amount');
                        $cha = array('(', ')', '-', ' ');
                        $sp = array('', '', '');
                        $recipient = str_replace($cha, $sp, $ph);

                        $settings = $this->settings;
                        $initial = $settings->sms_initial;
                          $message = '';
                        if ($bal == 0)
                        {
                             $message = $initial . ' ' . $fname . ', Confirmed your Pledge ' . number_format($amt) . ' has been received. We thank you for supporting  ministry may you be blessed';
                        }
                        else
                        {
                             $message = $initial . ' ' . $fname . ', Confirmed your Pledge ' . number_format($amt) . ' has been received. Balance is ' . number_format($bal) . '. We thank you for supporting ministry may you be blessed';
                        }
                        $this->sms_m->send_sms($recipient, $message);

                        $form_data = array(
                                'recipient' => $get->member,
                                'status' => 1,
                                'message' => $message,
                                'sent_to' => 'church member',
                                'group_type' => $gtype,
                                'created_by' => $user->id,
                                'created_on' => time()
                        );

                        $sn = $this->sms_m->create($form_data);
                        $this->sync->log_new('sms', array($sn));
                        //Update SMS counter table

                        $tt = ($sms_bal->balance - 1);
                        $sms = array(
                                'balance' => $tt,
                                'modified_by' => $user->id,
                                'modified_on' => time());

                        $this->sms_m->update_counter($sms);
                   }
                   $this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Pledge Payment has been successfully recorded '));
                   redirect("admin/pledges/");
              }
              else
              {
                   $this->session->set_flashdata('error', array('type' => 'error', 'text' => $done->errors->full_messages()));
                   redirect("admin/pledges/");
              }
         }

         /**
          * Edit  Pledges 
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
                   redirect('admin/pledges/');
              }
              if (!$this->pledges_m->exists($id))
              {
                   $this->session->set_flashdata('error', array('type' => 'warning', 'text' => lang('web_object_not_exist')));
                   redirect('admin/pledges');
              }
              //search the item to show in edit form
              $get = $this->pledges_m->find($id);

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
                           'title' => $this->input->post('title'),
                           'others' => $this->input->post('others'),
                           'member' => $this->input->post('member'),
                           'amount' => $this->input->post('amount'),
                           'expected_pay_date' => strtotime($this->input->post('expected_pay_date')),
                           'remarks' => $this->input->post('remarks'),
                           'modified_by' => $user->id,
                           'modified_on' => time());

                   $done = $this->pledges_m->update_attributes($id, $form_data);

                   // the information has therefore been successfully saved in the db
                   if ($done)
                   {
                        $this->sync->log_update('pledges', $id, $form_data);
                        $this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Pledges ' . lang('web_edit_success')));
                        redirect("admin/pledges/");
                   }
                   else
                   {
                        $this->session->set_flashdata('error', array('type' => 'error', 'text' => $done->errors->full_messages()));
                        redirect("admin/pledges/");
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
              $data['users'] = $this->ion_auth->list_users();
              $data['members'] = $this->ion_auth->get_members();
              //load the view and the layout
              $this->template->title('Edit Pledges ')->build('admin/create', $data);
         }

         function void($id = NULL, $page = 1)
         {

              //filter & Sanitize $id
              $id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;

              //redirect if its not correct
              if (!$id)
              {
                   $this->session->set_flashdata('error', array('type' => 'warning', 'text' => lang('web_object_not_exist')));

                   redirect('admin/pledges');
              }

              //search the item to delete
              if (!$this->pledges_m->exists($id))
              {
                   $this->session->set_flashdata('error', array('type' => 'warning', 'text' => lang('web_object_not_exist')));

                   redirect('admin/pledges');
              }

              $user = $this->ion_auth->get_user();
              // build array for the model
              $form_data = array(
                      'status' => 0,
                      'modified_by' => $user->id,
                      'modified_on' => time());

              $done = $this->pledges_m->update_attributes($id, $form_data);

              // the information has therefore been successfully saved in the db
              if ($done)
              {
                   $this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Pledges ' . lang('web_edit_success')));
                   redirect("admin/pledges/");
              }
              else
              {
                   $this->session->set_flashdata('error', array('type' => 'error', 'text' => $done->errors->full_messages()));
                   redirect("admin/pledges/");
              }
         }

         function void_paid($id = NULL, $page = 1)
         {

              //filter & Sanitize $id
              $id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;

              //redirect if its not correct
              if (!$id)
              {
                   $this->session->set_flashdata('error', array('type' => 'warning', 'text' => lang('web_object_not_exist')));

                   redirect('admin/pledges');
              }

              //search the item to delete
              if (!$this->pledges_m->exists_payment($id))
              {
                   $this->session->set_flashdata('error', array('type' => 'warning', 'text' => lang('web_object_not_exist')));

                   redirect('admin/pledges');
              }

              $get_paid = $this->pledges_m->get_paid($id);
              $get = $this->pledges_m->find($get_paid->pledge_id);



              $total = $get_paid->amount + $get->amount;

              //print_r($total);die;

              $user = $this->ion_auth->get_user();
              // build array for the model
              $form_data = array(
                      'amount' => $total,
                      'status' => 1,
                      'modified_by' => $user->id,
                      'modified_on' => time());

              $done = $this->pledges_m->update_attributes($id, $form_data);



              // the information has therefore been successfully saved in the db
              if ($done)
              {
                   $update_paid = array(
                           'status' => 0,
                           'modified_by' => $user->id,
                           'modified_on' => time());

                   $this->pledges_m->update_paid($id, $update_paid);

                   $this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Pledges ' . lang('web_edit_success')));
                   redirect("admin/pledges/");
              }
              else
              {
                   $this->session->set_flashdata('error', array('type' => 'error', 'text' => $done->errors->full_messages()));
                   redirect("admin/pledges/");
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

                   redirect('admin/pledges');
              }

              //search the item to delete
              if (!$this->pledges_m->exists($id))
              {
                   $this->session->set_flashdata('error', array('type' => 'warning', 'text' => lang('web_object_not_exist')));
                   redirect('admin/pledges');
              }

              //delete the item
              if ($this->pledges_m->delete($id) == TRUE)
              {
                   $this->sync->log_delete('pledges', $id);
                   $this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Pledges ' . lang('web_delete_success')));
              }
              else
              {
                   $this->session->set_flashdata('error', array('type' => 'error', 'text' => lang('web_delete_failed')));
              }

              redirect("admin/pledges/");
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
                              'field' => 'title',
                              'label' => 'Title',
                              'rules' => 'required|trim|xss_clean|min_length[0]|max_length[60]'),
                      array(
                              'field' => 'member',
                              'label' => 'Member',
                              'rules' => 'required|xss_clean'),
                      array(
                              'field' => 'others',
                              'label' => 'others',
                              'rules' => 'xss_clean'),
                      array(
                              'field' => 'amount',
                              'label' => 'Amount',
                              'rules' => 'required|trim|xss_clean|min_length[0]|max_length[60]'),
                      array(
                              'field' => 'expected_pay_date',
                              'label' => 'Expected Pay Date',
                              'rules' => 'xss_clean'),
                      array(
                              'field' => 'status',
                              'label' => 'Status',
                              'rules' => 'xss_clean'),
                      array(
                              'field' => 'remarks',
                              'label' => 'remarks',
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
              $config['base_url'] = site_url() . 'admin/pledges/index/';
              $config['use_page_numbers'] = TRUE;
              $config['per_page'] = 1000000000;
              $config['total_rows'] = $this->pledges_m->count();
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
    