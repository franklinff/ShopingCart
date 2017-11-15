<?php

class Shop extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Shop_model');
        $this->load->model('Wishlist_model');
        $this->load->library('pagination');
    }

    /*
     * index
     * Display products.
     * @access public
     * @param null
     * @return view file
     */
    public function index() {

        if ($this->input->get('per_page')) {
            $page = ($this->input->get('per_page'));
        } else {
            $page = 0;
        }
      
        $login_info = $this->session->userdata('user_login');
        $data['user_id'] = $login_info[0]['id'];

/*      print_r($login_info);
        die();*/

        $data['categories'] = $this->Shop_model->getCategories();  
        $data['sub_categories'] = $this->Shop_model->getSub_categories();           

        if(!empty($this->session->userdata('user_login'))){
            $wishlist_count = $this->Shop_model->check_prod_id('', $data['user_id']);  
            $wishlist_count = COUNT($wishlist_count);
            $this->session->set_userdata('wishlist_count', $wishlist_count);
        }

        $arr_category = array();        //an array is defined
        
        foreach ($data['categories'] as $category) {
            $id = $category['id'];
            $arr_category[$id]['name'] = $category['name'];
            $arr_category[$id]['id'] = $category['id'];
            $arr_category[$id]['parent_id'] = 0;
            $cnt_subcategory = 0;

            foreach ($data['sub_categories'] as $sub_category) {
                $sub_id = $sub_category['id'];
                $arr_sub_category = array();        //an array is defined
                $arr_sub_category['name'] = $sub_category['name'];
                $arr_sub_category['id'] = $sub_category['id'];
                $arr_sub_category['parent_id'] = $sub_category['parent_id'];

                if ($id == $sub_category['parent_id']) {
                    $arr_category[$id]['sub_categories'][$cnt_subcategory] = $arr_sub_category;
                    $cnt_subcategory++;
                }
            }
        }

        $category_id = $this->input->get('category_id');  //category id is saved
        
        $data['prod_count'] = $this->Shop_model->getProdetails(true, '', '', $category_id, '', ''); //returns total no.(qty) of products 

        $config['per_page'] = 6;
        $config['base_url'] = base_url() . 'Shop' . $category_id;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $data['prod_count'][0]['prod_count'];
        $config['uri_segment'] = 5;
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';
        $this->pagination->initialize($config);           

        $data['products'] = $this->Shop_model->getProdetails(false, $config['per_page'], $page, $category_id, '', ''); //product details on a single page are returned

        //$data['banner_name'] = $this->Shop_model->getBanners(); //all banner content is returned

        $data['arr_category'] = $arr_category;

        $data['wishlist_products'] = $this->Wishlist_model->getAddedProducts($data['user_id']);  //product_id is returned of the whishlist
        
        $this->load->view('frontend/header.php');
        $this->load->view('frontend/shop', $data);
        $this->load->view('frontend/footer');
    }

    /*
     * add_to_cart
     * Add products to the cart.
     * @access public
     * @param $product_id
     * @param $price
     * @return json
     */
    public function addToCart($product_id, $price, $prod_quantity) {

        $prod_limit = $this->Shop_model->getProdQuantity($product_id); 
        $prod_limit = $prod_limit->product_quantity;  //total quantity of added items in cart are saved

        $product_quantity = $this->Shop_model->getProdById($product_id);  //individual product details are acheived
        $product_quantity = $product_quantity[0];

        if ($prod_limit < $product_quantity['quantity']) {
            
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
                    if ($prod_quantity == 1) {
                        $existing_cart_data[$product_id] = array(
                            'quantity' => '1',
                            'price' => $price,
                            'total_price' => $price
                        );
                    } else {
                        $total_price = $price * $prod_quantity;
                        $existing_cart_data[$product_id] = array(
                            'quantity' => $prod_quantity,
                            'price' => $price,
                            'total_price' => $total_price
                        );
                    }
                    $this->session->set_userdata('cart', $existing_cart_data);

                    $cart_amount = COUNT($this->session->userdata('cart')); //total count of the items in cart

                    $cart_array = array(
                        'messge' => 'Added to the cart!',
                        'total_cart_prod' => $cart_amount);

                    echo json_encode($cart_array);
                } else {

                    if ($prod_quantity == 1) {
                        foreach ($existing_cart_data as $key => $value) {
                            if ($key == $product_id) {
                                $existing_cart_data[$key]['quantity'] = $value['quantity'] + 1;
                                $existing_cart_data[$key]['total_price'] = $price * $existing_cart_data[$key]['quantity'];
                                break;
                            }
                        }
                    } else {
                        foreach ($existing_cart_data as $key => $value) {
                            if ($key == $product_id) {
                                if ($value['quantity'] == $prod_quantity) {
                                    $prod_quantity++;
                                }
                                $price = $price * $prod_quantity;
                                $existing_cart_data[$key]['quantity'] = $prod_quantity;
                                $existing_cart_data[$key]['total_price'] = $price;
                                break;
                            }
                        }
                    }
                    $this->session->set_userdata('cart', $existing_cart_data);
                    $cart_amount = COUNT($this->session->cart);
                    $cart_array = array(
                        'messge' => 'Product Quantity Updated!',
                        'total_cart_prod' => $cart_amount);

                    echo json_encode($cart_array);
                }
            } else {
                $total_price = $price * $prod_quantity;
                if ($prod_quantity == 1) {

                    $new_product[$product_id] = array(
                        'quantity' => '1',
                        'price' => $price,
                        'total_price' => $total_price
                    );
                } else {

                    $total_price = $price * $prod_quantity;
                    $new_product[$product_id] = array(
                        'quantity' => $prod_quantity,
                        'price' => $price,
                        'total_price' => $total_price
                    );
                }
                $this->session->set_userdata('cart', $new_product);
                $cart_amount = COUNT($this->session->userdata('cart'));
                $cart_array = array(
                    'messge' => 'Added to the cart!',
                    'total_cart_prod' => $cart_amount);
                echo json_encode($cart_array);
            }
        } else {
            $cart_amount = COUNT($this->session->userdata('cart'));
            $cart_array = array(
                'messge' => 'Product out of stock!',
                'total_cart_prod' => $cart_amount);
            echo json_encode($cart_array);
        }
    }

    /*
     * add_to_wishlist
     * Add products to the wishlist.
     * @access public
     * @param $product_id
     * @return json
     */
     public function addToWishlist($product_id){

        if (empty($this->session->userdata('user_login')) && empty($this->session->userdata('gmail_data'))) {
            redirect(base_url().'UserLogin');
        } else {
            $data['product_id'] = $product_id;

            $user_login_details = $this->session->userdata('user_login');
            $data['user_id'] = $user_login_details[0]['id'];

            $result_check_product_id = $this->Shop_model->check_prod_id($data['product_id'], $data['user_id']);
            $wishlist_count = $this->Shop_model->check_prod_id('', $data['user_id']);
            $wishlist_count = COUNT($wishlist_count);
            $this->session->set_userdata('wishlist_count', $wishlist_count);

            if ($result_check_product_id) {                                         //Add to wishlist
                $result = $this->Wishlist_model->delete($product_id);
                $wishlist_count--; 
                $this->session->set_userdata('wishlist_count', $wishlist_count);
                $wishlist = array(
                    'quantity' => $wishlist_count,
                    'message' => '<i class="fa fa-plus-square"></i>Add to wishlist',
                );
                echo json_encode($wishlist);
            } else {                                                                 //Remove from wishlist
                $result = $this->Shop_model->insert($data);
                if ($result) {
                    $wishlist_count++;
                    $this->session->set_userdata('wishlist_count', $wishlist_count);
                    $wishlist = array(
                        'quantity' => $wishlist_count,
                        'message' => '<i class="fa fa-minus-square"></i>Remove from wishlist',
                    );
                echo json_encode($wishlist);
                }
            }
        }
    }



}

