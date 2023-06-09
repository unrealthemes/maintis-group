'use strict';

let ENTITY = {

    init: function init() {

        ENTITY.change_price();
        ENTITY.change_currency_symbols();
        ENTITY.map_filter();
        ENTITY.block_filter();
        ENTITY.init_maps();
        ENTITY.reinit_map();
        ENTITY.show_more_btn();

        $('input[name="dealType"]').on('change', function() {
            $('#realestate_form').submit();
        });
        
        $('#eksklyuziv, #sale').on('change', function() {
            $('#realestate_form').submit();
        });

        $('input[name="price_from"], input[name="price_to"]').on('click', function() { 
            $('#realestate_form').submit();
        });

        $('input[name="area_from"], input[name="area_to"]').on('change', function() { 
            let data = {
                action     : 'ut_count_filter',
                ajax_nonce : ut_params.ajax_nonce,
                form       : $('#realestate_form').serialize(),
            };

            $.ajax({
                url  : ut_params.ajax_url,
                data : data,
                type : 'POST',
                beforeSend: function() {},
                success: function( response ) {

                    if ( response.success ) {
                        $('.btn_found_posts').html( 'Показать ' + response.data.found_posts );
                    }
                }
            });
        });
        
        $('input[name="floor_from"], input[name="floor_to"]').on('change', function() { 
            let data = {
                action     : 'ut_count_filter',
                ajax_nonce : ut_params.ajax_nonce,
                form       : $('#realestate_form').serialize(),
            };

            $.ajax({
                url  : ut_params.ajax_url,
                data : data,
                type : 'POST',
                beforeSend: function() {},
                success: function( response ) {

                    if ( response.success ) {
                        $('.btn_found_posts').html( 'Показать ' + response.data.found_posts );
                    }
                }
            });
        });

    },

    block_filter: function block_filter() {

        $('input[name="dealType"]').on('change', function() {
            ENTITY.update_count_filter();
        });

        $('input[name="price_from"], input[name="price_to"]').on('click', function() { 
            ENTITY.update_count_filter();
        });
        
        $('input[name="area_from"], input[name="area_to"]').on('click', function() { 
            ENTITY.update_count_filter();
        });

        $('.dropdown-toggle').each(function() {
            const dropdownToggle = $(this);
            const dropdownMenu = dropdownToggle.siblings('.dropdown-menu');
            const checkboxes = dropdownMenu.find('input[type="checkbox"]');
            checkboxes.on('change', function() {
                if ( 
                    $(this).attr('name') == 'ut_highway[]' ||
                    $(this).attr('name') == 'ut_site_dstrict[]' ||
                    $(this).attr('name') == 'ut_district[]' ||
                    $(this).attr('name') == 'ut_typeMarket[]'
                ) {
                    ENTITY.update_count_filter();
                }
            });
        });
        
    },

    update_count_filter: function update_count_filter() {
        let data = {
            action     : 'ut_count_filter',
            ajax_nonce : ut_params.ajax_nonce,
            form       : $('#realestate_block_form').serialize(),
        };

        $.ajax({
            url  : ut_params.ajax_url,
            data : data,
            type : 'POST',
            beforeSend: function() {},
            success: function( response ) {

                if ( response.success ) {
                    $('.btn_block_found_posts').html( 'Показать ' + response.data.found_posts );
                }
            }
        });
    },

    show_more_btn: function show_more_btn() {

        $('.show_more_btn').on('click', function(e) {
            e.preventDefault();
            $(this).parent().parent().find('.object_list .item').show();
            $(this).hide();
        });

    },

    change_currency_symbols: function change_currency_symbols() {

        $('.base-currency__dropdown-item').on('click', function() {

            var currency = $(this).data('currency');
            $('#currency_symbol').val(currency);
            $('#realestate_form').submit();
        });
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

    map_filter: function map_filter() {

        if ( $('#init_map_filter').length ) {
            $('#init_map_filter').on('click', function() {
                var id = 'yandex-map-filter';
                let data = {
                    action     : 'ut_map_filter',
                    ajax_nonce : ut_params.ajax_nonce,
                    form       : $('#realestate_form').serialize(),
                };

                $.ajax({
                    url  : ut_params.ajax_url,
                    data : data,
                    type : 'POST',
                    beforeSend: function() {},
                    success: function( response ) {

                        if ( response.success ) {
                            $('#' + id).empty();
                            ENTITY.map_handler( id, response.data.params );
                        }
                    }
                });
            });

        }
    },

    init_maps: function init_maps() {

        if ( $('.yandex--map').length ) {
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
        }

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
                balloonContentHeader: '<strong>' + index.title + '</strong>',
                balloonContentBody: '<p>' + index.address + '</p><a href="' + index.permalink + '" target="_blank">' + index.thumbnail + '</a>',
                clusterCaption: '<strong>' + index.title + '</strong>'
            };
        },
        getPointOptions = function () {
            return {
                // preset: 'islands#violetIcon'
            };
        },
        geoObjects = [];

        console.log( points );

        for ( var i = 0, len = points.length; i < len; i++ ) {
            geoObjects[i] = new ymaps.Placemark( [ points[i].lat, points[i].lng ], getPointData(points[i]), getPointOptions());
            // geoObjects[i] = new ymaps.Placemark(points[i]);
        }

        // clusterer.options.set({
        //     gridSize: 80,
        //     clusterDisableClickZoom: true
        // });

        clusterer.add(geoObjects);
        myMap.geoObjects.add(clusterer);

        myMap.setBounds(clusterer.getBounds(), {
            // checkZoomRange: true
        });
    }

};

$(document).ready( ENTITY.init() );