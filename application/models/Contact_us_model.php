<?php
class Contact_us_model extends CI_Model{

    public function __construct() {
        parent::__construct();
    }
    
    /*
     * insert
     * Insert contact details
     * @access public
     * @param $data
     * @return boolean
     */
    public function insert($data) {
        $r = $this->db->insert('contact_us',$data);
        return $r;
    }
}