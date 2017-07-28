<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    class Admin extends Admin_Controller
    {

         function __construct()
         {
              parent::__construct();
              /* $this->template->set_layout('default');
                $this->template->set_partial('sidebar', 'partials/sidebar.php')
                ->set_partial('chat', 'partials/chat.php')
                ->set_partial('top', 'partials/top.php'); */

              $this->load->model('users_m');
         }

         public function index()
         {
              if (!$this->ion_auth->logged_in())
              {
                   redirect('admin/login');
              }
              
              $config = $this->set_paginate_options();
              //Initialize the pagination class
              $this->pagination->initialize($config);

              $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 1;

              //find all the categories with paginate and save it in array to past to the view
              $data['users'] = $this->users_m->paginate_all($config['per_page'], $page);

              //create pagination links
              $data['links'] = $this->pagination->create_links();

              //number page variable
              $data['page'] = $page;

              //load view
              $this->template->title('System Users')->build('admin/list', $data);
         }

         function search_around()
         {
              if (!$this->ion_auth->logged_in())
              {
                   echo json_encode(array('content' => 'login'));
                   exit();
              }
              $key = $this->input->post('search');
              $list = $this->users_m->search_list($key);
              $res = '';
              foreach ($list as $l)
              {
                   $res .= '<div class="show" align="left"><a href="' . base_url('admin/profile/' . $l->id) . '" > ' . theme_image('user-4.png', array('class' => 'img-circle', 'style' => "width:48px; height:48px; float:left; margin-right:6px;"));
                   $res .= '<span class="name" data-rec="' . $l->id . '"> ' . $l->first_name . ' ' . $l->last_name . ' </span>&nbsp;<br/>' . $l->email . '</a>  </div>';
              }

              echo json_encode(array('content' => $res));
         }

         //Update user
         function edit($id)
         {
              if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
              {
                   redirect('admin', 'refresh');
              }
              if (!$this->users_m->exists($id))
              {
                   $this->session->set_flashdata('error', lang('web_object_not_exist'));
                   redirect('admin/users');
              }
              $the_user = $this->ion_auth->get_user($id);

              $usr_groups = $this->ion_auth->get_users_groups($id)->result();

              $glist = array();
              foreach ($usr_groups as $grp)
              {
                   $glist[] = $grp->id;
              }
              $gs = $this->users_m->populate('groups', 'id', 'name');

              $this->data['groups_list'] = $gs;
              $sl = array();
              $sl = isset($_POST['groups']) ? $_POST['groups'] : $glist;


              $this->data['selected'] = $sl;
              //validate form input
              $this->form_validation->set_rules('first_name', 'First Name', 'required|xss_clean');
              $this->form_validation->set_rules('last_name', 'Last Name', 'required|xss_clean');
              $this->form_validation->set_rules('email', 'Email Address', 'required|valid_email');
              $this->form_validation->set_rules('phone', 'Phone', 'required|xss_clean|min_length[10]');
              //$this->form_validation->set_rules('phone2', 'Second Part of Phone', 'required|xss_clean|min_length[3]|max_length[3]');
              //$this->form_validation->set_rules('phone3', 'Third Part of Phone', 'required|xss_clean|min_length[4]|max_length[4]');

              $this->form_validation->set_rules('groups', 'Groups', 'required');
              // $this->form_validation->set_rules('company', 'Company Name', 'required|xss_clean');
              if ($this->input->post('password'))
              {
                   $this->form_validation->set_rules('password', 'Password', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
                   $this->form_validation->set_rules('password_confirm', 'Password Confirmation', 'required');
              }
              if ($this->form_validation->run() == true)
              {
                   $username = strtolower($this->input->post('first_name')) . ' ' . strtolower($this->input->post('last_name'));
                   $email = $this->input->post('email');
                   $password = $this->input->post('password');

                   $additional_data = array(
                           'username' => $username,
                           'email' => $email,
                           'password' => $password,
                           'first_name' => $this->input->post('first_name'),
                           'last_name' => $this->input->post('last_name'),
                           'phone' => $this->input->post('phone'),
                           'modified_by' => $this->ion_auth->get_user()->id,
                           'modified_on' => time(),
                   );

                   if (empty($password))
                   {
                        unset($additional_data['password']);
                   }
                   $this->ion_auth->update_user($id, $additional_data);

                   if (count($sl))
                   {
                        if ((in_array(1, $sl)) && (in_array(4, $sl)))
                        {
                             $this->session->set_flashdata('error', "Not Allowed!, Admin Can't be a Client");
                             redirect("admin/users", 'refresh');
                        }
                        if ((in_array(3, $sl)) && (in_array(4, $sl)))
                        {
                             $this->session->set_flashdata('error', "Not Allowed!, Media Monitor Can't be a Client");
                             redirect("admin/users", 'refresh');
                        }
//remove from existing groups
                        $this->ion_auth->remove_from_group(NULL, $id);
                        foreach ($sl as $d)
                        {
                             $this->ion_auth->add_to_group($d, $id);
                        }
                   }

//redirect them back to the admin page
                   $this->session->set_flashdata('message', "User Updated Successfully");
                   redirect("admin/users", 'refresh');
              }
              else
              { //display the create user form
//set the flash data error message if there is one
//$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
                   $this->data['first_name'] = array('name' => 'first_name',
                           'id' => 'first_name',
                           'type' => 'text',
                           'value' => $this->input->post('first_name') ? $this->input->post('first_name') : $the_user->first_name,
                   );
                   $this->data['last_name'] = array('name' => 'last_name',
                           'id' => 'last_name',
                           'type' => 'text',
                           'value' => $this->input->post('last_name') ? $this->input->post('last_name') : $the_user->last_name,
                   );
                   $this->data['email'] = array('name' => 'email',
                           'id' => 'email',
                           'type' => 'text',
                           'value' => $this->input->post('email') ? $this->input->post('email') : $the_user->email,
                   );
                   $this->data['phone'] = array('name' => 'phone',
                           'id' => 'phone',
                           'type' => 'text',
                           'value' => $this->input->post('phone') ? $this->input->post('phone') : $the_user->phone,
                   );

                   $this->data['password'] = array('name' => 'password',
                           'id' => 'password',
                           'type' => 'password',
                           'value' => $this->form_validation->set_value('password'),
                   );
                   $this->data['password_confirm'] = array('name' => 'password_confirm',
                           'id' => 'password_confirm',
                           'type' => 'password',
                           'value' => $this->form_validation->set_value('password_confirm'),
                   );
                   $this->template->title('Update User')->build('admin/edit_user', $this->data);
              }
         }

         function delete($id = NULL, $page = 1)
         {
              if (!$this->ion_auth->logged_in())
              {
                   redirect('admin/login');
              }
              if (!$this->ion_auth->is_admin())
              {
                   redirect('admin', 'refresh');
              }
//filter & Sanitize $id
              $id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;

//redirect if its not correct
              if (!$id OR $id == 1)
              {
                   $this->session->set_flashdata('error', lang('web_object_not_exist'));
                   redirect('admin/users');
              }

//search the item to delete
              if (!$this->users_m->exists($id))
              {
                   $this->session->set_flashdata('error', lang('web_object_not_exist'));
                   redirect('admin/users');
              }

//delete the item
              if ($this->users_m->delete($id) == TRUE)
              {
                   $this->session->set_flashdata('message', array('type' => 'success', 'text' => lang('web_delete_success')));
              }
              else
              {
                   $this->session->set_flashdata('error', array('type' => 'error', 'text' => lang('web_delete_failed')));
              }

              redirect("admin/users/");
         }

         private function validation()
         {
              $config = array(
                      array(
                              'field' => 'username',
                              'label' => 'Username',
                              'rules' => 'required|trim|xss_clean|min_length[0]|max_length[60]'),
                      array(
                              'field' => 'email',
                              'label' => 'Email',
                              'rules' => 'required|trim|xss_clean|min_length[0]|max_length[60]'),
                      array(
                              'field' => 'active',
                              'label' => 'Active',
                              'rules' => 'trim|xss_clean|min_length[0]|max_length[60]'),
              );
              $this->form_validation->set_error_delimiters("<br /><span class='error'>", '</span>');
              return $config;
         }

         private function set_paginate_options()
         {
              $config = array();
              $config['base_url'] = site_url() . 'admin/users/index/';
              $config['use_page_numbers'] = TRUE;
              $config['per_page'] = 30;
              $config['total_rows'] = $this->users_m->count();
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
              $config['full_tag_open'] = "<div class='pagination  pagination-centered'><ul>";
              $config['full_tag_close'] = '</ul></div>';
              $choice = $config["total_rows"] / $config["per_page"];
              //$config["num_links"] = round($choice);

              return $config;
         }

         //log the user in
         function login()
         {
              $this->template->set_layout('login');
              $this->data['title'] = "Login";

              if ($this->ion_auth->logged_in())
              {
//already logged in so no need to access this page
                   redirect('admin');
              }
//validate form input
              $this->form_validation->set_rules('email', 'Email Address', 'required|valid_email');
              $this->form_validation->set_rules('password', 'Password', 'required');

              if ($this->form_validation->run() == true)
              { //check to see if the user is logging in
                   //check for "remember me"
                   $remember = (bool) $this->input->post('remember');

                   if ($this->ion_auth->login($this->input->post('email'), $this->input->post('password'), $remember))
                   { //if the login is successful
                        //redirect them back to the home page
                        $this->session->set_flashdata('message', array('type' => 'success', 'text' => $this->ion_auth->messages()));
                        redirect('admin', 'refresh');
                   }
                   else
                   { //if the login was un-successful
                        //redirect them back to the login page
                        $this->session->set_flashdata('error', array('type' => 'error', 'text' => $this->ion_auth->errors()));
                        redirect('admin/login', 'refresh'); //use redirects instead of loading views for compatibility with CI_Controller libraries
                   }
              }
              else
              {  //the user is not logging in so display the login page
                   //set the flash data error message if there is one
                   $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

                   $this->data['email'] = array('name' => 'email',
                           'id' => 'username', //class="input-large span10" name="username" id="username"
                           'type' => 'text',
                           'class' => 'input-large span10',
                           'type' => 'text',
                           'value' => $this->form_validation->set_value('email'),
                   );
                   $this->data['password'] = array('name' => 'password',
                           'id' => 'password',
                           'type' => 'password',
                           'class' => 'input-large span10',
                   );

                   $this->template
                                ->set_partial('metadata', 'partials/metadata.html')
                                ->title('Welcome', 'Login')
                                ->build('admin/login', $this->data);
              }
         }

//log the user out
         function logout()
         {
              $this->data['title'] = "Logout";
//log the user out
              $logout = $this->ion_auth->logout();
//redirect them back to the page they came from
              redirect('admin/users', 'refresh');
         }

//change password
         function change_password()
         {

              redirect('admin/change_password');

              $this->form_validation->set_rules('old', 'Old password', 'required');
              $this->form_validation->set_rules('new', 'New Password', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
              $this->form_validation->set_rules('new_confirm', 'Confirm New Password', 'required');

              if (!$this->ion_auth->logged_in())
              {
                   redirect('admin/login', 'refresh');
              }
              $user = $this->ion_auth->get_user($this->session->userdata('user_id'));

              if ($this->form_validation->run() == false)
              { //display the form
//set the flash data error message if there is one
                   $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

                   $this->data['old_password'] = array('name' => 'old',
                           'id' => 'old',
                           'type' => 'password',
                   );
                   $this->data['new_password'] = array('name' => 'new',
                           'id' => 'new',
                           'type' => 'password',
                   );
                   $this->data['new_password_confirm'] = array('name' => 'new_confirm',
                           'id' => 'new_confirm',
                           'type' => 'password',
                   );
                   $this->data['user_id'] = array('name' => 'user_id',
                           'id' => 'user_id',
                           'type' => 'hidden',
                           'value' => $user->id,
                   );

                   $this->template
                                ->set_layout('default')
                                ->title('Admin', 'Change Password')
                                ->build('admin/change_password', $this->data);
              }
              else
              {
                   $identity = $this->session->userdata($this->config->item('identity', 'ion_auth'));

                   $change = $this->ion_auth->change_password($identity, $this->input->post('old'), $this->input->post('new'));

                   if ($change)
                   { //if the password was successfully changed
                        $this->session->set_flashdata('message', array('type' => 'success', 'text' => $this->ion_auth->messages()));
                        $this->logout();
                   }
                   else
                   {
                        $this->session->set_flashdata('error', array('type' => 'error', 'text' => $this->ion_auth->errors()));
                        redirect('admin/change_password', 'refresh');
                   }
              }
         }

//forgot password
         function forgot_password()
         {
              if ($this->ion_auth->logged_in())
              {
                   $this->ion_auth->logout();
                   redirect('admin/forgot_password');
              }
//get the identity type from config and send it when you load the view
              $identity = $this->config->item('identity', 'ion_auth');
              $identity_human = ucwords(str_replace('_', ' ', $identity)); //if someone uses underscores to connect words in the column names
              $this->form_validation->set_rules($identity, $identity_human, 'required');
              if ($this->form_validation->run() == false)
              {
//setup the input
                   $this->data[$identity] = array('name' => $identity,
                           'id' => $identity, //changed
                   );
//set any errors and display the form
                   $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
                   $this->data['identity'] = $identity;
                   $this->data['identity_human'] = $identity_human;
                   $this->template
                                ->set_layout('login')
                                ->title('Admin', 'Forgot Password')
                                ->build('admin/forgot_password', $this->data);
              }
              else
              {
//run the forgotten password method to email an activation code to the user
                   $forgotten = $this->ion_auth->forgotten_password($this->input->post($identity));

                   if ($forgotten)
                   { //if there were no errors
                        $this->session->set_flashdata('message', array('type' => 'success', 'text' => $this->ion_auth->messages()));
                        redirect('admin/login', 'refresh'); //we should display a confirmation page here instead of the login page
                   }
                   else
                   {
                        $this->session->set_flashdata('error', array('type' => 'error', 'text' => $this->ion_auth->errors()));
                        redirect('admin/forgot_password', 'refresh');
                   }
              }
         }

//reset password - final step for forgotten password
         public function reset_password($code)
         {
              $reset = $this->ion_auth->forgotten_password_complete($code);

              if ($reset)
              {  //if the reset worked then send them to the login page
                   $this->session->set_flashdata('message', array('type' => 'success', 'text' => $this->ion_auth->messages()));
                   redirect('admin/login', 'refresh');
              }
              else
              { //if the reset didnt work then send them back to the forgot password page
                   $this->session->set_flashdata('error', array('type' => 'error', 'text' => $this->ion_auth->errors()));
                   redirect('admin/users/forgot_password', 'refresh');
              }
         }

//activate the user
         function activate($id, $code = false)
         {
              if ($code !== false)
                   $activation = $this->ion_auth->activate($id, $code);
              else if ($this->ion_auth->is_admin())
                   $activation = $this->ion_auth->activate($id);


              if ($activation)
              {
//redirect them to the auth page
                   $this->session->set_flashdata('message', array('type' => 'success', 'text' => $this->ion_auth->messages()));
                   redirect('admin/users', 'refresh');
              }
              else
              {
//redirect them to the forgot password page
                   $this->session->set_flashdata('error', array('type' => 'error', 'text' => $this->ion_auth->errors()));
                   redirect('admin/users/forgot_password', 'refresh');
              }
         }

//deactivate the user
         function deactivate($id = NULL)
         {
              if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
              {
                   redirect('admin', 'refresh');
              }

//redirect if its not correct
              if (!$id OR $id == 1)
              {
                   $this->session->set_flashdata('error', lang('web_object_not_exist'));
                   redirect('admin');
              }
// no funny business, force to integer
              $id = (int) $id;
              if (!$this->users_m->exists($id))
              {
                   $this->session->set_flashdata('error', lang('web_object_not_exist'));
                   redirect('admin/users');
              }

              $this->form_validation->set_rules('confirm', 'confirmation', 'required');
              $this->form_validation->set_rules('id', 'user ID', 'required|is_natural');

              if ($this->form_validation->run() == FALSE)
              {

// insert csrf check
                   $this->data['csrf'] = $this->_get_csrf_nonce();
                   $this->data['user'] = $this->ion_auth->get_user_array($id);

                   $this->template
                                ->set_layout('default')
                                ->title('Admin', 'Deactivate User')
                                ->build('admin/deactivate_user', $this->data);
              }
              else
              {

// do we really want to deactivate?
                   if ($this->input->post('confirm') == 'yes')
                   {
// do we have a valid request?
                        if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id'))
                        {
                             $this->session->set_flashdata('error', array('type' => 'error', 'text' => $this->ion_auth->errors()));
                             redirect('admin/users/', 'refresh');
                        }

// do we have the right userlevel?
                        if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin())
                        {
                             $this->ion_auth->deactivate($id);
                        }
                   }
//redirect them back to the auth page
                   redirect('admin/users', 'refresh');
              }
         }

//create a new user
         function create()
         {
              if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
              {
                   redirect('admin', 'refresh');
              }

              $this->data['groups_list'] = $this->users_m->populate('groups', 'id', 'name');

              //validate form input
              $this->form_validation->set_rules('first_name', 'First Name', 'required|xss_clean');
              $this->form_validation->set_rules('last_name', 'Last Name', 'required|xss_clean');
              $this->form_validation->set_rules('email', 'Email Address', 'required|valid_email');
              //$this->form_validation->set_rules('company', 'Company Name', 'xss_clean');
              $this->form_validation->set_rules('phone', 'Phone', 'required|xss_clean');
              $this->form_validation->set_rules('password', 'Password', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
              $this->form_validation->set_rules('password_confirm', 'Password Confirmation', 'required');

              $this->form_validation->set_rules('groups', 'Groups', 'required');

              if ($this->form_validation->run() == true)
              {
                   $username = strtolower($this->input->post('first_name')) . ' ' . strtolower($this->input->post('last_name'));
                   $email = $this->input->post('email');
                   $password = $this->input->post('password');

                   $additional_data = array(
                           'first_name' => $this->input->post('first_name'),
                           'last_name' => $this->input->post('last_name'),
                           'phone' => $this->input->post('phone'),
                           'me' => $this->ion_auth->get_user()->id,
                   );
              }
              if ($this->form_validation->run() == true && $u_id = $this->ion_auth->register($username, $password, $email, $additional_data))
              { //check to see if we are creating the user
                   $gs = $this->input->post('groups');

                   if (isset($gs) && !empty($gs) && count($gs) > 0)
                   {
                        foreach ($gs as $d)
                        {
                             $this->ion_auth->add_to_group($d, $u_id);
                        }
                   }
                   //redirect them back to the admin page  ('message',
                   $this->session->set_flashdata('info', "User Created Successfully");
                   redirect('admin/users', 'refresh');
              }
              else
              { //display the create user form
                   //set the flash data error message if there is one
                   $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

                   $this->data['first_name'] = array('name' => 'first_name',
                           'id' => 'first_name',
                           'type' => 'text',
                           'value' => $this->form_validation->set_value('first_name'),
                   );
                   $this->data['last_name'] = array('name' => 'last_name',
                           'id' => 'last_name',
                           'type' => 'text',
                           'value' => $this->form_validation->set_value('last_name'),
                   );
                   $this->data['email'] = array('name' => 'email',
                           'id' => 'email',
                           'type' => 'text',
                           'value' => $this->form_validation->set_value('email'),
                   );

                   $this->data['phone'] = array('name' => 'phone',
                           'id' => 'phone',
                           'type' => 'text',
                           'value' => $this->form_validation->set_value('phone'),
                   );
                   $roles = array('staff' => 'staff', 'client' => 'client', 'company' => 'company');
                   $this->data['role'] = form_dropdown('role', array('' => 'Select role') + $roles, $this->form_validation->set_value('role'), ' class="chzn-select  " id="role_sel" ');

                   /*   $this->data['client'] = form_dropdown('client', array('' => 'Select Client', 999 => 'Datum Access') + $this->clientelle, $this->form_validation->set_value('client'), ' class="chzn-select  " '); */

                   $this->data['password'] = array('name' => 'password',
                           'id' => 'password',
                           'type' => 'password',
                           'value' => $this->form_validation->set_value('password'),
                   );
                   $this->data['password_confirm'] = array('name' => 'password_confirm',
                           'id' => 'password_confirm',
                           'type' => 'password',
                           'value' => $this->form_validation->set_value('password_confirm'),
                   );

                   $this->template
                                ->set_layout('default')
                                ->title('Create User')
                                ->build('admin/create_user', $this->data);
              }
         }

         function _get_csrf_nonce()
         {
              $this->load->helper('string');
              $key = random_string('alnum', 8);
              $value = random_string('alnum', 20);
              $this->session->set_flashdata('csrfkey', $key);
              $this->session->set_flashdata('csrfvalue', $value);

              return array($key => $value);
         }

         function _valid_csrf_nonce()
         {
              if ($this->input->post($this->session->flashdata('csrfkey')) !== FALSE &&
                           $this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue'))
              {
                   return TRUE;
              }
              else
              {
                   return FALSE;
              }
         }

         function profile($id = 0)
         {
              if (!$this->ion_auth->logged_in())
              {
                   redirect('admin/login');
              }

              $u = $this->ion_auth->get_user($id);
              $id OR $id = $u->id;
              if (!$this->users_m->exists($id))
              {
                   $this->session->set_flashdata('error', lang('web_object_not_exist'));
                   redirect('admin/users');
              }
              $data['id'] = $id;
              $data['user'] = $u;
              $data['tasks'] = $this->users_m->my_tasks();
              $data['count_tasks'] = $this->users_m->count_tasks();
              $data['my_count_sms'] = $this->portal_m->count_my_sms($id);
              $data['events'] = $this->portal_m->count_events();
              $data['meetings'] = $this->portal_m->count_meetings();

              $this->template
                           ->title('User Profile', $u->first_name . ' ' . $u->last_name)
                           ->build('admin/profile', $data);
         }

         /**
          * Friend Request
          * 
          * @param type $from
          * @param type $to
          */
         function add_connection($from, $to)
         {
              return $this->users_m->make_connection($from, $to);
         }

         function fetch_notes()
         {
              if (!$this->ion_auth->logged_in())
              {
                   echo json_encode(array('count' => 0, 'data' => 'login'));
                   exit();
              }

              $notes = $this->portal_m->get_notes();
              $out = '';
              foreach ($notes as $nt)
              {
                   $out .= '<li class="found">
                    <ul class="dropdown-menu-list list-unstyled ps-scrollbar">
                        <li class="active notification-success">
                            <a href="#">
                                <i class="fa-user"></i>

                                <span class="line">
                                    <strong>' . $nt->title . '</strong>
                                </span>

                                <span class="line small time">
                                    30 seconds ago
                                </span>
                            </a>
                        </li>
 
                    </ul>
                </li>';
              }
              echo json_encode(array('count' => count($notes), 'data' => $out));
         }

    }
    