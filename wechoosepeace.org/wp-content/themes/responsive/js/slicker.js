jQuery(document).ready(function() {
 // hides the slickbox as soon as the DOM is ready (a little sooner that page load)
  jQuery('#webcam_slide').hide();
  jQuery('#upload_slide').hide();
  jQuery('#peaceSubmit').hide();
  jQuery('#location_slide').hide();

 // slides down, up, and toggle the slickbox on click    
  jQuery('#slick-down-webcam').click(function() {
    jQuery('#webcam_slide').slideToggle(400);
    return false;
  });
  jQuery('#slick-down-upload').click(function() {
    jQuery('#upload_slide').slideToggle(400);
    return false;
  });
  $('#slick-up').click(function() {
    $('#slickbox').slideUp('fast');
    return false;
  });
  $('#slick-slidetoggle').click(function() {
    $('#slickbox').slideToggle(400);
    return false;
  });
});

function uploadSlider(){
	jQuery('#upload_slide').slideToggle(300);
	jQuery('#webcam_slide').slideUp('fast');
}

function webcamSlider(){
	jQuery('#webcam_slide').slideToggle(300);
	jQuery('#upload_slide').slideUp('fast');
}

function locationSlider(){
	jQuery('#location_slide').slideToggle(300);
}