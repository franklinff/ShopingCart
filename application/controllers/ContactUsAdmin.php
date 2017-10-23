<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ContactUsAdmin extends CI_Controller
{   
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Contact_admin_model');    
        $this->load->library('parser');        
        //$this->load->helper('string');//$this->load->helper(array('form', 'url'));//$this->load->library('email');
        if (!$this->session->userdata('admin_login')) {
            redirect('Login');
        }
    }

    public function index()
    {
        $data['result'] = $this->Contact_admin_model->user_query();   
        $this->load->view('backend/header.php');
		$this->load->view('backend/sidebar.php');
        $this->load->view("backend/user_query.php", $data);
        $this->load->view('backend/footer.php');
    }

    public function replyToQuery($id)
    {   
        $data['id'] = $id;
        $data['result'] = $this->Contact_admin_model->user_email_as_per_id($id); 
        $email = $data['result'][0]['email'];
        $id = $data['result'][0]['id'];

        $this->load->view('backend/header.php');
        $this->load->view('backend/sidebar.php');
        $this->load->view("backend/query_resolution.php",$data);
        $this->load->view('backend/footer.php');
    }

    public function dataSubmit()
    {
       $id = $this->input->post('reply_id');
       $content =  $this->input->post('name');

       $this->Contact_admin_model->resolution($content,$id);//inserts the resolution given by admin in db-Contact us table.

       $data['result'] = $this->Contact_admin_model->user_email_as_per_id($id); 

       $email = $data['result'][0]['email'];
       $name = $data['result'][0]['name'];
       $customer_query = $data['result'][0]['message'];

       $mesg = 'Hello ' . $name . ',<br><br>' . $customer_query . '<br><br>' . ' Answer:' .$content;  // string helper is required.

       if($this->input->server('REQUEST_METHOD') == 'POST'){

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
             $this->email->to($email);  //Customer resolution is sent on the email of the customer 
             $this->email->subject('Query resolution');
             $this->email->message($mesg);
             $this->email->send();
             redirect("Contact_us_admin");
        }
    }

}

