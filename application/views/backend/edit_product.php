<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Product
      </h1>
    </section>


<div style="width: 55%">
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <!-- /.box -->
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body">

              <form action="" method="post" id="add_product" enctype="multipart/form-data">

                <label>Product name</label>
                <div class="col-xl-12">
                  <input name="name" id="name" type="text" class="form-control"
                   value="<?php echo $current_product[0]['name'];?>">
                </div></br>
               
                <label>Product price</label>
                <div class="col-xl-12">
                    <input name="price" id="price"  type="text" class="form-control"
                    value="<?php echo $current_product[0]['price'];?>" >
                </div></br>
    
                <label>Quantity</label>
                <div class="col-xl-12">
                <input name="quantity" id="quantity"  type="text" class="form-control"
                value="<?php echo $current_product[0]['quantity'];?>" >
                </div></br>

                <label>Special price</label>
                <div class="col-xl-12">
                     <input name="special_price" id="special_price"  type="text" class="form-control"
                     value="<?php echo $current_product[0]['special_price'];?>" >
                </div></br>

                <!-- Date -->
                <div class="form-group">
                  <label>Discount begin date:</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input class="form-control pull-right" id="datepicker" name="special_price_from"
                    value="<?php echo $current_product[0]['special_price_from'];?>"
                    >
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->

                <!-- Date -->
                <div class="form-group">
                  <label>Discount end date:</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input class="form-control pull-right" id="datepicker1" name="special_price_to"
                    value="<?php echo $current_product[0]['special_price_to'];?>"
                    >
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->




                <label>Upload product image</label></br>
                <div class="col-md-12">              
                <span>
                <img src="<?php echo base_url();?>uploads/<?php echo $current_image[0]['image_name']; ?>" style= "width: 100px">
                </span>  
                <input id="uploadFile_1" name="uploadFile_0" type="file" placeholder="Choose File" 
                class="mandatory_fildes"> 
                </div>



               
                <label>Upload product image</label></br>
                <div class="col-md-12">                
                <span>
                <img src="<?php echo base_url();?>uploads/<?php echo $current_image[1]['image_name']; ?>" style="width: 100px">
                </span>                
                <input id="uploadFile_2" name="uploadFile_1" type="file" placeholder="Choose File" class="mandatory_fildes">             
                </div>



                <label>Upload product image</label></br>
                <div class="col-md-12">
                 <span>
                <img src="<?php echo base_url();?>uploads/<?php echo $current_image[2]['image_name']; ?>" style="width: 100px">
                </span> 
                <input id="uploadFile_3" name="uploadFile_2" type="file" placeholder="Choose File" class="mandatory_fildes">             
                </div>



                <label>SKU</label>
                <div class="col-xl-12">
                  <input name="sku" id="sku"  type="text" class="form-control" 
                  value="<?php echo $current_product[0]['sku'];?>" >
                </div></br>

                <label>Short description</label>
                <div class="col-xl-12" >
                  <input name="short_description" id="short_description"  type="text" class="form-control" value="<?php echo $current_product[0]['short_description'];?>">
                </div></br>

                <label>Long description</label>
                <div class="col-xl-12" >
                   <textarea name="long_description" type="text" id="long_description" class="form-control" 
                   rows="5" value="" ><?php echo $current_product[0]['long_description'];?></textarea>
                </div></br>

                <label>Meta title</label>
                <div class="col-xl-12">
                  <input name="meta_title" id="meta_title"  type="text" class="form-control" value="<?php echo $current_product[0]['meta_title'];?>">
                </div></br>

                <label>Meta keywords</label>
                <div class="col-xl-12" >
                <input name="meta_keywords" id="meta_keywords" type="text" class="form-control" value="<?php echo $current_product[0]['meta_keywords'];?>" >
                </div></br>

                <label>Meta description</label>
                <div class="col-xl-12" >
                <textarea  name="meta_description" id="meta_description" class="form-control" rows="5" cols="66"
                value="" ><?php echo $current_product[0]['meta_description'];?></textarea>
                </div></br>

                <label>Status</label>                  
                <div class="form-group"> 
                    <?php 
                    if ( $current_product[0]['status']==1){
                    ?> 

                        <input type="radio" name="status" value="1" checked="checked">Active<br>
                    <?php } else { ?>
                        <input type="radio" name="status" value="1" >Active<br>
                    <?php }?>

                    <?php 
                    if ( $current_product[0]['status']==0){
                    ?> 

                        <input type="radio" name="status" value="0" checked="checked">Inactive<br>
                    <?php } else { ?>
                        <input type="radio" name="status" value="0" >Inactive<br>
                    <?php }?>
                    <p id="err_status" class="err_msg"></p>                                
                </div>


                <label>Feature</label><br>
                 <div class="col-xl-12">

                 <?php
                  if ( $current_product[0]['is_featured']==1){
                 ?> 

                 <input type="checkbox" name="is_featured" value="1" checked="checked">
                 <?php } else { ?>
                  <input type="checkbox" name="is_featured" value="0">
                 <?php }?>
                </div></br> 




                <label>Select category</label>
                  <select multiple="" class="form-control" name="role_type">
                  <?php
                    foreach ($categories as $c) {

                      if($c['id'] == $category[0]['category_id'] )
                          {
                             $select_val="selected=selected";
                          }
                          else
                          {
                           $select_val="";
                          }
                  ?>

                  <option value="<?php echo $c['id']; ?>" <?php echo $select_val;?>>
                      <?php echo $c['name'];?> 
                  </option>

                  <?php 
                      }
                  ?>
                  </select></br>





                <div  align="center" >
                <button style="width:15%" type="submit" class="btn btn-block btn-primary">Submit</button>
                </div>
                
              </form>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
  <!-- /.content-wrapper -->
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<script src="<?php echo base_url("jquery.validate.js")?>"></script>

<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>

<script type="text/javascript">

    $( document ).ready(function() {
        //Date picker
        $('#datepicker').datepicker({
           format: 'yyyy/mm/dd',
          autoclose: true
        });

        //Date picker
        $('#datepicker1').datepicker({
           format: 'yyyy/mm/dd',
          autoclose: true
        });
    });
</script>

<script src="<?php echo base_url("jquery.validate.js")?>"></script>

<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });

   $("#add_product").validate({
    rules: {
            name: "required",            
            price: {
                required: true,
                number: true
            },
            quantity: {
                required: true,
                number: true
            },
            special_price: {
                required: true,
                number: true
            },
            sku: "required",
            short_description: "required",
            long_description: "required",
            meta_title: "required",
            meta_keywords: "required",
            meta_description: "required",
            uploadFile_0: "required",
            uploadFile_1: "required",
            uploadFile_2: "required",
            },

    messages: {
            name: "Please enter product name",
            price: {
                required:"Please enter product price",
                number: "Please select numericals"
            },
            quantity:  {
                required: "Please enter product quantity",
                 number: "Please select numericals"
            },
            special_price: {
                required: "Please provide a special price",
                 number: "Please select numericals"
            },
            sku: "Please enter sku",
            short_description: "Please enter short description",
            long_description: "Please enter long description",
            meta_title: "Please enter meta title",
            meta_keywords: "Please enter meta keywords",
            meta_description: "Please enter meta description",
            uploadFile_0: "Please select image",
            uploadFile_1: "Please select image",
            uploadFile_2: "Please select image"       
      }
 });

</script>


<style type="text/css">
  #add_product label.error{
    color: red;
  }
</style>

</body>



