/**
 * Created by florianpeters on 04.07.15.
 */
(function($) {
    $(document).ready(function() {
        var revapi = jQuery('.tp-banner').revolution({
            delay:9000,
            startwidth:1700,
            startheight:600,
            hideThumbs:true,
            navigationType:"none",
            fullWidth:"on",
            forceFullWidth:"on"
        });
        //new UISearch( document.getElementById( 'sb-search' ) );
    });
})(jQuery);