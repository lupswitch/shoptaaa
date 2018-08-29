<div class="breadcrumb-div">
		<div class="container">
		<ol class="breadcrumb">
			<li class="breadcrumb-item active"><a href="<?php echo base_url(); ?>">Home</a></li>
			<li class="breadcrumb-item">Edit My Address</li>
		</ol>
		</div>
	</div>

<!-- Form of Edit Profile Page --->
<section class="edit-pro">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				
			</div>
			<div class="col-xs-12">
			<div class="col-md-12"><?php echo $this->session->flashdata('verify_msg'); ?></div> 
				<div class="edit_profile-d">
					
					<?php 
						$attributes = array('id' => 'profile'.$myAddress['id'].'' ,'class'=>'');
					echo form_open_multipart('account/my-address/edit', $attributes);?>
					
					

					<div class="genral-details">
						<h5>My Address</h5>
						<div class="col-md-6 edit-left">
							<div class="form-group">
								<label for="exampleInputAddress">Address</label>
								<input type="text" class="form-control" id="address" name="address" placeholder="Enter a address" value="<?php echo (isset($myAddress['address']))? $myAddress['address'] : "" ;   ?>" >
								<span class="text-danger"><?php echo form_error('address'); ?></span>
							</div>
							 <div class="form-group">
							<label for="exampleInputAddress">State</label>
							<input type="text" class="form-control" id="State" name="state" placeholder="Enter a state" value="<?php echo (isset($myAddress['State']))? $myAddress['State'] : "" ;   ?>" >
							<span class="text-danger"><?php echo form_error('state'); ?></span>
							</div>
							<div class="form-group">
									<label for="exampleInputAddress">Zip</label>
									<input type="text" class="form-control" id="Zip" name="zip" placeholder="Enter Zip" Value="<?php echo (isset($myAddress['Zip']))? $myAddress['Zip'] : "" ;   ?>" />
									<span class="text-danger"><?php echo form_error('zip'); ?></span>
								</div>
							
						</div>	
						
						<div class="col-md-6 edit-right">
							<div class="form-group">
								<label for="exampleInputAddress">City</label>
								<input type="text" class="form-control" id="City" name="city" placeholder="Enter a City" value="<?php echo (isset($myAddress['City']))? $myAddress['City'] : "" ;   ?>" >
								<span class="text-danger"><?php echo form_error('city'); ?></span>
							</div>
							
						
					
								<div class="form-group">
									<label for="exampleInputAddress">Country</label>
									<select class="form-control" id="Country" name="country">
											<option>-- Please Select --</option>	
											
											  <?php foreach($country as $singlecountry) { ?>
                                       
                                   <option value="<?php echo $singlecountry['name'];?>" <?php if($myAddress['Country'] == $singlecountry['name']) { echo "selected"; } ?>><?php echo $singlecountry['name']; ?></option>
                                       
                                  <?php }    ?>    										  	
																	
									
										</select>
								</div>
								
							
					
								<div class="form-group">
								<label for="exampleInputAddress">Phone Number</label>
									<input type="text" class="form-control" id="PhoneNumber" name="phonenumber" placeholder="Enter PhoneNumber" Value="<?php echo (isset($myAddress['PhoneNumber']))? $myAddress['PhoneNumber'] : "" ;   ?>" />
									<span class="text-danger"><?php echo form_error('phonenumber'); ?></span>
								</div>
								<div class="clearfix"></div>
							</div>
							
							
				
						<div class="clearfix"></div>	
					</div>
					
					<div class="btn-save col-sm-12">
						<input type="submit" name="updatemyaddress" class="btn-success" value="save">
					</div>
					<div class="clearfix"></div>
				</form>
			</div>
		</div>
	</div>
</div>	
<div class="clearfix"></div>
</section>


<!-- End Form of checkout Page --->	
		