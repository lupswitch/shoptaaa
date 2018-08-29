<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
		<h1>  <i class="fa fa-<?php echo $font_icon; ?>"></i>
			<?php echo $pagetitle; ?>
			
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="<?php echo base_url(); ?>admin/revslider">Revslider</a></li>
			<li class="active"> Update Slide</li>
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
						<h3 class="box-title">Slide Entry Fields</h3>
					</div>
					<!-- /.box-header -->
					
					
					<!---- Alert Message---->
					<div class="col-md-12"><?php echo $this->session->flashdata('verify_msg'); ?></div> 
					<!---- Alert Message---->
					
					<!-- form start -->
					<?php $attributes = array('id' => 'updateslide' ,'class'=>'');
					echo form_open_multipart('admin/update-slide/'.$slidedata[0]->rid, $attributes);?>
					
					<input type="hidden" class="form-control" id="rid" name="rid"  value="<?php echo $slidedata[0]->rid ;?>">	
					<div class="box-body">
						<br/>
						<div class="col-md-6">
							<h4>Slide Title*</h4>
							<div class="form-group">
								
								<input type="text" class="form-control" id="slideTitle" name="slideTitle" placeholder="Enter Slide Title"   Value="<?php echo $slidedata[0]->slideTitle; ?>" />
								<span class="text-danger"><?php echo form_error('slideTitle'); ?></span>
							</div>
						</div>
						
						<div class="col-md-6">	
							<h4>Slide Status*</h4>
							<div class="form-group">
								
								<select class="form-control" id="slide_isActive" name="slide_isActive" >
									<option value="1" selected=""> Active </option>
									<option value="0"> De-active </option>
								</select>
								<span class="text-danger"><?php echo form_error('slide_isActive'); ?></span>
							</div>
						</div>
						<br/>
						
						<div class="col-md-6">
							<h4>Button Text*</h4>
							<div class="form-group">
								<input type="text" class="form-control" id="buttonText" name="buttonText" placeholder="Enter Button Text"   Value="<?php echo $slidedata[0]->buttonText; ?>" />
								<span class="text-danger"><?php echo form_error('buttonText'); ?></span>
							</div>
						</div>
						<br/>
						
						<div class="col-md-6">
							<h4>Button Url*</h4>
							<div class="form-group">
								<input type="text" class="form-control" id="buttonUrl" name="buttonUrl" placeholder="Enter Button Url"   Value="<?php echo $slidedata[0]->buttonUrl; ?>" />
								<span class="text-danger"><?php echo form_error('buttonUrl'); ?></span>
							</div>
						</div>
						<br/>
						
						<div class="col-md-6">	
							<h4>Slide Description*</h4>
							<div class="form-group">
								<div class="box-body pad">
									<textarea id="slideDescription" name="slideDescription" rows="8" cols="70" placeholder="Add Slide Description Here.."   ><?php echo $slidedata[0]->slideDescription; ?></textarea>
									<span class="text-danger"><?php echo form_error('slideDescription'); ?></span>
								</div>
							</div>
						</div>
						<br/>
						
						
						
						<div class="col-md-6">
							<h4>Edit slide Image</h4>
							<label><i>Image Should  Be ( 1360 x 570 ) For Better Display.</i></label>
							<div class="form-group">
							
								<img src="<?php echo base_url();?>/assets/revslideimage/<?php echo $slidedata[0]->image; ?> " alt="Image" class="media-object img-rounded thumb48"  width="500" height="200">
								
								<br/>
								<div id="dynamic-image"></div>
								<!--<input type="file" name="images" id="image">-->
									<input type="hidden" name="old-img" value="<?php echo $slidedata[0]->image; ?>">
										<div class="input_fields_wrap">
										<button data-filepath="<?php echo $slidedata[0]->image; ?>" type="button" class="image" id="filetype" >Edit Image</button>
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
			jQuery("#dynamic-image").append('<input type="file" name="images" id="image">');
		});		
	
</script>