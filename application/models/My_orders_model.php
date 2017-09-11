<?php

    class My_orders_model extends CI_Model{
    
    public function __construct() {
        parent::__construct();
    }
 

    /*
     * function name :getOrders
     * Get orders
     * @access	public
     * @param : $count,$limit,$offset,$user_id
     * @return : array
     */
    public function getOrders($count = false,$limit = '',$offset = '',$user_id) {
        if($count == false){
            $this->db->select('id,transaction_id,grand_total,created_date');
        }else{
            $this->db->select('count(1) AS order_count');
        }
        if($limit != '' && $offset!= ''){
            $this->db->limit($limit, $offset);
        }elseif($limit != ''){
            $this->db->limit($limit, $offset);
        }
        $this->db->from('user_order');
        $this->db->where('user_id',$user_id);
        $this->db->order_by('id','DESC');
        $r = $this->db->get();
        return $r->result_array();
    }
    
    /*
     * function name :getOrderDetails
     * Get order details
     * @access	public
     * @param : $order_id
     * @return : array
     */
    public function getOrderDetails($order_id) {
        $this->db->select('order_details.*,product.name,product.id');
        $this->db->from('order_details');
        $this->db->join('product', 'product.id = order_details.product_id');
        $this->db->where('order_id',$order_id);
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
    public function getOrderAddress($order_id,$addr = true) {

        if($addr == true){
            $this->db->select('billing_address_1,billing_address_2,billing_city,billing_starte,billing_country,billing_zipcode,coupon_id,grand_total,shipping_charges');
        }else{
            $this->db->select('shipping_address_1,shipping_address_2,shipping_city,shipping_state,shipping_country,shipping_zipcode');
        }

        $this->db->from('user_order');
        $this->db->where('id',$order_id);
        $r = $this->db->get();
        return $r->result_array();
    }
   

    /*
     * function name :getCouponDetails
     * Get coupon code
     * @access	public
     * @param : $coupon_id
     * @return : array
     */
    public function getCouponDetails($coupon_id) {
        $this->db->select('percent_off');
        $this->db->from('coupon');
        $this->db->where('id',$coupon_id);
        $r = $this->db->get();
        return $r->result_array();
    }
    
}
