<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Express_checkout extends CI_Controller {

    function __construct() {

        parent::__construct();
        //$this->load->helper('url'); //$this->load->library('session'); //$this->load->library('email');
        $this->load->model('checkout_model', 'checkout');
        $this->load->model('cart_model', 'cart');
        $this->load->model('user_addres_model', 'user_address');
        $this->load->model('User_login_model', 'user_login');           
        if (empty($this->session->userdata('user_login'))) {
            redirect('User_login');
        }

        // Load PayPal library config
        $this->config->load('paypal');
        $config = array(
            'Sandbox' => $this->config->item('Sandbox'), // Sandbox / testing mode option.
            'APIUsername' => $this->config->item('APIUsername'), // PayPal API username of the API caller
            'APIPassword' => $this->config->item('APIPassword'), // PayPal API password of the API caller
            'APISignature' => $this->config->item('APISignature'), // PayPal API signature of the API caller
            'APISubject' => '', // PayPal API subject (email address of 3rd party user that has granted API permission for your app)
            'APIVersion' => $this->config->item('APIVersion'), // API version you'd like to use for your call.  You can set a default version in the class and leave this blank if you want.
            'DeviceID' => $this->config->item('DeviceID'),
            'ApplicationID' => $this->config->item('ApplicationID'),
            'DeveloperEmailAccount' => $this->config->item('DeveloperEmailAccount')
        );
        // Show Errors
        if ($config['Sandbox']) {
            error_reporting(E_ALL);
            ini_set('display_errors', '1');
        }
        // Load PayPal library
        $this->load->library('paypal/paypal_pro', $config);
    }

    /*
    Cart Review page
    */
    function index() {
        $data = '';
        $product_details = $this->session->userdata('cart');
        $total = $this->session->userdata('checkout');
        $order_id = $this->session->userdata('last_id');

        if ($product_details) {
            $product_id = array_keys($product_details);
            $product_quantity = array();
            $data['cart_products'] = $this->cart->getAddedProducts($product_id);
            $data['cart_product_price'] = $this->cart->getPrice($product_id,$order_id);

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
            
            foreach ($data['cart_product_price'] as $key => $value) {
                $data['cart_products'][$key]['base_price'] = $value['base_price'];
            }

            $data['total'] = array();
            foreach ($data['cart_products'] as $value) {
                $data['total'][] = $value['total_price'];
            }
            $data['total'] = array_sum($data['total']);

            $data['discount'] = $this->session->userdata('discount');

            $user_info = $this->session->userdata('user_login');
            $user_id = $user_info[0]['id'];

            $data['user_address'] = $this->checkout->getUserAddress($user_id);
            $this->session->set_userdata('shopping_cart', $data);
        }
        $this->load->view('frontend/header');
        $this->load->view('frontend/paypal_index', $data);
        $this->load->view('frontend/footer');
    }

    /*
     * SetExpressCheckout
     */
    function SetExpressCheckout() {
        // Clear PayPalResult from session userdata
        $this->session->unset_userdata('PayPalResult');

        // Get cart data from session userdata
        $cart = $this->session->userdata('shopping_cart');
        $cart['grand_total'] = $this->session->userdata('grand_total');
        $cart['billing_address'] = $this->session->userdata('billing_address');
        $cart['shipping_address'] = $this->session->userdata('shipping_address');
        /*
         * Here we are setting up the parameters for a basic Express Checkout flow.
         * The template provided at /vendor/angelleye/paypal-php-library/templates/SetExpressCheckout.php
         * contains a lot more parameters that we aren't using here, so I've removed them to keep this clean.
         * $domain used here is set in the config file.
         */
        $SECFields = array(
            'maxamt' => $cart['grand_total'], // The expected maximum total amount the order will be, including S&H and sales tax.
            'returnurl' => site_url('index.php/paypal/demos/express_checkout/GetExpressCheckoutDetails'), // Required.  URL to which the customer will be returned after returning from PayPal.  2048 char max.
            'cancelurl' => site_url('index.php/paypal/demos/express_checkout/OrderCancelled'), // Required.  URL to which the customer will be returned if they cancel payment on PayPal's site.
            'hdrimg' => 'https://www.angelleye.com/images/angelleye-paypal-header-750x90.jpg', // URL for the image displayed as the header during checkout.  Max size of 750x90.  Should be stored on an https:// server or you'll get a warning message in the browser.
            'logoimg' => 'https://www.angellesye.com/images/angelleye-logo-190x60.jpg', // A URL to your logo image.  Formats:  .gif, .jpg, .png.  190x60.  PayPal places your logo image at the top of the cart review area.  This logo needs to be stored on a https:// server.
            'brandname' => 'Angell EYE', // A label that overrides the business name in the PayPal account on the PayPal hosted checkout pages.  127 char max.
            'customerservicenumber' => '816-555-5555', // Merchant Customer Service number displayed on the PayPal Review page. 16 char max.
        );
        /*
         * Now we begin setting up our payment(s).
         * Express Checkout includes the ability to setup parallel payments,
         * so we have to populate our $Payments array here accordingly.
         * For this sample (and in most use cases) we only need a single payment,
         * but we still have to populate $Payments with a single $Payment array.
         * Once again, the template file includes a lot more available parameters,
         * but for this basic sample we've removed everything that we're not using,
         * so all we have is an amount.
         */
        $Payments = array();
        $Payment = array(
        'amt' => $cart['grand_total'] );//Required.The total cost of the transaction to the customer.  If shipping cost and tax charges are known,include them in this value.If not, this value should be the current sub-total of the order.
        
        /*
         * Here we push our single $Payment into our $Payments array.
         */
        array_push($Payments, $Payment);

        /*
         * Now we gather all of the arrays above into a single array.
         */
        $PayPalRequestData = array(
            'SECFields' => $SECFields,
            'Payments' => $Payments,
        );
        /*
         * Here we are making the call to the SetExpressCheckout function in the library,
         * and we're passing in our $PayPalRequestData that we just set above.
         */
        $PayPalResult = $this->paypal_pro->SetExpressCheckout($PayPalRequestData);
        /*
         * Now we'll check for any errors returned by PayPal, and if we get an error,
         * we'll save the error details to a session and redirect the user to an
         * error page to display it accordingly.
         * If all goes well, we save our token in a session variable so that it's
         * readily available for us later, and then redirect the user to PayPal
         * using the REDIRECTURL returned by the SetExpressCheckout() function.
         */
        if (!$this->paypal_pro->APICallSuccessful($PayPalResult['ACK'])) {
            $errors = array('Errors' => $PayPalResult['ERRORS']);
            // Load errors to variable
            $this->load->vars('errors', $errors);
            $this->load->view('paypal/demos/express_checkout/paypal_error');
        } else {
            // Successful call.
            //print_r($PayPalResult);exit;
            // Set PayPalResult into session userdata (so we can grab data from it later on a 'payment complete' page)
            $this->session->set_userdata('PayPalResult', $PayPalResult);
            // In most cases you would automatically redirect to the returned 'RedirectURL' by using: redirect($PayPalResult['REDIRECTURL'],'Location');
            // Move to PayPal checkout
            redirect($PayPalResult['REDIRECTURL'], 'Location');
        }
    }

    /*
     * GetExpressCheckoutDetails
     */
    function GetExpressCheckoutDetails() {
        // Get cart data from session userdata
        $cart = $this->session->userdata('shopping_cart');
        $cart['grand_total'] = $this->session->userdata('grand_total');
        $cart['billing_address'] = $this->session->userdata('billing_address');
        $cart['shipping_address'] = $this->session->userdata('shipping_address');

        if ($cart['total'] > 500) {
            $cart['shipping_charges'] = 0;
        } else {
            $cart['shipping_charges'] = 50;
        }
        //echo '<pre>'; //print_r($cart);exit;      
        // Get PayPal data from session userdata
        $SetExpressCheckoutPayPalResult = $this->session->userdata('PayPalResult');

        $PayPal_Token = $SetExpressCheckoutPayPalResult['TOKEN'];
        /*
         * Now we pass the PayPal token that we saved to a session variable
         * in the SetExpressCheckout.php file into the GetExpressCheckoutDetails
         * request.
         */
        $PayPalResult = $this->paypal_pro->GetExpressCheckoutDetails($PayPal_Token);

        /*
         * Now we'll check for any errors returned by PayPal, and if we get an error,
         * we'll save the error details to a session and redirect the user to an
         * error page to display it accordingly.
         * If the call is successful, we'll save some data we might want to use
         * later into session variables.
         */
        //print_r($PayPalResult);exit;

        if (!$this->paypal_pro->APICallSuccessful($PayPalResult['ACK'])) {
            $errors = array('Errors' => $PayPalResult['ERRORS']);
            // Load errors to variable
            $this->load->vars('errors', $errors);
            $this->load->view('paypal/demos/express_checkout/paypal_error');
        } else {

            // Successful call.
            /*
             * Here we'll pull out data from the PayPal response.
             * Refer to the PayPal API Reference for all of the variables available
             * in $PayPalResult['variablename']
             * https://developer.paypal.com/docs/classic/api/merchant/GetExpressCheckoutDetails_API_Operation_NVP/
             * Again, Express Checkout allows for parallel payments, so what we're doing here
             * is usually the library to parse out the individual payments using the GetPayments()
             * method so that we can easily access the data.
             * We only have a single payment here, which will be the case with most checkouts,
             * but we will still loop through the $Payments array returned by the library
             * to grab our data accordingly.
             */
            $cart['paypal_payer_id'] = isset($PayPalResult['PAYERID']) ? $PayPalResult['PAYERID'] : '';
            $cart['phone_number'] = isset($PayPalResult['PHONENUM']) ? $PayPalResult['PHONENUM'] : '';
            $cart['email'] = isset($PayPalResult['EMAIL']) ? $PayPalResult['EMAIL'] : '';
            $cart['first_name'] = isset($PayPalResult['FIRSTNAME']) ? $PayPalResult['FIRSTNAME'] : '';
            $cart['last_name'] = isset($PayPalResult['LASTNAME']) ? $PayPalResult['LASTNAME'] : '';

            foreach ($PayPalResult['PAYMENTS'] as $payment) {
                $cart['shipping_name'] = isset($payment['SHIPTONAME']) ? $payment['SHIPTONAME'] : '';
                $cart['shipping_street'] = isset($payment['SHIPTOSTREET']) ? $payment['SHIPTOSTREET'] : '';
                $cart['shipping_city'] = isset($payment['SHIPTOCITY']) ? $payment['SHIPTOCITY'] : '';
                $cart['shipping_state'] = isset($payment['SHIPTOSTATE']) ? $payment['SHIPTOSTATE'] : '';
                $cart['shipping_zip'] = isset($payment['SHIPTOZIP']) ? $payment['SHIPTOZIP'] : '';
                $cart['shipping_country_code'] = isset($payment['SHIPTOCOUNTRYCODE']) ? $payment['SHIPTOCOUNTRYCODE'] : '';
                $cart['shipping_country_name'] = isset($payment['SHIPTOCOUNTRYNAME']) ? $payment['SHIPTOCOUNTRYNAME'] : '';
            }
            /**
             * At this point, we now have the buyer's shipping address available in our app.
             * We could now run the data through a shipping calculator to retrieve rate
             * information for this particular order.
             * This would also be the time to calculate any sales tax you may need to
             * add to the order, as well as handling fees.
             * We're going to set static values for these things in our static
             * shopping cart, and then re-calculate our grand total.
             */
//			$cart['shopping_cart']['shipping'] = 10.00;
//			$cart['shopping_cart']['handling'] = 2.50;
//			$cart['shopping_cart']['tax'] = 1.50;
//			$cart['shopping_cart']['grand_total'] = number_format(
//				$cart['shopping_cart']['subtotal']
//				+ $cart['shopping_cart']['shipping']
//				+ $cart['shopping_cart']['handling']
//				+ $cart['shopping_cart']['tax'],2);

            /*
             * Now we will redirect the user to a final review
             * page so they can see the shipping/handling/tax
             * that has been added to the order.
             */
            // Set example cart data into session
            $this->session->set_userdata('shopping_cart', $cart);
//print_r($cart);exit;
// Load example cart data to variable
            $this->load->vars('cart', $cart);
            // Example - Load Review Page
            $this->load->view('frontend/header');
            $this->load->view('paypal/demos/express_checkout/review', $cart);
            $this->load->view('frontend/footer');
        }
    }

    /**
     * DoExpressCheckoutPayment
     */
    function DoExpressCheckoutPayment() {
        /*
         * Now we'll setup the request params for the final call in the Express Checkout flow.
         * This is very similar to SetExpressCheckout except that now we can include values
         * for the shipping, handling, and tax amounts, as well as the buyer's name and
         * shipping address that we obtained in the GetExpressCheckoutDetails step.
         *
         * If this information is not included in this final call, it will not be
         * available in PayPal's transaction details data.
         *
         * Once again, the template for DoExpressCheckoutPayment provides
         * many more params that are available, but we've stripped everything
         * we are not using in this basic demo out.
         */
        // Get cart data from session userdata
        $cart = $this->session->userdata('shopping_cart');

        $cart['last_id'] = $this->session->userdata('last_id');

        if ($cart['total'] > 500) {
            $cart['shipping_charges'] = 0;
        } else {
            $cart['shipping_charges'] = 50;
        }
        // Get cart data from session userdata
        $SetExpressCheckoutPayPalResult = $this->session->userdata('PayPalResult');
        $PayPal_Token = $SetExpressCheckoutPayPalResult['TOKEN'];

        $DECPFields = array(
            'token' => $PayPal_Token, // Required.  A timestamped token, the value of which was returned by a previous SetExpressCheckout call.
            'payerid' => $cart['paypal_payer_id'], // Required.  Unique PayPal customer id of the payer.  Returned by GetExpressCheckoutDetails, or if you used SKIPDETAILS it's returned in the URL back to your RETURNURL.
        );

        /*
         * Just like with SetExpressCheckout, we need to gather our $Payment
         * data to pass into our $Payments array.  This time we can include
         * the shipping, handling, tax, and shipping address details that we
         * now have.
         */
        $Payments = array();
        if (!empty($cart['discount'])) {
            $Payment = array(
                'amt' => $cart['grand_total'], // Required.  The total cost of the transaction to the customer.  If shipping cost and tax charges are known, include them in this value.  If not, this value should be the current sub-total of the order.
                'itemamt' => $cart['discount']['discount_total'], // Subtotal of items only.
                'currencycode' => 'USD', // A three-character currency code.  Default is USD.
                'shippingamt' => $cart['shipping_charges'], // Total shipping costs for this order.  If you specify SHIPPINGAMT you mut also specify a value for ITEMAMT.
                'shiptoname' => $cart['shipping_name'], // Required if shipping is included.  Person's name associated with this address.  32 char max.
                'shiptostreet' => $cart['shipping_street'], // Required if shipping is included.  First street address.  100 char max.
                'shiptocity' => $cart['shipping_city'], // Required if shipping is included.  Name of city.  40 char max.
                'shiptostate' => $cart['shipping_state'], // Required if shipping is included.  Name of state or province.  40 char max.
                'shiptozip' => $cart['shipping_zip'], // Required if shipping is included.  Postal code of shipping address.  20 char max.
                'shiptocountrycode' => $cart['shipping_country_code'], // Required if shipping is included.  Country code of shipping address.  2 char max.
                'shiptophonenum' => $cart['phone_number'], // Phone number for shipping address.  20 char max.
                'paymentaction' => 'Sale', // How you want to obtain the payment.  When implementing parallel payments, this field is required and must be set to Order.
            );
        } else {
            $Payment = array(
                'amt' => $cart['grand_total'], // Required.The total cost of the transaction to the customer.  If shipping cost and tax charges are known, include them in this value.  If not, this value should be the current sub-total of the order.
                'itemamt' => $cart['total'], // Subtotal of items only.
                'currencycode' => 'USD', // A three-character currency code.  Default is USD.
                'shippingamt' => $cart['shipping_charges'], // Total shipping costs for this order.  If you specify SHIPPINGAMT you mut also specify a value for ITEMAMT.
                'shiptoname' => $cart['shipping_name'], // Required if shipping is included.  Person's name associated with this address.  32 char max.
                'shiptostreet' => $cart['shipping_street'], // Required if shipping is included.  First street address.  100 char max.
                'shiptocity' => $cart['shipping_city'], // Required if shipping is included.  Name of city.  40 char max.
                'shiptostate' => $cart['shipping_state'], // Required if shipping is included.  Name of state or province.  40 char max.
                'shiptozip' => $cart['shipping_zip'], // Required if shipping is included.  Postal code of shipping address.  20 char max.
                'shiptocountrycode' => $cart['shipping_country_code'], // Required if shipping is included.  Country code of shipping address.  2 char max.
                'shiptophonenum' => $cart['phone_number'], // Phone number for shipping address.  20 char max.
                'paymentaction' => 'Sale', // How you want to obtain the payment.  When implementing parallel payments, this field is required and must be set to Order.
            );
        }
        /*
         * Here we push our single $Payment into our $Payments array.
         */
        array_push($Payments, $Payment);
        /**
         * Now we gather all of the arrays above into a single array.
         */
        $PayPalRequestData = array(
            'DECPFields' => $DECPFields,
            'Payments' => $Payments,
        );
        /*
         * Here we are making the call to the DoExpressCheckoutPayment function in the library,
         * and we're passing in our $PayPalRequestData that we just set above.
         */
        $PayPalResult = $this->paypal_pro->DoExpressCheckoutPayment($PayPalRequestData);

        $reslt = $this->checkout->update_trans_id($PayPalResult['PAYMENTS'][0]['TRANSACTIONID'], $cart['last_id']);
        //Undefined offset: 0 [need to rectify the error]

        /*
         * Now we'll check for any errors returned by PayPal, and if we get an error,
         * we'll save the error details to a session and redirect the user to an
         * error page to display it accordingly.
         *
         * If the call is successful, we'll save some data we might want to use
         * later into session variables, and then redirect to our final
         * thank you / receipt page.
         */
        if (!$this->paypal_pro->APICallSuccessful($PayPalResult['ACK'])) {
            $errors = array('Errors' => $PayPalResult['ERRORS']);

            // Load errors to variable
            $this->load->vars('errors', $errors);

            $this->load->view('paypal/demos/express_checkout/paypal_error');
        } else {
            // Successful call.
            /**
             * Once again, since Express Checkout allows for multiple payments in a single transaction,
             * the DoExpressCheckoutPayment response is setup to provide data for each potential payment.
             * As such, we need to loop through all the payment info in the response.
             *
             * The library helps us do this using the GetExpressCheckoutPaymentInfo() method.  We'll
             * load our $payments_info using that method, and then loop through the results to pull
             * out our details for the transaction.
             *
             * Again, in this case we are you only working with a single payment, but we'll still
             * loop through the results accordingly.
             *
             * Here, we're only pulling out the PayPal transaction ID and fee amount, but you may
             * refer to the API reference for all the additional parameters you have available at
             * this point.
             *
             * https://developer.paypal.com/docs/classic/api/merchant/DoExpressCheckoutPayment_API_Operation_NVP/
             */
            foreach ($PayPalResult['PAYMENTS'] as $payment) {
                $cart['paypal_transaction_id'] = isset($payment['TRANSACTIONID']) ? $payment['TRANSACTIONID'] : '';
                $cart['paypal_fee'] = isset($payment['FEEAMT']) ? $payment['FEEAMT'] : '';
            }

            // Set example cart data into session
            $this->session->set_userdata('shopping_cart', $cart);
            $coupon_used = array();
            $coupon_used['coupon_id'] = $this->session->userdata('coupon_id');
            $login_info = $this->session->userdata('user_login');
            $coupon_used['user_id'] = $login_info[0]['id'];
            $coupon_used['order_id'] = $this->session->userdata('last_id');
            //echo '<pre>';
            //print_r($this->session->userdata());exit;
            if ($coupon_used['coupon_id'] != '') {
                $coupon_used_insert = $this->checkout->insert_coupon_used($coupon_used);
            }
            // Successful Order
            redirect('index.php/paypal/demos/express_checkout/OrderComplete');
        }
    }

    /**
     * Order Complete - Pay Return Url
     */
    function OrderComplete() {
        // Get cart from session userdata
        $cart = $this->session->userdata('shopping_cart');
        $cart['grand_total'] = $this->session->userdata('grand_total');
        $cart['billing_address'] = $this->session->userdata('billing_address');
        $cart['shipping_address'] = $this->session->userdata('shipping_address');
        $cart['order_id'] = $this->session->userdata('last_id');
        $cart['email'] = $this->session->userdata('email');
        $cart['sub_total'] = $cart['total'];  

        $curr_date = date('Y-m-d');

        $order_details_template = '';

        foreach ($cart['cart_products'] as $cart_item) {
            if (($cart_item['special_price'] != '0.00') && ($curr_date > $cart_item['special_price_from']) && ($curr_date < $cart_item['special_price_to']) || ($curr_date == $cart_item['special_price_from']) || ($curr_date == $cart_item['special_price_to'])) {
                $cart_item['price'] = $cart_item['special_price'];
            } else {
                $cart_item['price'] = $cart_item['price'];
            }
            $order_details_template .= '<tr><td>' . $cart_item['id'] . '</td><td>' . $cart_item['name'] .
                    '</td><td>' . $cart_item['price'] . '</td><td>' . $cart_item['quantity'] . '</td><td>' . $cart_item['total_price'] .
                    '</td></tr>';
        }

        $cart['billing_information'] = $cart['billing_address']['address_1'] . ',' . $cart['billing_address']['address_2'] . ',' . '<br />' .
                $cart['billing_address']['ct_name'] . ',' . $cart['billing_address']['st_name'] . ',' . $cart['billing_address']['count_name'] . '<br />' .
                $cart['billing_address']['zipcode'] . '<br />';

        $cart['shipping_information'] = $cart['shipping_address']['address_1'] . ',' . $cart['shipping_address']['address_2'] . ',' . '<br />' .
                $cart['shipping_address']['ct_name'] . ',' . $cart['shipping_address']['st_name'] . ',' . $cart['shipping_address']['count_name'] . '<br />' .
                $cart['shipping_address']['zipcode'] . '<br />';

        $cart['order_details_template'] = $order_details_template;

        if (!empty($cart['total'])) {
            if ($cart['total'] < 500) {
                $cart['shipping_charges'] = 50;
            } else {
                $cart['shipping_charges'] = 'FREE';
            }
        } else {
            $cart['shipping_charges'] = 'FREE';
        }

        if (!empty($cart['discount'])) {
            $cart['discount_price'] = $cart['discount']['discount_price'];
        } else {
            $cart['discount_price'] = 0;
        }

        if (!empty($cart['discount'])) {
            if ($cart['discount']['discount_total'] < 500) {
                $cart['discount']['discount_total'] = $cart['discount']['discount_total'] + 50;
                $cart['grand_temp_total'] = $cart['discount']['discount_total'];
            } else {
                $cart['grand_temp_total'] = $cart['discount']['discount_total'];
            }
        } else {
            if (!empty($cart['total'])) {
                if ($cart['total'] < 500) {
                    $cart['total'] = $cart['total'] + 50;
                    $cart['grand_temp_total'] = $cart['total'];
                } else {
                    $cart['grand_temp_total'] = $cart['total'];
                }
            } else {
                $cart['grand_temp_total'] = '0';
            }
        }

        /*$title = 'payment_template';
        $email_template_data = $this->user_login->getEmailTemplate($title);
        $email_template_data = $email_template_data[0];

        if ($cart['order_details_template'] != '') {
            $template1 = $this->parser->parse('payment_template', $cart);
        }

        $config = Array(
                        'protocol' => 'smtp',
                        'smtp_host' => 'smtp.wwindia.com',
                        'smtp_port' => 25,
                        'smtp_user' => 'rashmi.nalwaya@wwindia.com', 
                        'smtp_pass' => 'RashmI123', 
                        'mailtype' => 'html',
                        'charset' => 'utf-8',
                        'wordwrap' => TRUE,
                        'newline' =>'\r\n'
                        );

        $this->email->initialize($config);
        $this->load->library('email', $config);

        $this->email->from('franklinfargoj1991@gmail.com');
        $this->email->to($cart['email']);  // Mail to admin
        $this->email->subject('Order Details');
        $this->email->message($template1);
        $this->email->send();

        $this->email->from('franklinfargoj1991@gmail.com');
        $this->email->to(ADMIN_EMAIL);  // Mail to admin
        $this->email->subject('Order Details');
        $this->email->message($template1);
        $this->email->send();*/

        if ($cart['total'] > 500) {
            $cart['shipping_charges'] = '0';
        } else {
            $cart['shipping_charges'] = '&#8377;50';
        }
        if (empty($cart))
            redirect(base_url() . 'shop');

        $unset_data = array('cart', 'discount', 'coupon_id', 'checkout', 'checkout', 'last_id', 'billing_address', 'shipping_address',
            'grand_total','shipping_charges', 'shopping_cart', 'PayPalResult');
        $this->session->unset_userdata($unset_data);
        $order_id = $cart['order_id'];

        // Successful call.  Load view or whatever you need to do here.
        redirect(base_url() . 'index.php/payment_complete/index/' . $order_id);               
        //$this->session->unset_userdata('cart');
    }

    /*
     * Order Cancelled - Pay Cancel Url
     */
    function OrderCancelled() {
        // Clear PayPalResult from session userdata
        $this->session->unset_userdata('PayPalResult');
        // Clear cart from session userdata
        $this->session->unset_userdata('shopping_cart');
        // Successful call.  Load view or whatever you need to do here.
        $this->load->view('index.php/paypal/demos/express_checkout/order_cancelled');
    }

}
