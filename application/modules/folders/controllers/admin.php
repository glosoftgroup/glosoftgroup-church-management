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
              $this->load->model('folders_m');
              $this->load->model('files/files_m');
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

              $data['folders'] = $this->folders_m->paginate_all($config['per_page'], $page);

              //create pagination links
              $data['links'] = $this->pagination->create_links();

              //page number  variable
              $data['page'] = $page;
              $data['per'] = $config['per_page'];

              //load view
              $this->template->title(' Folders ')->build('admin/list', $data);
         }

         /**
          * Upload Student Passport
          * 
          * @return json Status Information
          */
         public function upload_file()
         {
              //echo'test';die;
              $folder = explode(' ', $this->input->post('folder'));
              $ff = $folder [0];
              $id = $this->input->post('id');
              $file = '';
              $status = '';
              $msg = '';
              $file_element_name = 'file';
              $dest = FCPATH . "/uploads/" . $ff . "/" . date('Y') . '/';
              if (!is_dir($dest))
              {
                   mkdir($dest, 0777, true);
              }

              if ($status != "error")
              {

                   $config['upload_path'] = $dest;
                   $config['allowed_types'] = 'pdf|doc|docx|csv|xlsx';
                   $config['max_size'] = 1024 * 50;
                   $config['encrypt_name'] = FALSE;

                   $this->load->library('upload', $config);



                   if (!$this->upload->do_upload($file_element_name))
                   {
                        $status = 'error';
                        $msg = $this->upload->display_errors('', '');
                   }
                   else
                   {
                        $data = $this->upload->data();


                        $file_id = $this->files_m->create(
                                     array(
                                             'title' => $this->input->post('title'),
                                             'type' => $this->input->post('type'),
                                             'folder' => $id,
                                             'file' => $data['file_name'],
                                             'filesize' => $data['file_size'],
                                             'fpath' => $ff . '/' . date('Y') . '/',
                                             'created_by' => $this->ion_auth->get_user()->id,
                                             'created_on' => now()
                        ));
                        if ($file_id)
                        {

                             $status = "success";
                             $file = $data['file_name'];
                             $msg = "File successfully uploaded";

                             $this->session->set_flashdata('message', array('type' => 'success', 'text' => 'File ' . lang('web_create_success')));
                        }
                        else
                        {
                             unlink($data['full_path']);
                             $status = "error";
                             $msg = "Something went wrong when saving the file, please try again.";

                             $this->session->set_flashdata('error', array('type' => 'error', 'text' => 'File ' . lang('web_create_failed')));
                        }
                   }
                   @unlink($_FILES[$file_element_name]);
              }


              //echo json_encode(array('Status' => $status, '. Message' => $msg, 'file_name' => $file));

              redirect('admin/folders/');
         }

         function files($id)
         {

              //redirect if no $id
              if (!$id)
              {
                   $this->session->set_flashdata('message', array('type' => 'warning', 'text' => lang('web_object_not_exist')));
                   redirect('admin/folders/');
              }
              if (!$this->folders_m->exists($id))
              {
                   $this->session->set_flashdata('message', array('type' => 'warning', 'text' => lang('web_object_not_exist')));
                   redirect('admin/folders');
              }

              //search the item to show in edit form
              $get = $this->folders_m->get_files($id);
              $data['fld'] = $this->folders_m->find($id);
              $data['folders'] = $this->folders_m->populate('folders', 'id', 'title');

              $data['mms'] = $this->ion_auth->get_member();
              $data['staff'] = $this->ion_auth->list_users();
              $data['mins'] = $this->folders_m->populate('ministries', 'id', 'name');
              $data['hbs'] = $this->folders_m->populate('hbcs', 'id', 'name');
              $data['groups'] = $this->folders_m->get_custom_groups();

              $data['p'] = $get;
              //load the view and the layout
              $this->template->title('Edit Folders ')->build('admin/files', $data);
         }

         /**
          * Add New Folders 
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
                           'title' => $this->input->post('title'),
                           'description' => $this->input->post('description'),
                           'created_by' => $user->id,
                           'created_on' => time()
                   );

                   $ok = $this->folders_m->create($form_data);

                   if ($ok) // the information has therefore been successfully saved in the db
                   {
                        $this->sync->log_new('folders', array($ok));
                        $folder = explode(' ', $this->input->post('title'));
                        $ff = $folder [0];

                        $dest = FCPATH . "/uploads/" . $ff . "/" . date('Y') . '/';
                        if (!is_dir($dest))
                        {
                             mkdir($dest, 0777, true);
                        }
                        $this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Folders ' . lang('web_create_success')));
                   }
                   else
                   {
                        $this->session->set_flashdata('error', array('type' => 'error', 'text' => 'Folders ' . lang('web_create_failed')));
                   }

                   redirect('admin/folders/');
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
                   $this->template->title('Add Folders ')->build('admin/create', $data);
              }
         }

         /**
          * Edit  Folders 
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
                   redirect('admin/folders/');
              }
              if (!$this->folders_m->exists($id))
              {
                   $this->session->set_flashdata('message', array('type' => 'warning', 'text' => lang('web_object_not_exist')));
                   redirect('admin/folders');
              }
              //search the item to show in edit form
              $get = $this->folders_m->find($id);
              
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
                           'title' => $this->input->post('title'),
                           'description' => $this->input->post('description'),
                           'modified_by' => $user->id,
                           'modified_on' => time());

                   $done = $this->folders_m->update_attributes($id, $form_data);

                   // the information has therefore been successfully saved in the db
                   if ($done)
                   {
                        $this->sync->log_update('folders', $id, $form_data);
                        $folder = explode(' ', $this->input->post('title'));
                        $ff = $folder [0];

                        $dest = FCPATH . "/uploads/" . $ff . "/" . date('Y') . '/';
                        if (!is_dir($dest))
                        {
                             mkdir($dest, 0777, true);
                        }

                        $this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Folders ' . lang('web_edit_success')));
                        redirect("admin/folders/");
                   }
                   else
                   {
                        $this->session->set_flashdata('error', array('type' => 'error', 'text' => $done->errors->full_messages()));
                        redirect("admin/folders/");
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
              $this->template->title('Edit Folders ')->build('admin/create', $data);
         }

         function delete($id = NULL, $page = 1)
         {
              //filter & Sanitize $id
              $id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;

              //redirect if its not correct
              if (!$id)
              {
                   $this->session->set_flashdata('message', array('type' => 'warning', 'text' => lang('web_object_not_exist')));

                   redirect('admin/folders');
              }

              //search the item to delete
              if (!$this->folders_m->exists($id))
              {
                   $this->session->set_flashdata('message', array('type' => 'warning', 'text' => lang('web_object_not_exist')));

                   redirect('admin/folders');
              }

              //delete the item
              if ($this->folders_m->delete($id) == TRUE)
              {
                   $this->sync->log_delete('folders', $id);
                   $this->session->set_flashdata('message', array('type' => 'sucess', 'text' => 'Folders ' . lang('web_delete_success')));
              }
              else
              {
                   $this->session->set_flashdata('error', array('type' => 'error', 'text' => lang('web_delete_failed')));
              }

              redirect("admin/folders/");
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
              $config['base_url'] = site_url() . 'admin/folders/index/';
              $config['use_page_numbers'] = TRUE;
              $config['per_page'] = 10;
              $config['total_rows'] = $this->folders_m->count();
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
    