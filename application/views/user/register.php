<div class="section">
	<div class="container">
		<div class="row">
	   		<div class="col-lg-12">
	   		
	   			<?php if(validation_errors()): ?>
	   			<div class="alert alert-danger">
			        <?php echo validation_errors(); ?>
			    </div>
			    <?php endif; ?>
			    
	   			<h2><?= lang('register') ?></h2>
	   			
	    		<?php echo form_open('users/register', array("class" => "form-horizontal", "role" => "form")); ?>
			        <div class="form-group">
			        	<label for="companyName" class="col-sm-2 control-label"><?= lang("registerCompanyName"); ?></label>
			            <div class="col-sm-10">
			            	<input class="form-control" type="text" id="companyName" name="companyName" required="true"
			                   placeholder="<?= lang("registerCompanyName"); ?>">
			            </div>
			        </div>
			
			        <div class="form-group">
			        	<label for="name" class="col-sm-2 control-label"><?= lang("registerName"); ?></label>
			        	<div class="col-sm-10">
			            	<input class="form-control" type="text" id="name" name="name" required="true"
			                   placeholder="<?= lang("registerName"); ?>">
			            </div>
			        </div>
					
			        <div class="form-group">
			        	<label for="phoneNumber" class="col-sm-2 control-label"><?= lang("registerPhoneNumber"); ?></label>
			        	<div class="col-sm-10">
			            	<input class="form-control" type="text" id="phoneNumber" name="phoneNumber" required="true"
			                   placeholder="<?= lang("registerPhoneNumber"); ?>">
			            </div>
			        </div>
			
			        <div class="form-group">
			        	<label for="contribuinteNumber" class="col-sm-2 control-label"><?= lang("registerContribuinteNumber"); ?></label>
			        	<div class="col-sm-10">
			            	<input class="form-control" type="text" id="contribuinteNumber" name="contribuinteNumber" required="true"
			                   placeholder="<?= lang("registerContribuinteNumber"); ?>">
			            </div>
			        </div>
			
			        <div class="form-group">
			        	<label for="address" class="col-sm-2 control-label"><?= lang("registerAddress"); ?></label>
			        	<div class="col-sm-10">
			            	<input class="form-control" type="text" id="address" name="address" required="true"
			                   placeholder="<?= lang("registerAddress"); ?>">
			            </div>
			        </div>
			
			        <div class="form-group">
			        	<label for="email" class="col-sm-2 control-label">Email</label>
			            <div class="col-sm-10">
			            	<input class="form-control" type="text" id="email" name="email" required="true" placeholder="Email">
			            </div>
			        </div>
			
			
			        <div class="form-group">
			        	<label for="password" class="col-sm-2 control-label">Password</label>
			        	<div class="col-sm-10">
			            	<input class="form-control" type="password" id="password" name="password" required="true" placeholder="Password">
			            </div>
			        </div>
			
			        <div class="form-group">
			    		<div class="col-sm-offset-2 col-sm-10">
			      			<input class="btn btn-success" type="submit" name="commit" value="Register" onclick="formhash(this.form, this.form.password);">
			      		</div>
			      	</div>
			    </form>
			    
			</div>
		</div>
	</div>
</div>

