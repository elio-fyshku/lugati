/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import Glide from "@glidejs/glide";
import Slider from "./Slider";
// import Client from "./Client";

(function($) {

    Slider.init();
    // Client.init();

    $(".js-menu__open").on("touchend click", function() {
        var menu = $(this).attr("data-menu");

        $(menu).toggleClass("js-menu__expanded");
        $(menu).parent().toggleClass("js-menu__expanded");
    });

    $(".js-menu__context, .js-menu__close").on("touchend click", function(event) {
        if (
            $(event.target).hasClass("js-menu__context") ||
            $(event.target).hasClass("js-menu__close")
        ) {
            $(".js-menu__expanded").removeClass("js-menu__expanded");
        }
    });

    $('.vfb-item').each(function(index, value) {
        var label = $(this).find('label').text();
        $(this).find('input,textarea').attr('placeholder', label);
        $(this).find('label').remove();
    });

    $(document).on("click", ".industries-page__card-button", function() {
        $(this).toggleClass("industries-page__card-active");
        $(this)
            .siblings()
            .fadeToggle("fast", function() {
                $(this).toggleClass("d-block");
            });
    });


})(jQuery);