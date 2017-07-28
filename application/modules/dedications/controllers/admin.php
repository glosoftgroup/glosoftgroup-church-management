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
              $this->load->model('dedications_m');
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

              $data['dedications'] = $this->dedications_m->paginate_all($config['per_page'], $page);

              //create pagination links
              $data['links'] = $this->pagination->create_links();

              //page number  variable
              $data['page'] = $page;
              $data['per'] = $config['per_page'];

              //load view
              //$data['member'] = $this->ion_auth->get_member('members','id','first_name'.' '.'last_name');
              $this->template->title(' Dedications ')->build('admin/list', $data);
         }

         /**
          * Add New Dedications 
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
              $this->form_validation->set_rules($this->valid_parent());

              //validate the fields of form
              if ($this->form_validation->run())
              {
                   //Validation OK!
                   $user = $this->ion_auth->get_user();
                   $form_data = array(
                           'date' => strtotime($this->input->post('date')),
                           'first_name' => $this->input->post('first_name'),
                           'middle_name' => $this->input->post('middle_name'),
                           'last_name' => $this->input->post('last_name'),
                           'gender' => $this->input->post('gender'),
                           'dob' => strtotime($this->input->post('dob')),
                           'location' => $this->input->post('location'),
                           'country' => $this->input->post('country'),
                           'status' => 0,
                           'type' => $this->input->post('option'),
                           'father' => $this->input->post('father'),
                           'mother' => $this->input->post('mother'),
                           'city' => $this->input->post('city'),
                           'expected_dedication_date' => strtotime($this->input->post('expected_dedication_date')),
                           'service_type' => $this->input->post('service_type'),
                           'description' => $this->input->post('description'),
                           'created_by' => $user->id,
                           'created_on' => time()
                   );

                   $ok = $this->dedications_m->create($form_data);

                   if ($ok) // the information has therefore been successfully saved in the db
                   {
                        $this->sync->log_new('dedications', array($ok));
                        if ($this->input->post('option') == 0)
                        {
                             $length = $this->input->post('type');
                             $size = count($length);

                             for ($i = 0; $i < $size; ++$i)
                             {
                                  $type = $this->input->post('type');
                                  $first_name = $this->input->post('first_name1');
                                  $last_name = $this->input->post('last_name1');
                                  $phone = $this->input->post('phone');
                                  $email = $this->input->post('email');
                                  $address = $this->input->post('address');

                                  $paro_details = array(
                                          'child_id' => $ok,
                                          'type' => $type[$i],
                                          'first_name' => $first_name[$i],
                                          'last_name' => $last_name[$i],
                                          'email' => $email[$i],
                                          'phone' => $phone[$i],
                                          'address' => $address[$i],
                                          'created_by' => $user->id,
                                          'created_on' => time()
                                  );
                                  //Insert Members Tithe
                                  $data = $this->dedications_m->insert_paro($paro_details);
                             }
                        }
                        $this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Dedications ' . lang('web_create_success')));
                   }
                   else
                   {
                        $this->session->set_flashdata('error', array('type' => 'error', 'text' => 'Dedications ' . lang('web_create_failed')));
                   }

                   redirect('admin/dedications/');
              }
              else
              {
                   $get = new StdClass();
                   $post = new StdClass();
                   foreach ($this->validation() as $field)
                   {
                        $fn = $field['field'];
                        $get->$fn = set_value($fn);
                   }

                   foreach ($this->valid_parent() as $field)
                   {
                        $post->$field['field'] = set_value($field['field']);
                   }

                   $data['result'] = $get;
                   $data['post'] = $post;
                   $data['parents'] = $this->ion_auth->get_member();
                   //load the view and the layout
                   $this->template->title('Add Child For Dedication ')->build('admin/create', $data);
              }
         }

         /**
          * Edit  Dedications 
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
                   redirect('admin/dedications/');
              }
              if (!$this->dedications_m->exists($id))
              {
                   $this->session->set_flashdata('error', array('type' => 'warning', 'text' => lang('web_object_not_exist')));
                   redirect('admin/dedications');
              }
              //search the item to show in edit form
              $get = $this->dedications_m->find($id);
              if ($get->type == 0)
              {
                   $data['cfd_parents'] = $this->dedications_m->get_parents($id);
              }
              elseif ($get->type == 1)
              {
                   $data['cfd_parents'] = $this->dedications_m->get_mmparents($get->father, $get->mother);
              }

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
                           'first_name' => $this->input->post('first_name'),
                           'middle_name' => $this->input->post('middle_name'),
                           'last_name' => $this->input->post('last_name'),
                           'gender' => $this->input->post('gender'),
                           'dob' => strtotime($this->input->post('dob')),
                           'location' => $this->input->post('location'),
                           'country' => $this->input->post('country'),
                           'city' => $this->input->post('city'),
                           'expected_dedication_date' => strtotime($this->input->post('expected_dedication_date')),
                           'service_type' => $this->input->post('service_type'),
                           'description' => $this->input->post('description'),
                           'modified_by' => $user->id,
                           'modified_on' => time());

                   $done = $this->dedications_m->update_attributes($id, $form_data);

                   // the information has therefore been successfully saved in the db
                   if ($done)
                   {
                        $this->sync->log_update('dedications', $id, $form_data);
                        $this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Dedications ' . lang('web_edit_success')));
                        redirect("admin/dedications/");
                   }
                   else
                   {
                        $this->session->set_flashdata('error', array('type' => 'error', 'text' => $done->errors->full_messages()));
                        redirect("admin/dedications/");
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
              $this->template->title('Edit Child For Dedication ')->build('admin/edit', $data);
         }

         /**
          * Update status Dedications 
          *
          * @param $id
          * @param $page
          */
         function dedicate($id = FALSE, $page = 0)
         {

              //redirect if no $id
              if (!$id)
              {
                   $this->session->set_flashdata('error', array('type' => 'warning', 'text' => lang('web_object_not_exist')));
                   redirect('admin/dedications/');
              }
              if (!$this->dedications_m->exists($id))
              {
                   $this->session->set_flashdata('error', array('type' => 'warning', 'text' => lang('web_object_not_exist')));
                   redirect('admin/dedications');
              }

              $user = $this->ion_auth->get_user();
              // build array for the model
              $form_data = array(
                      'status' => 1,
                      'modified_by' => $user->id,
                      'modified_on' => time());

              $done = $this->dedications_m->update_attributes($id, $form_data);
              $this->sync->log_update('dedications', $id, $form_data);
              // the information has therefore been successfully saved in the db
              if ($done)
              {
                   $this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Dedications ' . lang('web_edit_success')));
                   redirect("admin/dedications/");
              }
              else
              {
                   $this->session->set_flashdata('error', array('type' => 'error', 'text' => $done->errors->full_messages()));
                   redirect("admin/dedications/");
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

                   redirect('admin/dedications');
              }

              //search the item to delete
              if (!$this->dedications_m->exists($id))
              {
                   $this->session->set_flashdata('error', array('type' => 'warning', 'text' => lang('web_object_not_exist')));

                   redirect('admin/dedications');
              }

              //delete the item
              if ($this->dedications_m->delete($id) == TRUE)
              {
                   $this->sync->log_delete('dedications', $id);
                   $this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Dedications ' . lang('web_delete_success')));
              }
              else
              {
                   $this->session->set_flashdata('error', array('type' => 'error', 'text' => lang('web_delete_failed')));
              }

              redirect("admin/dedications/");
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
                              'field' => 'first_name',
                              'label' => 'First Name',
                              'rules' => 'required|trim|xss_clean|min_length[0]|max_length[60]'),
                      array(
                              'field' => 'middle_name',
                              'label' => 'Middle Name',
                              'rules' => 'trim|xss_clean|min_length[0]|max_length[60]'),
                      array(
                              'field' => 'last_name',
                              'label' => 'Last Name',
                              'rules' => 'required|trim|xss_clean|min_length[0]|max_length[60]'),
                      array(
                              'field' => 'gender',
                              'label' => 'Gender',
                              'rules' => 'required|trim|xss_clean|min_length[0]|max_length[60]'),
                      array(
                              'field' => 'dob',
                              'label' => 'Dob',
                              'rules' => 'required|xss_clean'),
                      array(
                              'field' => 'option',
                              'label' => 'Parent',
                              'rules' => 'xss_clean'),
                      array(
                              'field' => 'location',
                              'label' => 'Location',
                              'rules' => 'trim|xss_clean|min_length[0]|max_length[60]'),
                      array(
                              'field' => 'country',
                              'label' => 'Country',
                              'rules' => 'required|trim|xss_clean|min_length[0]|max_length[60]'),
                      array(
                              'field' => 'city',
                              'label' => 'City',
                              'rules' => 'required|trim|xss_clean|min_length[0]|max_length[60]'),
                      array(
                              'field' => 'expected_dedication_date',
                              'label' => 'Expected Dedication Date',
                              'rules' => 'required|xss_clean'),
                      array(
                              'field' => 'service_type',
                              'label' => 'Service Type',
                              'rules' => 'required|trim|xss_clean|min_length[0]|max_length[60]'),
                      array(
                              'field' => 'description',
                              'label' => 'Description',
                              'rules' => 'trim|xss_clean|min_length[0]|max_length[500]'),
              );
              $this->form_validation->set_error_delimiters("<br /><span class='error'>", '</span>');
              return $config;
         }

         /**
          * Generate Validation Rules
          *
          * @return array()
          */
         private function valid_parent()
         {
              $config = array(
                      array(
                              'field' => 'type',
                              'label' => 'Type',
                              'rules' => ''),
                      array(
                              'field' => 'first_name1',
                              'label' => 'First Name',
                              'rules' => ''),
                      array(
                              'field' => 'last_name1',
                              'label' => 'Last Name',
                              'rules' => ''),
                      array(
                              'field' => 'phone',
                              'label' => 'Phone',
                              'rules' => ''),
                      array(
                              'field' => 'email',
                              'label' => 'Email',
                              'rules' => ''),
                      array(
                              'field' => 'address',
                              'label' => 'Address',
                              'rules' => ''),
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
              $config['base_url'] = site_url() . 'admin/dedications/index/';
              $config['use_page_numbers'] = TRUE;
              $config['per_page'] = 10;
              $config['total_rows'] = $this->dedications_m->count();
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
    