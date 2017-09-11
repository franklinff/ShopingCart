<section id="cart_items">
    <div class="container">
        <div class="row shop-tracking-status">
            <b style='margin-left: 50px; color:orange;'>Order ID:-</b><?php echo $order_id; ?>    
            <div class="col-md-12">
                <div class="well">

                    <div class="box-body">
                        <table class="table table-bordered table-striped" id="myTable">
                            <thead>
                                <tr>
                                    <th class="">Order Id</th>
                                    <th class="">Name</th>
                                    <th class="">Transaction Id</th>
                                    <th class="">Amount</th>
                                    <th class="">Shipping Method</th>
                                    <th class="">Date</th>
                                    <th class="">Status</th>
                                </tr>
                            <thead>
                            <tbody>    
                                <tr>
                                    <td class=""><?php echo $order_id; ?></td>
                                    <td class=""><?php echo $firstname . ' ' . $lastname; ?></td>
                                    <td class="">
                                        <?php
                                        if (!empty($transaction_id)) {
                                            echo $transaction_id;
                                        } else {
                                            //echo 'ABCDEF';  //by default
                                        }
                                        ?>
                                    </td>
                                    <td class=""><?php echo $grand_total; ?></td>
                                    <td class=""><?php echo $shipping_method; ?></td>
                                    <td class=""><?php echo $created_date; ?></td>
                                    <td><?php echo $status; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="order-status">
                        <div class="order-status-timeline">
                            <div class="order-status-timeline-completion <?php
                            if ($status == 'Pending') {
                                echo 'c0';
                            }
                            if ($status == 'Processing') {
                                echo 'c1';
                            }
                            if ($status == 'Shipped') {
                                echo 'c2';
                            }
                            if ($status == 'Delivered') {
                                echo 'c3';
                            }
                            ?>">  
                            </div>
                        </div>

                        <div class="image-order-status image-order-status-new active img-circle">
                            <span class="status">Pending</span>
                            <div class="icon"></div>
                        </div>

                        <div class="image-order-status image-order-status-active active img-circle">
                            <span class="status">Processing</span>
                            <div class="icon"></div>
                        </div>

                        <div class="image-order-status image-order-status-intransit active img-circle">
                            <span class="status">Shipping</span>
                            <div class="icon"></div>
                        </div>

                        <div class="image-order-status image-order-status-delivered active img-circle">
                            <span class="status">Delivered</span>
                            <div class="icon"></div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
</section>