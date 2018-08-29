<?php 
/* Set WishList Class name if all ready added into wish-list by user */
	if(!empty($ProductData->isWishlist)){
		$embedClass="heartWished";
	}else{
		$embedClass=" ";
	}
?>
<div class="breadcrumb-div">
	<div class="container">
		<ol class="breadcrumb">
			<li class="breadcrumb-item active"><a href="<?php echo base_url(); ?>">Home</a></li>
			<li class="breadcrumb-item"><a href="<?php echo base_url('products'); ?>">Products</a></li>
			<li class="breadcrumb-item"><a href="<?php echo base_url('product/'.$ProductData->pro_slug.''); ?>"><?php echo $ProductData->productName ?></a></li>
		</ol>
	</div>
</div>

<!----pro-section---->	
<div class="container top-pro">
	<div class="card">
		<div class="container-fliud">
			<div class="wrapper row">
				<div class="preview col-md-6 cust-sliders">
					
					<div class="preview-pic tab-content">
						<div class="tab-pane active" id="pic-1"><img src="<?php if(!empty($ProductData->MainImageName)){ echo base_url('uploads/product_images/'.$ProductData->MainImageName.'') ;} else{ echo base_url('assets/frontend/images/no-image.jpg'); }?>" /></div>
						<?php
							if(!empty($ProductData->GalleryImages)){
								$count = 2;
								foreach($ProductData->GalleryImages as $data){ ?>
								<div class="tab-pane" id="pic-<?php echo $count; ?>"><img src="<?php echo base_url('uploads/product_images/'.$data['productImage'].'') ;?>" /></div>
							<?php $count ++; } } ?>
					</div>
					
					<ul class="preview-thumbnail nav nav-tabs">
						<li class="active"><a data-target="#pic-1" data-toggle="tab"><img src="<?php if(!empty($ProductData->MainImageName)){ echo base_url('uploads/product_images/thumb_images/').$ProductData->MainImageName;} else{ echo base_url('assets/frontend/images/no-image.jpg'); }?>" /></a></li>
						<?php
							if(!empty($ProductData->GalleryImages)){
								$count = 2;
								foreach($ProductData->GalleryImages as $data){ ?>
								<li>
									<a data-target="#pic-<?php echo $count; ?>" data-toggle="tab"><img src="<?php  echo base_url('uploads/product_images/'.$data['productImage'].'') ;?>" /></a>
								</li>
								
							<?php $count ++; } }?>
							
					</ul>
				</div>
				<div class="details col-md-6">
				
				
				
					<h3 class="product-title"><?php echo $ProductData->productName ?></h3>
					<h4 class="price">$ <?php echo $ProductData->productPrice ?></h4>
					
		<?php if( $ProductData->IsProductInCart == FALSE ): ?>
					
			<?php 
			$form_attributes = array('id' => 'product_addtocart');
			
			 	echo form_open('cart/add', $form_attributes );
					
						echo form_hidden('pro_id', $ProductData->pId);
						
					/*	(!empty($ProductData->isWishlist))? $WishVal = true : $WishVal = "";
											
						echo form_hidden('isWishlist', $WishVal);
					*/	
						
						
					?>
					
					<div class="section" style="padding-bottom:20px;">
						<div class="sp-quantity">
							<div class="sp-minus fff"> <a class="ddd" href="javascript:void(0);">-</a></div>
							<div class="sp-input">
								<input type="text" name="pro_PruchaseQuantity" id="pro_PruchaseQuantity" class="quntity-input" value="1" />
							</div>
							<div class="sp-plus fff"> <a class="ddd" href="javascript:void(0);">+</a></div>
                      
						</div>
						<span id="quantity_error" style="color:red;"></span>
					</div> 
					
					<div class="action">

                   <?php if($ProductData->proQuantity != '0') { ?>					
                   <button type="Submit" name="AddtoCart"  id="add_to_cart_btn" class="add-to-cart btn btn-default" ><i class="fa fa-cart-plus" aria-hidden="true"></i> Add To cart</button>
						<?php } else { ?>
                   	<a href="JavaScript:Void(0);"  class="add-to-cart btn btn-default" ><i class="fa fa-ban fa-3" aria-hidden="true" style="color: red"></i>
 Out Of Stock</a>
					
                     <?php  } ?>
							<button id="wished_<?php echo $ProductData->pId; ?>" href="javascript:void(0);" class="like btn btn-default addWishlist <?php echo $embedClass; ?>" data-id="<?php echo $ProductData->pId ; ?>" type="button"> Add To Wishlist</button>
					</div>
				<?php echo form_close(); ?>
			<?php else: ?> 	
					<div class="action">
						<a href="<?php echo base_url('cart'); ?>" name="GoToCart" class="add-to-cart btn btn-default" ><i class="fa fa-shopping-cart" aria-hidden="true"></i> Go To Cart</a>
						
							<button id="wished_<?php echo $ProductData->pId; ?>" href="javascript:void(0);" class="like btn btn-default addWishlist <?php echo $embedClass; ?>" data-id="<?php echo $ProductData->pId ; ?>" type="button">Add To Wishlist</button>
					</div>
			
			
			<?php endif; ?>
			
				<p class="product-description"><?php echo $ProductData->productDesign ?></p>
					
					
				</div>
			</div>
		</div>
	</div>
