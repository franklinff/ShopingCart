<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  
<!-- <link rel="stylesheet" type="text/css" href = "http://localhost/project/bootstrap/css/bootstrap.min.css"> -->

<link rel="stylesheet" type="text/css" href = "<?php echo base_url("/bootstrap/css/bootstrap.min.css")?>">

<link rel="stylesheet" type="text/css" href = "<?php echo base_url("/application/admin/dist/css/AdminLTE.min.css")?>">

<link rel="stylesheet" type="text/css" href = "http://localhost/project/application/admin/plugins/iCheck/square/blue.css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>

<body class="hold-transition login-page">


<form action="Login" method="POST" id="login"> 
<div class="login-box">

  <div class="login-logo">
    <a href="../../index2.html"><b>Admin</b>LTE</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

            <span style='color:red'>
            <?php
           // echo $this->session->flashdata('error');
            ?>
            </span>

      <div class="form-group has-feedback">
        <input id="email" name="email" type="email" placeholder="Email" class="form-control"   >
        <?php //echo form_error('Email'); ?>
        <span  style="" class="glyphicon glyphicon-envelope form-control-feedback"></span>       
      </div>

      <div class="form-group has-feedback">
        <input id="password" name="password" type="password" placeholder="Password" class="form-control"   >
        <?php// echo form_error('Password'); ?>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>

      <div class="row">
          <div class="col-xs-8">
            <div class="checkbox icheck">
              <label>
                <input type="checkbox"> Remember Me
              </label>
            </div>
          </div>
           
          <div class="col-xs-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
          </div>       
      </div>         
  </div>
 
</div>
</form>

<script src="http://localhost/project/application/admin/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->

<script src="http://localhost/project/application/admin/bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="http://localhost/project/application/admin/plugins/iCheck/icheck.min.js"></script>

<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>



<script src="<?php echo base_url("jquery.validate.js")?>"></script>
<script type="text/javascript">  
  $("#login").validate({
                  rules: {
                          email: {
                                    required: true,
                                    email: true
                                  },
                          password: {
                                    required: true,
                                   }
                        },

                  messages: {
                          email: {
                                   required: "Please enter email address",
                                   email: "Please enter a valid email address",
                                  },
                          password: {
                                    required: "Please provide a password",
                            }
                        }
   });
</script>

<style type="text/css">
      #login label.error{
        color: red;
      }
</style>
