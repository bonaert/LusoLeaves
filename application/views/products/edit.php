<div class="section">
	<div class="container">
		<div class="row">
	   		<div class="col-lg-12">
  
				<?php if(validation_errors()): ?>
				<div class="alert alert-danger">
					<?php echo validation_errors(); ?>
			    </div>
			    <?php endif; ?>
			    		    
				<h2>Edit Product</h2>
			
					
	            <?php echo form_open_multipart('products/edit/'.$product['id'], array("class" => "form-horizontal", "role" => "form")); ?>
	
		            <div class="form-group">
		            	<label for="name" class="col-sm-2 control-label">Name:</label>
		            	<div class="col-sm-10">
			               <input type="text" name="name" id="name" class="form-control" value="<?php echo $product['name']; ?>">
		                </div>
		            </div>
		
		            <div class="form-group">
		            	<label for="image" class="col-sm-2 control-label">Image:</label>
		            	<div class="col-sm-10">
			               <input type="file" name="image" id="image" class="form-control">
		                </div>
		            </div>
		            
		             <div class="form-group">
		            	<label for="tpb" class="col-sm-2 control-label">Tiges par Bouquet:</label>
		            	<div class="col-sm-10">
			               <input type="text" name="tpb" id="tpb" class="form-control" value="<?php echo $product['tpb']; ?>">
		                </div>
		            </div>
		            
		            		           
					<div class="form-group">
		            	<label for="bpc" class="col-sm-2 control-label">Bouquets par caisse:</label>
		            	<div class="col-sm-10">
			               <input type="text" name="bpc" id="bpc" class="form-control" value="<?php echo $product['bpc']; ?>">
		                </div>
		            </div>
		            
					<div class="form-group">
		            	<label for="prixFloriste" class="col-sm-2 control-label">Prix Fleuriste:</label>
		            	<div class="col-sm-10">
			               <input type="text" name="prixFloriste" id="prixFloriste" class="form-control" value="<?php echo $product['prixFloriste'] ?>">
		                </div>
		            </div>
		            
		            <div class="form-group">
		            	<label for="prixGrossiste" class="col-sm-2 control-label">Prix Grossiste:</label>
		            	<div class="col-sm-10">
			               <input type="text" name="prixGrossiste" id="prixGrossiste" class="form-control" value="<?php echo $product['prixGrossiste'] ?>">
		                </div>
		            </div>
		
		             
		            <div class="form-group">
		            	<label for="isAvailable" class="col-sm-2 control-label">Is Available:</label>
		            	<div class="col-sm-10">
		            		<select name="isAvailable" id="isAvailable" class="form-control">
		            			<option value="1" <?php if($product['isAvailable']==="1"): ?>selected<?php endif;?>>Yes</option>
		            			<option value="0" <?php if($product['isAvailable']==="0"): ?>selected<?php endif;?>>No</option>
		            		</select>
		                </div>
		            </div>
		            
		            <div class="form-group">
		            	<label for="availabilityDate" class="col-sm-2 control-label">Availability date:</label>
		            	<div class="col-sm-10">
			               <input type="text" name="availabilityDate" id="availabilityDate" class="form-control" value="<?php echo $product['availabilityDate'] ?>">
		                </div>
		            </div>
	
	            	<div class="form-group">
			    		<div class="col-sm-offset-2 col-sm-10">
			      			<input class="btn btn-success" type="submit" name="commit" value="Save">
			      		</div>
			      	</div>	
	        	</form>
	
		        <hr>
		
		        <a href="<?= site_url('products/delete/') . '/' . $product['id'] ?>" class="btn btn-danger">
		            Delete
		        </a>

   			 </div>
		</div>
	</div>
</div>


