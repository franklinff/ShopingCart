<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mailchimp extends CI_Controller
{   

    public function __construct()
    {
        parent::__construct();
        $this->load->library('MailChimp');
        $this->load->model('Mailchimp_model');
    }

    public function index()
    {
	$this->load->view('frontend/header.php');
	$this->load->view('frontend/user_login.php');
	$this->load->view('frontend/footer.php');
    }

    public function insertNewsLetter()
    {
        $email = $this->input->post('email_id');

        $x = $this->Mailchimp_model->verify_if_registered($email);
        $user_email = $x[0]['email'];

        	if($user_email === $email)
        	{    		 
				$this->session->set_flashdata('error_X','Email address already registered');
				redirect('UserLogin');
        	}
        	else
        	{
        		$fname = 'Franklin';//$_POST['fname'];
           		$lname = 'Fargoj';//$_POST['lname'];

        		if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL) === false) {

        			$apiKey = '9abd45585f7d661a122c6bcb403afb97-us16';
                    $listID = '00f6eb47dc';
                    $memberID = md5(strtolower($email));
                    $dataCenter = substr($apiKey, strpos($apiKey, '-') + 1);
                    $url = 'https://' . $dataCenter . '.api.mailchimp.com/3.0/lists/' . $listID . '/members/' . $memberID;

                    // member information
                    $json = json_encode([
                        'email_address' => $email,
                        'status' => 'subscribed',
                    ]);

                    // send a HTTP POST request with curl
                    $ch = curl_init($url);
                    curl_setopt($ch, CURLOPT_USERPWD, 'user:' . $apiKey);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
                    $result = curl_exec($ch);
                    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                    curl_close($ch);

                    // store the status message based on response code
                    if ($httpCode == 200) {
                        $this->Mailchimp_model->insert_user_mail($email);
                        $this->session->set_flashdata('mailchimp_msg', '<p style="color: #34A853">You have successfully subscribed to Eshopper.</p>');
                    } else {
                        switch ($httpCode) {
                            case 214:
                                $msg = 'You are already subscribed.';
                                break;
                            default:
                                $msg = 'Some problem occurred, please try again.';
                                break;
                        }
                        $this->session->set_flashdata('mailchimp_msg', '<p style="color: #EA4335">' . $msg . '</p>');
                        //$_SESSION['msg'] = '<p style="color: #EA4335">' . $msg . '</p>';
                    }
        		$this->session->set_flashdata('success_X','Email address registered');
        	}else {
                   $this->session->set_flashdata('mailchimp_error_msg', '<p style="color: #EA4335">Please enter valid email address.</p>');
                }
            redirect('Shop');
    		}
		} 


}

//9abd45585f7d661a122c6bcb403afb97-us16
//00f6eb47dc




