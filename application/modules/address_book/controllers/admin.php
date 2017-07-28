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
              $this->load->model('address_book_m');
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

              $data['address_book'] = $this->address_book_m->paginate_all($config['per_page'], $page);

              //create pagination links
              $data['links'] = $this->pagination->create_links();

              //page number  variable
              $data['page'] = $page;
              $data['per'] = $config['per_page'];
              $data['category'] = $this->address_book_m->populate('address_book_category', 'id', 'name');


              //load view
              $this->template->title(' Address Book ')->build('admin/list', $data);
         }

         public function customers()
         {
              $config = $this->set_paginate_options();  //Initialize the pagination class
              $this->pagination->initialize($config);

              $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 1;

              $data['address_book'] = $this->address_book_m->customers($config['per_page'], $page);

              //create pagination links
              $data['links'] = $this->pagination->create_links();

              //page number  variable
              $data['page'] = $page;
              $data['per'] = $config['per_page'];
              $data['category'] = $this->address_book_m->populate('address_book_category', 'id', 'name');


              //load view
              $this->template->title(' Address Book ')->build('admin/list', $data);
         }

         public function suppliers()
         {
              $config = $this->set_paginate_options();  //Initialize the pagination class
              $this->pagination->initialize($config);

              $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 1;

              $data['address_book'] = $this->address_book_m->suppliers($config['per_page'], $page);

              //create pagination links
              $data['links'] = $this->pagination->create_links();

              //page number  variable
              $data['page'] = $page;
              $data['per'] = $config['per_page'];
              $data['category'] = $this->address_book_m->populate('address_book_category', 'id', 'name');


              //load view
              $this->template->title(' Address Book ')->build('admin/list', $data);
         }

         public function others()
         {
              $config = $this->set_paginate_options();  //Initialize the pagination class
              $this->pagination->initialize($config);

              $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 1;

              $data['address_book'] = $this->address_book_m->others($config['per_page'], $page);

              //create pagination links
              $data['links'] = $this->pagination->create_links();

              //page number  variable
              $data['page'] = $page;
              $data['per'] = $config['per_page'];
              $data['category'] = $this->address_book_m->populate('address_book_category', 'id', 'name');


              //load view
              $this->template->title(' Address Book ')->build('admin/list', $data);
         }

         /**
          * Add New Address Book 
          *
          * @param $page
          */
         function quick_add($page = NULL)
         {
              //create control variables
              $data['updType'] = 'create';
              $data['page'] = ( $this->uri->segment(4) ) ? $this->uri->segment(4) : $page;

              //Rules for validation
              $this->form_validation->set_rules($this->valid_rules());

              //validate the fields of form
              if ($this->form_validation->run())
              {         //Validation OK!
                   $user = $this->ion_auth->get_user();
                   $form_data = array(
                           'address_book' => 'suppliers',
                           'category' => $this->input->post('category'),
                           'contact_person' => $this->input->post('contact_person'),
                           'business_name' => $this->input->post('business_name'),
                           'phone' => $this->input->post('phone'),
                           'email' => $this->input->post('email'),
                           'address' => $this->input->post('address'),
                           'additional_info' => $this->input->post('additional_info'),
                           'created_by' => $user->id,
                           'created_on' => time()
                   );

                   $ok = $this->address_book_m->create($form_data);

                   if ($ok) // the information has therefore been successfully saved in the db
                   {
                        $this->sync->log_new('address_book', array($ok));
                        $this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Address Book ' . lang('web_create_success')));
                   }
                   else
                   {
                        $this->session->set_flashdata('error', array('type' => 'error', 'text' => 'Address Book ' . lang('web_create_failed')));
                   }

                   redirect('admin/address_book/create');
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
                   $data['category'] = $this->address_book_m->populate('address_book_category', 'id', 'name');
                   //load the view and the layout
                   $this->template->title('Add Contact ')->build('admin/create', $data);
              }
         }

         /**
          * Add New Address Book 
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
                           'address_book' => $this->input->post('address_book'),
                           'category' => $this->input->post('category'),
                           'contact_person' => $this->input->post('contact_person'),
                           'business_name' => $this->input->post('business_name'),
                           'phone' => $this->input->post('phone'),
                           'email' => $this->input->post('email'),
                           'address' => $this->input->post('address'),
                           'additional_info' => $this->input->post('additional_info'),
                           'created_by' => $user->id,
                           'created_on' => time()
                   );

                   $ok = $this->address_book_m->create($form_data);

                   if ($ok) // the information has therefore been successfully saved in the db
                   {
                        $this->sync->log_new('address_book', array($ok));
                        $this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Address Book ' . lang('web_create_success')));
                   }
                   else
                   {
                        $this->session->set_flashdata('error', array('type' => 'error', 'text' => 'Address Book ' . lang('web_create_failed')));
                   }

                   redirect('admin/address_book/');
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
                   $data['category'] = $this->address_book_m->populate('address_book_category', 'id', 'name');
                   //load the view and the layout
                   $this->template->title('Add Contact ')->build('admin/create', $data);
              }
         }

         /**
          * Edit  Address Book 
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
                   redirect('admin/address_book/');
              }
              if (!$this->address_book_m->exists($id))
              {
                   $this->session->set_flashdata('message', array('type' => 'warning', 'text' => lang('web_object_not_exist')));
                   redirect('admin/address_book');
              }
              //search the item to show in edit form
              $get = $this->address_book_m->find($id);

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
                           'address_book' => $this->input->post('address_book'),
                           'category' => $this->input->post('category'),
                           'contact_person' => $this->input->post('contact_person'),
                           'business_name' => $this->input->post('business_name'),
                           'phone' => $this->input->post('phone'),
                           'email' => $this->input->post('email'),
                           'address' => $this->input->post('address'),
                           'additional_info' => $this->input->post('additional_info'),
                           'modified_by' => $user->id,
                           'modified_on' => time());

                   $done = $this->address_book_m->update_attributes($id, $form_data);

                   // the information has therefore been successfully saved in the db
                   if ($done)
                   {
                        $this->sync->log_update('address_book', $id, $form_data);
                        $this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Address Book ' . lang('web_edit_success')));
                        redirect("admin/address_book/");
                   }
                   else
                   {
                        $this->session->set_flashdata('error', array('type' => 'error', 'text' => $done->errors->full_messages()));
                        redirect("admin/address_book/");
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
              $data['category'] = $this->address_book_m->populate('address_book_category', 'id', 'name');
              //load the view and the layout
              $this->template->title('Edit Contact ')->build('admin/create', $data);
         }

         function delete($id = NULL, $page = 1)
         {
              //filter & Sanitize $id
              $id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;

              //redirect if its not correct
              if (!$id)
              {
                   $this->session->set_flashdata('message', array('type' => 'warning', 'text' => lang('web_object_not_exist')));

                   redirect('admin/address_book');
              }

              //search the item to delete
              if (!$this->address_book_m->exists($id))
              {
                   $this->session->set_flashdata('message', array('type' => 'warning', 'text' => lang('web_object_not_exist')));

                   redirect('admin/address_book');
              }

              //delete the item
              if ($this->address_book_m->delete($id) == TRUE)
              {
                   $this->sync->log_delete('address_book', $id);
                   $this->session->set_flashdata('message', array('type' => 'sucess', 'text' => 'Address Book ' . lang('web_delete_success')));
              }
              else
              {
                   $this->session->set_flashdata('error', array('type' => 'error', 'text' => lang('web_delete_failed')));
              }

              redirect("admin/address_book/");
         }

         /**
          * Generate Validation Rules
          *
          * @return array()
          */
         private function valid_rules()
         {
              $config = array(
                      array(
                              'field' => 'category',
                              'label' => 'Category',
                              'rules' => 'required|xss_clean'),
                      array(
                              'field' => 'contact_person',
                              'label' => 'Contact Person',
                              'rules' => 'required|trim|xss_clean|min_length[0]|max_length[60]'),
                      array(
                              'field' => 'business_name',
                              'label' => 'Business Name',
                              'rules' => 'trim|xss_clean|min_length[0]|max_length[60]'),
                      array(
                              'field' => 'phone',
                              'label' => 'Phone',
                              'rules' => 'required|trim|xss_clean|min_length[0]|max_length[60]'),
                      array(
                              'field' => 'email',
                              'label' => 'Email',
                              'rules' => 'trim|valid_email|xss_clean|min_length[0]|max_length[60]'),
                      array(
                              'field' => 'address',
                              'label' => 'Address',
                              'rules' => 'trim|xss_clean|min_length[0]|max_length[500]'),
                      array(
                              'field' => 'additional_info',
                              'label' => 'Additional Info',
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
         private function validation()
         {
              $config = array(
                      array(
                              'field' => 'address_book',
                              'label' => 'Address Book',
                              'rules' => 'required|trim|xss_clean|min_length[0]|max_length[60]'),
                      array(
                              'field' => 'category',
                              'label' => 'Category',
                              'rules' => 'required|xss_clean'),
                      array(
                              'field' => 'contact_person',
                              'label' => 'Contact Person',
                              'rules' => 'required|trim|xss_clean|min_length[0]|max_length[60]'),
                      array(
                              'field' => 'business_name',
                              'label' => 'Business Name',
                              'rules' => 'trim|xss_clean|min_length[0]|max_length[60]'),
                      array(
                              'field' => 'phone',
                              'label' => 'Phone',
                              'rules' => 'required|trim|xss_clean|min_length[0]|max_length[60]'),
                      array(
                              'field' => 'email',
                              'label' => 'Email',
                              'rules' => 'trim|valid_email|xss_clean|min_length[0]|max_length[60]'),
                      array(
                              'field' => 'address',
                              'label' => 'Address',
                              'rules' => 'trim|xss_clean|min_length[0]|max_length[500]'),
                      array(
                              'field' => 'additional_info',
                              'label' => 'Additional Info',
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
              $config['base_url'] = site_url() . 'admin/address_book/index/';
              $config['use_page_numbers'] = TRUE;
              $config['per_page'] = 10;
              $config['total_rows'] = $this->address_book_m->count();
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
    