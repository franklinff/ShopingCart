<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit banner
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

<form method="POST" enctype="multipart/form-data" action="">

<?php 
if($current_banner){
foreach ($current_banner as $row) {
/* echo'<pre>';
  print_r($row);
  die();*/
?>
                <label>Upload banner</label><br></br>
                <div class="col-sm-12" style="width: 92%">
                <span><img src="<?php echo base_url();?>uploads/<?php echo $row['banner_path']; ?>" style="width:160px"></span>
                <br></br>
                    <input id="uploadFile" name="uploadFile" type="file" placeholder="Choose File" class="mandatory_fildes">         

                </div><br></br>

                <label>Status</label>                  
                <div class="form-group"> 

                    <?php 
                    if ($row['status']==1){
                    ?> 

                        <input type="radio" name="optionsRadios" value="1" checked="checked">Active<br>
                    <?php } else { ?>
                        <input type="radio" name="optionsRadios" value="1" >Active<br>
                    <?php }?>

                    <?php 
                    if ($row['status']==0){
                    ?> 

                        <input type="radio" name="optionsRadios" value="0" checked="checked">Inactive<br>
                    <?php } else { ?>
                        <input type="radio" name="optionsRadios" value="0" >Inactive<br>

                    <?php }?>

                    <p id="err_status" class="err_msg"></p>                                
                </div>
                
                <div  align="center" >
                <button style="width:15%" type="submit" class="btn btn-block btn-primary">Submit</button>
                </div>
<?php 
   }
}
?>         
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
</body>



