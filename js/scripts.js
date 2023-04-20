'use strict';

let ENTITY = {

    init: function init() {

        // ENTITY.save_form();
        ENTITY.change_price();
        ENTITY.init_maps();
        ENTITY.reinit_map();
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

    init_maps: function init_maps() {

        ymaps.ready(function () {

            var maps = $('.yandex--map');

            if ( maps.length ) {
                maps.each( function( index ) {
                    let id = $(this).attr('id');
                    let count = $(this).data('count');
                    let params = $(this).data('params');

                    if (count == 1) {
                        ENTITY.map_handler( id, params );
                        $('#' + id).attr('data-status', 'load');
                    }
                });
            }

        });

    },

    reinit_map: function reinit_map() {

        $('.tab_map').on('click', function() {
            var id = $(this).data('id');
            var params = $('#' + id).data('params');
            var status = $('#' + id).attr('data-status');

            if ( status != 'load' ) {
                setTimeout( function() { 
                    ENTITY.map_handler( id, params );
                    $('#' + id).attr('data-status', 'load');
                }, 500);
            }
        });
    },

    map_handler: function map_handler( id, params ) {

        var points = params;
        var myMap = new ymaps.Map(id, {
            center: [55.751574, 37.573856],
            zoom: 9,
            behaviors: ['default', 'scrollZoom']
        }),
        clusterer = new ymaps.Clusterer({
            // preset: 'islands#invertedVioletClusterIcons',
            groupByCoordinates: false,
            clusterDisableClickZoom: true,
            // clusterHideIconOnBalloonOpen: false,
            geoObjectHideIconOnBalloonOpen: false
        }),
        getPointData = function (index) {
            return {
                // balloonContentHeader: '<font size=3><b><a target="_blank" href="https://yandex.ru">Здесь может быть ваша ссылка</a></b></font>',
                // balloonContentBody: '<p>Ваше имя: <input name="login"></p><p>Телефон в формате 2xxx-xxx:  <input></p><p><input type="submit" value="Отправить"></p>',
                // balloonContentFooter: '<font size=1>Информация предоставлена: </font> балуном <strong>метки ' + index + '</strong>',
                // clusterCaption: 'метка <strong>' + index + '</strong>'
            };
        },
        getPointOptions = function () {
            return {
                // preset: 'islands#violetIcon'
            };
        },
        geoObjects = [];

        for ( var i = 0, len = points.length; i < len; i++ ) {
            geoObjects[i] = new ymaps.Placemark(points[i], getPointData(i), getPointOptions());
        }

        // clusterer.options.set({
        //     gridSize: 80,
        //     clusterDisableClickZoom: true
        // });

        clusterer.add(geoObjects);
        myMap.geoObjects.add(clusterer);

        myMap.setBounds(clusterer.getBounds(), {
            checkZoomRange: true
        });
    }

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