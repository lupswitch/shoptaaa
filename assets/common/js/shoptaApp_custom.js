$(function(){
	
	
/* Image Preview Function*/
	$("#uploadTrigger").click(function(){
	   $("#uploadFile").click();
	});
						        
   /* end here */	
	
	
}); // end of doc ready	


/*******************************************************************************
*	Description : 'readURL' is used to display the image before upload 
*	Developer   : Er.Parwinder Singh
*	DOC			: 30th-March-2017	
*******************************************************************************/	


function readURL(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();

		reader.onload = function (e) {
			$('#upload_post_img_body-bottom').show();
			
			var FileArry = input.files[0].type.split("/"); /* get file type and convert into array */
			
			if(FileArry[0] == 'image'){
				$('.previewimg').attr('src', e.target.result);
			}else{
			/*	$('.previewimg').attr('src', 'http://www.freeiconspng.com/uploads/video-icon-16.png'); */
			/*	$('.previewimg').attr('src', 'https://cdn4.iconfinder.com/data/icons/BRILLIANT/3d_graphics/png/400/camera.png'); */
				
				alert("Error : only (JPG,JPEG, PNG, GIF) images are allowed");
			}
			console.log(input.files[0]);
		}

		reader.readAsDataURL(input.files[0]);
	}
}


/* Image Preview Function*/
	$("#uploadGalleryTrigger").click(function(){
	   $("#uploadGalleryImages").click();
	});



$(document).ready(function() {

  if (window.File && window.FileList && window.FileReader) {
	  
    $("#uploadGalleryImages").on("change", function(e) {
	
		


      var files = e.target.files,
        filesLength = files.length;

        $("#GalleryImagesView").html(""); // reset the Gallery view images
		
      for (var i = 0; i < filesLength; i++) {
        var f = files[i]
        var fileReader = new FileReader();
        fileReader.onload = (function(e) {
          var file = e.target;
      /*    $("<span class=\"pip\">" +
            "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
            "<br/><span class=\"remove\">Remove image</span>" +
            "</span>").insertAfter("#files"); 
	*/		
		/*	$("<span class=\"pip\">" +
            "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
            "<br/><span class=\"remove\">Remove image</span>" +
            "</span>").insertAfter("#blankDiv");
*/
			$('#GalleryImagesView').append("<span class=\"pip\">" +
            "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
            "<br/>" +
            "</span>");	

     /*     $(".remove").click(function(){
            $(this).parent(".pip").remove();
          });
     */     
          // Old code here
          /*$("<img></img>", {
            class: "imageThumb",
            src: e.target.result,
            title: file.name + " | Click to remove"
          }).insertAfter("#files").click(function(){$(this).remove();});*/
          
        });
        fileReader.readAsDataURL(f);
      }
    });
  } else {
    alert("Your browser doesn't support to File API")
  }
});












