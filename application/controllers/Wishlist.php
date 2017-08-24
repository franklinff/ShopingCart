<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Wishlist extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Wishlist_model', 'wishlist');
        $this->load->model('Shop_model', 'shop');
 
        if (empty($this->session->userdata('user_login'))){      
           redirect(base_url() . 'index.php/user_login');
        }
    }

    /**
     * index
     * Displays products added to the wishlist. 
     *
     * @access public
     * @param null 
     * @return view file
     */
    public function index() {
        $data = '';
/*        $user_id = $this->session->id;*/

        $user_login_details = $this->session->userdata('user_login');
        $user_id = $user_login_details[0]['id'];

        $wishlist = $this->wishlist->getWishlistData($user_id);
        $wishlist_count = $this->shop->check_prod_id('', $user_id);
        $wishlist_count = COUNT($wishlist_count);
        $this->session->set_userdata('wishlist_count', $wishlist_count);
        if ($wishlist) {
            $wishlist_product_ids = array();
            foreach ($wishlist as $value) {
                $wishlist_product_ids[] = $value['product_id'];
            }
            $data['wishlist_products'] = $this->wishlist->getWishlistProducts($wishlist_product_ids);
        }

        $this->load->view('frontend/header.php');
        $this->load->view('frontend/wishlist', $data);
        $this->load->view('frontend/footer');
    }

    /**
     * delete_wishlist_product
     * Deletes product added to the wishlist. 
     *
     * @access public
     * @param $product_id 
     * @return json
     */
    public function delete_wishlist_product($product_id) {
        $result = $this->wishlist->delete($product_id);
        $user_id = $this->session->id;
        $wishlist_count = $this->shop->check_prod_id('', $user_id);
        $wishlist_count = COUNT($wishlist_count);
        $delete_wishlist_prod = array(
            'status' => 'Deleted',
            'total_wishlist_prod' => $wishlist_count
        );
        echo json_encode($delete_wishlist_prod);
    }

    /**
     * add_to_cart
     * Adds product to cart. 
     *
     * @access public
     * @param $product_id 
     * @param $price 
     * @return json
     */
    public function add_to_cart($product_id, $price, $prod_quantity) {


        $user_id = $this->session->id;
        if ($this->session->userdata('cart')) {
            $existing_cart_data = $this->session->userdata('cart');
            $available = false;
            foreach ($existing_cart_data as $key => $val) {
                if ($key == $product_id) {
                    $available = true;
                    break;
                }
            }
            
            if (!$available) {
                $total_price = $price * $prod_quantity;
                $existing_cart_data[$product_id] = array(
                    'quantity' => $prod_quantity,
                    'price' => $price,
                    'total_price' => $total_price
                );
                $this->session->set_userdata('cart', $existing_cart_data);
                $reslt = $this->wishlist->delete($product_id);
                $wishlist_count = $this->shop->check_prod_id('', $user_id);
                $wishlist_count = COUNT($wishlist_count);
                $cart_amount = COUNT($this->session->cart);

                $cart_array = array(
                    'messge' => 'Added to the cart!',
                    'total_cart_prod' => $cart_amount,
                    'total_wishlist_prod' => $wishlist_count);

                echo json_encode($cart_array);
            } else {
                foreach ($existing_cart_data as $key => $value) {
                    if ($key == $product_id) {
                        $existing_cart_data[$key]['quantity'] = $value['quantity'] + 1;
                        $existing_cart_data[$key]['total_price'] = $value['total_price'] * $value['quantity'];
                        break;
                    }
                }
                $this->session->set_userdata('cart', $existing_cart_data);
                $reslt = $this->wishlist->delete($product_id);
                $wishlist_count = $this->shop->check_prod_id('', $user_id);
                $wishlist_count = COUNT($wishlist_count);
                $cart_amount = COUNT($this->session->cart);

                $cart_array = array(
                    'messge' => 'Product Quantity Updated!',
                    'total_cart_prod' => $cart_amount,
                    'total_wishlist_prod' => $wishlist_count);

                echo json_encode($cart_array);
            }
        } else {
            $total_price = $price * $prod_quantity;
            $new_product[$product_id] = array(
                'quantity' => $prod_quantity,
                'price' => $price,
                'total_price' => $total_price
            );
            $this->session->set_userdata('cart', $new_product);
            $reslt = $this->wishlist->delete($product_id);
            $wishlist_count = $this->shop->check_prod_id('', $user_id);
            $wishlist_count = COUNT($wishlist_count);
            $this->session->set_userdata('cart', $new_product);
            $cart_amount = COUNT($this->session->cart);
            $cart_array = array(
                'messge' => 'Added to the cart!',
                'total_cart_prod' => $cart_amount,
                'total_wishlist_prod' => $wishlist_count);
            echo json_encode($cart_array);
        }
    }

}
