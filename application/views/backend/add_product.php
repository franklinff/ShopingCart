<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add Product
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

              <form action="addProduct" method="post" id="add_product" enctype="multipart/form-data">

                <label>Product name</label>
                <div class="col-xl-12">
                  <input name="name" id="name" placeholder="Product name" type="text" class="form-control alphacapital" >
                </div></br>
               
                <label>Product price</label>
                <div class="col-xl-12">
                    <input name="price" id="price" placeholder="Product price" type="text" class="form-control" >
                </div></br>
    
                <label>Quantity</label>
                <div class="col-xl-12">
                <input name="quantity" id="quantity" placeholder="Quantity" type="text" class="form-control" >
                </div></br>

                <label>Special price</label>
                <div class="col-xl-12">
                     <input name="special_price" id="special_price" placeholder="Special price" type="text" class="form-control" >
                </div></br>

                <!-- Date -->
                <div class="form-group">
                  <label>Discount begin date:</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right" id="datepicker" name="special_price_from">
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
                    <input type="text" class="form-control pull-right" id="datepicker1" name="special_price_to">
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->

                <label>Upload product image</label></br>
                <div class="col-md-12">
                  <input id="uploadFile_0" name="uploadFile_0" type="file" placeholder="Choose File" class="mandatory_fildes">             
                </div><br></br>
               
                <label>Upload product image</label></br>
                <div class="col-md-12">
                  <input id="uploadFile_1" name="uploadFile_1" type="file" placeholder="Choose File" class="mandatory_fildes">             
                </div><br></br>

                <label>Upload product image</label></br>
                <div class="col-md-12">
                  <input id="uploadFile_2" name="uploadFile_2" type="file" placeholder="Choose File" class="mandatory_fildes">             
                </div><br></br>

                <label>SKU</label>
                <div class="col-xl-12">
                  <input name="sku" id="sku" placeholder="SKU" type="text" class="form-control" >
                </div></br>

                <label>Short description</label>
                <div class="col-xl-12" >
                  <input name="short_description" id="short_description" placeholder="Short description" type="text" class="form-control" >
                </div></br>

                <label>Long description</label>
                <div class="col-xl-12" >
                   <textarea name="long_description" id="long_description" class="form-control" rows="5"  placeholder="Long description"></textarea>
                </div></br>

                <label>Meta title</label>
                <div class="col-xl-12">
                  <input name="meta_title" id="meta_title" placeholder="Meta title" type="text" class="form-control" >
                </div></br>

                <label>Meta keywords</label>
                <div class="col-xl-12" >
                <input name="meta_keywords" id="meta_keywords" placeholder="Short description" type="text" class="form-control" >
                </div></br>

                <label>Meta description</label>
                <div class="col-xl-12">
                <textarea id="meta_description" name="meta_description" rows="10" cols="80"> </textarea>   
                        
                </div></br>



                <label>Status</label>                  
                <div class="radio">
                    <label>
                    <input name="status" id="optionsRadios1" type="radio" value="1" checked>
                        Active 
                    </label>
                </div>
                <div class="radio">
                    <label>
                      <input name="status" id="optionsRadios2" type="radio" value="0">
                        Inactive  
                     </label>
                </div>

                <label>Feature</label><br>
                 <div class="col-xl-12">
                <input type="checkbox" name="is_featured" value="1">
                </br>
                </div>  

                <label>Select category</label>
                  <select multiple="" class="form-control" name="role_type">
                     <?php foreach ($categories as $c) { ?>                  
                    <option value="<?php echo $c['id'];?>"><?php echo $c['name'];?> </option>
                    <?php } ?>
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
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>



<script src="https://cdn.ckeditor.com/4.7.3/standard/ckeditor.js"></script>
<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('meta_description');
    //bootstrap WYSIHTML5 - text editor
    // $(".textarea").wysihtml5();
  });
</script>








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


$('#quantity').keyup(function(){
  if ($(this).val() <= 0){
    alert("Quantity needs to be gretater then zero.");
    $(this).val('100');
  }
});

$('#price').keyup(function(){
  if ($(this).val() <= 0){
    alert("Price needs to be a positie integer.");
    $(this).val('100');
  }
});

$('#special_price').keyup(function(){
  if ($(this).val() <= 0){
    alert("Special price needs to be a positie integer.");
    $(this).val('100');
  }
});



/*var pricevar = $("#quantity").val();
console.log(pricevar);

if (pricevar == '' || pricevar == '0') {
    var errormessage = 'Product Price is empty or zero. Please enter it above.';
    alert("Product Price is empty or zero. Please enter it above.");
    $("#errordiv").html(errormessage).slideDown();
    
}*/


   $("#add_product").validate({
    rules: {
            name: "required",            
            price: {
                required: true,
                number: true,
                maxlength: 5
                },
            quantity: {
                required: true,
                number: true,
                maxlength: 3
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
            uploadFile_0: {
              required:true,
             
               accept: "image/jpg,image/png,image/jpeg" 
            },
            uploadFile_1: {
              required:true,
              accept: "image/jpg,image/png,image/jpeg"
      
            },
            uploadFile_2: {
              required:true,
              accept: "image/jpg,image/png,image/jpeg"
            }
            },

    messages: {
            name: "Please enter product name",
            price: {
                required:"Please enter product price",
                number: "Please select numericals",
                maxlength: "The price can't exceed the above limit."
            },
            quantity:  {
                required: "Please enter product quantity",
                number: "Please select numericals",
                maxlength: "Product quantity can't exceed the above limit."
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

            uploadFile_0: {
              required: "Please select image",
              accept: "Please select file with .jpg/.jpeg/.png extension only."
            },
            uploadFile_1: {
              required: "Please select image",
              accept: "Please select file with .jpg/.jpeg/.png extension only."
            },
            uploadFile_2: {
              required: "Please select image",
              accept: "Please select file with .jpg/.jpeg/.png extension only."
            }       
      }
 });

</script>


<style type="text/css">
  #add_product label.error{
    color: red;
  }
</style>

</body>



