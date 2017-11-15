<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Wishlist</li>
            </ol>
        </div>

        <div>
            <h4 id="prod_name"></h4>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
                 Modal content
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Delete product</h4>
                    </div>
                    <div class="modal-body">
                        <h4>Are you sure you want to remove '<span id="product_name"></span>' from the wishlist?</h4>
                        <input type="hidden" id="prod_id" value="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" id="delete" data-dismiss="modal"> OK </button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
                        <td class="quantity"></td>
                        <td class="total">Action</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($wishlist_products)) {
                        foreach ($wishlist_products as $wishlist_product) {
                            ?>
                            <tr>
                                <td class="cart_product">
                                    <a href=""><img src="<?php echo base_url(); ?>uploads/<?php echo $wishlist_product['image_name'];  ?>" class="cart_img_style" style="width: 100px" alt=""></a>
                                </td>
                                <td class="cart_description">
                                    <h4><a href=""><span id="prod_name_<?php echo $wishlist_product['id']; ?>"><?php echo $wishlist_product['name']; ?></span></a></h4>
                                </td>
                                <td class="cart_price">
                                    <p>&#8377;<span id="price_<?php echo $wishlist_product['id']; ?>"><?php echo $wishlist_product['price']; ?></span></p>
                                </td>

                                <td class="cart_total">
                                    <br><a id="add_to_cart" href="javascript:void(0);" class="btn btn-default add-to-cart" data-value="<?php echo $wishlist_product['id']; ?>"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                </td>
                                <td class="cart_delete">
                                    <a class="cart_quantity_delete" id="prod_del_<?php echo $wishlist_product['id']; ?>" href="javascript:void(0);" data-value="<?php echo $wishlist_product['id']; ?>" data-toggle="modal" data-target="#myModal">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </td>
                            </tr>
    <?php }
} else { ?>

<!--    <div id="myDiv"  style="display: none">
        <img src="<?php echo base_url();?>/uploads/ajax-loader.gif"/>
    </div> -->


                        <tr>
                            <td colspan="5">No product added to the wishlist!</td>
                        </tr> 
<?php } ?>						
                </tbody>
            </table>
        </div>
    </div>
</section> <!--/#cart_items-->

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
            var prod_name = $('#prod_name_'+product_id).text();
            $.ajax({
                type: "post",
                url: "<?php echo base_url() . 'wishlist/deleteWishlistProduct/' ?>" + product_id,
                beforeSend: function() {
                //$("#myDiv").show();
                $.LoadingOverlay("show");
                },
                success: function (data) {
                    var status = JSON.parse(data);
                    $("#prod_del_" + product_id).closest("tr").remove();
                    $('#prod_name').text(prod_name+' removed from the wishlist!').css('color','red');
                    $('#wishlist_count_total').text(status.total_wishlist_prod);
                    //$("#myDiv").hide();
                    $.LoadingOverlay("hide");
                },
            })
        });

        $('.add-to-cart').click(function(){        
           var product_id = $(this).attr('data-value');
           var price = $('#price_'+product_id).text();
           var prod_name = $('#prod_name_'+product_id).text();
           var quantity = 1;

           console.log(price); 
           console.log(product_id);
           console.log(prod_name);
           console.log(quantity);  
           $.ajax({
                type:"post",
                url:"<?php echo base_url().'wishlist/addToCart/'?>"+product_id+"/"+price + "/" + quantity,
                beforeSend: function() {
                //$("#myDiv").show();
                $.LoadingOverlay("show");
                },
               success:function(data){
                   var messge = JSON.parse(data);
                    //console.log(messge);
                    $("#prod_del_" + product_id).closest("tr").remove();
                    $('#prod_name').text(prod_name+' moved to the cart!').css('color','yellow');
                    $('#cart_count_total').text(messge.total_cart_prod);
                    $('#wishlist_count_total').text(messge.total_wishlist_prod);
                    //$("#myDiv").hide();
                    $.LoadingOverlay("hide");
               },
           });
       });
    });
</script>

