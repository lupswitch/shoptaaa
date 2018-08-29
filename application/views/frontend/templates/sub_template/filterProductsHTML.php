<?php 



foreach($AllProductsList as $key => $proVal ): ?>
									
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
							<li><a onclick="AddToWishList(this);" id="wished_<?php echo $proVal->pId; ?>" href="JavaScript:void(0);" class="addWishlist <?php echo $embedClass; ?>" data-id="<?php echo $proVal->pId ; ?>" ><i class="fa fa-heart" aria-hidden="true"></a></i></li>
						
							<li>
								<a <?php if($proVal->proQuantity == 0){ } else{ ?> onclick="AddToCart(this);" <?php } ?>  id="AddCart_<?php echo $proVal->pId; ?>" href="JavaScript:void(0);" data-id="<?php echo $proVal->pId ; ?>" ><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
							</li>
							<li>$ <?php echo $proVal->productPrice; ?></li>
						</ul>
					</div>
				</div>
			</div>
		</li>
						
<?php endforeach; ?>

<script>
$(document).ready(function () {
	
var pro_count = <?php echo count($AllProductsList) ?>	;

	if(pro_count > 8 ){
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

