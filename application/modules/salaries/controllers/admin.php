<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    class Admin extends Admin_Controller
    {

         function __construct()
         {
              parent::__construct();
              /* $this->template->set_layout('default');
                $this->template->set_partial('sidebar', 'partials/sidebar.php')
                ->set_partial('top', 'partials/top.php'); */
              if (!$this->ion_auth->logged_in())
              {
                   redirect('admin/login');
              }

              if (!$this->ion_auth->is_in_group($this->user->id, 1) && !$this->ion_auth->is_in_group($this->user->id, 7))
              {
                   $this->session->set_flashdata('message', array('type' => 'success', 'text' => '<b style="color:red">Sorry you do not have permission to access this Module!!</b>'));
                   redirect('admin');
              }

              $this->load->model('salaries_m');
         }

         public function index()
         {
              $config = $this->set_paginate_options();  //Initialize the pagination class
              $this->pagination->initialize($config);

              $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 1;

              $data['salaries'] = $this->salaries_m->paginate_all($config['per_page'], $page);

              //create pagination links
              $data['links'] = $this->pagination->create_links();


              //page number  variable
              $data['page'] = $page;
              $data['per'] = $config['per_page'];

              $data['updType'] = 'edit';

              $data['deductions'] = $this->salaries_m->list_deductions();
              $data['allowances'] = $this->salaries_m->list_allowances();

              $data['dd'] = $this->salaries_m->populate('deductions', 'id', 'name');
              $data['ll'] = $this->salaries_m->populate('allowances', 'id', 'name');
              $data['users'] = $this->ion_auth->list_users();
              //load view
              $this->template->title(' Salaries ')->build('admin/list', $data);
         }

         function create($page = NULL)
         {
              //create control variables
              $data['updType'] = 'create';
              $form_data_aux = array();
              $data['page'] = ( $this->uri->segment(4) ) ? $this->uri->segment(4) : $page;

              $data['deductions'] = $this->salaries_m->populate('deductions', 'id', 'name');
              $data['allowances'] = $this->salaries_m->populate('allowances', 'id', 'name');

              //Rules for validation
              $this->form_validation->set_rules($this->validation());

              /**
               * * List Salaried Employees 
               * * Create View
               * */
              $data['post'] = $this->salaries_m->get_all();

              //validate the fields of form
              if ($this->form_validation->run())
              {         //Validation OK!
                   $emp = $this->input->post('employee');

                   if ($this->salaries_m->exists_employee($emp))
                   {
                        $this->session->set_flashdata('message', array('type' => 'warning', 'text' => '<b style="color:red">Sorry this Employee has been added to salary records!!</b>'));
                        redirect('admin/salaries');
                   }

                   $user = $this->ion_auth->get_user();

                   //Compute Nhif

                   $basic_salo = $this->input->post('basic_salary');

                   $nhif = $this->get_nhif($basic_salo);

                   $form_data = array(
                           'employee' => $emp,
                           'salary_method' => $this->input->post('salary_method'),
                           'basic_salary' => $basic_salo,
                           'bank_name' => $this->input->post('bank_name'),
                           'bank_account_no' => $this->input->post('bank_account_no'),
                           'nhif' => $this->input->post('nhif'),
                           'nhif_no' => $this->input->post('nhif_no'),
                           'nssf_no' => $this->input->post('nssf_no'),
                           'created_by' => $user->id,
                           'created_on' => time()
                   );

                   $ok = $this->salaries_m->create($form_data);

                   if ($ok) // the information has therefore been successfully saved in the db
                   {
                        /*                         * NSERT DEDUCTIONS*** */
                        $deducs = array();
                        $deducs = $this->input->post('deductions');

                        foreach ($deducs as $dd)
                        {
                             $deducs_vals = array(
                                     'salary_id' => $ok,
                                     'deduction_id' => $dd,
                                     'created_by' => $user->id,
                                     'created_on' => time()
                             );

                             $this->salaries_m->insert_deducs($deducs_vals);
                        }



                        /*                         * NSERT ALLOWANCE*** */
                        $allws = array();
                        $allws = $this->input->post('allowances');

                        foreach ($allws as $ll)
                        {
                             $allwnce_vals = array(
                                     'salary_id' => $ok,
                                     'allowance_id' => $ll,
                                     'created_by' => $user->id,
                                     'created_on' => time()
                             );

                             $this->salaries_m->insert_allws($allwnce_vals);
                        }

                        $this->session->set_flashdata('message', array('type' => 'success', 'text' => lang('web_create_success')));
                   }
                   else
                   {
                        $this->session->set_flashdata('message', array('type' => 'error', 'text' => lang('web_create_failed')));
                   }

                   redirect('admin/salaries/');
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
                   $data['users'] = $this->ion_auth->list_users();
                   //load the view and the layout
                   $this->template->title('Add Salaries ')->build('admin/create', $data);
              }
         }

         function edit($id = FALSE, $page = 0)
         {
              //redirect if no $id
              if (!$id)
              {
                   $this->session->set_flashdata('message', array('type' => 'warning', 'text' => lang('web_object_not_exist')));
                   redirect('admin/salaries/');
              }
              if (!$this->salaries_m->exists($id))
              {
                   $this->session->set_flashdata('message', array('type' => 'warning', 'text' => lang('web_object_not_exist')));
                   redirect('admin/salaries');
              }

              $data['deductions'] = $this->salaries_m->populate('deductions', 'id', 'name');
              $data['allowances'] = $this->salaries_m->populate('allowances', 'id', 'name');
              //search the item to show in edit form
              $get = $this->salaries_m->find($id);

              //Rules for validation
              $this->form_validation->set_rules($this->validation());

              //create control variables
              $data['updType'] = 'edit';
              $data['page'] = $page;

              if ($this->form_validation->run())  //validation has been passed
              {

                   $basic_salo = $this->input->post('basic_salary');
                   $user = $this->ion_auth->get_user();
                   $nhif = $this->get_nhif($basic_salo);

                   // build array for the model
                   $form_data = array(
                           'employee' => $this->input->post('employee'),
                           'salary_method' => $this->input->post('salary_method'),
                           'basic_salary' => $this->input->post('basic_salary'),
                           'bank_name' => $this->input->post('bank_name'),
                           'bank_account_no' => $this->input->post('bank_account_no'),
                           'nhif' => $this->input->post('nhif'),
                           'nhif_no' => $this->input->post('nhif_no'),
                           'nssf_no' => $this->input->post('nssf_no'),
                           'modified_by' => $user->id,
                           'modified_on' => time());

                   $done = $this->salaries_m->update_attributes($id, $form_data);

                   // the information has therefore been successfully saved in the db
                   if ($done)
                   {
                        //$this->sync->log_update('salaries', $id, $form_data);
                        /*                         * INSERT DEDUCTIONS*** */
                        $deducs = array();
                        $deducs = $this->input->post('deductions');

                        $this->salaries_m->delete_deductions($id);
                        $this->sync->log_delete('employee_deductions', $id);
                        foreach ($deducs as $dd)
                        {
                             $deducs_vals = array(
                                     'salary_id' => $id,
                                     'deduction_id' => $dd,
                                     'created_by' => $user->id,
                                     'created_on' => time()
                             );

                             $in = $this->salaries_m->insert_deducs($deducs_vals);
                             $this->sync->log_new('employee_deductions', array($in));
                        }

                        /*                         * NSERT ALLOWANCE*** */

                        $this->salaries_m->delete_allowances($id);
                        $this->sync->log_delete('employee_allowances', $id);

                        $allws = $this->input->post('allowances');

                        foreach ($allws as $ll)
                        {
                             $allwnce_vals = array(
                                     'salary_id' => $id,
                                     'allowance_id' => $ll,
                                     'created_by' => $user->id,
                                     'created_on' => time()
                             );

                             $aw = $this->salaries_m->insert_allws($allwnce_vals);
                             $this->sync->log_new('employee_allowances', array($aw));
                        }

                        $this->session->set_flashdata('message', array('type' => 'success', 'text' => lang('web_edit_success')));
                        redirect("admin/salaries/");
                   }
                   else
                   {
                        $this->session->set_flashdata('message', array('type' => 'error', 'text' => $done->errors->full_messages()));
                        redirect("admin/salaries/");
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
              $data['users'] = $this->ion_auth->list_users();
              //load the view and the layout
              $this->template->title('Edit Salaries ')->build('admin/edit', $data);
         }

         function get_nhif($salo)
         {
              switch ($salo)
              {
                   case $salo < 1499:
                        $nhif = 30;
                        break;

                   case $salo < 1999:
                        $nhif = 40;
                        break;
                   case $salo < 2999:
                        $nhif = 60;
                        break;

                   case $salo < 3999:
                        $nhif = 80;
                        break;
                   case $salo < 4999:
                        $nhif = 100;
                        break;
                   case $salo < 5999:
                        $nhif = 120;
                        break;
                   case $salo < 6999:
                        $nhif = 140;
                        break;
                   case $salo < 7999:
                        $nhif = 160;
                        break;
                   case $salo < 9999:
                        $nhif = 200;
                        break;

                   case $salo < 10999:
                        $nhif = 220;
                        break;
                   case $salo < 11999:
                        $nhif = 240;
                        break;
                   case $salo < 12999:
                        $nhif = 260;
                        break;
                   case $salo < 13999:
                        $nhif = 280;
                        break;
                   case $salo < 14999:
                        $nhif = 300;
                        break;
                   default:
                        $nhif = 320;
                        break;
              }
              return $nhif;
         }

         function delete($id = NULL, $page = 1)
         {
              //filter & Sanitize $id
              $id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;

              //redirect if its not correct
              if (!$id)
              {
                   $this->session->set_flashdata('message', array('type' => 'warning', 'text' => lang('web_object_not_exist')));

                   redirect('admin/salaries');
              }

              //search the item to delete
              if (!$this->salaries_m->exists($id))
              {
                   $this->session->set_flashdata('message', array('type' => 'warning', 'text' => lang('web_object_not_exist')));

                   redirect('admin/salaries');
              }

              //delete the item
              if ($this->salaries_m->delete($id) == TRUE)
              {
                   $this->sync->log_delete('salaries', $id);
                   $this->sync->log_delete('employee_deductions', $id);
                   $this->sync->log_delete('employee_allowances', $id);
                   $this->salaries_m->delete_deductions($id);
                   $this->salaries_m->delete_allowances($id);
                   $this->session->set_flashdata('message', array('type' => 'success', 'text' => lang('web_delete_success')));
              }
              else
              {
                   $this->session->set_flashdata('message', array('type' => 'error', 'text' => lang('web_delete_failed')));
              }

              redirect("admin/salaries/");
         }

         private function validation()
         {
              $config = array(
                      array(
                              'field' => 'employee',
                              'label' => 'Employ',
                              'rules' => 'required|xss_clean'),
                      array(
                              'field' => 'salary_method',
                              'label' => 'Salary Method',
                              'rules' => 'required|xss_clean'),
                      array(
                              'field' => 'nhif',
                              'label' => 'nhif',
                              'rules' => 'required|xss_clean'),
                      array(
                              'field' => 'deductions',
                              'label' => 'Deductions',
                              'rules' => 'xss_clean'),
                      array(
                              'field' => 'allowances',
                              'label' => 'Allowances',
                              'rules' => 'xss_clean'),
                      array(
                              'field' => 'basic_salary',
                              'label' => 'Basic Salary',
                              'rules' => 'required|trim|xss_clean|min_length[0]|max_length[60]'),
                      array(
                              'field' => 'bank_name',
                              'label' => 'Bank Name',
                              'rules' => 'trim|xss_clean|min_length[0]|max_length[60]'),
                      array(
                              'field' => 'bank_account_no',
                              'label' => 'Bank Account No',
                              'rules' => 'trim|xss_clean|min_length[0]|max_length[60]'),
                      array(
                              'field' => 'nhif_no',
                              'label' => 'Nhif No',
                              'rules' => 'trim|xss_clean|min_length[0]|max_length[60]'),
                      array(
                              'field' => 'nssf_no',
                              'label' => 'Nssf No',
                              'rules' => 'trim|xss_clean|min_length[0]|max_length[60]'),
              );
              $this->form_validation->set_error_delimiters("<br /><span class='error'>", '</span>');
              return $config;
         }

         private function set_paginate_options()
         {
              $config = array();
              $config['base_url'] = site_url() . 'admin/salaries/index/';
              $config['use_page_numbers'] = TRUE;
              $config['per_page'] = 10;
              $config['total_rows'] = $this->salaries_m->count();
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
    