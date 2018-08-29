/************************************************************
	*														*
	*	JQuery	:	All jQuery ajax code written are here	*
	*	Author	:	Puneet Singh							*
	*	Url		:											*
	*	Date	:	April/06/2017							*
	*														*
************************************************************/






$(document).ready(function(){
	
/**********************************************************
	Description	:	Code for Auto fill Slug in Add New Page
	Url 		:	'admin/create-page'
	Doc			:	PS
	Date		:	April/06/2017
**********************************************************/
	
	jQuery("#pageTitle").keyup(function(){
		var Text = $(this).val();    
		Text = Text.toLowerCase();   
		var regExp = /\s+/g;    
		Text = Text.replace(regExp,'-');  
		$("#pageSlug").val(Text);   
	}); 
	

	
/**********************************************************
	Description	:	Code for assign delivery boy for order
	Url 		:	'admin/admin/delivery'
	Doc			:	PS
	Date		:	April/25/2017
**********************************************************/
	
	$('.Delivery').click( function(){
		
		var oid = $(this).attr('data-id');
		var Dboy = $('#deleveryBoyId_'+oid).val();
		var href = $(this).attr('data-href');
		var NewData ={ orderid : oid, RequestMethod : 'AssignDeliveryBoy', DeliveryBoy : Dboy }
		
		$.ajax({
			url: href,
			data: NewData, 
			type: "POST",
			dataType: 'json',
			async: true,
			success: function(returnData){
				if(returnData.success == '1' ){
					
					var msg = '<div class="alert-success "> '+returnData.msg+' </div>';
					$('.msg_noti').html(msg);
					$('.msg_noti').show().delay(6000).fadeOut();
					$('#Deliverystatus_'+oid).text('Processing');
					
					$('#Deliverystatus_'+oid).css({
													"color": "#3C8DBC", 
													"font-weight": "800", 
													"font-variant": "petite-caps",
												});
												
					$('#deleveryBoyId_'+oid).css({
													"backgroundColor": "greenyellow",
													"color": "#000"
												});
					
					
				}
				
				if(returnData.success == '0' ){
					var msg = '<div class="alert-danger "> '+returnData.msg+' </div>';
					$('.msg_noti').html(msg);
					$('.msg_noti').show().delay(6000).fadeOut();
				}

			}
		});
		
		
	});
	
		
});

/***********************************************************
	Description	:	Code for hide Alert div on admin pages
	Url 		:	'admin/create-page'
	Doc			:	PS
	Date		:	April/07/2017
**********************************************************/
	setTimeout(function() {
		$("div.alert").hide('blind', {}, 700)
	}, 5000);

