<?php

class Track_order_model extends CI_Model{
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * getOrderDetails
     * Get order details
     *
     * @access public
     * @param $order_id
     * @return array
     */
    public function getOrderDetails($order_id) {
        $this->db->select('order_details.*,product.name,product.id,product.price');
        $this->db->from('order_details');
        $this->db->join('product', 'product.id = order_details.product_id');
        $this->db->where('order_id',$order_id);
        $r = $this->db->get();
        return $r->result_array();
    }
    
    /**
     * getOrderAddress
     * Get order address
     *
     * @access public
     * @param $order_id,$addr
     * @return array
     */
    public function getOrderAddress($order_id,$addr = true) {
        if($addr == true){
            $this->db->select('billing_address_1,billing_address_2,billing_city,billing_state,billing_country,billing_zipcode,coupon_id,grand_total,shipping_charges,status');
        }else{
            $this->db->select('shipping_address_1,shipping_address_2,shipping_city,shipping_state,shipping_country,shipping_zipcode');
        }
        $this->db->from('user_order');
        $this->db->where('id',$order_id);
        $r = $this->db->get();
        return $r->result_array();
    }
    
    /**
     * getOrderDetailsById
     * Get order details by id
     *
     * @access public
     * @param $order_id,$user_id
     * @return array
     */
    public function getOrderDetailsById($order_id,$user_id) {
        $this->db->select('status,user_id,transaction_id,grand_total,shipping_method,created_date');
        $this->db->from('user_order');
        $this->db->where('id',$order_id);
        $this->db->where('user_id',$user_id);
        $r = $this->db->get();
        return $r->result_array();
    }
}