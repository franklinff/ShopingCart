<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login controller class
 */
class Login extends CI_Controller{    

        public function __construct(){        
        parent::__construct();
        //$this->load->helper('url');//$this->load->library('form_validation');//$this->load->library('session');       
        $this->load->model('Login_model');
        $this->load->model('User_model');
        }

        /*
         * function name :__construct
         * Counstructor for Admin_login controller 
         * @access	public
         * @return : void
         */
        public function index()
        { 
            $this->form_validation->set_rules('email', 'Email', 'trim|required');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');
         
                if($this->form_validation->run() == FALSE) {
                $this->load->view('backend/login');
                } else {  

                        $email= $this->input->post('email');
                        $password= $this->input->post('password');
                        $result = $this->Login_model->login($email,$password);                                 
       
                        if(!empty($result)){

                             $role = $result->role_type;

                             if ($role == 2) {
                             $newdata = array(
                                'id' => $result->id,
                                'firstname' => $result->firstname,
                                'lastname' => $result->lastname,
                                'email' => $result->email,
                                'role_type' => 2
                             );   

                            $this->session->set_userdata('admin_login',$newdata);
                            redirect('User');
                            } 
                        }
                        else {
                          $this->session->set_flashdata('error','Email id/password/ is invalid.');
                          $this->load->view('backend/login');
                        }
                    }
        }

        public function logout() {
        $this->session->sess_destroy();
        redirect('Login');        
        }

}
?>