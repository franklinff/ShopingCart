<?php
class Product_model extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }


    /*
     * function name : getAll  
     * for listing product table.
     * @author  Franklin
     * @access  public
     * @param : number
     * @return : array
     */
    public function getAll()
    {
        $this->db->where('is_deleted','0');
        $r = $this->db->get('product');
        return $r->result_array();
    }


    /*
     * function name : insert_product_info
     * for inserting product details in product table
     * @author  Franklin
     * @access  public
     * @param : number
     * @return : number
     */
    public function insert_product_info($data_info)
    {       
        $name = $data_info['name'];
        $sku = $data_info['sku'];
        $short_description = $data_info['short_description'];
        $long_description = $data_info['long_description'];
        $price = $data_info['price'];
        $special_price = $data_info['special_price'];
        $special_price_from = $data_info['special_price_from'];
        $special_price_to = $data_info['special_price_to'];
        $quantity = $data_info['quantity'];
        $meta_title = $data_info['meta_title'];
        $meta_description = $data_info['meta_description'];
        $meta_keywords = $data_info['meta_keywords'];
        $status = $data_info['status'];
        $created_date = date('y-m-d');
        $is_featured = $data_info['is_featured'];
        $category_id = $data_info['category_id'];
            
        $select = "SELECT @product_id as p_id";

        $result = $this->db->query("CALL add_product('$name','$sku','$short_description',
          '$long_description','$price','$special_price','$special_price_from','$special_price_to',
          '$quantity','$meta_title','$meta_description','$meta_keywords','$status','2','$created_date',
          '$is_featured',@product_id)");

        $result_product_id = $this->db->query($select);

        $arr_product_id = $result_product_id->result_array();
        
        $cc = $arr_product_id[0]['p_id'];
        $result = $this->db->query("CALL add_product_categories('$cc','$category_id')");
        return  $arr_product_id;
    }


    /*
     * function name : insert_product
     * insert the images in  product_images table
     * @author  Franklin
     * @access  public
     * @param : number
     * @return : array
     */
    public function insert_product_img($data,$data_info,$p_id)
    {
        $x=$p_id[0]['p_id'];
        /*print_r($x);
        exit();*/
        $status = $data_info['status'];
        $created_date = date('y-m-d');
        $image_name = $data['image']['file_name'];
        $result = $this->db->query("CALL add_product_image('$image_name','$status','2','$created_date',".$x.")");
     }


    /*
     * function name : getByCat
     * for getting categories in dropdown.
     * @author  Franklin
     * @access  public
     * @param : number
     * @return : array
     */
    public function getByCat()
    {   
        $this->db->select('c.id as id, c.name as name, c.parent_id as parent_id, c2.name as parent_name');    
        $this->db->from('category as c');
        $this->db->join('category as c2', 'c.parent_id = c2.id', 'left');
        $query = $this->db->get();
        return $query->result_array();
    }


    /*
     * function name : getProduct
     * returns data from product table for editing purpose
     * @author  Franklin
     * @access  public
     * @param : number
     * @return : array
     */
    public function getProduct($id)
    {
        $this->db->where('id',$id);
        $r = $this->db->get('product');
        return $r->result_array();
    }



    /*
     * function name : getCurrentCategory
     * retrieves data from product_categories table  
     * @author  Franklin
     * @access  public
     * @param : number
     * @return : array
     */
    public function getCurrentCategory($id)
    {
        $this->db->select('id,product_id,category_id');
        $this->db->where('product_id',$id);
        $r = $this->db->get('product_categories');
        return $r->result_array();
    }


    /*
     * function name : getProduct_image
     * returns data from product_images table for editing purpose
     * @author  Franklin
     * @access  public
     * @param : number
     * @return : array
     */
    public function getProduct_image($id)
    {
        $this->db->where('product_id',$id);
        $r = $this->db->get('product_images');
        return $r->result_array();
    }



    /*
     * function name : update_product_info
     * to update the products
     * @author  Franklin
     * @access  public
     * @param : number
     * @return : array
     */
    public function update_product_info($data_info,$id)
    {
        $name = $data_info['name'];
        $sku = $data_info['sku'];
        $short_description = $data_info['short_description'];
        $long_description = $data_info['long_description'];
        $price = $data_info['price'];
        $special_price = $data_info['special_price'];
        $special_price_from = $data_info['special_price_from'];
        $special_price_to = $data_info['special_price_to'];
        $quantity = $data_info['quantity'];
        $meta_title = $data_info['meta_title'];
        $meta_description = $data_info['meta_description'];
        $meta_keywords = $data_info['meta_keywords'];
        $status = $data_info['status'];
        $is_featured = $data_info['is_featured'];
        $catg_id = $data_info['category_id'];

        $result = $this->db->query("CALL update_product('$name','$sku','$short_description','$long_description','$price','$special_price',
                                                        '$special_price_from','$special_price_to','$quantity','$meta_title',
                                                        '$meta_description','$meta_keywords','$status','2','$is_featured',
                                                        ".$id.")");

        $result = $this->db->query("CALL update_product_categories('$catg_id',".$id.")");
    }



    /*
     * function name : update_product_images
     * Updates the images product_images
     * @author  Franklin
     * @access  public
     * @param : number
     * @return : array
     */
    public function update_product_images($data,$data_info,$id)
    {
        $image_name = $data['image']['file_name'];
        $status = $data_info['status'];
        $created_date = date('y-m-d');
        $result = $this->db->query("CALL edit_product_images('$image_name','$status','2','$created_date',".$id.")");
    }



    /*
     * function name : delete_product
     * sets value of cloum is_deleted to o
     * @author  Franklin
     * @access  public
     * @param : number
     * @return : array
     */
    public function delete_product($id)
    {
        $data=array('is_deleted'=>'1');
        $this->db->where('id', $id);
        $this->db->update('product',$data);     
        //$this->db->delete('product'); 
    }

} 
