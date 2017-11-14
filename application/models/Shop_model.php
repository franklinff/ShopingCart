<?php

class Shop_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

     /*
     * function name : getProdetails
     * Retreive the products 
     * @author  Franklin
     * @access  public
     * @param : $count,$limit,$offset,$category_id,$min_price,$max_prices
     * @return : array
     *///Called from Shop controller only   
    public function getProdetails($count = false, $limit = '', $offset = '', $category_id = '',$min_price = '',$max_price = '') {

        if ($category_id != '') {
            
            $this->db->select('id');
            $this->db->from('category');
            $this->db->where('parent_id', $category_id);
            $r = $this->db->get();
            $sub_categoryid = $r->result_array();        
            $sub_category_id = array();
            foreach ($sub_categoryid as $value) {
                $sub_category_id[] = $value['id'];
            }
            $this->db->select('product_id');
            $this->db->from('product_categories');
            if (!empty($sub_category_id)) {
                $this->db->where_in('category_id', $sub_category_id);
            } else {
                $this->db->where('category_id', $category_id);
            }
            $r = $this->db->get();
            $product_id = $r->result_array();
            if (empty($product_id)) {
                return false;
            }
        }

        if ($count == false) {
            $this->db->select('product.id,product.name,product.is_featured,product.price,product.special_price,product.special_price_from,
                    product.special_price_to,(SELECT pm.image_name FROM product_images pm 
                    WHERE pm.product_id = product.id ORDER BY pm.id ASC LIMIT 1 ) AS image_name');
        } else {
            $this->db->select('count(1) AS prod_count');
        }

        if ($count == false) {
            if ($limit != '' && $offset != '') {
                $this->db->limit($limit, $offset);
            } else if ($limit != '') {
                $this->db->limit($limit, $offset);
            }
        }
        $this->db->from('product');

        if ($category_id != '') {
            if (!empty($product_id)) {
                $arr_prod = array();
                foreach ($product_id as $value) {
                    $arr_prod[] = $value['product_id'];
                }
                $this->db->where_in('product.id', $arr_prod);
            }
        } else {
            $this->db->where('is_featured', '1');
            //$this->db->where('is_deleted', '1');
        }

        if($min_price != '' || $max_price != ''){
            $this->db->where('price >=',$min_price);
            $this->db->where('price <=',$max_price);
        }

        $this->db->order_by('product.id', 'DESC');
        $result = $this->db->get();
        return $result->result_array();
    }



     /*
     * function name : getPrice
     * Get price range
     * @author  Franklin
     * @access  public
     * @param : $count
     * @return : array
     */
    /*public function getPrice($count = false) {
        if ($count == false) {
            $this->db->select_min('price');
        } else {
            $this->db->select_max('price');
        }
        $this->db->from('product');
        $this->db->where('is_featured', '1'); 
        $r = $this->db->get();
        return $r->result_array();
    }*/


    /*
     * function name : getProdById
     * Get product by id
     * @author  Franklin
     * @access  public
     * @param : $id
     * @return : array
     */
    public function getProdById($id) {
        $this->db->select('*');
        $this->db->from('product');
        $this->db->where('id', $id);
        $r = $this->db->get();
        return $r->result_array();
    }

    /*
     * function name : getCategories
     * Get categories
     * @author  Franklin
     * @access  public
     * @param : null
     * @return : array
     */
    public function getCategories() {
        $this->db->select('id,name,parent_id');
        $this->db->from('category');
        $this->db->where('status', '1');
        $this->db->where('parent_id', '0');
        
        $this->db->order_by('name', 'ASC');
        $result = $this->db->get();
        return $result->result_array();
    }


    /*
     * function name : getSub_categories
     * Get sub categories
     * @author  Franklin
     * @access  public
     * @param : null
     * @return : array
     */
    public function getSub_categories() {
        $this->db->select('id,name,parent_id');
        $this->db->from('category');
        $this->db->where('status', '1');
        $this->db->where('parent_id !=', '0');        
        $this->db->order_by('name', 'ASC');
        $result = $this->db->get();
        return $result->result_array();
    }


     /*
     * function name : check_prod_id
     * Check product id in wishlist table
     * @author  Franklin
     * @access  public
     * @param : $product_id,$user_id
     * @return : array
     */
    public function check_prod_id($product_id, $user_id) {  //This function is called from the controller Cart,Shop.
        $this->db->select('*');
        $this->db->from('user_wish_list');
        if($product_id != ''){
            $this->db->where('product_id', $product_id);
        }
        $this->db->where('user_id', $user_id);
        $r = $this->db->get();
        return $r->result_array();
    }


     /*
     * function name : insert
     * Insert product in wishlist
     * @author  Franklin
     * @access  public
     * @param : $user_wishlist
     */
    public function insert($user_wishlist) {
        $r = $this->db->insert('user_wish_list', $user_wishlist);
        return $r;
    }
    
    /*
     * function name : getProdQuantity
     * @author  Franklin
     * @access  public
     * @param : $product_id
     * @return : 
     */
    public function getProdQuantity($product_id) {
        $this->db->select('count(1) AS product_quantity');
        $this->db->from('order_details');
        $this->db->where('product_id', $product_id);
        $r = $this->db->get();
        return $r->row();
    }
 
    /*
     * function name : getBanners
     * @author  Franklin
     * @access  public
     * @param : null
     * @return : array
     */   
    public function getBanners() {
        $this->db->select('*');
        $this->db->from('banners');
        $this->db->where('status', '1');
        $r = $this->db->get();
        return $r->result_array();
    }

}