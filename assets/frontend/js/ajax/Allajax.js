/************************************************************
	*														*
	*	JQuery	:	All jQuery ajax code written are here	*
	*	Author	:	Puneet Singh							*
	*	Url		:											*
	*	Date	:	April/19/2017							*
	*														*
************************************************************/

/*#################################################################################
 #	Description	:	@SnackbarNotification is use Display the message in pop up
 #	Developer	:	Puneet Singh
 #	DOC			:	2nd-May-2017
 ################################################################################*/


function SnackbarNotification(msg){
		
	//Notificiation Snackbar
	$('#snackbar').text(msg);
	var x = document.getElementById("snackbar");
	x.className = "show";
	setTimeout(function(){
		x.className = x.className.replace("show", ""); 
	}, 3000);
}

/*#################################################################################
 #	Description	:	@ResetBtn is use Display Reset button on filter left side bar
 #	Developer	:	Er.Parwinder Singh
 #	DOC			:	15-May-2017
 ################################################################################*/

	function ResetBtn(){
		
		var baseURL =	$('#base_url').val();	
		var resetBtn ='<a class="btn btn-success" href="'+baseURL+'products">Reset Filter</a>';			
		$('.resetFilter').html(resetBtn);
	}
	
/* <<<<<<<<<< END HERE >>>>>>>>>> */

/*#################################################################################
 #	Description	:	Function is use add product to cart By ajax
 #	name 		:	'add to cart'
 #	Developer	:	Er.Parwinder Singh
 #	DOC			:	3rd-May-2017
 ################################################################################*/
	
	
	function AddToCart(obj){
	
		var pro_id = $(obj).attr('data-id');
		var base_url = $('#base_url').val();
		
		var NewData ={ pidadd : pro_id,  RequestMethod : 'AddToCartajax', }
		
		$.ajax({
			url: base_url+'request/addtobuket',
			data: NewData, // change this to send js object
			type: "POST",
			dataType: 'json',
			async: true,
			success: function(returnData){
				
				if(returnData.success =='login'){
					var msg = '<div class="alert-danger alert-dismissable"> Please Login First </div>';
					$('#loginFailed').html(msg);
					$('#loginFailed').show().delay(6000).fadeOut();
					$('#login_signup').trigger('click');
					
					
				}
				
				if(returnData.success == '1' ){
					$('#cartItemsCount').text(returnData.total_items);
					//$ths.attr('id', 'wished_'+pro_id+'');
					$('#AddCart_'+pro_id).addClass("heartWished");
					$('#FeatAddCart_'+pro_id).addClass("heartWished");
				
					//Notificiation Snackbar
					SnackbarNotification(returnData.msg+' '+'Total items in Cart '+returnData.total_items);
					
				}
				
				if(returnData.success == '0' )
				{
					
					//Notificiation Snackbar
					SnackbarNotification(returnData.msg);
				}
				
			},error: function () {
						alert('ajax failure ( Add to cart )');
			}
		});
		
		
	}
	

/*#################################################################################
 #	Description	:	@AddToWishList is use add product in to login User Account
 #	name 		:	'add to wishlist'
 #	Developer	:	Er.Parwinder Singh
 #	DOC			:	2nd-May-2017
 ################################################################################*/
	
	function AddToWishList(obj){
		
		var pro_id = $(obj).attr('data-id');
		var base_url = $('#base_url').val();
		var NewData ={ productid : pro_id, RequestMethod : 'AddWishList', }

		$.ajax({
			url: base_url+'request/addWishlist',
			data: NewData, // change this to send js object
			type: "POST",
			dataType: 'json',
			async: true,
			success: function(returnData){
				
				if(returnData.success =='login'){
					var msg = '<div class="alert-danger alert-dismissable"> Please Login First </div>';
					$('#loginFailed').html(msg);
					$('#loginFailed').show().delay(6000).fadeOut();
					$('#login_signup').trigger('click');
					
					
				}
				
				if(returnData.success == '1' ){
					$('#wishlistcount').text(returnData.wishcount);
					
					$('#wished_'+pro_id).addClass("heartWished");
					$('#Feturedwished_'+pro_id).addClass("heartWished");
					
					//Notificiation Snackbar
					SnackbarNotification(returnData.msg);
					
				}
				
				if(returnData.success == '2' )
				{
					$('#wishlistcount').text(returnData.wishcount);
					$('#wished_'+pro_id).removeClass("heartWished");
					$('#Feturedwished_'+pro_id).removeClass("heartWished");
					
					//Notificiation Snackbar
				 	SnackbarNotification(returnData.msg);
					
				}
				
			}
		});
	}
	
	
