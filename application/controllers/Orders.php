<?php
class Orders extends CI_Controller{
    
    public function __construct() {
        parent::__construct();

        $this->load->model('Orders_model');
        $this->load->library('parser');

        $x=$this->session->admin_login;
        if(empty($x)){
             redirect('Login');
       }
    }
    
    /*
     * index
     * List orders.
     * @access public
     * @param null
     * @return view file
     */
    public function index() {
        $data['orders'] = $this->Orders_model->getOrders();
        $this->load->view('backend/header.php');
        $this->load->view('backend/sidebar.php');
        $this->load->view('backend/orders.php', $data);
        $this->load->view('backend/footer.php');
    }

    /*
     * order_details
     * Display order details as per order id.
     * @access public
     * @param $order_id
     * @return view file
     */
    public function orderDetails($order_id) {

        $data['order_details'] = $this->Orders_model->getOrderDetails($order_id);
        $data['billing_address'] = $this->Orders_model->getOrderAddress($order_id, true);
        $data['shipping_address'] = $this->Orders_model->getOrderAddress($order_id, false);

        $data['billing_address'] = $data['billing_address'][0];
        $data['shipping_address'] = $data['shipping_address'][0];
        $data['sub_total'] = array();
        foreach ($data['order_details'] as $value) {
            $data['sub_total'][] = $value['amount'];
        }

        $data['sub_total'] = array_sum($data['sub_total']);
        if (!empty($data['billing_address']['coupon_id'])) {
            $percent_off = $this->Orders_model->getCouponDetails($data['billing_address']['coupon_id']);
            $percent_off = $percent_off[0]['percent_off'];
            $percent = $percent_off / 100;
            $discount = $percent * $data['sub_total'];
            $data['discount'] = $discount;
        }
        $this->load->view('backend/header.php');
        $this->load->view('backend/sidebar.php');
        $this->load->view("backend/order_details.php", $data);
        $this->load->view('backend/footer.php');
    }
    
    /*
     * update_order_status
     * Update order status and sends email notification to customer.
     * @access public
     * @param null
     * @return null
     */
    public function updateOrderStatus() {

        $order_status = $this->input->post();

        $data['order_id'] = $order_status['id']; //Order id is assigned to  $data['order_id']

        $data['email'] = $this->Orders_model->getEmail($data['order_id']);

        $data['name'] = $data['email'][0]['firstname'].' '.$data['email'][0]['lastname']; //error is caused of offset

        $data['email'] = $data['email'][0]['email'];

        $result = $this->Orders_model->update_status($order_status);

        if($order_status['status'] == 'P'){
            $order_status['status'] = 'Pending';
        }
        if($order_status['status'] == 'O'){
            $order_status['status'] = 'Processing';
        }
        if($order_status['status'] == 'S'){
            $order_status['status'] = 'Shipped';
        }
        if($order_status['status'] == 'D'){
            $order_status['status'] = 'Delivered';
        }
        $data['status'] = $order_status['status'];
        
        if($order_status){
            $data['order_details'] = $this->Orders_model->getOrderDetails($data['order_id']);
            $data['billing_address'] = $this->Orders_model->getOrderAddress($data['order_id'], true);
            $data['shipping_address'] = $this->Orders_model->getOrderAddress($data['order_id'], false);
            
            $data['billing_address'] = $data['billing_address'][0];
            $data['shipping_address'] = $data['shipping_address'][0];

            $data['sub_total'] = array();
            foreach ($data['order_details'] as $value) {
                $data['sub_total'][] = $value['amount'];
            }
            $data['sub_total'] = array_sum($data['sub_total']);  //returns the total price of the order

            if (!empty($data['billing_address']['coupon_id'])) {

                $percent_off = $this->Orders_model->getCouponDetails($data['billing_address']['coupon_id']);
                $percent_off = $percent_off[0]['percent_off'];

                $percent = $percent_off / 100;
                $discount = $percent * $data['sub_total'];
                $data['discount'] = $discount;
            }

            $order_details_template = '';
            foreach ($data['order_details'] as $cart_item) {
                $order_details_template .= '<tr><td>' . $cart_item['id'] . '</td><td>' . $cart_item['name'] .
                        '</td><td>' . $cart_item['price'] . '</td><td>' . $cart_item['quantity'] . '</td><td>' . $cart_item['amount'] .
                        '</td></tr>';
            }
            $data['billing_information'] = $data['billing_address']['billing_address_1'] . ',' . $data['billing_address']['billing_address_2'] . ',' . '<br />' ;

            $data['billing_address']['billing_city'] . ',' . $data['billing_address']['billing_starte'] . ',' . $data['billing_address']['billing_country'] . '<br />' .$data['billing_address']['billing_zipcode'] . '<br />';

            $data['shipping_information'] = $data['shipping_address']['shipping_address_1'] . ',' . $data['shipping_address']['shipping_address_2'] . ',' . '<br />' .
                    $data['shipping_address']['shipping_city'] . ',' . $data['shipping_address']['shipping_state'] . ',' . $data['shipping_address']['shipping_country'] . '<br />' .
                    $data['shipping_address']['shipping_zipcode'] . '<br />';
            $data['order_details_template'] = $order_details_template;
            
            if (empty($data['discount'])) {
                $data['discount'] = 0;
            }

            if($data['sub_total'] > 500 ){
                $data['shipping_charges'] = 'FREE';
            }else{
                $data['shipping_charges'] = 50;
            }
            $data['grand_total'] = $data['billing_address']['grand_total'];
           
            if ($data['order_details_template'] != '') {
                $template1 = $this->parser->parse('backend/order_status_template', $data);
            }
            
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
            $this->email->to($data['email']);  // Query details is sent on the email of the user 
            $this->email->subject('Order Status');
            $this->email->message($template1);
            $this->email->send();

            if($result){
                $this->session->set_flashdata('success','Status of order id '.$data['order_id'].' updated successfully!');
                redirect('Orders');
            }
        }
    }
    

}
