<?php defined('BASEPATH') OR exit('No direct script access allowed');

class UserAuthentication extends CI_Controller
{
    function __construct() {
        parent::__construct();

        // Load facebook library
        $this->load->library('facebook');

        //Load user model
        $this->load->model('User');
    }

    public function index(){
        $userData = array();

        // Check if user is logged in
        if($this->facebook->is_authenticated()){
            // Get user facebook profile details
            $userProfile = $this->facebook->request('get', '/me?fields=id,firstname,lastname,email,gender,locale');

            // Preparing data for database insertion
            $userData['oauth_provider'] = 'facebook';
            $userData['oauth_uid'] = $userProfile['id'];

            $userData['first_name'] = $userProfile['firstname'];
            $userData['last_name'] = $userProfile['lastname'];
            $userData['email'] = $userProfile['email'];
            $userData['gender'] = $userProfile['gender'];
           // $userData['locale'] = $userProfile['locale'];

            echo"hiii";
            die();




            // Insert or update user data
            $userID = $this->User->checkUser($userData);

            // Check user data insert or update status
            if(!empty($userID)){
                $data['userData'] = $userData;
                $this->session->set_userdata('userData',$userData);
            }else{
               $data['userData'] = array();
            }

            // Get logout URL
            $data['logoutUrl'] = $this->facebook->logout_url();
        }else{
            $fbuser = '';

            // Get login URL
            $data['authUrl'] =  $this->facebook->login_url();
        }

        // Load login & profile view
        //$this->load->view('user_authentication/index',$data);
       // redirect('Shop');
        redirect('MyAccount');
    }

    public function logout() {
        // Remove local Facebook session
        $this->facebook->destroy_session();

        // Remove user data from session
        $this->session->unset_userdata('userData');

        // Redirect to login page
        redirect('UserLogin'); // redirect('/user_authentication');
      }
}


