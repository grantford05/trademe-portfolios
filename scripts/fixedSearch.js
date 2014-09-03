jQuery(function($) {
    function fixDiv() {
      var $cache = $('#topNav'); 
      if ($(window).scrollTop() > 100) 
        $cache.css({'position': 'fixed', 'top': '0px'}); 
      else
        $cache.css({'position': 'relative', 'top': 'auto'});
    }
    $(window).scroll(fixDiv);
    fixDiv();
});