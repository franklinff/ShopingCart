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
     * @param : $data
     */
    public function registration($data)
    {
        $data1['firstname'] =$data['firstname'];
        $data1['lastname'] = $data['lastname'];
        $data1['email'] = $data['email'];
        $data1['password'] = md5($data['password']);
        $data1['created_date'] = $data['created_date'];
        $data1['role_type'] = $data['role_type'];
        $data1['status'] = $data['status'];

        $result =$this->db->insert('users',$data1);
        return $result;
    }



    /*
     * function name : login
     * insert the data into users table for new user registration
     * @author  Franklin
     * @access  public
     * @param : $email,$password
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
     * @param : $email
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
     * @param : $first_name,$last_name,$email,$id
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
            'registration_method' => 'f',
            'status' =>'1'
            );
        /*echo '<pre>';print_r($data);die();*/
        $result =$this->db->insert('users',$data);
        return $result;
    }
 
     /*
     * function name : gmail_login
     * @author  Franklin
     * @access  public
     * @param : $email
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
     * @author  Franklin
     * @access  public
     * @param : $first_name,$last_name,$email,$id
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

        $result =$this->db->insert('users',$data);
        return $result;

    }

    /*
     * function name : getEmailTemplate
     * @author  Franklin
     * @access  public
     * @param : $first_name,$last_name,$email,$id
     */
    public function getEmailTemplate($title) {
        $this->db->select('*');
        $this->db->from('email_template');
        $this->db->where('title', $title);
        $query = $this->db->get();
        return $query->result_array();
    }




    public function getId($user_id)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('id', $user_id);

        $query = $this->db->get();
        return $query->result_array();
    }

}
?>