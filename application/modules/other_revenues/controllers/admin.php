<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    class Admin extends Admin_Controller
    {

         function __construct()
         {
              parent::__construct();
              $this->template->set_layout('default');
              $this->template->set_partial('sidebar', 'partials/sidebar.php')
                           ->set_partial('footer', 'partials/footer.php')->set_partial('top', 'partials/top.php');
              if (!$this->ion_auth->logged_in())
              {
                   redirect('admin/login');
              }
              $this->load->model('other_revenues_m');
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

              $data['other_revenues'] = $this->other_revenues_m->paginate_all($config['per_page'], $page);

              //create pagination links
              $data['links'] = $this->pagination->create_links();

              //page number  variable
              $data['page'] = $page;
              $data['per'] = $config['per_page'];
              $data['banks'] = $this->other_revenues_m->get_banks();
              $data['projects'] = $this->other_revenues_m->populate('church_projects', 'id', 'name');
              $data['users'] = $this->ion_auth->list_users();
              //load view
              $this->template->title(' Other Revenues ')->build('admin/list', $data);
         }

         /**
          * Add New Other Revenues 
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
                           'project' => $this->input->post('project'),
                           'amount' => $this->input->post('amount'),
                           'collected_by' => $this->input->post('collected_by'),
                           'bank' => $this->input->post('bank'),
                           'description' => $this->input->post('description'),
                           'created_by' => $user->id,
                           'created_on' => time()
                   );

                   $ok = $this->other_revenues_m->create($form_data);

                   if ($ok) // the information has therefore been successfully saved in the db
                   {
                        $this->sync->log_new('other_revenues', array($ok));
                        $this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Other Revenues ' . lang('web_create_success')));
                   }
                   else
                   {
                        $this->session->set_flashdata('error', array('type' => 'error', 'text' => 'Other Revenues ' . lang('web_create_failed')));
                   }

                   redirect('admin/other_revenues/');
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
                   $data['banks'] = $this->other_revenues_m->get_banks();
                   $data['projects'] = $this->other_revenues_m->populate('church_projects', 'id', 'name');
                   $data['users'] = $this->ion_auth->list_users();
                   //load the view and the layout
                   $this->template->title('Add Other Revenues ')->build('admin/create', $data);
              }
         }

         /**
          * Edit  Other Revenues 
          *
          * @param $id
          * @param $page
          */
         function edit($id = FALSE, $page = 0)
         {

              //redirect if no $id
              if (!$id)
              {
                   $this->session->set_flashdata('message', array('type' => 'warning', 'text' => lang('web_object_not_exist')));
                   redirect('admin/other_revenues/');
              }
              if (!$this->other_revenues_m->exists($id))
              {
                   $this->session->set_flashdata('message', array('type' => 'warning', 'text' => lang('web_object_not_exist')));
                   redirect('admin/other_revenues');
              }
              //search the item to show in edit form
              $get = $this->other_revenues_m->find($id);

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
                           'project' => $this->input->post('project'),
                           'amount' => $this->input->post('amount'),
                           'collected_by' => $this->input->post('collected_by'),
                           'bank' => $this->input->post('bank'),
                           'description' => $this->input->post('description'),
                           'modified_by' => $user->id,
                           'modified_on' => time());

                   $done = $this->other_revenues_m->update_attributes($id, $form_data);

                   // the information has therefore been successfully saved in the db
                   if ($done)
                   {
                        $this->sync->log_update('other_revenues', $id, $form_data);
                        $this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Other Revenues ' . lang('web_edit_success')));
                        redirect("admin/other_revenues/");
                   }
                   else
                   {
                        $this->session->set_flashdata('error', array('type' => 'error', 'text' => $done->errors->full_messages()));
                        redirect("admin/other_revenues/");
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
              $data['banks'] = $this->other_revenues_m->get_banks();
              $data['projects'] = $this->other_revenues_m->populate('church_projects', 'id', 'name');
              $data['users'] = $this->ion_auth->list_users();
              //load the view and the layout
              $this->template->title('Edit Other Revenues ')->build('admin/create', $data);
         }

         function delete($id = NULL, $page = 1)
         {
              //filter & Sanitize $id
              $id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;

              //redirect if its not correct
              if (!$id)
              {
                   $this->session->set_flashdata('message', array('type' => 'warning', 'text' => lang('web_object_not_exist')));

                   redirect('admin/other_revenues');
              }

              //search the item to delete
              if (!$this->other_revenues_m->exists($id))
              {
                   $this->session->set_flashdata('message', array('type' => 'warning', 'text' => lang('web_object_not_exist')));

                   redirect('admin/other_revenues');
              }

              //delete the item
              if ($this->other_revenues_m->delete($id) == TRUE)
              {
                   $this->sync->log_delete('other_revenues', $id);
                   $this->session->set_flashdata('message', array('type' => 'sucess', 'text' => 'Other Revenues ' . lang('web_delete_success')));
              }
              else
              {
                   $this->session->set_flashdata('error', array('type' => 'error', 'text' => lang('web_delete_failed')));
              }

              redirect("admin/other_revenues/");
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
                              'field' => 'project',
                              'label' => 'Project',
                              'rules' => 'required|xss_clean'),
                      array(
                              'field' => 'amount',
                              'label' => 'Amount',
                              'rules' => 'required|trim|xss_clean|min_length[0]|max_length[60]'),
                      array(
                              'field' => 'collected_by',
                              'label' => 'Collected By',
                              'rules' => 'required|xss_clean'),
                      array(
                              'field' => 'bank',
                              'label' => 'Bank',
                              'rules' => 'xss_clean'),
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
              $config['base_url'] = site_url() . 'admin/other_revenues/index/';
              $config['use_page_numbers'] = TRUE;
              $config['per_page'] = 10;
              $config['total_rows'] = $this->other_revenues_m->count();
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
    