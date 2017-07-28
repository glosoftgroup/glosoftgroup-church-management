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
              $this->load->model('reports_m');
              $this->load->model('ministries/ministries_m');
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

              $data['reports'] = $this->reports_m->paginate_all($config['per_page'], $page);

              //create pagination links
              $data['links'] = $this->pagination->create_links();

              //page number  variable
              $data['page'] = $page;
              $data['per'] = $config['per_page'];

              //load view
              $this->template->title(' Reports ')->build('admin/list', $data);
         }

         /**
          * Petty FROM TO
          */
         function petty_range()
         {
              $from = 0;
              $to = 0;
              if ($this->input->post('from'))
              {
                   $from = strtotime($this->input->post('from'));
              }
              if ($this->input->post('to'))
              {
                   $to = strtotime($this->input->post('to'));
              }

              $yr = 0;
              $month = 0;

              $post = $this->reports_m->petty_range($from, $to);
              //$post = $this->reports_m->get_petty_cash($month, $yr);
              foreach ($post as $p)
              {
                   $petty_cash_total = $this->reports_m->total_petty_cash_amount($p->item, $month, $yr);
                   $p->petty_cash_total = $petty_cash_total->total;
              }



              $this->load->model('petty_cash/petty_cash_m');

              $data['todays'] = $this->petty_cash_m->todays()->total;
              $data['mnths'] = $this->petty_cash_m->months()->total;
              $data['years'] = $this->petty_cash_m->years()->total;

              $data['total_petty_cash'] = $this->reports_m->total_petty_cash_this_year();
              $data['post'] = $post;
              $data['items'] = $this->reports_m->expense_items();
              $this->template->title('Petty Cash Summary Report')->build('admin/petty_cash', $data);
         }

         function accounts_reports()
         {
              //load view
              $data['sum_offerings'] = $this->reports_m->sum_offerings()->total;
              $data['sum_tithes'] = $this->reports_m->sum_tithes()->total;
              $data['sum_thanks'] = $this->reports_m->sum_thanks()->total;
              $data['sum_support'] = $this->reports_m->sum_support()->total;
              $data['sum_seeds'] = $this->reports_m->sum_seeds()->total;
              $data['sum_others'] = $this->reports_m->sum_others()->total;
              $data['sum_paid_pledges'] = $this->reports_m->sum_paid_pledges()->total;

              $pie_data = array();
              $data['pie_data'] = array(
                      "Offerings" => $this->reports_m->sum_offerings()->total,
                      'Tithes' => $this->reports_m->sum_tithes()->total,
                      'Thanks Giving' => $this->reports_m->sum_thanks()->total,
                      'Ministry Support' => $this->reports_m->sum_support()->total,
                      'Seed Planting' => $this->reports_m->sum_seeds()->total,
                      'Other Contributions' => $this->reports_m->sum_others()->total,
                      'Paid Pledges' => $this->reports_m->sum_paid_pledges()->total
              );


              //Line Graph
              $data['tithes_chart'] = $this->portal_m->tithes_chart();
              $data['offerings_chart'] = $this->portal_m->offerings_chart();
              $data['thanks_chart'] = $this->portal_m->thanks_chart();
              $data['support_chart'] = $this->portal_m->support_chart();
              $data['seeds_chart'] = $this->portal_m->seeds_chart();
              $data['others_chart'] = $this->portal_m->others_chart();

              $this->template->title('Accounts Reports ')->set_layout('reports.php')->build('admin/accounts', $data);
         }

         function filter_account($table = FALSE)
         {

              $tbl = $table;
              //redirect if no Table
              if (!$tbl)
              {
                   $this->session->set_flashdata('message', array('type' => 'warning', 'text' => lang('web_object_not_exist')));
                   redirect('admin/reports/accounts_reports');
              }

              $data['tbl_data'] = $this->reports_m->filter_account($tbl);
              $data['total_collection'] = $this->reports_m->total_collection($tbl);
              $data['table'] = $tbl;
              $data['banks'] = $this->reports_m->get_banks();
              $this->template->title(ucwords($tbl) . ' Reports ')->set_layout('reports.php')->build('admin/filter_accounts', $data);
         }

         function accounts_date()
         {

              $tbl = $this->input->post('table');
              $month = $this->input->post('month');
              $year = $this->input->post('year');

              // print_r($year);die;
              //redirect if no Table

              if ($month == "" || $year == "")
              {
                   $data['tbl_data'] = $this->reports_m->filter_account($tbl);
              }
              else
              {
                   $data['tbl_data'] = $this->reports_m->accounts_date($tbl, $month, $year);
              }
              $data['the_month'] = $month;
              $data['total_collection'] = $this->reports_m->total_collection($tbl);
              $data['table'] = $tbl;
              $data['banks'] = $this->reports_m->get_banks();
              $this->template->title(ucwords($tbl) . ' Reports ')->set_layout('reports.php')->build('admin/filter_accounts', $data);
         }

         /**
          * Expenses Summary Report
          * 
          */
         public function expenses()
         {
              $yr = $this->input->post('year');
              $month = $this->input->post('month');


              $post = $this->reports_m->get_expenses($month, $yr);
              foreach ($post as $p)
              {
                   $expense_total = $this->reports_m->total_expense_amount($p->category, $month, $yr);
                   $p->expense_total = $expense_total->total;
              }
              $this->load->model('expenses/expenses_m');

              $data['todays'] = $this->expenses_m->todays()->total;
              $data['mnths'] = $this->expenses_m->months()->total;
              $data['years'] = $this->expenses_m->years()->total;

              $data['total_expenses'] = $this->reports_m->total_expenses_this_year();
              $data['post'] = $post;
              $data['cats'] = $this->reports_m->expense_categories();
              $this->template->title('Expense Summary Report')->build('admin/expenses', $data);
         }

         /**
          * Petty cash Summary Report
          * 
          */
         public function petty_cash()
         {
              $yr = $this->input->post('year');
              $month = $this->input->post('month');


              $post = $this->reports_m->get_petty_cash($month, $yr);
              foreach ($post as $p)
              {
                   $petty_cash_total = $this->reports_m->total_petty_cash_amount($p->item, $month, $yr);
                   $p->petty_cash_total = $petty_cash_total->total;
              }


              $this->load->model('petty_cash/petty_cash_m');

              $data['todays'] = $this->petty_cash_m->todays()->total;
              $data['mnths'] = $this->petty_cash_m->months()->total;
              $data['years'] = $this->petty_cash_m->years()->total;

              $data['total_petty_cash'] = $this->reports_m->total_petty_cash_this_year();
              $data['post'] = $post;
              $data['items'] = $this->reports_m->expense_items();
              $this->template->title('Petty Cash Summary Report')->build('admin/petty_cash', $data);
         }

         /**
          *   Wages Report
          *  
          */
         public function wages()
         {
              $post = $this->reports_m->get_salaries();

              foreach ($post as $p)
              {
                   $basic = $this->reports_m->total_basic($p->salary_date);
                   $no_employees = $this->reports_m->count_employees($p->salary_date);
                   $deductions = $this->reports_m->total_deductions($p->salary_date);
                   $allowances = $this->reports_m->total_allowances($p->salary_date);
                   $nhif = $this->reports_m->total_nhif($p->salary_date);
                   $advance = $this->reports_m->total_advance($p->salary_date);
                   $total_paid = (($basic->basic + $deductions->ded + $allowances->allws + $nhif->nhif) - $advance->advs);

                   $p->total_paid = $total_paid;
                   $p->no_employees = $no_employees;
                   $p->advance = $advance->advs;
              }
              $data['post'] = $post;
              $this->template->title('Wages Reports ')->build('admin/wages', $data);
         }

         /**
          *   Pledges Report
          *  
          */
         public function pledges()
         {
              $data['paid'] = $this->reports_m->get_paid();
              $data['total_paid'] = $this->reports_m->total_paid();
              $data['pending'] = $this->reports_m->get_pending();
              $data['total_pending'] = $this->reports_m->total_pending();

              $data['members'] = $this->ion_auth->get_members();

              $data['pledge'] = $this->reports_m->populate('pledges', 'id', 'title');
              $data['mem'] = $this->reports_m->populate('pledges', 'id', 'member');

              $data['pledges_pie'] = array(
                      "Paid Pledges" => $this->reports_m->total_paid()->total,
                      'Pending Pledges' => $this->reports_m->total_pending()->total,
              );

              $this->template->title('Pledges Reports ')->build('admin/pledges', $data);
         }

         /**
          * ** Members Reports
          * * */
         function members_reports()
         {

              $data['count_members'] = $this->reports_m->count_members();
              $data['count_visitors'] = $this->reports_m->count_visitors();
              $data['count_sSchool'] = $this->reports_m->count_sSchool();

              $data['count_baptised_members'] = $this->reports_m->count_baptised_members();
              $data['count_baptism'] = $this->reports_m->count_baptism();
              $data['count_dedicated'] = $this->reports_m->count_dedicated();
              $data['count_hbc_members'] = $this->reports_m->count_hbc_members();
              $data['count_ministry_members'] = $this->reports_m->count_ministry_members();

              $data['load_pie_data'] = array(
                      'Registered Members' => $this->reports_m->count_members(),
                      'Registered Visitors' => $this->reports_m->count_visitors(),
                      'Sunday School' => $this->reports_m->count_sSchool(),
                      'Children Dedication' => $this->reports_m->count_dedicated(),
                      'Baptism' => $this->reports_m->count_baptism()
              );

              $data['reg_members_bar'] = $this->reports_m->members_bar();

              //$data['members_chart'] = $this->reports_m-> members_chart();
              //load view
              $this->template->title('Members Reports ')->set_layout('reports.php')->build('admin/members', $data);
         }

         /*          * *
          * ** Get List of ALL Members
          * * */

         function filter_members()
         {

              $data['members'] = $this->reports_m->filter_members();
              $data['count_members'] = $this->reports_m->count_members();
              $data['the_month'] = 'January';

              $data['load_pie_data'] = array(
                      'Registered Members' => $this->reports_m->count_members(),
                      'Registered Visitors' => $this->reports_m->count_visitors(),
                      'Sunday School' => $this->reports_m->count_sSchool(),
                      'Children Dedication' => $this->reports_m->count_dedicated(),
                      'Baptism' => $this->reports_m->count_baptism()
              );

              $data['reg_members_bar'] = $this->reports_m->members_bar();

              $this->template->title('Members Reports ')->set_layout('reports.php')->build('admin/filter_members', $data);
         }

         //Filter Members by Dates
         function members_byDate()
         {


              $month = $this->input->post('month');
              $year = $this->input->post('year');

              // print_r($year);die;
              //redirect if no Table

              if ($month == "" || $year == "")
              {
                   $data['members'] = $this->reports_m->filter_members();
              }
              else
              {
                   $data['members'] = $this->reports_m->members_byDate($month, $year);
                   $data['count_per_date'] = $this->reports_m->count_members_byDate($month, $year);
              }

              $data['load_pie_data'] = array(
                      'Registered Members' => $this->reports_m->count_members(),
                      'Registered Visitors' => $this->reports_m->count_visitors(),
                      'Sunday School' => $this->reports_m->count_sSchool(),
                      'Children Dedication' => $this->reports_m->count_dedicated(),
                      'Baptism' => $this->reports_m->count_baptism()
              );

              $data['the_month'] = $month;
              $data['count_members'] = $this->reports_m->count_members();

              $this->template->title('Members Reports ')->set_layout('reports.php')->build('admin/filter_members', $data);
         }

         function members_custom_filter()
         {

              $field = $this->input->post('field_name');

              if ($field == "")
              {
                   $data['members'] = $this->reports_m->filter_members();
              }
              else
              {

                   $data['members'] = $this->reports_m->members_custom_filter($field);
              }

              $data['the_month'] = '';
              $data['count_members'] = $this->reports_m->count_members();


              $data['reg_members_bar'] = $this->reports_m->members_bar();


              $data['load_pie_data'] = array(
                      'Registered Members' => $this->reports_m->count_members(),
                      'Registered Visitors' => $this->reports_m->count_visitors(),
                      'Sunday School' => $this->reports_m->count_sSchool(),
                      'Children Dedication' => $this->reports_m->count_dedicated(),
                      'Baptism' => $this->reports_m->count_baptism()
              );


              $this->template->title('Members Reports ')->set_layout('reports.php')->build('admin/filter_members', $data);
         }

         /*          * *
          * ** Filter Members in HBCs
          * ** */

         function filter_hbc_members()
         {

              $data['members'] = $this->reports_m->filter_hbc_members();
              $data['count_members'] = $this->reports_m->count_hbc_members();
              $data['the_month'] = '';

              $data['hbc'] = $this->reports_m->populate('hbcs', 'id', 'name');

              $this->template->title('HBC Members Reports ')->set_layout('reports.php')->build('admin/filter_hbc_members', $data);
         }

         /**
          * *** Filter Visitors
          * * */
         function filter_visitors()
         {

              $data['members'] = $this->reports_m->filter_visitors();
              $data['count_visitors'] = $this->reports_m->count_visitors();
              $data['the_month'] = '';

              $this->template->title('Visitors Reports ')->set_layout('reports.php')->build('admin/filter_visitors', $data);
         }

         //Filter Members by Dates
         function visitors_byDate()
         {


              $month = $this->input->post('month');
              $year = $this->input->post('year');

              // print_r($year);die;
              //redirect if no Table

              if ($month == "" || $year == "")
              {
                   $data['members'] = $this->reports_m->filter_visitors();
              }
              else
              {
                   $data['members'] = $this->reports_m->visitors_byDate($month, $year);
                   $data['count_per_date'] = $this->reports_m->count_visitors_byDate($month, $year);
              }
              $data['the_month'] = $month;
              $data['count_visitors'] = $this->reports_m->count_visitors();

              $this->template->title('Visitors Reports ')->set_layout('reports.php')->build('admin/filter_visitors', $data);
         }

         /**
          * *** Filter Baptisms Recorded
          * * */
         function filter_baptism()
         {

              $data['members'] = $this->reports_m->filter_baptism();
              $data['count_baptism'] = $this->reports_m->count_baptism();
              $data['the_month'] = '';

              $this->template->title('Baptism Reports ')->set_layout('reports.php')->build('admin/filter_baptism', $data);
         }

         //Filter Members by Dates
         function baptism_byDate()
         {


              $month = $this->input->post('month');
              $year = $this->input->post('year');

              // print_r($year);die;
              //redirect if no Table

              if ($month == "" || $year == "")
              {
                   $data['members'] = $this->reports_m->filter_baptism();
              }
              else
              {
                   $data['members'] = $this->reports_m->baptism_byDate($month, $year);
                   $data['count_per_date'] = $this->reports_m->count_baptism_byDate($month, $year);
              }
              $data['the_month'] = $month;
              $data['count_baptism'] = $this->reports_m->count_baptism();

              $this->template->title('Baptisms Reports ')->set_layout('reports.php')->build('admin/filter_baptism', $data);
         }

         /**
          * *** Filter Baptisms Recorded
          * * */
         function filter_dedications()
         {

              $data['members'] = $this->reports_m->filter_dedications();
              $data['count_dedicated'] = $this->reports_m->count_dedicated();
              $data['the_month'] = '';

              $this->template->title('Children Dedication Reports ')->set_layout('reports.php')->build('admin/filter_dedications', $data);
         }

         //Filter Members by Dates
         function dedications_byDate()
         {


              $month = $this->input->post('month');
              $year = $this->input->post('year');

              // print_r($year);die;
              //redirect if no Table

              if ($month == "" || $year == "")
              {
                   $data['members'] = $this->reports_m->filter_dedications();
              }
              else
              {
                   $data['members'] = $this->reports_m->dedications_byDate($month, $year);
                   $data['count_per_date'] = $this->reports_m->count_dedications_byDate($month, $year);
              }
              $data['the_month'] = $month;
              $data['count_dedicated'] = $this->reports_m->count_dedicated();

              $this->template->title('Children Dedication Reports ')->set_layout('reports.php')->build('admin/filter_dedications', $data);
         }

         /**
          * *** Filter Sunday School
          * * */
         function filter_ssSchool()
         {

              $data['members'] = $this->reports_m->filter_ssSchool();
              $data['count_sSchool'] = $this->reports_m->count_sSchool();
              $data['the_month'] = '';
              $data ['parent'] = $this->reports_m->ss_parent();

              $this->template->title('Sunday School Reports ')->set_layout('reports.php')->build('admin/filter_ssSchool', $data);
         }

         //Filter Members by Dates
         function ssSchool_byDate()
         {


              $month = $this->input->post('month');
              $year = $this->input->post('year');

              // print_r($year);die;
              //redirect if no Table

              if ($month == "" || $year == "")
              {
                   $data['members'] = $this->reports_m->filter_ssSchool();
              }
              else
              {
                   $data['members'] = $this->reports_m->ssSchool_byDate($month, $year);
                   $data['count_per_date'] = $this->reports_m->count_ssSchool_byDate($month, $year);
              }
              $data['the_month'] = $month;
              $data['count_sSchool'] = $this->reports_m->count_sSchool();
              $data['parent'] = $this->reports_m->ss_parent();

              $this->template->title('Sunday School Reports ')->set_layout('reports.php')->build('admin/filter_ssSchool', $data);
         }

         /*          * **
          * **** Filter Ministry Members
          * ** */

         public function filter_ministry_members()
         {
              $config = $this->set_paginate_options();  //Initialize the pagination class
              $this->pagination->initialize($config);

              $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 1;

              $data['ministries'] = $this->ministries_m->paginate_all($config['per_page'], $page);

              //create pagination links
              $data['links'] = $this->pagination->create_links();

              //page number  variable
              $data['page'] = $page;
              $data['per'] = $config['per_page'];
              $data['leader'] = $this->ion_auth->get_member('members', 'id', 'first_name' . ' ' . 'last_name');
              //load view
              $this->template->title(' List of Ministries ')->build('admin/filter_ministry_members', $data);
         }

         function ministry_members($id = 0)
         {
              //redirect if no $id


              if (!$id)
              {
                   $this->session->set_flashdata('error', array('type' => 'warning', 'text' => lang('web_object_not_exist')));
                   redirect('admin/ministries/');
              }
              if (!$this->ministries_m->exists($id))
              {
                   $this->session->set_flashdata('error', array('type' => 'warning', 'text' => lang('web_object_not_exist')));
                   redirect('admin/ministries');
              }

              $get = $this->ministries_m->find($id);

              $data['members'] = $this->ministries_m->get_members($id);
              $title = ucwords($get->name) . ' Members ';
              $data['title'] = $title;

              $data['min_id'] = $id;

              $data['ministries'] = $this->ministries_m->populate('ministries', 'id', 'name');

              $this->template->title($title)->build('admin/ministry_members', $data);
         }

         //Ministry Search

         function ministry_search()
         {
              //redirect if no $id

              $id = $this->input->post('ministry_id');
              //print_r($id);die;
              if (!$id)
              {
                   $this->session->set_flashdata('error', array('type' => 'warning', 'text' => lang('web_object_not_exist')));
                   redirect('admin/ministries/');
              }
              if (!$this->ministries_m->exists($id))
              {
                   $this->session->set_flashdata('error', array('type' => 'warning', 'text' => lang('web_object_not_exist')));
                   redirect('admin/ministries');
              }

              $get = $this->ministries_m->find($id);
              $data['min_id'] = $id;

              $data['members'] = $this->ministries_m->get_members($id);
              $title = ucwords($get->name) . ' Members ';
              $data['title'] = $title;
              $data['ministries'] = $this->ministries_m->populate('ministries', 'id', 'name');

              $this->template->title($title)->build('admin/ministry_members', $data);
         }

         /*          * ****
          * ****** SMS REPORTS
          * **** */

         function sms_reports()
         {

              $data['count_sms'] = $this->reports_m->count_sms();
              $data['count_purchased_sms'] = $this->reports_m->count_purchased_sms();
              $data['sms_sent_per_month'] = $this->reports_m->sms_sent_per_month();
              $data['sms_cost'] = $this->reports_m->sms_cost()->total;
              $title = 'SMS Reports';

              $pie_data = array();
              $data['pie_data'] = array(
                      "Sent SMS" => $this->reports_m->count_sms(),
                      'Purchased SMS' => $this->reports_m->count_purchased_sms()->total,
                      'SMS Cost' => $this->reports_m->sms_cost()->total,
              );



              $this->template->title($title)->build('admin/sms_report', $data);
         }

         function filter_sms()
         {
              $data['count_sms'] = $this->reports_m->count_sms();
              $data['sms'] = $this->reports_m->filter_sms();
              $data['count_per_date'] = 10; // $this->reports_m->count_sms_per_date();
              $data['month'] = '';

              $title = 'SMS Reports';

              $this->template->title($title)->build('admin/filter_sms', $data);
         }

         function current_monthSMS()
         {
              $data['count_sms'] = $this->reports_m->count_sms();
              $data['sms'] = $this->reports_m->current_monthSMS();
              $data['count_per_date'] = 10; // $this->reports_m->count_sms_per_date();
              $data['month'] = '';

              $title = 'SMS Reports';

              $this->template->title($title)->build('admin/filter_sms', $data);
         }

         //Filter Sent SMS by Dates
         function sms_byDate()
         {


              $month = $this->input->post('month');
              $year = $this->input->post('year');


              if ($month == "" || $year == "")
              {
                   $data['sms'] = $this->reports_m->filter_sms();
              }
              else
              {
                   $data['sms'] = $this->reports_m->sms_byDate($month, $year);
                   $data['count_per_date'] = $this->reports_m->count_sms_byDate($month, $year);
              }
              $data['the_month'] = $month;
              $data['count_sms'] = $this->reports_m->count_sms();

              $this->template->title('Sent SMS Reports ')->set_layout('reports.php')->build('admin/filter_sms', $data);
         }

         function sms_purchased()
         {

              $data['count_purchased_sms'] = $this->reports_m->count_purchased_sms();
              $data['sms'] = $this->reports_m->sms_purchased();
              $data['count_per_date'] = 10; // $this->reports_m->count_sms_per_date();
              $data['month'] = '';

              $title = 'Purchased SMS Reports';

              $this->template->title($title)->build('admin/purchased_sms', $data);
         }

         //Filter Purchased SMS by Dates
         function purchased_byDate()
         {

              $month = $this->input->post('month');
              $year = $this->input->post('year');

              if ($month == "" || $year == "")
              {
                   $data['sms'] = $this->reports_m->sms_purchased();
              }
              else
              {
                   $data['sms'] = $this->reports_m->purchased_byDate($month, $year);
                   $data['count_per_date'] = $this->reports_m->count_purchased_byDate($month, $year);
              }
              $data['the_month'] = $month;
              $data['count_purchased_sms'] = $this->reports_m->count_purchased_sms();

              $this->template->title('Purchased SMS Reports ')->set_layout('reports.php')->build('admin/purchased_sms', $data);
         }

         /*          * ****
          * ****** ASSETS REPORTS
          * **** */

         function assets_reports()
         {

              $items = $this->reports_m->populate('asset_items', 'id', 'name');
              $item_cost = $this->reports_m->item_cost();
              $data['quantity_in'] = $this->reports_m->quantity_in();
              $data['rem_stock'] = $this->reports_m->rem_stock();
              $category = $this->reports_m->get_assets_category();
              $data['assets_cost'] = $this->reports_m->assets_cost()->total;

              $assets = $this->reports_m->get_assets();

              $data['assets'] = $assets;
              $data['item_cost'] = $item_cost;
              $data['category'] = $category;
              $data['items'] = $items;



              $this->template->title('Assets Reports')->build('admin/assets_report', $data);
         }

         function filter_assets($id)
         {

              //redirect if no $id
              if (!$id)
              {
                   $this->session->set_flashdata('message', array('type' => 'warning', 'text' => lang('web_object_not_exist')));
                   redirect('admin/reports/assets_report');
              }
              $items = $this->reports_m->populate('asset_items', 'id', 'name');
              $item_cost = $this->reports_m->item_cost();
              $data['quantity_in'] = $this->reports_m->quantity_in();
              $data['rem_stock'] = $this->reports_m->rem_stock();
              $category = $this->reports_m->get_assets_category();
              $data['assets_cost'] = $this->reports_m->assets_cost()->total;

              $assets = $this->reports_m->get_stock_out($id);

              $data['assets'] = $assets;
              $data['item_cost'] = $item_cost;
              $data['category'] = $category;
              $data['items'] = $items;

              $data['supplier'] = $this->reports_m->populate('address_book', 'id', 'business_name');
              $data['assets_stock'] = $this->reports_m->get_specific_stock($id);
              $data['get_specific_cost'] = $this->reports_m->get_specific_cost($id)->total;



              $this->template->title('Assets Reports')->build('admin/filter_assets', $data);
         }

         /**
          * Add New Reports 
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
              {         //Validation OK!
                   $user = $this->ion_auth->get_user();
                   $form_data = array(
                           'dtae' => strtotime($this->input->post('dtae')),
                           'title' => $this->input->post('title'),
                           'item_id' => $this->input->post('item_id'),
                           'description' => $this->input->post('description'),
                           'created_by' => $user->id,
                           'created_on' => time()
                   );

                   $ok = $this->reports_m->create($form_data);

                   if ($ok) // the information has therefore been successfully saved in the db
                   {
                        $this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Reports ' . lang('web_create_success')));
                   }
                   else
                   {
                        $this->session->set_flashdata('error', array('type' => 'error', 'text' => 'Reports ' . lang('web_create_failed')));
                   }

                   redirect('admin/reports/');
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
                   $this->template->title('Add Reports ')->build('admin/create', $data);
              }
         }

         /**
          * Edit  Reports 
          *
          * @param $id
          * @param $page
          */
         function edit($id = FALSE, $page = 0)
         {

              //redirect if no $id
              if (!$id)
              {
                   $this->session->set_flashdata('message', array('type' => 'warning', 'text' => lang('web_object_not_exist')));
                   redirect('admin/reports/');
              }
              if (!$this->reports_m->exists($id))
              {
                   $this->session->set_flashdata('message', array('type' => 'warning', 'text' => lang('web_object_not_exist')));
                   redirect('admin/reports');
              }
              //search the item to show in edit form
              $get = $this->reports_m->find($id);
              
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
                           'dtae' => strtotime($this->input->post('dtae')),
                           'title' => $this->input->post('title'),
                           'item_id' => $this->input->post('item_id'),
                           'description' => $this->input->post('description'),
                           'modified_by' => $user->id,
                           'modified_on' => time());

                   //add the aux form data to the form data array to save
                   $form_data = array_merge($form_data_aux, $form_data);

                   //find the item to update

                   $done = $this->reports_m->update_attributes($id, $form_data);

                   // the information has therefore been successfully saved in the db
                   if ($done)
                   {
                        $this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Reports ' . lang('web_edit_success')));
                        redirect("admin/reports/");
                   }
                   else
                   {
                        $this->session->set_flashdata('error', array('type' => 'error', 'text' => $done->errors->full_messages()));
                        redirect("admin/reports/");
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
              //load the view and the layout
              $this->template->title('Edit Reports ')->build('admin/create', $data);
         }

         function delete($id = NULL, $page = 1)
         {
              //filter & Sanitize $id
              $id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;

              //redirect if its not correct
              if (!$id)
              {
                   $this->session->set_flashdata('message', array('type' => 'warning', 'text' => lang('web_object_not_exist')));

                   redirect('admin/reports');
              }

              //search the item to delete
              if (!$this->reports_m->exists($id))
              {
                   $this->session->set_flashdata('message', array('type' => 'warning', 'text' => lang('web_object_not_exist')));

                   redirect('admin/reports');
              }

              //delete the item
              if ($this->reports_m->delete($id) == TRUE)
              {
                   $this->session->set_flashdata('message', array('type' => 'sucess', 'text' => 'Reports ' . lang('web_delete_success')));
              }
              else
              {
                   $this->session->set_flashdata('error', array('type' => 'error', 'text' => lang('web_delete_failed')));
              }

              redirect("admin/reports/");
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
                              'field' => 'dtae',
                              'label' => 'Dtae',
                              'rules' => 'required|xss_clean'),
                      array(
                              'field' => 'title',
                              'label' => 'Title',
                              'rules' => 'required|trim|xss_clean|min_length[0]|max_length[60]'),
                      array(
                              'field' => 'item_id',
                              'label' => 'Item Id',
                              'rules' => 'required|trim|xss_clean|min_length[0]|max_length[60]'),
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
              $config['base_url'] = site_url() . 'admin/reports/index/';
              $config['use_page_numbers'] = TRUE;
              $config['per_page'] = 10000000000;
              $config['total_rows'] = $this->reports_m->count();
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
    