<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Edit configuration
      </h1>
    </section>

<div style="width: 50%">
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <!-- /.box -->
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body">

                <form id="edit_config" method="post">
        
                <label>Configuration key</label><br></br>
                <div class="col-sm-12" >

                <?php if ($current_config[0]['id']==1){ ?>

                <p>Admin Email</p> 

                <?php }else{ ?>

                <p>Notification Email</p> 

                <?php } ?>

                </div><br></br>

                <label>Configuration value</label><br></br>
                <div class="col-sm-12" style="width: 92%">
                    <input name="config_value" id="config_value" type="text" class="form-control" 
                    value="<?php echo $current_config[0]['conf_value']; ?>" >
                </div><br></br>
            
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
  <!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<script src="<?php echo base_url("jquery.validate.js")?>"></script>

<script>
 $("#edit_config").validate({
    rules: {

              config_value: {
              required: true,
              email: true
              }
            },
    messages: {
              config_value: "Please enter valid Email"
      }
 });
</script>

<style type="text/css">
  #edit_config label.error{
    color: red;
  }
</style>

</body>

