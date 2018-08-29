 
<!-- Breadcrumb --->
	<div class="breadcrumb-div">
		<div class="container">
		<ol class="breadcrumb">
			<li class="breadcrumb-item active"><a href="<?php echo base_url(); ?>">Home</a></li>
			<li class="breadcrumb-item">Your Cart</li>
		</ol>
		</div>
	</div>
	
<!-- End Breadcrumb -->

<?php 	
$CI =& get_instance();
$CI->load->model('ProductFrontendModel');

if(!function_exists('is_InWishlist')) {
	
function is_InWishlist($pro_id,$CI){
	if(!empty($GLOBALS['curentuserID'])){
return $Iswishlistdata = $CI->ProductFrontendModel->IsProductInWishlist($pro_id, $GLOBALS['curentuserID']);
}
else {
return false;
}
}
}

?>
	 <!-------we-accpted-section---->
   <div class="container">
		<div class="row">
				<div class="col-xs-12">
					<div class="section2-headeing">
						<h2>Your Cart</h2>
						</div>
	<div class="c-l-r">				
		
		
		<div class="cart_messages" id="CartMessages"><?php echo $this->session->flashdata('verify_msg'); ?></div>
		
	<?php 
      


	if ($cart = $this->cart->contents()){ ?>
		
	<?php // pr($cart)  ?>
	
	<?php 	echo form_open('cart/update-cart'); ?>
		<div class="cart-left">

	<!-- First Table -->			
       <div id="no-more-tables">
            <table class="table-bordered table-striped table-condensed cf cart-tab">
        		<thead class="cf">
        			<tr class="hd-tb">
        				
        				<!--th class="numeric">Sr.No</th-->
        				<th class="numeric">PRODUCT</th>
        				<th class="numeric">PRICE</th>
        				<th class="numeric">QUANTITY</th>
        				<th class="numeric">SUBTOTAL</th>
        			</tr>
        		</thead>
        		<tbody>
				
			
        	<?php $grand_total = 0; $i = 1; ?>
			<?php	
          			$cart = $this->cart->contents();
			
			foreach ($cart as $item): ?>
					<tr class="pro-cd">
			<?php		
					echo form_hidden('cart['. $item['id'] .'][id]', $item['id']);
					echo form_hidden('cart['. $item['id'] .'][rowid]', $item['rowid']);
					echo form_hidden('cart['. $item['id'] .'][name]', $item['name']);
					echo form_hidden('cart['. $item['id'] .'][price]', $item['price']);
					//echo form_hidden('cart['. $item['id'] .'][qty]', $item['qty']);
					$grand_total = $grand_total + $item['subtotal']; 
								?>		
						
						
						<!--td class="numeric" ><?php // echo $i++; ?></td-->
						
        				<td data-title="PRODUCT" class="numeric" id="product">
						<div class="pro-img">
							<a href="<?php echo base_url('product/'.$item['pro_slug']); ?>">
							<img width="70px" src="<?php echo base_url('uploads/product_images/thumb_images/'.$item['pro_image']); ?>" alt="<?php echo $item['name'] ?>" />
							</a>
						</div>
						<div class="pro-text">
							<h4><?php echo $item['name'] ?></h4>
							<!--p>Quis aute iure reprehenderit in voluptate velit esse cillum</p-->
						<ul>
						<li>
							<a id="wished_<?php echo $item['id'] ?>" href="javascript:void(0);" class="addWishlist <?php echo (!empty(is_InWishlist( $item['id'],$CI)))? "heartWished" : ""; ?>  " data-id="<?php echo $item['id'] ?>" >
							<span><i class="fa fa-heart-o" aria-hidden="true"></i></span>Wishlist</a>
						</li>
						
						<li>
							<a href="<?php echo base_url('cart/remove/'.$item['rowid']); ?>">
							<span><i class="fa fa-trash-o" aria-hidden="true"></i></span>Remove</a>
						</li>
						
						</ul>
						<div class="clearfix"></div>
						</div>
						</td>
        				<td data-title="PRICE" class="numeric" id="price">$ <?php echo $item['price']; ?></td>
        				<td data-title="QUANTITY" class="numeric">  
							
							<div class="sp-quantity">
							
								<div class="sp-minus fff"> <a class="ddd" href="javascript:void(0);">-</a></div>
								<div class="sp-input">
									<input type="text" name="cart[<?php echo $item['id']; ?>][qty]"" id="pro_PruchaseQuantity<?php echo $item['id']; ?>" class="quntity-input" value="<?php echo $item['qty']; ?>" />
								</div>
								<div class="sp-plus fff"> <a class="ddd" href="javascript:void(0);">+</a></div>
							
							</div>
							
							
							
						</td>
        				<td data-title="SUBTOTAL" class="numeric" id="subtotal">$ <?php echo number_format($item['subtotal']); ?></td>
                     
        			</tr>
        			<tr>
        				<td>
                    	<span id="quantity_error<?php echo $item['id'];?>" style="color:red; text-align: center; width: 100%; float: left; margin: 5px 0 2px;"></span>
                    	</td>
              		</tr>
			<?php endforeach; ?>
        		</tbody>
				<!-- Second -->
				
				
        	</table>
			
			<div class="boot-btn">
				<input type="submit" value="Update Cart" id="updatecartqu" class="btn btn-default">
			</div>
		
        </div>
	<?php echo form_close(); ?>
	</div>




  <!-- End First Table -->
  
		<div class="cart-right">
			<div class="order-list">
							<ul class="odd-lst">
								<li class="bot-b">
									<h3 class="o-left">Total</h3> 
									<h3 class="o-right">$<?php echo number_format($grand_total,2); ?></h3>
									<div class="clearfix"></div>
									<div class="btn_pls">	
										<a href="<?php echo base_url('checkout'); ?>">PLACE ORDER</a>
									</div>
									
								</li>
								<li class="bb">
									<h3 class="o-left">Order Summery</h3> 
									<h3 class="o-right"></h3>
									<div class="clearfix"></div>
								</li>
								<li class="bb">
									<p class="o-left">Price</p> 
									<p class="o-right">$<?php echo number_format($grand_total,2); ?></p>
									<div class="clearfix"></div>
								</li>
								<li class="bb">
									<p class="o-left">Handling Charges</p> 
									<p class="o-right">Free</p>
									<div class="clearfix"></div>
								</li>
								<!--li class="bb">
									<p class="o-left">VAT/CST</p> 
									<p class="o-right">$15</p>
									<div class="clearfix"></div>
								</li-->
								<li class="top-b">
									<p class="o-left">TOTAL</p> 
									<p class="o-right">$<?php echo number_format($grand_total,2); ?></p>
									<div class="clearfix"></div>
								</li>
								<li class="bb">
									<p class="part">*Part of the taxes payable to the government</p>
								</li>
								
							  </ul>	
					</div>
		</div>
	
	<?php } ?>


	
	<div class="clearfix"></div>	
	
	
		<div class="boot-btn">
				<a href="<?php echo base_url('products'); ?>">Back To Shop</a>
			</div>
	
	</div>	
			
	</div>	
		</div>
	</div>	
    <!-----we-accpted--section---->
	
