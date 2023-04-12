'use strict';

let ENTITY = {

    init: function init() {

        // ENTITY.save_form();
        ENTITY.change_price();
    },

    change_price: function change_price() {

        $('.change-price').on('change', function() {

            var price = $(this).data('price');
            var price_square = $(this).data('price-square');
            var symbol = $(this).data('symbol');

            $('.price_v').html(price + ' ' + $(this).val());
            $('.price_s').html(price_square + ' ' + symbol);

        });
    },

    // save_form: function save_form() {

    //     $('#form').submit( function( e ) {

    //         e.preventDefault();
    //         let data = {
    //             action     : 'ut_save_form',
    //             ajax_nonce : ut_params.ajax_nonce,
    //             form       : $('#form').serialize(),
    //         };

    //         $.ajax({
    //             url  : ut_params.ajaxurl,
    //             data : data,
    //             type : 'POST',
    //             beforeSend: function() {
    //                 let overlay = $('<div id="overlay_form"><img src="' + ut_params.get_template_directory_uri + '/images/preloader.gif"></div>');
    //                     overlay.appendTo('#form');
    //                 $('button[name="form"]').attr( "disabled", true ); 
    //             },
    //             success: function( response ) {

    //                 if ( response.success ) {
    //                     $('#overlay_form').remove();
    //                     $('button[name="form"]').removeAttr("disabled");
    //                 }
    //             }
    //         });
    //     });
    // },

};

$(document).ready( ENTITY.init() );