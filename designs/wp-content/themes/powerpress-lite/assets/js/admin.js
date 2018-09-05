jQuery(document).ready(function($) {
    "use strict";

    //FontAwesome Icon Control JS
    $('body').on('click', '.powerpress-lite-icon-list li', function(){
        var icon_class = $(this).find('i').attr('class');
        $(this).addClass('icon-active').siblings().removeClass('icon-active');
        $(this).parent('.powerpress-lite-icon-list').prev('.powerpress-lite-selected-icon').children('i').attr('class','').addClass(icon_class);
        $(this).parent('.powerpress-lite-icon-list').next('input').val(icon_class).trigger('change');
    });

    $('body').on('click', '.powerpress-lite-selected-icon', function(){
        $(this).next().slideToggle();
    });

});
