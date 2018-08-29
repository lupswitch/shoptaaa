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
			<li><a href="<?php echo base_url(); ?>admin/brand-listing">Brand Listing</a></li>
			<li class="active">Create New Brand</li>
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
              <h3 class="box-title">Brand Entry Fields</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
			<div class="col-md-12"><?php echo $this->session->flashdata('verify_msg'); ?></div> 
			
			<?php $attributes = array('id' => 'CreateNewBrand' ,'class'=>'createNewBrand_form');
					echo form_open_multipart('admin/create-brand', $attributes);?>
				<div class="box-body">
				
				<div class="col-md-6">
					<h4>Brand Name<span class="required">*</span></h4>
					<div class="form-group">
					  <input type="text" class="form-control" id="BrandName" name="BrandName" placeholder="Enter Brand Name"   Value="<?php echo set_value('BrandName'); ?>" />
					  <span class="text-danger"><?php echo form_error('BrandName'); ?></span>
					</div>
				</div>
	<!-- Add Sub category--->			
		
      <div class="col-md-6">
					<h4>Assign Parent Brand Name<span class="required">*</span></h4>
					<div class="form-group">
						<select class="form-control" id="parentBrand" name="parentBrand" >
							<option value="">-- Select Parent Category --</option>
							<?php if(!empty($all_ParentBrand) ){ ?>
							<?php foreach($all_ParentBrand as $BrandVal ){ ?>
								<option value="<?php echo $BrandVal->BrandId; ?>"><?php echo $BrandVal->BrandName; ?></option>
							<?php } } ?>
						</select>
							<span class="text-danger"><?php echo form_error('parentBrand'); ?></span>
					</div>
				</div>
	<!-- End  of Sub category --->					
				<div class="col-md-6">	
					<h4>Brand Status<span class="required">*</span></h4>
					<div class="form-group">
				
							<select class="form-control" id="is_brand_active" name="is_brand_active" required >
								<option value="0">-- Select Status --</option>
								<option value="1" selected > Active </option>
								<option value="0"> De-active </option>
							</select>
							<span class="text-danger"><?php echo form_error('is_brand_active'); ?></span>
					</div>
				</div>
				<br/>
				<hr/>
				<div class="col-md-12">	
					<h4>Category Description<span class="required">*</span></h4>
					<div class="form-group">
						<div class="box-body pad">
						  <textarea id="productDescriptionCKEditor" name="BrandDescription" rows="10" cols="80" placeholder="Add Category Description Here.."  Required ><?php echo set_value('BrandDescription'); ?></textarea>
						  <span class="text-danger"><?php echo form_error('BrandDescription'); ?></span>
						</div>
					</div>
				</div>
				
				
				<div class="col-md-12">
					<h4>Category Main Image</h4>
					<div class="form-group">
						<input type="file"  onchange="readURL(this);" style="display:none;" name="BrandMainImage" id="uploadFile" />
						
						<a href="javascript:void(0);" id="uploadTrigger" name="upload_file_name">
							<img class=" previewimg" height="130px" width="130px"  src="<?php echo base_url("assets/images/add-image.jpg"); ?>" alt="Brand_image" id="upload_post_image"  >
						</a>		
						<p>Click on image to update New Brand Image.</p>
					</div>
				</div>
				
				
              
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" name="addNew_brand" class="btn btn-success">Create Now</button>
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
  #CreateNewBrand .required
  {
   color:red;  
  }
  </style>