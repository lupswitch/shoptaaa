  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
		<h1>  <i class="fa fa-<?php echo $font_icon; ?>"></i>
			<?php echo $pagetitle; ?>
			<small>Create </small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="<?php echo base_url(); ?>admin/user-listing">Users Listing</a></li>
			<li class="active">Create New User</li>
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
              <h3 class="box-title">Users Entry Fields</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
			<div class="col-md-12"><?php echo $this->session->flashdata('verify_msg'); ?></div> 
			
			<?php $attributes = array('id' => 'createCategory' ,'class'=>'createCat_form');
					echo form_open_multipart('admin/create-user/', $attributes);?>
				<div class="box-body">
				
				<div class="col-md-12">
					<h4>User Profile Image</h4>
					<div class="form-group">
						<input type="file"  onchange="readURL(this);" style="display:none;" name="user_profileImage" id="uploadFile" />
						
						<a href="javascript:void(0);" id="uploadTrigger" name="upload_file_name">
							<img class="img-circle  previewimg" height="130px" width="130px"  src="<?php echo base_url("assets/images/user-1.png"); ?>" alt="profile_image" id="upload_post_image"  >
						</a>		
						<p> <b>Click on image to upload Profile image</b> </p>
					</div>
				</div>
				
				<div class="col-md-6">
				
					<h4>User First Name<span>*</span></h4>
					<div class="form-group">
					  <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Enter First Name" Value="<?php echo set_value('firstName'); ?>" />
					  <span class="text-danger"><?php echo form_error('firstName'); ?></span>
					</div>
				
				
					<h4>User Name<span>*</span></h4>
					<div class="form-group">
					  <input type="text" class="form-control" id="userName" name="userName" placeholder="Enter userName" Value="<?php echo set_value('userName'); ?>" />
					  <span class="text-danger"><?php echo form_error('userName'); ?></span>
					</div>
				
				
					<h4>User Email<span>*</span></h4>
					<div class="form-group">
					  <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" Value="<?php echo set_value('email'); ?>" />
					  <span class="text-danger"><?php echo form_error('email'); ?></span>
					</div>
				
					
					<h4>User Type<span>*</span></h4>
					<div class="form-group">
				
							<select class="form-control" id="userType" name="userType" required >
								<option value="">-- Select Status --</option>
								<option value="admin" > Admin </option>
								<option value="staff" > Staff </option>
								<option value="user"  > Customer </option>
								<option value="deliveryboy"  > Delivery Boy </option>
							</select>
							<span class="text-danger"><?php echo form_error('userType'); ?></span>
					</div>
				
				</div>
				
				
				<div class="col-md-6">
				
					<h4>User Phone Number <span>*</span></h4>
					<div class="form-group">
					  <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" placeholder="Enter Phone Number" Value="<?php echo set_value('phoneNumber'); ?>" />
					  <span class="text-danger"><?php echo form_error('phoneNumber'); ?></span>
					</div>
			
				
				
					<h4>User Status</h4>
					<div class="form-group">
				
							<select class="form-control" id="is_active" name="is_active" required >
								<option value="0">-- Select Status --</option>
								<option value="1" > Active </option>
								<option value="0" > De-active </option>
							</select>
							<span class="text-danger"><?php echo form_error('is_active'); ?></span>
					</div>
				
				
				
					<h4>User Password<span>*</span></h4>
					<div class="form-group">
					  <input type="password" class="form-control" id="password" name="password" placeholder="Enter user password " Value="" />
					  <span class="text-danger"><?php echo form_error('password'); ?></span>
					</div>
				
				
				</div>
				</div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" name="create_user" class="btn btn-success">Create Now</button>
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
  
  #createCategory span {
  color: red;
}
  </style>