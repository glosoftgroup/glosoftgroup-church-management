<?php

if (!defined('BASEPATH'))
        exit('No direct script access allowed');

class Admin extends Admin_Controller
{

        function __construct()
        {
                parent::__construct();

                /*$this->template->set_layout('home');
                $this->template->set_partial('sidebar', 'partials/sidebar.php')
                             ->set_partial('chat', 'partials/chat.php')
                             ->set_partial('footer', 'partials/footer.php')
                             ->set_partial('top', 'partials/top.php');*/
            

                $this->load->model('members/members_m');
                $this->load->model('pledges/pledges_m');
                $this->load->model('expenses/expenses_m');
                $this->load->model('announcements/announcement_m');
        }

        public function index()
        {
                if (!$this->ion_auth->logged_in())
                {
                        $this->session->set_flashdata('error', array('type' => 'error', 'text' => 'web_not_logged'));
                        redirect('login');
                }


                $users = $this->ion_auth->fetch_logged_in();
				
                $data['members_count'] = $this->portal_m->count_members();
                $data['visitors_count'] = $this->portal_m->count_visitors();
                $data['ss_count'] = $this->portal_m->count_sSchool();
                $data['hbcs_count'] = $this->portal_m->count_hbcs();
                $data['ministries_count'] = $this->portal_m->count_ministries();
                $data['users_count'] = $this->portal_m->count_users();
                $data['collection_log'] = $this->portal_m->get_collection_logs();
                $data['members'] = $this->members_m->paginate_all(7, 1);
                $data['pledges'] = $this->pledges_m->pending(7, 1);

                $data['single_member'] = $this->ion_auth->get_members();

                $data['expenses_items'] = $this->expenses_m->populate('expenses_items', 'id', 'name');
                $data['expenses_category'] = $this->expenses_m->populate('expenses_category', 'id', 'name');
                $data['expenses'] = $this->expenses_m->paginate_all(6, 1);
                $data['announcements'] = $this->announcement_m->paginate_all(6, 1);

                $data['total_offering'] = $this->portal_m->sum_offerings();
                $data['total_tithes'] = $this->portal_m->sum_tithes();
                $data['total_thanks'] = $this->portal_m->sum_thanks();
                $data['total_support'] = $this->portal_m->sum_support();
                $data['total_seeds'] = $this->portal_m->sum_seeds();
                $data['total_others'] = $this->portal_m->sum_others();

                $data['tithes'] = $this->portal_m->tithes_bar();
                $data['offerings'] = $this->portal_m->offerings_bar();
                $data['thanks'] = $this->portal_m->thanks_bar();
                $data['seeds'] = $this->portal_m->seeds_bar();
                $data['support'] = $this->portal_m->support_bar();
                $data['others'] = $this->portal_m->others_bar();


                $data['tithes_chart'] = $this->portal_m->tithes_chart();
                $data['offerings_chart'] = $this->portal_m->offerings_chart();
                $data['thanks_chart'] = $this->portal_m->thanks_chart();
                $data['support_chart'] = $this->portal_m->support_chart();
                $data['seeds_chart'] = $this->portal_m->seeds_chart();
                $data['others_chart'] = $this->portal_m->others_chart();

                //events and meeting
                $data['events'] = $this->portal_m->fetch_events();
                $data['meetings'] = $this->portal_m->fetch_meetings();
 
                $data['users'] = array_unique($users);

                $this->template
                             ->title('Admin  Dashboard')
                             ->build('admin/index', $data);
        }
		
		//Function to LIST All SMS PURCHASE HISTORY
		
		  function purchase_history(){
		
		 //load the view and the layout
		 $this->template->title('SMS Purchase History ' )->set_layout('default.php')->build('admin/purchase');
		
	}	

        function calendar()
        {

                //events and meeting
                $data['events'] = $this->portal_m->fetch_events();
                $data['meetings'] = $this->portal_m->fetch_meetings();

                $this->template
                             ->title('Church Calender')
                             ->set_layout('calendar.php')
                             ->build('admin/index', $data);
        }

