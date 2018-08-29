<div class="breadcrumb-div">
	<div class="container">
		<ol class="breadcrumb">
			<li class="breadcrumb-item active"><a href="#">Home</a></li>
			<li class="breadcrumb-item">Profile</li>
		</ol>
	</div>
</div>

<!----pro-section-start-section---->
<section class="order-div dis">	 
	<!-----Container---->
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<div class="section2-headeing">
					<h2>Profile</h2>
				</div>	
			</div>
		</div>
		
		
		<!----Main if Start ------>
		
		
		
		<div class="col-sm-offset-2 col-sm-10">
			<a href="<?php echo base_url('account/profile/edit'); ?>"><button type="submit" class="button-edit pull-right">Edit Info</button></a>
		</div>
		
		<h4 class="text-color">Primary Information</h4>
		<div class="panel panel-default">
			<div class="panel-body">
				<form class="form-horizontal">
					<div class="form-group">
						<label class="col-xs-6 col-sm-2" for="Username">Username</label>
						<div class="col-xs-6 col-sm-10">
							<p class="form-control-static"><?php echo (isset($profile->userName))? $profile->userName : " N/A " ;   ?></p>
						</div>
					</div>
					<div class="form-group">
						<label class="col-xs-6 col-sm-2" for="Gender">Gender</label>
						<div class="col-xs-6 col-sm-10">
							<p class="form-control-static"><?php echo (isset($profile->userGender))? $profile->userGender : " N/A " ;   ?></p>
						</div>
					</div>
					<div class="form-group">
						<label class="col-xs-6 col-sm-2" for="Date of Birth">Date of Birth</label>
						<div class="col-xs-6 col-sm-10">
							<p class="form-control-static"><?php echo $profile->dob;?></p>
						</div>
					</div>
					<div class="form-group">
						<label class="col-xs-6 col-sm-2" for="Bio">Bio</label>
						<div class="col-xs-6 col-sm-10">
							<p class="form-control-static"><?php echo (isset($profile->userBio))? $profile->userBio : " N/A " ;   ?></p>
						</div>
					</div>
					<div class="form-group">
						<label class="col-xs-6 col-sm-2" for="Mobile Number">Phone Number</label>
						<div class="col-xs-6 col-sm-10">
							<p class="form-control-static"><?php echo (isset($profile->phoneNumber))? $profile->phoneNumber : " N/A " ;   ?></p>
						</div>
					</div>
					<div class="form-group">
						<label class="col-xs-6 col-sm-2" for="Location">Location</label>
						<div class="col-xs-6 col-sm-10">
							<p class="form-control-static"><?php echo (isset($profile->userLocation))? $profile->userLocation : " N/A " ;   ?></p>
						</div>
					</div>
					<div class="form-group">
						<label class="col-xs-6 col-sm-2" for="Location">Email Id</label>
						<div class="col-xs-6 col-sm-10">
							<p class="form-control-static"><?php echo (isset($profile->email))? $profile->email : " N/A " ;   ?></p>
						</div>
					</div>
				</form>
			</div>
		</div>
		
		<p></p>
		
		<!---My Address Data--------------------->
		<div class="col-sm-offset-2 col-sm-10">
			<a href="<?php echo base_url('account/my-address/edit'); ?>"><button type="submit" class="button-edit pull-right">Edit Address</button></a>
		</div>
		
		<h4 class="text-color">My Billing Address</h4>
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="form-group">
					<label class="col-xs-6 col-sm-2" for="Username">Address</label>
					<div class="col-xs-6 col-sm-10">
						<p class="form-control-static"><?php echo (isset($myAddress['address']))? $myAddress['address'] : " N/A " ;   ?></p>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-xs-6 col-sm-2" for="Username">City</label>
					<div class="col-xs-6 col-sm-10">
						<p class="form-control-static"><?php echo (isset($myAddress['City']))? $myAddress['City'] : " N/A " ;   ?></p>
					</div>
				</div>	
				
				<div class="form-group">
					<label class="col-xs-6 col-sm-2" for="Username">State</label>
					<div class="col-xs-6 col-sm-10">
						<p class="form-control-static"><?php echo (isset($myAddress['State']))? $myAddress['State'] : " N/A " ;   ?></p>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-xs-6 col-sm-2" for="Username">Country</label>
					<div class="col-xs-6 col-sm-10">
						<p class="form-control-static"><?php echo (isset($myAddress['Country']))? $myAddress['Country'] : " N/A " ;   ?></p>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-xs-6 col-sm-2" for="Username">Zip</label>
					<div class="col-xs-6 col-sm-10">
						<p class="form-control-static"><?php echo (isset($myAddress['Zip']))? $myAddress['Zip'] : " N/A " ;   ?></p>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-xs-6 col-sm-2" for="Username">PhoneNumber</label>
					<div class="col-xs-6 col-sm-10">
						<p class="form-control-static"><?php echo (isset($myAddress['PhoneNumber']))? $myAddress['PhoneNumber'] : " N/A " ;   ?></p>
					</div>
				</div>
				
				
			</div>
		</div>
	</div>
	<!-----Container---->
</section>	
<!----pro-section-end-section---->		