<script>
function clear_cart() {
	var result = confirm('Are you sure want to clear cart?');
	
	if(result) {
		window.location = "<?php echo base_url(); ?>cart/remove/all";
	}else{
		return false; // cancel button
	}
}
</script>

<?php



$cartdata = $this->cart->contents();

foreach($cartdata as $prosig){
	
$SingleProduct = $CI->ProductFrontendModel->GetSingleProduct($prosig['id'], $isGallery ='no');
$proQuantity = $SingleProduct->proQuantity;

?>
<script type="text/javascript" >
$(document).ready(function() {
  $('#updatecartqu').on('click', function(e){

   
   var pro_qun = $('#pro_PruchaseQuantity<?php echo $SingleProduct->pId;?>').val();
   var proQuantity = <?php echo $proQuantity; ?>;    // validation code here
     if(pro_qun > proQuantity) {
      e.preventDefault();
     	$('#quantity_error<?php echo $SingleProduct->pId;?>').show();
      $('#quantity_error<?php echo $SingleProduct->pId;?>').text('We have '+<?php echo $proQuantity; ?>+ ' quantity left in stock');
      return false;
    }
      
  });
});
</script>








<?php
}



/* if product is out of stock and user click on place order and this will be call */
if($this->uri->segment(2) == 'error-outofstock' ){ ?>
	
	<script>
		$(document).ready(function() {
			$('#updatecartqu').trigger('click');
		}); 
	</script>
	
<?php } 

//pr($SingleProduct);

?>






