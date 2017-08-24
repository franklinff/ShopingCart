<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                
            </ol>
        </div>

        <label><h3>Reset new password:</h3></label>

        <div class="row">
            <div class="col-sm-4 col-sm-offset-1">
                <div class="login-form"><!--login form-->
                    
                    <form role="form" method="post" id="change_passwd" action="<?php echo base_url(); ?>/index.php/Change_password/update_password">
                        <div class="box-body">

                            <div class="form-group">
                                <label for="exampleInputEmail1">Old password:</label>
                                <input type="password" class="form-control" id="old_passwd" placeholder="Old password" name="password">
                                <p id="err_old_passwd" class="err_msg"></p>
                                <?php 
                                  if($this->session->flashdata('error_msg')){
                                    echo "<span style='color:red'>".$this->session->flashdata('error_msg')."</span><br>";
                                    }
                                ?>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">New password:</label>
                                <input type="password" class="form-control" id="new_passwd" placeholder="New password" name="new_password">
                                <p id="err_new_passwd" class="err_msg"></p>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Confirm password:</label>
                                <input type="password" class="form-control" id="conf_passwd" placeholder="Confirm password" name="conf_passwd">
                                <p id="err_conf_passwd" class="err_msg"></p>
                            </div>
                            
                            <div class="box-footer">
                                  <button type="submit" class="btn btn-primary" onclick="return validateform();">Submit</button><br>
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
        $('#change_passwd').validate({
           rules:{
               password:{
                   required:true,
               },
               new_password:{
                   required:true,
               },
               conf_passwd:{
                   required:true,
                   equalTo: "#new_passwd"
               },
           },
           messages:{
               password:{
                   required:"Please enter old password",
               },
               new_password:{
                   required:"Please enter new password",
               },
               conf_passwd:{
                   required:"New password and confirm password should be same",
                   equalTo: "New password and confirm password should be same"
               },           
           }
       });
    });
</script>
<style>
    #change_passwd label.error{
        font-weight: normal;
        color : red;
    } 
</style>