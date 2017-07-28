<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    class Admin extends Admin_Controller
    {

         function __construct()
         {
              parent::__construct();
              /* $this->template->set_layout('default');
                $this->template->set_partial('sidebar', 'partials/sidebar.php')
                ->set_partial('footer', 'partials/footer.php')->set_partial('top', 'partials/top.php'); */
              if (!$this->ion_auth->logged_in())
              {
                   redirect('admin/login');
              }
              $this->load->model('baptism_m');
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

              $data['baptism'] = $this->baptism_m->paginate_all($config['per_page'], $page);

              //create pagination links
              $data['links'] = $this->pagination->create_links();
              $data['updType'] = 'edit';
              //page number  variable
              $data['page'] = $page;
              $data['per'] = $config['per_page'];
              $data['members'] = $this->ion_auth->get_members();
              $data['ss'] = $this->ion_auth->get_ss_school();

              //load view
              $this->template->title(' Baptism ')->build('admin/list', $data);
         }

         /**
          * Add New Baptism 
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
              {
                   //Validation OK!

                   $type = 0;
                   $mm = '';
                   if ($this->input->post('option') == 0)
                   {
                        $type = 1; //From Members Table
                        $mm = $this->input->post('member');
                   }
                   elseif ($this->input->post('option') == 1)
                   {
                        $type = 2; //From Sunday School Table
                        $mm = $this->input->post('sunday_school');
                   }
                   else
                   {
                        $this->session->set_flashdata('error', array('type' => 'error', 'text' => 'Option is required '));

                        redirect('admin/baptism/create');
                   }

                   $user = $this->ion_auth->get_user();
                   $form_data = array(
                           'date' => strtotime($this->input->post('date')),
                           'member' => $mm,
                           'ff_name' => $this->input->post('ff_name'),
                           'fl_name' => $this->input->post('fl_name'),
                           'father_religion' => $this->input->post('father_religion'),
                           'father_phone' => $this->input->post('father_phone'),
                           'father_email' => $this->input->post('father_email'),
                           'father_address' => $this->input->post('father_address'),
                           'mf_name' => $this->input->post('mf_name'),
                           'status' => 0,
                           'type' => $type,
                           'ml_name' => $this->input->post('ml_name'),
                           'mother_religion' => $this->input->post('mother_religion'),
                           'mother_phone' => $this->input->post('mother_phone'),
                           'mother_email' => $this->input->post('mother_email'),
                           'mother_address' => $this->input->post('mother_address'),
                           'gff_name' => $this->input->post('gff_name'),
                           'gfl_name' => $this->input->post('gfl_name'),
                           'gf_age' => $this->input->post('gf_age'),
                           'gf_phone' => $this->input->post('gf_phone'),
                           'gf_address' => $this->input->post('gf_address'),
                           'gmf_name' => $this->input->post('gmf_name'),
                           'gml_name' => $this->input->post('gml_name'),
                           'gm_age' => $this->input->post('gm_age'),
                           'gm_phone' => $this->input->post('gm_phone'),
                           'gm_address' => $this->input->post('gm_address'),
                           'description' => $this->input->post('description'),
                           'created_by' => $user->id,
                           'created_on' => time()
                   );

                   $ok = $this->baptism_m->create($form_data);

                   if ($ok) // the information has therefore been successfully saved in the db
                   {
                        $this->sync->log_new('baptism', array($ok));
                        $this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Baptism ' . lang('web_create_success')));
                   }
                   else
                   {
                        $this->session->set_flashdata('error', array('type' => 'error', 'text' => 'Baptism ' . lang('web_create_failed')));
                   }

                   redirect('admin/baptism/');
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
                   $data['members'] = $this->ion_auth->get_members();
                   $data['ss'] = $this->ion_auth->get_ss_school();
                   $this->template->title('Add Baptism Registration')->build('admin/create', $data);
              }
         }

         /**
          * Edit  Baptism 
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
                   redirect('admin/baptism/');
              }
              if (!$this->baptism_m->exists($id))
              {
                   $this->session->set_flashdata('error', array('type' => 'warning', 'text' => lang('web_object_not_exist')));
                   redirect('admin/baptism');
              }
              //search the item to show in edit form
              $get = $this->baptism_m->find($id);
              
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
                           'date' => strtotime($this->input->post('date')),
                           'member' => $this->input->post('member'),
                           'ff_name' => $this->input->post('ff_name'),
                           'fl_name' => $this->input->post('fl_name'),
                           'father_religion' => $this->input->post('father_religion'),
                           'father_phone' => $this->input->post('father_phone'),
                           'father_email' => $this->input->post('father_email'),
                           'father_address' => $this->input->post('father_address'),
                           'mf_name' => $this->input->post('mf_name'),
                           'ml_name' => $this->input->post('ml_name'),
                           'mother_religion' => $this->input->post('mother_religion'),
                           'mother_phone' => $this->input->post('mother_phone'),
                           'mother_email' => $this->input->post('mother_email'),
                           'mother_address' => $this->input->post('mother_address'),
                           'gff_name' => $this->input->post('gff_name'),
                           'gfl_name' => $this->input->post('gfl_name'),
                           'gf_age' => $this->input->post('gf_age'),
                           'gf_phone' => $this->input->post('gf_phone'),
                           'gf_address' => $this->input->post('gf_address'),
                           'gmf_name' => $this->input->post('gmf_name'),
                           'gml_name' => $this->input->post('gml_name'),
                           'gm_age' => $this->input->post('gm_age'),
                           'gm_phone' => $this->input->post('gm_phone'),
                           'gm_address' => $this->input->post('gm_address'),
                           'description' => $this->input->post('description'),
                           'modified_by' => $user->id,
                           'modified_on' => time());

                   //add the aux form data to the form data array to save
                   $form_data = array_merge($form_data_aux, $form_data);

                   //find the item to update

                   $done = $this->baptism_m->update_attributes($id, $form_data);

                   // the information has therefore been successfully saved in the db
                   if ($done)
                   {
                        $this->sync->log_update('baptism', $id, $form_data);
                        $this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Baptism ' . lang('web_edit_success')));
                        redirect("admin/baptism/");
                   }
                   else
                   {
                        $this->session->set_flashdata('error', array('type' => 'error', 'text' => $done->errors->full_messages()));
                        redirect("admin/baptism/");
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
              $data['ss'] = $this->ion_auth->get_ss_school();
              //load the view and the layout
              $this->template->title('Edit Baptism Registration ')->build('admin/edit', $data);
         }

         function delete($id = NULL, $page = 1)
         {
              //filter & Sanitize $id
              $id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;

              //redirect if its not correct
              if (!$id)
              {
                   $this->session->set_flashdata('error', array('type' => 'warning', 'text' => lang('web_object_not_exist')));

                   redirect('admin/baptism');
              }

              //search the item to delete
              if (!$this->baptism_m->exists($id))
              {
                   $this->session->set_flashdata('error', array('type' => 'warning', 'text' => lang('web_object_not_exist')));

                   redirect('admin/baptism');
              }

              //delete the item
              if ($this->baptism_m->delete($id) == TRUE)
              {
                   $this->sync->log_delete('baptism', $id);
                   $this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Baptism ' . lang('web_delete_success')));
              }
              else
              {
                   $this->session->set_flashdata('error', array('type' => 'error', 'text' => lang('web_delete_failed')));
              }

              redirect("admin/baptism/");
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
                              'field' => 'member',
                              'label' => 'Member',
                              'rules' => 'xss_clean'),
                      array(
                              'field' => 'sunday_school',
                              'label' => 'Sunday School',
                              'rules' => 'xss_clean'),
                      array(
                              'field' => 'option',
                              'label' => 'Option',
                              'rules' => 'xss_clean'),
                      array(
                              'field' => 'ff_name',
                              'label' => 'Ff Name',
                              'rules' => 'trim|xss_clean|min_length[0]|max_length[60]'),
                      array(
                              'field' => 'fl_name',
                              'label' => 'Fl Name',
                              'rules' => 'trim|xss_clean|min_length[0]|max_length[60]'),
                      array(
                              'field' => 'father_religion',
                              'label' => 'Father Religion',
                              'rules' => 'trim|xss_clean|min_length[0]|max_length[60]'),
                      array(
                              'field' => 'father_phone',
                              'label' => 'Father Phone',
                              'rules' => 'trim|xss_clean|min_length[0]|max_length[60]'),
                      array(
                              'field' => 'father_email',
                              'label' => 'Father Email',
                              'rules' => 'trim|xss_clean|valid_email|min_length[0]|max_length[60]'),
                      array(
                              'field' => 'father_address',
                              'label' => 'Father Address',
                              'rules' => 'trim|xss_clean|min_length[0]|max_length[500]'),
                      array(
                              'field' => 'mf_name',
                              'label' => 'Mf Name',
                              'rules' => 'trim|xss_clean|min_length[0]|max_length[60]'),
                      array(
                              'field' => 'ml_name',
                              'label' => 'Ml Name',
                              'rules' => 'trim|xss_clean|min_length[0]|max_length[60]'),
                      array(
                              'field' => 'mother_religion',
                              'label' => 'Mother Religion',
                              'rules' => 'trim|xss_clean|min_length[0]|max_length[60]'),
                      array(
                              'field' => 'mother_phone',
                              'label' => 'Mother Phone',
                              'rules' => 'trim|xss_clean|min_length[0]|max_length[60]'),
                      array(
                              'field' => 'mother_email',
                              'label' => 'Mother Email',
                              'rules' => 'trim|xss_clean|valid_email|min_length[0]|max_length[60]'),
                      array(
                              'field' => 'mother_address',
                              'label' => 'Mother Address',
                              'rules' => 'trim|xss_clean|min_length[0]|max_length[500]'),
                      array(
                              'field' => 'gff_name',
                              'label' => 'Gff Name',
                              'rules' => 'required|trim|xss_clean|min_length[0]|max_length[60]'),
                      array(
                              'field' => 'gfl_name',
                              'label' => 'Gfl Name',
                              'rules' => 'required|trim|xss_clean|min_length[0]|max_length[60]'),
                      array(
                              'field' => 'gf_age',
                              'label' => 'Gf Age',
                              'rules' => 'required|trim|xss_clean|min_length[0]|max_length[60]'),
                      array(
                              'field' => 'gf_phone',
                              'label' => 'Gf Phone',
                              'rules' => 'required|trim|xss_clean|min_length[0]|max_length[60]'),
                      array(
                              'field' => 'gf_address',
                              'label' => 'Gf Address',
                              'rules' => 'trim|xss_clean|min_length[0]|max_length[500]'),
                      array(
                              'field' => 'gmf_name',
                              'label' => 'Gmf Name',
                              'rules' => 'trim|xss_clean|min_length[0]|max_length[60]'),
                      array(
                              'field' => 'gml_name',
                              'label' => 'Gml Name',
                              'rules' => 'trim|xss_clean|min_length[0]|max_length[60]'),
                      array(
                              'field' => 'gm_age',
                              'label' => 'Gm Age',
                              'rules' => 'trim|xss_clean|min_length[0]|max_length[60]'),
                      array(
                              'field' => 'gm_phone',
                              'label' => 'Gm Phone',
                              'rules' => 'trim|xss_clean|min_length[0]|max_length[60]'),
                      array(
                              'field' => 'gm_address',
                              'label' => 'Gm Address',
                              'rules' => 'trim|xss_clean|min_length[0]|max_length[60]'),
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
              $config['base_url'] = site_url() . 'admin/baptism/index/';
              $config['use_page_numbers'] = TRUE;
              $config['per_page'] = 10;
              $config['total_rows'] = $this->baptism_m->count();
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
    