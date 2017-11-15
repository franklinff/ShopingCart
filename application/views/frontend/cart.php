    <!-- <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                  <li><a href="#">Home</a></li>
                  <li class="active">Shopping Cart</li>
                </ol>
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
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
<?php
foreach ($cart_data as $cart) { 
?>
                        <tr>
                            <td class="cart_product">
                                <a href=""><img src="<?php echo base_url(); ?>uploads/<?php echo $cart['pr_img'];?>" style ="width:100px;" ></a>
                            </td>

                            <td class="cart_description">
                                <h4><a href=""><?php echo $cart['name'];?></a></h4>
                            </td>

                            <td class="cart_price">
                                <p><?php echo $cart['price'];?></p>
                            </td>

                            <td class="cart_quantity">
                                <div class="cart_quantity_button">
                                    <a class="cart_quantity_up" href=""> + </a>
                                    <input class="cart_quantity_input" type="text" name="quantity" value="1" autocomplete="off" size="2">
                                    <a class="cart_quantity_down" href=""> - </a>
                                </div>
                            </td>

                            <td class="cart_total">
                                <p class="cart_total_price">$59</p>
                            </td>
                            
                            <td class="cart_delete">
                                <a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
<?php  } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section> 


    <section id="do_action">
        <div class="container">
            <div class="heading">
                <h3>What would you like to do next?</h3>
                <p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="chose_area">
                        <ul class="user_option">
                            <li>
                                <input type="checkbox">
                                <label>Use Coupon Code</label>
                            </li>
                        </ul>
                        
                        <a class="btn btn-default check_out" href="">Continue</a>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="total_area">
                        <ul>
                            <li>Cart Sub Total <span>$59</span></li>
                            <li>Discount <span>$2</span></li>
                            <li>Shipping Cost <span>Free</span></li>
                            <li>Total <span>$61</span></li>
                        </ul>
                            <a class="btn btn-default update" href="">Update</a>
                            <a class="btn btn-default check_out" href="">Check Out</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
 -->





 <section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>Shop">Home</a></li>
                <li class="active">Shopping Cart</li>
            </ol>
        </div>

        <div>
            <h4 id="prod_name"></h4>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Delete product</h4>
                    </div>
                    <div class="modal-body">
                        <h4>Are you sure you want to remove '<span id="product_name" class="err_msg"></span>' from the cart?</h4>
                        <input type="hidden" id="prod_id" value="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" id="delete" data-dismiss="modal"> Yes </button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                    </div>
                </div>
            </div>
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
                            <td>Action</td>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    if (!empty($cart_products)) {
                        foreach ($cart_products as $cart_product) {
                    ?>

                            <tr>
                                <td class="cart_product">
                                    <a href="<?php echo base_url(); ?>/productDetails/<?php echo $cart_product['id']; ?>">
                                        <img src="<?php echo base_url(); ?>uploads/<?php echo $cart_product['image_name']; ?>" class="cart_img_style" style="width: 100px" alt="">
                                    </a>
                                </td>

                                <td class="cart_description">
                                    <h4><a href=""><span id="prod_name_<?php echo $cart_product['id']; ?>"><?php echo $cart_product['name']; ?></span></a></h4>
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
                                        <a class="cart_quantity_up" href="javascript:void(0);" data-value="<?php echo $cart_product['id']; ?>"> + </a>
                                        <input class="cart_quantity_input" type="text" id="product_<?php echo $cart_product['id']; ?>" name="quantity" value="<?php echo $cart_product['quantity']; ?>" autocomplete="off" size="2">

                                        <input type="hidden" class="cart_quantity_id" value="<?php echo $cart_product['id']; ?>">
                                        <a class="cart_quantity_down" href="javascript:void(0);" data-value="<?php echo $cart_product['id']; ?>"> - </a>
                                    </div>
                                </td>

                                <td class="cart_total">
                                    <p class="cart_total_price">&#8377;<span id="<?php echo $cart_product['id']; ?>"><?php echo $cart_product['total_price']; ?></span></p>
                                </td>

                                <td class="cart_delete">
                                    <a class="cart_quantity_delete" id="prod_del_<?php echo $cart_product['id']; ?>" href="" data-value="<?php echo $cart_product['id']; ?>" data-toggle="modal" data-target="#myModal">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="5" id="no_prod">No product added to the cart!</td>
                        </tr> 

                    <?php } ?>                      
                </tbody>

            </table>



<!-- <div id="myDiv"  style="display: none">
    <img src="<?php echo base_url();?>/uploads/ajax-loader.gif"/>
</div> -->


        </div>
    </div>
</section> <!--/#cart_items-->

<section id="do_action">
    <div class="container">
        <div class="heading">
            <h3>What would you like to do next?</h3>
            <p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="chose_area">
                    <ul class="user_option">
                        <li>
                            <input type="checkbox" class="coupon_code">
                            <label>Use Coupon Code</label>
                            <input type="text" class="coupons_code" id="coupon_code" value="<?php
                            if (!empty($discount['coupon_code'])) {
                                echo $discount['coupon_code'];
                            } else {
                                echo '';
                            }
                            ?>">    
                            <!--<button class="coupons_code" id="coupon_btn">Submit</button>-->

                        </li>
                    </ul>

                </div>
            </div>
            <div class="col-sm-6">
                <div class="total_area">
                    <ul>
                        <li>Cart Sub Total <span>&#8377;<span class="total_price">
                                    <?php 
                                    if (!empty($sub_total)) {
                                        echo $sub_total;
                                    } else {
                                        echo '0';
                                    } ?>
                                </span></span></li>
                        <li>Discount price <span>&#8377;<span id="dis_price">
                                    <?php
                                    if (!empty($discount)) {
                                        echo $discount['discount_price'];
                                    } else {
                                        echo '0';
                                    }
                                    ?></span></span></li>    
                        <li>Shipping Cost <span><span id="shipping_price">
                                    <?php
                                    if (!empty($shipping_charges)) {
                                        echo $shipping_charges;
                                    } else {
                                        echo 'FREE';
                                    }  ?></span></span></li>
                        <li>Total <span>&#8377;<span id="di_total">
                                    <?php
                                    if (!empty($grand_total)) {
                                        echo $grand_total;
                                    } else {
                                        echo '0';
                                    } ?>
                                </span></span></li>
                    </ul>
                    <!--<a class="btn btn-default update" href="">Update</a>-->
                    <?php
                    if (!empty($cart_products)) {
                        ?>
                        <a class="btn btn-default check_out" href="<?php echo base_url() . 'Checkout' ?>">Check Out</a>
                    <?php } else { ?>
                        <a class="btn btn-default check_out" href="">Check Out</a>
<?php } ?>
                </div>
            </div>
        </div>
    </div>
</section><!--/#do_action-->


<script type="text/javascript">
    $(document).ready(function () {

        $('.cart_quantity_delete').click(function(){
            var product_id = $(this).attr('data-value');
            var product_name = $('#prod_name_'+product_id).text();
            $('#prod_id').val(product_id);
            $('#product_name').text(product_name);
        });


        $('#delete').click(function () {
            var product_id = $('#prod_id').val();
            var quantity = $('#product_' + product_id).val();
            var price = $('#price_' + product_id).html();
            var prod_name = $('#prod_name_' + product_id).text();
            $.ajax({
                type: "post",
                url: "<?php echo base_url() . 'cart/deleteCartProduct/' ?>" + product_id,
                beforeSend: function() {
                //$("#myDiv").show();
                $.LoadingOverlay("show");
                },
                success: function (data) {
//                    $("#prod_del_" + product_id).closest("tr").slideUp(1000,function(){
//                        $("#prod_del_" + product_id).closest("tr").fadeOut("slow");
                    $("#prod_del_" + product_id).closest("tr").fadeOut(1000);
                    $('#prod_name').text(prod_name + ' removed from the cart!').css('color','red');
                    $('#product_' + product_id).val(quantity);
                    //$("#myDiv").hide();
                    $.LoadingOverlay("hide");
                    
                    if (data) {
                        var cart_price = JSON.parse(data);
                            $('#cart_count_total').text(cart_price.cart_count);
                            $('#dis_price').text(cart_price.discount_price);
                        
                        if (cart_price.sub_total > 500) {
                            $('#shipping_price').text('FREE');
                        } else {
                            $('#shipping_price').html('&#8377;50');
                        }
                        $('.total_price').text(cart_price.sub_total);
                        $('#di_total').text(cart_price.total);
                    }
//                    });
//                    var status = JSON.parse(data);
//                    if(status.status == 'Deleted'){
//                        $('#no_prod').text('Cart is empty now!');
//                    }
//                    alert(status.status);
//                console.log($(this));

                },
            });
        });



        $('.cart_quantity_up').click(function () {
            var product_id = $(this).attr('data-value');
            var quantity = $('#product_' + product_id).val();
            var price = $('#price_' + product_id).html();
            quantity++;
            var total_price = price * quantity;

            console.log(price);
            $.ajax({
                type: "post",
                url: "<?php echo base_url() . 'cart/updateCartQuantity/' ?>" + quantity + "/" + product_id + "/" + total_price,
                beforeSend: function() {
                //$("#myDiv").show();
                $.LoadingOverlay("show");
                },
                success: function (data) {
                    $('#product_' + product_id).val(quantity);
                    $('#' + product_id).text(total_price);
                    if (data) {
                        var cart_price = JSON.parse(data);
                        if (cart_price.discount_price) {
                            $('#dis_price').text(cart_price.discount_price);
                            //$("#myDiv").hide();
                            $.LoadingOverlay("hide");
                        }
                        if (cart_price.sub_total > 500) {
                            $('#shipping_price').text('FREE');
                            //$("#myDiv").hide();
                            $.LoadingOverlay("hide");
                        } else {
                            $('#shipping_price').html('&#8377;50');
                            //$("#myDiv").hide();
                            $.LoadingOverlay("hide");
                        }
                        $('.total_price').text(cart_price.sub_total);
                        $('#di_total').text(cart_price.total);
                        //$("#myDiv").hide();
                        $.LoadingOverlay("hide");

                        toastr["success"](data.cart_quantity_up + data.cart_quantity_up);          
                        toastr.options = {
                            "closeButton": true,
                            "debug": false,
                            "newestOnTop": true,
                            "progressBar": true,
                            "positionClass": "toast-top-center",
                            "preventDuplicates": true,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "100",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                    }
                },
            });
        });



        $('.cart_quantity_input').change(function () {

            var product_id = $(this).parent().find('.cart_quantity_id').val();
            var quantity = $(this).val();
            var price = $('#price_' + product_id).html();
            var total_price = price * quantity;
            console.log(product_id);
            $.ajax({
                type: "post",
                url: "<?php echo base_url() . 'cart/updateCartQuantity/' ?>" + quantity + "/" + product_id + "/" + total_price,
                success: function (data) {
                    $('#product_' + product_id).val(quantity);
                    $('#' + product_id).text(total_price);
                    if (data) {
                        var cart_price = JSON.parse(data);
                        if (cart_price.discount_price) {
                            $('#dis_price').text(cart_price.discount_price);
                            $.LoadingOverlay("hide");
                            //$("#myDiv").hide();
                        }
                        if (cart_price.sub_total > 500) {
                            $('#shipping_price').text('FREE');
                            $.LoadingOverlay("hide");
                            //$("#myDiv").hide();

                        } else {
                            $('#shipping_price').html('&#8377;50');
                            $.LoadingOverlay("hide");
                            //$("#myDiv").hide();
                        }
                        $('.total_price').text(cart_price.sub_total);
                        $('#di_total').text(cart_price.total);
                        $.LoadingOverlay("hide");
                        //$("#myDiv").hide();
                    }
                },
            })
        });

        $('.cart_quantity_down').click(function () {
            var product_id = $(this).attr('data-value');
            var quantity = $('#product_' + product_id).val();
            var price = $('#price_' + product_id).html();
            if (quantity == 1) {
                var total_price = price * quantity;
            } else {
                quantity--;
                var total_price = price * quantity;
            }

            console.log(total_price);
            $.ajax({
                type: "post",
                url: "<?php echo base_url() . 'cart/updateCartQuantity/' ?>" + quantity + "/" + product_id + "/" + total_price,
                beforeSend: function() {
                //$("#myDiv").show();
                $.LoadingOverlay("show");
                },
                success: function (data) {
                    $('#product_' + product_id).val(quantity);
                    $('#' + product_id).text(total_price);
                    if (data) {
                        var cart_price = JSON.parse(data);
                        if (cart_price.discount_price) {
                            $('#dis_price').text(cart_price.discount_price);
                            //$("#myDiv").hide();
                            $.LoadingOverlay("hide");
                        }
                        if (cart_price.sub_total > 500) {
                            $('#shipping_price').text('FREE');
                            //$("#myDiv").hide();
                            $.LoadingOverlay("hide");
                        } else {
                            $('#shipping_price').html('&#8377;50');
                            //$("#myDiv").hide();
                            $.LoadingOverlay("hide");
                        }
                        $('.total_price').text(cart_price.sub_total);
                        $('#di_total').text(cart_price.total);
                        //$("#myDiv").hide();
                        $.LoadingOverlay("hide");

                        toastr["success"](data.cart_quantity_down + data.cart_quantity_down);          
                        toastr.options = {
                            "closeButton": true,
                            "debug": false,
                            "newestOnTop": true,
                            "progressBar": true,
                            "positionClass": "toast-top-center",
                            "preventDuplicates": true,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "100",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                    }
                },
            });
        });

        $('.coupons_code').hide();
        $(".coupon_code").change(function () {
            if (this.checked) {
                $('.coupons_code').show();
            } else {
                $('.coupons_code').hide();  
            }
        });


        $("#coupon_code").on("change", function () {
            var coupon_code = $('#coupon_code').val();

            console.log(coupon_code);
            if (coupon_code == '') {
                $('#dis_price').text(0);
                var discount = $('.total_price').text();
                $('#di_total').text(discount);
                alert('Please enter a coupon code!');
                return false;
            }
            $.ajax({
                type: "post",
                url: "<?php echo base_url() . 'cart/couponCode/' ?>" + coupon_code,
                success: function (data) {
                    var discount = JSON.parse(data);
                    if (discount.discount_price || discount.discount_total) {
                        $('#dis_price').text(discount.discount_price);
                        $('#di_total').text(discount.discount_total);
                        if (discount.discount_total < 500) {
                            var shipping_cost = '&#8377;50';
                        } else {
                            var shipping_cost = 'FREE';
                        }
                        $('#shipping_price').html(shipping_cost);
                    } else {
                        alert(discount);
                    }
                },
            });
        });

        $("#country").on("change", function () {
            var country_id = $(this).val();
            $.ajax({
                type: "post",
                url: "<?php echo base_url() . 'index.php/user_address/state/' ?>" + country_id,
                success: function (data) {

                    var states = JSON.parse(data);
                    console.log(states);
                    $('#state').html(states.states);
                },
            });
        });

    });
</script>




<?php
$discount = $this->session->discount;
$coupon_code = $discount['coupon_code'];

if (!empty($coupon_code)) {
    ?>
    <script type="text/javascript">
        $(document).ready(function () {
            $(".coupon_code").prop('checked', true);
            $('.coupons_code').show();
        });
    </script>
    <?php
}
?>
