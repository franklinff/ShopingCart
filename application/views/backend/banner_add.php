<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add banner
      </h1>
    </section>

<div style="width: 75%">
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-8">
          <!-- /.box -->
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body">

                <?php
                  $attributes = array(
                    'id' => 'do_upload',
                    'method' => 'post'
                    );
                  echo form_open_multipart('index.php/banner/upload_image',$attributes);
                ?>
     <!--  <form action="do_upload" method="post" id="do_upload"> -->

                <label>Upload banner</label><br></br>
                <div class="col-sm-12" style="width: 92%">
                <input id="uploadFile" name="uploadFile" type="file" placeholder="Choose File" class="mandatory_fildes">
                </div><br></br>

                <label>Status</label>                  

                </div> 
                <div class="form-group">
                                
                                <input type="radio" name="optionsRadios" value="1">Active<br>
                                <input type="radio" name="optionsRadios" value="0">Inactive<br>
                                <p id="err_status" class="err_msg"></p>                                
                            </div>
          
                <div  align="center" ><button style="width:15%" type="submit" class="btn btn-block btn-primary">Submit</button>
                </div>
         
                <?php
                echo form_close();    
                ?>

     <!--  </form> -->
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

<script src="<?php echo base_url("jquery.validate.js")?>"></script>

<script type="text/javascript">
  $("#do_upload").validate({
                rules: {
                    uploadFile: "required"
                  }                
    });
</script>


<style type="text/css">
  #do_upload label.error{
    color: red;
  }
</style>

</body>



