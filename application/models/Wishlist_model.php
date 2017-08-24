 <?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Wishlist_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        // Your own constructor code
    }


    /*
     * function name : getWishlistData
     * Display products added to wishlist.
     * @access public
     * @param $user_id
     * @return array
     */
    public function getWishlistData($user_id) {
        $this->db->select('product_id');
        $this->db->from('user_wish_list');
        $this->db->where('user_id', $user_id);
        $r = $this->db->get();
        return $r->result_array();
    }


    /*
     * function name : getWishlistProducts
     * Display products added to the cart.
     * @access public
     * @param $product_ids
     * @return array
     */
    public function getWishlistProducts($product_ids) {
        $this->db->select('product.id,product.name,product.is_featured,product.price,
                    (SELECT pm.image_name FROM product_images pm 
                    WHERE pm.product_id = product.id ORDER BY pm.id ASC LIMIT 1 ) AS image_name');
        $this->db->from('product');
//        $this->db->join('product_images', 'product.id = product_images.product_id');
        $this->db->where_in('product.id', $product_ids);
        $r = $this->db->get();
        return $r->result_array();
    }



    /*
     * function name : getAddedProducts
     * Display products added to the wish_list 
     * @access public
     * @param $user_id
     * @return array
     */
    public function getAddedProducts($user_id) {
        $this->db->select('product_id');
        $this->db->from('user_wish_list');
        $this->db->where('user_id', $user_id);
        $r = $this->db->get();
        return $r->result_array();
    }


    /*
     * function name :delete
     * Delete products added to wishlist
     * @access public
     * @param $product_id
     * @return boolean
     */
    public function delete($product_id) {
        $this->db->where('product_id', $product_id);
        $r = $this->db->delete('user_wish_list');
        return $r;
    }

}
