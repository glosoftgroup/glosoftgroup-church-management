<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    class Admin extends Admin_Controller
    {

         function __construct()
         {
              parent::__construct();
              /* $this->template->set_layout('default');
                $this->template->set_partial('sidebar','partials/sidebar.php')
                -> set_partial('top', 'partials/top.php'); */
              if (!$this->ion_auth->logged_in())
              {
                   redirect('admin/login');
              }

              if (!$this->ion_auth->is_in_group($this->user->id, 1) && !$this->ion_auth->is_in_group($this->user->id, 7))
              {
                   $this->session->set_flashdata('message', array('type' => 'success', 'text' => '<b style="color:red">Sorry you do not have permission to access this Module!!</b>'));
                   redirect('admin');
              }
              $this->load->model('advance_salary_m');
         }

         public function index()
         {
              $config = $this->set_paginate_options();  //Initialize the pagination class
              $this->pagination->initialize($config);

              $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 1;

              $data['advance_salary'] = $this->advance_salary_m->paginate_all($config['per_page'], $page);

              //create pagination links
              $data['links'] = $this->pagination->create_links();
              $data['updType'] = 'edit';

              //page number  variable
              $data['page'] = $page;
              $data['per'] = $config['per_page'];

              $data['employees'] = $this->advance_salary_m->list_employees();

              //load view
              $this->template->title(' Advance Salary ')->build('admin/list', $data);
         }

         function create($page = NULL)
         {
              //create control variables
              $data['updType'] = 'create';
              $form_data_aux = array();
              $data['page'] = ( $this->uri->segment(4) ) ? $this->uri->segment(4) : $page;

              $data['employees'] = $this->advance_salary_m->list_employees();

              //Rules for validation
              $this->form_validation->set_rules($this->validation());

              //validate the fields of form
              if ($this->form_validation->run())
              {         //Validation OK!
                   $user = $this->ion_auth->get_user();

                   $length = $this->input->post('employee');
                   $size = count($length);
                   $ids = array();
                   for ($i = 0; $i < $size; ++$i)
                   {
                        $employee = $this->input->post('employee');
                        $advance_date = $this->input->post('advance_date');
                        $amount = $this->input->post('amount');
                        $comment = $this->input->post('comment');
                        $form_data = array(
                                'employee' => $employee[$i],
                                'advance_date' => strtotime($advance_date[$i]),
                                'amount' => $amount[$i],
                                'status' => 1,
                                'comment' => $comment[$i],
                                'created_by' => $user->id,
                                'created_on' => time()
                        );
                        $ok = $this->advance_salary_m->create($form_data);
                        $ids[] = $ok;
                   }

                   if ($ok) // the information has therefore been successfully saved in the db
                   {
                        $this->sync->log_new('advance_salary', $ids);
                        $this->session->set_flashdata('message', array('type' => 'success', 'text' => lang('web_create_success')));
                   }
                   else
                   {
                        $this->session->set_flashdata('message', array('type' => 'error', 'text' => lang('web_create_failed')));
                   }

                   redirect('admin/advance_salary/');
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
                   $this->template->title('Add Advance Salary ')->build('admin/create', $data);
              }
         }

         function edit($id = FALSE, $page = 0)
         {

              //get the $id and sanitize
              $id = ( $id != 0 ) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;

              $page = ( $page != 0 ) ? filter_var($page, FILTER_VALIDATE_INT) : NULL;

              //redirect if no $id
              if (!$id)
              {
                   $this->session->set_flashdata('message', array('type' => 'warning', 'text' => lang('web_object_not_exist')));
                   redirect('admin/advance_salary/');
              }
              if (!$this->advance_salary_m->exists($id))
              {
                   $this->session->set_flashdata('message', array('type' => 'warning', 'text' => lang('web_object_not_exist')));
                   redirect('admin/advance_salary');
              }
              //search the item to show in edit form
              $get = $this->advance_salary_m->find($id);
              $data['employees'] = $this->advance_salary_m->list_employees();

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
                           'employee' => $this->input->post('employee'),
                           'advance_date' => strtotime($this->input->post('advance_date')),
                           'amount' => $this->input->post('amount'),
                           'comment' => $this->input->post('comment'),
                           'modified_by' => $user->id,
                           'modified_on' => time());

                   $done = $this->advance_salary_m->update_attributes($id, $form_data);

                   // the information has therefore been successfully saved in the db
                   if ($done)
                   {
                        $this->sync->log_update('advance_salary', $id, $form_data);
                        $this->session->set_flashdata('message', array('type' => 'success', 'text' => lang('web_edit_success')));
                        redirect("admin/advance_salary/");
                   }
                   else
                   {
                        $this->session->set_flashdata('message', array('type' => 'error', 'text' => $done->errors->full_messages()));
                        redirect("admin/advance_salary/");
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
              $this->template->title('Edit Advance Salary ')->build('admin/edit', $data);
         }

         function void($id = FALSE)
         {
              //redirect if no $id
              if (!$id)
              {
                   $this->session->set_flashdata('error', array('type' => 'warning', 'text' => lang('web_object_not_exist')));
                   redirect('admin/advance_salary/');
              }
              if (!$this->advance_salary_m->exists($id))
              {
                   $this->session->set_flashdata('error', array('type' => 'warning', 'text' => lang('web_object_not_exist')));
                   redirect('admin/advance_salary');
              }

              $user = $this->ion_auth->get_user();
              // build array for the model
              $form_data = array(
                      'status' => 0,
                      'modified_by' => $user->id,
                      'modified_on' => time());


              $done = $this->advance_salary_m->update_attributes($id, $form_data);

              // the information has therefore been successfully saved in the db
              if ($done)
              {
                   $this->sync->log_update('advance_salary', $id, $form_data);
                   $this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Advance Salary ' . lang('web_edit_success')));
                   redirect("admin/advance_salary/");
              }
              else
              {
                   $this->session->set_flashdata('message', array('type' => 'error', 'text' => $done->errors->full_messages()));
                   redirect("admin/advance_salary/");
              }
         }

         function delete($id = NULL, $page = 1)
         {
              //filter & Sanitize $id
              $id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;

              //redirect if its not correct
              if (!$id)
              {
                   $this->session->set_flashdata('message', array('type' => 'warning', 'text' => lang('web_object_not_exist')));

                   redirect('admin/advance_salary');
              }

              //search the item to delete
              if (!$this->advance_salary_m->exists($id))
              {
                   $this->session->set_flashdata('message', array('type' => 'warning', 'text' => lang('web_object_not_exist')));

                   redirect('admin/advance_salary');
              }

              //delete the item
              if ($this->advance_salary_m->delete($id) == TRUE)
              {
                   $this->sync->log_delete('advance_salary', $id);
                   $this->session->set_flashdata('message', array('type' => 'sucess', 'text' => lang('web_delete_success')));
              }
              else
              {
                   $this->session->set_flashdata('message', array('type' => 'error', 'text' => lang('web_delete_failed')));
              }

              redirect("admin/advance_salary/");
         }

         private function validation()
         {
              $config = array(
                      array(
                              'field' => 'employee',
                              'label' => 'Employee',
                              'rules' => 'xss_clean'),
                      array(
                              'field' => 'advance_date',
                              'label' => 'Advance Date',
                              'rules' => 'xss_clean'),
                      array(
                              'field' => 'amount',
                              'label' => 'Amount',
                              'rules' => 'xss_clean'),
                      array(
                              'field' => 'comment',
                              'label' => 'Comment',
                              'rules' => 'xss_clean'),
              );
              $this->form_validation->set_error_delimiters("<br /><span class='error'>", '</span>');
              return $config;
         }

         private function set_paginate_options()
         {
              $config = array();
              $config['base_url'] = site_url() . 'admin/advance_salary/index/';
              $config['use_page_numbers'] = TRUE;
              $config['per_page'] = 10;
              $config['total_rows'] = $this->advance_salary_m->count();
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
              $config['full_tag_open'] = '<div class="pagination pagination-centered"><ul>';
              $config['full_tag_close'] = '</ul></div>';
              $choice = $config["total_rows"] / $config["per_page"];
              //$config["num_links"] = round($choice);

              return $config;
         }

    }
    