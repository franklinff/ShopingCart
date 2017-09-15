<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Order Details
            <small></small>
        </h1>
<!--        <ol class="breadcrumb">
            <a href="cms/add" class="btn btn-primary btn-block">Add Content</a>
        </ol><br>-->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- /.box -->

        <div class="row">
            <div class="col-xs-12">
                <?php
                    if ($this->session->flashdata('success')) {
                        echo "<span style='color:green'>" . $this->session->flashdata('success') . "</span><br>";
                    }
                    ?>
                <div class="box">
                    
                </div>
                    
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="image">Id</th>
                                    <th class="image">Name</th>
                                    <th class="description">Price</th>
                                    <th class="price">Quantity</th>
                                    <th class="quantity">Total</th>
                                </tr>
                            <thead>
                            <tbody>    
                                <?php
                                foreach ($order_details as $cart_item) {
                                //print_r($cart_item);exit;
                                    ?>
                                    <tr>
                                        <td class="prod_id"><?php echo $cart_item['product_id']; ?></td>
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
                                    echo $billing_address['billing_address_1'] . ',' . $billing_address['billing_address_2'] . ',' . '<br />' .
                                    $billing_address['billing_city'] . ',' . $billing_address['billing_starte'] . ',' . $billing_address['billing_country'] . '<br />' .
                                    $billing_address['billing_zipcode'] . '<br />';
                                    ?>
                                </p>
                            </div>
                            <div class="col-md-4 column">
                                <p><strong>Shipping Information</strong></p>
                                <p>
                                    <?php
                                    echo $shipping_address['shipping_address_1'] . ',' . $shipping_address['shipping_address_2'] . ',' . '<br />' .
                                    $shipping_address['shipping_city'] . ',' . $shipping_address['shipping_state'] . ',' . $shipping_address['shipping_country'] . '<br />' .
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
                                            <td><span><?php
                                                    if (!empty($sub_total)) {
                                                        if ($sub_total < 500) {
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
                                            <td><strong>Discount price</strong></td>
                                            <td><span>&#8377;
                                                    <?php if (!empty($discount)) { ?>
                                                        <?php
                                                        echo $discount;
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
                                                    if (!empty($cart['discount'])) {
                                                        if ($cart['discount']['discount_total'] < 500) {
                                                            $cart['discount']['discount_total'] = $cart['discount']['discount_total'] + 50;
                                                            echo $cart['discount']['discount_total'];
                                                        } else {
                                                            echo $cart['discount']['discount_total'];
                                                        }
                                                    } else {
                                                        if (!empty($billing_address['grand_total'])) {
                                                            if ($billing_address['grand_total'] < 500) {
                                                                $billing_address['grand_total'] = $billing_address['grand_total'] + 50;
                                                                echo $billing_address['grand_total'];
                                                            } else {
                                                                echo $billing_address['grand_total'];
                                                            }
                                                        } else {
                                                            echo '0';
                                                        }
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
                    <!-- /.box-body -->
                    
                </div>
                <!-- /.box -->
            </div>
    </section>
    <!-- /.content -->
</div>
