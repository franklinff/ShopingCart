<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>E-shopper-Payment Complete</title>
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

            <h2 align="center">Payment Complete</h2>            
            <div>
                <p>Thank you for shopping,we will be processing your order.</p>
                <p>Your order id is: <strong><?php echo $order_id; ?></strong></p>
            </div>
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
                foreach($order_details as $cart_item) {
                    ?>
                    <tr>
                        <td><?php echo $cart_item['id']; ?></td>
                        <td><?php echo $cart_item['name']; ?></td>
                        <td class="center"> &#8377;<?php echo $cart_item['base_price']; ?></td>
                        <td class="center"><?php echo $cart_item['quantity']; ?></td>
                        <td class="center"> &#8377;<?php echo $cart_item['amount']; ?></td>
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
                        echo $billing_address['billing_address_1'] . ',' . $billing_address['billing_address_2'] .','. '<br />' .
                            $billing_address['billing_city'].','.$billing_address['billing_starte'].','.$billing_address['billing_country'] . '<br />'.
                            $billing_address['billing_zipcode'] . '<br />';
                        ?>
                    </p>
                </div>
                <div class="col-md-4 column">
                    <p><strong>Shipping Information</strong></p>
                    <p>
                        <?php
                        echo $shipping_address['shipping_address_1'] . ',' . $shipping_address['shipping_address_2'] .','. '<br />' .
                            $shipping_address['shipping_city'].','.$shipping_address['shipping_state'].','.$shipping_address['shipping_country'] . '<br />'.
                            $shipping_address['shipping_zipcode'] . '<br />';
                        ?>
                    </p>
                </div>
                <div class="col-md-4 column"> </div>
                <div class="col-md-4 column">
                    <table class="table">
                        <tbody>
                        <tr>
                            <td><strong> Subtotal</strong></td>
                            <td><span>&#8377;<?php
                                        if (!empty($sub_total)) {
                                            echo $sub_total;
                                        } else {
                                            echo '0';
                                        }
                                        ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Shipping</strong></td>
                            <td><span><?php echo $shipping_charges; ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Discount price</strong></td>
                            <td><span>&#8377;
                                        <?php 
                                        if(!empty($discount_price)){?>
                                        <?php   
                                            echo $discount_price; 
                                        } else {
                                            echo '0';
                                        }

                                        ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Grand Total</strong></td>
                            <td><span>&#8377;<?php echo $grand_total; ?>
                            
                                </span>
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