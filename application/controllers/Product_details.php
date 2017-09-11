<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_details extends CI_Controller
{

	public function __construct()
    {
    	 parent::__construct();
    	 $this->load->model('Product_details_model');
    	 $this->load->model('Shop_model');
    }

    public function index($id)
	{
		$data['individual_data'] = $this->Product_details_model->getProduct($id);
		$data['images'] = $this->Product_details_model->getProduct_images($id);

		$data['categories'] = $this->Shop_model->getCategories();  
        $data['sub_categories'] = $this->Shop_model->getSub_categories();

        $arr_category = array(); 

        foreach ($data['categories'] as $category) {
            $id = $category['id'];
            $arr_category[$id]['name'] = $category['name'];
            $arr_category[$id]['id'] = $category['id'];
            $arr_category[$id]['parent_id'] = 0;
            $cnt_subcategory = 0;

            foreach ($data['sub_categories'] as $sub_category) {
                $sub_id = $sub_category['id'];
                $arr_sub_category = array();
                
                $arr_sub_category['name'] = $sub_category['name'];
                $arr_sub_category['id'] = $sub_category['id'];
                $arr_sub_category['parent_id'] = $sub_category['parent_id'];

                if ($id == $sub_category['parent_id']) {
                    $arr_category[$id]['sub_categories'][$cnt_subcategory] = $arr_sub_category;
                    $cnt_subcategory++;
                }
            }
        }            
        $data['arr_category'] = $arr_category;
		$this->load->view('frontend/header'); 
		$this->load->view('frontend/product_details',$data); 	
		$this->load->view('frontend/footer');
	}

}

