<div class="container">
    <div class="row clearfix">
        <div class="col-md-12 column">
           
            <h4>Order Id: <?php echo $order_id; ?></h4>
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
                        <td class="prod_id"><?php echo $cart_item['product_id']; ?></td>
                        <td><?php echo $cart_item['name']; ?></td>
                        <td class="center"> Rs<?php echo $cart_item['base_price']; ?></td>
                        <td class="center"><?php echo $cart_item['quantity']; ?></td>
                        <td class="center"> Rs<?php echo $cart_item['amount']; ?></td>
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
                            <td><span>&#8377;<?php
                                                if(!empty($grand_total)){
                                                    echo $grand_total;
                                                }else{
                                                    echo '0';
                                                }

                                            ?>
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