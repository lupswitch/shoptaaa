<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="breadcrumb-div">
	<div class="container">
		<ol class="breadcrumb">
			<li class="breadcrumb-item active"><a href="<?php echo base_url(); ?>">Home</a></li>
			<li class="breadcrumb-item">Search</li>
		</ol>
	</div>
</div>

<!-- End Breadcrumb -->	

<?php /* pr($searchdata) */;?> 

<!-- Instagram Area Start -->
<section class="instagram dis">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<div class="section-headeing">
					<h2>Search Product</h2>
				</div>
				
				<h3 class="result_heading"><?php echo $title;?></h3>
				
				
				<div class="slider_test">
					<div class="slid-hop">
						
						<?php 
							if(!empty($searchdata)):
						foreach($searchdata as $key=>$ProVal): ?>
						
						<div class="slide">
							<div class="inner">
								<div class="img-blk">
									<a href="<?php echo base_url('product/'.$ProVal->pro_slug.''); ?>"><img alt="<?php echo $ProVal->productName; ?>" title="<?php echo $ProVal->productName; ?>" src="<?php if(!empty($ProVal->MainImage)){ echo base_url('/uploads/product_images/thumb_images/').$ProVal->MainImage; }  else{ echo base_url('/assets/frontend/images/no-image.jpg'); } ?>" />	</a>
								</div>
								<div class="txt-blk">
									<div class="d-cell">
										
										<h3><a href="<?php echo base_url('product/'.$ProVal->pro_slug.''); ?>"><?php echo $ProVal->productName; ?></a></h3>
										<div class="pr">
											<ul>
												<?php 
													if(!empty($ProVal->isWishlist)){
														$embedClass="heartWished";
														} else{
														$embedClass=" ";
													}
												?>
												<li><a id="wished_<?php echo $ProVal->pId; ?>" href="javascript:void(0);" class="addWishlist <?php echo $embedClass; ?>" data-id="<?php echo $ProVal->pId ; ?>"><i class="fa fa-heart" aria-hidden="true"></a></i></li>
												
												<li>
													<a <?php if($ProVal->proQuantity == 0){ } else{ ?> Class="addtoCart" <?php } ?> id="AddCart_<?php echo $ProVal->pId; ?>" href="JavaScript:void(0);" data-id="<?php echo $ProVal->pId ; ?>" ><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></li>
												<li>$ <?php echo  $ProVal->productPrice; ?></li>
											</ul>
										</div>
									</div>
								</div>
								
							</div>
						</div>
						
						<?php 
							endforeach; 
							endif; 
						?>	
						
					</div>
				</div>
				
				
				<!-- Instagram Area Ends -->
			</div>
		</div>
	</div>
	
</section>
<script type="text/javascript">
$( document ).ready(function() {
	
	var keyword = $("#keyword_search_text").text();
	var search_keyword = $("#search_keyword").val(keyword);
});

</script>