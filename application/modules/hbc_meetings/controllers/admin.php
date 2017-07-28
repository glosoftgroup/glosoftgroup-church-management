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
              $this->load->model('hbc_meeting_m');
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

              $data['hbc_meetings'] = $this->hbc_meeting_m->paginate_all($config['per_page'], $page);

              //create pagination links
              $data['links'] = $this->pagination->create_links();

              //page number  variable
              $data['page'] = $page;
              $data['per'] = $config['per_page'];
              $data['hbc'] = $this->hbc_meeting_m->populate('hbcs', 'id', 'name');
              //load view
              $this->template->title(' HBC Meetings ')->build('admin/list', $data);
         }

         //meetings per HBC

         public function meetings($id = FALSE)
         {
              $config = $this->set_paginate_options();  //Initialize the pagination class
              $this->pagination->initialize($config);

              $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 1;

              $data['hbc_meetings'] = $this->hbc_meeting_m->meetings($config['per_page'], $page, $id);

              //create pagination links
              $data['links'] = $this->pagination->create_links();

              //page number  variable
              $data['page'] = $page;
              $data['per'] = $config['per_page'];
              $data['hbc'] = $this->hbc_meeting_m->populate('hbcs', 'id', 'name');
              //load view
              $this->template->title(' HBC Meetings ')->build('admin/list', $data);
         }

         /**
          * Add New Hbc Meetings 
          *
          * @param $page
          */
         function add($id = FALSE)
         {
              //create control variables
              //redirect if no $id
              if (!$id)
              {
                   $this->session->set_flashdata('error', array('type' => 'warning', 'text' => lang('web_object_not_exist')));
                   redirect('admin/hbc_meetings/');
              }
              if (!$this->hbc_meeting_m->exists_hbc($id))
              {
                   $this->session->set_flashdata('error', array('type' => 'warning', 'text' => lang('web_object_not_exist')));
                   redirect('admin/hbc_meetings');
              }


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
                           'hbc' => $id,
                           'date' => strtotime($this->input->post('date')),
                           'host' => $this->input->post('host'),
                           'hosts_phone_no' => $this->input->post('hosts_phone_no'),
                           'house_number' => $this->input->post('house_number'),
                           'service_leader' => $this->input->post('service_leader'),
                           'preacher' => $this->input->post('preacher'),
                           'brief_description' => $this->input->post('brief_description'),
                           'created_by' => $user->id,
                           'created_on' => time()
                   );

                   $ok = $this->hbc_meeting_m->create($form_data);

                   if ($ok) // the information has therefore been successfully saved in the db
                   {
                        $this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Hbc Meetings ' . lang('web_create_success')));
                   }
                   else
                   {
                        $this->session->set_flashdata('error', array('type' => 'error', 'text' => 'Hbc Meetings ' . lang('web_create_failed')));
                   }

                   redirect('admin/hbc_meetings/');
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
                   $data['members'] = $this->hbc_meeting_m->get_hbc_members($id);
                   //load the view and the layout
                   $this->template->title('Add Hbc Meetings ')->build('admin/create', $data);
              }
         }

         /**
          * Add New Hbc Meetings 
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
                           'host' => $this->input->post('host'),
                           'hosts_phone_no' => $this->input->post('hosts_phone_no'),
                           'date' => strtotime($this->input->post('date')),
                           'house_number' => $this->input->post('house_number'),
                           'service_leader' => $this->input->post('service_leader'),
                           'preacher' => $this->input->post('preacher'),
                           'brief_description' => $this->input->post('brief_description'),
                           'created_by' => $user->id,
                           'created_on' => time()
                   );

                   $ok = $this->hbc_meeting_m->create($form_data);

                   if ($ok) // the information has therefore been successfully saved in the db
                   {
                        $this->sync->log_new('hbc_meetings', array($ok));
                        $this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Hbc Meetings ' . lang('web_create_success')));
                   }
                   else
                   {
                        $this->session->set_flashdata('error', array('type' => 'error', 'text' => 'Hbc Meetings ' . lang('web_create_failed')));
                   }

                   redirect('admin/hbc_meetings/');
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
                   $data['host'] = $this->ion_auth->get_member('members', 'id', 'first_name');
                   //load the view and the layout
                   $this->template->title('Add Hbc Meetings ')->build('admin/create', $data);
              }
         }

         /**
          * Edit  Hbc Meetings 
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
                   redirect('admin/hbc_meetings/');
              }
              if (!$this->hbc_meeting_m->exists($id))
              {
                   $this->session->set_flashdata('error', array('type' => 'warning', 'text' => lang('web_object_not_exist')));
                   redirect('admin/hbc_meetings');
              }
              //search the item to show in edit form
              $get = $this->hbc_meeting_m->find($id);
              
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
                           'date' => strtotime($this->input->post('date')),
                           'host' => $this->input->post('host'),
                           'hosts_phone_no' => $this->input->post('hosts_phone_no'),
                           'house_number' => $this->input->post('house_number'),
                           'service_leader' => $this->input->post('service_leader'),
                           'preacher' => $this->input->post('preacher'),
                           'brief_description' => $this->input->post('brief_description'),
                           'modified_by' => $user->id,
                           'modified_on' => time());

                   $done = $this->hbc_meeting_m->update_attributes($id, $form_data);

                   // the information has therefore been successfully saved in the db
                   if ($done)
                   {
                        $this->sync->log_update('hbc_meetings', $id, $form_data);
                        $this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Hbc Meetings ' . lang('web_edit_success')));
                        redirect("admin/hbc_meetings/");
                   }
                   else
                   {
                        $this->session->set_flashdata('error', array('type' => 'error', 'text' => $done->errors->full_messages()));
                        redirect("admin/hbc_meetings/");
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

              $data['members'] = $this->hbc_meeting_m->get_hbc_members($get->id);
              //load the view and the layout
              $this->template->title('Edit Hbc Meetings ')->build('admin/create', $data);
         }

         function delete($id = NULL, $page = 1)
         {
              //filter & Sanitize $id
              $id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;

              //redirect if its not correct
              if (!$id)
              {
                   $this->session->set_flashdata('error', array('type' => 'warning', 'text' => lang('web_object_not_exist')));

                   redirect('admin/hbc_meetings');
              }

              //search the item to delete
              if (!$this->hbc_meeting_m->exists($id))
              {
                   $this->session->set_flashdata('message', array('type' => 'warning', 'text' => lang('web_object_not_exist')));

                   redirect('admin/hbc_meetings');
              }

              //delete the item
              if ($this->hbc_meeting_m->delete($id) == TRUE)
              {
                   $this->sync->log_delete('hbc_meetings', $id);
                   $this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Hbc Meetings ' . lang('web_delete_success')));
              }
              else
              {
                   $this->session->set_flashdata('error', array('type' => 'error', 'text' => lang('web_delete_failed')));
              }

              redirect("admin/hbc_meetings/");
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
                              'rules' => 'required|trim'),
                      array(
                              'field' => 'host',
                              'label' => 'Host',
                              'rules' => 'required|trim|xss_clean|min_length[0]|max_length[60]'),
                      array(
                              'field' => 'hosts_phone_no',
                              'label' => 'Hosts Phone No',
                              'rules' => 'trim|xss_clean|min_length[0]|max_length[60]'),
                      array(
                              'field' => 'house_number',
                              'label' => 'House Number',
                              'rules' => 'required|trim|xss_clean|min_length[0]|max_length[60]'),
                      array(
                              'field' => 'service_leader',
                              'label' => 'Service Leader',
                              'rules' => 'required|xss_clean'),
                      array(
                              'field' => 'preacher',
                              'label' => 'Preacher',
                              'rules' => 'trim|xss_clean|min_length[0]|max_length[60]'),
                      array(
                              'field' => 'brief_description',
                              'label' => 'Brief Description',
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
              $config['base_url'] = site_url() . 'admin/hbc_meetings/index/';
              $config['use_page_numbers'] = TRUE;
              $config['per_page'] = 10;
              $config['total_rows'] = $this->hbc_meeting_m->count();
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
    