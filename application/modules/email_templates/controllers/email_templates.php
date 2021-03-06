<?php

    if (!defined('BASEPATH'))
         exit('No direct script access allowed');

    class Email_templates extends CI_Controller
    {

         function __construct()
         {
              parent::__construct();
              $this->load->model('email_templates_m');
              $this->load->helper('text');
              $this->load->helper('pagination');
              $this->load->library('pagination');
              $this->load->library('template');
         }

         // email_templates/page/x also routes here
         function index()
         {
              $this->data->pagination = create_pagination('email_templates/page', $this->email_templates_m->count_by(array('status' => 'live')));
              $this->data->email_templates = $this->email_templates_m->limit($this->data->pagination['limit'])->get_many_by(array('status' => 'live'));
              //echo $this->email_templates_m->count_by(array('status' => 'live')); die;, NULL, 3
              // Set meta description based on post titles
              $data = $this->data;
              $this->template->build('index', $data);
         }

         // Public: View an post
         function view($slug = '')
         {
              if (!$slug or ! $post = $this->email_templates_m->get_by('slug', $slug))
              {
                   redirect('email_templates');
              }

              if ($post->status != 'live' && !$this->ion_auth->is_admin())
              {
                   redirect('email_templates');
              }

              $this->session->set_flashdata(array('referrer' => $this->uri->uri_string));
              $this->data->post = & $post;
              $this->template->build('view', $this->data);
         }

    }
    