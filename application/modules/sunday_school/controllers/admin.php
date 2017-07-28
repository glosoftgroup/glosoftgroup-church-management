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
              $this->load->model('sunday_school_m');
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
              $sunday_school = $this->sunday_school_m->paginate_all($config['per_page'], $page);
              $data['sunday_school'] = $sunday_school;
              //create pagination links
              $data['links'] = $this->pagination->create_links();
              $data['parent'] = $this->sunday_school_m->ss_parent_details();

              //page number  variable
              $data['page'] = $page;
              $data['per'] = $config['per_page'];

              //load view
              $this->template->title(' Sunday School ')->build('admin/list', $data);
         }

         /**
          * Add New Sunday School 
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

              $file = '';
              if (!empty($_FILES['file']['name']))
              {
                   $this->load->library('files_uploader');
                   $upload_data = $this->files_uploader->upload('file');
                   $file = $upload_data['file_name'];
              }

              //validate the fields of form
              if ($this->form_validation->run())
              {         //Validation OK!
                   $user = $this->ion_auth->get_user();

                   $form_data = array(
                           'date_joined' => strtotime($this->input->post('date_joined')),
                           'first_name' => $this->input->post('first_name'),
                           'parent_id' => $this->input->post('parent_id'),
                           'type' => $this->input->post('type'),
                           'last_name' => $this->input->post('last_name'),
                           'dob' => strtotime($this->input->post('dob')),
                           'gender' => $this->input->post('gender'),
                           'relationship' => $this->input->post('relationship'),
                           'home_phone' => $this->input->post('home_phone'),
                           'residential' => $this->input->post('residential'),
                           'baptised' => $this->input->post('baptised'),
                           'confirmed' => $this->input->post('confirmed'),
                           'how_joined' => $this->input->post('how_joined'),
                           'special_interest' => $this->input->post('special_interest'),
                           'strengths' => $this->input->post('strengths'),
                           'weaknesses' => $this->input->post('weaknesses'),
                           'health' => $this->input->post('health'),
                           'passport' => $file,
                           'additionals' => $this->input->post('additionals'),
                           'created_by' => $user->id,
                           'created_on' => time()
                   );

                   $ok = $this->sunday_school_m->create($form_data);

                   if ($ok) // the information has therefore been successfully saved in the db
                   {
                        $this->sync->log_new('sunday_school', array($ok));
                        if ($this->input->post('type') == 0)
                        {
                             $paro_data = array(
                                     'child_id' => $ok,
                                     'first_name' => $this->input->post('first_name1'),
                                     'last_name' => $this->input->post('last_name1'),
                                     'gender' => $this->input->post('gender1'),
                                     'county' => $this->input->post('county'),
                                     'location' => $this->input->post('location1'),
                                     'phone1' => $this->input->post('phone11'),
                                     'phone2' => $this->input->post('phone2'),
                                     'address' => $this->input->post('address1'),
                                     'email' => $this->input->post('email1'),
                                     'relationship' => $this->input->post('relationship1'),
                                     'additionals' => $this->input->post('additionals1'),
                                     'created_by' => $user->id,
                                     'created_on' => time()
                             );

                             $ss = $this->sunday_school_m->insert_paro($paro_data);
                             $this->sync->log_new('ss_parents', array($ss));
                        }
                        elseif ($this->input->post('type') == 1)
                        {
                             $mm = $this->ion_auth->get_single_member($this->input->post('parent_id'));
                             $paro_data = array(
                                     'child_id' => $ok,
                                     'first_name' => $mm->first_name,
                                     'last_name' => $mm->last_name,
                                     'gender' => $mm->gender,
                                     'county' => $mm->county,
                                     'location' => $mm->location,
                                     'phone1' => $mm->phone1,
                                     'phone2' => $mm->phone2,
                                     'address' => $mm->address,
                                     'email' => $mm->email,
                                     'relationship' => $this->input->post('relationship'),
                                     'additionals' => $mm->description,
                                     'created_by' => $user->id,
                                     'created_on' => time()
                             );

                             $sn = $this->sunday_school_m->insert_paro($paro_data);
                             $this->sync->log_new('ss_parents', array($sn));
                        }

                        $this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Sunday School ' . lang('web_create_success')));
                   }
                   else
                   {
                        $this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Sunday School ' . lang('web_create_failed')));
                   }

                   redirect('admin/sunday_school/');
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
                   $data['parents'] = $this->ion_auth->get_member();
                   //load the view and the layout
                   $this->template->title('Add Sunday School ')->build('admin/create', $data);
              }
         }

         function search()
         {
              $id = $this->input->post('child_id');

              if (!empty($id))
              {
                   redirect('admin/sunday_school/profile/' . $id);
              }
              else
              {
                   $this->session->set_flashdata('error', array('type' => 'warning', 'text' => lang('web_object_not_exist')));
                   redirect('admin/sunday_school');
              }
         }

         function profile($id = FALSE)
         {
              if (!$id)
              {
                   $this->session->set_flashdata('error', array('type' => 'warning', 'text' => lang('web_object_not_exist')));
                   redirect('admin/sunday_school//');
              }
              if (!$this->sunday_school_m->exists($id))
              {
                   $this->session->set_flashdata('error', array('type' => 'warning', 'text' => lang('web_object_not_exist')));
                   redirect('admin/sunday_school');
              }
              $p = $this->sunday_school_m->find($id);
              $new_paro = $this->sunday_school_m->get_ssparent($id);
              $member_paro = $this->sunday_school_m->get_single_parent($p->parent_id);
              if ($p->type == 1)
              {
                   $data['post'] = $member_paro;
              }
              else
              {
                   $data['post'] = $new_paro;
              }

              $p_details = '';
              if ($p->type == 0)
              {
                   $p_details = $this->sunday_school_m->ss_parent($id);
              }
              elseif ($p->type == 1)
              {
                   $p_details = $this->sunday_school_m->get_parent($p->parent_id);
              }

              $data['p_details'] = $p_details;
              $data['p'] = $p;
              $data['result'] = $p;
              $data['children'] = $this->sunday_school_m->get_childen();
              $data['parents'] = $this->ion_auth->get_member();

              //load the view and the layout
              $this->template->title(' Sunday School Register')->build('admin/profile', $data);
         }

         /**
          * Edit  Sunday School 
          *
          * @param $id
          * @param $page
          */
         function edit($id = FALSE, $page = 0)
         {
              if (!$id)
              {
                   $this->session->set_flashdata('error', array('type' => 'warning', 'text' => lang('web_object_not_exist')));
                   redirect('admin/sunday_school/');
              }
              if (!$this->sunday_school_m->exists($id))
              {
                   $this->session->set_flashdata('error', array('type' => 'warning', 'text' => lang('web_object_not_exist')));
                   redirect('admin/sunday_school');
              }
              //search the item to show in edit form
              $get = $this->sunday_school_m->find($id);
              //Rules for validation
              $this->form_validation->set_rules($this->validation());

              //create control variables
              $data['updType'] = 'edit';
              $data['page'] = $page;

              if ($this->form_validation->run())  //validation has been passed
              {
                   $file = '';
                   if (!empty($_FILES['file']['name']))
                   {
                        $this->load->library('files_uploader');
                        $upload_data = $this->files_uploader->upload('file');
                        $file = $upload_data['file_name'];
                   }
                   else
                   {
                        $file = $get->passport;
                   }
                   $user = $this->ion_auth->get_user();
                   // build array for the model
                   $form_data = array(
                           'date_joined' => strtotime($this->input->post('date_joined')),
                           'first_name' => $this->input->post('first_name'),
                           'last_name' => $this->input->post('last_name'),
                           'dob' => strtotime($this->input->post('dob')),
                           'home_phone' => $this->input->post('home_phone'),
                           'residential' => $this->input->post('residential'),
                           'baptised' => $this->input->post('baptised'),
                           'confirmed' => $this->input->post('confirmed'),
                           'how_joined' => $this->input->post('how_joined'),
                           'gender' => $this->input->post('gender'),
                           'special_interest' => $this->input->post('special_interest'),
                           'strengths' => $this->input->post('strengths'),
                           'weaknesses' => $this->input->post('weaknesses'),
                           'health' => $this->input->post('health'),
                           'passport' => $file,
                           'additionals' => $this->input->post('additionals'),
                           'modified_by' => $user->id,
                           'modified_on' => time());

                   $done = $this->sunday_school_m->update_attributes($id, $form_data);

                   // the information has therefore been successfully saved in the db
                   if ($done)
                   {
                        $this->sync->log_update('sunday_school', $id, $form_data);
                        $this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Sunday School ' . lang('web_edit_success')));
                        redirect("admin/sunday_school/profile/" . $id);
                   }
                   else
                   {
                        $this->session->set_flashdata('error', array('type' => 'error', 'text' => $done->errors->full_messages()));
                        redirect("admin/sunday_school");
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

              $p_details = '';
              if ($get->type == 0)
              {

                   $p_details = $this->sunday_school_m->ss_parent($id);
              }
              elseif ($get->type == 1)
              {

                   $p_details = $this->sunday_school_m->get_parent($get->parent_id);
              }

              $data['p_details'] = $p_details;
              $post_r = new StdClass();

              foreach ($this->validation() as $field)
              {
                   $post_r->$field['field'] = set_value($field['field']);
              }

              $data['post'] = $post_r;
              $data['result'] = $get;
              $data['parents'] = $this->ion_auth->get_member('members', 'id', 'first_name' . ' ' . 'last_name');
              //load the view and the layout
              $this->template->title('Edit Sunday School ')->build('admin/edit', $data);
         }

         function remove_parent($id)
         {
              //redirect if no $id
              if (!$id)
              {
                   $this->session->set_flashdata('error', array('type' => 'warning', 'text' => lang('web_object_not_exist')));
                   redirect('admin/sunday_school/');
              }
              if (!$this->sunday_school_m->exists($id))
              {
                   $this->session->set_flashdata('error', array('type' => 'warning', 'text' => lang('web_object_not_exist')));
                   redirect('admin/sunday_school');
              }
              $user = $this->ion_auth->get_user();
              // build array for the model
              $form_data = array(
                      'relationship' => 0,
                      'parent_id' => 0,
                      'modified_by' => $user->id,
                      'modified_on' => time()
              );

              //find the item to update
              $this->sunday_school_m->update_attributes($id, $form_data);
              $this->sync->log_update('sunday_school', $id, $form_data);

              redirect('admin/sunday_school/edit/' . $id . '/1/1001');
         }

         function delete($id = NULL, $page = 1)
         {
              //redirect if its not correct
              if (!$id)
              {
                   $this->session->set_flashdata('error', array('type' => 'warning', 'text' => lang('web_object_not_exist')));
                   redirect('admin/sunday_school');
              }

              //search the item to delete
              if (!$this->sunday_school_m->exists($id))
              {
                   $this->session->set_flashdata('error', array('type' => 'warning', 'text' => lang('web_object_not_exist')));
                   redirect('admin/sunday_school');
              }

              //delete the item
              if ($this->sunday_school_m->delete($id) == TRUE)
              {
                   $this->sync->log_delete('sunday_school', $id);
                   $this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Sunday School ' . lang('web_delete_success')));
              }
              else
              {
                   $this->session->set_flashdata('error', array('type' => 'error', 'text' => lang('web_delete_failed')));
              }

              redirect("admin/sunday_school/");
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
                              'field' => 'date_joined',
                              'label' => 'Reg Date',
                              'rules' => 'required|xss_clean'),
                      array(
                              'field' => 'first_name',
                              'label' => 'First Name',
                              'rules' => 'required|trim|xss_clean|min_length[0]|max_length[60]'),
                      array(
                              'field' => 'first_name1',
                              'label' => 'First Name',
                              'rules' => 'trim|xss_clean'),
                      array(
                              'field' => 'last_name',
                              'label' => 'Last Name',
                              'rules' => 'required|trim|xss_clean|min_length[0]|max_length[60]'),
                      array(
                              'field' => 'last_name1',
                              'label' => 'Last Name',
                              'rules' => 'trim|xss_clean'),
                      array(
                              'field' => 'dob',
                              'label' => 'Dob',
                              'rules' => 'required|trim|xss_clean|min_length[0]|max_length[60]'),
                      array(
                              'field' => 'gender',
                              'label' => 'Gender',
                              'rules' => 'required|trim|xss_clean|min_length[0]|max_length[60]'),
                      array(
                              'field' => 'gender1',
                              'label' => 'Gender',
                              'rules' => 'trim|xss_clean'),
                      array(
                              'field' => 'home_phone',
                              'label' => 'home phone',
                              'rules' => 'trim|xss_clean'),
                      array(
                              'field' => 'residential',
                              'label' => 'Residential',
                              'rules' => 'required|trim|xss_clean'),
                      array(
                              'field' => 'how_joined',
                              'label' => 'How Joined',
                              'rules' => 'required|trim|xss_clean'),
                      array(
                              'field' => 'baptised',
                              'label' => 'Baptised',
                              'rules' => 'required|trim|xss_clean'),
                      array(
                              'field' => 'confirmed',
                              'label' => 'Confirmed',
                              'rules' => 'required|trim|xss_clean'),
                      array(
                              'field' => 'special_interest',
                              'label' => 'Special Interest',
                              'rules' => 'trim|xss_clean|min_length[0]|max_length[500]'),
                      array(
                              'field' => 'strengths',
                              'label' => 'Strengths',
                              'rules' => 'trim|xss_clean|min_length[0]|max_length[500]'),
                      array(
                              'field' => 'weaknesses',
                              'label' => 'Weaknesses',
                              'rules' => 'trim|xss_clean|min_length[0]|max_length[500]'),
                      array(
                              'field' => 'health',
                              'label' => 'Health',
                              'rules' => 'trim|xss_clean|min_length[0]|max_length[500]'),
                      array(
                              'field' => 'passport',
                              'label' => 'Passport',
                              'rules' => 'trim|xss_clean|min_length[0]|max_length[60]'),
                      array(
                              'field' => 'additionals',
                              'label' => 'Additional Info',
                              'rules' => 'trim|xss_clean|min_length[0]|max_length[500]'),
                      array(
                              'field' => 'county',
                              'label' => 'County',
                              'rules' => 'trim|xss_clean'),
                      array(
                              'field' => 'location1',
                              'label' => 'Location',
                              'rules' => 'trim|xss_clean'),
                      array(
                              'field' => 'type',
                              'label' => 'type',
                              'rules' => 'trim|xss_clean'),
                      array(
                              'field' => 'phone2',
                              'label' => 'Phone2',
                              'rules' => 'trim|xss_clean'),
                      array(
                              'field' => 'relationship1',
                              'label' => 'relationship1',
                              'rules' => 'trim|xss_clean'),
                      array(
                              'field' => 'address1',
                              'label' => 'Address',
                              'rules' => 'trim|xss_clean'),
                      array(
                              'field' => 'email1',
                              'label' => 'Email',
                              'rules' => 'trim|xss_clean'),
                      array(
                              'field' => 'phone11',
                              'label' => 'Phone11',
                              'rules' => 'trim|xss_clean'),
                      array(
                              'field' => 'additionals1',
                              'label' => 'Additional',
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
              $config['base_url'] = site_url() . 'admin/sunday_school/index/';
              $config['use_page_numbers'] = TRUE;
              $config['per_page'] = 10;
              $config['total_rows'] = $this->sunday_school_m->count();
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
    