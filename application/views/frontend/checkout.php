<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>Shop">Home</a></li>
                <li class="active">Check out</li>
            </ol>
        </div><!--/breadcrums-->
        <a href="<?php echo base_url(); ?>Address/addUserAdds"><button type="submit" class="btn btn-default">Add Address</button></a>
     

   <!-- confirmation page-->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog-checkout">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Order and shipping details</h4>
                    </div> 

                    <div class="modal-body">
                        <div class="table-responsive cart_info">
                            
                            <table class="table table-condensed">                             
                                <thead>
                                    <tr class="cart_menu">
                                        <td class="image">Item</td>
                                        <td class="description">Name</td>
                                        <td class="price">Price</td>
                                        <td class="quantity">Quantity</td>
                                        <td class="total">Total</td>
                                        <td></td>
                                    </tr>
                                </thead> 
                                <tbody>
                                    <?php
                                    if (!empty($cart_products)) {
                                        foreach ($cart_products as $cart_product) {
                                            ?>
                                            <tr>
                                                <td class="cart_product">
                                                    <a href=""><img src="<?php echo base_url(); ?>uploads/<?php echo $cart_product['image_name']; ?>" class="cart_img_style"  style="width: 100px" alt=""></a>
                                                </td>
                                                <td class="cart_description">
                                                    <h4><a href=""><?php echo $cart_product['name']; ?></a></h4>
                                                    
                                                </td>
                                                <td class="cart_price">
                                                    <p>&#8377;<span id="price_<?php echo $cart_product['id']; ?>"><?php
                                                            $curr_date = date('Y-m-d');
                                                            if (($cart_product['special_price'] != '0.00') && ($curr_date > $cart_product['special_price_from']) && ($curr_date < $cart_product['special_price_to']) || ($curr_date == $cart_product['special_price_from']) || ($curr_date == $cart_product['special_price_to'])) {
                                                                echo $cart_product['special_price'];
                                                            } else {
                                                                echo $cart_product['price'];
                                                            }
                                                            ?></span></p>
                                                </td>
                                                <td class="cart_quantity">
                                                    <div class="cart_quantity_button">
                                                        <?php echo $cart_product['quantity']; ?>
                                                    </div>
                                                </td>
                                                <td class="cart_total">
                                                    <p class="cart_total_price">&#8377;<span id="<?php echo $cart_product['id']; ?>"><?php echo $cart_product['total_price']; ?></span></p>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="5">No product added to the cart!</td>
                                        </tr> 
                                    <?php } ?>
                                    <tr>
                                        <td colspan="4">&nbsp;
                                            <span id="address"></span>
                                        </td>
                                        <td colspan="2">
                                            <table class="table table-condensed total-result">
                                                <tr>
                                                    <td>Cart Sub Total</td>
                                                    <td><span>&#8377;<?php
                                                            if (!empty($cart_products)) {
                                                                echo $total;
                                                            } else {
                                                                echo '0';
                                                            }
                                                            ?></span>
                                                    </td>
                                                </tr>


                                                <tr class="shipping-cost">
                                                    <td>Shipping Cost</td>
                                                    <td><span><?php
                                                            if (!empty($total)) {
                                                                if ($total < 500) {
                                                                    ?>
                                                                    &#8377;50
                                                                    <?php
                                                                } else {
                                                                    echo 'FREE';
                                                                }
                                                            } else {
                                                                echo'FREE';
                                                            }
                                                            ?>
                                                        </span>
                                                    </td>										
                                                </tr>


                                                <tr>
                                                    <td>Discount price</td>
                                                    <td><span>&#8377;
                                                            <?php if (!empty($discount)) { ?>
                                                                <?php
                                                                echo $discount['discount_price'];
                                                            } else {
                                                                echo '0';
                                                            }
                                                            ?>
                                                        </span>
                                                    </td>
                                                </tr>



                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        
                        </div>
                    </div> 

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" id="proceed_btn" data-dismiss="modal"> Proceed </button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div> 



        <div class="register-req">
            <div class="shipping_checkout">
                <?php if (!empty($user_address)) {     ?>
                    <label class="ship">Shipping Address</label>
                    <?php
                    // print_r($user_address);exit;
                    foreach ($user_address as $shipping) {
                        ?>
                        <address class="ship_add"><input type="radio" name="shipping_address" value="<?php echo $shipping['id']; ?>"><span id="shipp_address_<?php echo $shipping['id']; ?>"><?php echo $shipping['address_1']; ?>,<?php echo $shipping['address_2']; ?>,<br><?php echo $shipping['ct_name']; ?>,
                                <?php echo $shipping['st_name']; ?>,<?php echo $shipping['count_name']; ?>,<br><?php echo $shipping['zipcode']; ?></span></address>
                        <?php
                    }
                } else {
                    ?>
                <label class="on">----Please Add New Address to Continue----</label>
                <?php 
                    }
                ?>
                <span id="err_shipping_addr" class="err_msg_checkout"></span>
            </div>

            <div class="billing">
                <?php if (!empty($user_address)) { ?>
                    <label class="bill">Billing Address </label>
                    <?php
                    // print_r($user_address);exit;

                    foreach ($user_address as $row) {
                        ?>
                        <address class="bill_add"><input type="radio" name="billing_address" value="<?php echo $row['id']; ?>"><span id="bill_address_<?php echo $row['id']; ?>"><?php echo $row['address_1']; ?>,<?php echo $row['address_2']; ?>,<br><?php echo $row['ct_name']; ?>,
                                <?php echo $row['st_name']; ?>,<?php echo $row['count_name']; ?>,<br><?php echo $row['zipcode']; ?></span></address>
                        <?php
                    }
                } else {
                    ?>
                <label class="on">----Please Add New Address to Continue----</label>
                <?php }
                ?>
                <span id="err_billing_addr" class="err_msg_checkout"></span>
            </div>
        </div>
   

        <div class="review-payment">
            <h2>Review & Payment</h2>
        </div>

        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Item</td>
                        <td class="description">Name</td>
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td class="total">Total</td>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    if (!empty($cart_products)) {

                        foreach ($cart_products as $cart_product) {
                            ?>
                            <tr>
                                <td class="cart_product">
                                    <a href=""><img src="<?php echo base_url(); ?>uploads/<?php echo $cart_product['image_name']; ?>" class="cart_img_style" style="width: 100px" alt=""></a>
                                </td>
                                <td class="cart_description">
                                    <h4><a href=""><?php echo $cart_product['name']; ?></a></h4>
                                    <!--<p>Pr ID: 1089772</p>-->
                                </td>
                                <td class="cart_price">
                                    <p>&#8377;<span id="price_<?php echo $cart_product['id']; ?>"><?php
                                            $curr_date = date('Y-m-d');
                                            if (($cart_product['special_price'] != '0.00') && ($curr_date > $cart_product['special_price_from']) && ($curr_date < $cart_product['special_price_to']) || ($curr_date == $cart_product['special_price_from']) || ($curr_date == $cart_product['special_price_to'])) {
                                                echo $cart_product['special_price'];
                                            } else {
                                                echo $cart_product['price'];
                                            }
                                            ?></span></p>
                                </td>
                                <td class="cart_quantity">
                                    <div class="cart_quantity_button">
                                        <?php echo $cart_product['quantity']; ?>
                                    </div>
                                </td>
                                 <td class="cart_total">
                                    <p class="cart_total_price">&#8377;<span id="<?php echo $cart_product['id']; ?>"><?php echo $cart_product['total_price']; ?></span></p>
                                </td> 
                            </tr>
                            <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="5">No product added to the cart!</td>
                        </tr> 
                    <?php } ?>


                    <tr>
                        <td colspan="4">&nbsp;</td>
                        <td colspan="2">
                            <table class="table table-condensed total-result">
                                <tr>
                                    <td>Cart Sub Total</td>
                                    <td><span>&#8377;<?php
                                            if (!empty($cart_products)) {
                                                echo $total;;
                                            } else {
                                                echo '0';
                                            }
                                            ?></span>
                                    </td>
                                </tr>
                                <tr class="shipping-cost">
                                    <td>Shipping Cost</td>
                                    <td><span><?php
                                            if (!empty($total)) {
                                                if ($total < 500) {
                                                    ?>
                                                    &#8377;50
                                                    <?php
                                                } else {
                                                    echo 'FREE';
                                                }
                                            } else {
                                                echo'FREE';
                                            }
                                            ?>
                                        </span>
                                    </td>										
                                </tr>
                                <tr>
                                    <td>Discount price</td>
                                    <td><span>&#8377;
                                            <?php if (!empty($discount)) { ?>
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
                                    <td>Total</td>
                                    <td><span>&#8377;<?php
                                            if (!empty($discount)) {
                                                if ($discount['discount_total'] < 500) {
                                                    $discount['discount_total'] = $discount['discount_total'] + 50;
                                                    echo $discount['discount_total'];
                                                } else {
                                                    echo $discount['discount_total'];
                                                }
                                            } else {
                                                if (!empty($total)) {
                                                    if ($total < 500) {
                                                        $total = $total + 50;
                                                        echo $total;
                                                    } else {
                                                        echo $total;
                                                    }
                                                } else {
                                                    echo '0';
                                                }
                                            }
                                            ?>         
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="payment-options">
            <span>
                <input type="radio" class="payment" name="paymnt" value="COD" id="cod"> 
                <label>COD</label>

                <input type="radio" class="payment" name="paymnt" value="Paypal" id="paypal"> 
                <label>Paypal</label>
            </span>
            <p id="err_payment_method" class="err_msg"></p>
            <button class="btn btn-default" id="proceed" data-toggle="modal" data-target="#myModal">Proceed</button>
        </div>
    </div>
</section> <!--/#cart_items-->



<script type="text/javascript">
    $(document).ready(function () {

        $('#proceed').click(function () {
            var billing_addr_id = $('input[name="billing_address"]:checked').val();
            var shipping_addr_id = $('input[name="shipping_address"]:checked').val();
            var billing_address = $('#bill_address_' + billing_addr_id).text();
            var shipping_address = $('#shipp_address_' + shipping_addr_id).text();
        /*  console.log(billing_addr_id);
            console.log(shipping_addr_id);
            console.log(billing_address);
            console.log(shipping_address);*/
            $('#address').html('<br><h4>Shipping Address:</h4>' + shipping_address + '<br>' + '<h4>Billing Address:</h4>' + billing_address);

        });


        $('#proceed_btn').click(function () {

            var billing_addr_chk1 = $('input[name="billing_address"]').is(':checked');
            var billing_addr_chk2 = $('input[name="billing_address"]').is(':checked');
            var billing_addr_chk3 = $('input[name="billing_address"]').is(':checked');

            var shipping_addr_chk1 = $('input[name="shipping_address"]').is(':checked');
            var shipping_addr_chk2 = $('input[name="shipping_address"]').is(':checked');
            var shipping_addr_chk3 = $('input[name="shipping_address"]').is(':checked');

            var shipping_method_chk1 = $('input[name="paymnt"]').is(':checked');
            var shipping_method_chk2 = $('input[name="paymnt"]').is(':checked');
            var validate = true;

            if (billing_addr_chk1 === false && billing_addr_chk2 === false && billing_addr_chk3 === false) {
                $('#err_billing_addr').html("Please select billing address!");
                validate = false;
            } else {
                var billing_addr_id = $("input[name='billing_address']:checked").val();
                $('#err_billing_addr').html("");
            }

            if (shipping_addr_chk1 === false && shipping_addr_chk2 === false && shipping_addr_chk3 === false) {
                $('#err_shipping_addr').html("Please select shipping address!");
                validate = false;
            } else {
                var shipping_addr_id = $("input[name='shipping_address']:checked").val();
                $('#err_shipping_addr').html("");
            }

            if (shipping_method_chk1 === false && shipping_method_chk2 === false) {
                $('#err_payment_method').html("Please select payment method!");
                validate = false;
            } else {
                var shipping_method = $("input[name='paymnt']:checked").val();
                $('#err_payment_method').html("");
            }

            if (validate == false) {
                return false;
            } else {

                console.log(billing_addr_id);
                console.log(shipping_addr_id);
                console.log(shipping_method);
                
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url() . 'index.php/checkout/userAddressDetails/' ?>" + billing_addr_id + "/" + shipping_addr_id + "/" + shipping_method,
                    success: function (data) {
//                   alert(data);
                        var payment_method = JSON.parse(data);
                        console.log(paypal);
                        if (payment_method == 'success_paypal') {
                //window.location = '<?php //echo base_url() . 'index.php/paypal/demos/express_checkout'; ?>';
                        window.location = '<?php echo base_url() . 'payPal'; ?>';
                        } else {
                            window.location = '<?php echo base_url() . 'index.php/checkout/paymentSuccess'; ?>';
                        }
                    },
                });
            }
        });
    });
</script>


<style type="text/css">
    #err_payment_method{
      color: red;
    }
</style>

<style type="text/css">
    #err_billing_addr{
    color: red;
    }
</style>

<style type="text/css">
    #err_shipping_addr{
    color: red;
    }
</style>

