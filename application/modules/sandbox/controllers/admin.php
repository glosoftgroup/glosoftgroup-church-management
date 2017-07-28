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

              $this->load->model('sandbox_m');
         }

         /**
          * Imports Excel to various Tables 
          * Rates Version
          */
         function exp()
         {
              $this->load->library('excel_reader');

              // Read the spreadsheet via a relative path to the document
              $this->excel_reader->read(FCPATH . 'csv/fees.xls');

              // Get worksheet contents by sheet index(starts from 0) 
              $worksheet = $this->excel_reader->worksheets[0];
              $titles = $worksheet[0];
              echo '<pre>Fields: ';
              print_r($titles);
              echo '</pre>';

              unset($worksheet[0]);
              $fn = array();
              $size = count($titles);
              foreach ($worksheet as $key => $coldata)
              {
                   for ($i = 0; $i < $size; $i++)
                   {
                        if (!isset($coldata[$i]))
                        {
                             $coldata[$i] = '';
                        }
                   }
                   $fn[] = array_combine($titles, $coldata);
              }
              echo '<pre>';
              // print_r($fn);
              echo '</pre>';
              // die();

              $i = 0;
              $am = 0;

              foreach ($fn as $row)
              {
                   $i++;
                   $fr = (object) $row;

                   if (!empty($fr->name))
                   {
                        $mprn = array(
                                'name' => $fr->name,
                                'category' => $fr->category,
                                'fee_type' => $fr->fee_type,
                                'amount' => $fr->amount,
                                'created_on' => time(),
                                'created_by' => $this->ion_auth->get_user()->id,
                        );
                        $this->sandbox_m->create($mprn);
                   }
              }
              echo '<pre>Processed: ';
              print_r($i);
              echo ' Rows  (';
              echo ' )</pre>';
              exit('**The End**');
         }

         public function index()
         {
              echo 'haha';
         }

         function fix()
         {
              $fdata = array('balance' => 0);
              $done = $this->sandbox_m->update_attributes($fdata);
              echo '<pre>';
              print_r($done);
              echo '</pre>';
              die();
         }

    }
    