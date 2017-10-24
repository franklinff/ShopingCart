<?php
class Product_details_model extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    /*
     * function name : getProduct
     * returns data from product table for editing purpose
     * @author  Franklin
     * @access  public
     * @param : $id
     * @return : array
     */
    public function getProduct($id)
    {
        $this->db->where('id',$id);
        $r = $this->db->get('product');
        return $r->result_array();
    }

    /*
     * function name : getProduct_images
     * returns images from product_images for editing purpose
     * @author  Franklin
     * @access  public
     * @param : $id
     * @return : array
     */
    public function getProduct_images($id)
    {
        $this->db->where('product_id',$id);
        $r = $this->db->get('product_images');
        return $r->result_array();
    }
}