        public function ckeditor()
        {
                if (!$this->ion_auth->logged_in())
                {
                        $this->session->set_flashdata('error', array('type' => 'error', 'text' => 'web_not_logged'));
                        redirect('admin/login');
                }
                $url = FCPATH . 'assets/uploads/ckeditor/' . time() . "_" . $_FILES['upload']['name'];

                $url_aux = substr($url, strlen(FCPATH) - 1);

                if (($_FILES['upload'] == "none") OR ( empty($_FILES['upload']['name'])))
                {
                        $message = "No file uploaded.";
                }
                else if (file_exists(FCPATH . 'assets/uploads/ckeditor/' . $_FILES['upload']['name']))
                {
                        $message = "File already exists";
                }
                else if ($_FILES['upload']["size"] == 0)
                {
                        $message = "The file is of zero length.";
                }
                else if (($_FILES['upload']["type"] != "image/jpeg") AND ( $_FILES['upload']["type"] != "image/jpeg") AND ( $_FILES['upload']["type"] != "image/png"))
                {
                        $message = "The image must be in either JPG or PNG format. Please upload a JPG or PNG instead.";
                }
                else if (!is_uploaded_file($_FILES['upload']["tmp_name"]))
                {
                        $message = "You may be attempting to hack our server. We're on to you; expect a knock on the door sometime soon.";
                }
                else
                {
                        $message = "Image uploaded correctly";
                        move_uploaded_file($_FILES['upload']['tmp_name'], $url);
                }

                $funcNum = $_GET['CKEditorFuncNum'];
                $url = $url_aux;
                echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($funcNum, '$url', '$message');</script>";
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
                                $this->session->set_flashdata('message', array('type' => 'error', 'text' => $this->ion_auth->errors()));
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
                                     //->set_partial('metadata', 'partials/metadata.html')
                                     ->set_layout('login')
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

        /**
         * Data Backup
         * 
         */
        function backup()
        {
                $this->load->library('Dump');
                $dump = new Ifsnop\Mysqldump\Mysqldump($this->db->database, $this->db->username, $this->db->password);
                @mkdir(FCPATH . 'uploads/dump', 777, TRUE);
                $dump->start(FCPATH . 'uploads/dump/' . date('d_M_Y_H_i') . '.sql');

                $this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Backup Complete'));
                redirect('admin');
        }
         /**
         * License Activation Page
         */
        function license()
        {
                if (!$this->ion_auth->logged_in())
                {
                        $this->session->set_flashdata('error', array('type' => 'error', 'text' => lang('web_not_logged')));
                        redirect('admin/login');
                }
                $this->load->library('Pad');
 
                $data['key'] = $this->settings->active;
                $data['keys'] = $this->portal_m->fetch_keys();
                $this->template->title('Smart Church License')
                             ->set_layout('default')
                             ->build('admin/active', $data);
        }
		
        function do_key()
        {
                 if ($this->input->post('license'))
                {
                        $lii = $this->input->post('license');
                        if (strlen($lii) > 1000)
                        {
                                $user = $this->ion_auth->get_user();
                                $form_data = array(
                                    'license' => $lii,
                                    'status' => 1,
                                    'created_by' => $user->id,
                                    'created_on' => time()
                                );

                                $this->portal_m->save_key($form_data);
                        }
                }
                redirect('admin/license');
        }

        //change password
        function change_password()
        {
                $this->form_validation->set_rules('old', 'Old password', 'required');
                $this->form_validation->set_rules('new', 'New Password', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
                $this->form_validation->set_rules('new_confirm', 'Confirm New Password', 'required');

                if (!$this->ion_auth->logged_in())
                {
                        redirect('admin/login', 'refresh');
                }
                $user = $this->ion_auth->get_user($this->session->userdata('user_id'));
                $this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');

                if ($this->form_validation->run() == FALSE)
                { //display the form
                        //set the flash data error message if there is one
                        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

                        $this->data['old_password'] = array('name' => 'old',
                            'id' => 'old',
                            'class' => 'span7',
                            'type' => 'password',
                        );
                        $this->data['new_password'] = array('name' => 'new',
                            'id' => 'new',
                            'class' => 'span7',
                            'type' => 'password',
                        );
                        $this->data['new_password_confirm'] = array('name' => 'new_confirm',
                            'id' => 'new_confirm',
                            'class' => 'span7',
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
                                $this->session->set_flashdata('message', array('type' => 'error', 'text' => $this->ion_auth->errors()));
                                redirect('admin/change_password', 'refresh');
                        }
                }
        }

        //forgot password
        function forgot_password()
        {
                //get the identity type from config and send it when you load the view
                $identity = $this->config->item('identity', 'ion_auth');
                $identity_human = ucwords(str_replace('_', ' ', $identity)); //if someone uses underscores to connect words in the column names
                $this->form_validation->set_rules($identity, $identity_human, 'required|valid_email');
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
                        $forgotten = $this->ion_auth->forgotten_password($this->input->post('email'));

                        if ($forgotten)
                        { //if there were no errors
                                $this->session->set_flashdata('message', array('type' => 'success', 'text' => $this->ion_auth->messages()));
                                redirect('admin/login', 'refresh'); //we should display a confirmation page here instead of the login page
                        }
                        else
                        {
                                $this->session->set_flashdata('message', array('type' => 'error', 'text' => $this->ion_auth->errors()));
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
                        $this->session->set_flashdata('message', array('type' => 'error', 'text' => $this->ion_auth->errors()));
                        redirect('admin/forgot_password', 'refresh');
                }
        }

        //activate the user
        function activate($id, $code = false)
        {
                if (!$this->ion_auth->logged_in())
                {
                        $this->session->set_flashdata('error', array('type' => 'error', 'text' => 'web_not_logged'));
                        redirect('admin/login');
                }

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
                        $this->session->set_flashdata('message', array('type' => 'error', 'text' => $this->ion_auth->errors()));
                        redirect('admin/forgot_password', 'refresh');
                }
        }

        //deactivate the user
        function deactivate($id = NULL)
        {
                $id or redirect('admin');
                if (!$this->ion_auth->logged_in())
                {
                        $this->session->set_flashdata('error', array('type' => 'error', 'text' => 'web_not_logged'));
                        redirect('admin/login');
                }
                // no funny business, force to integer
                $id = (int) $id;

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
                                     ->build('admin/forgot_password', $this->data);
                }
                else
                {
                        // do we really want to deactivate?
                        if ($this->input->post('confirm') == 'yes')
                        {
                                // do we have a valid request?
                                if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id'))
                                {
                                        show_404();
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
        function create_user()
        {
                $this->data['title'] = "Create User";

                if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
                {
                        redirect('admin/users', 'refresh');
                }

                //validate form input
                $this->form_validation->set_rules('first_name', 'First Name', 'required|xss_clean');
                $this->form_validation->set_rules('last_name', 'Last Name', 'required|xss_clean');
                $this->form_validation->set_rules('email', 'Email Address', 'required|valid_email');
                $this->form_validation->set_rules('phone1', 'First Part of Phone', 'required|xss_clean|min_length[4]|max_length[4]');
                $this->form_validation->set_rules('phone2', 'Second Part of Phone', 'required|xss_clean|min_length[3]|max_length[3]');
                $this->form_validation->set_rules('phone3', 'Third Part of Phone', 'required|xss_clean|min_length[3]|max_length[3]');
                $this->form_validation->set_rules('company', 'Company Name', 'required|xss_clean');
                $this->form_validation->set_rules('password', 'Password', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
                $this->form_validation->set_rules('password_confirm', 'Password Confirmation', 'required');

                if ($this->form_validation->run() == true)
                {
                        $username = strtolower($this->input->post('first_name')) . ' ' . strtolower($this->input->post('last_name'));
                        $email = $this->input->post('email');
                        $password = $this->input->post('password');

                        $additional_data = array('first_name' => $this->input->post('first_name'),
                            'last_name' => $this->input->post('last_name'),
                            'company' => $this->input->post('company'),
                            'phone' => $this->input->post('phone1') . '-' . $this->input->post('phone2') . '-' . $this->input->post('phone3'),
                        );
                }
                if ($this->form_validation->run() == true && $this->ion_auth->register($username, $password, $email, $additional_data))
                { //check to see if we are creating the user
                        //redirect them back to the admin page  ('message',
                        $this->session->set_flashdata('message', array('type' => 'success', 'text' => "User Created Successfully"));
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
                        $this->data['company'] = array('name' => 'company',
                            'id' => 'company',
                            'type' => 'text',
                            'value' => $this->form_validation->set_value('company'),
                        );
                        $this->data['phone1'] = array('name' => 'phone1',
                            'id' => 'phone1',
                            'type' => 'text',
                            'value' => $this->form_validation->set_value('phone1'),
                        );
                        $this->data['phone2'] = array('name' => 'phone2',
                            'id' => 'phone2',
                            'type' => 'text',
                            'value' => $this->form_validation->set_value('phone2'),
                        );
                        $this->data['phone3'] = array('name' => 'phone3',
                            'id' => 'phone3',
                            'type' => 'text',
                            'value' => $this->form_validation->set_value('phone3'),
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

                        $this->template
                                     ->set_layout('default')
                                     ->title('Admin', 'Create User')
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
                $this->load->model('users/users_m');
                if (!$this->ion_auth->logged_in())
                {
                        redirect('admin/login');
                }

                $u = $this->ion_auth->get_user($id);
                $id OR $id = $u->id;
                if (!$this->users_m->exists($id))
                {
                        $this->session->set_flashdata('error', lang('web_object_not_exist'));
                        redirect('admin/');
                }
                $data['id'] = $id;
                $data['user'] = $u;

                $this->template->set_layout('default')
                             ->title('User Profile', $u->first_name . ' ' . $u->last_name)
                             ->build('admin/profile', $data);
        }

        function recent()
        {
                if (!$this->ion_auth->logged_in())
                {
                        $this->session->set_flashdata('error', array('type' => 'error', 'text' => 'web_not_logged'));
                        redirect('admin/login');
                }
                if ($this->ion_auth->is_in_group($this->user->id, 4))
                {
                        $data['cos'] = $this->portal_m->get_companies();
                        $this->template
                                     ->title('Recent Activity', $this->client->name)
                                     ->set_layout('client')
                                     ->build('admin/recent', $data);
                }
                else
                {
                        redirect('admin');
                }
        }

        function activity()
        {
                if (!$this->ion_auth->logged_in())
                {
                        $this->session->set_flashdata('error', array('type' => 'error', 'text' => 'web_not_logged'));
                        redirect('admin/login');
                }

                $data['cos'] = '';
                $this->template->set_layout('default')
                             ->title('Recent Activity Log')
                             ->build('admin/activity', $data);
        }

        function search()
        {
                if (!$this->ion_auth->logged_in())
                {
                        $this->session->set_flashdata('error', array('type' => 'error', 'text' => 'web_not_logged'));
                        redirect('admin/login');
                }
                $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 1;
                $from = strtotime($this->input->post('from'));
                $to = strtotime($this->input->post('to'));
                $cat = $this->input->post('category');
                $company = $this->input->post('company');
                $media = $this->input->post('house');
                $sector = $this->input->post('sector');
                $keyword = $this->input->post('keyword');
                $cl = $this->input->post('client');
                $config = $this->set_paginate_options();
                $per = $config['per_page'];
                if ($this->input->post('Search'))
                {

                        $config['total_rows'] = $this->portal_m->count_results($from, $to, $cat, $company, $media, $sector, $keyword);
                        $data['scount'] = $config['total_rows'];
                        $data['cat'] = $cat;
                        //Initialize the pagination class
                        $this->pagination->initialize($config);

                        //find all the categories with paginate and save it in array to past to the view
                        $data['result'] = $this->portal_m->search($per, $page, $from, $to, $cat, $company, $media, $sector, $keyword);

                        //create pagination links
                        $data['links'] = $this->pagination->create_links();
                }
                elseif ($this->input->post('Excel'))
                {
                        if ($company)
                        {
                                $cids = $this->portal_m->fetch_ct($cl, $company);
                        }
                        else
                        {
                                $posts = $this->portal_m->get_companies($cl);

                                $cids = array();
                                foreach ($posts as $key => $value)
                                {
                                        $cids[$key] = $value;
                                }
                                $cids = array_unique($cids);
                                $cids = array_flip($cids);
                                ksort($cids);
                                $cids = array_flip($cids);
                        }

                        $objPHPExcel = new PHPExcel();
                        $objPHPExcel->getProperties()->setCreator("User")
                                     ->setLastModifiedBy("user")
                                     ->setTitle("Office 2007 XLSX  Document")
                                     ->setSubject("Office 2007 XLSX  Document")
                                     ->setDescription("Document for Office 2007 .")
                                     ->setKeywords("office 2007 openxml php")
                                     ->setCategory("Results Excel");

                        $i = 6;
                        $index = 1;
                        $ref = ($cl) ? $cl : $this->client->id;
                        $objPHPExcel->setActiveSheetIndex(0)->setTitle(' Report');
                        foreach ($cids as $kv => $cid)
                        {
                                $mySheet = new PHPExcel_Worksheet($objPHPExcel, $cid);
                                $objPHPExcel->addSheet($mySheet, $index);

                                $objPHPExcel->setActiveSheetIndex($index);
                                $objPHPExcel->getActiveSheet()->mergeCells('D2:E2');
                                $objPHPExcel->getActiveSheet()->setCellValue('D2', $cid);
                                $objPHPExcel->getActiveSheet()->getStyle('D2')->getFont()->setSize(20);
                                $objPHPExcel->getActiveSheet()->getStyle('D2')->getFont()->setBold(true);
                                //set aligment to center for the merged cells  
                                $objPHPExcel->getActiveSheet()->getStyle('D2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                                // Add Header
                                $objPHPExcel->setActiveSheetIndex($index);
                                $objPHPExcel->getActiveSheet()->setCellValue('B4', 'DATE');
                                $objPHPExcel->getActiveSheet()->setCellValue('C4', 'STATION/PAPER');
                                $objPHPExcel->getActiveSheet()->setCellValue('D4', 'TITLE');
                                $objPHPExcel->getActiveSheet()->setCellValue('E4', 'AVE');
                                $objPHPExcel->getActiveSheet()->setCellValue('F4', 'PRV');
                                $objPHPExcel->getActiveSheet()->setCellValue('G4', 'SLOT');
                                $objPHPExcel->getActiveSheet()->setCellValue('H4', 'LINK');
                                $objPHPExcel->getActiveSheet()->setCellValue('I4', 'SUMMARY');

                                $objPHPExcel->getActiveSheet()->getStyle('B4')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
                                $objPHPExcel->getActiveSheet()->duplicateStyle($objPHPExcel->getActiveSheet()->getStyle('B4'), 'B4:J4');

                                $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
                                $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
                                $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(60);
                                $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
                                $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
                                $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(30);
                                $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(60);
                                $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(70);
                                $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(50);
                                $objPHPExcel->getActiveSheet()->getRowDimension('4')->setRowHeight(-1);

                                $objPHPExcel->getActiveSheet()->getStyle('B4:J4')
                                             ->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                                $objPHPExcel->getActiveSheet()->getStyle('B4:J4')->applyFromArray(
                                             array('fill' => array(
                                                     'type' => PHPExcel_Style_Fill::FILL_SOLID,
                                                     'color' => array('rgb' => '61009B')
                                                 ),
                                                 'borders' => array(
                                                     'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                                                     'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
                                                 )
                                             )
                                );
                                $result = $this->portal_m->search_client($cl, $kv, $from, $to, $cat, $media, $sector, $keyword);
                                if (!empty($result))
                                {
                                        foreach ($result as $pos)
                                        {
                                                $pos = (object) $pos;
                                                $objPHPExcel->getActiveSheet()->mergeCells('I' . $i . ':J' . $i);
                                                $objPHPExcel->getActiveSheet()->getStyle('A' . $i . ':J' . $i)
                                                             ->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

                                                if ($cat == 'print' && $pos->house)
                                                {
                                                        $house = $this->print_media[$pos->house];
                                                }
                                                elseif ($cat == 'clips' && $pos->house)
                                                {
                                                        $house = $this->clip_media[$pos->house];
                                                }
                                                else
                                                {
                                                        if ($pos->house && isset($pos->stype))
                                                        {
                                                                $house = ($pos->stype == 'print') ? $this->print_media[$pos->house] : $this->clip_media[$pos->house];
                                                        }
                                                        else
                                                        {
                                                                $house = 'Unspecified';
                                                        }
                                                }
                                                $objPHPExcel->getActiveSheet()->getStyle('I' . $i . ':J' . $i)->getAlignment()->setWrapText(true);
                                                $objPHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(30);
                                                $objPHPExcel->getActiveSheet()->SetCellValue('B' . $i, date('d M Y', $pos->date));
                                                $objPHPExcel->getActiveSheet()->SetCellValue('C' . $i, $house);
                                                $objPHPExcel->getActiveSheet()->SetCellValue('D' . $i, $pos->title);
                                                $objPHPExcel->getActiveSheet()->SetCellValue('E' . $i, $pos->ave);
                                                $objPHPExcel->getActiveSheet()->SetCellValue('F' . $i, $pos->prv);
                                                $objPHPExcel->getActiveSheet()->SetCellValue('G' . $i, $pos->slot);
                                                $objPHPExcel->getActiveSheet()->SetCellValue('H' . $i, $pos->clip);
                                                $objPHPExcel->getActiveSheet()->SetCellValue('I' . $i, $pos->summary);

                                                $i ++;
                                        }
                                }
                                $index ++;
                                $i = 6;
                        }
                        //$objPHPExcel->removeSheetByIndex(0);
                        $objPHPExcel->setActiveSheetIndex(1);
                        // Send Excel 2005 headers
                        header('Content-Type: application/vnd.ms-excel');
                        header('Content-Disposition: attachment;filename="Media_Monitoring_Report_.xls" ');
                        header('Cache-Control: max-age=0');

                        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
                        $objWriter->save('php://output');
                }

                $data['cos'] = $this->portal_m->get_companies();
                $data['sectors'] = $this->portal_m->get_sectors();
                $tt = 'Excel';
                $layout = 'default';
                if ($this->ion_auth->is_in_group($this->user->id, 4))
                {
                        $tt = $this->client->name;
                        $layout = 'search';
                }
                $this->template
                             ->title('Search', $tt)
                             ->set_layout($layout)
                             ->build('admin/search', $data);
        }

        function gotcha()
        {
                if (!$this->ion_auth->logged_in())
                {
                        $this->session->set_flashdata('error', array('type' => 'error', 'text' => 'web_not_logged'));
                        redirect('admin/login');
                }
                $this->template
                             ->title('Not Found')
                             ->set_layout('default')
                             ->build('admin/error');
        }

        private function set_paginate_options()
        {
                $config = array();
                $config['base_url'] = site_url() . 'admin/search/tox/';
                $config['use_page_numbers'] = TRUE;
                $config['per_page'] = 100;
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
                //$choice = $config["total_rows"] / $config["per_page"];
                //$config["num_links"] = round($choice);

                return $config;
        }

        function make_trends()
        {
                die('No Way');
                $aff_c = $this->portal_m->get_pool('sales_index', 'created_at');

                $period = array();
                //get the last 30 days 
                for ($i = 0; $i < 30; $i++)
                {
                        $period[] = strtotime("-$i days");
                }

                $k = 0;
                foreach ($aff_c as $key)
                {
                        $fixx = array('created_at' => $period[rand(0, 29)], 'modified_at' => time());
                        $this->portal_m->mashup($key, $fixx, 'sales_index');
                        $k++;
                }

                echo '<hr>Processed ' . $k . '<br> **************Clips****************';
        }

}
