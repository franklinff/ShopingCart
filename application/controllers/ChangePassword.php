<?php
class ChangePassword extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Change_password_model');

        $session_data = $this->session->userdata('user_login');

        if(empty($session_data)){
             redirect(base_url() . 'User_login');
       }
    }
    
    /*
     * index
     * Display a view file.
     * @access public
     * @param null
     * @return view file
     */
    public function index() {
        $this->load->view('frontend/header.php');
        $this->load->view('frontend/change_password');
        $this->load->view('frontend/footer');    
    }
    
    /*
     * update_password
     * Update password.
     * @access public
     * @param null
     * @return null
     */
    public function updatePassword() {
        $data = $this->input->post();

        $login_info = $this->session->userdata('user_login');
        $user_id = $login_info[0]['id'];
        $email = $login_info[0]['email'];

        $result = $this->Change_password_model->check_password($user_id);

        $data['user_id'] = $user_id;
        $data['email'] = $email;

        if(!empty($result)){
            if($result[0]['password']== $data['password']){
                $result1 = $this->Change_password_model->update($data);
                $this->session->set_flashdata('updated_password', 'Password updated successfully!');
                redirect('MyAccount');
            }else{
                $this->session->set_flashdata('error_msg', 'Enter correct old password!');
                redirect('ChangePassword');
            }
            
        }else{
            $this->session->set_flashdata('error_msg', 'Enter correct old password!');
            redirect('ChangePassword');
        }
    } 
}