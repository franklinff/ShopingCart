<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Coupon
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

              <form action="" method="post" id="edit_coupon" >

                <label>Coupon code</label>
                <div class="col-xl-12">
                  <input name="code" id="code" type="text" class="form-control"  
                  value="<?php echo $current_coupon[0]['code'];?>" >
                </div></br>
               
                <label>Percent off</label>
                <div class="col-xl-12">
                    <input name="percent_off" id="percent_off"  type="text" class="form-control"
                     value="<?php echo $current_coupon[0]['percent_off'];?>">
                </div></br>
    
                <label>Number of uses</label>
                <div class="col-xl-12">
                <input name="no_of_uses" id="no_of_uses"  type="text" class="form-control"
                value="<?php echo $current_coupon[0]['no_of_uses'];?>" >
                </div></br>

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

   $("#edit_coupon").validate({
    rules: {
            code: "required",            
            percent_off: {
                required: true,
                number: true,
            },
            no_of_uses: {
                required: true,
                number: true
            },

            },

    messages: {
            code: "Please enter coupon code.",
            percent_off: {
                required:"Please enter percentage.",
                number: "Please select numericals"
            },
            no_of_uses:  {
                required: "Please enter the number of uses.",
                number: "Please select numericals"
            },
      }
 });
</script>


<style type="text/css">
  #edit_coupon label.error{
    color: red;
  }
</style>

</body>



