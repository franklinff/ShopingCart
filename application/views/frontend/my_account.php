 <div class="col-sm-6">
    <div class="total_area">
            <ul>
            	   <label><h2>My account</h2></label>
                   
                   <form action="update" method="POST" id="login"> 
					<li class="fileds">
						<div class="name_fileds">
							<label>Firstname</label>
							<input name="firstname" type="text" value= "<?php echo $user[0]['firstname']; ?>" /> 
						</div>
					</li>
					</br>
					
					<li class="fileds">
						<div class="name_fileds">
							<label>Lastname</label>
							<input name="lastname" type="text" value="<?php echo $user[0]['lastname']; ?>" /> 
						</div>
					</li>
					</br>
										
					<li class="fileds">
						<div class="name_fileds">
							<label>Email</label>
							<input name="email" type="email" value="<?php echo $user[0]['email']; ?>" disabled /> 
						</div>
					</li>
					</br>

					<button type="submit" class="btn btn-default">Submit</button>
					</form>
					</br>

					<div class="name_fileds">
						<a href="<?php echo base_url('index.php/User_login/') ?>" class="active">
							<?php if(!empty($this->session->userdata('user_login'))){   ?>
								<a href="<?php echo site_url('index.php/Change_password')?>">Change password</a>
							<?php } ?>  
						</a>
					</div>
			</ul>				
    </div>
</div>


					