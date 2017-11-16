
<link rel="stylesheet" href="<?php echo base_url("viewbox-master/viewbox.css");?>">
<script src="<?php echo base_url("bootstrap/js/jquery.min.js");?>"></script> <!-- plugins for zooming the image -->
<script src="<?php echo base_url("viewbox-master/jquery.viewbox.min.js");?>"></script>  <!-- plugins for zooming the image -->



<section>
        <div class="container">
           
                <div class="col-sm-3 padding-left">
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
                                                <a href="<?php echo base_url(); ?>Shop/index?category_id=<?php echo $category['id']; ?>"><?php echo $category['name']; ?></a>
                                                <a data-toggle="collapse" data-parent="#accordian" href="#<?php echo $category['id']; ?>">
                                                    <span class="badge pull-right">
                                                        <i class="fa fa-plus"></i>
                                                    </span>
                                                </a>
                                            <?php } else { ?>
                                                <a href="<?php echo base_url(); ?>Shop/index?category_id=<?php echo $category['id']; ?>"><?php echo $category['name']; ?>
                                                </a>
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
                                                            ?>" href="<?php echo base_url(); ?>Shop/index?category_id=<?php echo $sub_category['id']; ?>" name="category_id" ><?php echo $sub_category['name']; ?> </a></li>
                                                    <?php } ?>
                                                </ul>
                                            </div>
                                        </div>
                                    <?php } ?>

                                </div>
                            <?php } ?>      
                        </div><!--/category-products-->

                    </div>
                </div>
        



<div class="col-sm-9 padding-right">                                         
    <div class="product-details"><!--product-details-->
                    <div class="col-sm-5">

                        <div class="view-product">
                            <img id="product_image" src="<?php echo base_url(); ?>uploads/<?php echo $images[0]["image_name"];?>" style =" width: 100%; height: 100%" alt="">
                        </div>
                        <br></br>
                        <div id="similar-product" class="carousel slide" data-ride="carousel">
                            <!-- Controls -->
                            <a class="left item-control" href="#similar-product" data-slide="prev" style="left:-14px;">
                                <i class="fa fa-angle-left"></i>
                            </a>

                            <!-- Wrapper for slides -->
                            <div class="carousel-inner">
                                <div class="item active">

<!-- 
<img id="myImg0" src="<?php echo base_url(); ?>uploads/<?php echo $images[0]["image_name"];?>" style = "width:83px; height: 80px" >
<img id="myImg1" src="<?php echo base_url(); ?>uploads/<?php echo $images[1]["image_name"];?>" style = "width:83px; height:80px"> 
<img id="myImg2" src="<?php echo base_url(); ?>uploads/<?php echo $images[2]["image_name"];?>" style = "width:83px; height:80px">
-->
<!--<a href=""><img src="<?php echo base_url(); ?>uploads/<?php echo $images[2]["image_name"];?>" class="prod_details_img_style" style = "width:83px; height:80px" alt=""></a>
 -->
<a href="<?php echo base_url(); ?>uploads/<?php echo $images[0]["image_name"];?>" class="image-link">
    <img src="<?php echo base_url(); ?>uploads/<?php echo $images[0]["image_name"];?>" style = "width:83px; height: 80px">
</a>

<a href="<?php echo base_url(); ?>uploads/<?php echo $images[1]["image_name"];?>" class="image-link" title="Image Title">
    <img src="<?php echo base_url(); ?>uploads/<?php echo $images[1]["image_name"];?>" style = "width:83px; height: 80px">
</a>


<a href="<?php echo base_url(); ?>uploads/<?php echo $images[2]["image_name"];?>" class="image-link">
    <img src="<?php echo base_url(); ?>uploads/<?php echo $images[2]["image_name"];?>" style = "width:83px; height: 80px">
</a>

                                </div>



                            </div>

                            <!-- Controls -->
                            <a class="right item-control" href="#similar-product" data-slide="next" style="right:-7px;">
                                <i class="fa fa-angle-right"></i> 
                            </a>


                        </div>
                    </div>


                    <div class="col-sm-7">
                        <div class="product-information"><!--/product-information-->
                    
                            <h2><?php echo $individual_data[0]['name']; ?></h2>
                    
                            <span>

                            <span id="prc">&#8377;<?php echo $individual_data[0]['price']; ?></span>    

                            <label>Quantity:</label>
                            <input type="text" class="quantity" value="0" />

                            <a href="javascript:void(0);" data-value="<?php echo $individual_data[0]['id']; ?>" class="btn btn-fefault cart">       
                            <i class="fa fa-shopping-cart"></i>  Add to cart   
                            </a>

                            </span>
                            <p><b>Availability:</b> In Stock</p>
                            <p><b>Condition:</b> New</p>
                            <p><b>Brand:</b> E-SHOPPER</p>
                            <p id="added_to_cart"></p> 
                        </div><!--/product-information-->
                    </div>
    </div><!--/product-details-->
</div>

</div>
</section>

<script type="text/javascript">

        $('.cart').click(function () {
            var product_id = $(this).attr('data-value');
            var price = <?php echo $individual_data[0]['price']; ?>;
            //var quantity = $('.quantity').val() ;  
            var quantity = 1;

            console.log(product_id);
            console.log(price);
            console.log(quantity);

            $.ajax({
                type: "post",
                url: "<?php echo base_url() . 'shop/addToCart/' ?>" + product_id + "/" + price + "/" + quantity,
                success: function (data) {
                    var messge = JSON.parse(data);
                    $('#cart_count_total').text(messge.total_cart_prod);
                    if (messge.messge == 'Already added to the cart!') {
                        $('#added_to_cart').text('Cart updated successfully');
                    } else {
                        $('#added_to_cart').text(messge.messge);
                        $('.quantity').val(quantity);
                    }
                },
            });
        });

       /* $('.quantity').change(function () {
            var product_id = $('.cart').attr('data-value');
            var quantity = $(this).val();
            var price = $('#prod_' + product_id).val();
            var total_price = price * quantity;

            console.log(quantity);
            console.log(product_id);
            console.log(price);

            $.ajax({
                type: "post",
                url: "<?php echo base_url() . 'cart/update_cart_quantity/' ?>" + quantity + "/" + product_id + "/" + total_price,
                complete: function () {
                    $('#product_' + product_id).val(quantity);
                    $('#' + product_id).text(total_price);
                    $('#added_to_cart').text('Quantity updated successfully');
                },
            });
        });
*/
</script>


<script>
    $(function(){
    $('.image-link').viewbox();
     });

    $(function(){
        $('.image-link').viewbox({
        setTitle: true,
        margin: 20,
            resizeDuration: 300,
            openDuration: 200,
            closeDuration: 200,
            closeButton: true,
            navButtons: true,
            closeOnSideClick: true,
            nextOnContentClick: true
            });
        });
       
</script>