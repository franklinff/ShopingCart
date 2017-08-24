<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Shop extends CI_Controller {
    /*
     * function name :__construct
     *  Counstructor for Admin_login controller 
     * 

     * @access	public
     * @param : 
     * @return : void
     */

    public function __construct() {
        parent::__construct();
        

        $this->load->model('frontend/Shop_model');
    }

    public function index($id = '') {
//        echo $id;
//        echo '<pre>';print_r($this->session->userdata(''));exit;
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'index.php/Shop/index/';
        $config['per_page'] = 6;
        $config['uri_segment'] = 5;
        $config['total_rows'] = $this->Shop_model->record_count();
        $this->pagination->initialize($config);




        $data["category"] = $this->Shop_model->fetch_category();

        $data["sub_category"] = $this->Shop_model->fetch_subcategory();
        if ($id == 0) {
            $data["product"] = $this->Shop_model->fetch_products($config['per_page']);
        }
//         echo '<pre>';print_r($data["product"]);exit;
        else {
            $data['product'] = $this->Shop_model->fetch_products_by_cat($id, $config['per_page']);
        }
//        echo '<pre>';print_r($data['dis_category']);exit;
        $this->load->view("frontend/header");
        $this->load->view("frontend/shop", $data);
        $this->load->view("frontend/footer");
    }

    public function add_to_cart($id, $final_price) {
        $cart = $this->session->userdata('cart');
        //print_r($cart);exit;
        $available = false;

        if (!is_null($cart)) {
            foreach ($cart as $value) {
                if ($id == $value['product_id']) {
                    $available = true;
                }
            }
        } else {
            $cart = array();
        }

        if ($available) {
            foreach ($cart as $key => $value) {
                if ($id == $value['product_id']) {
                    $cart[$key]['quantity'] = $value['quantity'] + 1;
                    $cart[$key]['total_price'] = $value['total_price'] * $cart[$key]['quantity'];
                }
            }

            $this->session->set_userdata('cart', $cart);
             $cart_count1 = $this->session->userdata('cart');
            $cart_count = array(
                'count' => COUNT($cart_count1)
            );
            $this->session->set_userdata('cart_count', $cart_count);
            echo json_encode($cart_count);
//            echo '<pre>';print_r($cart);exit;
        }

        if ((count($cart) == 0) || $available === false) {
            $arr_new_product = array(
                'product_id' => $id,
                'quantity' => 1,
                'total_price' => $final_price,
                
            );
            array_push($cart, $arr_new_product);
            $this->session->set_userdata('cart', $cart);
            $cart_count1 = $this->session->userdata('cart');
            $cart_count = array(
                'count' => COUNT($cart_count1)
            );
            echo '<pre>';print_r($cart_count);exit;
            $this->session->set_userdata('cart_count', $cart_count);
            echo json_encode($cart_count);
        }
    }

}
