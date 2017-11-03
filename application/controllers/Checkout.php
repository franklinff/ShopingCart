<?php
/*
 * Checkout
 * @package    CI
 * @subpackage Controller
 * @author     Franklin Fargoj
 */
class Checkout extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Checkout_model');
        $this->load->model('Cart_model');
        $this->load->model('User_addres_model');
        $this->load->model('My_orders_model');
        $this->load->library('parser');//$this->load->library('email');
      
        $session_data = $this->session->userdata('user_login');  

        if (!empty($session_data) || !empty($this->session->userdata('gmail_data'))) {
            $last_page_visited = 'checkout';
            $this->session->set_userdata('last_page_visited', $last_page_visited);
        }else{
            $last_page_visited = 'checkout';
            $this->session->set_userdata('last_page_visited', $last_page_visited);
            redirect(base_url() . 'UserLogin');
        }
    }

    /* 
     * Display cart products.
     * @access public
     * @param null
     * @return view file
     */
    public function index() {
        $data = '';
        $product_details = $this->session->userdata('cart');
        //echo'<pre>';print_r($this->session->userdata());exit;
        $total = $this->session->userdata('checkout');
        $grand_total = $this->session->userdata('grand_total');
        
        if ($product_details) {
            $product_id = array_keys($product_details);
            $product_quantity = array();
            $data['cart_products'] = $this->Cart_model->getAddedProducts($product_id);
            $i = 0;

            foreach ($data['cart_products'] as $cart_prod) {
                foreach ($product_details as $key => $quantity) {
                    if ($key == $cart_prod['id']) {
                        $data['cart_products'][$i]['quantity'] = $quantity['quantity'];
                    }
                }
                foreach ($product_details as $key => $total_price) {
                    if ($key == $cart_prod['id']) {
                        $data['cart_products'][$i]['total_price'] = $total_price['total_price'];
                    }
                }
                $i++;
            }

            $data['total'] = array();
            foreach ($data['cart_products'] as $value) {
                $data['total'][] = $value['total_price'];
            }

            $data['total'] = array_sum($data['total']);
            $data['discount'] = $this->session->userdata('discount');
            $user_login_details = $this->session->userdata('user_login');
            $user_id = $user_login_details[0]['id'];

            $data['user_address'] = $this->Checkout_model->getUserAddress($user_id);
        }
        $this->load->view('frontend/header.php');
        $this->load->view('frontend/checkout', $data);
        $this->load->view('frontend/footer');
    }


    /*
     * user_address_details
     * Apply coupon code. 
     * @access public
     * @param $billing_addr_id, $shipping_addr_id,$shipping_method  
     * @return json
     */
    public function userAddressDetails($billing_addr_id, $shipping_addr_id, $shipping_method) {

        //$this->session->unset_userdata('last_page_visited');
        //echo'<pre>';print_r($this->session->userdata());exit;
        $data = array();
        $user_login_details = $this->session->userdata('user_login');
        $data['user_id'] = $user_login_details[0]['id'];
        $data['created_date'] = date('Y-m-d h:i:s');
        $data['status'] = 'P';
        $data['grand_total'] = $this->session->userdata('grand_total');
        $data['shipping_method'] = $shipping_method;

        //$data['payment_gateway_id'] = $shipping_method;
        $data['coupon_id'] = $this->session->userdata('coupon_id');       
        $data['shipping_charges'] = $this->session->userdata('shipping_charges');

        $last_id = $this->Checkout_model->insert($data);

        $this->session->set_userdata('last_id', $last_id);  // sets session and gets the last id of user_order table
        $product_details = $this->session->userdata('cart');

        $product_id = array_keys($product_details);
        $i = 0;
        
        $prod_cart_details = array();

        foreach ($product_details as $key => $cart_prod) {
            $prod_cart_details[$i]['product_id'] = $key;
            $prod_cart_details[$i]['quantity'] = $cart_prod['quantity'];
            $prod_cart_details[$i]['base_price'] = $cart_prod['price'];
            $prod_cart_details[$i]['amount'] = $cart_prod['total_price'];
            $prod_cart_details[$i]['order_id'] = $last_id;
            $i++;
        }

        $order_details = $this->Checkout_model->insert_order_details($prod_cart_details);
        $user_address_confirmation = array();

        if ($billing_addr_id) {
            $billing_user_addr = $this->User_addres_model->getUserAddress_By_Id($billing_addr_id);
          
            $billing_user_addr = $billing_user_addr[0];
            $this->session->set_userdata('billing_address', $billing_user_addr);
            if (!empty($billing_user_addr)) {
                $addrss = 1;
                $result = $this->Checkout_model->update($billing_user_addr, $addrss, $last_id);
            }
        }

        if ($shipping_addr_id) {
            $shipping_user_addr = $this->User_addres_model->getUserAddress_By_Id($shipping_addr_id);
            $shipping_user_addr = $shipping_user_addr[0];
          
            $this->session->set_userdata('shipping_address', $shipping_user_addr);
            if (!empty($shipping_user_addr)) {
                $addrss = 0;
                $result = $this->Checkout_model->update($shipping_user_addr, $addrss, $last_id);
            }
        }

        if ($data['shipping_method'] == 'Paypal') {
            echo json_encode(array('success_paypal'));
        } else {
            echo json_encode(array('success_cod'));
        }

    }


    /*
     * payment_success
     * Display order details summary. 
     * @access public
     * @param null
     * @return view file
     */
    public function paymentSuccess() {
        $data = $this->session->userdata();

        $data['user_id'] = $data['user_login'][0]['id'];

        $data['email'] = $data['user_login'][0]['email']; //user email address has to be saved from above $data, need to create a proper array

        $data['sub_total'] = $data['checkout'];  //total amount of the order is not acheived,instead only product amount is received in case of amount less then 500rs.

        $data['cart_products'] = $this->My_orders_model->getOrderDetails($data['last_id']);
        $order_details_template = '';
        $curr_date = date('Y-m-d');

        foreach ($data['cart_products'] as $cart_item) {
            $order_details_template .= '<tr><td>' . $cart_item['id'] . '</td><td>' . $cart_item['name'] .
                    '</td><td>' . $cart_item['base_price'] . '</td><td>' . $cart_item['quantity'] . '</td><td>' . $cart_item['amount'] .
                    '</td></tr>';
        }

        $data['billing_information'] = $data['billing_address']['address_1'] . ',' . $data['billing_address']['address_2'] . ',' . '<br />' . $data['billing_address']['ct_name'] . ',' . $data['billing_address']['st_name'] . ',' . $data['billing_address']['count_name'] . '<br />' . $data['billing_address']['zipcode'] . '<br />';

        $data['shipping_information'] = $data['shipping_address']['address_1'] . ',' . $data['shipping_address']['address_2'] . ',' . '<br />' . $data['shipping_address']['ct_name'] . ',' . $data['shipping_address']['st_name'] . ',' . $data['shipping_address']['count_name'] . '<br />' . $data['shipping_address']['zipcode'] . '<br />';

        $data['order_details_template'] = $order_details_template;

        if (empty($data['discount'])) {

            $data['discount_price'] = 0;
            $cart_prod_total = array();
            foreach ($data['cart_products'] as $value) {
                $cart_prod_total[] = $value['amount'];
            }
            $data['sub_total'] = array_sum($cart_prod_total);
            if ($data['sub_total'] < 500) {
                $data['grand_total'] = $data['sub_total'] + 50;
                $data['shipping_charges'] = '&#8377;50';
            } else {
                $data['grand_total'] = $data['sub_total'];
                $data['shipping_charges'] = 'FREE';
            }
        } else {
            $data['discount_price'] = $data['discount']['discount_price'];
            if ($data['sub_total'] < 500) {
                $data['grand_total'] = $data['grand_total'] + 50;
                $data['shipping_charges'] = '&#8377;50';
            } else {
                $data['grand_total'] = $data['grand_total'];
                $data['shipping_charges'] = 'FREE';
            }
        }
       
        if ($data['order_details_template'] != '') {
            $template1 = $this->parser->parse('frontend/payment_cod_template', $data);
        }

        $order_id = $data['last_id'];
        $mail_add = $data['email'];

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
        $this->email->to($mail_add);  // Order details is sent on the user mail 
        $this->email->subject('Order details');
        $this->email->message($template1);
        $this->email->send();

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
        $this->email->to('franklinfargoj1991@gmail.com');  // Order details is sent on the admin mail 
        $this->email->subject('Order details');
        $this->email->message($template1);
        $this->email->send();

        $unset_data = array('cart', 'discount', 'coupon_id', 'checkout', 'checkout', 'last_id', 'billing_address', 'shipping_address',
            'grand_total');

        $this->session->unset_userdata($unset_data);
        redirect(base_url() . 'index.php/PaymentComplete/codSucces/' . $order_id);
    }

}

        