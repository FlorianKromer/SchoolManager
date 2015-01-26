(function($) {

    baguetteBox.run('.gallery', {
        captions: true,       // true|false|callback(gallery, element) - Display image captions 
        buttons: true,      // 'auto'|true|false - Display buttons
        async: false,         // true|false - Load files asynchronously
        preload: 2,           // [number] - How many files should be preloaded from current image
        animation: 'slideIn', // 'slideIn'|'fadeIn'|false - Animation type
        afterShow: null,      // callback - To be run after showing the overlay
        afterHide: null,      // callback - To be run after hiding the overlay
        onChange: null        // callback(currentIndex, imagesElements.length) - When image changes
    });
    $.material.init();
    $(document).ready(function() {
	});


})(jQuery);