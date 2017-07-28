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
              $this->load->model('wedding_m');
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

              $data['weddings'] = $this->wedding_m->paginate_all($config['per_page'], $page);

              //create pagination links
              $data['links'] = $this->pagination->create_links();
              $data['updType'] = 'edit';

              //page number  variable
              $data['page'] = $page;
              $data['per'] = $config['per_page'];

              //load view
              $data['member'] = $this->ion_auth->get_member('members', 'id', 'first_name' . ' ' . 'last_name');
              $this->template->title(' Weddings ')->build('admin/list', $data);
         }

         /**
          * Add New Weddings 
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
                   $array_thumbnails = explode(",", "wedding_photo");
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
                           'wedding_date' => strtotime($this->input->post('wedding_date')),
                           'bride' => $this->input->post('bride'),
                           'bridegroom' => $this->input->post('bridegroom'),
                           'venue' => $this->input->post('venue'),
                           'file' => $file,
                           'status' => $this->input->post('status'),
                           'brief_description' => $this->input->post('brief_description'),
                           'created_by' => $user->id,
                           'created_on' => time()
                   );

                   $ok = $this->wedding_m->create($form_data);

                   if ($ok) // the information has therefore been successfully saved in the db
                   {
                        $this->sync->log_new('weddings', array($ok));
                        $this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Weddings ' . lang('web_create_success')));
                   }
                   else
                   {
                        $this->session->set_flashdata('error', array('type' => 'error', 'text' => 'Weddings ' . lang('web_create_failed')));
                   }

                   redirect('admin/weddings/');
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
                   $data['member'] = $this->ion_auth->get_member('members', 'id', 'first_name' . ' ' . 'last_name');
                   //load the view and the layout
                   $this->template->title('Add Weddings ')->build('admin/create', $data);
              }
         }

         /**
          * Edit  Weddings 
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
                   redirect('admin/weddings/');
              }
              if (!$this->wedding_m->exists($id))
              {
                   $this->session->set_flashdata('error', array('type' => 'warning', 'text' => lang('web_object_not_exist')));
                   redirect('admin/weddings');
              }
              //search the item to show in edit form
              $get = $this->wedding_m->find($id);

              $form_data_aux = array();
              $files_to_delete = array();
              //Rules for validation
              $this->form_validation->set_rules($this->validation());

              //create control variables
              $data['updType'] = 'edit';
              $data['page'] = $page;

              if ($this->form_validation->run())  //validation has been passed
              {
                   $array_thumbnails = explode(",", "wedding_photo");
                   $data['wedding_m'] = $this->wedding_m->find($id);

                   $this->load->library('upload');
                   $this->load->library('image_lib');

                   foreach ($_FILES as $index => $value)
                   {
                        if ($value['name'] != '')
                        {
                             //uploads rules for $index
                             if ($index == 'wedding_photo')
                             {
                                  $this->upload->initialize($this->set_upload_options('weddings', 'wedding_photo'));
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

                                  //Save the name of old files to delete
                                  array_push($files_to_delete, $data['wedding_m']->$index);

                                  //Initializing the imagelib library to create the thumbnail

                                  if (in_array($index, $array_thumbnails))
                                  {

                                       //thumbnails rules for $index
                                       if ($index == 'wedding_photo')
                                       {
                                            $this->image_lib->initialize($this->set_thumbnail_options($info_upload, 'weddings', 'wedding_photo'));
                                       }

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
                           'wedding_date' => strtotime($this->input->post('wedding_date')),
                           'bride' => $this->input->post('bride'),
                           'bridegroom' => $this->input->post('bridegroom'),
                           'venue' => $this->input->post('venue'),
                           'status' => $this->input->post('status'),
                           'brief_description' => $this->input->post('brief_description'),
                           'modified_by' => $user->id,
                           'modified_on' => time());

                   $done = $this->wedding_m->update_attributes($id, $form_data);

                   // the information has therefore been successfully saved in the db
                   if ($done)
                   {
                        $this->sync->log_update('weddings', $id, $form_data);
                        //delete the old images
                        foreach ($files_to_delete as $index)
                        {
                             if (is_file(FCPATH . 'uploads/weddings/' . $index))
                                  unlink(FCPATH . 'uploads/weddings/' . $index);

                             if (is_file(FCPATH . 'uploads/weddings/thumbs/' . $index))
                                  unlink(FCPATH . 'uploads/weddings/thumbs/' . $index);
                        }

                        $this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Weddings ' . lang('web_edit_success')));
                        redirect("admin/weddings/");
                   }

                   else
                   {
                        $this->session->set_flashdata('error', array('type' => 'error', 'text' => $done->errors->full_messages()));
                        redirect("admin/weddings/");
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
              $data['member'] = $this->ion_auth->get_member('members', 'id', 'first_name' . ' ' . 'last_name');
              //load the view and the layout
              $this->template->title('Edit Weddings ')->build('admin/create', $data);
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

                   redirect('admin/weddings');
              }

              //search the item to delete
              if (!$this->wedding_m->exists($id))
              {
                   $this->session->set_flashdata('error', array('type' => 'warning', 'text' => lang('web_object_not_exist')));

                   redirect('admin/weddings');
              }
              else
                   $wedding_m = $this->wedding_m->find($id);

              //Save the files into array to delete after
              array_push($files_to_delete, $wedding_m->wedding_photo);

              //delete the item
              if ($this->wedding_m->delete($id) == TRUE)
              {
                   $this->sync->log_delete('weddings', $id);
                   $this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Weddings ' . lang('web_delete_success')));

                   //delete the old images
                   foreach ($files_to_delete as $index)
                   {
                        if (is_file(FCPATH . 'uploads/weddings/' . $index))
                             unlink(FCPATH . 'uploads/weddings/img/' . $index);
                        if (is_file(FCPATH . 'public/uploads/weddings/thumbs/' . $index))
                             unlink(FCPATH . 'public/uploads/weddings/thumbs/' . $index);
                   }
              }
              else
              {
                   $this->session->set_flashdata('error', array('type' => 'error', 'text' => lang('web_delete_failed')));
              }

              redirect("admin/weddings/");
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
                              'field' => 'wedding_date',
                              'label' => 'Wedding Date',
                              'rules' => 'required|xss_clean'),
                      array(
                              'field' => 'bride',
                              'label' => 'Bride',
                              'rules' => 'required|xss_clean'),
                      array(
                              'field' => 'bridegroom',
                              'label' => 'Bridegroom',
                              'rules' => 'required|xss_clean'),
                      array(
                              'field' => 'venue',
                              'label' => 'Venue',
                              'rules' => 'required|trim|xss_clean'),
                      array(
                              'field' => 'file',
                              'label' => 'File',
                              'rules' => 'xss_clean'),
                      array(
                              'field' => 'status',
                              'label' => 'Status',
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
              $config['base_url'] = site_url() . 'admin/weddings/index/';
              $config['use_page_numbers'] = TRUE;
              $config['per_page'] = 10;
              $config['total_rows'] = $this->wedding_m->count();
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
              if ($field == 'wedding_photo')
              {
                   $config['upload_path'] = FCPATH . 'uploads/' . $controller . '/';
                   $config['allowed_types'] = 'gif|jpg|png';
                   $config['encrypt_name'] = TRUE;
                   $config['max_width'] = '2000';
                   $config['max_height'] = '1500';
                   $config['max_size'] = '2048';
              }
              //create controller upload folder if not exists
              if (!is_dir($config['upload_path']))
              {
                   mkdir(FCPATH . "uploads/$controller/", 777, TRUE);
                   mkdir(FCPATH . "uploads/$controller/thumbs/", 777, TRUE);
              }

              return $config;
         }

         private function set_thumbnail_options($info_upload, $controller, $field)
         {
              $config = array();
              $config['image_library'] = 'gd2';
              $config['source_image'] = FCPATH . 'uploads/' . $controller . '/' . $info_upload["file_name"];
              $config['new_image'] = FCPATH . 'uploads/' . $controller . '/thumbs/' . $info_upload["file_name"];
              $config['create_thumb'] = TRUE;
              if ($field == 'wedding_photo')
              {
                   $config['maintain_ratio'] = FALSE;
                   $config['master_dim'] = 'width';
                   $config['width'] = 100;
                   $config['height'] = 100;
                   $config['thumb_marker'] = '';
              }
              return $config;
         }

    }
    