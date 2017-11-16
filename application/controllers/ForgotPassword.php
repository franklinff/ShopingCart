<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ForgotPassword extends CI_Controller
{   

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Forgot_password_model');
        //$this->load->library('email'); // $this->load->library('session');   
    } 

    /*
     * index
     * Forgot password view
     * @access public
     * @return null
     */
    public function index()
    {
        $email = $this->input->post('email');

        $this->form_validation->set_rules('email', 'Email ID', 'required|valid_email');

            if ($this->form_validation->run() == TRUE) 
            {                    
             $result = $this->Forgot_password_model->search_email($email);
                 if(!empty($result))
                 {
                    $config = Array(
                                  'protocol' => 'smtp',
                                  'smtp_host' => 'smtp.wwindia.com',
                                  'smtp_port' => 25,
                                  'smtp_user' => 'rashmi.nalwaya@wwindia.com', // change it to yours
                                  'smtp_pass' => 'RashmI123', // change it to yours
                                  'mailtype' => 'html',
                                  'charset' => 'utf-8',
                                  'wordwrap' => TRUE,
                                  'newline' =>'\r\n'
                                );

                          $this->email->initialize($config);
                          $this->load->library('email', $config);
                          $this->email->from('franklinfargoj1991@gmail.com');
                          $this->email->to($email);  // change it to yours 
                          $this->email->subject('Forgot password test mail');
                          $this->email->message('Testing the email class.');
                                                  
                          if($this->email->send()) {
                              $this->session->set_flashdata('new_password_success', 'We have sent new password to registered email address!!.');  
                            } else {
                              print_r($this->email->print_debugger());  
                            }
                }
                else
                {
                  redirect('UserLogin');
                }

            redirect('UserLogin');        
          }
        $this->load->view('frontend/header.php');
        $this->load->view('frontend/forgot_pwd.php');
        $this->load->view('frontend/footer.php');
    }

}
