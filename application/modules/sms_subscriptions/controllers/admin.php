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
              $this->load->model('sms_subscriptions_m');
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
              $data['sms_subscriptions'] = $this->sms_subscriptions_m->paginate_all($config['per_page'], $page);
              //create pagination links
              $data['links'] = $this->pagination->create_links();
              //page number  variable
              $data['page'] = $page;
              $data['per'] = $config['per_page'];
              $data['member'] = $this->ion_auth->get_member();
              //load view
              $this->template->title(' Sms Subscriptions ')->build('admin/list', $data);
         }

         /**
          * Add New Sms Subscriptions 
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
                   $length = $this->input->post('member');
                   $size = count($length);

                   //search the item to show in edit form
                   for ($i = 0; $i < $size; ++$i)
                   {
                        $member = $this->input->post('member');
                        $bible_quotes = $this->input->post('bible_quotes');
                        $daily_inspirations = $this->input->post('daily_inspirations');
                        $form_data = array(
                                'member' => $member[$i],
                                'bible_quotes' => $bible_quotes[$i],
                                'daily_inspirations' => $daily_inspirations[$i],
                                'status' => 1,
                                'created_by' => $user->id,
                                'created_on' => time()
                        );
                        if ($this->sms_subscriptions_m->exists_mem($member[$i]))
                        {
                             $update_data = array(
                                     'bible_quotes' => $bible_quotes[$i],
                                     'daily_inspirations' => $daily_inspirations[$i],
                                     'modified_by' => $user->id,
                                     'modified_on' => time());
                             $ok = $this->sms_subscriptions_m->update_member($member[$i], $update_data);
                             $this->sync->log_update('sms_subscriptions', $member[$i], $update_data);
                        }
                        else
                        {
                             $ok = $this->sms_subscriptions_m->create($form_data);
                             $this->sync->log_new('sms_subscriptions', array($ok));
                        }
                   }
                   if ($ok) // the information has therefore been successfully saved in the db
                   {
                        $this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Sms Subscriptions ' . lang('web_create_success')));
                   }
                   else
                   {
                        $this->session->set_flashdata('error', array('type' => 'error', 'text' => 'Sms Subscriptions ' . lang('web_create_failed')));
                   }
                   redirect('admin/sms_subscriptions/');
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
                   $data['members'] = $this->ion_auth->get_members();
                   //load the view and the layout
                   $this->template->title('Add Sms Subscriptions ')->build('admin/create', $data);
              }
         }

         /**
          * Edit  Sms Subscriptions 
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
                   redirect('admin/sms_subscriptions/');
              }
              if (!$this->sms_subscriptions_m->exists($id))
              {
                   $this->session->set_flashdata('message', array('type' => 'warning', 'text' => lang('web_object_not_exist')));
                   redirect('admin/sms_subscriptions');
              }
              //search the item to show in edit form
              $get = $this->sms_subscriptions_m->find($id);

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
                           'member' => $this->input->post('member'),
                           'bible_quotes' => $this->input->post('bible_quotes'),
                           'daily_inspirations' => $this->input->post('daily_inspirations'),
                           'modified_by' => $user->id,
                           'modified_on' => time());

                   $done = $this->sms_subscriptions_m->update_attributes($id, $form_data);
                   // the information has therefore been successfully saved in the db
                   if ($done)
                   {
                        $this->sync->log_update('sms_subscriptions', $id, $form_data);
                        $this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Sms Subscriptions ' . lang('web_edit_success')));
                        redirect("admin/sms_subscriptions/");
                   }
                   else
                   {
                        $this->session->set_flashdata('error', array('type' => 'error', 'text' => $done->errors->full_messages()));
                        redirect("admin/sms_subscriptions/");
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
              $data['members'] = $this->ion_auth->get_members();
              //load the view and the layout
              $this->template->title('Edit Sms Subscriptions ')->build('admin/edit', $data);
         }

         function delete($id = NULL, $page = 1)
         {
              //filter & Sanitize $id
              $id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;
              //redirect if its not correct
              if (!$id)
              {
                   $this->session->set_flashdata('message', array('type' => 'warning', 'text' => lang('web_object_not_exist')));
                   redirect('admin/sms_subscriptions');
              }
              //search the item to delete
              if (!$this->sms_subscriptions_m->exists($id))
              {
                   $this->session->set_flashdata('message', array('type' => 'warning', 'text' => lang('web_object_not_exist')));
                   redirect('admin/sms_subscriptions');
              }
              //delete the item
              if ($this->sms_subscriptions_m->delete($id) == TRUE)
              {
                   $this->sync->log_delete('sms_subscriptions', $id);
                   $this->session->set_flashdata('message', array('type' => 'sucess', 'text' => 'Sms Subscriptions ' . lang('web_delete_success')));
              }
              else
              {
                   $this->session->set_flashdata('error', array('type' => 'error', 'text' => lang('web_delete_failed')));
              }
              redirect("admin/sms_subscriptions/");
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
                              'field' => 'member',
                              'label' => 'Member',
                              'rules' => 'xss_clean'),
                      array(
                              'field' => 'bible_quotes',
                              'label' => 'Bible Quotes',
                              'rules' => 'xss_clean'),
                      array(
                              'field' => 'daily_inspirations',
                              'label' => 'Daily Inspirations',
                              'rules' => 'xss_clean'),
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
              $config['base_url'] = site_url() . 'admin/sms_subscriptions/index/';
              $config['use_page_numbers'] = TRUE;
              $config['per_page'] = 10;
              $config['total_rows'] = $this->sms_subscriptions_m->count();
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
    