<?php

class UT_Real_Estate {

    private static $_instance = null;

    static public function get_instance() {

        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __construct() {

        /* Hook into the 'init' action so that the function
        * Containing our post type registration is not 
        * unnecessarily executed. 
        */
        add_action( 'init', [$this, 'custom_post_type'], 0 );
        add_action( 'init', [$this, 'add_custom_taxonomies'], 0 );
        add_action( 'template_redirect', [$this, 'track_post_view'], 20 );
        add_action( "wp_head", [$this, "track_posts"] );
    }

    function custom_post_type() {

        register_post_type( 'realestate', [
            'label'               => 'Недвижимость',
            'labels'              => array(
                'name'          => 'Недвижимость',
                'singular_name' => 'Недвижимость',
                'menu_name'     => 'Недвижимость',
                'all_items'     => 'Все Недвижимость',
                'add_new'       => 'Добавить Недвижимость',
                'add_new_item'  => 'Добавить новую Недвижимость',
                'edit'          => 'Редактировать',
                'edit_item'     => 'Редактировать Недвижимость',
                'new_item'      => 'Новая Недвижимость',
            ),
            'description'         => '',
            'public'              => true,
            'publicly_queryable'  => true,
            'show_ui'             => true,
            'show_in_rest'        => true,
            'rest_base'           => '',
            'show_in_menu'        => true,
            'exclude_from_search' => false,
            'capability_type'     => 'post',
            'map_meta_cap'        => true,
            'hierarchical'        => false,
            'rewrite'             => array( 
                // 'slug' => 'faq/%cat_realestate%', 
                'with_front' => false, 
                'pages' => false, 
                'feeds' => false, 
                'feed' => false 
            ),
            'has_archive'         => true, // 'realestate',
            'query_var'           => true,
            'supports'            => array( 'title', 'thumbnail', ),
            'taxonomies'          => array( 'cat_realestate' ),
        ] );
    }

    function add_custom_taxonomies() {

        register_taxonomy(
            'cat_realestate', 
            ['realestate'], 
            array(
                'public'                => true,
                'show_in_nav_menus'     => true, // равен аргументу public
                'show_ui'               => true, // равен аргументу public
                'show_tagcloud'         => true, // равен аргументу show_ui
                'hierarchical'          => true,
                'show_admin_column'     => true,
                'labels' => array(
                    'name' => _x( 'Категории', 'taxonomy general name' ),
                    'singular_name' => _x( 'Категория', 'taxonomy singular name' ),
                    'search_items' =>  __( 'Поиск Категории' ),
                    'all_items' => __( 'Все Категории' ),
                    'parent_item' => __( 'Родительская Категория' ),
                    'parent_item_colon' => __( 'Родительская Категория:' ),
                    'edit_item' => __( 'Edit Категория' ),
                    'update_item' => __( 'Обновить Категорию' ),
                    'add_new_item' => __( 'Добавить новую Категорию' ),
                    'new_item_name' => __( 'Новое имя Категории' ),
                    'menu_name' => __( 'Категории' ),
                ),
                'rewrite' => array(
                    'slug' => 'cat-realestates', // This controls the base slug that will display before each term
                    'with_front' => true, // Don't display the category base before "/locations/"
                    'hierarchical' => true // This will allow URL's like "/locations/boston/cambridge/"
                ),
            )
        );
    }

    public function track_post_view() {
 
        if ( ! is_singular( 'realestate' ) ) {
            return;
        }
     
        global $post;
     
        if ( empty( $_COOKIE['recently_viewed'] ) ) {
            $viewed_realestates = array();
        } else {
            $viewed_realestates = (array) explode( '|', $_COOKIE['recently_viewed'] );
        }

        if ( ! in_array( $post->ID, $viewed_realestates ) ) {
            $viewed_realestates[] = $post->ID;
        }
     
        if ( sizeof( $viewed_realestates ) > 10 ) {
            array_shift( $viewed_realestates );
        }
     
        // Store for session only
        setcookie( 'recently_viewed', implode( '|', $viewed_realestates ) );
     
    }

    public function track_posts($post_id) {

        if (!is_singular('realestate')) {
            return;
        }

        if ( current_user_can('editor') || current_user_can('administrator') ) {
            return;
        }

        if (empty($post_id)) {
            global $post;
            $post_id = $post->ID;
        }

        $this->popular_posts($post_id);
    }

    public function popular_posts($post_id) {

        $count_key = "post_views";

        $count = get_post_meta($post_id, $count_key, true);

        if ($count == "") {
            $count = 1;
            delete_post_meta($post_id, $count_key);
            add_post_meta($post_id, $count_key, $count);
        } else {
            $count++;
            update_post_meta($post_id, $count_key, $count);
        }
    }

    public function get_post_views($postID) {

        $count_key = "post_views";

        $count = get_post_meta($postID, $count_key, true);

        if ($count == "") {
            delete_post_meta($postID, $count_key);
            add_post_meta($postID, $count_key, "0");
            return "0";
        }

        return $count;
    }

} 