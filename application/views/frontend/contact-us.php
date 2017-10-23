<div id="contact-page" class="container">
    	<div class="bg">

	    	<div class="row">    		
	    		<div class="col-sm-12">    			   			
				<h2 class="title text-center">Contact <strong>Us</strong></h2>    			    			
					<?php 
                	if($this->session->flashdata('error_msg')){
                	echo "<span style='color:green'>".$this->session->flashdata('error_msg')."</span><br>";
                	}
            		?>
				</div>			 		
			</div> 

    		<div class="row">  	
	    		<div class="col-sm-8">
	    			<div class="contact-form">
	    				<h2 class="title text-center">Get In Touch</h2>
	    				<div class="status alert alert-success" style="display: none"></div>

                        <form id="main-contact-form" class="contact-form row" action="<?php echo base_url(); ?>index.php/contactUs/add" name="contact-form" method="post">
				            
				            <div class="form-group col-md-6">
				                <input type="text" name="name" class="form-control" required="required" placeholder="Name" style="text-transform:capitalize">
				            </div>
				            
				            <div class="form-group col-md-6">
				                <input type="email" name="email" class="form-control" required="required" placeholder="Email">
				            </div>
				            
				            <div class="form-group col-md-12">
				                <input type="text" name="contact_no" class="form-control" required="required" placeholder="Contact No">
				            </div>
                            
                            <div class="form-group col-md-12">
				                <input type="text" name="subject" class="form-control" required="required" placeholder="Subject" style="text-transform:capitalize">
				            </div>
				            
				            <div class="form-group col-md-12">
				                <!-- <textarea name="message" id="message" required="required" class="form-control" rows="8" placeholder="Your Message Here" style="text-transform:capitalize"></textarea> -->

				            <!--     <textarea id="message" name="message" rows="10" cols="80" placeholder="Your Message Here">    
    		                </textarea>
 -->

	<textarea cols="10" id="message" name="message" rows="10" >Type your message here.
	</textarea>




				            </div>                        
				            
				            <div class="form-group col-md-12">
				                <input type="submit" class="btn btn-primary pull-right" value="Submit">
				            </div>
				        </form>
	    			</div>
	    		</div>

	    		<div class="col-sm-4">
	    			<div class="contact-info">
	    				<h2 class="title text-center">Contact Info</h2>
	    				<address>
	    					<p>E-Shopper Inc.</p>
							<p>935 W. Webster Ave New Streets Chicago, IL 60614, NY</p>
							<p>Newyork USA</p>
							<p>Mobile: +2346 17 38 93</p>
							<p>Fax: 1-714-252-0026</p>
							<p>Email: info@e-shopper.com</p>
	    				</address>
	    				<div class="social-networks">
	    					<h2 class="title text-center">Social Networking</h2>
							<ul>
								<li>
									<a href="#"><i class="fa fa-facebook"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-twitter"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-google-plus"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-youtube"></i></a>
								</li>
							</ul>
	    				</div>
	    			</div>
    			</div> 

	    	</div>  
    	</div>	
    </div><!--/#contact-page-->




<script src="https://cdn.ckeditor.com/4.7.3/standard-all/ckeditor.js"></script>
<script>
  $(function () {

    CKEDITOR.replace('message',{
			extraPlugins: 'placeholder',
			height: 220
		} );

    $(".textarea").wysihtml5();

    config.extraPlugins = 'placeholder';
  });
</script>



    
<script type="text/javascript">
    $(document).ready(function(){
       $('#main-contact-form').validate({
           rules:{
               name:{
                   required:true,
               },
               email:{
                   required:true,
                   email: true,
               },
               contact_no:{
                   required:true,
                   number:true,
               },
               subject:{
                   required:true,
               },
               message:{
                   required:true,
               },
           },
           messages:{
               name:{
                   required:"Please enter your name",
               },
               email:{
                   required:"Please enter email",
               },
               contact_no:{
                   required:"Please enter contact no",
                   number:"Please enter valid contact number"
               },
               subject:{
                   required:"Please enter subject",
               },
               message:{
                   required:"Please enter message",
               },
           }
       }); 
    });
</script>  
  
<style>
    #main-contact-form label.error{
        font-weight: normal;
        color : red;
    } 
</style>