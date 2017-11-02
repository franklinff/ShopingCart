<?php

class Cart_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }


     /*
     * function name : getAddedProducts
     * Retreive the products added to cart.
     * @author  Franklin
     * @access  public
     * @param : $product_id
     * @return : array
     */
    public function getAddedProducts($product_id) { 
        var_dump($product_id);
        $this->db->select('product.id,product.name,product.is_featured,product.price,product.special_price,product.special_price_from,
                    product.special_price_to,(SELECT pm.image_name FROM product_images pm 
                    WHERE pm.product_id = product.id ORDER BY pm.id ASC LIMIT 1 ) AS image_name');
        $this->db->from('product');
        $this->db->where_in('product.id', $product_id);
        $r = $this->db->get();
        echo $this->db->last_query();
        return $r->result_array();
    }


     /*
     * function name : getcoupondata
     * Get coupon data.
     * @author  Franklin
     * @access  public
     * @param : $coupon_code
     * @return : array
     */
    public function getcoupondata($coupon_code) { 
        $this->db->select('*');
        $this->db->from('coupon');
        $this->db->where('code', $coupon_code);
        $this->db->where('is_deleted', '0');
        $r = $this->db->get();
        return $r->result_array();
    }


     /*
     * function name : update_users
     * Update coupon data.
     * @author  Franklin
     * @access  public
     * @param : $no_of_uses, $coupon_code
     */
    public function update_users($no_of_uses, $coupon_code) {
        $this->db->set('no_of_uses', $no_of_uses);
        $this->db->where('code', $coupon_code);
        $r = $this->db->update('coupon');
        return $r;
    }


     /*
     * function name : coupon_uses
     * Get coupons used.
     * @author  Franklin
     * @access  public
     * @param : $coupon_id
     * @return : array
     */
    public function coupon_uses($coupon_id) {
        $this->db->select('count(1) AS coupon_count');
        $this->db->from('coupons_used');
        $this->db->where('coupon_id', $coupon_id);
        $r = $this->db->get();
        return $r->result_array();
    }
    

     /*
     * function name : getPrice
     * to get price of products as per the $product_id
     * @author  Franklin
     * @access  public
     * @param : $product_id,$order_id
     * @return : array
     */
    public function getPrice($product_id,$order_id) {
        $this->db->select('id,base_price,product_id');
        $this->db->from('order_details');
        $this->db->where_in('product_id',$product_id);
        $this->db->where('order_id', $order_id);
        $r = $this->db->get();
        return $r->result_array();
    }
    

}