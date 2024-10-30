 
 jQuery(document).ready(function($){

  var mediaUploader;

  $('#ms_co_upload_button').click(function(e) {
	 
    e.preventDefault();
    // If the uploader object has already been created, reopen the dialog
      if (mediaUploader) {
      mediaUploader.open();
      return;
    }
    // Extend the wp.media object
    mediaUploader = wp.media.frames.file_frame = wp.media({
      title: 'Choose Image File',
      button: {
      text: 'Add Image File'
    }, multiple: false });

    // When a file is selected, grab the URL and set it as the text field's value
    mediaUploader.on('select', function() {
      attachment = mediaUploader.state().get('selection').first().toJSON();
      $('#ms_co_image_file').val(attachment.url);
	  $('#ms_co_thumbnail').attr('src', attachment.url);
    });
    // Open the uploader dialog
    mediaUploader.open();
  });
  
  
  
   $('#box-content').keyup('change', function(){ 
				
        var content = $("#box-content").val();
         $('#maintext').html(content);
				
   });

    $('#box-linktext').keyup('change', function(){ 
         var blink = $("#box-linktext").val();
         $('#ctatext').html(blink);
				
    });

    $('#linktext').keyup('change', function(){ 
        var clink = $("#linktext").val();
        $('#linkcta').html(clink);
				
    });
	
	$('.ms_co_plain_box').click(function() {
		window.location = $(this).find("a").attr("href");
	})
  

});
