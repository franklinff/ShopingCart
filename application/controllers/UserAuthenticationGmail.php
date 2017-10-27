<?php defined('BASEPATH') OR exit('No direct script access allowed');

class UserAuthenticationGmail extends CI_Controller
{
    function __construct() {
		parent::__construct();
		// Load user model
		$this->load->model('User_gmail');
        $this->load->model('User_login_model');

    }
    
    public function index(){

		// Include the google api php libraries
		include_once APPPATH."libraries/google-api-php-client/Google_Client.php";
		include_once APPPATH."libraries/google-api-php-client/contrib/Google_Oauth2Service.php";

		// Google Project API Credentials
		$clientId = '439039940405-074bbibdr5ddvbgk9cr96tj2i88hd3bc.apps.googleusercontent.com';
        $clientSecret = 'Xixn9mG9uzSXXjKPq-z4j6e9';
        $redirectUrl ='https://murmuring-wave-89756.herokuapp.com/UserAuthenticationGmail/index';

		// Google Client Configuration
        $gClient = new Google_Client();
        //$gClient->setApplicationName('Login to codexworld.com');
        $gClient->setClientId($clientId);
        $gClient->setClientSecret($clientSecret);
        $gClient->setRedirectUri($redirectUrl);
        $google_oauthV2 = new Google_Oauth2Service($gClient);

        if (isset($_REQUEST['code'])) {
            $gClient->authenticate();
            $this->session->set_userdata('token', $gClient->getAccessToken());         
        }

        $token = $this->session->userdata('token');

        if (!empty($token)) {
            $gClient->setAccessToken($token);
        }

        if ($gClient->getAccessToken()) {
            $userProfile = $google_oauthV2->userinfo->get();

			$userData['google_token'] = $userProfile['id'];
            $userData['firstname'] = $userProfile['given_name'];
            $userData['lastname'] = $userProfile['family_name'];
            $userData['email'] = $userProfile['email'];
            $userData['role_type'] = 5;
            $userData['status'] = 1;
            $userData['registration_method'] = 'G';
/*
            $x['email'] =  $userData['email'];
            $x['firstname'] =  $userData['firstname'];
            $x['lastname'] =  $userData['lastname'];
            $data['gmail_data'] = $x;
            $this->session->set_userdata('gmail_data',$data);
            echo"<pre>";
            print_r($this->session->userdata('gmail_data'));
            echo"<pre>";
            print_r($data['gmail_data']);*/
            //die();
            $data['userData'] = $userData;
            $this->session->set_userdata('userData',$userData);

			// Insert or update user data
            $userID = $this->User_gmail->checkUser($userData);

            if(!empty($userID)){
                 $data['userData'] = $userData;

                $this->session->set_userdata('userData',$userData);
                
                //redirect('homepagecontroller/test/'.$userID,'refresh');
                redirect('UserAuthenticationGmail/gmailTrial/'.$userID);
            } else {
               $data['userData'] = array();
            }
        } else {
            $data['authUrl'] = $gClient->createAuthUrl();
        }
		$this->load->view('frontend/index_gmail',$data);

    }
	
    public function gmailTrial($user_id)
    {
        $result = $this->User_login_model->getId($user_id);

            $x['email'] =  $result[0]['email'];
            $x['firstname'] =  $result[0]['firstname'];
            $x['lastname'] =  $result[0]['lastname'];

            $data['gmail_data'] = $x;
            $this->session->set_userdata('gmail_data',$data);

        if(!empty($result))
        {
            redirect('Shop');
        }
        else
        {
            redirect('UserLogin');
        }

    }

	public function logout() {
		$this->session->unset_userdata('token');
		$this->session->unset_userdata('userData');
        $this->session->unset_userdata('gmail_data');
        $this->session->sess_destroy();
		redirect('UserAuthenticationGmail');
    }

}


