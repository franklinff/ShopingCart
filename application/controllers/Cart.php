<?php

class Cart extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Cart_model');
        $this->load->model('Shop_model');
        $this->load->model('User_addres_model');
        $this->load->model('My_orders_model');

        /*if (empty($this->session->userdata('user_login'))){      
           redirect(base_url() . 'User_login');
        }*/
    }

    /* index
     * Display products added to the cart.
     * @access public
     * @param null
     * @return view file
     */
    public function index() {
        $data = '';
        //echo '<pre>';        print_r($this->session->userdata());exit;
        $product_details = $this->session->userdata('cart'); 

        $login_info = $this->session->userdata('user_login');
        $data['user_id'] = $login_info[0]['id'];

        $wishlist_count = $this->Shop_model->check_prod_id('', $data['user_id']);
        $wishlist_count = COUNT($wishlist_count);
        $this->session->set_userdata('wishlist_count', $wishlist_count);

        if ($product_details) {

            $product_id = array_keys($product_details);
            $product_quantity = array();
        //     $this->db->select('product.id,product.name,product.is_featured,product.price,product.special_price,product.special_price_from,
        // product.special_price_to,(SELECT pm.image_name FROM product_images pm WHERE pm.product_id = product.id ORDER BY pm.id ASC LIMIT 1) AS image_name');

        // $this->db->from('product');
        // $this->db->where_in('product.id', $product_id);
        // $r = $this->db->get();

            $cart_products = $this->Cart_model->getAddedProducts($product_id);
            // $data['cart_products'] = $cart_products;
            print_r($cart_products);
            $i = 0;
            foreach ($cart_products as $cart_prod) {
                // $cart_prod = (array) $cart_prod;
                foreach ($product_details as $key => $quantity) {

                    if ($key == $cart_prod['id']) {
                        $cart_products[$i]['quantity'] = $quantity['quantity'];
                    }
                }
                foreach ($product_details as $key => $total_price) {
                    if ($key == $cart_prod['id']) {
                        $cart_products[$i]['total_price'] = $total_price['total_price'];
                    }
                }
                $i++;
            }
            
            $data['sub_total'] = array();
            foreach ($cart_products as $value) {
                $data['sub_total'][] = $value['total_price'];
            }
            $data['sub_total'] = array_sum($data['sub_total']);

            $this->session->set_userdata('checkout', $data['sub_total']);
            $data['discount'] = $this->session->userdata('coupon_id');
                        
            if ($this->session->has_userdata('coupon_id')) {
                $data['coupon_id'] = $this->session->userdata('coupon_id');
                $percent_off = $this->My_orders_model->getCouponDetails($data['coupon_id']);
                $percent_off = $percent_off[0]['percent_off'];
                $percent = $percent_off / 100;
                $discount = $percent * $data['sub_total'];
                $data['discount'] = $discount;
            }else{
                $data['discount'] = '';
            }

            if ($data['discount'] == '') {
                if ($data['sub_total'] < 500) {
                    $data['grand_total'] = $data['sub_total'] + 50;
                    $data['shipping_charges'] = '&#8377;50';
                    $this->session->set_userdata('grand_total',$data['grand_total']);
                    $this->session->set_userdata('shipping_charges',$data['shipping_charges']);
                } else {
                    $data['grand_total'] = $data['sub_total'];
                    $data['shipping_charges'] = 'FREE';
                    $this->session->set_userdata('grand_total',$data['grand_total']);
                    $this->session->set_userdata('shipping_charges',$data['shipping_charges']);
                }
            } else {
                $data['discount_price'] = $data['discount'];
                if ($data['sub_total'] < 500) {
                    $data['grand_total'] = $data['sub_total'] + 50;
                    $data['shipping_charges'] = '&#8377;50';
                    $this->session->set_userdata('grand_total',$data['grand_total']);
                    $this->session->set_userdata('shipping_charges',$data['shipping_charges']);
                } else {
                    $data['grand_total'] = $data['sub_total'] - $data['discount_price'];
                    $data['shipping_charges'] = 'FREE';
                    $this->session->set_userdata('grand_total',$data['grand_total']);
                    $this->session->set_userdata('shipping_charges',$data['shipping_charges']);
                }
            }        
            $data['countries'] = $this->User_addres_model->getCountries();
        }
        $data['cart_products']  = $cart_products;

        $this->load->view('frontend/header.php');
        $this->load->view('frontend/cart', $data);
        $this->load->view('frontend/footer');
    }


    /*
     * state
     * Sending state data. 
     * @access public
     * @param integer $country_id 
     * @return json
     */
    public function state($country_id) {
        $data['states'] = $this->User_addres_model->getStates($country_id);
        $states = '';
        foreach ($data['states'] as $value) {
            $states .= '<option value="' . $value['id'] . '">' . $value['name'] . '</option>';
        }
        echo json_encode(array('states' => $states));
    }


    /*
     * delete_cart_product
     * Delete cart data. 
     * @access public
     * @param integer $product_id 
     * @return json
     */
    public function deleteCartProduct($product_id) {
        $cart_product = $this->session->userdata('cart');
        $discount = $this->session->userdata('discount');
        if (array_key_exists($product_id, $cart_product)) {
            unset($cart_product[$product_id]);
        }
        
        $this->session->set_userdata('cart', $cart_product);
        $this->session->unset_userdata('shipping_charges');
        $this->session->unset_userdata('discount');
        $this->session->unset_userdata('coupon_id');

        $product_details = $this->session->userdata('cart');
        $sub_total = array();
        foreach ($product_details as $value) {
            $sub_total_prices[] = $value['total_price'];
        }

        $sub_total = array_sum($sub_total_prices);

        if (!empty($sub_total)) {
            if ($sub_total < 500) {
                $total = $sub_total + 50;
            } else {
                $total = $sub_total;
            }
        }

        $grand_total = $this->session->userdata('grand_total');
        $discount = $this->session->userdata('discount');

        if (!empty($discount['coupon_code'])) {
            $coupon_percent_off = $this->Cart_model->getcoupondata($discount['coupon_code']);
            $coupon_percent_off = $coupon_percent_off[0];
            $discount_price = $sub_total * $coupon_percent_off['percent_off'] / 100;
            $total = $sub_total - $discount_price;
            $cart_count = COUNT($this->session->userdata('cart'));
            $cart_price = array(
                'sub_total' => $sub_total,
                'discount_price' => $discount_price,
                'total' => $total,
                'cart_count' => $cart_count
            );
            $price = array();
            $price['discount_price'] = $cart_price['discount_price'];
            $price['discount_total'] = $cart_price['total'];
            $price['coupon_code'] = $discount['coupon_code'];
            $this->session->set_userdata('discount', $price);
        } else {

            $cart_count = COUNT($this->session->userdata('cart'));
            $cart_price = array(
                'sub_total' => $sub_total,
                'discount_price' => '0',
                'total' => $total,
                'cart_count' => $cart_count
            );
        }

        echo json_encode($cart_price);
    }

    /*
     * update_cart_quantity
     * Update cart data. 
     * @access public
     * @param integer $quantity 
     * @param integer $product_id 
     * @param integer $total_price 
     * @return null
     */
    public function updateCartQuantity($quantity, $product_id, $total_price) {
        $cart_product = $this->session->userdata('cart');
        $discount = $this->session->userdata('discount');

        if (array_key_exists($product_id, $cart_product)) {
            $cart_product[$product_id]['quantity'] = $quantity;
            $cart_product[$product_id]['total_price'] = $total_price;
        }
        $this->session->set_userdata('cart', $cart_product);
        $product_details = $this->session->userdata('cart');
        $sub_total = array();
        foreach ($product_details as $value) {
            $sub_total_prices[] = $value['total_price'];
        }
        
        $sub_total = array_sum($sub_total_prices);
        if (!empty($sub_total)) {
            if ($sub_total < 500) {
                $total = $sub_total + 50;
            } else {
                $total = $sub_total;
            }
        }

        $grand_total = $this->session->userdata('grand_total');
        $discount = $this->session->userdata('discount');

        if (!empty($discount['coupon_code'])) {
            $coupon_percent_off = $this->Cart_model->getcoupondata($discount['coupon_code']);
            $coupon_percent_off = $coupon_percent_off[0];
            $discount_price = $sub_total * $coupon_percent_off['percent_off'] / 100;
            $total = $sub_total - $discount_price;
            $cart_price = array(
                'sub_total' => $sub_total,
                'discount_price' => $discount_price,
                'total' => $total
            );
            $price = array();
            $price['discount_price'] = $cart_price['discount_price'];
            $price['discount_total'] = $cart_price['total'];
            $price['coupon_code'] = $discount['coupon_code'];
            $this->session->set_userdata('discount', $price);
        } else {
            $cart_price = array(
                'sub_total' => $sub_total,
                'total' => $total
            );
            $this->session->set_userdata('grand_total',$total);
        }

        echo json_encode($cart_price);
    }

    /*
     * coupon_code
     * Apply coupon code. 
     * @access public
     * @param alphanumeric $coupon_code 
     * @return json
     */
    public function couponCode($coupon_code) {
        if (!empty($coupon_code)) {
            $result = $this->Cart_model->getcoupondata($coupon_code);

            if ($result) {
                $coupon_id = $result[0]['id'];
                $data['no_of_uses'] = $result[0]['no_of_uses'];
                $no_of_uses = $this->Cart_model->coupon_uses($coupon_id);
                $no_of_uses = $no_of_uses[0]['coupon_count'];
                if ($no_of_uses < $data['no_of_uses']) {

                    $this->session->set_userdata('coupon_id', $result[0]['id']);  //coupon_id session is set.

                    $product_details = $this->session->userdata('cart');
                    $product_id = array_keys($product_details);
                    $product_quantity = array();
                    $data['cart_products'] = $this->Cart_model->getAddedProducts($product_id);

                    $i = 0;
                    foreach ($data['cart_products'] as $cart_prod) {
                        foreach ($product_details as $key => $quantity) {
                            if ($key == $cart_prod['id']) {
                                $data['cart_products'][$i]['quantity'] = $quantity['quantity'];
                            }
                        }
                        foreach ($product_details as $key => $total_price) {
                            if ($key == $cart_prod['id']) {
                                $data['cart_products'][$i]['total_price'] = $total_price['total_price'];
                            }
                        }
                        $i++;
                    }

                    $data['percent_off'] = $result[0]['percent_off'];

                    $data['total'] = array();
                    foreach ($data['cart_products'] as $value) {
                        $data['total'][] = $value['total_price'];
                    }

                    $data['total'] = array_sum($data['total']);
                    $percent = $data['percent_off'] / 100;
                    $discount_price = $data['total'] * $percent;
                    $discount_total = $data['total'] - $discount_price;
                    $price = array();
                    $price['discount_price'] = $discount_price;
                    $price['discount_total'] = $discount_total;
                    $price['coupon_code'] = $coupon_code;
                    if ($discount_total < 500) {
                        $discount_total = $discount_total + 50;
                        $this->session->set_userdata('grand_total', $discount_total);
                    }
                    $this->session->set_userdata('grand_total', $discount_total);
                    $this->session->set_userdata('discount', $price);
                    echo json_encode(array('discount_price' => $discount_price, 'discount_total' => $discount_total));
                }
            } else {
                echo json_encode(array('Please enter a valid coupon!'));
            }
        }
    }


    function test($product_id){
        $this->db->select('product.id,product.name,product.is_featured,product.price,product.special_price,product.special_price_from,
        product.special_price_to,(SELECT pm.image_name FROM product_images pm WHERE pm.product_id = product.id ORDER BY pm.id ASC LIMIT 1) AS image_name');

        $this->db->from('product');
        $this->db->where_in('product.id', $product_id);
        $r = $this->db->get();
        return $r->result_array();
    }
}