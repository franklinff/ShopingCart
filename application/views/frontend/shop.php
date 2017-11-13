<body>

    <section id="slider"><!--slider-->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <?php
                    $uri_segment = $this->input->get('category_id');
//                    print_r($uri_segment);exit;
                    if ($uri_segment == '') {
                        ?>
                        <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                                <li data-target="#slider-carousel" data-slide-to="1"></li>
                                <li data-target="#slider-carousel" data-slide-to="2"></li>
                            </ol>

                            <div class="carousel-inner">
                                <?php // foreach ($banner_name as $banners) { ?>
                                <div class="item active">
                                    <div class="col-sm-6">
                                        <h1><span>E</span>-SHOPPER</h1>
                                        <h2>Best E-Commerce Shopping Site</h2>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                                    </div>
                                    <div class="col-sm-6">
                                        <img src="<?php echo base_url("/Eshopper/images/home/girl1.jpg")?>" class="girl img-responsive" alt="" />
                                    </div>
                                </div>
               
                                <div class="item">
                                    <div class="col-sm-6">
                                        <h1><span>E</span>-SHOPPER</h1>
                                        <h2>Best E-Commerce Shopping Site</h2>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                                    </div>
                                    <div class="col-sm-6">
                                        <img src="<?php echo base_url("/Eshopper/images/home/girl2.jpg")?>" class="girl img-responsive" alt="" />
                                    </div>
                                </div>

                                <div class="item">
                                    <div class="col-sm-6">
                                        <h1><span>E</span>-SHOPPER</h1>
                                        <h2>Best E-Commerce Shopping Site</h2>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                                    </div>
                                    <div class="col-sm-6">
                                        <img src="<?php echo base_url("/Eshopper/images/home/girl3.jpg")?>" class="girl img-responsive" alt="" />
                                    </div>
                                </div>

                            </div>

                            <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                                <i class="fa fa-angle-left"></i>
                            </a>
                            <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </div>
    </section><!--/slider-->


    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="left-sidebar">
                        <h2>Category</h2>
                        <div class="panel-group category-products" id="accordian"><!--category-product-->
                            <?php
                            foreach ($arr_category as $category) {
                                ?>  
                                <div class="panel panel-default">

                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <?php if (isset($category['sub_categories'])) { ?>
                                                <a href="<?php echo base_url(); ?>shop/index?category_id=<?php echo $category['id']; ?>"><?php echo $category['name']; ?></a>
                                                <a data-toggle="collapse" data-parent="#accordian" href="#<?php echo $category['id']; ?>">
                                                    <span class="badge pull-right">
                                                        <i class="fa fa-plus"></i>
                                                    </span>
                                                </a>
                                            <?php } else { ?>
                                                <a href="<?php echo base_url(); ?>shop/index?category_id=<?php echo $category['id']; ?>"><?php echo $category['name']; ?></a>
                                            <?php } ?>
                                        </h4>
                                    </div>

                                    <?php if (isset($category['sub_categories'])) { ?>
                                        <div id="<?php echo $category['id']; ?>" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <ul>
                                                    <?php foreach ($category['sub_categories'] as $sub_category) {
                                                        ?>
                                                        <li><a class="<?php
                                                            if ($this->uri->segment(2) == 'index?category_id=' . $sub_category['id']) {
                                                                echo 'active';
                                                            }
                                                            ?>" href="<?php echo base_url(); ?>shop/index?category_id=<?php echo $sub_category['id']; ?>" name="category_id" ><?php echo $sub_category['name']; ?> </a></li>
                                                        <?php } ?>
                                                </ul>
                                            </div>
                                        </div>
                                    <?php } ?>

                                </div>
                            <?php } ?>      
                        </div><!--/category-productsr-->

                        <br></br><br></br>
<!-- 
                        <div class="price-range">
                            <h2>Price Range</h2>
                            <div class="well">
                                <input type="text" class="span2" value="" data-slider-min="<?php echo $min_price[0]; ?>" data-slider-max="<?php echo $max_price[0]; ?>" data-slider-step="5" data-slider-value="[<?php echo $min_price[0]; ?>,<?php echo $max_price[0]; ?>]" id="sl2" ><br />
                                
                                <b><?php echo $min_price[0]; ?></b> <b class="pull-right"><?php echo $max_price[0]; ?></b>
                            </div>
                        </div> -->

                        <div class="shipping text-center">
                            <img src="<?php echo base_url("/Eshopper/images/home/shipping.jpg")?>">
                        </div><br>

                    </div>
                </div>
                <?php
                if ($this->session->flashdata('mailchimp_error_msg')) {
                    echo "<span style='color:green'>" . $this->session->flashdata('mailchimp_error_msg') . "</span><br>";
                }
                ?>
                <?php
                if ($this->session->flashdata('mailchimp_msg')) {
                    echo "<span style='color:green'>" . $this->session->flashdata('mailchimp_msg') . "</span><br>";
                }
                ?>

                <div class="col-sm-9 padding-right">
                    <div class="features_items"><!--features_items-->
                        <h2 class="title text-center"><?php
                            $uri_segment = $this->input->get('category_id');
                            if ($uri_segment == '') {
                                echo 'Featured Items';
                            }
                            ?></h2>
                        <div id="price_range_products">
                            <?php
                            if (!empty($products)) {
                          foreach ($products as $product) {
 
 
                   ?>



                                    <div class="col-sm-4" >
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                    <a href="<?php echo base_url();?>ProductDetails/index/<?php echo $product['id']; ?>">
                                                    <img src="<?php echo base_url(); ?>uploads/<?php echo $product['image_name']; ?>" class="img_style" style="width: 100%; " alt="" />
                                                </a>

                                                    <?php
                                                    $curr_date = date('Y-m-d');
                                                    if (($product['special_price'] != '0.00') && ($curr_date > $product['special_price_from']) && ($curr_date < $product['special_price_to']) || ($curr_date == $product['special_price_from']) || ($curr_date == $product['special_price_to'])) {
                                                        $strike_start = '<strike>';
                                                        $strike_end = '</strike>';
                                                    } else {
                                                        $strike_start = '';
                                                        $strike_end = '';
                                                        $product['price'] = $product['price'];
                                                        $product['special_price'] = '';
                                                    }
                                                    ?>



                                                    <h2>&#8377;<?php echo $strike_start; ?><span id="prod_<?php echo $product['id']; ?>"><?php echo $product['price']; ?></span><?php echo $strike_end; ?>
                                                        <span id="special_price_<?php echo $product['id']; ?>"><?php echo $product['special_price']; ?></span></h2>
                                                    <p><?php echo $product['name']; ?></p>


                                                    <a id="add_to_cart" href="javascript:void(0);" class="btn btn-default add-to-cart" data-value="<?php echo $product['id']; ?>">
                                                        <span id="added_prod_to_cart_<?php echo $product['id']; ?>">
                                                            <?php
                                                            $cart_data = $this->session->cart;
                                                            if (!empty($cart_data)) {
                                                                $avail = FALSE;
                                                                foreach ($cart_data as $key => $value) {
                                                                    if ($key == $product['id']) {
                                                                        $avail = TRUE;
                                                                        echo '<span style="color:#FE980F">Added to the cart!</span>';
                                                                        break;
                                                                    }
                                                                }
                                                                if ($avail == FALSE) {
                                                                    echo '<i class="fa fa-shopping-cart"></i>Add to cart';
                                                                }
                                                            } else {
                                                                echo '<i class="fa fa-shopping-cart"></i>Add to cart';
                                                            }
                                                            ?>
                                                        </span>
                                                    </a>


                                                    
<!--     <div id="myDiv"  style="display: none" >
        <img src="<?php echo base_url();?>/uploads/ajax-loader.gif"/>
    </div>
 -->

                                                </div>
                                            </div>

                                            <div class="choose">
                                                <ul class="nav nav-pills nav-justified">
                                                    <li><a href="javascript:void(0);" id="add_to_wishlist" class="add-to-wishlist" data-value="<?php echo $product['id']; ?>"><span id="added_to_wishlist_<?php echo $product['id']; ?>"><?php
                                                                if (!empty($wishlist_products)) {
                                                                    $avail = FALSE;
                                                                    foreach ($wishlist_products as $value) {
                                                                        if ($value['product_id'] == $product['id']) {
                                                                            $avail = TRUE;
                                                                            echo '<i class="fa fa-minus-square"></i>Remove from wishlist!';
                                                                            break;
                                                                        }
                                                                    }
                                                                    if ($avail == FALSE) {
                                                                        echo '<i class="fa fa-plus-square"></i>Add to wishlist';
                                                                    }
                                                                } else {
                                                                    echo '<i class="fa fa-plus-square"></i>Add to wishlist';
                                                                }
                                                                ?></span></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            } else {
                                echo 'Sorry no products in this category!';
                            }
                            ?>      </div>              
                    </div>

                    <ul class="pagination">
                    <?php echo $this->pagination->create_links(); ?>    
                    </ul>
                </div><!--features_items-->
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">

    function display_cart_prod(product_id, price, quantity) {
        $.ajax({
            type: "post",          
            url: "<?php echo base_url() . 'shop/addToCart/' ?>" + product_id + "/" + price + "/" + quantity,
            beforeSend: function() {
                //$("#myDiv").show();
                $.LoadingOverlay("show");
            },
//           data: 'product_id='+product_id,
            success: function (data) {
                var messge = JSON.parse(data);
                $('#cart_count_total').text(messge.total_cart_prod);
                $('#added_prod_to_cart_' + product_id).html('<span style="color:#FE980F">' + messge.messge + '</span>');
                //$("#myDiv").hide();
                $.LoadingOverlay("hide");
            },
        });
    }

    $(document).ready(function () { 

        $('.slider-track').click(function () {
            var price_range = $('.tooltip-inner').html();
            console.log(price_range);
            $.ajax({
                type: "post",
                url: "<?php echo base_url(); ?>index.php/shop/priceRange/" + price_range,
                success: function (data) {
                    var products = JSON.parse(data);
                    //console.log(products.price_range_products);
                    if (products.price_range_products != '') {
                        $('#price_range_products').html(products.price_range_products);
                        $('.pagination').html(products.price_range_pagination);
                    } else {
                        $('#price_range_products').html('No Products Found in this range');
                        $('.pagination').html(products.price_range_pagination);
                    }
                }
            });
        });


        $('.add-to-cart').click(function () {
            var product_id = $(this).attr('data-value');
            var price = $('#prod_' + product_id).text();
            var special_price = $('#special_price_' + product_id).text();
            var quantity = 1;
            console.log(product_id); 
            //console.log(price);
            //console.log(special_price);
            //console.log(price);
            if (special_price !== '') {
                price = special_price;
            }
            
            display_cart_prod(product_id, price, quantity);
//           console.log(product_id);
        });




        $('.add-to-wishlist').click(function () {               //add-to-wishlist is a class
            var product_id = $(this).attr('data-value');
            console.log(product_id);
            $.ajax({
                type: "post",
                url: "<?php echo base_url() . 'Shop/addToWishlist/' ?>" + product_id,
                beforeSend: function() {
                //$("#myDiv").show();
                $.LoadingOverlay("show");
                },
                success: function (data) {
                    if (data == 'login') {
                        window.location = '<?php echo base_url(); ?>UserLogin';
                    }
                    var messge = JSON.parse(data);
                    //console.log(messge);
                    $('#added_to_wishlist_' + product_id).html(messge.message);
                    $('#wishlist_count_total').text(messge.quantity);
                    $.LoadingOverlay("hide");
                    //$("#myDiv").hide();
                }
            });
        });

    });
</script>

<style>
.pagination a {
    background-color: #ff9800;
    border: 2px solid #ff9800;
    border-radius: 10px;
    color: #ffffff;
    font-family: "roboto_slabregular";
    margin:7px;
    padding: 10px 15px;
}
</style>




