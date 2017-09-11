<?php

class Track_order extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Track_order_model');

        if(empty($this->session->userdata('user_login'))){
            redirect('User_login');
        }
    }

    
    /*
     * index
     * Display a view page.
     * @access public
     * @param null
     * @return view file
     */
    public function index() {
        $this->load->view('frontend/header.php');
        $this->load->view('frontend/track_order');
        $this->load->view('frontend/footer');
    }


    /*
     * track_order_details
     * Display order status.
     * @access public
     * @param $order_id
     * @return view file
     */
    public function track_order_details() {

        $login_info = $this->session->userdata('user_login');

        $user_id = $login_info[0]['id'];
        $order_id = $this->input->post();
        
        $email = $login_info[0]['email'];
        $firstname = $login_info[0]['firstname'];
        $lastname = $login_info[0]['lastname'];

        $data = $this->Track_order_model->getOrderDetailsById($order_id['order_id'], $user_id);

        if (!empty($data)) {
            $data = $data[0];
            $data['firstname'] = $firstname;
            $data['lastname'] = $lastname;
            
            if ($data['status'] == 'P') {
                $data['status'] = 'Pending';
            }
            if ($data['status'] == 'O') {
                $data['status'] = 'Processing';
            }
            if ($data['status'] == 'S') {
                $data['status'] = 'Shipped';
            }
            if ($data['status'] == 'D') {
                $data['status'] = 'Delivered';
            }
            $data['order_id'] = $order_id['order_id'];
       
            $this->load->view('frontend/header');
            $this->load->view('frontend/track_order_details', $data);
            $this->load->view('frontend/footer');
        }else{
            $this->session->set_flashdata('error','Enter a valid order id!');
            redirect('Track_order');
        }
    }

}