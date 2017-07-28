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
              $this->load->model('expenses_m');
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
              $data['expenses'] = $this->expenses_m->paginate_all($config['per_page'], $page);

              //create pagination links
              $data['links'] = $this->pagination->create_links();
              $data['updType'] = 'edit';

              $data['todays'] = $this->expenses_m->todays()->total;
              $data['months'] = $this->expenses_m->months()->total;
              $data['years'] = $this->expenses_m->years()->total;

              //page number  variable
              $data['page'] = $page;
              $data['per'] = $config['per_page'];
              $data['expenses_items'] = $this->expenses_m->populate('expenses_items', 'id', 'name');
              $data['expenses_category'] = $this->expenses_m->populate('expenses_category', 'id', 'name');
              $data['users'] = $this->ion_auth->list_users();

              //load view
              $this->template->title(' Expenses ')->build('admin/list', $data);
         }

         //List By Selected Item
         function by_item($id)
         {
              //redirect if its not correct
              if (!$id)
              {
                   $this->session->set_flashdata('error', array('type' => 'warning', 'text' => lang('web_object_not_exist')));

                   redirect('admin/expenses');
              }

              $config = $this->set_paginate_options();  //Initialize the pagination class
              $this->pagination->initialize($config);

              $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 1;

              $data['expenses'] = $this->expenses_m->by_item($config['per_page'], $page, $id);

              //create pagination links
              $data['links'] = $this->pagination->create_links();
              $data['updType'] = 'edit';

              $data['todays'] = $this->expenses_m->todays()->total;
              $data['months'] = $this->expenses_m->months()->total;
              $data['years'] = $this->expenses_m->years()->total;

              //page number  variable
              $data['page'] = $page;
              $data['per'] = $config['per_page'];
              $data['expenses_items'] = $this->expenses_m->populate('expenses_items', 'id', 'name');
              $data['expenses_category'] = $this->expenses_m->populate('expenses_category', 'id', 'name');
              $data['users'] = $this->ion_auth->list_users();

              //load view
              $this->template->title(' Expenses ')->build('admin/list', $data);
         }

         //List By Selected Category
         function by_category($id)
         {
              //redirect if its not correct
              if (!$id)
              {
                   $this->session->set_flashdata('error', array('type' => 'warning', 'text' => lang('web_object_not_exist')));

                   redirect('admin/expenses');
              }

              $config = $this->set_paginate_options();  //Initialize the pagination class
              $this->pagination->initialize($config);

              $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 1;

              $data['expenses'] = $this->expenses_m->by_category($config['per_page'], $page, $id);

              //create pagination links
              $data['links'] = $this->pagination->create_links();
              $data['updType'] = 'edit';

              $data['todays'] = $this->expenses_m->todays()->total;
              $data['months'] = $this->expenses_m->months()->total;
              $data['years'] = $this->expenses_m->years()->total;

              //page number  variable
              $data['page'] = $page;
              $data['per'] = $config['per_page'];
              $data['expenses_items'] = $this->expenses_m->populate('expenses_items', 'id', 'name');
              $data['expenses_category'] = $this->expenses_m->populate('expenses_category', 'id', 'name');
              $data['users'] = $this->ion_auth->list_users();

              //load view
              $this->template->title(' Expenses ')->build('admin/list', $data);
         }

         /**
          * Add New Expenses 
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
                   $file = '';
                   if (!empty($_FILES['file']['name']))
                   {
                        $this->load->library('files_uploader');
                        $upload_data = $this->files_uploader->upload('file');
                        $file = $upload_data['file_name'];
                   }

                   $user = $this->ion_auth->get_user();
                   $form_data = array(
                           'date' => strtotime($this->input->post('date')),
                           'item' => $this->input->post('item'),
                           'category' => $this->input->post('category'),
                           'amount' => $this->input->post('amount'),
                           'file' => $file,
                           'status' => 1,
                           'person_responsible' => $this->input->post('person_responsible'),
                           'description' => $this->input->post('description'),
                           'created_by' => $user->id,
                           'created_on' => time()
                   );

                   $ok = $this->expenses_m->create($form_data);

                   if ($ok) // the information has therefore been successfully saved in the db
                   {
                        $this->sync->log_new('expenses', array($ok));
                        $this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Expenses ' . lang('web_create_success')));
                   }
                   else
                   {
                        $this->session->set_flashdata('error', array('type' => 'error', 'text' => 'Expenses ' . lang('web_create_failed')));
                   }

                   redirect('admin/expenses/');
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

                   $data['expenses_items'] = $this->expenses_m->populate('expenses_items', 'id', 'name');
                   $data['expenses_category'] = $this->expenses_m->populate('expenses_category', 'id', 'name');
                   $data['users'] = $this->ion_auth->list_users();
                   //load the view and the layout
                   $this->template->title('Add Expenses ')->build('admin/create', $data);
              }
         }

         /**
          * Edit  Expenses 
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
                   redirect('admin/expenses/');
              }
              if (!$this->expenses_m->exists($id))
              {
                   $this->session->set_flashdata('error', array('type' => 'warning', 'text' => lang('web_object_not_exist')));
                   redirect('admin/expenses');
              }
              //search the item to show in edit form
              $get = $this->expenses_m->find($id);

              //Rules for validation
              $this->form_validation->set_rules($this->validation());

              //create control variables
              $data['updType'] = 'edit';
              $data['page'] = $page;

              if ($this->form_validation->run())  //validation has been passed
              {

                   $data['expenses_m'] = $this->expenses_m->find($id);
                   $file = '';
                   if (!empty($_FILES['file']['name']))
                   {
                        $this->load->library('files_uploader');
                        $upload_data = $this->files_uploader->upload('file');
                        $file = $upload_data['file_name'];
                   }
                   else
                   {
                        $file = $get->file;
                   }

                   $user = $this->ion_auth->get_user();
                   // build array for the model
                   $form_data = array(
                           'date' => strtotime($this->input->post('date')),
                           'item' => $this->input->post('item'),
                           'category' => $this->input->post('category'),
                           'amount' => $this->input->post('amount'),
                           'person_responsible' => $this->input->post('person_responsible'),
                           'description' => $this->input->post('description'),
                           'file' => $file,
                           'modified_by' => $user->id,
                           'modified_on' => time());

                   //ad 
                   $done = $this->expenses_m->update_attributes($id, $form_data);

                   // the information has therefore been successfully saved in the db
                   if ($done)
                   {
                        $this->sync->log_update('expenses', $id, $form_data);
                        $this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Expenses ' . lang('web_edit_success')));
                        redirect("admin/expenses/");
                   }
                   else
                   {
                        $this->session->set_flashdata('error', array('type' => 'error', 'text' => $done->errors->full_messages()));
                        redirect("admin/expenses/");
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
              $data['expenses_items'] = $this->expenses_m->populate('expenses_items', 'id', 'name');
              $data['expenses_category'] = $this->expenses_m->populate('expenses_category', 'id', 'name');
              $data['users'] = $this->ion_auth->list_users();
              //load the view and the layout
              $this->template->title('Edit Expenses ')->build('admin/create', $data);
         }

         function delete($id = NULL, $page = 1)
         {
              $files_to_delete = array();

              //filter & Sanitize $id
              $id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;

              //redirect if its not correct
              if (!$id)
              {
                   $this->session->set_flashdata('error', array('type' => 'warning', 'text' => lang('web_object_not_exist')));

                   redirect('admin/expenses');
              }

              //search the item to delete
              if (!$this->expenses_m->exists($id))
              {
                   $this->session->set_flashdata('error', array('type' => 'warning', 'text' => lang('web_object_not_exist')));

                   redirect('admin/expenses');
              }
              else
                   $expenses_m = $this->expenses_m->find($id);

              //Save the files into array to delete after
              array_push($files_to_delete, $expenses_m->file);

              //delete the item
              if ($this->expenses_m->delete($id) == TRUE)
              {
                   $this->sync->log_delete('expenses', $id);
                   $this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Expenses ' . lang('web_delete_success')));

                   //delete the old images
                   foreach ($files_to_delete as $index)
                   {
                        if (is_file(FCPATH . 'uploads/expenses/files/' . $index))
                             unlink(FCPATH . 'uploads/expenses/files/' . $index);
                   }
              }
              else
              {
                   $this->session->set_flashdata('error', array('type' => 'error', 'text' => lang('web_delete_failed')));
              }

              redirect("admin/expenses/");
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
                              'field' => 'item',
                              'label' => 'Item',
                              'rules' => 'required|xss_clean'),
                      array(
                              'field' => 'name',
                              'label' => 'Item',
                              'rules' => 'xss_clean'),
                      array(
                              'field' => 'category',
                              'label' => 'Category',
                              'rules' => 'required|xss_clean'),
                      array(
                              'field' => 'amount',
                              'label' => 'Amount',
                              'rules' => 'required|trim|xss_clean|min_length[0]|max_length[60]'),
                      array(
                              'field' => 'person_responsible',
                              'label' => 'Person Responsible',
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
              $config['base_url'] = site_url() . 'admin/expenses/index/';
              $config['use_page_numbers'] = TRUE;
              $config['per_page'] = 10;
              $config['total_rows'] = $this->expenses_m->count();
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

         private function set_upload_options($controller, $field)
         {
              //upload an image options
              $config = array();
              if ($field == 'file')
              {
                   $config['upload_path'] = FCPATH . 'uploads/' . $controller . '/files/';
                   $config['allowed_types'] = 'pdf';
                   $config['max_size'] = '2048';
                   $config['encrypt_name'] = TRUE;
              }
              //create controller upload folder if not exists
              if (!is_dir($config['upload_path']))
              {
                   mkdir(FCPATH . "uploads/$controller/", 777, TRUE);
                   mkdir(FCPATH . "uploads/$controller/thumbs/", 777, TRUE);
              }

              return $config;
         }

    }
    