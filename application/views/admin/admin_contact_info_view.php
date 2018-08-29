<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
		<h1>  <i class="fa fa-<?php echo $font_icon; ?>"></i>
			<?php echo $pagetitle; ?>
			<small>Manage Contact info </small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="<?php echo base_url(); ?>admin/contact-info">Contact Info</a></li>
			<li class="active">Manage info</li>
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
						<h3 class="box-title">Manage Contact info</h3>
					</div>
					<!-- /.box-header -->
					
					
					<!---- Alert Message---->
					<div class="col-md-12"><?php echo $this->session->flashdata('verify_msg'); ?></div> 
					<!---- Alert Message---->
					
					<!-- form start -->
					<?php $attributes = array('id' => 'CreateNewslide' ,'class'=>'');
					echo form_open_multipart('admin/contact-info', $attributes);?>
					
					<div class="box-body"> 
						
						
						<div class="col-md-6">
							
							<h4>Contact Heading</h4>
							<div class="form-group">
								<input class="form-control" id="siteContactHeadingKey" name="siteContactHeadingKey" placeholder="Contact Info" aria-describedby="sizing-addon1" value="<?php echo $contactusinfo['siteContactHeadingKey']['optionValue']; ?>" type="text">	
							</div>
							
							<h4>Phone</h4>	
							<div class="form-group">
								<input class="form-control" id="siteContactPhoneKey" name="siteContactPhoneKey" aria-describedby="sizing-addon1" value="<?php echo $contactusinfo['siteContactPhoneKey']['optionValue']; ?>" type="text">
							</div>
							
							
							<h4>Email</h4>	
							<div class="form-group">
								<input class="form-control" id="siteContactEmailKey" name="siteContactEmailKey" aria-describedby="sizing-addon1" value="<?php echo $contactusinfo['siteContactEmailKey']['optionValue']; ?>" type="text">
							</div>
						</div>
						
						
						<div class="col-md-6">
						
							<h4>Address</h4>	
							<div class="form-group">
								<textarea id="siteContactAddressKey" name="siteContactAddressKey" rows="2" cols="70" ><?php echo $contactusinfo['siteContactAddressKey']['optionValue']; ?></textarea>	
							</div>
							
							<div class="form-group has-feedback">
								<?php 
									$iframe = $contactusinfo['siteContactAddressKey']['optionValue'];
									$getiframe = str_replace(" ","+",$iframe); 
								?>
								<iframe width="100%" height="250" frameborder="0" scrolling="no" marginheigh
								t="0" marginwidth="0" src="https://www.google.com/maps/embed/v1/place?q=<?php echo $getiframe;?>&key=AIzaSyB3MCVSyQHwa_jPHh6xWLWR20zUlkquKxw&zoom=12"allowfullscreen>
								</iframe>			
							</div>
						</div>
						
						
						<div class="col-md-12">	
							<h4>Contact Us <i>Description*</i></h4>
							<div class="form-group">
								<div class="box-body pad">
									<textarea id="productDescriptionCKEditor" name="siteContactDescriptionKey" rows="10" cols="80" ><?php echo $contactusinfo['siteContactDescriptionKey']['optionValue']; ?></textarea>
								</div>
							</div>
						</div>
					</div>  
					
				</div>
				<!-- /.box-body -->
				
				<div class="box-footer">
					<button type="submit" name="UpdateContactInfo" class="btn btn-success">Save Now</button>
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