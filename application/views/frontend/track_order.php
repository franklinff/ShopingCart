<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                
            </ol>
        </div>
        <div class="row">
            <?php 
                if($this->session->flashdata('error')){
                    echo "<span style='color:red'>".$this->session->flashdata('error')."</span><br>";
                }
            ?>

            <div class="col-sm-4 col-sm-offset-1">
                <div class="login-form"><!--login form-->
                    <form role="form" method="post" id="order_status" action="<?php echo base_url();?>TrackOrder/trackOrderDetails">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Order id:</label>
                                <input type="text" class="form-control" id="order_id" placeholder="Enter your order id" name="order_id">
                                <p id="err_order_id" class="err_msg"></p>
                            </div>
                            <div class="box-footer">
                                        <button type="submit" class="btn btn-primary" onclick="return validateform();">Get Status</button><br>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>


<script type="text/javascript">
    $(document).ready(function(){
        $("#order_status").validate({
            rules: {
                order_id: {
                    required: true,
                }
            },
            messages: {
                order_id:{
                   required : "Please enter your order id!",
                }
            },
        });
    });
</script>


<style>
    #order_status label.error{
        font-weight: normal;
        color : red;
    } 
</style>