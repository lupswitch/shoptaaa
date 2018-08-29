<div class="breadcrumb-div">
		<div class="container">
		<ol class="breadcrumb">
			<li class="breadcrumb-item active"><a href="<?php echo base_url(); ?>">Home</a></li>
			<li class="breadcrumb-item">Edit Profile</li>
		</ol>
		</div>
	</div>

<!-- Form of Edit Profile Page --->
<section class="edit-pro">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<div class="section2-headeing">
					<h2>Edit Profile</h2>
				</div>	
			</div>
			<div class="col-xs-12">
			<div class="col-md-12"><?php echo $this->session->flashdata('verify_msg'); ?></div> 
				<div class="edit_profile-d">
					
					<?php $attributes = array('id' => 'profile'.$profile->user_id.'' ,'class'=>'');
					echo form_open_multipart('account/profile/edit', $attributes);?>
					
					<input type="hidden"  name="user_id" value="<?php echo $profile->user_id;  ?>" >
					<div class="acc-details">
						
						<h5>Account Details</h5>
						<div class="col-md-6 edit-left">
							<div class="form-group">
								<label for="exampleInputAddress">Email-id<span>*</span></label>
								<input type="text" class="form-control" id="email" name="email" placeholder="Enter a email" value="<?php if((isset($profile->email))) { echo $profile->email;} else{ echo set_value('email');} ?>" >
								<span class="text-danger"><?php echo form_error('email'); ?></span>
							</div>
						</div>	
						
						
						<div class="col-md-6 edit-right">
							<div class="form-group">
								<label for="exampleInputAddress">Password</label>
								<input type="password" class="form-control" name="password" id="password" placeholder="" value="">
								
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
					
					
					<div class="genral-details">
						<h5>General information</h5>
						<div class="col-md-6 edit-left">
							<div class="form-group">
								<label for="exampleInputAddress">First Name<span>*</span></label>
								<input type="text" class="form-control" id="firstName" name="firstName" placeholder="" value="<?php if((isset($profile->firstName))) { echo $profile->firstName;} else{ echo set_value('firstName');} ?>">
								<span class="text-danger"><?php echo form_error('firstName'); ?></span>
							</div>
						</div>	
						
						<div class="col-md-6 edit-right">
							<div class="form-group">
								<label for="exampleInputAddress">Last Name<span>*</span></label>
								<input type="text" class="form-control" id="lastName" name="lastName" placeholder="" value="<?php if((isset($profile->lastName))) { echo $profile->lastName;} else{ echo set_value('lastName');} ?>">
								<span class="text-danger"><?php echo form_error('lastName'); ?></span>
							</div>
							<div class="clearfix"></div>
						</div>
						
						<div class="date-birth">
							
							<div class="col-md-6 edit-left">
								<div class="form-group">
									<label for="exampleInputAddress">Date of Birth</label>
									<div class="input-group date">
										<div class="input-group-addon">
											<i class="fa fa-calendar"></i>
										</div>
										<input placeholder="YYYY-MM-DD" class="form-control pull-right" id="datepicker" name="dob" type="text" Value="<?php if((isset($profile->dob)) && $profile->dob != '0000-00-00') { echo $profile->dob;} else {echo set_value('dob');} ?>" />
									</div>
								</div>
							</div>
							
							<div class="col-md-6 edit-right">
								<div class="form-group">
									<label for="exampleInputAddress">Gender</label>
									<select class="form-control" id="userGender" name="userGender">
										<option value="male" <?php echo ($profile->userGender == 'male')? 'selected' : ""; ?>> Male </option>
										<option value="female" <?php echo ($profile->userGender == 'female')? 'selected' : ""; ?>> Female </option>
										<option value="others" <?php echo ($profile->userGender == 'others')? 'selected' : ""; ?>> Others </option>
									</select>
								</div>
								<div class="clearfix"></div>
							</div>
							
							<div class="col-md-6 edit-left">
								<div class="form-group">
									<label for="exampleInputAddress">Phone Number<span>*</span></label>
									<input type="text" class="form-control" id="phoneNumber" name="phoneNumber" placeholder="Enter Phone Number" Value="<?php if((isset($profile->phoneNumber))) { echo $profile->phoneNumber;} else{ echo set_value('phoneNumber');} ?>" />
									<span class="text-danger"><?php echo form_error('phoneNumber'); ?></span>
								</div>
								<div class="clearfix"></div>
							</div>
							
							<div class="col-md-6 edit-right">
								<div class="form-group">
								<label for="exampleInputAddress">Location<span>*</span></label>
									<input type="text" class="form-control" id="userLocation" name="userLocation" placeholder="Enter Address" Value="<?php if((isset($profile->userLocation))) { echo $profile->userLocation;} else{ echo set_value('userLocation');} ?>" />
									<span class="text-danger"><?php echo form_error('userLocation'); ?></span>
								</div>
								<div class="clearfix"></div>
							</div>
							
							<div class="col-md-12 full-sec">
								<div class="form-group">
								<label for="exampleInputAddress">Bio</label>
									<textarea id="userBio" name="userBio" placeholder="Enter Bio" rows="2" cols="80" ><?php echo (isset($profile->userBio))? $profile->userBio : "" ;   ?></textarea>
								</div>
								<div class="clearfix"></div>
							</div>
							
							
						</div>
						<div class="clearfix"></div>	
					</div>
					
					<div class="btn-save col-sm-12">
						<button type="submit" name="updateprofile" class="btn-success">Save</button>
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
<script>
	$(function () {
		
		//Date picker
		$('#datepicker').datepicker({
			autoclose: true,
			format: 'yyyy-mm-dd',
			todayHighlight: false,
			clearBtn: true
		});   
		
	}); 
	</script>		