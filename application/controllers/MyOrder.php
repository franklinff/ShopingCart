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


    public function index(){

        if ($this->uri->segment(5)) {
            $page = ($this->uri->segment(5));
        } else {
            $page = 1;
        }

        $login_info = $this->session->userdata('user_login');
        $user_id = $login_info[0]['id'];       
        $data['order_count'] = $this->My_orders_model->getOrders(true,'', '',$user_id);

        $config['page_query_string'] = TRUE;
        $config['per_page'] = 3;
        $config['base_url'] = base_url() . 'MyOrder/index/page/';
        $config['total_rows'] = $data['order_count'][0]['order_count'];
        $config['uri_segment'] = 5;
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';
        
        $this->pagination->initialize($config);  

        $data['orders'] = $this->My_orders_model->getOrders(false,$config['per_page'], $page,$user_id);

     /* echo"<pre>";
        print_r($data['orders']);
        die();*/
        $this->load->view('frontend/header.php');
        $this->load->view('frontend/my_order_view', $data);
        $this->load->view('frontend/footer');
    }



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

