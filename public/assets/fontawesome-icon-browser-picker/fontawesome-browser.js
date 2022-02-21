/**
 * FontAwesome Browser (https://github.com/GianlucaChiarani/FontAwesomeBrowser)
 * @version 0.3
 * @author Gianluca Chiarani
 * @license The MIT License (MIT)
 */

(function ($) {
    
    $.fabrowser = function( options ) {

        var settings = $.extend({
        }, options );

        var icons = ["twitter","facebook","google","linkedin","youtube","instagram","pinterest","snapchat-ghost","skype","android","dribbble","vimeo","fa fa-yahoo","fa fa-reddit"];
		
		
		
        //var icons = ["facebook"];
        $('input[data-fa-browser]').click(function() {
            if (!$('.fa-browser-container').length) {
                var input = $(this);

                $('body').append('<div class="fa-browser-container"><div class="window"></div><div class="close"><i class="fa fa-times"></i></div></div>');
                icons.forEach(function(icon) {
                    $('.fa-browser-container .window').append('<div class="icon"><i title="fab fa-'+icon+'" class="fab fa-'+icon+'"></i></div>');
                });

                $('.fa-browser-container .close').click(function() {
                    $('.fa-browser-container').remove();
                });

                $('.fa-browser-container .icon').click(function() {
                    input.val($(this).find('i').attr('class'));
                    $('.fa-browser-container').remove();
                });
            }
        });
    };

}(jQuery));
