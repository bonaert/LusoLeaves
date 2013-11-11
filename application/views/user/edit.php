<div class="section">
	<div class="container">
		<div class="row">
	   		<div class="col-lg-12">
  
				<?php if(validation_errors()): ?>
				<div class="alert alert-danger">
					<?php echo validation_errors(); ?>
			    </div>
			    <?php endif; ?>
			    		    
				<h2>Edit User</h2>
				
				<?php echo form_open('users/edit/'.$user['id'], array("class" => "form-horizontal", "role" => "form")); ?>
					<div class="form-group">
		            	<label for="name" class="col-sm-2 control-label">Name:</label>
		            	<div class="col-sm-10">
							<?php echo form_input(array(
									"name" => "name", 
									"id" => "name", 
									"disabled" => "disabled", 
									"class" => "form-control", 
									"value" => $user['name']
							)); ?>
		                </div>
		            </div>
				
					<div class="form-group">
		            	<label for="id" class="col-sm-2 control-label">ID:</label>
		            	<div class="col-sm-10">
			            	<?php echo form_input(array(
			            			"name" => "id", 
			            			"id" => "id", 
			            			"disabled" => 
			            			"disabled", 
			            			"class" => "form-control", 
			            			"value" => $user['id']
			            	)); ?>
		                </div>
		            </div>
				
					<div class="form-group">
		            	<label for="companyName" class="col-sm-2 control-label">Company Name:</label>
		            	<div class="col-sm-10">
							<?php echo form_input(array(
									"name" => "companyName", 
									"id" => "companyName", 
									"disabled" => "disabled", 
									"class" => "form-control", 
									"value" => $user['companyName']
							)); ?>
		                </div>
		            </div>
				
					<div class="form-group">
		            	<label for="contribuinteNumber" class="col-sm-2 control-label">VAT Number:</label>
		            	<div class="col-sm-10">
							<?php echo form_input(array(
									"name" => "contribuinteNumber", 
									"id" => "contribuinteNumber", 
									"disabled" => "disabled", 
									"class" => "form-control", 
									"value" => $user['contribuinteNumber']
							)); ?>
		                </div>
		            </div>
				
					<div class="form-group">
		            	<label for="phoneNumber" class="col-sm-2 control-label">Phone Number:</label>
		            	<div class="col-sm-10">
			               <?php echo form_input(array(
			               		"name" => "phoneNumber", 
			               		"id" => "phoneNumber", 
			               		"disabled" => "disabled", 
			               		"class" => "form-control", 
			               		"value" => $user['phoneNumber']
			               )); ?>
		                </div>
		            </div>
				
					<div class="form-group">
		            	<label for="address" class="col-sm-2 control-label">Address:</label>
		            	<div class="col-sm-10">
			          		<?php echo form_input(array(
			          				"name" => "address", 
			          				"id" => "address", 
			          				"disabled" => "disabled", 
			          				"class" => "form-control", 
			          				"value" => $user['address']
			          		)); ?>
		                </div>
		            </div>
				
		            <div class="form-group">
		            	<label for="email" class="col-sm-2 control-label">Email:</label>
		            	<div class="col-sm-10">
			            	<?php echo form_input(array(
			            			"name" => "email", 
			            			"id" => "email", 
			            			"disabled" => "disabled", 
			            			"class" => "form-control", 
			            			"value" => $user['email']
			            	)); ?>
		                </div>
		            </div>
		            
		            <div class="form-group">
		            	<label for="companyType" class="col-sm-2 control-label">Company type:</label>
		            	<div class="col-sm-10">
			                <?php
		            			echo form_dropdown(
										'companyType',
										array(
											'unknown' => 'Unknown',
											'Grossiste' => 'Grossiste',
											'Floriste' => 'Fleuriste',            			
			            				),
										$user['companyType'],
										'id="companyType" class="form-control"'
								); 
		            		?>
		                </div>
		            </div>
		            
		           	<div class="form-group">
			    		<div class="col-sm-offset-2 col-sm-10">
			      			<input class="btn btn-success" type="submit" name="commit" value="Save">
			      		</div>
			      	</div>		
		        </form>

			</div>
		</div>
	</div>
</div>
		        