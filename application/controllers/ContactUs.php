<?php

class ContactUs extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Contact_us_model'); 
        $this->load->library('parser');//$this->load->library('email');
    }

    /*
     * index
     * Displays contact us form. 
     * @access public
     * @param null
     * @return view file
     */
    public function index() {
        $this->load->view('frontend/header');
        $this->load->view('frontend/contact-us');
        $this->load->view('frontend/footer');
    }


    public function add() {

        $postData = $this->input->post();  //data from the form on post of the user
        /*echo"<pre>"; print_r($postData);die();*/
       
        $login_info = $this->session->userdata('user_login');
        $postData['created_by'] = $login_info[0]['role_type'];//Role type is customer if registered user else null is set

        $postData['created_date'] = date('Y-m-d h:i:s');  

        if ($postData) {
            $result = $this->Contact_us_model->insert($postData);  //inserts the data in contact us table

            $contact_us_template = $this->parser->parse('frontend/contact_us_template', $postData);  //its a file format the user will be able to view on the mail

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
             $this->email->to('franklin.fargoj@neosofttech.com');  // Query details is sent to the admin email.
             $this->email->subject('Customer query[contatc us]');
             $this->email->message($contact_us_template);
             $this->email->send();

            $this->session->set_flashdata('error_msg', 'Query submitted. Rest assured!');

            redirect('Contact_us');
        }
    }

}