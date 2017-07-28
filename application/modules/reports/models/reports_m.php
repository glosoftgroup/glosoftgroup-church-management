<?php

    class Reports_m extends MY_Model
    {

         function __construct()
         {
              // Call the Model constructor
              parent::__construct();
              $this->db_set();

              //print_r($this->jan_members());die;
         }

         function create($data)
         {
              $this->db->insert('reports', $data);
              return $this->db->insert_id();
         }

         /**
          * Expenses Summary Report
          * 
          * @param int $term
          * @param int $year
          * @return type
          */
         function get_expenses($month = 0, $year = 0)
         {
              $this->db->order_by('created_on', 'DESC');
              if ($month)
              {
                   $this->db->where_in('MONTH(FROM_UNIXTIME(date)) ', $month, NULL, FALSE);
              }
              if ($year)
              {
                   $this->db->where("DATE_FORMAT(FROM_UNIXTIME(date),'%Y')", $year, NULL, FALSE);
              }

              return $this->db->where('status', 1)->group_by('category')->order_by('created_on', 'DESC')->get('expenses')->result();
         }

         /**
          * Petty FROM TO
          * 
          */
         function petty_range($from = 0, $to = 0)
         {


              if (($from && $to) && $from == $to)
              {
                   $dt = date('d-m-Y', $from);
                   $this->db->where("DATE_FORMAT(FROM_UNIXTIME(date),'%d-%m-%Y') ='" . $dt . "'", NULL, FALSE);
              }
              else
              {
                   if ($from)
                   {
                        $this->db->where('date >' . $from, NULL, FALSE);
                   }
                   if ($to)
                   {
                        $this->db->where('date <' . $to, NULL, FALSE);
                   }
              }

              return $this->db->where('status', 1)->order_by('created_on', 'DESC')->get('petty_cash')->result();
         }

         /**
          * Expenses Summary Report
          * 
          * @param int $term
          * @param int $year
          * @return type
          */
         function get_petty_cash($month = 0, $year = 0)
         {

              if ($month)
              {
                   $this->db->where_in('MONTH(FROM_UNIXTIME(date)) ', $month, NULL, FALSE);
              }
              if ($year)
              {
                   $this->db->where("DATE_FORMAT(FROM_UNIXTIME(date),'%Y')", $year, NULL, FALSE);
              }

              return $this->db->where('status', 1)->order_by('created_on', 'DESC')->get('petty_cash')->result();
         }

         // Filter Expenses

         function total_expense_amount($cat, $month = 0, $year = 0)
         {
              $this->db->order_by('created_on', 'DESC');

              if ($month)
              {

                   $this->db->where_in('MONTH(FROM_UNIXTIME(date)) ', $month, NULL, FALSE);
              }
              if ($year)
              {
                   $this->db->where("DATE_FORMAT(FROM_UNIXTIME(date),'%Y')", $year, NULL, FALSE);
              }
              return $this->db->select('sum(amount) as total')->where(array('category' => $cat, 'status' => 1))->get('expenses')->row();
         }

         // Filter Petty cash

         function total_petty_cash_amount($cat, $month = 0, $year = 0)
         {
              $this->db->order_by('created_on', 'DESC');

              if ($month)
              {

                   $this->db->where_in('MONTH(FROM_UNIXTIME(date)) ', $month, NULL, FALSE);
              }
              if ($year)
              {
                   $this->db->where("DATE_FORMAT(FROM_UNIXTIME(date),'%Y')", $year, NULL, FALSE);
              }
              return $this->db->select('sum(amount) as total')->where(array('item' => $cat, 'status' => 1))->get('petty_cash')->row();
         }

         // Filter Expenses

         function total_expenses_this_year()
         {
              $this->db->order_by('created_on', 'DESC');
              $this->db->where("DATE_FORMAT(FROM_UNIXTIME(date),'%Y')", date('Y'), NULL, FALSE);

              return $this->db->select('sum(amount) as total')->where(array('status' => 1))->get('expenses')->row();
         }

         function total_petty_cash_this_year()
         {
              $this->db->order_by('created_on', 'DESC');
              $this->db->where("DATE_FORMAT(FROM_UNIXTIME(date),'%Y')", date('Y'), NULL, FALSE);

              return $this->db->select('sum(amount) as total')->where(array('status' => 1))->get('petty_cash')->row();
         }

         //Expenses Category

         function expense_categories()
         {
              $result = $this->db->select('expenses_category.*')
                           ->order_by('created_on', 'DESC')
                           ->get('expenses_category')
                           ->result();

              $rr = array();
              foreach ($result as $res)
              {
                   $rr[$res->id] = $res->name;
              }

              return $rr;
         }

         //Expenses Items

         function expense_items()
         {
              $result = $this->db->select('expenses_items.*')
                           ->order_by('created_on', 'DESC')
                           ->get('expenses_items')
                           ->result();

              $rr = array();
              foreach ($result as $res)
              {
                   $rr[$res->id] = $res->name;
              }

              return $rr;
         }

         /**
          * Get Salaries report
          * 
          * @return type
          */
         function get_salaries()
         {
              $this->db->order_by('created_on', 'DESC');
              return $this->db->select('record_salaries.*')->group_by('salary_date')->order_by('salary_date', 'DESC')->get('record_salaries')->result();
         }

         function count_employees($date)
         {
              return $this->db->where(array('salary_date' => $date))->count_all_results('record_salaries');
         }

         function total_basic($date)
         {
              return $this->db->select('sum(basic_salary) as basic')->where(array('salary_date' => $date))->get('record_salaries')->row();
         }

         function total_deductions($date)
         {
              return $this->db->select('sum(total_deductions) as ded')->where(array('salary_date' => $date))->get('record_salaries')->row();
         }

         function total_allowances($date)
         {
              return $this->db->select('sum(total_allowance) as allws')->where(array('salary_date' => $date))->get('record_salaries')->row();
         }

         function total_nhif($date)
         {
              return $this->db->select('sum(nhif) as nhif')->where(array('salary_date' => $date))->get('record_salaries')->row();
         }

         function total_advance($date)
         {
              return $this->db->select('sum(advance) as advs')->where(array('salary_date' => $date))->get('record_salaries')->row();
         }

         //********************END WAGES ***********************//
         //Banks


         function get_banks()
         {

              $results = $this->db->get('bank_accounts')->result();

              $res = array();

              foreach ($results as $r)
              {
                   $res[$r->id] = $r->bank_name . ' (' . $r->account_number . ')';
              }

              return $res;
         }

         /*          * *
          * ****
          * **** REGISTRATION REPORTS DATA
          * ****
          * */

         //Filter Members

         function filter_members()
         {
              $this->select_all_key('members');
              $this->db->order_by('created_on', 'DESC');
              return $this->db->get('members')->result();
         }

         //Filter Members By Date

         function members_byDate($month, $year)
         {

              $this->select_all_key('members');
              $this->db->order_by('created_on', 'DESC');
              return $this->db
                                        ->where_in("DATE_FORMAT(FROM_UNIXTIME(" . $this->dx('date_joined') . "),'%m-%Y')", '0' . $month . '-' . $year, FALSE)
                                        ->get('members')->result();
         }

         //Count members per Date

         function count_members_byDate($month, $year)
         {

              $this->select_all_key('members');
              $this->db->order_by('created_on', 'DESC');
              return $this->db
                                        ->where_in("DATE_FORMAT(FROM_UNIXTIME(" . $this->dx('date_joined') . "),'%m-%Y')", '0' . $month . '-' . $year, FALSE)
                                        ->count_all_results('members');
         }

         //Count members per Date

         function members_custom_filter($field)
         {

              $this->select_all_key('members');
              $this->db->order_by('created_on', 'DESC');
              return $this->db->where($this->dx('gender') . "='" . $field . "'", NULL, FALSE)->get('members')->result();
              //  return  $this->db->where($this->dx('email')."='".$email."'",NULL,FALSE)->get('users')->row();
              //return $this->db->where($this->dx('gender')." like '%".$field."%'", NULL, false)->get('members')->result();
         }

         //start pledges
         function total_paid()
         {
              $this->db->where("DATE_FORMAT(FROM_UNIXTIME(date),'%Y')", date('Y'), NULL, FALSE);
              return $this->db->select('sum(amount) as total')->where(array('status' => 1))->get('paid_pledges')->row();
         }

         function get_paid()
         {
              $this->db->order_by('created_on', 'DESC');
              return $this->db->where(array('status' => 1))->get('paid_pledges')->result();
         }

         //pending pledges
         function total_pending()
         {
              $this->db->where("DATE_FORMAT(FROM_UNIXTIME(date),'%Y')", date('Y'), NULL, FALSE);
              return $this->db->select('sum(amount) as total')->where(array('status' => 1))->get('pledges')->row();
         }

         function get_pending()
         {
              $this->db->order_by('created_on', 'DESC');
              return $this->db->where(array('status' => 1))->get('pledges')->result();
         }

         //end pledges
         //Registered Members January
         function members_bar()
         {

              return $this->db->select('date_joined,count(date_joined) as count, DATE_FORMAT(FROM_UNIXTIME(' . $this->dx("date_joined") . '),"%m") as the_month', FALSE)
                                        ->where_in("DATE_FORMAT(FROM_UNIXTIME(" . $this->dx('date_joined') . "),'%Y')", date('Y'), FALSE)
                                        ->group_by('the_month')
                                        ->get('members')
                                        ->result_array();
         }

         function members_chart()
         {
              $this->select_all_key('members');
              $data = $this->db
                           ->where_in("DATE_FORMAT(FROM_UNIXTIME(" . $this->dx('date_joined') . "),'%Y')", date('Y'), FALSE)
                           ->group_by("date_joined")
                           ->get('members')
                           ->result();

              $dat = array();
              foreach ($data as $d)
              {
                   $per = $this->db->where_in("DATE_FORMAT(FROM_UNIXTIME(" . $this->dx('date_joined') . "),'%m')", date('m', $d->date_joined), FALSE)->group_by("date_joined")->count_all_results('members');

                   $dat[] = $per;
              }

              //print_r($dat);die;
              return $data;
         }

         /*          * *
          * ***FILTER Visitors
          * *** */

         function filter_visitors()
         {

              return $this->db->get('visitors')->result();
         }

         //Count Visitors per Date

         function count_visitors_byDate($month, $year)
         {

              return $this->db
                                        ->where("DATE_FORMAT(FROM_UNIXTIME(visit_date),'%m-%Y')", '0' . $month . '-' . $year)
                                        ->count_all_results('visitors');
         }

         // Visitors per Date	
         function visitors_byDate($month, $year)
         {

              return $this->db
                                        ->where("DATE_FORMAT(FROM_UNIXTIME(visit_date),'%m-%Y')", '0' . $month . '-' . $year)
                                        ->get('visitors')->result();
         }

         /*          * *
          * ***FILTER Baptism
          * *** */

         function filter_baptism()
         {

              return $this->db->get('baptism')->result();
         }

         //Count Visitors per Date

         function count_baptism_byDate($month, $year)
         {

              return $this->db
                                        ->where("DATE_FORMAT(FROM_UNIXTIME(date),'%m-%Y')", '0' . $month . '-' . $year)
                                        ->count_all_results('baptism');
         }

         // Visitors per Date	
         function baptism_byDate($month, $year)
         {

              return $this->db
                                        ->where("DATE_FORMAT(FROM_UNIXTIME(date),'%m-%Y')", '0' . $month . '-' . $year)
                                        ->get('baptism')->result();
         }

         /*          * *
          * ***FILTER Dedicated
          * *** */

         function filter_dedications()
         {

              return $this->db->get('dedications')->result();
         }

         //Count Visitors per Date

         function count_dedications_byDate($month, $year)
         {

              return $this->db
                                        ->where("DATE_FORMAT(FROM_UNIXTIME(date),'%m-%Y')", '0' . $month . '-' . $year)
                                        ->count_all_results('dedications');
         }

         // Visitors per Date	
         function dedications_byDate($month, $year)
         {

              return $this->db
                                        ->where("DATE_FORMAT(FROM_UNIXTIME(date),'%m-%Y')", '0' . $month . '-' . $year)
                                        ->get('dedications')->result();
         }

         /*          * *
          * ***FILTER filter_ssSchool
          * *** */

         function filter_ssSchool()
         {

              return $this->db->get('sunday_school')->result();
         }

         //Count Visitors per Date

         function count_ssSchool_byDate($month, $year)
         {

              return $this->db
                                        ->where("DATE_FORMAT(FROM_UNIXTIME(date_joined),'%m-%Y')", '0' . $month . '-' . $year)
                                        ->count_all_results('sunday_school');
         }

         // Visitors per Date	
         function ssSchool_byDate($month, $year)
         {

              return $this->db
                                        ->where("DATE_FORMAT(FROM_UNIXTIME(date_joined),'%m-%Y')", '0' . $month . '-' . $year)
                                        ->get('sunday_school')->result();
         }

         function ss_parent()
         {

              $res = $this->db->get('ss_parents')->result();
              $rr = array();

              foreach ($res as $r)
              {
                   $rr[$r->child_id] = $r->first_name . ' ' . $r->last_name;
              }

              return $rr;
         }

         //Filter HBC members

         function filter_hbc_members()
         {

              $this->select_all_key('members');

              return $this->db->where($this->dx('hbc_id') . "!=''", NULL, FALSE)->get('members')->result();
              //  return  $this->db->where($this->dx('email')."='".$email."'",NULL,FALSE)->get('users')->row();
              //return $this->db->where($this->dx('gender')." like '%".$field."%'", NULL, false)->get('members')->result();
         }

         //Count members per Date

         function count_hbc_members_byDate($month, $year)
         {

              $this->select_all_key('members');

              return $this->db
                                        ->where_in("DATE_FORMAT(FROM_UNIXTIME(" . $this->dx('date_joined') . "),'%m-%Y')", '0' . $month . '-' . $year, FALSE)
                                        ->count_all_results('members');
         }

         //count All Members

         function count_members()
         {

              return $this->db->count_all_results('members');
         }

         //count All Visitors

         function count_visitors()
         {

              return $this->db->count_all_results('visitors');
         }

         //count All Sunday School

         function count_sSchool()
         {

              return $this->db->count_all_results('sunday_school');
         }

         function count_baptised_members()
         {

              return $this->db->where($this->dx('baptised') . '= "yes"', NULL, FALSE)->count_all_results('members');
         }

         //Count Dedicated Children
         function count_dedicated()
         {

              return $this->db->count_all_results('dedications');
         }

         //Count Baptism 
         function count_baptism()
         {

              return $this->db->count_all_results('baptism');
         }

         //Count HBC Members
         function count_hbc_members()
         {

              return $this->db->where($this->dx('hbc_id') . '!= " "', NULL, FALSE)->count_all_results('members');
         }

         //Count Ministry Members
         function count_ministry_members()
         {

              return $this->db->count_all_results('member_ministries');
         }

         /*          * *
          * ****
          * ****SMS REPORTS DATA
          * ****
          * */

         function count_sms()
         {
              return $this->db->count_all_results('sms');
         }

         //Get SMSs Sent
         function filter_sms()
         {

              return $this->db->order_by('id', 'DESC')->get('sms')->result();
         }

         function count_purchased_sms()
         {

              return $this->db->select('sum(' . $this->dx('total') . ') as total', FALSE)
                                        ->get('current')
                                        ->row();
         }

         function sms_cost()
         {

              return $this->db->select('sum(cost) as total')
                                        ->get('sms')
                                        ->row();
         }

         function sms_sent_per_month()
         {

              return $this->db->where("DATE_FORMAT(FROM_UNIXTIME(created_on),'%m-%Y')", date('m-Y'))->count_all_results('sms');
         }

         function current_monthSMS()
         {

              return $this->db->where("DATE_FORMAT(FROM_UNIXTIME(created_on),'%m-%Y')", date('m-Y'))->get('sms')->result();
         }

         function sms_byDate($month, $year)
         {

              return $this->db->where("DATE_FORMAT(FROM_UNIXTIME(created_on),'%m-%Y')", '0' . $month . '-' . $year)->get('sms')->result();
         }

         function count_sms_byDate($month, $year)
         {

              return $this->db->where("DATE_FORMAT(FROM_UNIXTIME(created_on),'%m-%Y')", '0' . $month . '-' . $year)->count_all_results('sms');
         }

         function sms_purchased()
         {

              $this->select_all_key('current');
              return $this->db->order_by('id', 'DESC')->get('current')->result();
         }

         function purchased_byDate($month, $year)
         {

              $this->select_all_key('current');

              return $this->db
                                        ->where_in("DATE_FORMAT(FROM_UNIXTIME(" . $this->dx('date') . "),'%m-%Y')", '0' . $month . '-' . $year, FALSE)
                                        ->order_by('id', 'DESC')
                                        ->get('current')->result();
         }

         function count_purchased_byDate($month, $year)
         {


              return $this->db
                                        ->where_in("DATE_FORMAT(FROM_UNIXTIME(" . $this->dx('date') . "),'%m-%Y')", '0' . $month . '-' . $year, FALSE)
                                        ->count_all_results('current');
         }

         /*          * *
          * ****
          * ****Inventory REPORTS DATA
          * ****
          * */

         function get_assets()
         {

              return $this->db->group_by('item')->get('asset_stock')->result();
         }

         function get_specific_stock($id)
         {

              return $this->db->where('item', $id)->order_by('created_on', 'DESC')->get('asset_stock')->result();
         }

         function get_stock_out($id)
         {

              return $this->db->where('asset_name', $id)->order_by('created_on', 'DESC')->get('take_stock')->result();
         }

         function get_specific_cost($id)
         {

              return $this->db->select('sum(total) as total')->where('item', $id)->get('asset_stock')->row();
         }

         function item_cost()
         {

              $res = $this->db->get('asset_stock')->result();
              $total = array();
              foreach ($res as $r)
              {

                   $tt = $this->db->select('asset_stock.item, sum(total) as total')->where('item', $r->item)->get('asset_stock')->row();
                   $total[$r->item] = $tt->total;
              }

              return $total;
         }

         function quantity_in()
         {

              $res = $this->db->get('asset_stock')->result();
              $total = array();
              foreach ($res as $r)
              {

                   $tt = $this->db->select('asset_stock.item, sum(quantity) as total')->where('item', $r->item)->get('asset_stock')->row();
                   $total[$r->item] = $tt->total;
              }

              return $total;
         }

         function get_assets_category()
         {
              $cats = $this->populate('asset_category', 'id', 'name');

              $res = $this->db->get('asset_items')->result();
              $rr = array();
              foreach ($res as $r)
              {
                   $rr[$r->id] = $cats[$r->category];
              }

              return $rr;
         }

         function rem_stock()
         {

              $res = $this->db->get('take_stock')->result();
              $rr = array();
              foreach ($res as $r)
              {
                   $rr[$r->asset_name] = $r->remaining_stock;
              }

              return $rr;
         }

         function assets_cost()
         {

              return $this->db->select('sum(total) as total')
                                        ->get('asset_stock')
                                        ->row();
         }

         /*          * *
          * ****
          * ****ACCOUNT REPORTS DATA
          * ****
          * */

         //Filter Accounts

         function filter_account($table)
         {

              $this->select_all_key($table);

              return $this->db
                                        ->where_in("DATE_FORMAT(FROM_UNIXTIME(" . $this->dx('date') . "),'%Y')", date('Y'), FALSE)
                                        ->get($table)->result();
         }

         //Filter Accounts By Date

         function accounts_date($table, $month, $year)
         {

              $this->select_all_key($table);

              return $this->db
                                        ->where_in("DATE_FORMAT(FROM_UNIXTIME(" . $this->dx('date') . "),'%m-%Y')", '0' . $month . '-' . $year, FALSE)
                                        ->get($table)->result();
         }

         // Get Totals For a table
         //Sum Thanks Giving Contributions
         function total_collection($tbl)
         {
              $amnt = '';
              if ($tbl == 'offerings')
                   $amnt = 'amount';
              else
                   $amnt = 'totals';

              return $this->db->select('sum(' . $this->dx($amnt) . ') as total', FALSE)
                                        ->where_in("DATE_FORMAT(FROM_UNIXTIME(" . $this->dx('date') . "),'%Y')", date('Y'), FALSE)
                                        ->get($tbl)
                                        ->row();
         }

         //Sum Offering Contributions
         function sum_offerings()
         {

              return $this->db->select('sum(' . $this->dx('amount') . ') as total', FALSE)
                                        ->where_in("DATE_FORMAT(FROM_UNIXTIME(" . $this->dx('date') . "),'%Y')", date('Y'), FALSE)
                                        ->get('offerings')
                                        ->row();
         }

         //Sum Tithe Contributions
         function sum_tithes()
         {

              return $this->db->select('sum(' . $this->dx('totals') . ') as total', FALSE)
                                        ->where_in("DATE_FORMAT(FROM_UNIXTIME(" . $this->dx('date') . "),'%Y')", date('Y'), FALSE)
                                        ->get('tithes')
                                        ->row();
         }

         //Sum Thanks Giving Contributions
         function sum_thanks()
         {

              return $this->db->select('sum(' . $this->dx('totals') . ') as total', FALSE)
                                        ->where_in("DATE_FORMAT(FROM_UNIXTIME(" . $this->dx('date') . "),'%Y')", date('Y'), FALSE)
                                        ->get('thanks_giving')
                                        ->row();
         }

//Sum Ministry Support Contributions
         function sum_support()
         {

              return $this->db->select('sum(' . $this->dx('totals') . ') as total', FALSE)
                                        ->where_in("DATE_FORMAT(FROM_UNIXTIME(" . $this->dx('date') . "),'%Y')", date('Y'), FALSE)
                                        ->get('ministry_support')
                                        ->row();
         }

//Sum Seeds Contributions
         function sum_seeds()
         {

              return $this->db->select('sum(' . $this->dx('totals') . ') as total', FALSE)
                                        ->where_in("DATE_FORMAT(FROM_UNIXTIME(" . $this->dx('date') . "),'%Y')", date('Y'), FALSE)
                                        ->get('seed_planting')
                                        ->row();
         }

         //Sum Other Contributions
         function sum_others()
         {

              return $this->db->select('sum(' . $this->dx('totals') . ') as total', FALSE)
                                        ->where_in("DATE_FORMAT(FROM_UNIXTIME(" . $this->dx('date') . "),'%Y')", date('Y'), FALSE)
                                        ->get('other_contributions')
                                        ->row();
         }

         //Sum Paid Pledges
         function sum_paid_pledges()
         {

              return $this->db->select('sum(amount) as total')
                                        ->where_in("DATE_FORMAT(FROM_UNIXTIME(date),'%Y')", date('Y'))
                                        ->get('paid_pledges')
                                        ->row();
         }

         function find($id)
         {
              return $this->db->where(array('id' => $id))->get('reports')->row();
         }

         function exists($id)
         {
              return $this->db->where(array('id' => $id))->count_all_results('reports') > 0;
         }

         function count()
         {

              return $this->db->count_all_results('reports');
         }

         function update_attributes($id, $data)
         {
              return $this->db->where('id', $id)->update('reports', $data);
         }

         function populate($table, $option_val, $option_text)
         {
              $query = $this->db->select('*')->order_by($option_text)->get($table);
              $dropdowns = $query->result();
              $options = array();
              foreach ($dropdowns as $dropdown)
              {
                   $options[$dropdown->$option_val] = $dropdown->$option_text;
              }
              return $options;
         }

         function delete($id)
         {
              return $this->db->delete('reports', array('id' => $id));
         }

         /**
          * Setup DB Table Automatically
          * 
          */
         function db_set()
         {
              $this->db->query(" 
	CREATE TABLE IF NOT EXISTS  reports (
	id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
	dtae  INT(11), 
	title  varchar(256)  DEFAULT '' NOT NULL, 
	item_id  varchar(256)  DEFAULT '' NOT NULL, 
	description  text  , 
	created_by INT(11), 
	modified_by INT(11), 
	created_on INT(11) , 
	modified_on INT(11) 
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8; ");
         }

         function paginate_all($limit, $page)
         {
              $offset = $limit * ( $page - 1);

              $this->db->order_by('id', 'desc');
              $query = $this->db->get('reports', $limit, $offset);

              $result = array();

              foreach ($query->result() as $row)
              {
                   $result[] = $row;
              }

              if ($result)
              {
                   return $result;
              }
              else
              {
                   return FALSE;
              }
         }

    }
    