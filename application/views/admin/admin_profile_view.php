<!-- Content Wrapper. Contains page content -->
<?php  $Aid = $this->session->userdata['is_admin']['user_id'] ; ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
		<h1>  <i class="fa fa-<?php echo $font_icon; ?>"></i>&nbsp;&nbsp;
			<?php echo $pagetitle; ?>
			<small>Admin Profile</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="<?php echo base_url(); ?>admin/profile/<?php echo $Aid ;?>">Profile</a></li>
			<li class="active">Manage Profile</li>
		</ol>
	</section>
	
    <!-- Main content -->
    <section class="content">
		<div class="row">
			<!-- left column -->
			<div class="col-md-12">
				<!-- general form elements -->
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title"></h3>
					</div>
					<!-- /.box-header -->
					<!-- form start -->
					<div class="col-md-12"><?php echo $this->session->flashdata('verify_msg'); ?></div> 
					<?php $attributes = array('id' => 'updateCategory' ,'class'=>'updateCat_form');
					echo form_open_multipart('admin/profile/'. $Aid.'', $attributes);?>
					<div class="box-body">
						
						<div class="col-md-12">
							<h4>Profile Image</h4>
							<label><i>Image Should Be ( 160 x 160 ) For Better Display.</i></label>
							<div class="form-group">
								<input type="file"  onchange="readURL(this);" style="display:none;" name="user_profileImage" id="uploadFile" />
								
								<?php (!empty($profile->profileImage)) ? $imgPath = $profile->profileImage  : $imgPath = base_url("assets/images/user-1.png");    ?>
								
								<a href="javascript:void(0);" id="uploadTrigger" name="upload_file_name">
									<img class="img-circle  previewimg" height="130px" width="130px"  src="<?php echo $imgPath ?>" alt="profile_image" id="upload_post_image">
								</a>		
								<p> <b>Click on image to change profile image </b></p>
							</div>
						</div>
						
						
						
						
						<div class="col-md-6">
							
							<h4>First Name*</h4>
							<div class="form-group">
								<input type="text" class="form-control" id="firstName" name="firstName" placeholder="Enter First Name" Value="<?php echo $profile->firstName ;?>" />
								<span class="text-danger"><?php echo form_error('firstName'); ?></span>
							</div>
							
							
							<h4>User Name*</h4>
							<div class="form-group">
								<input type="text" class="form-control" id="userName" name="userName" placeholder="Enter userName" Value="<?php echo $profile->userName ;?>" />
								<span class="text-danger"><?php echo form_error('userName'); ?></span>
							</div>
							
							
							<h4>Email*</h4>
							<div class="form-group">
								<input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" Value="<?php echo $profile->email ;?>" />
								<span class="text-danger"><?php echo form_error('email'); ?></span>
							</div>
							
							
							<h4>Phone Number</h4>
							<div class="form-group">
								<input type="text" class="form-control" id="phoneNumber" name="phoneNumber" placeholder="Enter Phone Number" Value="<?php echo $profile->phoneNumber ;?>" />
							</div>
							
							
							<h4>Password</h4>
							<div class="form-group">
								<input type="password" class="form-control" id="password" name="password" placeholder="Enter Password here " Value="" />
							</div>
							
							
						</div>
						
						
						<div class="col-md-6">
							
							<h4>Last Name*</h4>
							<div class="form-group">
								<input type="text" class="form-control" id="lastName" name="lastName" placeholder="Enter Last Name" Value="<?php echo $profile->lastName ;?>" />
								<span class="text-danger"><?php echo form_error('lastName'); ?></span>
							</div>
							
							
							<h4>Date of Birth</h4>
							<div class="form-group">
							
								<div class="input-group date">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input class="form-control pull-right" id="datepicker" name="dob" type="text" Value="<?php echo $profile->dob; ?>" />
								</div>
								
							</div>
							
							
							<h4>Gender</h4>
							<div class="form-group">
								<select class="form-control" id="userGender" name="userGender">
									<option value="male" <?php echo ($profile->userGender == 'male')? 'selected' : ""; ?>> Male </option>
									<option value="female" <?php echo ($profile->userGender == 'female')? 'selected' : ""; ?>> Female </option>
									<option value="others" <?php echo ($profile->userGender == 'others')? 'selected' : ""; ?>> Others </option>
								</select>
							</div>
							
							<h4>Bio</h4>
							<div class="form-group">
								<textarea id="userBio" name="userBio" placeholder="Enter Bio" rows="2" cols="60" ><?php echo $profile->userBio ;?></textarea>
							</div>
							
							<h4>Address</h4>
							<div class="form-group">
								<input type="text" class="form-control" id="userLocation" name="userLocation" placeholder="Enter Address" Value="<?php echo $profile->userLocation ;?>" />
							</div>
							
						</div>
						
						
					</div>
					<!-- /.box-body -->
					
					<div class="box-footer">
						<button type="submit" name="updateadmin" class="btn btn-success">Update Now</button>
					</div>
				</form>
			</div>
			<!-- /.box -->
			
		</div>
		<!--/.col (left) -->
		<!-- right column -->
		
	
	</div>
	<!-- /.row -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

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
