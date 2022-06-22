(function($){
  "use strict";
  $(document).ready(function(){

    

    $('.ovamt_date').each(function(){
      var date_format = $(this).data('date_format');
      
      $(this).datetimepicker({
        timepicker:false,
        format: date_format,
        formatDate: date_format,
      });
    });
    



  });
})(jQuery);