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
              $this->load->model('visitors_m');
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

              $data['visitors'] = $this->visitors_m->paginate_all($config['per_page'], $page);

              //create pagination links
              $data['links'] = $this->pagination->create_links();
              $data['updType'] = 'edit';
              //page number  variable
              $data['page'] = $page;
              $data['per'] = $config['per_page'];

              //load view
              $this->template->title(' Visitors ')->build('admin/list', $data);
         }

         /**
          * Add New Visitors 
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
                           'visit_date' => strtotime($this->input->post('visit_date')),
                           'first_name' => $this->input->post('first_name'),
                           'last_name' => $this->input->post('last_name'),
                           'gender' => $this->input->post('gender'),
                           'phone' => $this->input->post('phone'),
                           'email' => $this->input->post('email'),
                           'county' => $this->input->post('county'),
                           'location' => $this->input->post('location'),
                           'directed_by' => $this->input->post('directed_by'),
                           'interested_in_membership' => $this->input->post('interested_in_membership'),
                           'saved' => $this->input->post('saved'),
                           'baptised' => $this->input->post('baptised'),
                           'know_more' => $this->input->post('know_more'),
                           'ministries_interest' => $this->input->post('ministries_interest'),
                           'come_back' => $this->input->post('come_back'),
                           'additionals' => $this->input->post('additionals'),
                           'created_by' => $user->id,
                           'created_on' => time()
                   );

                   $ok = $this->visitors_m->create($form_data);

                   if ($ok) // the information has therefore been successfully saved in the db
                   {
                        $this->sync->log_new('visitors', array($ok));
                        //*********************SMS VISITOR ***********************

                        $bal = $this->sms_m->get_counter_balance();

                        if (!$bal->balance == 0)
                        {
                             $gtype = refNo() . '/' . date('m/y', time());

                             $ph = $this->input->post('phone');
                             $fname = $this->input->post('first_name');
                             $cha = array('(', ')', '-', ' ');
                             $sp = array('', '', '');
                             $recipient = str_replace($cha, $sp, $ph);
                             $message = 'Hi ' . $fname . ', we thank you for visiting our sanctuary. Be blessed and welcome all the times';

                             $this->sms_m->send_sms($recipient, $message);

                             $form_data = array(
                                     'recipient' => $ok,
                                     'status' => 1,
                                     'message' => $message,
                                     'sent_to' => 'church visitor',
                                     'group_type' => $gtype,
                                     'created_by' => $user->id,
                                     'created_on' => time()
                             );

                             $sm = $this->sms_m->create($form_data);
                             $this->sync->log_new('sms', array($sm));
                             //Update SMS counter table

                             $tt = ($bal->balance - 1);
                             $sms = array(
                                     'balance' => $tt,
                                     'modified_by' => $user->id,
                                     'modified_on' => time());

                             $this->sms_m->update_counter($sms);
                        }

                        $this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Visitors ' . lang('web_create_success')));
                   }
                   else
                   {
                        $this->session->set_flashdata('error', array('type' => 'error', 'text' => 'Visitors ' . lang('web_create_failed')));
                   }

                   redirect('admin/visitors/');
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
                   //load the view and the layout
                   $this->template->title('Add Visitors ')->build('admin/create', $data);
              }
         }

         /**
          * Edit  Visitors 
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
                   redirect('admin/visitors/');
              }
              if (!$this->visitors_m->exists($id))
              {
                   $this->session->set_flashdata('error', array('type' => 'warning', 'text' => lang('web_object_not_exist')));
                   redirect('admin/visitors');
              }
              //search the item to show in edit form
              $get = $this->visitors_m->find($id);

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
                           'visit_date' => strtotime($this->input->post('visit_date')),
                           'first_name' => $this->input->post('first_name'),
                           'last_name' => $this->input->post('last_name'),
                           'gender' => $this->input->post('gender'),
                           'phone' => $this->input->post('phone'),
                           'email' => $this->input->post('email'),
                           'county' => $this->input->post('county'),
                           'location' => $this->input->post('location'),
                           'directed_by' => $this->input->post('directed_by'),
                           'interested_in_membership' => $this->input->post('interested_in_membership'),
                           'saved' => $this->input->post('saved'),
                           'baptised' => $this->input->post('baptised'),
                           'know_more' => $this->input->post('know_more'),
                           'ministries_interest' => $this->input->post('ministries_interest'),
                           'come_back' => $this->input->post('come_back'),
                           'additionals' => $this->input->post('additionals'),
                           'modified_by' => $user->id,
                           'modified_on' => time());

                   $done = $this->visitors_m->update_attributes($id, $form_data);

                   // the information has therefore been successfully saved in the db
                   if ($done)
                   {
                        $this->sync->log_update('visitors', $id, $form_data);
                        $this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Visitors ' . lang('web_edit_success')));
                        redirect("admin/visitors/");
                   }
                   else
                   {
                        $this->session->set_flashdata('error', array('type' => 'error', 'text' => $done->errors->full_messages()));
                        redirect("admin/visitors/");
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
              $data['p'] = $get;
              //load the view and the layout
              $this->template->title('Edit Visitors ')->build('admin/create', $data);
         }

         function delete($id = NULL, $page = 1)
         {
              //redirect if its not correct
              if (!$id)
              {
                   $this->session->set_flashdata('error', array('type' => 'warning', 'text' => lang('web_object_not_exist')));
                   redirect('admin/visitors');
              }

              //search the item to delete
              if (!$this->visitors_m->exists($id))
              {
                   $this->session->set_flashdata('error', array('type' => 'warning', 'text' => lang('web_object_not_exist')));

                   redirect('admin/visitors');
              }

              //delete the item
              if ($this->visitors_m->delete($id) == TRUE)
              {
                   $this->sync->log_delete('visitors', $id);
                   $this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Visitors ' . lang('web_delete_success')));
              }
              else
              {
                   $this->session->set_flashdata('error', array('type' => 'error', 'text' => lang('web_delete_failed')));
              }

              redirect("admin/visitors/");
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
                              'field' => 'visit_date',
                              'label' => 'Visit Date',
                              'rules' => 'required|xss_clean'),
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
                              'rules' => 'required|trim|xss_clean|min_length[0]|max_length[60]'),
                      array(
                              'field' => 'phone',
                              'label' => 'Phone',
                              'rules' => 'required|trim|xss_clean|min_length[0]|max_length[60]'),
                      array(
                              'field' => 'email',
                              'label' => 'Email',
                              'rules' => 'trim|xss_clean|min_length[0]|max_length[60]'),
                      array(
                              'field' => 'county',
                              'label' => 'County',
                              'rules' => 'required|trim|xss_clean|min_length[0]|max_length[60]'),
                      array(
                              'field' => 'location',
                              'label' => 'Location',
                              'rules' => 'required|trim|xss_clean|min_length[0]|max_length[60]'),
                      array(
                              'field' => 'directed_by',
                              'label' => 'Directed By',
                              'rules' => 'required|trim|xss_clean|min_length[0]|max_length[60]'),
                      array(
                              'field' => 'interested_in_membership',
                              'label' => 'Interested In Membership',
                              'rules' => 'xss_clean'),
                      array(
                              'field' => 'saved',
                              'label' => 'Saved',
                              'rules' => 'xss_clean'),
                      array(
                              'field' => 'baptised',
                              'label' => 'Baptised',
                              'rules' => 'xss_clean'),
                      array(
                              'field' => 'know_more',
                              'label' => 'Know More',
                              'rules' => 'xss_clean'),
                      array(
                              'field' => 'ministries_interest',
                              'label' => 'Ministries Interest',
                              'rules' => 'xss_clean'),
                      array(
                              'field' => 'come_back',
                              'label' => 'Come Back',
                              'rules' => 'xss_clean'),
                      array(
                              'field' => 'additionals',
                              'label' => 'Additionals',
                              'rules' => 'trim|xss_clean|min_length[0]|max_length[1000]'),
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
              $config['base_url'] = site_url() . 'admin/visitors/index/';
              $config['use_page_numbers'] = TRUE;
              $config['per_page'] = 10;
              $config['total_rows'] = $this->visitors_m->count();
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
    