</div>



<!----end------------>

<!--- Description --->
<section class="description-div">
	<div class="container">
		<div class="des-top-menu">
			<ul>
				<li><button class="w3-bar-item w3-button" onclick="openCity('description1')">Description</button></li>
				<li><button class="w3-bar-item w3-button" onclick="openCity('description2')">Dummy-2</button></li>
				<li><button class="w3-bar-item w3-button" onclick="openCity('description3')">Dummy-3</button></li>
				<div class="clearfix"></div>
			</ul>
		</div>
		<div class="des-head main-tab">
			<div id="description1" class="w3-container city">
			  <p><?php echo $ProductData->productDescription ?></p>
			</div>

			<div id="description2" class="w3-container city" style="display:none">
			  <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,</p> 
			</div>

			<div id="description3" class="w3-container city" style="display:none">
			  <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal</p>
			</div>
		</div>
		<!--div class="des-con">
			<div class="row">
				
				<div class="col-md-12 txt">
					<div class="single_product_desc">
						<?php echo $ProductData->productDescription ?>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
		</div--->
	</div>
</section>
<!--- End Description --->


<!--- feature producvt start------>
<section class="instagram">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<div class="section-headeing">
					<h2>Featured Products</h2>
				</div>
				<div class="slider_test">
					
					<div class="slider4">
						<!---Feature Products start---->
						<?php foreach($featureproduct as $fe_product){ ?>
							
							<div class="slide">
								<div class="inner">
									<div class="img-blk">
										<a href="<?php echo base_url('product/'.$fe_product->pro_slug.'');?>"><img alt="<?php echo $fe_product->productName;?>" src="<?php if(!empty($fe_product->MainImage)){ echo base_url('/uploads/product_images/thumb_images/').$fe_product->MainImage; } else { echo base_url('assets/frontend/images/no-image.jpg'); }?>" />	</a>
									</div>
									<div class="txt-blk">
										<div class="d-cell">
											<h3><a href="<?php echo base_url('product/'.$fe_product->pro_slug.'');?>"><?php echo $fe_product->productName;?></a></h3>
											<div class="pr">
												<ul>
													<?php 
														if(!empty($fe_product->isWishlist)){
															$embedClass="heartWished";
															} else {
															$embedClass=" ";
														}
													?>
													<li><a id="Feturedwished_<?php echo $fe_product->pId; ?>" href="javascript:void(0);" class="addWishlist <?php echo $embedClass; ?>" data-id="<?php echo $fe_product->pId ; ?>"><i class="fa fa-heart" aria-hidden="true"></a></i></li>
													
													<li>
														<a class="addtoCart" id="AddCart_<?php echo $fe_product->pId; ?>" href="JavaScript:void(0);" data-id="<?php echo $fe_product->pId ; ?>" ><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
													</li>
													
													<li>$&nbsp;<?php echo $fe_product->productPrice;?></li>
												</ul>
											</div>
										</div>
									</div>
									
								</div>
							</div>
						<?php } ?>
						<!---Feature Products end---->
						
						
					</div>
				</div>
				<!-- Instagram Area Ends -->
			</div></div>
	</div>
</section>
<script>
function openCity(cityName) {
    var i;
    var x = document.getElementsByClassName("city");
    for (i = 0; i < x.length; i++) {
       x[i].style.display = "none";  
    }
    document.getElementById(cityName).style.display = "block";  
}
</script>
<!----pro-section-end-section---->


<script type="text/javascript" >
$(document).ready(function() {
  $('#add_to_cart_btn').on('click', function(e){

   
   var pro_qun = $('#pro_PruchaseQuantity').val();
   var proQuantity = <?php echo $ProductData->proQuantity; ?>;    // validation code here
   
   
    if(pro_qun > proQuantity) {
    	e.preventDefault();
    	$('#quantity_error').show();
      $('#quantity_error').text('We have only '+<?php echo $ProductData->proQuantity; ?>+ ' quantity left in stock');
      return false;
    }else {
   // 	$('#quantity_error').hide();
    //	$('#product_addtocart').submit();
    	//return true;
     }
      
    
  });
});
</script>

