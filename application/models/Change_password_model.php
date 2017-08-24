<?php

class Change_password_model extends CI_Model{
    
    public function __construct() {
        parent::__construct();
    }
    
    /*
     * update
     * Update password
     * @access public
     * @param $data
     * @return boolean
     */
    public function update($data) {
        $this->db->set('password',($data['new_password']));
        $this->db->where('id',$data['user_id']);
        $this->db->where('email',$data['email']);
        $r = $this->db->update('users');
        return $r;
    }
    
    /*
     * check_password
     * Get match
     * @access public
     * @param $password
     * @return array
     */
    public function check_password($user_id) {
        $this->db->select('password');
        $this->db->from('users');
        $this->db->where('id',$user_id);
        $r = $this->db->get();
        return $r->result_array();
    }
        
}