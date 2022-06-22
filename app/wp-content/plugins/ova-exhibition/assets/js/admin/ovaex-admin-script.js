(function( $ ){
	// 'use strict';

	/***** Menu Tab *****/
	$( function() {
		$( "#tabs" ).tabs();
	} );
	/***** End Menu Tab *****/


	/***** Upload Image *****/
	$( function() {
		var file_frame;
		$(document).on('click', '#metabox-exhibition-gallery a.gallery-add', function(e) {

			e.preventDefault();

			if (file_frame) file_frame.close();

			file_frame = wp.media.frames.file_frame = wp.media({
				title: $(this).data('uploader-title'),
				button: {
					text: $(this).data('uploader-button-text'),
				},
				multiple: true
			});

			file_frame.on('select', function() {
				var listIndex = $('#gallery-metabox-list li').index($('#gallery-metabox-list li:last')),
				selection = file_frame.state().get('selection');

				selection.map(function(attachment, i) {
					attachment = attachment.toJSON(),
					index      = listIndex + (i + 1);

					$('#gallery-metabox-list').append('<li><input type="hidden" name="ovaex_gallery_id[' + index + ']" value="' + attachment.id + '"><img class="image-preview" src="' + attachment.sizes.thumbnail.url + '"><a class="change-image button button-small" href="#" data-uploader-title="Change image" data-uploader-button-text="Change image">Change image</a><small><a class="remove-image" href="#">Remove image</a></small></li>');
				});
			});

			makeSortable();

			file_frame.open();

		});

		$(document).on('click', '#metabox-exhibition-gallery a.change-image', function(e) {

			e.preventDefault();

			var that = $(this);

			if (file_frame) file_frame.close();

			file_frame = wp.media.frames.file_frame = wp.media({
				title: $(this).data('uploader-title'),
				button: {
					text: $(this).data('uploader-button-text'),
				},
				multiple: false
			});

			file_frame.on( 'select', function() {
				attachment = file_frame.state().get('selection').first().toJSON();

				that.parent().find('input:hidden').attr('value', attachment.id);
				that.parent().find('img.image-preview').attr('src', attachment.sizes.thumbnail.url);
			});

			file_frame.open();

		});

		function resetIndex() {
			$('#metabox-exhibition-gallery #gallery-metabox-list li').each(function(i) {
				$(this).find('input:hidden').attr('name', 'ovaex_gallery_id[' + i + ']');
			});
		}

		function makeSortable() {
			$('#metabox-exhibition-gallery #gallery-metabox-list').sortable({
				opacity: 0.6,
				stop: function() {
					resetIndex();
				}
			});
		}

		$(document).on('click', '#metabox-exhibition-gallery a.remove-image', function(e) {
			e.preventDefault();

			$(this).parents('li').animate({ opacity: 0 }, 200, function() {
				$(this).remove();
				resetIndex();
			});
		});

		makeSortable();
	} );
	/***** End Upload Image *****/


	/***** Date Time Picker *****/
	$( function($) {
		$('.ex_start_date, .ex_end_date').each(function(){
         var date = $(this).data('date');
         var lang = $(this).data('lang');

         $(this).datetimepicker({
            format: date,
         });
         $.datetimepicker.setLocale(lang);

      });
	} );
	/***** End Date Time Picker *****/

})(jQuery); 	