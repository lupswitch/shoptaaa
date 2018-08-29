<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
		<h1>  <i class="fa fa-<?php echo $font_icon; ?>"></i>
			<?php echo $pagetitle; ?>
			<small>Create New </small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="<?php echo base_url(); ?>admin/revslider">Revslider</a></li>
			<li class="active"> Create New Slide</li>
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
					<?php $attributes = array('id' => 'CreateNewslide' ,'class'=>'');
					echo form_open_multipart('admin/create-revslide', $attributes);?>
					
					<div class="box-body">
						<br/>
						<div class="col-md-6">
							<h4>Slide Title*</h4>
							<div class="form-group">
								<!--label for="exampleInputEmail1">Product Name*</label-->
								<input type="text" class="form-control" id="slideTitle" name="slideTitle" placeholder="Enter Slide Title"   Value="<?php echo set_value('slideTitle'); ?>" />
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
								<input type="text" class="form-control" id="buttonText" name="buttonText" placeholder="Enter Button Text"   Value="<?php echo set_value('buttonText'); ?>" />
								<span class="text-danger"><?php echo form_error('buttonText'); ?></span>
							</div>
						</div>
						<br/>
						
						<div class="col-md-6">
							<h4>Button Url*</h4>
							<div class="form-group">
								<!--label for="exampleInputEmail1">Product Name*</label-->
								<input type="text" class="form-control" id="buttonUrl" name="buttonUrl" placeholder="Enter Button Url"   Value="<?php echo set_value('buttonUrl'); ?>" />
								<span class="text-danger"><?php echo form_error('buttonUrl'); ?></span>
							</div>
						</div>
						<br/>
						
						<div class="col-md-6">	
							<h4>Slide Description*</h4>
							<div class="form-group">
								<div class="box-body pad">
									<textarea id="slideDescription" name="slideDescription" rows="8" cols="70" placeholder="Add Slide Description Here.."   ><?php echo set_value('revDescription'); ?></textarea>
									<span class="text-danger"><?php echo form_error('slideDescription'); ?></span>
								</div>
							</div>
						</div>
						<br/>
						
						
						<div class="col-md-6">
							<h4>Add slide Image</h4>
							<label><i>Image Should  Be ( 1360 x 570 ) For Better Display.</i></label>
							<div class="form-group">
								<input type="file" id="images" name="images" />
								<span class="text-danger"><?php echo form_error('images'); ?></span>
							</div>
						</div>
						<br/>
						
					</div>
					<!-- /.box-body -->
					
					<div class="box-footer">
						<button type="submit" name="addNewSlide" class="btn btn-success">Create Now</button>
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