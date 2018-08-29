<!-- Breadcrumb --->
<div class="breadcrumb-div">
	<div class="container">
		<ol class="breadcrumb">
			<li class="breadcrumb-item active"><a href="<?php echo base_url(); ?>">Home</a></li>
			<li class="breadcrumb-item">Your Wishlist</li>
		</ol>
	</div>
</div>

<!-- End Breadcrumb -->	


<!-------we-accpted-section---->
<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<div class="section2-headeing">
				<h2>Your Wishlist</h2>
			</div>
			<div class="c-l-r">				
				
				<div class="wish-div">
					<!-- First Table -->			
					<div id="no-more-tables">
						
						<?php 
							if(!empty($wishlistProduct)){ ?>
							
							<table class="table-bordered table-striped table-condensed cf cart-tab">
								<thead class="cf">
									<tr class="hd-tb wsh-l">
										<th class="numeric"></th>
										<th class="numeric">PRODUCT</th>
										<th class="numeric">AVAILABILTY</th>
										<th class="numeric">ADD TO BAG</th>
									</tr>
								</thead>
								
								<!--- Tbody --->
								<tbody>
									<?php foreach($wishlistProduct as $data){
									?>
									<tr class="wish-b">
										<td data-title="" class="numeric">
											<a class="delete_wishPro" data-wish-id="<?php echo $data->wish_id; ?>" href="javascript:void(0)"><span class="cross"><i class="fa fa-times-circle fa-lg" aria-hidden="true"></i></span></a>
										</td>
										<td data-title="PRODUCT" class="numeric">
											<div class="product-off">
												<?php 
												if(!empty($data->MainImageName))
												{
													$imagepath =  base_url('uploads/product_images/thumb_images/'.$data->MainImageName.'');
												}
												else
												{
													$imagepath =  base_url('/assets/frontend/images/no-image.jpg');
												}
											?>
											<a href="<?php echo base_url('product/'.$data->pro_slug.''); ?>">
											<img  src="<?php echo $imagepath ; ?>"/></a>
											
											<p><a href="<?php echo base_url('product/'.$data->pro_slug.''); ?>"><?php echo $data->productName; ?></a></p> 
										</div>
									</td>
									
									<?php if(!empty($data->proQuantity) &&  $data->proQuantity != '0' ){
										$stock = "In Stock";
										}else{
										$stock = "Out Stock";
									}
									
									?>
									<td data-title="AVAILABILTY" class="numeric"><?php echo $stock; ?></td>
									<td data-title="ADD TO BAG" class="numeric">
									
										<button class="addtoCart"  id="AddCart_<?php echo $data->pId; ?>" data-id ="<?php echo $data->pId; ?>"  type="submit" class="ad_t_c">Add To Cart</button>
									</td>
									
									</tr>
									
								<?php }  ?>
							</tbody>
							
							<?php } else { ?>
							<div class="col-md-10">
								<h3>No products are added in wishlist</h3>
							</div>
						<?php }?>
						
						<!--- End Tbody --->
						
					</table>
				</div>
				
			</div>
			<!-- End First Table -->	
		</div>	
		
	</div>	
</div>
</div>	
<script type="text/javascript" 
src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
