<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
phpinfo();
die();*/
class UserLogin extends CI_Controller
{ 

    public function __construct()
    {
        parent::__construct();

        // Load facebook library
        //$this->load->library('facebook');

        //Load user model
        $this->load->model('User');

        $this->load->model('User_login_model');
    }
	
	public function index()
	{

	    $data = array(
			'firstname' => $this->input->post('first_name'),
			'lastname' => $this->input->post('last_name'),
			'email' => $this->input->post('email_add'),
			'password' => $this->input->post('password'),
			'created_date'=> date('y-m-d'),
			'role_type' => '5',
			'status' =>1
			);

		$content = "Succesfully registered!"; //String is set in a variable
	    $email =  $data['email'];  //used for sending the email to the user on registration
	    $pwd = $data['password'];  //login credetianls to the user on registration
	    $name = $data['firstname'];  
		
		if(!empty($data)){
		    $this->form_validation->set_rules('first_name', 'Firstname', 'trim|required');
		    $this->form_validation->set_rules('last_name', 'Lastname', 'trim|required');
		    $this->form_validation->set_rules('email_add', 'Email', 'trim|required|is_unique[users.email]');
		    $this->form_validation->set_rules('password', 'Password', 'trim|required');
		    $this->form_validation->set_rules('conf_pwd', 'Password', 'trim|required|matches[password]');

			if ($this->form_validation->run() == TRUE) 
			{
			$this->User_login_model->registration($data);

	   		$message = 'Hello ' . $name . ',<br><br>' . 'Login email - ' . $email .'<br><br>' . 'Login password  -'. $pwd .'<br><br>' .$content;  // string helper is required.

		   	$config = Array(
                                'protocol' => 'smtp',
                                'smtp_host' => 'smtp.wwindia.com',
                                'smtp_port' => 25,
                                'smtp_user' => 'rashmi.nalwaya@wwindia.com', 
                                'smtp_pass' => 'RashmI123', 
                                'mailtype' => 'html',
                                'charset' => 'utf-8',
                                'wordwrap' => TRUE,
                                'newline' =>'\r\n'
                            );

            $this->email->initialize($config);
            $this->load->library('email', $config);
            $this->email->from('franklinfargoj1991@gmail.com');
            $this->email->to($email);  // Query details is sent on the email of the user 
            $this->email->subject('Shopping cart registration');
            $this->email->message($message);
            $this->email->send();

			$this->session->set_flashdata('success','User registaration successfull !');

			$message_to_admin = 'Hello Administrator, ' . '<br><br>' . 'User email - ' . $email . '<br><br>' .$content;  // string helper is required.
		   	$config = Array(
                                'protocol' => 'smtp',
                                'smtp_host' => 'smtp.wwindia.com',
                                'smtp_port' => 25,
                                'smtp_user' => 'rashmi.nalwaya@wwindia.com', 
                                'smtp_pass' => 'RashmI123', 
                                'mailtype' => 'html',
                                'charset' => 'utf-8',
                                'wordwrap' => TRUE,
                                'newline' =>'\r\n'
                            );
             $this->email->initialize($config);
             $this->load->library('email', $config);
             $this->email->from('franklinfargoj1991@gmail.com');
             $this->email->to('franklinfargoj1991@gmail.com');  // Mail to admin
             $this->email->subject('New customer registered!');
             $this->email->message($message_to_admin);
             $this->email->send();

             redirect('UserLogin');
			}
			//$this->load->view('frontend/header');
			$this->load->view('frontend/login_header'); 
			$this->load->view('frontend/user_login'); 	
			$this->load->view('frontend/footer');
		}
	}

	public function login()
	{
			$data = array(
			'email' => $this->input->post('login_email'),
			'password' => md5($this->input->post('login_password')),
			);

			if(!empty($data))
			{
/*	echo"hello login";
	die();*/

		    $this->form_validation->set_rules('login_email', 'Email', 'required');
		    $this->form_validation->set_rules('login_password', 'Password', 'required');
		    	if($this->form_validation->run() == TRUE )
		    	{
		    		$email = $this->input->post('login_email');
					$password = md5($this->input->post('login_password'));
					$result = $this->User_login_model->login($email,$password);

						if(!empty($result))
						{
							$role = $result[0]['role_type'];
							if ($role == 5) 
							{
					        $this->session->set_userdata('user_login',$result);
					        
					        print_r($this->session->userdata('user_login'));
					        exit();

                            redirect('Shop');
							}    							  
						}
						else
						{
							$this->session->set_flashdata('fail','Please provide correct email and password.');
							redirect('UserLogin');
						}
				}
				$this->session->set_flashdata('fail','Please provide correct email and password.');
				redirect('UserLogin');
			}	
	}




	public function facebookLogin()
	{
       $name = $this->input->post('name');
       $email = $this->input->post('email');
       $id = $this->input->post('id');

       $result = $this->User_login_model->fb_login($email);



       if(!empty($result)){
	       	$this->session->set_userdata('user_login',$result);
	       	redirect('Shop');      	
       }else{
			$name1 =  (explode(" ",$name));		
			$first_name = $name1[0];
			$last_name =$name1[1];

			$data = array(
			'firstname' => $this->input->post('first_name'),
			'lastname' => $this->input->post('last_name'),
			'email' => $this->input->post('email_add'),
			'password' => $this->input->post('password')
			);



			 $this->session->set_userdata('user_login',$data);



			$this->User_login_model->registration_through_fb($first_name,$last_name,$email,$id);
			redirect('Shop');
       }
	}

/*
	public function gmailLogin()
	{

       	if(!empty($result)){
	       	$this->session->set_userdata('user_login',$result);    
	       	redirect('Shop');     
       	}else{

			$name2 =  (explode(" ",$name));
			$first_name = $name2[0];
			$last_name = $name2[1];

			$data = array(
			'firstname' => $this->input->post('first_name'),
			'lastname' => $this->input->post('last_name'),
			'email' => $this->input->post('email_add'),
			'password' => md5($this->input->post('password')),
			'role_type' => '5'
			);

			$this->User_login_model->registration_through_gmail($first_name,$last_name,$email,$id);
			redirect('Shop');
       }
	}*/


	public function logout()
	{
		$this->session->unset_userdata('user_login');
		$this->session->unset_userdata('cart');
		$this->session->unset_userdata('my_acc');  //set in My_account controller
		$this->session->unset_userdata('coupon_id');
		$this->session->unset_userdata('discount');
		$this->session->unset_userdata('gmail_data');

		$this->session->sess_destroy();
		redirect('UserLogin');
	}

}
