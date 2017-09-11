<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Angell EYE - PayPal CodeIgniter Library Demo - Express Checkout - Basic</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Angell EYE">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <style>
        #angelleye-logo { margin:10px 0; }
        thead th { background: #F4F4F4;  }
        th.center {
            text-align:center;
        }
        td.center{
            text-align:center;
        }
        #paypal_errors {
            margin-top:25px;
        }
        .general_message {
            margin: 20px 0 20px 0;
        }
        #angelleye-demo-digital-goods-success-msg {
            display:none;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row clearfix">
        <div class="col-md-12 column">
            <div id="header" class="row clearfix">
                <div class="col-md-6 column">
                    <div id="angelleye-logo">
                        <!--<a href="<?php echo base_url('paypal/demos/intro');?>"><img class="img-responsive" alt="Angell EYE PayPal CodeIgniter Library Demo" src="https://www.angelleye.com/images/paypal-codeigniter-library-demo-header.png"></a>-->
                    </div>
                </div>
            </div>
            <!--<h2 align="center">Express Checkout - Basic</h2>-->
<!--            <div class="alert alert-info">
                <p>Here we are using a basic shopping cart for display purposes, however, for this basic demo, all we are sending to PayPal is the order total without any line item details. We are assuming that we have not collected any billing or shipping information from the buyer yet because we'll be obtaining those details from PayPal after the user logs in and is returned back to the site.</p>
            </div>
            <div class="alert alert-info">
                <p>
                    To complete the demo, click the Checkout with PayPal button and use the following credentials to login to PayPal.<br /><br />
                Email Address:  paypalphp@angelleye.com<br />
                Password:  paypalphp
                </p>
            </div>-->
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th class="center">Price</th>
                    <th class="center">QTY</th>
                    <th class="center">Total</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach($cart_products as $cart_item) {
                    ?>
                    <tr>
                        <td><?php echo $cart_item['id']; ?></td>
                        <td><?php echo $cart_item['name']; ?></td>
                        <td class="center">&#8377;<?php echo $cart_item['price']; ?></td>
                        <td class="center"><?php echo $cart_item['quantity']; ?></td>
                        <td class="center"> &#8377;<?php echo $cart_item['total_price']; ?></td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
            <div class="row clearfix">
                <div class="col-md-4 column"> </div>
                <div class="col-md-4 column"> </div>
                <div class="col-md-4 column">
                    <table class="table">
                        <tbody>
                        <tr>
                            <td><strong> Subtotal</strong></td>
                            <td><span>&#8377;<?php
                                        if (!empty($cart_products)) {
                                            echo $total;
                                        } else {
                                            echo '0';
                                        }
                                        ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Shipping</strong></td>
                            <td><span><?php 
                                        if(!empty($total)){
                                        if($total < 500){ ?>
                                        &#8377;50
                                       <?php }else{
                                            echo 'FREE';
                                        } }else{
                                            echo'FREE';
                                        } ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Discount price</strong></td>
                            <td><span>&#8377;
                                        <?php 
                                        if(!empty($discount)){?>
                                        <?php   
                                            echo $discount['discount_price']; 
                                        } else {
                                            echo '0';
                                        }

                                        ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Grand Total</strong></td>
                            <td><span>&#8377;<?php
                                                if(!empty($discount)){
                                                    if($discount['discount_total'] < 500){
                                                        $discount['discount_total'] = $discount['discount_total'] + 50;
                                                        echo $discount['discount_total'];
                                                    }else{
                                                        echo $discount['discount_total'];
                                                    }
                                                }else{
                                                    if(!empty($total)){
                                                        if($total < 500){
                                                            $total = $total+50;
                                                            echo $total;
                                                        }else{
                                                            echo $total;
                                                        }
                                                    }else{
                                                        echo '0';
                                                    }
                                                }

                                            ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="center" colspan="2"><a href="<?php echo site_url('index.php/paypal/demos/express_checkout/SetExpressCheckout'); ?>"><img src="https://www.paypal.com/en_US/i/btn/btn_xpressCheckout.gif"></a></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>


