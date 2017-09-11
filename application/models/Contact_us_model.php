<?php
class Contact_us_model extends CI_Model{

    public function __construct() {
        parent::__construct();
    }
    

    /*
     * function name : insert
     * Insert contact details
     * @author  Franklin
     * @access  public
     * @param : $data
     */    
    public function insert($data) {
        $r = $this->db->insert('contact_us',$data);
        return $r;
    }

}