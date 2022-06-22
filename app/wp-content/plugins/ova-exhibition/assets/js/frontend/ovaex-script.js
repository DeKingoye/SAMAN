(function($){
   "use strict";
   $(document).ready(function(){

      if( $('.gallery_slide').length > 0 ){
         $('.gallery_slide').each(function(){

            var rtl = false;
            
            if( $('body').hasClass('rtl') ){
               rtl = true;
            }

            $(this).owlCarousel({
               autoplay: true,
               autoplayHoverPause: true,
               loop: true,
               nav: true,
               dots: false,
               margin: 40,
               rtl: rtl, 
               lazyLoad: true,
               center: true,
               responsive:{
                  0:{
                     items:1,
                     autoWidth: false,
                  },
                  768:{
                     items:3,
                     autoWidth: false,
                     margin: 30,
                  },
                  1200:{
                     items:2,
                     autoWidth: true,
                  }
               }
            });
         });
      }
   });

})(jQuery);