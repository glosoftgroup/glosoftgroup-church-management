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
              $this->load->model('hbcs_m');
         }

         function upload_hbcsc()
         {

              $file = $_FILES['csv']['tmp_name'];

              $handler = fopen($file, "r");

              while (($fileop = fgetcsv($handler, 1000, ",")) !== false)
              {


                   $name = $fileop[0];


                   $user = $this->ion_auth->get_user();
                   $form_data = array(
                           'name' => $name,
                           'estate' => $name,
                           'created_by' => $user->id,
                           'created_on' => time()
                   );

                   $ok = $this->hbcs_m->create($form_data);
              }

              if ($ok) // the information has therefore been successfully saved in the db
              {
                   $this->session->set_flashdata('message', array('type' => 'success', 'text' => lang('web_create_success')));
              }
              else
              {
                   $this->session->set_flashdata('message', array('type' => 'error', 'text' => lang('web_create_failed')));
              }

              redirect('admin/hbcs/');
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

              $data['hbcs'] = $this->hbcs_m->paginate_all($config['per_page'], $page);

              //create pagination links
              $data['links'] = $this->pagination->create_links();
              $data['updType'] = 'edit';

              //page number  variable
              $data['page'] = $page;
              $data['per'] = $config['per_page'];
              $data['host'] = $this->ion_auth->get_member('members', 'id', 'first_name' . ' ' . 'last_name');
              //load view
              $this->template->title(' Hbcs ')->build('admin/list', $data);
         }

         /**
          * Add New Hbcs 
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
                           'name' => $this->input->post('name'),
                           'estate' => $this->input->post('estate'),
                           'meeting_day' => $this->input->post('meeting_day'),
                           'meeting_time' => $this->input->post('meeting_time'),
                           'overall_leader' => $this->input->post('overall_leader'),
                           'description' => $this->input->post('description'),
                           'created_by' => $user->id,
                           'created_on' => time()
                   );

                   $ok = $this->hbcs_m->create($form_data);

                   if ($ok) // the information has therefore been successfully saved in the db
                   {
                        $this->sync->log_new('hbcs', array($ok));
                        $this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Hbcs ' . lang('web_create_success')));
                   }
                   else
                   {
                        $this->session->set_flashdata('error', array('type' => 'error', 'text' => 'Hbcs ' . lang('web_create_failed')));
                   }

                   redirect('admin/hbcs/');
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
                   $data['host'] = $this->ion_auth->get_member('members', 'id', 'first_name' . ' ' . 'last_name');
                   //load the view and the layout
                   $this->template->title('Add Hbcs ')->build('admin/create', $data);
              }
         }

         /**
          * Edit  Hbcs 
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
                   redirect('admin/hbcs/');
              }
              if (!$this->hbcs_m->exists($id))
              {
                   $this->session->set_flashdata('error', array('type' => 'warning', 'text' => lang('web_object_not_exist')));
                   redirect('admin/hbcs');
              }
              //search the item to show in edit form
              $get = $this->hbcs_m->find($id);

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
                           'name' => $this->input->post('name'),
                           'estate' => $this->input->post('estate'),
                           'meeting_day' => $this->input->post('meeting_day'),
                           'meeting_time' => $this->input->post('meeting_time'),
                           'overall_leader' => $this->input->post('overall_leader'),
                           'description' => $this->input->post('description'),
                           'modified_by' => $user->id,
                           'modified_on' => time());

                   $done = $this->hbcs_m->update_attributes($id, $form_data);

                   // the information has therefore been successfully saved in the db
                   if ($done)
                   {
                        $this->sync->log_update('hbcs', $id, $form_data);
                        $this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Hbcs ' . lang('web_edit_success')));
                        redirect("admin/hbcs/");
                   }
                   else
                   {
                        $this->session->set_flashdata('error', array('type' => 'error', 'text' => $done->errors->full_messages()));
                        redirect("admin/hbcs/");
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
              $data['host'] = $this->ion_auth->get_member('members', 'id', 'first_name' . ' ' . 'last_name');
              //load the view and the layout
              $this->template->title('Edit Hbcs ')->build('admin/create', $data);
         }

         function delete($id = NULL, $page = 1)
         {
              //filter & Sanitize $id
              $id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;

              //redirect if its not correct
              if (!$id)
              {
                   $this->session->set_flashdata('error', array('type' => 'warning', 'text' => lang('web_object_not_exist')));

                   redirect('admin/hbcs');
              }

              //search the item to delete
              if (!$this->hbcs_m->exists($id))
              {
                   $this->session->set_flashdata('error', array('type' => 'warning', 'text' => lang('web_object_not_exist')));

                   redirect('admin/hbcs');
              }

              //delete the item
              if ($this->hbcs_m->delete($id) == TRUE)
              {
                   $this->sync->log_delete('hbcs', $id);
                   $this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Hbcs ' . lang('web_delete_success')));
              }
              else
              {
                   $this->session->set_flashdata('error', array('type' => 'error', 'text' => lang('web_delete_failed')));
              }

              redirect("admin/hbcs/");
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
                              'field' => 'name',
                              'label' => 'Name',
                              'rules' => 'required|trim|xss_clean|min_length[0]|max_length[60]'),
                      array(
                              'field' => 'estate',
                              'label' => 'Estate',
                              'rules' => 'required|trim|xss_clean|min_length[0]|max_length[60]'),
                      array(
                              'field' => 'meeting_day',
                              'label' => 'Meeting Day',
                              'rules' => 'required|xss_clean'),
                      array(
                              'field' => 'meeting_time',
                              'label' => 'Meeting Time',
                              'rules' => 'required|xss_clean'),
                      array(
                              'field' => 'overall_leader',
                              'label' => 'Overall Leader',
                              'rules' => 'required|xss_clean'),
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
              $config['base_url'] = site_url() . 'admin/hbcs/index/';
              $config['use_page_numbers'] = TRUE;
              $config['per_page'] = 10000;
              $config['total_rows'] = $this->hbcs_m->count();
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
    