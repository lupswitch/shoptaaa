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
			<li><a href="<?php echo base_url(); ?>admin/user-listing">Product Listing</a></li>
			<li class="active">Create New Product</li>
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
						<h3 class="box-title">Product Entry Fields</h3>
					</div>
					<!-- /.box-header -->
					<!-- form start -->
					<div class="col-md-12"><?php echo $this->session->flashdata('verify_msg'); ?></div> 
					<?php $attributes = array('id' => 'updateProduct' ,'class'=>'');
					echo form_open_multipart('admin/create-product', $attributes);?>
					<div class="box-body">
						<br/>
						
						
						<div class="col-md-6">
							<h4>Product Name <span class="required">*</span></h4>
							<div class="form-group">
								<!--label for="exampleInputEmail1">Product Name*</label-->
								<input type="text" class="form-control" id="pageTitle" name="productName" placeholder="Enter Product Name"   Value="<?php echo set_value('productName'); ?>" />
								<span class="text-danger"><?php echo form_error('productName'); ?></span>
							</div>
						
						
							<h4>Product Slug</h4>
							<div class="form-group">
								<div class="input-group">
									<span class="input-group-addon"><?php echo base_url();?>product</span>
									<input class="form-control" id="pageSlug" name="pro_slug" type="text" value="<?php echo set_value('pro_slug'); ?>">
								</div>
								<span class="text-danger"><?php echo form_error('pro_slug'); ?></span>
							</div>
						
						
						
							<h4>Product SKU <span class="required">*</span></h4>
							<div class="form-group">
								<!--label for="exampleInputEmail1">Product Name*</label-->
								<input type="text" class="form-control" id="pro_SUK" name="pro_SUK" placeholder="Enter Product Name"   Value="<?php echo set_value('pro_SUK'); ?>"  />
								<span class="text-danger"><?php echo form_error('pro_SUK'); ?></span>
							</div>
						
						
						
							<h4>Product Category <span class="required">*</span></h4>
							<div class="form-group">
								
								<select class="form-control" id="cId" name="cId"  >
									<option value="">-- Assign Category --</option>
									<?php foreach($all_categories as $CatVal ){ ?>
										<option value="<?php echo $CatVal->c_id; ?>"><?php echo $CatVal->categaryName; ?></option>
										<?php if($CatVal->count_subCat > 0 ): ?>
										<?php foreach($CatVal->subCat_list as $subCatVal): ?>
										<option value="<?php echo $subCatVal->c_id; ?>">---<?php echo $subCatVal->categaryName; ?></option>
										<?php endforeach; ?>
										<?php  endif; ?>
										
									<?php } ?>
								</select>
								<span class="text-danger"><?php echo form_error('cId'); ?></span>
							</div>
						
						
						
							<h4>Product Quantity <span class="required">*</span></h4>
							<div class="form-group">
								<input class="form-control"  type="number" id="proQuantity" name="proQuantity" placeholder="Enter Product Quantity"  value="<?php echo set_value('proQuantity'); ?>"  />
								<span class="text-danger"><?php echo form_error('proQuantity'); ?></span>
							</div>
							
							<h4>Is Featured</h4>
							<div class="form-group">
								<!--label for="exampleInputPassword1">use Care*</label-->
								<input type="checkbox"  id="pro_isFeature" name="pro_isFeature" value="1"   />  &nbsp;   <label> Check to make feature product </label>
								<span class="text-danger"><?php echo form_error('pro_isFeature'); ?></span>
							</div> 
							
						</div>
						
						
						<div class="col-md-6">
							<h4>Product Price <span class="required">*</span></h4>
							<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon">$</span>
								<input class="form-control"  type="text" id="productPrice" name="productPrice" placeholder="Enter Product Price"  value="<?php echo set_value('productPrice'); ?>"  />
								<span class="input-group-addon">.00</span>
							</div>	
							
							<span class="text-danger"><?php echo form_error('productPrice'); ?></span>
							
						</div>
						
							
							<h4>Product Brand</h4>
							<div class="form-group">
								
								<select class="form-control" id="bId" name="bId" >
									<option value="">-- Assign Brand --</option>
									<?php foreach($all_Brands as $BrandVal ){ ?>
										<option value="<?php echo $BrandVal->BrandId; ?>" ><?php echo $BrandVal->BrandName; ?></option>
										
										<?php if($BrandVal->count_subCat > 0 ): ?>
										<?php foreach($BrandVal->subCat_list as $subBrandVal): ?>
										<option value="<?php echo $subBrandVal->BrandId; ?>" >---<?php echo $subBrandVal->BrandName; ?></option>
										<?php endforeach; ?>
										<?php  endif; ?>
										
									<?php } ?>
								</select>
								<span class="text-danger"><?php echo form_error('bId'); ?></span>
							</div>
						
					<?php /*	
							
							<h4>Use Care <span class="required">*</span></h4>
							<div class="form-group">
								<!--label for="exampleInputPassword1">use Care*</label-->
								<input type="text" class="form-control" id="useCare" name="useCare" placeholder="Enter Use Care"  value="<?php echo set_value('useCare'); ?>"  />
								<span class="text-danger"><?php echo form_error('useCare'); ?></span>
							</div> 
						
						
						
							<h4>Product Design <span class="required">*</span></h4>
							<div class="form-group">
								<!--label for="exampleInputPassword1">Product Design*</label-->
								<input type="text" class="form-control" id="productDesign" name="productDesign" placeholder="Enter Product Design"  Value="<?php echo set_value('productDesign'); ?>" />
								<span class="text-danger"><?php echo form_error('productDesign'); ?></span>
							</div>
						
					*/ ?>	
							
							<h4>Product Status <span class="required">*</span></h4>
							<div class="form-group">
								
								<select class="form-control" id="pro_isActive" name="pro_isActive" >
									<option value="0">-- Select Status --</option>
									<option value="1" selected=""> Active </option>
									<option value="0"> De-active </option>
								</select>
								<span class="text-danger"><?php echo form_error('pro_isActive'); ?></span>
							</div>
							
							
							<h4>Is New Arrivals</h4>
							<div class="form-group">
								<!--label for="exampleInputPassword1">use Care*</label-->
								<input type="checkbox"  id="pro_isNewArrivals" name="pro_isNewArrivals" value="1" /> &nbsp;   <label> Check to make Product as NewArrivals. </label>
								<span class="text-danger"><?php echo form_error('pro_isNewArrivals'); ?></span>
							</div> 
						
						</div>
						
						
						<div class="col-md-12">	
							<h4>Product Description <span class="required">*</span></h4>
							<div class="form-group">
								<div class="box-body pad">
									<textarea id="productDescriptionCKEditor" name="productDescription" rows="10" cols="80" placeholder="Add Product Description Here.."   ><?php echo set_value('productDescription'); ?></textarea>
									<span class="text-danger"><?php echo form_error('productDescription'); ?></span>
								</div>
							</div>
						</div>
						<br/>
						
						<!----Add product main image start--------->
						<div class="col-md-12">	
							<div class="col-md-2">
								<h4>Product Main Image</h4>
								<div class="form-group">
									<input type="file"  onchange="readURL(this);" style="display:none;" name="ProductMainImage" id="uploadFile" />
									
									<a href="javascript:void(0);" id="uploadTrigger" name="upload_file_name">
										<img class=" previewimg" height="130px" width="130px"  src="<?php echo base_url('assets/frontend/images/no-image.jpg'); ?>" alt="Product_image" id="upload_post_image"  />
									</a>	
									
									<p> Click on image to update New Main Image For Product. </p>
								</div>
							</div>
							
							<div class="col-md-10">
								<div class="col-md-2">
									<h4>Add Product Gallery Images</h4>
									<div class="form-group">
										<input type="file"  name="ProductGalleryImage[]" id="uploadGalleryImages"  multiple style="visibility:hidden;" />
										<?php $imgPath = base_url("assets/images/add-image.jpg");    ?>
										
										<a href="javascript:void(0);" id="uploadGalleryTrigger" name="uploadGalleryTrigger">
											<img class="" height="100px" width="100px"  src="<?php echo $imgPath; ?>" alt="Add_Gallery_image" id="upload_pro_gallery_image"  >
										</a>		
									</div>
								</div>
								<div class="col-md-10">
									<div class="form-group " id="GalleryImagesView"><div id="blankDiv"></div></div>
								</div>
								
								<style>
									
									input[type="file"] {
									display: block;
									}
									.imageThumb {
									max-height: 75px;
									border: 2px solid;
									padding: 1px;
									cursor: pointer;
									}
									.pip {
									display: inline-block;
									margin: 10px 10px 0 0;
									}
									.remove {
									display: block;
									background: #444;
									border: 1px solid black;
									color: white;
									text-align: center;
									cursor: pointer;
									}
									.remove:hover {
									background: white;
									color: black;
									}
									#updateProduct .required
									{
                            color: red;									
									} 
								</style>
								
								
							</div>
						</div>	
						
						<?php // pr($SingleProduct); ?>	
						
						<!----------gallery- view- section ------------>
						<div class="col-md-12">
							<h3>Gallery Images</h3>
							<hr/>
							<?php if(!empty($SingleProduct->GalleryImages)): ?>
							
							<?php 	foreach($SingleProduct->GalleryImages  as $key => $galVal){  ?>
								<div class="col-md-2 grid-im">
										<img height="150px" width="150px"  src="<?php echo base_url('uploads/product_images/').$galVal['productImage']; ?>" alt="Product_image" id="upload_post_image"  >
										<a data-href="<?php echo base_url();?>delete/gallery/image/<?php echo $galVal['imgId']; ?>" class="delete" onclick="return confirm('Are you sure want to delete this image ?')" ><i class="fa fa-times pull-right" title="Delete Image" ></i></a>



									<div class="clear"></div>	
								</div>
							<?php 	}  ?>
							<?php else: ?>
							<div class="col-md-12"style="text-align:center;"><h3> No gallery image found </h3> </div>
							
							<?php endif; ?>
						</div>
						<!---------------------end Here --------------->  
						<div class="col-md-8">
						<p>&nbsp;</p>
						</div>

							
							<div class="col-md-12">
								<div class="box box-info">
									<div class="box-header with-border">
										<h3 class="box-title">Seo - Settings</h3>
									</div>
									<div class="box-body">
										
										<div class="input-group">
											<span class="input-group-addon">Meta Title</span>
											<input class="form-control" id="product_meta_title" name="product_meta_title" type="text" value="<?php echo set_value('product_meta_title'); ?>">
										</div>
										<br>
										
										<div class="input-group">
											<span class="input-group-addon">Meta Keyword</span>
											<input class="form-control" id="product_meta_keyword" name="product_meta_keyword" type="text" value="<?php echo set_value('product_meta_keyword'); ?>">
										</div>
										<br>
										
										
										<div class="input-group">
											<span class="input-group-addon">Meta Description</span>
											<textarea class="form-control" rows="3" cols="40" id="product_meta_description" name="product_meta_description" ><?php echo set_value('product_meta_description'); ?></textarea>
										</div>
										<br>
									</div>
									<!-- /.box-body -->
								</div>
							</div>
							
							
						</div>
						<!----Add product main image end--------->
						
						
					</div>
					<!-- /.box-body -->
					
					<div class="box-footer">
						<button type="submit" name="addNew_product" class="btn btn-success">Create Now</button>
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
