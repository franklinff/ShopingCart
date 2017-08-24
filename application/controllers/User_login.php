<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_login extends CI_Controller
{   
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_login_model');
        //$this->load->helper(array('form', 'url'));
        $this->load->library('email');
        $this->load->helper('string');
    }
	
	public function index()
	{
	    $data = array(
			'firstname' => $this->input->post('first_name'),
			'lastname' => $this->input->post('last_name'),
			'email' => $this->input->post('email_add'),
			'password' => $this->input->post('password'),
			'role_type' => '5'
			);

		$content = "Succesfully registered!";
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
             //$this->email->to($email);  // Query details is sent on the email of the user 

             $this->email->to($email);  // Query details is sent on the email of the user 
             $this->email->to('franklinfargoj1991@gmail.com');  // Admin email address

             $this->email->subject('Shopping cart registration');
             $this->email->message($message);
             $this->email->send();

				$this->session->set_flashdata('success','User registaration successfull !');
		        redirect('index.php/user_login');
			}
			$this->load->view('frontend/header');
			$this->load->view('frontend/user_login'); 
			//$this->load->view('frontend/change_password'); 
			$this->load->view('frontend/footer');
		}
	}

	public function login()
	{
			$data = array(
			'email' => $this->input->post('login_email'),
			'password' => $this->input->post('login_password'),
			);

			if(!empty($data))
			{
		    $this->form_validation->set_rules('login_email', 'Email', 'required');
		    $this->form_validation->set_rules('login_password', 'Password', 'required');

		    	if($this->form_validation->run() == TRUE )
		    	{
		    		$email = $this->input->post('login_email');
					$password = $this->input->post('login_password');
					$result = $this->User_login_model->login($email,$password);

						if(!empty($result))
						{
							$role = $result[0]['role_type'];
							if ($role == 5) 
							{
					        $this->session->set_userdata('user_login',$result);
                            redirect('index.php/Shop');
							}    							  
						}
						else
						{
							$this->session->set_flashdata('fail','Please provide correct email and password.');
							redirect('index.php/user_login');
						}
				}
				$this->session->set_flashdata('fail','Please provide correct email and password.');
				redirect('index.php/user_login');
			}	
	}


	public function facebook_login()
	{
       $name = $this->input->post('name');
       $email = $this->input->post('email');
       $id = $this->input->post('id');
       $result = $this->User_login_model->fb_login($email);

       if(!empty($result)){
	       	$this->session->set_userdata('user_login',$result);
	       	redirect('index.php/Shop');
	       	
       }else{
			$name1 =  (explode(" ",$name));			
			$first_name = $name1[0];
			$last_name =$name1[1];

			$data = array(
			'firstname' => $this->input->post('first_name'),
			'lastname' => $this->input->post('last_name'),
			'email' => $this->input->post('email_add'),
			'password' => $this->input->post('password'),
			'role_type' => '5'
			);
/*			print_r($data);
			die();*/

			$this->User_login_model->registration_through_fb($first_name,$last_name,$email,$id);
			redirect('index.php/Shop');
       }
	}

	public function gmail_login()
	{
	   $name = $this->input->post('name');
       $email = $this->input->post('email');
       $id = $this->input->post('id');
       $result = $this->User_login_model->gmail_login($email);

       if(!empty($result)){
	       	$this->session->set_userdata('user_login',$result);    
	       	redirect('index.php/Shop');     
       }else{
			$name2 =  (explode(" ",$name));
			$first_name = $name2[0];
			$last_name =$name2[1];

			$data = array(
			'firstname' => $this->input->post('first_name'),
			'lastname' => $this->input->post('last_name'),
			'email' => $this->input->post('email_add'),
			'password' => $this->input->post('password'),
			'role_type' => '5'
			);

			$this->User_login_model->registration_through_gmail($first_name,$last_name,$email,$id);
			redirect('index.php/Shop');
       }
	}


	public function logout()
	{
		$this->session->unset_userdata('user_login');
		$this->session->unset_userdata('cart');
		$this->session->unset_userdata('my_acc');  //set in My_account controller
		$this->session->unset_userdata('coupon_id');
		$this->session->unset_userdata('discount');
		redirect('index.php/User_login');
	}

}
