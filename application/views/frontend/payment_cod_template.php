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
           

            <div id="header" class="row clearfix">
                <div class="col-md-6 column">
                    <div id="angelleye-logo">
                        E-shopper
                    </div>
                </div>
            </div><!--
            <h2 align="center">Payment Complete</h2>-->            
            <div>
                <p>We have received your order request and we will be soon processing it.</p>
                <p>Your order id is: <strong>{last_id}</strong></p>
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
                <tbody>{order_details_template}</tbody>
            </table>

            <div class="row clearfix">
                <div class="col-md-4 column">
                    <p><strong>Billing Information</strong></p>
                    <p>{billing_information}</p>
                </div>
                <div class="col-md-4 column">
                    <p><strong>Shipping Information</strong></p>
                    <p>{shipping_information}</p>
                </div>

                <div class="col-md-4 column"> </div>

                <div class="col-md-4 column">
                    <table class="table">
                        <tbody>
                        <tr>
                            <td><strong> Subtotal</strong></td>
                            <td><span>&#8377;{sub_total}</span>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Shipping</strong></td>
                            <td><span>{shipping_charges}</span>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Discount price</strong></td>
                            <td><span>&#8377;{discount_price}</span>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Grand Total</strong></td>
                            <td><span>&#8377;{grand_total}</span>
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
