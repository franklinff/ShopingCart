<?php

class Change_password_model extends CI_Model{
    
    public function __construct() {
        parent::__construct();
    }
    

    /*
     * function name : update
     * Update password
     * @author  Franklin
     * @access  public
     * @param : $data
     */
    public function update($data) {
        $this->db->set('password',($data['new_password']));
        $this->db->where('id',$data['user_id']);
        $this->db->where('email',$data['email']);
        $r = $this->db->update('users');
        return $r;
    }
    


    /*
     * function name : check_password
     * Get match
     * @author  Franklin
     * @access  public
     * @param : $user_id
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