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
			<li><a href="<?php echo base_url(); ?>admin/category-listing">Category Listing</a></li>
			<li class="active">Create New Category</li>
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
              <h3 class="box-title">Category Entry Fields</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
			<div class="col-md-12"><?php echo $this->session->flashdata('verify_msg'); ?></div> 
			
			<?php $attributes = array('id' => 'CreateNewCategory' ,'class'=>'createNewCat_form');
					echo form_open_multipart('admin/create-category', $attributes);?>
				<div class="box-body">
				
				<div class="col-md-6">
					<h4>Category Name*</h4>
					<div class="form-group">
					  <!--label for="exampleInputEmail1">Product Name*</label-->
					  <input type="text" class="form-control" id="categaryName" name="categaryName" placeholder="Enter category Name"   Value="<?php echo set_value('categaryName'); ?>" />
					  <span class="text-danger"><?php echo form_error('categaryName'); ?></span>
					</div>
				</div>
	<!-- Add Sub category --->			
		
				<div class="col-md-6">
					<h4>Assign Parent Category Name*</h4>
					<div class="form-group">
					  <select class="form-control" id="parent_cat" name="parent_cat"  >
								<option value="0">-- Select Parent Category --</option>
								<?php foreach($all_ParentCategories as $CatVal ){ ?>
									<option value="<?php echo $CatVal->c_id; ?>"><?php echo $CatVal->categaryName; ?></option>
								<?php } ?>
							</select>
							<span class="text-danger"><?php echo form_error('parent_cat'); ?></span>
					</div>
				</div>
	<!-- End  of Sub category --->					
				<div class="col-md-6">	
					<h4>Category Status*</h4>
					<div class="form-group">
				
							<select class="form-control" id="is_cat_active" name="is_cat_active" required >
								<option value="">-- Select Status --</option>
								<option value="1" selected > Active </option>
								<option value="0"> De-active </option>
							</select>
							<span class="text-danger"><?php echo form_error('is_cat_active'); ?></span>
					</div>
				</div>
				<br/>
				<hr/>
				<div class="col-md-12">	
					<h4>Category Description*</h4>
					<div class="form-group">
						<div class="box-body pad">
						  <textarea id="productDescriptionCKEditor" name="catDescription" rows="10" cols="80" placeholder="Add Category Description Here.."  Required ><?php echo set_value('catDescription'); ?></textarea>
						  <span class="text-danger"><?php echo form_error('catDescription'); ?></span>
						</div>
					</div>
				</div>
				
				
				<div class="col-md-12">
					<h4>Category Main Image</h4>
					<div class="form-group">
						<input type="file"  onchange="readURL(this);" style="display:none;" name="CategoryMainImage" id="uploadFile" />
						
						<a href="javascript:void(0);" id="uploadTrigger" name="upload_file_name">
							<img class=" previewimg" height="130px" width="130px"  src="<?php echo base_url("assets/images/user-1.png"); ?>" alt="Cateory_image" id="upload_post_image"  >
						</a>		
						<p> Click on image to update New Category image </p>
					</div>
				</div>
				
				
              
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" name="addNew_category" class="btn btn-success">Create Now</button>
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