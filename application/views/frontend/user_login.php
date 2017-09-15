<body>
	<section id="form"><!--form-->
		<div class="container">
			<div class="row">			
					<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->


						<span style="color:green;"><?php echo $this->session->flashdata('new_password_success'); ?></span>

						<h2>Login to your account</h2>

						<p class="login-box-msg" style="color:red;"><?php echo $this->session->flashdata('fail'); ?></p>

						<form action="User_login/login" method="POST" id="login">
							<input type="email" placeholder="Email Address" id="login_email" name="login_email" class="form-control" />
							<input type="password" placeholder="Password" id="login_password" name="login_password" class="form-control" />
							</br>
							<span>
								<input type="checkbox" class="checkbox"> 
								Keep me signed in
							</span>
							</br>
							
							<fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
							</fb:login-button>
							<br></br>

					
						<!-- 	<meta name="google-signin-client_id" 
							content="439039940405-074bbibdr5ddvbgk9cr96tj2i88hd3bc.apps.googleusercontent.com">
							<div class="g-signin2" data-onsuccess="onSignIn"></div>
							</br> -->
						

						<a href="<?php echo base_url("User_authentication_gmail");?>"><img src="<?php echo base_url("/Eshopper/images/home/sign-in-button.png")?>" style="width: 145px; height: 50px"></a></br>



							

							<a href="<?php echo base_url(); ?>Forgot_password")?> Forgot password?</a>


							<button type="submit" class="btn btn-default">Login</button>
						</form>
					</div><!--/login form-->
				</div>

				<div class="col-sm-1">
					<h2 class="or">OR</h2>
				</div>

				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
					<?php echo validation_errors(); ?>
						<h2>New User Signup!</h2>
						<p class="login-box-msg" style="color:green;"><?php echo $this->session->flashdata('success'); ?></p>
						<form action="User_login" method="POST" id="register">
							<input type="text" placeholder="First name" id="first_name" name="first_name"/>
							<span class="Firstname" id="err"></span>

							<input type="text" placeholder="Last name" id="last_name" name="last_name"/>
							<span class="Lastname" id="err"></span>
							
							<input type="email" placeholder="Email Address" id="email_add" name="email_add"/>
							<span class="Email" id="err"></span>
							
							<input type="password" placeholder="Password" id="password" name="password"/>
							<span class="Password" id="err"></span>
							
							<input type="password" placeholder="Confirm Password" id="conf_pwd" name="conf_pwd"/>
							<span class="Password" id="err"></span>
						
							<button type="submit" class="btn btn-default">Signup</button>
						</form>
					</div><!--/sign up form-->
				</div>
				

			</div>
		</div>
	</section><!--/form-->

	<script src="<?php echo base_url("jquery.validate.js")?>"></script>
	<script type="text/javascript">

	jQuery.validator.addMethod("lettersonly", function(value, element) {
            return this.optional(element) || /^[a-z\s]+$/i.test(value);
            }, "Only alphabetical characters");

	$("#register").validate({
	                rules: {
		                    first_name:  {
		                    	required: true,
		                    	lettersonly: true
		                    },
		                    last_name:  {
		                    	required: true,
		                    	lettersonly: true
		                    },
		                    email_add: {
						                required: true,
						                email: true
	           						   },
		                    password:  "required",
		                    conf_pwd: {
					                required: true,
					                equalTo : "#password"
					            }
	                  		},
	                messages: {

				            	first_name: "Please enter valid name",
				            	last_name: "Please enter your last-name",
				            	email_add: {
							                required: "Please enter email address",
							                email: "Please enter a valid email address",
		           						   },
				            	password: {
				                			required: "Please provide a password",
				            			  },
				            	conf_pwd: {
				              	 			required: "Confirm your password",
		            			          }
           					  }          
	    });

	$("#login").validate({
	                rules: {

	                	login_email: {
						                required: true,
						                email: true
	           						   },
						login_password: {
						                required: true,
	           						   }
	                	},
	                messages: {
	                	login_email: {
							required: "Please enter email address",
							email: "Please enter a valid email address",
		           					},
				        login_password: {
				            required: "Please provide a password",
				            	}
	                }
	 });
	</script>


<script src="https://apis.google.com/js/platform.js" async defer></script>

<script type="text/javascript">

	//<script src="https://apis.google.com/js/platform.js" async defer></script>

	<!-- <script type="text/javascript">
		function onSignIn(googleUser) {    //gmail registration
		 
		  var profile = googleUser.getBasicProfile();
		  console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
		  console.log('Name: ' + profile.getName());
		  console.log('Image URL: ' + profile.getImageUrl());
		  console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.

		  var id = profile.getId();
	      var name = profile.getName();
	      var email = profile.getEmail();
	      var url= '<?php echo base_url();?>index.php/User_login/gmail_login/';

	       $.ajax({
               url: '<?php echo base_url();?>index.php/User_login/gmail_login/',
               type: "POST",
               async: false,
               data: { 'id':id,'name':name,'email':email },

               success: function (data) {
              	// alert('hiiiiiiiiiiiiiiiiiiii');
                    window.location = "http://localhost/project/index.php/User_login/gmail_login";
	            }
	    	 	//console.log('Successful login for: ' + response.name);
	      		//window.location = "http://localhost/project/index.php/Home";
	    		});
		}
	</script>
 -->
	<script>
		function statusChangeCallback(response){
		    console.log('statusChangeCallback');
		    console.log(response);
		    if (response.status === 'connected') {
		     	testAPI();
		   	 	} else {
		        'into this app.';
		    	}
		  }

		function checkLoginState() {
		    FB.getLoginStatus(function(response) {
		      statusChangeCallback(response);
		    });
		  }

		window.fbAsyncInit = function() {
			    FB.init({
			      appId      : '1898439137095995',
			      cookie     : true,
			      xfbml      : true,
			      version    : 'v2.8'
			    });

				FB.getLoginStatus(function(response) {
		    	statusChangeCallback(response);
		  		});   
			  };

		(function(d, s, id){
		     var js, fjs = d.getElementsByTagName(s)[0];
		     if (d.getElementById(id)) {return;}
		     js = d.createElement(s); js.id = id;
		     js.src = "//connect.facebook.net/en_US/sdk.js";
		     fjs.parentNode.insertBefore(js, fjs);
		   }(document, 'script', 'facebook-jssdk'));

		function testAPI() {
	    	/*console.log('Welcome!  Fetching your information.... ');*/
	    	FB.api('/me?fields=id,name,email,permissions,picture', function(response)
	    	{
	    	var id = response.id;
	    	var name = response.name;
	        var email = response.email;
	        /*console.log(email);console.log(id);console.log(name);*/
	        	        
	        var url= '<?php echo base_url();?>index.php/User_login/facebook_login/';
	        //console.log(url);

			   $.ajax({
               url: '<?php echo base_url();?>index.php/User_login/facebook_login/',
               type: "POST",
               async: false,
               data: { 'id':id,'name':name,'email':email },
	    	 	//console.log('Successful login for: ' + response.name);
	      		//window.location = "http://localhost/project/index.php/Home";
			   success: function (data) {
              	// alert('hiiiiiiiiiiiiiiiiiiii');
                    window.location = "http://localhost/project/index.php/User_login/facebook_login/";              
	            },
	            failure: function (data) {
	                //alert('failllllllllllllllllllll');
	                die();
	            }

	    		});
	  	 })
	  	}
	</script>

	<style type="text/css">
		  #register label.error{
		    color: red;
		  }

		  #login label.error{
		    color: red;
		  }

		  #err {
		  	color: red;
		  }
	</style>

</body>


