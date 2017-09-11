<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * product model contain product related functions
 * @package    CI
 * @subpackage Model
 */
class Shop_model extends CI_Model {
    /*
     * function name :select
     *  To select login
     *
     * @access	public
     * @param : 
     * @return : boolean
     */

    public function __construct() {
        parent::__construct();
    }

    /*
     * function name :fetch_products
     *  To fetch products
     *
     * @access	public
     * @param : 
     * @return : boolean
     */

    public function fetch_products() {
        $this->db->select('product.id,product.name,product.price,product.status,(SELECT product_images.image_name FROM product_images WHERE product_images.product_id = product.id ORDER BY id ASC LIMIT 1) AS pr_img');
        $this->db->from('product');
        $this->db->where('is_featured', '1');
        $r = $this->db->get();

        return $r->result_array();
    }

    /*
     * function name :fetch_category
     *  To fetch category
     *
     * @access	public
     * @param : 
     * @return : boolean
     */

    public function fetch_category(){
        $this->db->where('parent_id', '0');
        $r = $this->db->get('category');
        return $r->result_array();
    }

    /*
     * function name :fetch_subcategory
     *  To fetch Sub Category
     *
     * @access	public
     * @param : 
     * @return : boolean
     */

    public function fetch_subcategory() {
        $this->db->where('parent_id!=', '0');
        $r = $this->db->get('category');
        return $r->result_array();
    }

    /*
     * function name :fetch_products_by_cat
     *  To 
     *
     * @access	public
     * @param : id
     * @return : boolean
     */

    public function fetch_products_by_cat($id) {
        $this->db->select('product.id,product.name,product.price,product.status,product_categories.product_id,product_categories.category_id,(SELECT product_images.image_name FROM product_images WHERE product_images.product_id = product.id ORDER BY id ASC LIMIT 1) AS pr_img');
        $this->db->from('product');
        $this->db->join('product_categories', 'product_categories.product_id = product.id');
        $this->db->where('product_categories.category_id', $id);
        $r = $this->db->get();
        return $r->result_array();
    }
    /*
     * function name :fetch_products_by_cat
     *  To 
     *
     * @access	public
     * @param : id
     * @return : boolean
     */
    public function record_count() {
        $count = $this->db->count_all('product');
        return $count;
    }
    
}
