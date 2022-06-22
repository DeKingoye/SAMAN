(function($){
	"use strict";
	

	$(window).on('elementor/frontend/init', function () {

		
		/* Masonry Element */
      elementorFrontend.hooks.addAction('frontend/element_ready/ovaex_exhibition_ajax.default', function(){

         jQuery('.ova_more_post, .exhibition_tab_item a').on( "click", function() {

            var $type_action     = jQuery(this).attr('data-type_action');
            var $behav           = jQuery(this).attr('data-behav');

            var $upcoming_day    = jQuery(this).attr('data-upcoming');

            var $pageid          = jQuery(this).attr('data-paged');
            var $ovaex_perpage   = jQuery(this).attr('data-perpage');
            var $ovaex_oder      = jQuery(this).attr('data-order');
            var $ovaex_order_by  = jQuery(this).attr('data-order-by');
            var $ovaex_data_post = jQuery(this).attr('data-post');
            var $data_columns    = jQuery(this).attr('data-columns');

            if( $behav == 'tab' ){
               jQuery('.tab-content').html('');
               jQuery('.ova_more_post').attr('data-paged','1');
               jQuery('.ova_more_post').show();
               jQuery('.ova-nodata').hide();
               jQuery('.image-loadmore').css('display','none');
               jQuery( '.ova_more_post' ).attr( 'data-type_action', $type_action );
            }

            jQuery('.load-more').hide();
            jQuery('.image-loadmore').css('display','inline-block');
            jQuery.ajax({
               url: load_more.url,
               type: 'POST',
               data: ({
                  type_action: $type_action,
                  upcoming_day: $upcoming_day,
                  action: 'ovaex_loadmore',
                  pageid: $pageid,
                  ovaex_perpage: $ovaex_perpage,
                  ovaex_order_by: $ovaex_order_by,
                  ovaex_oder: $ovaex_oder,
                  ovaex_data_post : $ovaex_data_post,
                  ovaex_data_columns : $data_columns
               }),
               success: function(data){
                  console.log(data);
                  if (data){
                     jQuery('.tab-content').append(data);
                  }else{
                     jQuery('.ova_more_post').hide();
                     jQuery('.ova-nodata').show();
                     jQuery('.ova-noload').show();
                  }

                  var $new_paged = parseInt($pageid) + 1;
                  jQuery('.ova_more_post').attr('data-paged',$new_paged);

                  jQuery('.load-more').show();
                  jQuery('.image-loadmore').css('display','none');
               }
            });
         });
      });


      /***** Exhibition Slide *****/
      elementorFrontend.hooks.addAction('frontend/element_ready/ovaex_exhibition_type.default', function(){

         if( $('.slide-owl').length > 0 ){  
            $('.slide-owl').each(function(){
               var owl_slide = $(this);
               var ovaex_sl = $(this).data('options');
               var rtl      = false;

               if( $('body').hasClass('rtl') ){
                  rtl = true;
               }

               owl_slide.owlCarousel({
                  margin: ovaex_sl.margin,
                  smartSpeed: ovaex_sl.smartSpeed,
                  loop: ovaex_sl.loop,
                  autoplay: ovaex_sl.autoplay,
                  autoplayTimeout: ovaex_sl.autoplayTimeout,
                  autoplayHoverPause: ovaex_sl.autoplayHoverPause,
                  dots: ovaex_sl.dots,  
                  nav: ovaex_sl.nav,
                  slideBy: ovaex_sl.slideBy,
                  navText:[ovaex_sl.prev,ovaex_sl.next],
                  rtl: rtl,
                  responsive:{
                     0:{
                        items: ovaex_sl.items_mobile
                     },
                     768:{
                        items: ovaex_sl.items_ipad
                     },
                     1170:{
                        items: ovaex_sl.total_columns_slide,
                     }
                  }
               });
               
               // alert('x');

               // if( $(this).find('.post-items a img').height() > 0 ){
               //    var h_total = $(this).find('.post-items').outerHeight();
               //    var h_content = $(this).find('.post-items .content').outerHeight();
               //    var result = (h_total - h_content)/2;
               //    $(this).find('.owl-next, .owl-prev').css({"top": result});
               //    console.log(h_total);
               //    console.log(h_content);
               //    console.log(result);
               // }
               
            });
         }

      });

   });
})(jQuery);
