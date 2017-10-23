<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>Shop">Home</a></li>
                <li class="active">My orders</li>
            </ol>
<!--            <a href="<?php echo base_url(); ?>index.php/track_order"><button type="submit" class="btn btn-default">Track order</button></a>-->
        </div><br>

        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="text-center">Order Id</td>
                        <td class="text-center">Transaction Id</td>
                        <td class="price">Amount</td>
                        <td class="quantity">Date</td>
                        <td class="total"></td>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($orders)){
                            foreach ($orders as $value) {
                    ?>
                    <tr>
                    	<td class="text-center"><?php echo $value['id']; ?></td>
                        

			<td class="text-center">
                            <?php 
                            if(!empty($value['transaction_id'])){
                                echo $value['transaction_id'];
                            }else{
                                echo '--------';
                            }?>
                        </td>


                        <td class="price"><?php echo $value['grand_total']; ?></td>


                        <td class="quantity"><?php echo $value['created_date']; ?></td>


                        <td class="total"><br><a href="<?php echo base_url(); ?>MyOrder/orderDetails/<?php echo $value['id'];  ?>" class="btn btn-default add-to-cart">View Details</a></td>
                        
                    </tr>
                    <?php }}else{ ?>

                    <tr>
                        <td colspan="5">No orders found yet!</td>
                    </tr> 

                    <?php } ?>	
                </tbody>
            </table>
        </div>

        <ul class="pagination">
            <?php echo $this->pagination->create_links(); ?>	
        </ul>

    </div>
</section>


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