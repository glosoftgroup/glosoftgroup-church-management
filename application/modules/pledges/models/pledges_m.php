<?php

    class Pledges_m extends MY_Model
    {

         function __construct()
         {
              // Call the Model constructor
              parent::__construct();
              $this->db_set();
         }

         function create($data)
         {
              $this->db->insert('pledges', $data);
              return $this->db->insert_id();
         }

         function insert_payment($data)
         {
              $this->db->insert('paid_pledges', $data);
              return $this->db->insert_id();
         }

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

         function find($id)
         {
              return $this->db->where(array('id' => $id))->get('pledges')->row();
         }

         function total_paid($id)
         {
              return $this->db->select('sum(amount) as total')->where(array('pledge_id' => $id))->get('paid_pledges')->row();
         }

         function get_paid($id)
         {
              return $this->db->where(array('id' => $id))->get('paid_pledges')->row();
         }

         function exists($id)
         {
              return $this->db->where(array('id' => $id))->count_all_results('pledges') > 0;
         }

         function exists_payment($id)
         {
              return $this->db->where(array('id' => $id))->count_all_results('paid_pledges') > 0;
         }

         function count()
         {
              return $this->db->count_all_results('pledges');
         }

         function update_attributes($id, $data)
         {
              return $this->db->where('id', $id)->update('pledges', $data);
         }

         function update_paid($id, $data)
         {
              return $this->db->where('id', $id)->update('paid_pledges', $data);
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
              return $this->db->delete('pledges', array('id' => $id));
         }

         /**
          * Setup DB Table Automatically
          * 
          */
         function db_set()
         {
              $this->db->query(" 
	CREATE TABLE IF NOT EXISTS  pledges (
	id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
	date  INT(11), 
	title  varchar(256)  DEFAULT '' NOT NULL, 
	member  varchar(32)  DEFAULT '' NOT NULL, 
	amount  varchar(256)  DEFAULT '' NOT NULL, 
	expected_pay_date  INT(11), 
	status  varchar(32)  DEFAULT '' NOT NULL, 
	remarks  text  , 
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
              $query = $this->db->get('pledges', $limit, $offset);

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

         function paid($limit, $page)
         {
              $this->db->where('paid_pledges.status', 1);
              $this->db->order_by('paid_pledges.id', 'desc');
              $res = $this->db->select('paid_pledges.id as ppid, pledges.date,pledges.title,pledges.member,paid_pledges.pledge_id,paid_pledges.date as pdate,paid_pledges.amount as total,paid_pledges.created_by')
                           ->join('paid_pledges', 'paid_pledges.pledge_id=pledges.id')
                           ->get('pledges')
                           ->result();

              return $res;
         }

         function voided($limit, $page)
         {
              $offset = $limit * ( $page - 1);

              $this->db->where('status', 0);
              $this->db->order_by('id', 'desc');
              $query = $this->db->get('pledges', $limit, $offset);

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

         function pending($limit, $page)
         {
              $offset = $limit * ( $page - 1);

              $this->db->where('status', 1);
              $this->db->order_by('id', 'desc');
              $query = $this->db->get('pledges', $limit, $offset);

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
    