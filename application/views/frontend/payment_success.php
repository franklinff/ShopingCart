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
            <div>
                <h4>We have received your order request and we will be soon processing it.</h4>
                <h5>Your order id is: <strong><?php echo $order_id; ?></strong></h5>
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