/************************************************************
	*														*
	*	JQuery	:	All jQuery ajax code written are here	*
	*	Author	:	Puneet Singh							*
	*	Url		:											*
	*	Date	:	April/06/2017							*
	*														*
************************************************************/




/**********************************************************************************
	Description	:	Function use for increase and decrease product quantitiy number
	Url 		:	'product/xxxx'
	Doc			:	Puneet singh
	Date		:	18 April 2017
**********************************************************************************/

	$(".ddd").on("click", function () {
		var $button = $(this);
		var oldValue = $button.closest('.sp-quantity').find("input.quntity-input").val();
		
		if ($button.text() == "+") {
			var newVal = parseFloat(oldValue) + 1;
		} else {
			// Don't allow decrementing below zero
			if (oldValue > 1) {
				var newVal = parseFloat(oldValue) - 1;
				} else {
				newVal = 1;
			}
		}
		
		$button.closest('.sp-quantity').find("input.quntity-input").val(newVal);
		
	});	

 
/***********************************************************
	Description	:	Code for trigger login and sign up popup
	Url 		:	'checkout'
	Doc			:	Puneet singh
	Date		:	May/1/2017
**********************************************************/

/* 	$('#registerformlink').on("click", function () {
		$('#login_signup').trigger('click');
		$('#register-form-link').trigger('click');
	}); */
	

/***********************************************************
	Description	:	Code for redirect from Download app now button 
	Url 		:	'Home (top header)'
	Doc			:	Puneet singh
	Date		:	May/3/2017
**********************************************************/
$(document).ready(function(){
$('#appclick').click(function() {
	var url = $(this).attr('data-href');
	document.location.href= url;
});

});


/***********************************************************
	Description	:	Code for hide Alert div on Contact us pages
	Url 		:	'contact'
	Doc			:	Puneet singh
	Date		:	April/17/2017
**********************************************************/
setTimeout(function() {
	$("#request").hide('blind');
}, 5000);



