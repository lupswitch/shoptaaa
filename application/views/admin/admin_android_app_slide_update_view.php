<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
		<h1>  <i class="fa fa-<?php echo $font_icon; ?>"></i>
			<?php echo $pagetitle; ?>
			
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="<?php echo base_url(); ?>/app-slider">App Slide</a></li>
			<li class="active"> Update App Slide</li>
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
						<h3 class="box-title">Update App Slide for Android and iOS</h3>
					</div>
					<!-- /.box-header -->
					
					
					<!---- Alert Message---->
					<div class="col-md-12"><?php echo $this->session->flashdata('verify_msg'); ?></div> 
					<!---- Alert Message---->
					
					<!-- form start -->
					<?php $attributes = array('id' => 'updateslide' ,'class'=>'');
					echo form_open_multipart('admin/update-app-slide/'.$slidedata[0]->id, $attributes);?>
					
					<input type="hidden" class="form-control" id="id" name="id"  value="<?php echo $slidedata[0]->id ;?>">	
					<div class="box-body">

						<div class="col-md-6">
							<h4>Edit slide Image</h4>
							<div class="form-group">
								<?php

   
								//$image = explode("/", $slidedata[0]->welcomeImage);
								?>
								<img src="<?php echo base_url('uploads/App-thumb-images/');?><?php echo $slidedata[0]->welcomeImage ?> " alt="Image" class="media-object img-rounded thumb48"  width="auto" height="auto">
								
								<br/>
								<div id="dynamic-image"></div>
								<!--<input type="file" name="images" id="image">-->
									<input type="hidden" name="old-img" value="<?php echo $slidedata[0]->welcomeImage; ?>">
										<div class="input_fields_wrap">
										<button data-filepath="<?php echo $slidedata[0]->welcomeImage; ?>" type="button" class="image" id="filetype" >Edit Image</button>
								</div>
							</div>
						</div>
						
					</div>
					<!-- /.box-body -->
					
					<div class="box-footer">
						<button type="submit" name="updateSlide" class="btn btn-success">Update Slide</button>
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
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>
	
		jQuery(document).one('click','#filetype',function(){
			jQuery("#dynamic-image").append('<input type="file" name="welcomeImage" id="image">');
		});		
	
</script>
