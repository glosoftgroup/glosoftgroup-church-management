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
              $this->load->model('sermon_m');
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

              $data['sermons'] = $this->sermon_m->paginate_all($config['per_page'], $page);

              //create pagination links
              $data['links'] = $this->pagination->create_links();
              $data['updType'] = 'edit';

              //page number  variable
              $data['page'] = $page;
              $data['per'] = $config['per_page'];

              //load view
              $data['leader'] = $this->sermon_m->get_users();
              $this->template->title(' Sermons ')->build('admin/list', $data);
         }

         /**
          * Add New Sermons 
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
              {
                   $file = '';
                   if (!empty($_FILES['file']['name']))
                   {
                        $this->load->library('files_uploader');
                        $upload_data = $this->files_uploader->upload('file');
                        $file = $upload_data['file_name'];
                   }

                   $user = $this->ion_auth->get_user();
                   $form_data = array(
                           'service_date' => strtotime($this->input->post('service_date')),
                           'title' => $this->input->post('title'),
                           'service_leader' => $this->input->post('service_leader'),
                           'first_service' => $this->input->post('first_service'),
                           'second_service' => $this->input->post('second_service'),
                           'pastor_on_duty' => $this->input->post('pastor_on_duty'),
                           'sermon_theme' => $this->input->post('sermon_theme'),
                           'description' => $this->input->post('description'),
                           'file' => $file,
                           'created_by' => $user->id,
                           'created_on' => time()
                   );

                   $ok = $this->sermon_m->create($form_data);

                   if ($ok) // the information has therefore been successfully saved in the db
                   {
                        $this->sync->log_new('sermons', array($ok));
                        $this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Sermons ' . lang('web_create_success')));
                   }
                   else
                   {
                        $this->session->set_flashdata('error', array('type' => 'error', 'text' => 'Sermons ' . lang('web_create_failed')));
                   }

                   redirect('admin/sermons/');
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
                   $data['leader'] = $this->sermon_m->get_users();
                   //$users = $this->sermon_m->get_users();
                   //$data['users']=$users;
                   //load the view and the layout
                   $this->template->title('Add Sermons ')->build('admin/create', $data);
              }
         }

         /**
          * Edit  Sermons 
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
                   redirect('admin/sermons/');
              }
              if (!$this->sermon_m->exists($id))
              {
                   $this->session->set_flashdata('error', array('type' => 'warning', 'text' => lang('web_object_not_exist')));
                   redirect('admin/sermons');
              }
              //search the item to show in edit form
              $get = $this->sermon_m->find($id);

              //Rules for validation
              $this->form_validation->set_rules($this->validation());

              //create control variables
              $data['updType'] = 'edit';
              $data['page'] = $page;

              if ($this->form_validation->run())  //validation has been passed
              {
                   $array_thumbnails = array();
                   $data['sermon_m'] = $this->sermon_m->find($id);

                   $this->load->library('upload');
                   $this->load->library('image_lib');

                   foreach ($_FILES as $index => $value)
                   {
                        if ($value['name'] != '')
                        {
                             //uploads rules for $index
                             if ($index == 'upload_sermon')
                             {
                                  $this->upload->initialize($this->set_upload_options('sermons', 'upload_sermon'));
                             }

                             //upload the image
                             if (!$this->upload->do_upload($index))
                             {
                                  $data['upload_error'][$index] = $this->upload->display_errors("<span class='error'>", "</span>");
                                  //load the view and the layout
                                  $this->template->build('admin/create', $data);

                                  return FALSE;
                             }
                             else
                             {
                                  //create an array to send to image_lib library to create the thumbnail
                                  $info_upload = $this->upload->data();

                                  //Save the name an array to save on BD before
                                  $form_data_aux[$index] = $info_upload["file_name"];

                                  //Initializing the imagelib library to create the thumbnail
                                  if (in_array($index, $array_thumbnails))
                                  {
                                       //create the thumbnail
                                       if (!$this->image_lib->resize())
                                       {
                                            $data['upload_error'][$index] = $this->image_lib->display_errors("<span class='error'>", "</span>");

                                            //load the view and the layout
                                            $this->template->build('admin/create', $data);

                                            return FALSE;
                                       }
                                  }
                             }
                        }
                   }

                   $user = $this->ion_auth->get_user();
                   // build array for the model
                   $form_data = array(
                           'service_date' => strtotime($this->input->post('service_date')),
                           'title' => $this->input->post('title'),
                           'service_leader' => $this->input->post('service_leader'),
                           'first_service' => $this->input->post('first_service'),
                           'second_service' => $this->input->post('second_service'),
                           'pastor_on_duty' => $this->input->post('pastor_on_duty'),
                           'sermon_theme' => $this->input->post('sermon_theme'),
                           'description' => $this->input->post('description'),
                           'modified_by' => $user->id,
                           'modified_on' => time()
                   );

                   $done = $this->sermon_m->update_attributes($id, $form_data);
                   // the information has therefore been successfully saved in the db
                   if ($done)
                   {
                        $this->sync->log_update('sermons', $id, $form_data);
                        $this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Sermons ' . lang('web_edit_success')));
                        redirect("admin/sermons/");
                   }
                   else
                   {
                        $this->session->set_flashdata('error', array('type' => 'error', 'text' => $done->errors->full_messages()));
                        redirect("admin/sermons/");
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
              $data['leader'] = $this->sermon_m->get_users();
              //load the view and the layout
              $this->template->title('Edit Sermons ')->build('admin/create', $data);
         }

         function delete($id = NULL, $page = 1)
         {
              //redirect if its not correct
              if (!$id)
              {
                   $this->session->set_flashdata('error', array('type' => 'warning', 'text' => lang('web_object_not_exist')));
                   redirect('admin/sermons');
              }

              //search the item to delete
              if (!$this->sermon_m->exists($id))
              {
                   $this->session->set_flashdata('error', array('type' => 'warning', 'text' => lang('web_object_not_exist')));

                   redirect('admin/sermons');
              }
              else
                   $sermon_m = $this->sermon_m->find($id);

              //delete the item
              if ($this->sermon_m->delete($id) == TRUE)
              {
                   $this->sync->log_delete('sermons', $id);
                   $this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Sermons ' . lang('web_delete_success')));
              }
              else
              {
                   $this->session->set_flashdata('error', array('type' => 'error', 'text' => lang('web_delete_failed')));
              }

              redirect("admin/sermons/");
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
                              'field' => 'service_date',
                              'label' => 'Service Date',
                              'rules' => 'required|xss_clean'),
                      array(
                              'field' => 'title',
                              'label' => 'Title',
                              'rules' => 'required|trim|xss_clean|min_length[0]|max_length[60]'),
                      array(
                              'field' => 'service_leader',
                              'label' => 'Service Leader',
                              'rules' => 'required|trim|xss_clean|min_length[0]|max_length[60]'),
                      array(
                              'field' => 'first_service',
                              'label' => 'First Service',
                              'rules' => 'required|trim|xss_clean|min_length[0]|max_length[60]'),
                      array(
                              'field' => 'second_service',
                              'label' => 'Second Service',
                              'rules' => 'trim|xss_clean|min_length[0]|max_length[60]'),
                      array(
                              'field' => 'pastor_on_duty',
                              'label' => 'Pastor On Duty',
                              'rules' => 'required|xss_clean'),
                      array(
                              'field' => 'sermon_theme',
                              'label' => 'Sermon Theme',
                              'rules' => 'required|trim|xss_clean|min_length[0]|max_length[500]'),
                      array(
                              'field' => 'file',
                              'label' => 'File',
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
              $config['base_url'] = site_url() . 'admin/sermons/index/';
              $config['use_page_numbers'] = TRUE;
              $config['per_page'] = 10;
              $config['total_rows'] = $this->sermon_m->count();
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
              if ($field == 'upload_sermon')
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
    