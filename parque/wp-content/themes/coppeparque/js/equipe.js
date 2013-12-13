(function(jQuery){
    jQuery(document).ready( function() {
        /*
         $(".usquare_module_wrapper").uSquare();
         or
         */
        jQuery(".usquare_module_wrapper").uSquare({
            opening_speed:		300,
            closing_speed:		500,
            easing:				'swing'
        });


        jQuery('.jcarousel-skin-tango').jcarousel();

    });
})(jQuery);