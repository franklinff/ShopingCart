<?php
class PaymentComplete extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Checkout_model');
        //$this->load->model('cart_model', 'cart');
        //$this->load->model('user_addres_model', 'user_address');
        $this->load->model('My_orders_model');

        if (empty($this->session->userdata('user_login')) && empty($this->session->userdata('gmail_data'))) {
            redirect(base_url().'UserLogin');
        }
    }


    /*
     * function name :index
     * Get order details when used paypal.
     * @access	public
     * @param : $order_id
     * @return : view file
     */
    public function index($order_id) {
        $data['order_details'] = $this->My_orders_model->getOrderDetails($order_id);

        $data['billing_address'] = $this->My_orders_model->getOrderAddress($order_id, true);
        $data['shipping_address'] = $this->My_orders_model->getOrderAddress($order_id, false);

        $data['billing_address'] = $data['billing_address'][0];
        $data['shipping_address'] = $data['shipping_address'][0];
        $data['order_id'] = $order_id;
        $data['sub_total'] = array();

        foreach ($data['order_details'] as $value) {
            $data['sub_total'][] = $value['amount'];
        }
        $data['sub_total'] = array_sum($data['sub_total']);

        if (!empty($data['billing_address']['coupon_id'])) {
            $percent_off = $this->My_orders_model->getCouponDetails($data['billing_address']['coupon_id']);
            $percent_off = $percent_off[0]['percent_off'];
            $percent = $percent_off / 100;
            $discount = $percent * $data['sub_total'];
            $data['discount'] = $discount;
        }

        if (empty($data['billing_address']['coupon_id'])) {

            if ($data['sub_total'] < 500) {
                $data['grand_total'] = $data['sub_total'] + 50;
                $data['shipping_charges'] = '&#8377;50';
            } else {
                $data['grand_total'] = $data['sub_total'];
                $data['shipping_charges'] = 'FREE';
            }
        } else {
            $data['discount_price'] = $data['discount'];
            if ($data['sub_total'] < 500) {
                $data['grand_total'] = $data['sub_total'] + 50;
                $data['shipping_charges'] = '&#8377;50';
            } else {
                $data['grand_total'] = $data['sub_total'] - $data['discount_price'];
                $data['shipping_charges'] = 'FREE';
            }
        }



        $this->load->view('frontend/header');
        $this->load->view('frontend/payment_complete', $data);        
        $this->load->view('frontend/footer');
    }


    /*
     * function name :cod_succes
     * Get order details when used cod.
     * @access	public
     * @param : $order_id
     * @return : view file
     */
    public function codSucces($order_id) {

        $data['order_details'] = $this->My_orders_model->getOrderDetails($order_id);
        $data['billing_address'] = $this->My_orders_model->getOrderAddress($order_id, true);
        $data['shipping_address'] = $this->My_orders_model->getOrderAddress($order_id, false);

        $x = $data['billing_address'][0]['coupon_id'];

        $data['order_id'] = $order_id;
        $data['sub_total'] = array();

        foreach ($data['order_details'] as $value) {
            $data['sub_total'][] = $value['amount'];
        }
        $data['sub_total'] = array_sum($data['sub_total']);

        if (!empty($x)) {
            $percent_off = $this->My_orders_model->getCouponDetails($x);

            $coupon_used = array();

            $login_info = $this->session->user_login;
            $coupon_used['user_id'] = $login_info[0]['id'];
            $coupon_used['coupon_id'] = $x;
            $coupon_used['order_id'] = $data['order_details'][0]['order_id'];
           
            $coupon_used_insert = $this->Checkout_model->insert_coupon_used($coupon_used);

            $percent_off = $percent_off[0]['percent_off'];
            $percent = $percent_off / 100;
            $discount = $percent * $data['sub_total'];
            $data['discount'] = $discount;
        }

        if (empty($x)) {
            if ($data['sub_total'] < 500) {
                $data['grand_total'] = $data['sub_total'] + 50 - $data['discount_price'];
                $data['shipping_charges'] = '&#8377;50';
            } else {
                $data['grand_total'] = $data['sub_total'];
                $data['shipping_charges'] = 'FREE';
            }
        } else {
            $data['discount_price'] = $data['discount'];
            if ($data['sub_total'] < 500) {
                $data['grand_total'] = $data['sub_total'] + 50 - $data['discount_price'];
                $data['shipping_charges'] = '&#8377;50';
            } else {
                $data['grand_total'] = $data['sub_total'] - $data['discount_price'];
                $data['shipping_charges'] = 'FREE';
            }
        }   

        echo"<pre>";
        echo"hello";
        print_r($data);
        die();


        $this->load->view('frontend/header');
        $this->load->view('frontend/payment_success', $data);
        $this->load->view('frontend/footer');
    }

}