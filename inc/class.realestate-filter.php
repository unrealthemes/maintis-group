<?php

class UT_Real_Estate_Filter {

    private static $_instance = null;

    static public function get_instance() {

        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __construct() {

        // add_filter('pre_get_posts', [$this, 'filter_pre_get_post']);
        add_action('pre_get_posts', [$this, 'filter_pre_get_post']);

        if ( wp_doing_ajax() ) {
            add_action( 'wp_ajax_ut_map_filter', [$this, 'map_filter'] );
            add_action( 'wp_ajax_nopriv_ut_map_filter', [$this, 'map_filter'] );
            
            add_action( 'wp_ajax_ut_count_filter', [$this, 'count_filter'] );
            add_action( 'wp_ajax_nopriv_ut_count_filter', [$this, 'count_filter'] );
        }
    }

    public function count_filter() {

        check_ajax_referer( 'ut_check', 'ajax_nonce' );
        parse_str( $_POST['form'], $form );

        if ( empty($form) ) {
            wp_send_json_error();
        }

        $params = [];
        $args = $this->get_args($form);
        $loop = new WP_Query( $args );
        wp_reset_postdata(); 
        wp_send_json_success( [
            'found_posts' => $loop->found_posts,
        ] );
    }

    public function map_filter() {

        check_ajax_referer( 'ut_check', 'ajax_nonce' );
        parse_str( $_POST['form'], $form );
        $params = [];
        $args = $this->get_args($form);
        $loop = new WP_Query( $args );
                            
        if ( $loop->have_posts() ) {
            while ( $loop->have_posts() ) {
                $loop->the_post(); 
                $lat = get_field('latitude', get_the_ID());
                $lng = get_field('longitude', get_the_ID());
                
                if ( $lat && $lng ) {
                    $params[] = [ $lat, $lng ];
                }
            }
        }
        wp_reset_postdata(); 
        wp_send_json_success( [
            'params' => $params,
        ] );
    }

    public function get_args($get_param) {

        $meta_query = [];
        $tax_query = [];  
        $args = [
            'post_type' => 'realestate',
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'orderby' => 'date',
            'order' => 'DESC',
        ];

        if ( ! empty($get_param['current_tax']) && ! empty($get_param['current_term']) ) {
            $tax_query[] = [
                [
                'taxonomy' => $get_param['current_tax'],
                'field' => 'slug',
                'terms' => $get_param['current_term'],
                ]
            ];
        }
        
        if ( isset($get_param['ut_country']) && ! empty($get_param['ut_country']) ) {
            $tax_query[] = [
                [
                'taxonomy' => 'country',
                'field' => 'name',
                'terms' => $get_param['ut_country'],
                ]
            ];
        }
        
        if ( isset($get_param['ut_city']) && ! empty($get_param['ut_city']) ) {
            $tax_query[] = [
                [
                'taxonomy' => 'city',
                'field' => 'name',
                'terms' => $get_param['ut_city'],
                ]
            ];
        }
        
        if ( isset($get_param['ut_department']) && ! empty($get_param['ut_department']) ) {
            $tax_query[] = [
                [
                'taxonomy' => 'department',
                'field' => 'name',
                'terms' => $get_param['ut_department'],
                ]
            ];
        }
        
        if ( isset($get_param['ut_district']) && ! empty($get_param['ut_district']) ) {
            $tax_query[] = [
                [
                'taxonomy' => 'district',
                'field' => 'name',
                'terms' => $get_param['ut_district'],
                ]
            ];
        }
        
        if ( isset($get_param['ut_finishing']) && ! empty($get_param['ut_finishing']) ) {
            $tax_query[] = [
                [
                'taxonomy' => 'finishing',
                'field' => 'name',
                'terms' => $get_param['ut_finishing'],
                ]
            ];
        }
        
        if ( isset($get_param['ut_site_dstrict']) && ! empty($get_param['ut_site_dstrict']) ) {
            $tax_query[] = [
                [
                'taxonomy' => 'site_dstrict',
                'field' => 'name',
                'terms' => $get_param['ut_site_dstrict'],
                ]
            ];
        }
        
        if ( isset($get_param['ut_tags']) && ! empty($get_param['ut_tags']) ) {
            $tax_query[] = [
                [
                'taxonomy' => 'tags',
                'field' => 'name',
                'terms' => $get_param['ut_tags'],
                ]
            ];
        }

        if ( isset($get_param['ut_badges']) && ! empty($get_param['ut_badges']) ) {
            $tax_query[] = [
                [
                'taxonomy' => 'badges',
                'field' => 'name',
                'terms' => $get_param['ut_badges'],
                ]
            ];
        }
        
        if ( isset($get_param['ut_highway']) && ! empty($get_param['ut_highway']) ) {
            $tax_query[] = [
                [
                'taxonomy' => 'highway',
                'field' => 'name',
                'terms' => $get_param['ut_highway'],
                ]
            ];
        }
            
        if ( isset($get_param['currency_symbol']) && ! empty($get_param['currency_symbol']) && $get_param['currency_symbol'] == 'usd' ) {
            $price_key = 'salePriceUsd';
            $rent_price_key = 'rentPriceUsd';
        } else if ( isset($get_param['currency_symbol']) && ! empty($get_param['currency_symbol']) && $get_param['currency_symbol'] == 'eur' ) {
            $price_key = 'salePriceEur';
            $rent_price_key = 'rentPriceEur';
        } else {
            $price_key = 'salePriceRub';
            $rent_price_key = 'rentPriceRub';
        }

        if ( isset($get_param['price_from']) && ! empty($get_param['price_from']) && isset($get_param['price_to']) && ! empty($get_param['price_to']) ) {
            $meta_query[] = [
                [
                    'key' => $price_key,
                    'value' => [ $get_param['price_from'], $get_param['price_to'] ], 
                    'type' => 'numeric',
                    'compare' => 'BETWEEN'
                ]
            ];
        }

        if ( isset($get_param['dealType']) && $get_param['dealType'] == 'Аренда' ) {
            $meta_query[] = [
                [
                    'key' => $rent_price_key,
                    'value' => 0,
                    'compare' => '<'
                ]
            ];
        }
        
        if ( isset($get_param['area_from']) && ! empty($get_param['area_from']) && isset($get_param['area_to']) && ! empty($get_param['area_to']) ) {
            $meta_query[] = [
                [
                    'key' => 'area',
                    'value' => [ $get_param['area_from'], $get_param['area_to'] ], 
                    'type' => 'numeric',
                    'compare' => 'BETWEEN'
                ]
            ];
        }
        
        if ( isset($get_param['floor_from']) && ! empty($get_param['floor_from']) && isset($get_param['floor_to']) && ! empty($get_param['floor_to']) ) {
            $meta_query[] = [
                [
                    'key' => 'floor',
                    'value' => [ $get_param['floor_from'], $get_param['floor_to'] ], 
                    'type' => 'numeric',
                    'compare' => 'BETWEEN'
                ]
            ];
        }
        
        if ( isset($get_param['ut_bedrooms']) && ! empty($get_param['ut_bedrooms']) ) {
            $meta_query[] = [
                [
                    'key' => 'bedrooms',
                    'value' => $get_param['ut_bedrooms'],
                ]
            ];
        }
        
        if ( isset($get_param['ut_rooms']) && ! empty($get_param['ut_rooms']) ) {
            $meta_query[] = [
                [
                    'key' => 'rooms',
                    'value' => $get_param['ut_rooms'],
                ]
            ];
        }
        
        if ( isset($get_param['ut_bathrooms']) && ! empty($get_param['ut_bathrooms']) ) {
            $meta_query[] = [
                [
                    'key' => 'bathrooms',
                    'value' => $get_param['ut_bathrooms'],
                ]
            ];
        }
        
        if ( isset($get_param['ut_typeMarket']) && ! empty($get_param['ut_typeMarket']) ) {
            $meta_query[] = [
                [
                    'key' => 'typeMarket',
                    'value' => $get_param['ut_typeMarket'],
                ]
            ];
        }
        
        if ( isset($get_param['ut_type']) && ! empty($get_param['ut_type']) ) {
            $meta_query[] = [
                [
                    'key' => 'type',
                    'value' => $get_param['ut_type'],
                ]
            ];
        }

        if ( isset( $get_param['sort'] ) && $get_param['sort'] == 'price_low_high' ) {

            $args['meta_key'] = $price_key;
            $args['orderby'] = 'meta_value_num';
            $args['order'] = 'ASC';

        } else if ( isset( $get_param['sort'] ) && $get_param['sort'] == 'popular' ) {

            $args['meta_key'] = 'post_views';
            $args['orderby'] = 'meta_value_num';
            $args['order'] = 'DESC';

        } else if ( isset( $get_param['sort'] ) && $get_param['sort'] == 'price_high_low' ) {

            $args['meta_key'] = $price_key;
            $args['orderby'] = 'meta_value_num';
            $args['order'] = 'DESC';

        } else if ( isset( $get_param['sort'] ) && $get_param['sort'] == 'alphabet_a_z' ) {

            $args['orderby'] = 'title';
            $args['order'] = 'ASC';

        } else if ( isset( $get_param['sort'] ) && $get_param['sort'] == 'alphabet_z_a' ) {

            $args['orderby'] = 'title';
            $args['order'] = 'DESC';

        }

        if ( ! empty($tax_query) ) {
            $args['tax_query'] = $tax_query;  
        }

        if ( ! empty($meta_query) ) {
            $args['meta_query'] = $meta_query;
        }

        return $args;
    }

    public function filter_pre_get_post( $query ) {

        if ( is_tax() /*is_tax('department')*/ && ! is_admin() && ! $query->is_single && $query->is_main_query() ) {

            global $wp_query;
    
            $meta_query = [];
            $tax_query = [];
            $tax_obj = $wp_query->get_queried_object();
            $paged = get_query_var('paged') ?: 1;
    
            // $query->set( 'posts_per_page', 32 );
            $query->set( 'paged', $paged );
            $query->set( 'orderby', 'date' );
            $query->set( 'order', 'DESC' );
            
            $args = [];
            $tax_query = [];
            $meta_query = [];
    
            if ( isset($tax_obj->taxonomy) && ! empty($tax_obj->taxonomy) ) {
                $tax_query[] = [
                    [
                    'taxonomy' => $tax_obj->taxonomy,
                    'field' => 'slug',
                    'terms' => $tax_obj->slug,
                    ]
                ];
            }
            
            if ( isset($_GET['ut_country']) && ! empty($_GET['ut_country']) ) {
                $tax_query[] = [
                    [
                    'taxonomy' => 'country',
                    'field' => 'name',
                    'terms' => $_GET['ut_country'],
                    ]
                ];
            }
            
            if ( isset($_GET['ut_city']) && ! empty($_GET['ut_city']) ) {
                $tax_query[] = [
                    [
                    'taxonomy' => 'city',
                    'field' => 'name',
                    'terms' => $_GET['ut_city'],
                    ]
                ];
            }
            
            if ( isset($_GET['ut_department']) && ! empty($_GET['ut_department']) ) {
                $tax_query[] = [
                    [
                    'taxonomy' => 'department',
                    'field' => 'name',
                    'terms' => $_GET['ut_department'],
                    ]
                ];
            }
            
            if ( isset($_GET['ut_district']) && ! empty($_GET['ut_district']) ) {
                $tax_query[] = [
                    [
                    'taxonomy' => 'district',
                    'field' => 'name',
                    'terms' => $_GET['ut_district'],
                    ]
                ];
            }
            
            if ( isset($_GET['ut_finishing']) && ! empty($_GET['ut_finishing']) ) {
                $tax_query[] = [
                    [
                    'taxonomy' => 'finishing',
                    'field' => 'name',
                    'terms' => $_GET['ut_finishing'],
                    ]
                ];
            }
            
            if ( isset($_GET['ut_site_dstrict']) && ! empty($_GET['ut_site_dstrict']) ) {
                $tax_query[] = [
                    [
                    'taxonomy' => 'site_dstrict',
                    'field' => 'name',
                    'terms' => $_GET['ut_site_dstrict'],
                    ]
                ];
            }
            
            if ( isset($_GET['ut_tags']) && ! empty($_GET['ut_tags']) ) {
                $tax_query[] = [
                    [
                    'taxonomy' => 'tags',
                    'field' => 'name',
                    'terms' => $_GET['ut_tags'],
                    ]
                ];
            }
            
            if ( isset($_GET['ut_badges']) && ! empty($_GET['ut_badges']) ) {
                $tax_query[] = [
                    [
                    'taxonomy' => 'badges',
                    'field' => 'name',
                    'terms' => $_GET['ut_badges'],
                    ]
                ];
            }
            
            if ( isset($_GET['ut_highway']) && ! empty($_GET['ut_highway']) ) {
                $tax_query[] = [
                    [
                    'taxonomy' => 'highway',
                    'field' => 'name',
                    'terms' => $_GET['ut_highway'],
                    ]
                ];
            }

            if ( isset($_GET['currency_symbol']) && ! empty($_GET['currency_symbol']) && $_GET['currency_symbol'] == 'usd' ) {
                $price_key = 'salePriceUsd';
                $rent_price_key = 'rentPriceUsd';
            } else if ( isset($_GET['currency_symbol']) && ! empty($_GET['currency_symbol']) && $_GET['currency_symbol'] == 'eur' ) {
                $price_key = 'salePriceEur';
                $rent_price_key = 'rentPriceEur';
            } else {
                $price_key = 'salePriceRub';
                $rent_price_key = 'rentPriceRub';
            }

            if ( isset($_GET['price_from']) && ! empty($_GET['price_from']) && isset($_GET['price_to']) && ! empty($_GET['price_to']) ) {
                $meta_query[] = [
                    [
                        'key' => $price_key,
                        'value' => [ $_GET['price_from'], $_GET['price_to'] ], 
                        'type' => 'numeric',
                        'compare' => 'BETWEEN'
                    ]
                ];
            }

            if ( isset($_GET['dealType']) && $_GET['dealType'] == 'Аренда' ) {
                $meta_query[] = [
                    [
                        'key' => $rent_price_key,
                        'value' => 0,
                        'compare' => '!='
                    ]
                ];
            } else {
                $meta_query[] = [
                    [
                        'key' => $rent_price_key,
                        'value' => 0,
                        'compare' => '=='
                    ]
                ];
            }

            if ( isset($_GET['ut_sale']) && $_GET['ut_sale'] ) {
                $meta_query[] = [
                    [
                        'key' => $rent_price_key,
                        'value' => 0,
                        'compare' => '=='
                    ]
                ];
            }
            
            if ( isset($_GET['area_from']) && ! empty($_GET['area_from']) && isset($_GET['area_to']) && ! empty($_GET['area_to']) ) {
                $meta_query[] = [
                    [
                        'key' => 'area',
                        'value' => [ $_GET['area_from'], $_GET['area_to'] ], 
                        'type' => 'numeric',
                        'compare' => 'BETWEEN'
                    ]
                ];
            }
            
            if ( isset($_GET['floor_from']) && ! empty($_GET['floor_from']) && isset($_GET['floor_to']) && ! empty($_GET['floor_to']) ) {
                $meta_query[] = [
                    [
                        'key' => 'floor',
                        'value' => [ $_GET['floor_from'], $_GET['floor_to'] ], 
                        'type' => 'numeric',
                        'compare' => 'BETWEEN'
                    ]
                ];
            }
            
            if ( isset($_GET['ut_bedrooms']) && ! empty($_GET['ut_bedrooms']) ) {
                $meta_query[] = [
                    [
                        'key' => 'bedrooms',
                        'value' => $_GET['ut_bedrooms'],
                    ]
                ];
            }
            
            if ( isset($_GET['ut_rooms']) && ! empty($_GET['ut_rooms']) ) {
                $meta_query[] = [
                    [
                        'key' => 'rooms',
                        'value' => $_GET['ut_rooms'],
                    ]
                ];
            }
            
            if ( isset($_GET['ut_bathrooms']) && ! empty($_GET['ut_bathrooms']) ) {
                $meta_query[] = [
                    [
                        'key' => 'bathrooms',
                        'value' => $_GET['ut_bathrooms'],
                    ]
                ];
            }
            
            if ( isset($_GET['ut_typeMarket']) && ! empty($_GET['ut_typeMarket']) ) {
                $meta_query[] = [
                    [
                        'key' => 'typeMarket',
                        'value' => $_GET['ut_typeMarket'],
                    ]
                ];
            }
            
            if ( isset($_GET['ut_type']) && ! empty($_GET['ut_type']) ) {
                $meta_query[] = [
                    [
                        'key' => 'type',
                        'value' => $_GET['ut_type'],
                    ]
                ];
            }
    
            if ( isset( $_GET['sort'] ) && $_GET['sort'] == 'price_low_high' ) {
    
                $query->set( 'meta_key', 'price' );
                $query->set( 'orderby', 'meta_value_num' );
                $query->set( 'order', 'ASC' );
    
            } else if ( isset( $_GET['sort'] ) && $_GET['sort'] == 'price_high_low' ) {
    
                $query->set( 'meta_key', 'price' );
                $query->set( 'orderby', 'meta_value_num' );
                $query->set( 'order', 'DESC' );
    
            } else if ( isset( $_GET['sort'] ) && $_GET['sort'] == 'alphabet_a_z' ) {
    
                $query->set( 'orderby', 'title' );
                $query->set( 'order', 'ASC' );
    
            } else if ( isset( $_GET['sort'] ) && $_GET['sort'] == 'alphabet_z_a' ) {
    
                $query->set( 'orderby', 'title' );
                $query->set( 'order', 'DESC' );
    
            }
    
            $query->set( 'tax_query', $tax_query );  
            $query->set( 'meta_query', $meta_query );   
        }
    }
} 