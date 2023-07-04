jQuery(function($) {
  $('#toggle-one').bootstrapToggle();
});

/**
 * Copy Text into clipboard.
 * @param string text text.
 */
function copyText(text){
  const textArea = document.createElement("textarea");
  textArea.value = text;
  // Move textarea out of the viewport so it's not visible
  textArea.style.position = "absolute";
  textArea.style.left = "-999999px";

  document.body.prepend(textArea);
  textArea.select();
  document.execCommand('copy');
  alert('Copied Successfully!');
}

/**
 * Create Drag and Drop file upload element.
 */
let myDropzone = new Dropzone("div#slide_upload_form", {
  url: slideshow_admin.ajax_url,
  paramName: "slide_image",
  maxFilesize: 2, // MB
  acceptedFiles: 'image/*',
  params: {
    slideshow_id : jQuery('#slideshow_id').val(),
    action: 'upload_slideshow_image'
  },
  success: function(file, response){
    response = JSON.parse(response);
    if(response.status == 'error'){
      jQuery(file.previewElement).find('.dz-error-message').text(response.message);
      jQuery(file.previewElement).find('.dz-error-message').css('display','block');
      jQuery(file.previewElement).find('.dz-error-message').css('opacity',1);
      jQuery(file.previewElement).find('.dz-error-mark').css('display','block');
      jQuery(file.previewElement).find('.dz-error-mark').css('opacity',1);
    }else{
      jQuery(file.previewElement).find('.dz-success-mark').css('display','block');
      jQuery(file.previewElement).find('.dz-success-mark').css('opacity',1);
    }
  }
});

myDropzone.on("complete", function(file) {
  setTimeout(function(){
    myDropzone.removeFile(file);
  },2500);
});
