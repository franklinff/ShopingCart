<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add user
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


              <form action="" method="post" id="edit">

                <label>Firstname</label><br></br>
                <div class="col-sm-10" style="width: 92%">
                  <input name="firstname" id="firstname"  type="text" class="form-control"
                   value="<?php echo $current_user[0]['firstname']; ?>">
                
                </div><br></br>

                <label>Lastname</label><br></br>
                <div class="col-sm-10" style="width: 92%">
                    <input name="lastname" id="lastname" type="text" class="form-control" value="<?php echo $current_user[0]['lastname']; ?>" >
                </div><br></br>

                <label>Email</label><br></br>
                <div class="col-sm-10" style="width: 92%">
                    <input name="email" id="email" type="text" class="form-control" value="<?php echo  $current_user[0]['email']; ?>">
                </div><br></br

                <label>Status</label>                  
                <div class="radio">
                    <label>
                    <input name="optionsRadios" id="optionsRadios1" type="radio" value="1" checked>
                        Active 
                    </label>
                </div>
                <div class="radio">
                    <label>
                      <input name="optionsRadios" id="optionsRadios2" type="radio" value="0">
                        Inactive  
                     </label>
                </div>

                <div class="form-group" style="width: 50%">
                  <label>Role</label>
                  <select multiple="" class="form-control" name="role_type">
                    <option value="1">Super Admin</option>
                    <option value="2">Admin</option>
                    <option value="3">Inventory Manager</option>
                    <option value="4">Order manager</option>
                    <option value="5">Customer</option>
                  </select>
                </div>

                <div  align="center" ><button style="width:15%" type="submit" class="btn btn-block btn-primary">Submit</button>
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

<!-- page script -->
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

  $("#edit").validate({
    rules: {
            firstname: "required",
            lastname: "required",
            email: {
                required: true,
                email: true
            },
            role_type: "required"
            },
    messages: {
            firstname: "Please enter your first-name",
            lastname: "Please enter your last-name",
            email: "Please enter a valid email address",
            role_type: "Please select role-type"
      }
 });

</script>

<style type="text/css">
  #edit label.error{
    color: red;
  }
</style>


</body>

