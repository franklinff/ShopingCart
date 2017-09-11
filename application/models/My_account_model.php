<?php
class My_account_model extends CI_Model{

	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }


     /*
     * function name : user_information
     * Retreives data from users table
     * @author  Franklin
     * @access  public
     * @param : $user_id
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


    /*
     * function name : update
     * Updates the users table 
     * @author  Franklin
     * @access  public
     * @param : $new_data,$user_id
     */
    public function update($new_data,$user_id)
    {
        $this->db->where('id',$user_id);
        $r = $this->db->update('users',$new_data);
        return $r;
    }


}
?>


       