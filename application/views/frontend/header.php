
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
							<a href="<?php echo base_url("Shop");?>"><img src="<?php echo base_url("/Eshopper/images/home/logo.png")?>"></a>
						</div>

					</div>

					<div class="col-sm-8">

						<div class="mainmenu pull-right">
							<ul class="nav navbar-nav">
							
							<li><a href="<?php echo site_url('ContactUs')?>">Contact</a></li>

							<li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                    <li><a href="<?php echo base_url("Shop")?>">Products</a></li>		
									<li><a href="<?php echo base_url("Checkout") ?>">Checkout</a></li> 
                                </ul>
                            </li> 

                            <li class="dropdown"><a href="#">Account<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu" class="nav navbar-nav collapse navbar-collapse">
                                		<li><a href="<?php echo base_url('MyAccount') ?>">My account</a></li>
                                        <li><a href="<?php echo site_url('Address')?>">Address</a></li>
										<li><a href="<?php echo base_url("TrackOrder")?>">Track order</a></li> 
										<li><a href="<?php echo base_url("MyOrder")?>">My order details</a></li>
                                </ul>
                            </li>

                            

							<li><a href="<?php echo base_url('Wishlist') ?>"><i class="fa fa-star"></i> Wishlist</a></li>
								
						    <li><a href="<?php echo base_url('Cart') ?>"><i class="fa fa-shopping-cart"></i> Cart</a></li>
							
							<li>
							<a href="<?php echo base_url('UserLogin') ?>" class="active">
							<?php if(!empty($this->session->userdata('user_login')) || !empty($this->session->userdata('userData'))){   ?>
								<a href="<?php echo site_url('UserLogin/logout')?>"><i class="fa fa-lock"></i>Logout</a>
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




   