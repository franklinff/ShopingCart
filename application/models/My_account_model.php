<?php

class My_account_model extends CI_Model{

	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }


     /*
     * function name : user_information
     * insert the data into users table for new user registration
     * @author  Franklin
     * @access  public
     * @param : number
     * @return : array
     */
    public function user_information($user_id)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('id', $user_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function update($new_data,$user_id)
    {
        $this->db->where('id',$user_id);
        $r = $this->db->update('users',$new_data);
        return $r;
    }
}

?>


       