  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
		<h1>  <i class="fa fa-<?php echo $font_icon; ?>"></i>
			<?php echo $pagetitle; ?>
			<small>Update </small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="<?php echo base_url(); ?>admin/user-listing">Users Listing</a></li>
			<li class="active">Update User</li>
		</ol>
    </section>

	<?php /* pr($singleUser); */ ?>
    <!-- Main content -->
    <section class="content">
		<div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Users Entry Fields</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
			<div class="col-md-12"><?php echo $this->session->flashdata('verify_msg'); ?></div> 
			
			<?php $attributes = array('id' => 'updateCategory' ,'class'=>'updateCat_form');
					echo form_open_multipart('admin/update-user/'.$currentUid, $attributes);?>
				<div class="box-body">
				
				<div class="col-md-12">
					<h4>User Profile Image</h4>
					<div class="form-group">
						<input type="file"  onchange="readURL(this);" style="display:none;" name="user_profileImage" id="uploadFile" />
							 
						<?php (!empty($singleUser->profileImage)) ? $imgPath = $singleUser->profileImage  : $imgPath = base_url("assets/images/user-1.png");    ?>
						
						<a href="javascript:void(0);" id="uploadTrigger" name="upload_file_name">
							<img class="img-circle  previewimg" height="130px" width="130px"  src="<?php echo $imgPath; ?>" alt="profile_image" id="upload_post_image"  >
						</a>		
						<p> <b>Click on image to change profile image </b></p>
					</div>
				</div>
			
				
				
				
				<div class="col-md-6">
					<h4>User First Name <span>*</span></h4>
					<div class="form-group">
					  <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Enter First Name" Value="<?php echo (isset($singleUser->firstName))? $singleUser->firstName : "" ;   ?>" />
					  <span class="text-danger"><?php echo form_error('firstName'); ?></span>
					</div>
				</div>
				
				<div class="col-md-6">
					<h4>User Name <span>*</span></h4>
					<div class="form-group">
					  <input type="text" class="form-control" id="userName" name="userName" placeholder="Enter userName" Value="<?php echo (isset($singleUser->userName))? $singleUser->userName : "" ;   ?>" />
					  <span class="text-danger"><?php echo form_error('userName'); ?></span>
					</div>
				</div>
				<br/>
				<div class="col-md-6">
					<h4>User Email <span>*</span></h4>
					<div class="form-group">
					  <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" Value="<?php echo (isset($singleUser->email))? $singleUser->email : "" ;   ?>" />
					  <span class="text-danger"><?php echo form_error('email'); ?></span>
					</div>
				</div>
				<br/>
				<div class="col-md-6">	
					<h4>User Type <span>*</span></h4>
					<div class="form-group">
				
							<select class="form-control" id="userType" name="userType" required >
								<option value="">-- Select Status --</option>
								<option value="admin" <?php echo (isset($singleUser->userType) && $singleUser->userType=='admin')? "selected":""; ?>> Admin </option>
								<option value="staff" <?php echo (isset($singleUser->userType) && $singleUser->userType=='staff')? "selected":""; ?> > Staff </option>
								<option value="user" <?php echo (isset($singleUser->userType) && $singleUser->userType=='user')? "selected":""; ?> > Customer </option>
								<option value="deliveryboy" <?php echo (isset($singleUser->userType) && $singleUser->userType=='deliveryboy')? "selected":""; ?> > Delivery Boy </option>
							</select>
							<span class="text-danger"><?php echo form_error('userType'); ?></span>
					</div>
				</div>
				<br/>
				
				<div class="col-md-6">
					<h4>User Phone Number</h4>
					<div class="form-group">
					  <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" placeholder="Enter Phone Number" Value="<?php echo (isset($singleUser->phoneNumber))? $singleUser->phoneNumber : "" ;   ?>" />
					  <span class="text-danger"><?php echo form_error('phoneNumber'); ?></span>
					</div>
				</div>
				<br/>
				
				<div class="col-md-6">	
					<h4>User Status <span>*</span></h4>
					<div class="form-group">
				
							<select class="form-control" id="is_active" name="is_active" required >
								<option value="0">-- Select Status --</option>
								<option value="1" <?php echo (isset($singleUser->is_active) && $singleUser->is_active=='1')? "selected":""; ?>> Active </option>
								<option value="0" <?php echo (isset($singleUser->is_active) && $singleUser->is_active=='0')? "selected":""; ?> > De-active </option>
							</select>
							<span class="text-danger"><?php echo form_error('is_active'); ?></span>
					</div>
				</div>
				<br/>
				
				<div class="col-md-6">
					<h4>User Password</h4>
					<div class="form-group">
					  <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password here if you want to change it" Value="" />
					  <span class="text-danger"><?php echo form_error('password'); ?></span>
					</div>
				</div>
				<br/>
				
				<hr/>
				
				
				
				
				
				
				</div>
				</div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" name="update_user" class="btn btn-success">Update Now</button>
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
<style type="text/css">
#updateCategory span {
  color: red;
}
</style>  
  