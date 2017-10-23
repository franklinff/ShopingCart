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

<div style="width: 75%">
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <!-- /.box -->
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body">

              <form action="addUser" method="post" id="add_user">

                <label>Firstname</label><br></br>
                <div class="col-sm-12" style="width: 92%">
                  <input name="firstname" id="firstname" placeholder="Firstname" type="text" class="form-control alphacapital"  >
                </div><br></br>

                <label>Lastname</label><br></br>
                <div class="col-sm-12" style="width: 92%">
                    <input name="lastname" id="lastname" placeholder="Lastname" type="text" class="form-control alphacapital" >
                </div><br></br><br></br>

                <label>Email</label><br></br>
                <div class="col-sm-12" style="width: 92%">
                    <input name="email" id="email" placeholder="Email" type="text" class="form-control">
                </div><br></br>

                <label>Password</label><br></br>
                <div class="col-sm-10" style="width: 92%">
                    <input name="password" id="password" placeholder="Password" type="Password" class="form-control" >
                </div><br></br>



                <label>Confirm Password</label><br></br>
                <div class="col-sm-10" style="width: 92%">
                    <input name="confirmpwd" id="confirmpwd" placeholder="Password" type="Password" class="form-control" >
                </div><br></br>
                   <br></br>

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


   $("#add_user").validate({
    rules: {
            firstname: "required",
            lastname: "required",
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 6
            },
            confirmpwd: {
                required: true,
                 equalTo : "#password"
            },
            optionsRadios: "required",
            role_type: "required"
            },
    messages: {
            firstname: "Please enter your first-name",
            lastname: "Please enter your last-name",
            email: "Please enter a valid email address",
            password: {
                required: "Please provide a password",
                minlength: "Your password must be at least 5 characters long"
            },
            confirmpwd: {
               required: "Confirm your password",
               
            },
            role_type: "Please select role-type"
      }
 });

</script>

<style type="text/css">
  #add_user label.error{
    color: red;
  }
</style>

</body>



