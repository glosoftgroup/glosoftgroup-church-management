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
              $this->load->model('donations_m');
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

              $data['donations'] = $this->donations_m->paginate_all($config['per_page'], $page);

              //create pagination links
              $data['links'] = $this->pagination->create_links();
              $data['updType'] = 'edit';
              //page number  variable
              $data['page'] = $page;
              $data['per'] = $config['per_page'];

              //load view
              $this->template->title(' Donations ')->build('admin/list', $data);
         }

         /**
          * Add New Donations 
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
                           'donor' => $this->input->post('donor'),
                           'phone' => $this->input->post('phone'),
                           'email' => $this->input->post('email'),
                           'address' => $this->input->post('address'),
                           'country' => $this->input->post('country'),
                           'city' => $this->input->post('city'),
                           'donation_type' => $this->input->post('donation_type'),
                           'pledged_amount' => $this->input->post('pledged_amount'),
                           'value' => $this->input->post('value'),
                           'description' => $this->input->post('description'),
                           'created_by' => $user->id,
                           'created_on' => time()
                   );

                   $ok = $this->donations_m->create($form_data);

                   if ($ok) // the information has therefore been successfully saved in the db
                   {
                        $this->sync->log_new('donations', array($ok));
                        //*********************SMS Givers ***********************

                        $bal = $this->sms_m->get_counter_balance();

                        if (!$bal->balance == 0)
                        {
                             $gtype = refNo() . '/' . date('m/y', time());
                             $country_code = '254';

                             $ph = $this->input->post('phone');
                             $fname = $this->input->post('donor');
                             $cha = array('(', ')', '-', ' ');
                             $sp = array('', '', '');
                             $recipient = str_replace($cha, $sp, $ph);

                             //$new_number = substr_replace($recipient, '+'.$country_code, 0, ($recipient[0] == '0'));
                             $message = 'Hi ' . $fname . ', Confirmed your Donation has been received. We thank you for supporting ministry may you be blessed';
                             $from = "KEYPAD";

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

                             $this->sms_m->create($form_data);

                             //Update SMS counter table

                             $tt = ($bal->balance - 1);
                             $sms = array(
                                     'balance' => $tt,
                                     'modified_by' => $user->id,
                                     'modified_on' => time());

                             $this->sms_m->update_counter($sms);
                        }
                        // print_r($message.'/'.$new_number);die;

                        $this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Donations ' . lang('web_create_success')));
                   }
                   else
                   {
                        $this->session->set_flashdata('error', array('type' => 'error', 'text' => 'Donations ' . lang('web_create_failed')));
                   }

                   redirect('admin/donations/');
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
                   $this->template->title('Add Donations ')->build('admin/create', $data);
              }
         }

         /**
          * Edit  Donations 
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
                   redirect('admin/donations/');
              }
              if (!$this->donations_m->exists($id))
              {
                   $this->session->set_flashdata('error', array('type' => 'warning', 'text' => lang('web_object_not_exist')));
                   redirect('admin/donations');
              }
              //search the item to show in edit form
              $get = $this->donations_m->find($id);

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
                           'donor' => $this->input->post('donor'),
                           'phone' => $this->input->post('phone'),
                           'email' => $this->input->post('email'),
                           'address' => $this->input->post('address'),
                           'country' => $this->input->post('country'),
                           'city' => $this->input->post('city'),
                           'donation_type' => $this->input->post('donation_type'),
                           'pledged_amount' => $this->input->post('pledged_amount'),
                           'value' => $this->input->post('value'),
                           'description' => $this->input->post('description'),
                           'modified_by' => $user->id,
                           'modified_on' => time());

                   $done = $this->donations_m->update_attributes($id, $form_data);

                   // the information has therefore been successfully saved in the db
                   if ($done)
                   {
                        $this->sync->log_update('donations', $id, $form_data);
                        $this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Donations ' . lang('web_edit_success')));
                        redirect("admin/donations/");
                   }
                   else
                   {
                        $this->session->set_flashdata('error', array('type' => 'error', 'text' => $done->errors->full_messages()));
                        redirect("admin/donations/");
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
              $this->template->title('Edit Donations ')->build('admin/create', $data);
         }

         function delete($id = NULL, $page = 1)
         {
              //filter & Sanitize $id
              $id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;

              //redirect if its not correct
              if (!$id)
              {
                   $this->session->set_flashdata('error', array('type' => 'warning', 'text' => lang('web_object_not_exist')));

                   redirect('admin/donations');
              }

              //search the item to delete
              if (!$this->donations_m->exists($id))
              {
                   $this->session->set_flashdata('error', array('type' => 'warning', 'text' => lang('web_object_not_exist')));

                   redirect('admin/donations');
              }

              //delete the item
              if ($this->donations_m->delete($id) == TRUE)
              {
                   $this->sync->log_delete('donations', $id);
                   $this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Donations ' . lang('web_delete_success')));
              }
              else
              {
                   $this->session->set_flashdata('error', array('type' => 'error', 'text' => lang('web_delete_failed')));
              }

              redirect("admin/donations/");
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
                              'field' => 'donor',
                              'label' => 'donor',
                              'rules' => 'required|trim|xss_clean|min_length[0]|max_length[60]'),
                      array(
                              'field' => 'phone',
                              'label' => 'Phone',
                              'rules' => 'required|trim|xss_clean|min_length[0]|max_length[60]'),
                      array(
                              'field' => 'email',
                              'label' => 'Email',
                              'rules' => 'required|trim|valid_email|xss_clean|min_length[0]|max_length[60]'),
                      array(
                              'field' => 'address',
                              'label' => 'Address',
                              'rules' => 'trim|xss_clean|min_length[0]|max_length[500]'),
                      array(
                              'field' => 'country',
                              'label' => 'Country',
                              'rules' => 'required|xss_clean'),
                      array(
                              'field' => 'city',
                              'label' => 'City',
                              'rules' => 'required|trim|xss_clean|min_length[0]|max_length[60]'),
                      array(
                              'field' => 'donation_type',
                              'label' => 'Donation Type',
                              'rules' => 'required|trim|xss_clean|min_length[0]|max_length[60]'),
                      array(
                              'field' => 'pledged_amount',
                              'label' => 'Pledged Amount',
                              'rules' => 'required|trim|xss_clean|min_length[0]|max_length[60]'),
                      array(
                              'field' => 'value',
                              'label' => 'Value',
                              'rules' => 'trim|xss_clean|min_length[0]|max_length[60]'),
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
              $config['base_url'] = site_url() . 'admin/donations/index/';
              $config['use_page_numbers'] = TRUE;
              $config['per_page'] = 10;
              $config['total_rows'] = $this->donations_m->count();
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
    