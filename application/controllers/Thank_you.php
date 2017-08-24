<?php
class Thank_you extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form','url'));
        $this->load->model('Checkout_model');
        $this->load->model('Cart_model');
        $this->load->model('User_addres_model');
        $this->load->model('My_orders_model');

     /*   if (!$this->session->userdata('  ')) {
            redirect('index.php/login');
        }*/
    }



    public function index()
    {
        $session_data = $this->session->user_login;

      	if (!empty($session_data)) {

      		$product_details = $this->session->cart;
      		 if ($product_details) {
      		 	    $product_id = array_keys($product_details);
         			$data['cart_products'] = $this->Cart_model->getAddedProducts($product_id);
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
			}
	        $this->load->view('frontend/header.php');
	        $this->load->view('frontend/thank_you', $data);
	        $this->load->view('frontend/footer');
                
        }
        else
        {
       	redirect('index.php/user_login');
        }

    }

}
