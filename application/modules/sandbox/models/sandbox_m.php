<?php

    class Sandbox_m extends MY_Model
    {

         function __construct()
         {
              // Call the Model constructor
              parent::__construct();
              $this->db_set();
         }

         function create($data)
         {
              $this->db->insert('rates', $data);
              return $this->db->insert_id();
         }

         function set_config($data)
         {
              return $this->insert_key_data('config', $data);
         }

         function create_e($data)
         {
              return $this->insert_key_data('parents', $data);
         }

         /**
          * Save new Admission Record
          * 
          * @param type $data
          * @return type
          */
         function save_student($data)
         {
              return $this->insert_key_data('admission', $data);
         }

         /**
          * Save Parent-Child
          * @param type $data
          * @return type
          */
         function save_linkup($data)
         {
              $this->db->insert('assign_parent', $data);
              return $this->db->insert_id();
         }

         /**
          * New payment
          * 
          * @param type $data
          * @return type
          */
         function save_payment($data)
         {
              return $this->insert_key_data('fee_payment', $data);
         }

         /**
          * Create Fee_extras Invoices
          * @param type $data
          * @return type
          */
         function invoice_fee($data)
         {
              return $this->insert_key_data('fee_extra_specs', $data);
         }

         function save_bals($data)
         {
              return $this->insert_key_data('new_balances', $data);
         }

         /**
          * Insert Fee Arrears
          * 
          * @param type $data
          * @return type
          */
         function insert_rears($data)
         {
              return $this->insert_key_data('fee_arrears', $data);
         }

         /**
          * New Receipt
          * 
          * @param type $data
          * @return type
          */
         function insert_rec($data)
         {
              $this->db->insert('fee_receipt', $data);
              return $this->db->insert_id();
         }

         function upd_student($id, $data)
         {
              return $this->update_key_data($id, 'admission', $data);
         }

         /**
          * Add to fee_extras
          * 
          * @param type $data
          * @return int
          */
         function add_extra($data)
         {
              $this->db->insert('fee_extras', $data);
              return $this->db->insert_id();
         }

         /**
          * Add to fee_extra_specs
          * 
          * @param type $data
          * @return int
          */
         function save_spec($data)
         {
              return $this->insert_key_data('fee_extra_specs', $data);
         }

         function find($id)
         {
              return $this->db->where(array('id' => $id))->get('sandbox')->row();
         }

         function exists($id)
         {
              return $this->db->where(array('id' => $id))->count_all_results('sandbox') > 0;
         }

         function count()
         {
              return $this->db->count_all_results('sandbox');
         }

         function update_attributes($data)
         // function update_attributes($id, $data)
         {
              return $this->update_key_all('accounts', $data);
              // return $this->update_key_data($id, 'fee_payment', $data);
              //return $this->db->where('id', $id)->update('sandbox', $data);
         }

         /**
          * Update Config Table
          * 
          * @param type $data
          * @return type
          */
         function fxconfig($data)
         {
              return $this->update_key_data(1, 'config', $data);
         }

         function fxclass($old, $data)
         {
              return $this->update_key_where($this->dx('class') . '=' . $old, 'admission', $data);
         }

         function fxstream($data)
         {
              return $this->update_key_all('admissssion', $data);
              // return $this->update_key_where($this->dx('class') . '=' . $id, 'admission', $data);
              //return $this->db->where('id', $id)->update('sandbox', $data);
         }

         function fetch_invoices()
         {
              return $this->db->get('invoices')->result();
         }

         function fxinvoice_extras($id, $data)
         {
              return $this->db->where('id', $id)->update('invoices', $data);
         }

         function fxinvoice_status()
         {
              //set suspended 3
              $q = "update invoices,admission set invoices.check_st = 3 where AES_DECRYPT(admission.status,SHA2('=4$~?J*&^%2*!!A3C.k&*((()9.[]>^<',512)) =0 AND term=3 AND year=2014";
              return $this->db->query($q);
              //return $this->update_key_where($this->dx('admission.status') . '=0 AND tesrm=' . get_term(date('m')) . ' AND year=' . date('Y'), 'invoices', array('check_st' => 3));
         }

         function fx_arrears($data)
         {
              return $this->update_key_all('fee_arrears', $data);
         }

         function fxstatus($data)
         {
              return $this->update_key_all('fee_lunch', $data);
         }

         function fxwaiver()
         {
              $q = "update fee_waivers set term='2' ";
              return $this->db->query($q);
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
              return $this->db->delete('sandbox', array('id' => $id));
         }

         /**
          * Perform Fee Extras Analogue to Digital Migration 
          */
         function feextras()
         {
              //get Targets
              $targets = array(
                      'fee_admission', 'fee_boarding', 'fee_caution', 'fee_diary', 'fee_interview', 'fee_lunch',
                      'fee_reportbook', 'fee_swimming', 'fee_transport', 'fee_trips', 'fee_uniform');
              //prepare db
              $this->make_extras();
              //get my extras
              $mine = array();
              foreach ($targets as $t)
              {
                   if ($this->fee_exists($t))
                   {
                        $mine[] = $t;
                   }
              }
              /* Add to fee_extras table & return id 
               * Then do a select insert into fee_extra_specs tbl
               */
              echo '<pre>Found you with: </pre><pre>';
              print_r($mine);
              echo '</pre> ';
              $k = 0;
              foreach ($mine as $mk)
              {
                   $mofo = explode('_', $mk);
                   $nm = ucfirst($mofo[1]) . ' ' . ucfirst($mofo[0]);
                   $feex = array('title' => $nm, 'ftype' => 1, 'amount' => 0, 'description' => $nm, 'created_by' => 1, 'created_on' => time());
                   $ex = $this->add_extra($feex);
                   $exlist = $this->fetch_old_extras($mk);
                   $i = 0;
                   foreach ($exlist as $l)
                   {
                        $i++;
                        $dump = array(
                                'student' => $l->student,
                                'term' => $l->term,
                                'year' => $l->year,
                                'amount' => $l->amount,
                                'fee_id' => $ex,
                                'created_by' => 1,
                                'created_on' => time());
                        $this->save_spec($dump);
                   }
                   $k += $i;
                   echo '<pre>' . $mk . ':   ' . $i . '</pre> ';
              }
              echo '<pre>Total Rows Inserted to fee_extra_specs:   ' . $k . '</pre>';
              echo '<pre>----Data Migration Complete----</pre> ';
              echo '<pre>Now you can drop all these tables as they are no longer needed:: </pre><pre>';
              print_r($targets);
              echo '</pre> ';
         }

         function fee_exists($fee)
         {
              return $this->db->count_all_results($fee) > 0;
         }

         function make_extras()
         {
              $this->db->query(" 
	CREATE TABLE IF NOT EXISTS  fee_extras (
	id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
	title  varchar(256)  DEFAULT '' NOT NULL, 
	ftype  int(11)  , 
	amount  float , 
	description  text  , 
	created_by INT(11), 
	modified_by INT(11), 
	created_on INT(11) , 
	modified_on INT(11) 
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8; ");
         }

         function fetch_old_extras($tbl)
         {
              $this->select_all_key($tbl);
              return $this->db
                                        ->get($tbl)
                                        ->result();
         }

         /**
          * Setup DB Table Automatically
          * 
          */
         function db_set()
         {
              $this->db->query(" 
	CREATE TABLE IF NOT EXISTS  sandbox (
	id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
	title  varchar(256)  DEFAULT '' NOT NULL, 
	day  INT(11), 
	dday  varchar(256)  DEFAULT '' NOT NULL, 
	time  varchar(256)  DEFAULT '' NOT NULL, 
	slot  varchar(256)  DEFAULT '' NOT NULL, 
	link  varchar(256)  DEFAULT '' NOT NULL, 
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
              $query = $this->db->get('sandbox', $limit, $offset);

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
    