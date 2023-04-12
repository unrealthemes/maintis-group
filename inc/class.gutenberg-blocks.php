<?php

class UT_Guneberg_Blocks {

    private static $_instance = null; 

    static public function get_instance() {

        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __construct() {

        add_filter( 'block_categories_all', [$this, 'filter_block_categories_when_post_provided'], 10, 2 );
        add_action( 'acf/init', [$this, 'acf_init_block_types'] );
    }

    public function filter_block_categories_when_post_provided( $block_categories, $editor_context ) {

        if ( ! empty( $editor_context->post ) ) {
            array_push(
                $block_categories,
                array(
                    'slug'  => 'maintisgroup',
                    'title' => 'Maintis-Group',
                    'icon'  => 'maintisgroup',
                )
            );
        }
        return $block_categories;
    }

    public function acf_init_block_types() {

        // Check function exists.
        if ( function_exists('acf_register_block_type') ) {
    
            acf_register_block_type([
                'name'              => 'title',
                'title'             => 'Заглавие H1',
                // 'description'       => __('A custom title.'),
                'render_template'   => 'template-parts/blocks/title.php',
                'category'          => 'maintisgroup',
                'icon'              => 'maintisgroup',
                'keywords'          => [ 'Заглавие', 'H1' ],
                'example'           => [
                    'attributes' => [
                        'mode' => 'preview',
                        'data' => [
                            'is_preview' => true
                        ]
                    ]
                ]
            ]);

            acf_register_block_type([
                'name'              => 'breadcrumbs',
                'title'             => 'Навигация',
                // 'description'       => __('A custom breadcrumbs.'),
                'render_template'   => 'template-parts/blocks/breadcrumbs.php',
                'category'          => 'maintisgroup',
                'icon'              => 'maintisgroup',
                'keywords'          => [ 'Навигация' ],
                'example'           => [
                    'attributes' => [
                        'mode' => 'preview',
                        'data' => [
                            'is_preview' => true
                        ]
                    ]
                ]
            ]);

            acf_register_block_type([
                'name'              => 'text',
                'title'             => 'Текст',
                // 'description'       => __('A custom text.'),
                'render_template'   => 'template-parts/blocks/text.php',
                'category'          => 'maintisgroup',
                'icon'              => 'maintisgroup',
                'keywords'          => [ 'Текст' ],
                'example'           => [
                    'attributes' => [
                        'mode' => 'preview',
                        'data' => [
                            'is_preview' => true
                        ]
                    ]
                ]
            ]);
            
            acf_register_block_type([
                'name'              => 'contacts',
                'title'             => 'Контакты',
                // 'description'       => __('A custom contacts.'),
                'render_template'   => 'template-parts/blocks/contacts.php',
                'category'          => 'maintisgroup',
                'icon'              => 'maintisgroup',
                'keywords'          => [ 'Контакты' ],
                'example'           => [
                    'attributes' => [
                        'mode' => 'preview',
                        'data' => [
                            'is_preview' => true
                        ]
                    ]
                ]
            ]);
            
            acf_register_block_type([
                'name'              => 'requisites',
                'title'             => 'Реквизиты',
                // 'description'       => __('A custom requisites.'),
                'render_template'   => 'template-parts/blocks/requisites.php',
                'category'          => 'maintisgroup',
                'icon'              => 'maintisgroup',
                'keywords'          => [ 'Реквизиты' ],
                'example'           => [
                    'attributes' => [
                        'mode' => 'preview',
                        'data' => [
                            'is_preview' => true
                        ]
                    ]
                ]
            ]);
            
            acf_register_block_type([
                'name'              => 'blocks',
                'title'             => 'Блоки',
                // 'description'       => __('A custom blocks.'),
                'render_template'   => 'template-parts/blocks/blocks.php',
                'category'          => 'maintisgroup',
                'icon'              => 'maintisgroup',
                'keywords'          => [ 'Блоки' ],
                'example'           => [
                    'attributes' => [
                        'mode' => 'preview',
                        'data' => [
                            'is_preview' => true
                        ]
                    ]
                ]
            ]);
            
            acf_register_block_type([
                'name'              => 'about',
                'title'             => 'О нас',
                // 'description'       => __('A custom about.'),
                'render_template'   => 'template-parts/blocks/about.php',
                'category'          => 'maintisgroup',
                'icon'              => 'maintisgroup',
                'keywords'          => [ 'О нас' ],
                'example'           => [
                    'attributes' => [
                        'mode' => 'preview',
                        'data' => [
                            'is_preview' => true
                        ]
                    ]
                ]
            ]);
            
            acf_register_block_type([
                'name'              => 'yreviews',
                'title'             => 'Отзывы на Яндексе',
                // 'description'       => __('A custom yreviews.'),
                'render_template'   => 'template-parts/blocks/yreviews.php',
                'category'          => 'maintisgroup',
                'icon'              => 'maintisgroup',
                'keywords'          => [ 'Отзывы', 'Яндекс' ],
                'example'           => [
                    'attributes' => [
                        'mode' => 'preview',
                        'data' => [
                            'is_preview' => true
                        ]
                    ]
                ]
            ]);
            
            acf_register_block_type([
                'name'              => 'documents',
                'title'             => 'Документы',
                // 'description'       => __('A custom documents.'),
                'render_template'   => 'template-parts/blocks/documents.php',
                'category'          => 'maintisgroup',
                'icon'              => 'maintisgroup',
                'keywords'          => [ 'Документы' ],
                'example'           => [
                    'attributes' => [
                        'mode' => 'preview',
                        'data' => [
                            'is_preview' => true
                        ]
                    ]
                ]
            ]);
            
            acf_register_block_type([
                'name'              => 'district-infrastructure',
                'title'             => 'Инфрастуктура района',
                // 'description'       => __('A custom district-infrastructure.'),
                'render_template'   => 'template-parts/blocks/realestate/district-infrastructure.php',
                'category'          => 'maintisgroup',
                'icon'              => 'maintisgroup',
                'keywords'          => [ 'Инфрастуктура района' ],
                'example'           => [
                    'attributes' => [
                        'mode' => 'preview',
                        'data' => [
                            'is_preview' => true
                        ]
                    ]
                ]
            ]);
            
            acf_register_block_type([
                'name'              => 'complex-architecture',
                'title'             => 'Архитектура комплекса',
                // 'description'       => __('A custom complex-architecture.'),
                'render_template'   => 'template-parts/blocks/realestate/complex-architecture.php',
                'category'          => 'maintisgroup',
                'icon'              => 'maintisgroup',
                'keywords'          => [ 'Архитектура комплекса' ],
                'example'           => [
                    'attributes' => [
                        'mode' => 'preview',
                        'data' => [
                            'is_preview' => true
                        ]
                    ]
                ]
            ]);
            
            acf_register_block_type([
                'name'              => 'about-complex',
                'title'             => 'О комплексе',
                // 'description'       => __('A custom about-complex.'),
                'render_template'   => 'template-parts/blocks/realestate/about-complex.php',
                'category'          => 'maintisgroup',
                'icon'              => 'maintisgroup',
                'keywords'          => [ 'О комплексе' ],
                'example'           => [
                    'attributes' => [
                        'mode' => 'preview',
                        'data' => [
                            'is_preview' => true
                        ]
                    ]
                ]
            ]);

        }
    }

} 