/* <<<<<<<<<< End HERE >>>>>>>>>>> */ 
	
	
	
	
	
$(document).ready(function(){
	
	/**********************************************************************************
	Description	:	Function use add product to wishlist
	Url 		:	'wishlist'
	Doc			:	Puneet singh
	Date		:	19 April 2017
	**********************************************************************************/
	
	
	$('.addWishlist').click( function(){
		AddToWishList(this);
	});	
	
	
/* <<<<<<<<<< End HERE >>>>>>>>>>> */ 			
		
/*#################################################################################
 #	Description	:	Function is use add product to cart By ajax
 #	name 		:	'add to cart'
 #	Developer	:	Er.Parwinder Singh
 #	DOC			:	2nd-May-2017
 ################################################################################*/
	
		
	$('.addtoCart').click( function(){
			AddToCart(this);
	});
/* <<<<<<<<<< End HERE >>>>>>>>>>> */ 			

	
/*#################################################################################
	*	Description	:	This Function helps to Filter product on the bases of selected 
		categories by check box.
	*	Developer	:	Er.Parwinder Singh
	*	Date		:	19 April 2017
*###############################################################################*/
	
	
	$('.category_productFilter').on('change', function(){
		$( "#filterProductsData" ).submit();
	});
	
	
/*#################################################################################
	*	Description	:	This Function helps to Filter product on the bases of selected 
		categories by check box as well as on the based on Selected min and Max Price
	*	Developer	:	Er.Parwinder Singh
	*	Date		:	21 April 2017
*###############################################################################*/
	
	$("#filterProductsData").on('submit',(function(e) {
		
		e.preventDefault();
		
		var baseURL =	$('#base_url').val();	
		
		$('#pageOffset').val('1');/* set offset 1 */
		
		$('#loadMorebtn').removeAttr("disabled");
		$('#loadMorebtn').html('Load More Products... <img width="25px" style="display: none;" id="loader" src="'+baseURL+'assets/frontend/images/loading-100x100.gif">');
		
		$.ajax({
			url: baseURL+'request/productfillter', // Url to which the request is send
			type: "POST",             // Type of request to be send, called as method
			data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
			dataType: 'html',
			contentType: false,       // The content type used when sending data to the server.
			cache: false,             // To unable request pages to be cached
			processData:false,        // To send DOMDocument or non processed data file it is set to false
			async: true,
			success: function(FilterData){
				
				
				if(FilterData == 0){
					
					var msg ="Invalid Request!";
					SnackbarNotification(msg);
					$('#loadMorebtn').hide();
					ResetBtn(); /* call Reset btn function */
					return false;
				}else if(FilterData == 2 ){
					
					var msg = "No Record Found!";
					SnackbarNotification(msg);
					
					var NoRecordHtml = '<div class="txt-blk"><div class="d-cell"><h3><a href="JavaScript:void(0);">No Record Found !</a></h3></div></div>';
					
					$('#product_listingView').html(NoRecordHtml);
					
					$('#loadMorebtn').hide();
					
					ResetBtn(); /* call Reset btn function */
					return false;
				}else{
					$('#product_listingView').html(FilterData);
					$('#loadMorebtn').show();
					
					ResetBtn(); /* call Reset btn function */
				}		
			},
			error: function () {
				alert(' Product Filter Request Failure');
			}
			
		});
		
	}));
	
	/* <<<<<<<<<< End HERE >>>>>>>>>>> */ 			
	
	
/*#################################################################################
	*	Description	:	This Function helps to Load More Products which load on the bases
		of set categories as well as price. 
	*	Developer	:	Er.Parwinder Singh
	*	Date		:	24th-April-2017
*################################################################################*/
	
	
	$(".load_more").click(function(e){
		e.preventDefault();
		// var page = $(this).data('val');
		
		LoadMoreProducts();
		
	});
	
	
	var LoadMoreProducts = function(){
		
		$("#loader").show();
		
		var formData = $("#filterProductsData").serialize();
		/* 	var formData = $("#filterProductsData").serializeArray(); */
		var baseURL =	$('#base_url').val();	
		
		$.ajax({
			url: baseURL+'request/loadmore-products', // Url to which the request is send
			type: "GET",             // Type of request to be send, called as method
			data: formData, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
			
			dataType: 'html',
			contentType: false,       // The content type used when sending data to the server.
			cache: false,             // To unable request pages to be cached
			processData:false,        // To send DOMDocument or non processed data file it is set to false
			async: true,
			/*	success: function(FilterData){
				if(FilterData != '0'){
				$('#product_listingView').html(FilterData);
				
					ResetBtn(); // call Reset btn function 
				}		
				},
				error: function () {
				alert(' Product Filter Request Failure');
				}
			*/
			}).done(function(response){
			
			if(response == 2){
				$('#loadMorebtn').attr('disabled','disabled');
				$('#loadMorebtn').html('No More Products... <img width="25px" style="display: none;" id="loader" src="'+baseURL+'assets/frontend/images/loading-100x100.gif">');		
				return false;
			}
			
			if(response != 0){
				$('#product_listingView').append(response);
				$('#loadMorebtn').show();
				var pageVal = $('#pageOffset').val();
				var NewUpdateVal = ( parseInt(pageVal)+1 );
				$('#pageOffset').val(NewUpdateVal);
				
			}	
			
			$("#loader").hide();
			//	scroll();
		});
		
	};
	
	
	var scroll  = function(){
		
		$('html, body').animate({
			scrollTop: $('.load_more').offset().top
		}, 1000);
	};	
	
	/* <<<<<<<<<< End HERE >>>>>>>>>>> */ 	

	
/**********************************************************************************
	Description	:	Function use Delete product from wishlist
	Url 		:	'Delete wishlist'
	Doc			:	Puneet singh
	Date		:	28 April 2017
**********************************************************************************/

	$('.delete_wishPro').click(function(e){
		e.preventDefault();
		var wishid = $(this).attr('data-wish-id');
		var parent = $(this).parent("td").parent("tr");
		var base_url = $('#base_url').val();
		bootbox.dialog({
			message: "Are you sure you want to Delete this product from wishlist ?",
			title: " <i class='fa fa-exclamation-circle' aria-hidden='true'></i> Confirm Deletion",
			buttons: {
				success: {
					label: "No",
					className: "btn-success",
					callback: function() {
						$('.bootbox').modal('hide');
					}
				},
				danger: {
					label: "Delete!",
					className: "btn-danger",
					callback: function() {
						$.ajax({
							type: 'POST',
							url: base_url+'delete/wishlist/product/'+wishid,
							data: 'wishid='+wishid
						})
						.done(function(response){
							location.reload();
							//bootbox.alert(response);
							//parent.fadeOut('slow');
						})
						.fail(function(){
							bootbox.alert('Error....');
						})
					}
				}
			}
		});
	});
	

	
/**********************************************************************************
	Description	:	Function use Front-end login , sign up and forgot password ?
	Url 		:	'Login/signup'
	Doc			:	Puneet singh
	Date		:	29 April 2017 (Added in this file)
**********************************************************************************/
	
	/******** START LOGIN  ********/
			jQuery("#loginform").validate({
				rules: {
					"email": {
						required: true,
						email: true
					}
				},
				messages: {
					"email": {
						required: "Please, enter an email",
						email: "Email is invalid"
					}
				},
				submitHandler: function (form) { 
					jQuery.ajax({
						url: form.action,
						type: form.method,
						data: jQuery(form).serialize(),
						success: function(response) {
				
							if(response == 1){
								window.location.href = '';
							}else{
								jQuery('#loginFailed').html('<div class="alert-danger alert-dismissable">Incorrect user email or password!</div>');
								jQuery('#loginFailed').show().delay(5000).fadeOut();	
							}
					 
						}
					});			
				}
			});
			/******** END LOGIN ********/
			
			/******* START SIGN-UP *****/
			 $('#register-form').validate({
				 
				rules: {
					email: {
						required: true,
						minlength: 5,
						email: true,
						remote: {
								url: $('#base_url').val()+"frontend/Auth/chk_email_ext",
								type: "post"
							 }
									   
					},
					userName: {
						required: true,
						minlength: 6,
						
									   
					}, 
					passwords: {
						required: true,
						minlength: 8,
						
									   
					},
					confirm_password: {
						required: true,
						equalTo : '#passwords',
					},
					
				},
				  messages: {
					email: {
						required: "Please enter email",
						minlength: "Name should be more than 5 characters",
						remote: "Email already in use!"
						
					
					},
					userName: {
						required: "Please enter Username",
						minlength: "Username should be more than 6 characters"
					
					},
					passwords: {
						required: "Please enter password",
						minlength: "Password should be more than 8 characters"
					
					},
					
				},
				submitHandler: function(form) {
					//alert(form.action);
				$.ajax({
					url: form.action,
					type: form.method,
					data: $(form).serialize(),
					success: function(response) {
						if(response == 1 ){
							
							$('.suces_signup').html('<div class="alert-success alert-dismissable">Sign up sucess!</div>');
							
							window.location.href = 'account/profile';
						}
						else
						{
							jQuery('#loginFailed').html('<div class="alert-danger alert-dismissable">Not able to signup. Please try agin !</div>');
							jQuery('#loginFailed').show().delay(5000).fadeOut();
						
						}
				
					},
				  error: function(data, errorThrown)
				  {
					  alert('request failed :'+errorThrown);
				  }          
				});
			},
			});
			/******* END SIGN-UP *******/
			
			/******* FORGOT PASSWORD ******/
			
			$('#forgot-form').validate({
				 
				rules: {
					forgot_email: {
						required: true,
						email: true,
					},
				},
					messages: {
					forgot_email: {
						required: "Please enter email",
					},
				},
				submitHandler: function(form) {
				
				//alert(form.action);
				$.ajax({
					url: form.action,
					type: form.method,
					data: $(form).serialize(),
					success: function(response) {
					
							$('#reset_msg').html(response);
				
					},
				  error: function(data, errorThrown)
				  {
					  alert('request failed :'+errorThrown);
				  }          
				});
			},
			});
			
			/******* FORGOT PASSWORD ******/
			
			/******* START RESET-PASSWORD *****/
			 $('#resetpassword-form').validate({
				 
				rules: {
					
					new_passwords: {
						required: true,
						minlength: 8,
					},
					match_password: {
						required: true,
						equalTo : '#new_passwords',
					},
					
				},
				  messages: {
					
					new_passwords: {
						required: "Please enter password",
						minlength: "Password should be more than 8 characters"
					
					},
					
				},
				submitHandler: function(form) {
					//alert(form.action);
				$.ajax({
					url: form.action,
					type: form.method,
					data: $(form).serialize(),
					success: function(response) 
					{
						if(response == 1){
							
							$('.suces_signup').html('<div class="alert-success alert-dismissable">Sucessfully update!</div>');
							$('#new_passwords').attr('disabled','disabled');
							$('#match_password').attr('disabled','disabled');
							var baseURL =	$('#base_url').val();
							 
							setTimeout(function() {
								 window.location.href = baseURL;
							}, 3000); 
							
						}
						else
						{
							alert('Please Try Again !');
						}
				
					},
				  error: function(data, errorThrown)
				  {
					  alert('request failed :'+errorThrown);
				  }          
				});
			},
			});
			/******* END RESET-PASSWORD *******/
			
			

});


/*#################################################################################
 #	Description	:	@Remember me use forntend login section
 #	Developer	:	Puneet Singh
 #	DOC			:	3-May-2017
 ################################################################################*/
$(function() {

			if (localStorage.chkbx && localStorage.chkbx != '') 
			{
				$('#remember').attr('checked', 'checked');
				$('#email').val(localStorage.email);
				$('#password').val(localStorage.pass);
            } else {
				$('#remember').removeAttr('checked');
				$('#email').val('');
				$('#password').val('');
            }

            $('#remember').click(function() {
					
                    if ($('#remember').is(':checked')) {
                        // save username and password
                        localStorage.email = $('#email').val();
                        localStorage.pass = $('#password').val();
                        localStorage.chkbx = $('#remember').val();
                    } else {
                        localStorage.email = '';
                        localStorage.pass = '';
                        localStorage.chkbx = '';
                    }
                });
            });
	/************end***************/