jQuery(document).ready(function($) {
$('#post-formats-select input').change(checkFormat);
function checkFormat(){
  var format = $('#post-formats-select input:checked').attr('value');
    
    if(typeof format !== 'undefined'){
      
        if(format === 'gallery'){
          $('#gallery_post_metabox').stop(true,true).fadeIn(500);
        }
        else {
          $('#gallery_post_metabox').stop(true,true).fadeOut(500);
        }
        if(format === '0'){
          $('#standard_post_metabox').stop(true,true).fadeIn(500);
        }
        else {
          $('#standard_post_metabox').stop(true,true).fadeOut(500);
        }
        if(format === 'image'){
          $('#image_post_metabox').stop(true,true).fadeIn(500);
        }
        else {
          $('#image_post_metabox').stop(true,true).fadeOut(500);
        }
        if(format === 'video'){
          $('#video_post_metabox').stop(true,true).fadeIn(500);
        }
        else {
          $('#video_post_metabox').stop(true,true).fadeOut(500);
        }
        if(format === 'quote'){
          $('#quote_post_metabox').stop(true,true).fadeIn(500);
        }
        else {
          $('#quote_post_metabox').stop(true,true).fadeOut(500);
        }
        
      }
    }
  $(window).on( 'load', function(){
    checkFormat();
  });
});

   (function($){
    "use strict";

    $.imgupload = $.imgupload || {};
    
    $(document).ready(function () {
         $.imgupload();
    });
$.imgupload = function(){
        // When the user clicks on the Add/Edit gallery button, we need to display the gallery editing
        $('body').on({
             click: function(event){
                var current_imgupload = $(this).closest('.kad_img_upload_widget');

                // Make sure the media gallery API exists
                if ( typeof wp === 'undefined' || ! wp.media ) {
                    return;
                }
                event.preventDefault();

                var frame;
                // Activate the media editor
                var $$ = $(this);

                // If the media frame already exists, reopen it.
                if ( frame ) {
                        frame.open();
                        return;
                    }

                    // Create the media frame.
                    frame = wp.media({
                        multiple: false,
                        library: {type: 'image'}
                    });

                        // When an image is selected, run a callback.
                frame.on( 'select', function() {

                    // Grab the selected attachment.
                    var attachment = frame.state().get('selection').first();
                    frame.close();

                    current_imgupload.find('.kad_custom_media_url').val(attachment.attributes.url);
                    current_imgupload.find('.kad_custom_media_id').val(attachment.attributes.id);
                    var thumbSrc = attachment.attributes.url;
                    if (typeof attachment.attributes.sizes !== 'undefined' && typeof attachment.attributes.sizes.thumbnail !== 'undefined') {
                        thumbSrc = attachment.attributes.sizes.thumbnail.url;
                    } else {
                        thumbSrc = attachment.attributes.icon;
                    }
                    current_imgupload.find('.kad_custom_media_image').attr('src', thumbSrc);
                    current_imgupload.find('.kad_custom_media_id').trigger('change');
                });

                // Finally, open the modal.
                frame.open();
            }

        }, '.kad_custom_media_upload');
     };
})(jQuery);

 (function($){
    "use strict";
    
    $.ascendgallery = $.ascendgallery || {};
    
    $(document).ready(function () {
        $.ascendgallery();
    });

    $.ascendgallery = function(){
        // When the user clicks on the Add/Edit gallery button, we need to display the gallery editing
        $('body').on({
            click: function(event){
                var current_gallery = $(this).closest('.kad_widget_image_gallery');

                if (event.currentTarget.id === 'clear-gallery') {
                    //remove value from input 
                    
                    var rmVal = current_gallery.find('.gallery_values').val('');

                    //remove preview images
                    current_gallery.find(".gallery_images").html("");

                    return;

                }

                // Make sure the media gallery API exists
                if ( typeof wp === 'undefined' || ! wp.media || ! wp.media.gallery ) {
                    return;
                }
                event.preventDefault();

                // Activate the media editor
                var $$ = $(this);

                var val = current_gallery.find('.gallery_values').val();
                wp.media.view.Settings.Gallery = wp.media.view.Settings.Gallery.extend({
                    template: function(view){
                      return;
                    },
                });
                var final;
                if (!val) {
                    var options = {
					frame: 'post',
					       state: 'gallery',
					       multiple: true
					};

					var frame = wp.media.editor.open('gallery_values',options);
                } else {
                    final = '[gallery ids="' + val + '"]';
                    frame = wp.media.gallery.edit(final);
                }


                    
                // When the gallery-edit state is updated, copy the attachment ids across
                frame.state('gallery-edit').on( 'update', function( selection ) {

                    //clear screenshot div so we can append new selected images
                    current_gallery.find(".gallery_images").html("");
                    
                    var element, preview_html= "", preview_img, img_id;
                    var ids = selection.models.map(function(e){
                        element = e.toJSON();
                        preview_img = typeof element.sizes.thumbnail !== 'undefined'  ? element.sizes.thumbnail.url : element.url ;
                        img_id = element.id;
                        preview_html = '<a class="of-uploaded-image edit-kt-meta-gal" data-attachment-id="'+img_id+'" href="#"><img class="gallery-widget-image" src="'+preview_img+'" /></a>';
                        current_gallery.find(".gallery_images").append(preview_html);
                        return e.id;
                    });
                    current_gallery.find('.gallery_values').val(ids.join(','));
                     current_gallery.find( '.gallery_values' ).trigger('change');
    
                });


                return false;
            }
        }, '.gallery-attachments');
    };
})(jQuery);
(function($){
    "use strict";
    
    $.ascend_attachment_gallery = $.ascend_attachment_gallery || {};
    
    $(document).ready(function () {
        $.ascend_attachment_gallery();
    });

    $.ascend_attachment_gallery = function(){
        // When the user clicks on the Add/Edit gallery button, we need to display the gallery editing
        $('body').on({
            click: function(event){
                var current_gallery = $(this).closest('.kad_widget_image_gallery');
                var selected = $(this).data('attachment-id');

                // Make sure the media gallery API exists
                if ( typeof wp === 'undefined' || ! wp.media || ! wp.media.gallery ) {
                    return;
                }

                event.preventDefault();
                // Activate the media editor
                 wp.media.view.Settings.Gallery = wp.media.view.Settings.Gallery.extend({
                    template: function(view){
                      return;
                    },
                });
                var $$ = $(this);
                var val = current_gallery.find('.gallery_values').val();
                var final = '[gallery ids="' + val + '"]';
                var frame = wp.media.gallery.edit(final);
                
                // When the gallery-edit state is updated, copy the attachment ids across
                frame.state('gallery-edit').on( 'update', function( selection ) {

                    //clear screenshot div so we can append new selected images
                    current_gallery.find(".gallery_images").html("");
                    
                    var element, preview_html= "", preview_img, img_id;
                    var ids = selection.models.map(function(e){
                        element = e.toJSON();
                        preview_img = typeof element.sizes.thumbnail !== 'undefined'  ? element.sizes.thumbnail.url : element.url ;
                        img_id = element.id;
                        preview_html = '<a class="of-uploaded-image edit-kt-meta-gal" data-attachment-id="'+img_id+'" href="#"><img class="gallery-widget-image" src="'+preview_img+'" /></a>';
                        current_gallery.find(".gallery_images").append(preview_html);
                        return e.id;
                    });
                    current_gallery.find('.gallery_values').val(ids.join(','));
                    current_gallery.find( '.gallery_values' ).trigger('change');
    
                });


                return false;
            }
        }, '.edit-kt-meta-gal');
    };
})(jQuery);

