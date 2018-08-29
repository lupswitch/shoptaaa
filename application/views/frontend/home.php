<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div id="myCarousel" class="carousel slide"> 
	<ol class="carousel-indicators">
	<?php $count = 0; foreach($revslides as $slide )  { ?>
		<li data-target="#myCarousel" data-slide-to="<?php echo $count;?>" class="<?php if($count == '0'){ echo "active"; }else{ echo " "; }?>"></li>
	<?php $count++; } ?>
	</ol>
	
	<div class="carousel-inner">
	
		<?php $count = 0; foreach($revslides as $slide )  { ?>
		<div class="item <?php if($count == '0'){ echo "active"; }else{ echo " "; }?>">
			<!-- Set the first background image using inline CSS below. -->
			<img src="<?php echo base_url();?>/assets/revslideimage/<?php echo $slide->image; ?>" alt="" class="fill" >
			<div class="carousel-caption">
				<div class="mid-cont">
					<div class="slider-section-text">
						<h2><?php echo $slide->slideTitle;?></h2>
						<p><?php echo $slide->slideDescription;?></p>
						<a href="<?php echo $slide->buttonUrl;?>"><?php echo $slide->buttonText;?></a>
					</div>
				</div>
			</div>
		</div>
	<?php  $count++; } ?>
	
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="col-xs-12">
			
			<div class="affter-slider">
				<!------- Catgory start ---------->
				
				<div class="col-sm-6 left-slide">
					<img src="<?php echo base_url('uploads/main/').$GridOption['siteGridImageOne']['optionValue']; ?>">
					<h3><?php echo $GridOption['siteGridButtonTextOne']['optionValue'] ?></h3>
				</div>
				
				<div class="col-sm-6 right-slide">
					<div class="top-image">
						<img src="<?php echo base_url('uploads/main/').$GridOption['siteGridImageTwo']['optionValue']; ?>">
						<!--h3><?php /* echo $GridOption['siteGridButtonTextTwo']['optionValue']; */ ?></h3-->
					</div>
					<div class="btom-image">
						<div class="col-sm-6">
							<img src="<?php echo base_url('uploads/main/').$GridOption['siteGridImageThree']['optionValue']; ?>">
							<h3><?php echo $GridOption['siteGridButtonTextThree']['optionValue']; ?></h3>
						</div>
						<div class="col-sm-6">
							<img src="<?php echo base_url('uploads/main/').$GridOption['siteGridImageFour']['optionValue']; ?>">
							<h3><?php echo $GridOption['siteGridButtonTextFour']['optionValue']; ?></h3>
						</div>
					</div>
				</div>
				
			</div>
		</div>
	</div>
</div>
<!----pro-section---->

<!-- Instagram Area Start -->
<section class="instagram">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<div class="section-headeing">
					<h2>New Arrivals</h2>
				</div>
				<div class="slider_test">
					<div class="slider4">
						
						<!--New product Slider start--->
						<?php foreach($newproduct as $product) { ?>
							<div class="slide">
								<div class="inner">
									<div class="img-blk">
										<a href="<?php echo base_url('product/'.$product->pro_slug.''); ?>"><img alt="<?php echo $product->productName;?>" src="<?php if(!empty($product->MainImage)){ echo base_url('/uploads/product_images/thumb_images/').$product->MainImage; } else { echo base_url('assets/frontend/images/no-image.jpg'); }?>" /></a>
									</div>
									<div class="txt-blk">
										<div class="d-cell">
											<h3><a href="<?php echo base_url('product/'.$product->pro_slug.''); ?>"><?php echo $product->productName;?></a></h3>
											<div class="pr">
												<ul>
												<?php 
												if(!empty($product->isWishlist)){
													$embedClass="heartWished";
												}else{
													$embedClass=" ";
												}
												?>
													<li><a id="wished_<?php echo $product->pId; ?>" href="javascript:void(0);" class="addWishlist <?php echo $embedClass; ?>" data-id="<?php echo $product->pId ; ?>" ><i class="fa fa-heart" aria-hidden="true"></a></i></li>
													<li>
														<a <?php if($product->proQuantity == 0){ } else{ ?> Class="addtoCart" <?php } ?> id="AddCart_<?php echo $product->pId; ?>" href="JavaScript:void(0);" data-id="<?php echo $product->pId ; ?>" ><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
													</li>
													<li>$&nbsp;<?php echo $product->productPrice;?></li>
												</ul>
											</div>
										</div>
									</div>
									
								</div>
							</div>
						<?php } ?>
						<!--New product end slide--->
						
						
					</div>
				</div>
			</div>
			
			
			<!-- Instagram Area Ends -->
		</div></div>
</div>
</section>


<section class="instagram">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<div class="section-headeing">
					<h2>Featured Products</h2>
				</div>
				<div class="slider_test">
					
					<div class="slider5">
						<!---Feature Products start---->
						<?php foreach($featureproduct as $fe_product){ ?>
							


							<div class="slide">
								<div class="inner">
									<div class="img-blk">
										<a href="<?php echo base_url('product/'.$fe_product->pro_slug.''); ?>"><img alt="<?php echo $fe_product->productName;?>" src="<?php if(!empty($fe_product->MainImage)){ echo base_url('/uploads/product_images/thumb_images/').$fe_product->MainImage; } else { echo base_url('assets/frontend/images/no-image.jpg'); }?>" />	</a>
									</div>
									<div class="txt-blk">
										<div class="d-cell">
											<h3><a href="<?php echo base_url('product/'.$fe_product->pro_slug.''); ?>"><?php echo $fe_product->productName;?></a></h3>
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
														<a <?php if($fe_product->proQuantity == 0){ } else{ ?> Class="addtoCart" <?php } ?> id="FeatAddCart_<?php echo $fe_product->pId; ?>" href="JavaScript:void(0);" data-id="<?php echo $fe_product->pId ; ?>" ><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
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
<!----pro-section-end-section---->


<!----logo-section---->
<div class="container mid-logo">
	<div class="section-headeing">
		<h2>Favourite Brands</h2>
	</div>
	<div class="logo-sections">	
		<ul>
		<?php foreach($Brandslogo as $b_logo){ ?>
			<?php if($b_logo->parentBrand ==""): ?>
			<li><a href="javascript:void(0);"><img width="93" height="58" src="<?php echo base_url(''.$b_logo->BrandImgPath.'');?>"></a></li>
		
			<?php endif; ?>
		<?php } ?>
		</ul>
	</div>	
	
</div>

<!----end---logo-section---->
<!-------about-section---->
<div class="container about-section">
	<div class="section-headeing">
		<h2>About Shopta</h2>
	</div>
	<div class="about-text">
		<?php echo substr($AboutData[0]->pageContent,0,500);?>&nbsp;&nbsp;<label><i><a href="<?php echo base_url(''.$AboutData[0]->pageSlug.'');?>">Read More...</a></i></label>
	</div>   
	</div>
</div>
<!-----end--about-section---->

<!-----we-accpted--section---->
<?php

$cart = $this->cart->contents();
foreach ($cart as $val)
{ ?>
<script>
$(document).ready(function () {
$("#AddCart_<?php echo $val['id'];?>").addClass("heartWished");
$("#FeatAddCart_<?php echo $val['id'];?>").addClass("heartWished");
});
</script>

<?php
}
?>