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
				
				<?php echo form_open('users/edit/'.$user['id'], array("class" => "form-horizontal", "method" => "post", "role" => "form")); ?>
					<div class="form-group">
		            	<label for="name" class="col-sm-2 control-label">Name:</label>
		            	<div class="col-sm-10">
			               <input type="text" disabled name="name" id="name" class="form-control" value="<?php echo $user['name'] ?>">
		                </div>
		            </div>
				
					<div class="form-group">
		            	<label for="id" class="col-sm-2 control-label">ID:</label>
		            	<div class="col-sm-10">
			               <input type="text" disabled name="id" id="id" class="form-control" value="<?php echo $user['id'] ?>">
		                </div>
		            </div>
				
					<div class="form-group">
		            	<label for="companyName" class="col-sm-2 control-label">Company Name:</label>
		            	<div class="col-sm-10">
			               <input type="text" disabled name="companyName" id="companyName" class="form-control" value="<?php echo $user['companyName'] ?>">
		                </div>
		            </div>
				
					<div class="form-group">
		            	<label for="contribuinteNumber" class="col-sm-2 control-label">VAT Number:</label>
		            	<div class="col-sm-10">
			               <input type="text" disabled id="contribuinteNumber" class="form-control" value="<?php echo $user['contribuinteNumber'] ?>">
		                </div>
		            </div>
				
					<div class="form-group">
		            	<label for="phoneNumber" class="col-sm-2 control-label">Phone Number:</label>
		            	<div class="col-sm-10">
			               <input type="text" disabled id="phoneNumber" class="form-control" value="<?php echo $user['phoneNumber'] ?>">
		                </div>
		            </div>
				
					<div class="form-group">
		            	<label for="address" class="col-sm-2 control-label">Address:</label>
		            	<div class="col-sm-10">
			               <input type="text" disabled id="address" class="form-control" value="<?php echo $user['address'] ?>">
		                </div>
		            </div>
				
		            <div class="form-group">
		            	<label for="email" class="col-sm-2 control-label">Email:</label>
		            	<div class="col-sm-10">
			               <input type="text" disabled id="email" class="form-control" value="<?php echo $user['email'] ?>">
		                </div>
		            </div>
		            
		            <div class="form-group">
		            	<label for="companyType" class="col-sm-2 control-label">Company type:</label>
		            	<div class="col-sm-10">
			                <select id="companyType" name="companyType" class="form-control">
			                    <option value="Select company type" disabled selected>Select company type</option>
			                    <option value="Floriste">Fleuriste</option>
			                    <option value="Grossiste">Grossiste</option>
			                    <option value="unknown">Unknown</option>
			                </select>
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
		        