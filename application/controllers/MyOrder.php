<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MyOrder extends CI_Controller
{   
    public function __construct()
    {
        parent::__construct();
        $this->load->model('My_orders_model');
        $this->load->model('Cart_model');
        $this->load->model('User_addres_model');
        $this->load->model('My_orders_model');
        $this->load->library('pagination');

        if(empty($this->session->userdata('user_login')) && empty($this->session->userdata('gmail_data'))){
        	redirect('UserLogin');
        }
    } 

    /*
     * function name :index
     * User order list
     * @access  public
     * @param : null
     * @return : view file
     */
    public function index(){

        $login_info = $this->session->userdata('user_login');
        $user_id = $login_info[0]['id']; 

        $data['order_count'] = $this->My_orders_model->getOrders(true,'', '',$user_id);
        $config['total_rows'] = $data['order_count'][0]['order_count'];
        $config['per_pagev'] = 6;   
        $config['page_query_string'] = TRUE;
        $config['num_links'] = $data['order_count'][0]['order_count'];
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';
        $config['base_url'] = base_url() . 'MyOrder/index/page/';
        $this->pagination->initialize($config);

        if ($this->input->get('per_page')) {
            $page = ($this->input->get('per_page'));
        } else {
            $page = 0;
        }

        $data['orders'] = $this->My_orders_model->getOrders(false,$config['per_pagev'],$page,$user_id);

        $this->load->view('frontend/header.php');
        $this->load->view('frontend/my_order_view', $data);
        $this->load->view('frontend/footer');
    }


    /*
     * function name :orderDetails
     * Get order details.
     * @access  public
     * @param : $order_id
     * @return : view file
     */
     public function orderDetails($order_id) {

        $data['order_details'] = $this->My_orders_model->getOrderDetails($order_id);
        $data['billing_address'] = $this->My_orders_model->getOrderAddress($order_id,true);
        $data['shipping_address'] = $this->My_orders_model->getOrderAddress($order_id,false);
        $data['billing_address'] = $data['billing_address'][0];
        $data['shipping_address'] = $data['shipping_address'][0];
        $data['sub_total'] = array();

        foreach ($data['order_details'] as $value) {
            $data['sub_total'][] = $value['amount'];
        }

        $data['sub_total'] = array_sum($data['sub_total']);
        if(!empty($data['billing_address']['coupon_id'])){
            $percent_off = $this->My_orders_model->getCouponDetails($data['billing_address']['coupon_id']);
            $percent_off = $percent_off[0]['percent_off'];
            $percent = $percent_off / 100;
            $discount = $percent * $data['sub_total'];
            $data['discount'] = $discount;
        }
        //echo '<pre>';print_r($data);echo '<br>';
        if (empty($data['billing_address']['coupon_id'])) {
            
            if ($data['sub_total'] < 500) {
                $data['grand_total'] = $data['sub_total'] + 50;
                $data['shipping_charges'] = '&#8377;50';
            } else {
                $data['grand_total'] = $data['sub_total'];
                $data['shipping_charges'] = 'FREE';
            }
        }else{
            $data['discount_price'] = $data['discount'];
            if ($data['sub_total'] < 500) {
                $data['grand_total'] = $data['sub_total'] + 50;
                $data['shipping_charges'] = '&#8377;50';
            } else {
                $data['grand_total'] = $data['sub_total'] - $data['discount_price'];
                $data['shipping_charges'] = 'FREE';
            }
        }

        $data['order_id'] = $order_id;

        $this->load->view('frontend/header.php');
        $this->load->view('frontend/order_details', $data);
        $this->load->view('frontend/footer');
    }

}

