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
                                                            ?></span>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        
                        </div>
                    </div> 

                