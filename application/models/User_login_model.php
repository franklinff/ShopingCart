<?php

class User_login_model extends CI_Model{

	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

 

     /*
     * function name : registration
     * insert the data into users table for new user registration
     * @author  Franklin
     * @access  public
     * @param : number
     * @return : array
     */
    public function registration($data)
    {
        $result =$this->db->insert('users',$data);
        return $result;
    }


     /*
     * function name : login
     * insert the data into users table for new user registration
     * @author  Franklin
     * @access  public
     * @param : number
     * @return : array
     */
    public function login($email,$password)
    {
        $condition = "email =" . "'" . $email . "' AND " . "password =" . "'" . $password . "'";
        $this->db->select('*');
        $this->db->where($condition);
        $query = $this->db->get('users'); //users is db table.
        /*echo '<pre>';
        print_r($query);
        die();*/
        return $query->result_array();
    }


     /*
     * function name : fb_login
     * insert the data into users table for new user registration
     * @author  Franklin
     * @access  public
     * @param : number
     * @return : array
     */
    public function fb_login($email)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('email =', $email);
        $query = $this->db->get();
        return $query->result_array();
        /*print_r($this->db->last_query());exit;*/
        /*echo '<pre>';print_r($query);die();  */      
    }


     /*
     * function name : registration_through_fb
     * insert the data into users table for new user registration
     * @author  Franklin
     * @access  public
     * @param : number
     * @return : array
     */
    public function registration_through_fb($first_name,$last_name,$email,$id)
    {
        $data = array(
            'firstname' => $first_name,
            'lastname' =>$last_name,
            'email'=> $email,
            'fb_token' => $id,
            'created_date' => date('y-m-d'),
            'role_type' => 5,
            'registration_method' => 'f'
            );
        /*echo '<pre>';print_r($data);die();*/
        $result =$this->db->insert('users',$data);
        return $result;
    }

 
     /*
     * function name : gmail_login
     * 
     * @author  Franklin
     * @access  public
     * @param : number
     * @return : array
     */
    public function gmail_login($email)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('email =', $email);
        $query = $this->db->get();
        return $query->result_array();
        /*print_r($this->db->last_query());
        exit;*/
        /*echo '<pre>';
        print_r($query);
        die();  */      
    }


     /*
     * function name : registration_through_gmail
     * 
     * @author  Franklin
     * @access  public
     * @param : number
     * @return : array
     */
    public function registration_through_gmail($first_name,$last_name,$email,$id)
    {
        $data = array(
            'firstname' => $first_name,
            'lastname' =>$last_name,
            'email'=> $email,
            'google_token' => $id,
            'created_date' => date('y-m-d'),
            'role_type' => 5,
            'registration_method' => 'g'
            );
        /*echo '<pre>';
        print_r($data);
        die();*/
        $result =$this->db->insert('users',$data);
        return $result;

    }


}
?>