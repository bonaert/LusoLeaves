<div class="section">
	<div class="container">
		<div class="row">
	   		<div class="col-lg-12">
	   		
	   			<?php if(validation_errors()): ?>
	   			<div class="alert alert-danger">
			        <?php echo validation_errors(); ?>
			    </div>
			    <?php endif; ?>
	   			<h2>Login</h2>

    			<?php echo form_open('users/login', array("class" => "form-horizontal", "method" => "post", "role" => "form")); ?>
			        <div class="form-group">
			        	<label for="email" class="col-sm-2 control-label">Email</label>
			            <div class="col-sm-4">
			            	<input class="form-control" type="text" id="email" name="email" required="true" placeholder="Email">
			            </div>
			        </div>
	
			        <div class="form-group">
			        	<label for="password" class="col-sm-2 control-label">Password</label>
			        	<div class="col-sm-4">
			            	<input class="form-control" type="password" id="password" name="password" required="true" placeholder="Password">
			            </div>
			        </div>

			        <div class="form-group">
			    		<div class="col-sm-offset-2 col-sm-4">
			      			<input class="btn btn-success" type="submit" name="commit" value="Register" onclick="formhash(this.form, this.form.password);">
			      		</div>
			      	</div>
			    </form>
			    
			</div>
		</div>
	</div>
</div>
		        