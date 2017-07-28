<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

// Run before admin controllers
    class Admin_Controller extends MY_Controller
    {

         public $user;
         public $notes;
         public $show;
         public $scope;
         public $drop = 1;
         public $contacts;
         public $settings;
         public $side = 'sidebar';
         public $list_size = 10;

         public function __construct()
         {
              parent::__construct();
              $this->load->library('ion_auth');
              $this->load->model('portal_m');
              $this->load->model('permissions/permissions_m');
              $this->load->model('sms/sms_m');

              if ($this->ion_auth->logged_in())
              {
                   if (!$this->acl->is_allowed() && (!preg_match('/^(admin)$/i', $this->uri->uri_string())))
                   {
                        $this->session->set_flashdata('error', lang('web_not_backend'));
                        redirect('admin');
                   }
                   $this->user = $this->ion_auth->get_user();

                   $this->show = ($this->ion_auth->is_in_group($this->user->id, 4) == FALSE );
                   // $this->notes = $this->portal_m->count_notes();
                   $this->contacts = $this->portal_m->fetch_all_users();
                   $this->settings = $this->portal_m->fetch_settings();
                   $this->scope = $this->permissions_m->get_scope();
                   if (isset($this->settings->list_size) && $this->settings->list_size > 10)
                   {
                        $this->list_size = $this->settings->list_size;
                   }
              }

              if (!$this->admin_theme->slug)
              {
                   show_error('This site has been set to use an admin theme that does not exist.');
              }
              // Set Backend Theme 
              $this->template->set_theme(ADMIN_THEME);

              // Set the admin theme directory for Asset library 
              $this->config->set_item('asset_dir', $this->admin_theme->path . '/');
              $this->config->set_item('asset_url', BASE_URL . $this->admin_theme->web_path . '/');

              // Template configuration
              $this->template
                           ->set_theme(ADMIN_THEME)
                           ->set_layout('default');


              if ($this->ion_auth->logged_in())
              {
                   $this->settings->active = $this->portal_m->get_active_key();

                   if (preg_match('/^(admin)$/i', $this->uri->uri_string()))
                   {
                        $this->template->set_layout('home');
                   }
                   else
                   {
                        $this->template->set_layout('default');
                   }

                   $this->template->set_partial('sidebar', 'partials/sidebar.php')
                                ->set_partial('top', 'partials/top.php')
                                ->set_partial('perms', 'partials/perms.php')
                                ->set_partial('footer', 'partials/footer.php');
                   if (!$this->ion_auth->is_in_group($this->user->id, 1))
                   {
                        $this->side = 'gen_sidebar';
                        $this->template->set_partial('gen_sidebar', 'partials/nsidebar.php');
                   }
              }
         }

    }
    