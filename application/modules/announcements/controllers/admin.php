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
              $this->load->model('announcement_m');
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

              $data['announcements'] = $this->announcement_m->paginate_all($config['per_page'], $page);

              //create pagination links
              $data['links'] = $this->pagination->create_links();
              $data['updType'] = 'edit';

              //page number  variable
              $data['page'] = $page;
              $data['per'] = $config['per_page'];

              //load view
              $this->template->title(' Announcements ')->build('admin/list', $data);
         }

         /**
          * Add New Announcements 
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
                   $array_thumbnails = array();
                   $array_required = array();
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
                           'title' => $this->input->post('title'),
                           'status' => $this->input->post('status'),
                           'file' => $file,
                           'brief_description' => $this->input->post('brief_description'),
                           'created_by' => $user->id,
                           'created_on' => time()
                   );
                   $form_data = array_merge($form_data, $form_data_aux);

                   $ok = $this->announcement_m->create($form_data);

                   if ($ok) // the information has therefore been successfully saved in the db
                   {
                        $this->sync->log_new('announcements', array($ok));
                        $this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Announcements ' . lang('web_create_success')));
                   }
                   else
                   {
                        $this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Announcements ' . lang('web_create_failed')));
                   }

                   redirect('admin/announcements/');
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
                   $this->template->title('Add Announcements ')->build('admin/create', $data);
              }
         }

         /**
          * Edit  Announcements 
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
                   redirect('admin/announcements/');
              }
              if (!$this->announcement_m->exists($id))
              {
                   $this->session->set_flashdata('error', array('type' => 'warning', 'text' => lang('web_object_not_exist')));
                   redirect('admin/announcements');
              }
              //search the item to show in edit form
              $get = $this->announcement_m->find($id);
              
              $form_data_aux = array();
              $files_to_delete = array();
              //Rules for validation
              $this->form_validation->set_rules($this->validation());

              //create control variables
              $data['updType'] = 'edit';
              $data['page'] = $page;

              if ($this->form_validation->run())  //validation has been passed
              {

                   $data['announcement_m'] = $this->announcement_m->find($id);
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
                           'title' => $this->input->post('title'),
                           'date' => strtotime($this->input->post('date')),
                           'status' => $this->input->post('status'),
                           'file' => $file,
                           'brief_description' => $this->input->post('brief_description'),
                           'modified_by' => $user->id,
                           'modified_on' => time());

                   //add the aux form data to the form data array to save
                   $form_data = array_merge($form_data_aux, $form_data);

                   //find the item to update

                   $done = $this->announcement_m->update_attributes($id, $form_data);

                   // the information has therefore been successfully saved in the db
                   if ($done)
                   {
                        $this->sync->log_update('announcements', $id, $form_data);
                        //delete the old images
                        foreach ($files_to_delete as $index)
                        {
                             if (is_file(FCPATH . 'uploads/announcements/files/' . $index))
                                  unlink(FCPATH . 'uploads/announcements/files/' . $index);
                        }

                        $this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Announcements ' . lang('web_edit_success')));
                        redirect("admin/announcements/");
                   }

                   else
                   {
                        $this->session->set_flashdata('error', array('type' => 'error', 'text' => $done->errors->full_messages()));
                        redirect("admin/announcements/");
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
              $this->template->title('Edit Announcements ')->build('admin/create', $data);
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

                   redirect('admin/announcements');
              }

              //search the item to delete
              if (!$this->announcement_m->exists($id))
              {
                   $this->session->set_flashdata('error', array('type' => 'warning', 'text' => lang('web_object_not_exist')));

                   redirect('admin/announcements');
              }
              else
                   $announcement_m = $this->announcement_m->find($id);

              //Save the files into array to delete after
              array_push($files_to_delete, $announcement_m->upload_announcements);

              //delete the item
              if ($this->announcement_m->delete($id) == TRUE)
              {
                   $this->sync->log_delete('announcements', $id);
                   $this->session->set_flashdata('message', array('type' => 'sucess', 'text' => 'Announcements ' . lang('web_delete_success')));

                   //delete the old images
                   foreach ($files_to_delete as $index)
                   {
                        if (is_file(FCPATH . 'uploads/announcements/files/' . $index))
                             unlink(FCPATH . 'uploads/announcements/files/' . $index);
                   }
              }
              else
              {
                   $this->session->set_flashdata('error', array('type' => 'error', 'text' => lang('web_delete_failed')));
              }

              redirect("admin/announcements/");
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
                              'field' => 'title',
                              'label' => 'Title',
                              'rules' => 'required|trim|xss_clean|min_length[0]|max_length[60]'),
                      array(
                              'field' => 'date',
                              'label' => 'date',
                              'rules' => 'required'),
                      array(
                              'field' => 'status',
                              'label' => 'Status',
                              'rules' => 'xss_clean'),
                      array(
                              'field' => 'file',
                              'label' => 'File',
                              'rules' => 'xss_clean'),
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
              $config['base_url'] = site_url() . 'admin/announcements/index/';
              $config['use_page_numbers'] = TRUE;
              $config['per_page'] = 10;
              $config['total_rows'] = $this->announcement_m->count();
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
              if ($field == 'upload_announcements')
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
    