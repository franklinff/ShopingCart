
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Login | E-Shopper</title>

  <link rel="stylesheet" type="text/css" href = "<?php echo base_url("/bootstrap/css/bootstrap.min.css")?>">
  <link rel="stylesheet" href="<?php echo base_url("/Eshopper/css/font-awesome.min.css")?>">
  <link rel="stylesheet" href="<?php echo base_url("/Eshopper/css/prettyPhoto.css")?>">
  <link rel="stylesheet" href="<?php echo base_url("/Eshopper/css/price-range.css")?>">
  <link rel="stylesheet" href="<?php echo base_url("/Eshopper/css/animate.css")?>">

	<link rel="stylesheet" href="<?php echo base_url("/Eshopper/css/main.css")?>" >
	<link rel="stylesheet" href="<?php echo base_url("/Eshopper/css/responsive.css")?>">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">


    <style type="text/css">
    .alphacapital{
      text-transform: capitalize;
    }
	</style>

</head><!--/head-->


<header id="header"><!--header-->
	
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href=""><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
								<li><a href=""><i class="fa fa-envelope"></i> info@domain.com</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href=""><i class="fa fa-facebook"></i></a></li>
								<li><a href=""><i class="fa fa-twitter"></i></a></li>
								<li><a href=""><i class="fa fa-linkedin"></i></a></li>
								<li><a href=""><i class="fa fa-dribbble"></i></a></li>
								<li><a href=""><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->


		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					
					<div class="col-sm-4">

						<div class="logo pull-left">
							<a href="<?php echo base_url("UserLogin");?>"><img src="<?php echo base_url("/Eshopper/images/home/logo.png")?>"></a>
						</div>

					</div>

					<div class="col-sm-8">

						<div class="mainmenu pull-right">
							<ul class="nav navbar-nav">
							
							
							<div class="logo pull-left">
								<a href="<?php echo base_url("Shop");?>"><img src="<?php echo base_url('Eshopper/images/home/shop_img.jpg' )?>" style="height: 70px; width:150px; margin-top: -13%;"></a>
							</div>
							
							

							<li>
							<a href="<?php echo base_url('UserLogin/') ?>" class="active" style="margin-top: 18%;">
							<?php if(!empty($this->session->userdata('user_login'))){   ?>
								<a href="<?php echo site_url('user_login/logout')?>">
									<i class="fa fa-lock"></i>Logout</a>
							<?php }else{ ?>
							        <i class="fa fa-lock"></i>Login
							<?php } ?>		
							</a>
							</li>

							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->

 	<script src="<?php echo base_url("/Eshopper/js/jquery.js")?>"></script>
	<script src="<?php echo base_url("/Eshopper/js/price-range.js")?>"></script>
    <script src="<?php echo base_url("/Eshopper/js/jquery.scrollUp.min.js")?>"></script>
	<script src="<?php echo base_url("/Eshopper/js/bootstrap.min.js")?>"></script>
    <script src="<?php echo base_url("/Eshopper/js/jquery.prettyPhoto.js")?>"></script>
    <script src="<?php echo base_url("/Eshopper/js/main.js")?>"></script>



