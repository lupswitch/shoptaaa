


<!-- Instagram Area Start -->
<section class="instagram dis our-products-section">
	<div class="container">
		<div class="row">
			<div class="col-md-3 col-sm-5 nopadding">
				<div class="filter-box">
					<div class="resetFilter"></div>
					
					<form name="filterproducts" class="filterdata" id="filterProductsData" >
						<h2 class="fill-head">Filter by price</h2>
						<div class="form-group">
							
							<input type="text" id="range" value="" name="range" />
							<!--input class="rangepicker no-limits" data-value="[6,12,17,24]" max="24" min=".25" data-limit="false" data-precision="2" data-range="true" data-formatter="return arguments[0]+'hrs';" type="range"--->
						</div>
						
						<!----hbgh--->
						
						
						
						<div class="form-group price-filter">
							<input type="text" placeholder="$15" readonly id="priceStartFrom" name="PriceFilterFrom" value="$1" />
							<input class="high-price" type="text" readonly id="PriceUpTo" name="PriceFilterUpTo" placeholder="$5000" value="$5000" />
						</div>
						<div class="categories-wrap" id="main_categoryList">
							<h2 class="fill-head">categories</h2>
							
							<?php if(!empty($AllCategories)): ?>
							<?php foreach($AllCategories as $key => $CatVal ): ?>
							<div class="form-check">
								<label class="form-check-label">
									<input type="checkbox" name="FilterCategory[<?php echo $CatVal->categaryName; ?>]"class="form-check-input category_productFilter"  value="<?php echo $CatVal->c_id; ?>"/>
									<?php echo $CatVal->categaryName; ?>
								</label>
							</div>
							<?php endforeach; ?>
							
							<?php else: ?>
							
							<div class="form-check">
								<label class="form-check-label">
									No Record Found!
								</label>
							</div>
							<?php endif; ?>	
							
							
							<input type="hidden" name="page" id="pageOffset" value="1" />
							
						</div>
					</form>
				</div>
				<div class="add-box">
					<h2>Your Add Here</h2>
				</div>
				<div class="add-box">
					<h2>Your Add Here</h2>
				</div>
			</div>
			
			<div class="col-md-9 col-sm-7">
				<div class="product-list">
					<div class="pro-head">
						<h2>Our Products</h2>
					</div>
					
					<ul class="slide" id="product_listingView">
						
						<?php if(!empty($AllProductsList)): ?>
						
						<?php foreach($AllProductsList as $key => $proVal ): ?>
						
						<?php if(!empty($proVal->pro_slug)){ ?>
							<?php $ProURL = base_url().'product/'.$proVal->pro_slug; ?>	
						<?php }else{ ?>
							<?php $ProURL = base_url().'product/'.$proVal->pId; ?>
						<?php }  ?>
						
						<li class="inner">
							<div class="img-blk">
								<?php if(!empty($proVal->MainImagePath)){ ?>
									<?php 	$ImgPath = base_url('/uploads/product_images/thumb_images/').$proVal->MainImageName; ?>
								<?php }else{ ?>
									<?php $ImgPath = base_url('assets/frontend/images/no-image.jpg'); ?>
								<?php } ?>
								<a href="<?php echo $ProURL; ?>"><img src="<?php echo $ImgPath; ?>" alt="<?php echo $proVal->productName; ?>" /></a>
							</div>
							<div class="txt-blk">
								<div class="d-cell">
									<h3><a href="<?php echo $ProURL; ?>"><?php echo $proVal->productName; ?></a></h3>
									<div class="pr">
										<?php 
											if(!empty($proVal->isWishlist)){
												$embedClass="heartWished";
											} else{ $embedClass="";	}
										?>
										
										<ul>
											<li><a id="wished_<?php echo $proVal->pId; ?>" href="JavaScript:void(0);" class="addWishlist <?php echo $embedClass; ?>" data-id="<?php echo $proVal->pId ; ?>" ><i class="fa fa-heart" aria-hidden="true"></a></i></li>
											
											<li>
												<a Class="addtoCart" id="AddCart_<?php echo $proVal->pId; ?>" href="JavaScript:void(0);" data-id="<?php echo $proVal->pId ; ?>" ><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
											</li>
											<li>$ <?php echo $proVal->productPrice; ?></li>
										</ul>
									</div>
								</div>
							</div>
						</li>
						
						
						
						
						<?php endforeach; ?>
						
						
						
						
						<?php else: ?>
						
						<li class="inner">
							<div class="txt-blk">
								<div class="d-cell">
									<h3><a href="JavaScript:void(0);">No Record Found!</a></h3>
								</div>
							</div>
						</li>
						
						<?php endif; ?>
						
					</ul>
					
					
					<div class="more-products">
						<button id="loadMorebtn"  class="btn btn-primary  load_more" >Load More Products... <img width="25px" style="display: none;" id="loader" src="<?php echo base_url('assets/frontend/images/loading-100x100.gif'); ?>"></button>
						
						<!--a href="javascript:void(0);" class="load_more" >Load More Products <img style="display: none;" id="loader" src="http://www.trycatchclasses.com/code/demo/load-more-records-ci/asset/loader.GIF"> </a-->
						
					</div>	
					
					
				</div>
				<!-- Instagram Area Ends -->
			</div></div>
	</div>
	
</section>

<script>
	
    jQuery(document).ready(function(){
		
		var $range = jQuery("#range");
		
	    $range.ionRangeSlider({
            hide_min_max: true,
            keyboard: true,
            min: 1,
            max: 5000,
            from: 1,
            to: 5000,
            type: 'double',
            step: 1,
            prefix: "$",
            grid: true,
			onChange: function (data) {
				console.log(data);
				from = data.from,
				to = data.to;
				
				var PriceFrom = '$'+from;
				var PriceUpto = '$'+to;
				
				$('#priceStartFrom').val(PriceFrom);
				$('#PriceUpTo').val(PriceUpto);
				
				//	console.log(from + " - " + to);
				
			},
			onFinish: function (data) {
				$( "#filterProductsData" ).submit();
			}
			
		});
		/*	
			$range.on("change", function () {
			var $this = $(this),
			from = $this.data("from"),
			to = $this.data("to");
			
			var PriceFrom = '$'+from;
			var PriceUpto = '$'+to;
			
			$('#priceStartFrom').val(PriceFrom);
			$('#PriceUpTo').val(PriceUpto);
			
			console.log(from + " - " + to);
			});
			
		*/	
		
		
	});
</script>
<script>
$(document).ready(function () {



	
var pro_count = <?php echo count($AllProductsList) ?>;

	if(pro_count >= 12){
		$('#loadMorebtn').show();
		$('#loadMorebtn').prop('disabled', false);
	}else {
		$('#loadMorebtn').text('No More Products... ');
		$('#loadMorebtn').prop('disabled', true);
	}	
	
});

</script>

<?php

$cart = $this->cart->contents();
foreach ($cart as $val)
{ ?>
<script>
$(document).ready(function () {
$("#AddCart_<?php echo $val['id'];?>").addClass("heartWished");

	});
</script>

<?php
}
?>

<?php   
$CI =& get_instance();
$datatat = $CI->load->ProductFrontendModel->get_zero_quanitity_pro();

foreach ($datatat as $value) {


?>
<script>
$(document).ready(function () {
$("#AddCart_<?php echo $value['pId'];?>").removeClass('addtoCart'); 

	});
</script>
<?php 

} ?>