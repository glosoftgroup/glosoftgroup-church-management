<?php

defined('BASEPATH') OR exit('No direct script access allowed');

function module_exists($var)
{
    return false;
}

// Code here is run before frontend controllers
class Public_Controller extends MY_Controller
{

    public $minicart;

    public function Public_Controller()
    {
        parent::__construct();

        // Prepare template library
        $this->template->set_theme($this->theme->slug);
        // Set the theme view folder
        $this->template
                ->set_theme($this->theme->slug)
                ->append_metadata('
                        <script type="text/javascript">
                                var APPPATH_URI = "' . BASE_URI . '";
                                var BASE_URI = "' . BASE_URI . '";
                        </script>');

        // default theme directory for Asset library 
        $this->config->set_item('asset_dir', $this->theme->path . '/');
        $this->config->set_item('asset_url', BASE_URL . $this->theme->web_path . '/');
        // Is there a layout file for this module?
        if ($this->template->layout_exists($this->module . '.php'))
        {
            $this->template->set_layout($this->module . '.php');
        }

        // use the default layout
        elseif ($this->template->layout_exists('default.php'))
        {
            $this->template->set_layout('default.php');
        }

        // Make sure whatever page the user loads it by, its telling search robots the correct formatted URL
        $this->template->set_metadata('canonical', site_url($this->uri->uri_string()), 'link');

        // If there is a blog module, link to its RSS feed in the head
        if (module_exists('blog'))
        {
            $this->template->append_metadata('<link rel="alternate" type="application/rss+xml" title="' . $this->settings->site_name . '" href="' . site_url('blog/rss/all.rss') . '" />');
        }

        // Assign segments to the template the new way
        $this->template->server = $_SERVER;
        
         
    }

}
