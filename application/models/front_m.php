<?php

class Front_m extends CI_Model
{

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    /**
     * Get All
     * 
     */
    function get_all()
    {
        return $this->db
                          ->order_by('item_id', 'ASC')
                          ->get('catalog')
                          ->result();
    }

}
