<?php
class Forgot_password_model extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

     /*
     * function name :fetch_products
     *  To get  all active products
     * @author  Franklin
     * @access  public
     * @param : number
     * @return : array
     */
    public function search_email($email)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('email =', $email);
        $query = $this->db->get();
        return $query->result_array();
    }

}