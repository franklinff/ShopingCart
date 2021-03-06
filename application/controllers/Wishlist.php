<?php

class Wishlist extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Wishlist_model');
        $this->load->model('Shop_model'); 
/*        if (empty($this->session->userdata('user_login'))){      
           redirect(base_url() . 'UserLogin');
        }*/
    }


    /*
     * index
     * Displays products added to the wishlist. 
     * @access public
     * @param null 
     * @return view file
     */
    public function index() {
        $data = [];

        $user_login_details = $this->session->userdata('user_login');
        $user_id = $user_login_details[0]['id'];

        $wishlist = $this->Wishlist_model->getWishlistData($user_id);
        $wishlist_count = $this->Shop_model->check_prod_id('', $user_id);
        $wishlist_count = COUNT($wishlist_count);
        $this->session->set_userdata('wishlist_count', $wishlist_count); //session - wishlist_count is set.

        if ($wishlist) {
            $wishlist_product_ids = array();
            foreach ($wishlist as $value) {
                $wishlist_product_ids[] = $value['product_id'];
            }
            $data['wishlist_products'] = $this->Wishlist_model->getWishlistProducts($wishlist_product_ids);
        }
        $this->load->view('frontend/header.php');
        $this->load->view('frontend/wishlist', $data);
        $this->load->view('frontend/footer');
    }

    /*
     * deleteWishlistProduct
     * Deletes product added to the wishlist. 
     * @access public
     * @param $product_id 
     * @return json
     */
    public function deleteWishlistProduct($product_id) {
        $result = $this->Wishlist_model->delete($product_id);

        $user_login_details = $this->session->userdata('user_login');
        $user_id = $user_login_details[0]['id'];

        $wishlist_count = $this->Shop_model->check_prod_id('', $user_id);
        $wishlist_count = COUNT($wishlist_count);
        $delete_wishlist_prod = array(
            'status' => 'Deleted',
            'total_wishlist_prod' => $wishlist_count
        );
        echo json_encode($delete_wishlist_prod);
    }

    /*
     * addToCart
     * Adds product to cart. 
     * @access public
     * @param $product_id, $price, $prod_quantity
     * @return json
     */
    public function addToCart($product_id, $price, $prod_quantity) {

        $user_login_details = $this->session->userdata('user_login');
        $user_id = $user_login_details[0]['id'];

        if ($this->session->userdata('cart')) {                     //loop ends on line 130
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
                $reslt = $this->Wishlist_model->delete($product_id);
                $wishlist_count = $this->Shop_model->check_prod_id('', $user_id);
                $wishlist_count = COUNT($wishlist_count);
                $cart_amount = COUNT($this->session->userdata('cart'));

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
                $reslt = $this->Wishlist_model->delete($product_id);
                $wishlist_count = $this->Shop_model->check_prod_id('', $user_id);
                $wishlist_count = COUNT($wishlist_count);
                $cart_amount = COUNT($this->session->userdata('cart'));

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
            $reslt = $this->Wishlist_model->delete($product_id);
            $wishlist_count = $this->Shop_model->check_prod_id('', $user_id);
            $wishlist_count = COUNT($wishlist_count);
            $this->session->set_userdata('cart', $new_product);
            $cart_amount = COUNT($this->session->userdata('cart'));
            $cart_array = array(
                'messge' => 'Added to the cart!',
                'total_cart_prod' => $cart_amount,
                'total_wishlist_prod' => $wishlist_count);
            echo json_encode($cart_array);
        }

    }

}
