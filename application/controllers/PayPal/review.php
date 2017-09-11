<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title></title>
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
                foreach($cart['cart_products'] as $cart_item) {
                    ?>
                    <tr>
                        <td><?php echo $cart_item['id']; ?></td>
                        <td><?php echo $cart_item['name']; ?></td>
                        <td class="center"> &#8377;<?php 
                                    $curr_date = date('Y-m-d');
                                    if(($cart_item['special_price'] != '0.00') && ($curr_date > $cart_item['special_price_from']) && ($curr_date < $cart_item['special_price_to'])
                                                        || ($curr_date == $cart_item['special_price_from']) || ($curr_date == $cart_item['special_price_to'])){
                                        echo $cart_item['special_price']; 
                                    }else{
                                        echo $cart_item['price']; 
                                    }
                                    ?></td>
                        <td class="center"><?php echo $cart_item['quantity']; ?></td>
                        <td class="center"> &#8377;<?php echo $cart_item['total_price']; ?></td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
            <div class="row clearfix">
                <div class="col-md-4 column">
                    <p><strong>Billing Information</strong></p>
                    <p>
                        <?php
                        echo $cart['billing_address']['address_1'] . ',' . $cart['billing_address']['address_2'] .','. '<br />' .
                            $cart['billing_address']['ct_name'].','.$cart['billing_address']['st_name'].','.$cart['billing_address']['count_name'] . '<br />'.
                            $cart['billing_address']['zipcode'] . '<br />';
                        ?>
                    </p>
                </div>
                <div class="col-md-4 column">
                    <p><strong>Shipping Information</strong></p>
                    <p>
                        <?php
                        echo $cart['shipping_address']['address_1'] . ',' . $cart['shipping_address']['address_2'] .','. '<br />' .
                            $cart['shipping_address']['ct_name'].','.$cart['shipping_address']['st_name'].','.$cart['shipping_address']['count_name'] . '<br />'.
                            $cart['shipping_address']['zipcode'] . '<br />';
                        ?>
                    </p>
                </div>
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
                            <td class="center" colspan="2">
                                <a class="btn btn-primary btn-block" href="<?php echo site_url('paypal/demos/express_checkout/DoExpressCheckoutPayment'); ?>">Complete Order</a>
                            </td>
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