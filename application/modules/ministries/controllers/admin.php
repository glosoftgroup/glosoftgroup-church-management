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
              $this->load->model('ministries_m');
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

              $data['ministries'] = $this->ministries_m->paginate_all($config['per_page'], $page);

              //create pagination links
              $data['links'] = $this->pagination->create_links();
              $data['updType'] = 'edit';

              //page number  variable
              $data['page'] = $page;
              $data['per'] = $config['per_page'];
              $data['leader'] = $this->ion_auth->get_member('members', 'id', 'first_name' . ' ' . 'last_name');
              //load view
              $this->template->title(' List of Ministries ')->build('admin/list', $data);
         }

         /*          * *
          * ** Public Function View Ministry Members
          * * */

         function members($id = 0)
         {
              //redirect if no $id


              if (!$id)
              {
                   $this->session->set_flashdata('error', array('type' => 'warning', 'text' => lang('web_object_not_exist')));
                   redirect('admin/ministries/');
              }
              if (!$this->ministries_m->exists($id))
              {
                   $this->session->set_flashdata('error', array('type' => 'warning', 'text' => lang('web_object_not_exist')));
                   redirect('admin/ministries');
              }

              $get = $this->ministries_m->find($id);

              $data['members'] = $this->ministries_m->get_members($id);
              $title = ucwords($get->name) . ' Ministry Members ';
              $data['title'] = $title;

              $data['min_id'] = $id;

              $data['ministries'] = $this->ministries_m->populate('ministries', 'id', 'name');

              $this->template->title($title)->build('admin/members', $data);
         }

         function search()
         {
              //redirect if no $id

              $id = $this->input->post('ministry_id');
              //print_r($id);die;
              if (!$id)
              {
                   $this->session->set_flashdata('error', array('type' => 'warning', 'text' => lang('web_object_not_exist')));
                   redirect('admin/ministries/');
              }
              if (!$this->ministries_m->exists($id))
              {
                   $this->session->set_flashdata('error', array('type' => 'warning', 'text' => lang('web_object_not_exist')));
                   redirect('admin/ministries');
              }

              $get = $this->ministries_m->find($id);
              $data['min_id'] = $id;

              $data['members'] = $this->ministries_m->get_members($id);
              $title = ucwords($get->name) . ' Ministry Members ';
              $data['title'] = $title;
              $data['ministries'] = $this->ministries_m->populate('ministries', 'id', 'name');

              $this->template->title($title)->build('admin/members', $data);
         }

         /**
          * Add New Ministries 
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
                           'code' => $this->input->post('code'),
                           'name' => $this->input->post('name'),
                           'leader' => $this->input->post('leader'),
                           'telephone' => $this->input->post('telephone'),
                           'mobile' => $this->input->post('mobile'),
                           'email' => $this->input->post('email'),
                           'congregation_size' => $this->input->post('congregation_size'),
                           'description' => $this->input->post('description'),
                           'created_by' => $user->id,
                           'created_on' => time()
                   );

                   $ok = $this->ministries_m->create($form_data);

                   if ($ok) // the information has therefore been successfully saved in the db
                   {
                        $this->sync->log_new('ministries', array($ok));
                        $this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Ministries ' . lang('web_create_success')));
                   }
                   else
                   {
                        $this->session->set_flashdata('error', array('type' => 'error', 'text' => 'Ministries ' . lang('web_create_failed')));
                   }

                   redirect('admin/ministries/');
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
                   $data['leader'] = $this->ion_auth->get_member('members', 'id', 'first_name' . ' ' . 'last_name');
                   //load the view and the layout
                   $this->template->title('Add Ministries ')->build('admin/create', $data);
              }
         }

         /**
          * Edit  Ministries 
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
                   redirect('admin/ministries/');
              }
              if (!$this->ministries_m->exists($id))
              {
                   $this->session->set_flashdata('error', array('type' => 'warning', 'text' => lang('web_object_not_exist')));
                   redirect('admin/ministries');
              }
              //search the item to show in edit form
              $get = $this->ministries_m->find($id);

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
                           'code' => $this->input->post('code'),
                           'name' => $this->input->post('name'),
                           'leader' => $this->input->post('leader'),
                           'telephone' => $this->input->post('telephone'),
                           'mobile' => $this->input->post('mobile'),
                           'email' => $this->input->post('email'),
                           'congregation_size' => $this->input->post('congregation_size'),
                           'description' => $this->input->post('description'),
                           'modified_by' => $user->id,
                           'modified_on' => time());

                   $done = $this->ministries_m->update_attributes($id, $form_data);

                   // the information has therefore been successfully saved in the db
                   if ($done)
                   {
                        $this->sync->log_update('ministries', $id, $form_data);
                        $this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Ministries ' . lang('web_edit_success')));
                        redirect("admin/ministries/");
                   }
                   else
                   {
                        $this->session->set_flashdata('error', array('type' => 'error', 'text' => $done->errors->full_messages()));
                        redirect("admin/ministries/");
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
              $data['leader'] = $this->ion_auth->get_member('members', 'id', 'first_name' . ' ' . 'last_name');
              //load the view and the layout
              $this->template->title('Edit Ministries ')->build('admin/create', $data);
         }

         function delete($id = NULL, $page = 1)
         {
              //filter & Sanitize $id
              $id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;

              //redirect if its not correct
              if (!$id)
              {
                   $this->session->set_flashdata('error', array('type' => 'warning', 'text' => lang('web_object_not_exist')));

                   redirect('admin/ministries');
              }

              //search the item to delete
              if (!$this->ministries_m->exists($id))
              {
                   $this->session->set_flashdata('error', array('type' => 'warning', 'text' => lang('web_object_not_exist')));

                   redirect('admin/ministries');
              }

              //delete the item
              if ($this->ministries_m->delete($id) == TRUE)
              {
                   $this->sync->log_delete('ministries', $id);
                   $this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Ministries ' . lang('web_delete_success')));
              }
              else
              {
                   $this->session->set_flashdata('error', array('type' => 'error', 'text' => lang('web_delete_failed')));
              }

              redirect("admin/ministries/");
         }

         function remove_member($id = NULL, $min_id)
         {
              //filter & Sanitize $id
              $id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;

              //redirect if its not correct
              if (!$id)
              {
                   $this->session->set_flashdata('error', array('type' => 'warning', 'text' => lang('web_object_not_exist')));

                   redirect('admin/ministries');
              }

              //search the item to delete
              if (!$this->ministries_m->exists_mem_min($id))
              {
                   $this->session->set_flashdata('error', array('type' => 'warning', 'text' => lang('web_object_not_exist')));

                   redirect('admin/ministries');
              }

              //delete the item
              if ($this->ministries_m->delete_mem_min($id) == TRUE)
              {
                   $this->sync->log_delete('member_ministries', $id);
                   $this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Ministries ' . lang('web_delete_success')));
              }
              else
              {
                   $this->session->set_flashdata('error', array('type' => 'error', 'text' => lang('web_delete_failed')));
              }

              redirect("admin/ministries/members/" . $min_id);
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
                              'field' => 'code',
                              'label' => 'Code',
                              'rules' => 'trim|xss_clean|min_length[0]|max_length[60]'),
                      array(
                              'field' => 'name',
                              'label' => 'Name',
                              'rules' => 'required|trim|xss_clean|min_length[0]|max_length[60]'),
                      array(
                              'field' => 'leader',
                              'label' => 'Leader',
                              'rules' => 'required|xss_clean'),
                      array(
                              'field' => 'telephone',
                              'label' => 'Telephone',
                              'rules' => 'required|trim|xss_clean|min_length[0]|max_length[60]'),
                      array(
                              'field' => 'mobile',
                              'label' => 'Mobile',
                              'rules' => 'trim|xss_clean|min_length[0]|max_length[60]'),
                      array(
                              'field' => 'email',
                              'label' => 'Email',
                              'rules' => 'required|valid_email|trim|xss_clean|min_length[0]|max_length[60]'),
                      array(
                              'field' => 'congregation_size',
                              'label' => 'Congregation Size',
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
              $config['base_url'] = site_url() . 'admin/ministries/index/';
              $config['use_page_numbers'] = TRUE;
              $config['per_page'] = 10;
              $config['total_rows'] = $this->ministries_m->count();
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
    