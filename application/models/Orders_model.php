<?php

class Orders_model extends CI_Model{

    public function __construct() {
        parent::__construct();
    }
   

    /*
     * function name :getOrders
     * Get orders
     * @access	public
     * @param : null
     * @return : array
     */
    public function getOrders() {        
        $this->db->select('user_order.id,user_order.transaction_id,user_order.grand_total,user_order.shipping_method,'
                . 'user_order.created_date,user_order.user_id,users.id AS user_id ,users.firstname,users.lastname');
        $this->db->from('user_order');
        $this->db->join('users','users.id=user_order.user_id');
        $r = $this->db->get();
        return $r->result_array();
    }


    /*
     * function name :getOrderDetails
     * Get orders details as per order id
     * @access	public
     * @param : $order_id
     * @return : array
     */
    public function getOrderDetails($order_id) {
        $this->db->select('order_details.*,product.name,product.id,product.price');
        $this->db->from('order_details');
        $this->db->join('product', 'product.id = order_details.product_id');
        $this->db->where('order_id', $order_id);
        $r = $this->db->get();
        return $r->result_array();
    }


    /*
     * function name :getOrderAddress
     * Get order address
     * @access	public
     * @param : $order_id,$addr
     * @return : array
     */
    public function getOrderAddress($order_id, $addr = true) {
        if ($addr == true) {
            $this->db->select('billing_address_1,billing_address_2,billing_city,billing_starte,billing_country,billing_zipcode,coupon_id,grand_total,shipping_charges');
        } else {
            $this->db->select('shipping_address_1,shipping_address_2,shipping_city,shipping_state,shipping_country,shipping_zipcode');
        }
        $this->db->from('user_order');
        $this->db->where('id', $order_id);
        $r = $this->db->get();
        return $r->result_array();
    }


    /*
     * function name :getCouponDetails
     * Get coupon percent off
     * @access	public
     * @param : $coupon_id
     * @return : array
     */
    public function getCouponDetails($coupon_id) {
        $this->db->select('percent_off');
        $this->db->from('coupon');
        $this->db->where('id', $coupon_id);
        $r = $this->db->get();
        return $r->result_array();
    }

    
    /*
     * function name : update_status
     * 
     * @access	public
     * @param : $order_status
     */
    public function update_status($order_status) {
        $status['status'] = $order_status['status'];
        $this->db->where('id',$order_status['id']);
        $r = $this->db->update('user_order',$status);
        return $r;
    }
 

    /*
     * function name :getEmail
     * 
     * @access	public
     * @param : $order_id
     * @return : array
     */
    public function getEmail($order_id) {
        $this->db->select('user_order.user_id,users.id,users.email,users.firstname,users.lastname');
        $this->db->from('user_order');
        $this->db->join('users','user_order.user_id=users.id');
        $this->db->where('user_order.id', $order_id);
        $r = $this->db->get();
        return $r->result_array();  
    }
    

}