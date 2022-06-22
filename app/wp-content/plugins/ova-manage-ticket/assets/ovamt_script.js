(function($){
  "use strict";
  $(document).ready(function(){

   


    /***** Date Time Picker *****/
    $('.ovamt_date').each(function(){
      var date_format = $(this).data('date_format');
      var disabled_week_days = $(this).data('disabled_week_days');
      var disabled_date = $(this).data('disabled_date');
      var lang = $(this).data('lang');
      $(this).datetimepicker({
        timepicker:false,
        format: date_format,
        formatDate: date_format,
        disabledWeekDays: disabled_week_days,
        disabledDates: disabled_date,
        minDate:0
      });
      $.datetimepicker.setLocale(lang);

    });


   

    $( '.single_add_to_cart_button' ).off('click').on('click', function(){
      
        var flag_s = true;

        if( $('.ovamt_date').length > 0  ){
          if( !$('.ovamt_date').val()){
            var meg1 = $( '.ovamt_date' ).data( 'message' );
              alert( meg1 );
              flag_s = false;
          }
        }

        if( $('#ovamt_time').length > 0  ){
          if( !$('#ovamt_time').val() ){
            var meg2 = $( '#ovamt_time' ).data( 'message' );
            alert( meg2 );
            flag_s = false;
          }
        }

        if( flag_s ){
          return true;
        }else{
          return false;
        }

      
      
     
      return true;
    });
      
    
    
    /***** End Date Time Picker *****/

  });
})(jQuery);