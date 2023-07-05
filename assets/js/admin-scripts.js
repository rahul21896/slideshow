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
  parallelUploads: 5,
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
  render_slide_data();
  setTimeout(function(){
    myDropzone.removeFile(file);
  },2500);
});

function update_slide_data(update_data){
  let data = {
    slide_data : update_data,
    action : 'slide_order_update'
  };
  jQuery.ajax({
    url: slideshow_admin.ajax_url,
    method: 'post',
    data: data,
    dataType: 'json',
    beforeSend: function() {
      jQuery('#slideshow_slides ul').addClass('disable');
    },
    success: function(res){
      jQuery('#slideshow_slides ul').removeClass('disable');
    }
  })
}

function init_sortable(){
  jQuery( "#slideshow_slides ul" ).sortable({
    stop: function( event, ui ) {
      let li_list = jQuery('#slideshow_slides ul li');
      let  count = 1;
      let update_data = [];
      jQuery(li_list).each(function(){
        jQuery(this).attr('data-order',count);
        let order = count;
        let id = jQuery(this).attr('data-id');
        update_data.push({id: id,order:order});
        count = count + 1;
      });
      update_slide_data(update_data);
    }
  });
}


function render_slide_data(){
  let slideshow_id = jQuery('#slideshow_id').val();
  if(parseInt(slideshow_id) > 0){
    let data = {
      slideshow_id: slideshow_id,
      action : 'update_slides_list'
    };
    jQuery.ajax({
      url: slideshow_admin.ajax_url,
      method: 'post',
      data: data,
      dataType: 'html',
      beforeSend: function() {
        jQuery('#slideshow_slide_section').addClass('disable');
      },
      success: function(res){
        jQuery('#slideshow_slide_section').removeClass('disable');
        jQuery('#slideshow_slide_section').html(res);
        init_sortable();
      }
    })
  }
}

function delete_slide(element){
  if(confirm('Are you sure, you want to delete slide ?')){
    let slide_id = jQuery(element).attr('data-id');
    if(parseInt(slide_id) > 0){
      let data = {
        slide_id: slide_id,
        action : 'delete_slide'
      };
      jQuery.ajax({
        url: slideshow_admin.ajax_url,
        method: 'post',
        data: data,
        dataType: 'html',
        beforeSend: function() {
          jQuery('#slideshow_slide_section').addClass('disable');
        },
        success: function(res){
          jQuery('#slideshow_slide_section').addClass('disable');
          render_slide_data();
        }
      })
    }
  }
}

jQuery(document).ready(function(){
  render_slide_data();
});

