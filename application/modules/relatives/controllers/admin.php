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
              $this->load->model('relatives_m');
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

              $data['relatives'] = $this->relatives_m->paginate_all($config['per_page'], $page);

              //create pagination links
              $data['links'] = $this->pagination->create_links();

              //page number  variable
              $data['page'] = $page;
              $data['per'] = $config['per_page'];
              $data['member'] = $this->ion_auth->get_member();

              //load view
              $this->template->title(' Relatives ')->build('admin/list', $data);
         }

         /**
          * Add New Relatives 
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
                           'first_name' => $this->input->post('first_name'),
                           'last_name' => $this->input->post('last_name'),
                           'gender' => $this->input->post('gender'),
                           'type' => $this->input->post('type'),
                           'relationship' => $this->input->post('relationship'),
                           'phone' => $this->input->post('phone'),
                           'email' => $this->input->post('email'),
                           'additionals' => $this->input->post('additionals'),
                           'created_by' => $user->id,
                           'created_on' => time()
                   );

                   $ok = $this->relatives_m->create($form_data);

                   if ($ok) // the information has therefore been successfully saved in the db
                   {
                        $this->sync->log_new('relatives', array($ok));
                        $this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Relatives ' . lang('web_create_success')));
                   }
                   else
                   {
                        $this->session->set_flashdata('error', array('type' => 'error', 'text' => 'Relatives ' . lang('web_create_failed')));
                   }

                   redirect('admin/relatives/');
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
                   $this->template->title('Add Relatives ')->build('admin/create', $data);
              }
         }

         /**
          * Edit  Relatives 
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
                   redirect('admin/relatives/');
              }

              //search the item to show in edit form
              $get = $this->relatives_m->find($id);

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
                           'first_name' => $this->input->post('first_name'),
                           'last_name' => $this->input->post('last_name'),
                           'gender' => $this->input->post('gender'),
                           'type' => $this->input->post('type'),
                           'relationship' => $this->input->post('relationship'),
                           'phone' => $this->input->post('phone'),
                           'email' => $this->input->post('email'),
                           'additionals' => $this->input->post('additionals'),
                           'modified_by' => $user->id,
                           'modified_on' => time());

                   $done = $this->relatives_m->update_attributes($id, $form_data);

                   // the information has therefore been successfully saved in the db
                   if ($done)
                   {
                        $this->sync->log_update('relatives', $id, $form_data);
                        $this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Relatives ' . lang('web_edit_success')));
                        redirect("admin/relatives/");
                   }
                   else
                   {
                        $this->session->set_flashdata('error', array('type' => 'error', 'text' => $done->errors->full_messages()));
                        redirect("admin/relatives/");
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
              $this->template->title('Edit Relatives ')->build('admin/create', $data);
         }

         function delete($id = NULL, $page = 1)
         {
              //filter & Sanitize $id
              $id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;

              //redirect if its not correct
              if (!$id)
              {
                   $this->session->set_flashdata('error', array('type' => 'warning', 'text' => lang('web_object_not_exist')));

                   redirect('admin/relatives');
              }

              //search the item to delete
              if (!$this->relatives_m->exists($id))
              {
                   $this->session->set_flashdata('error', array('type' => 'warning', 'text' => lang('web_object_not_exist')));

                   redirect('admin/relatives');
              }

              //delete the item
              if ($this->relatives_m->delete($id) == TRUE)
              {
                   $this->sync->log_delete('relatives', $id);
                   $this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Relatives ' . lang('web_delete_success')));
              }
              else
              {
                   $this->session->set_flashdata('error', array('type' => 'error', 'text' => lang('web_delete_failed')));
              }

              redirect("admin/relatives/");
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
                              'field' => 'type',
                              'label' => 'Type',
                              'rules' => 'required|xss_clean'),
                      array(
                              'field' => 'relationship',
                              'label' => 'Relationship',
                              'rules' => 'required|xss_clean'),
                      array(
                              'field' => 'phone',
                              'label' => 'Phone',
                              'rules' => 'required|trim|xss_clean|min_length[0]|max_length[60]'),
                      array(
                              'field' => 'email',
                              'label' => 'Email',
                              'rules' => 'trim|xss_clean|min_length[0]|max_length[60]'),
                      array(
                              'field' => 'additionals',
                              'label' => 'Additionals',
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
              $config['base_url'] = site_url() . 'admin/relatives/index/';
              $config['use_page_numbers'] = TRUE;
              $config['per_page'] = 10;
              $config['total_rows'] = $this->relatives_m->count();
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
    