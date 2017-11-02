<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MyAccount extends CI_Controller
{   
    public function __construct()
    {
        parent::__construct();
        $this->load->model('My_account_model');
    } 

    public function index()
	{
					        print_r($this->session->userdata('user_login'));
					        exit();



		if(!empty($this->session->userdata('user_login')) || !empty($this->session->userdata('gmail_data')) )
		{
			$user_data = $this->session->userdata('user_login');
			$user_id = $user_data[0]['id'];

			$data['user']= $this->My_account_model->user_information($user_id);

			//$data['gmail'] = $this->session->userdata('gmail_data');

			$this->load->view('frontend/header');
			$this->load->view('frontend/my_account',$data); 
			$this->load->view('frontend/footer');
		}
		else 
		{
		 	redirect('UserLogin');	
		}
	}


	public function update()
	{
		$user_data = $this->session->userdata('user_login');
		$user_id = $user_data[0]['id'];

		$new_data= array(
                'firstname' => $this->input->post('firstname'),
                'lastname' => $this->input->post('lastname'),
                );

		if($new_data){
			$this->form_validation->set_rules('firstname', 'Firstname', 'required|min_length[2]|max_length[15]');
			$this->form_validation->set_rules('lastname', 'Lastname', 'required|min_length[2]|max_length[15]');

			if ($this->form_validation->run() == TRUE)
                  {
                  	 $result = $this->My_account_model->update($new_data,$user_id);
                  	 $this->session->set_userdata('my_acc',$result);
                  	 redirect("Shop");
                  }
                 // $this->session->unset_userdata($user_data);
		}
 		redirect("MyAccount");
	}


}