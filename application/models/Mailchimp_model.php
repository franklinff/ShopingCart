<?php
class Mailchimp_model extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

     /*
     * function name : insert_user_mail
     * insert the data into banners table
     * @author  Franklin
     * @access  public
     * @param : array
     * @return : array
     */
    public function insert_user_mail($email)
    {
        $data['email'] = $email;
        $result = $this->db->insert('news_letter',$data);
        return $result;
    }

    public function verify_if_registered($email)
    {
    	$data['email'] = $email;
    	$this->db->select('*');
    	$this->db->where('email',$data['email']);
    	$result = $this->db->get('news_letter');
   	    return $result->result_array();
    }
    	

}
   


