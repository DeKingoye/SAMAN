(function($){
	"use strict";

	$(window).on('elementor/frontend/init', function () {

		
		/* Masonry Element */
      elementorFrontend.hooks.addAction('frontend/element_ready/ova_collections.default', function(){
         if($().imagesLoaded) {
            var $grid = $('.content_archive_coll').imagesLoaded( function() {
               $grid.masonry({
                  itemSelector: '.items_archive_coll',
               });
            });
         }
      });		

   });
})(jQuery);
