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
                'name'              => 'banner',
                'title'             => 'Баннер',
                // 'description'       => __('A custom banner.'),
                'render_template'   => 'template-parts/blocks/banner.php',
                'category'          => 'maintisgroup',
                'icon'              => 'maintisgroup',
                'keywords'          => [ 'Баннер' ],
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
                'name'              => 'contacts-info',
                'title'             => 'Контакты (инфо)',
                // 'description'       => __('A custom contacts-info.'),
                'render_template'   => 'template-parts/blocks/contacts-info.php',
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
                'name'              => 'contact-form',
                'title'             => 'Контактная форма',
                // 'description'       => __('A custom contact-form.'),
                'render_template'   => 'template-parts/blocks/contact-form.php',
                'category'          => 'maintisgroup',
                'icon'              => 'maintisgroup',
                'keywords'          => [ 'Контактная форма' ],
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
                'title'             => 'Блоки 1',
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
                'name'              => 'blocks2',
                'title'             => 'Блоки 2',
                // 'description'       => __('A custom blocks2.'),
                'render_template'   => 'template-parts/blocks/blocks2.php',
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
                'name'              => 'blocks3',
                'title'             => 'Блоки 3',
                // 'description'       => __('A custom blocks3.'),
                'render_template'   => 'template-parts/blocks/blocks3.php',
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
                'name'              => 'blocks4',
                'title'             => 'Блоки 4',
                // 'description'       => __('A custom blocks4.'),
                'render_template'   => 'template-parts/blocks/blocks4.php',
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
                'name'              => 'best_re',
                'title'             => 'Лучшие объекты',
                // 'description'       => __('A custom best_re.'),
                'render_template'   => 'template-parts/blocks/best-realestate.php',
                'category'          => 'maintisgroup',
                'icon'              => 'maintisgroup',
                'keywords'          => [ 'Ообъекты' ],
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
                'name'              => 'best_res',
                'title'             => 'Лучшие объекты (слайдер)',
                // 'description'       => __('A custom best_res.'),
                'render_template'   => 'template-parts/blocks/best-realestate-slider.php',
                'category'          => 'maintisgroup',
                'icon'              => 'maintisgroup',
                'keywords'          => [ 'Ообъекты' ],
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
                'name'              => 'slider_main',
                'title'             => 'Слайдер',
                // 'description'       => __('A custom slider-main.'),
                'render_template'   => 'template-parts/blocks/slider-main.php',
                'category'          => 'maintisgroup',
                'icon'              => 'maintisgroup',
                'keywords'          => [ 'Слайдер' ],
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
                'name'              => 'filter',
                'title'             => 'Фильтр',
                // 'description'       => __('A custom filter.'),
                'render_template'   => 'template-parts/blocks/filter.php',
                'category'          => 'maintisgroup',
                'icon'              => 'maintisgroup',
                'keywords'          => [ 'Фильтр' ],
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
                'name'              => 'info-country',
                'title'             => 'Инфо (страна)',
                // 'description'       => __('A custom info-country.'),
                'render_template'   => 'template-parts/blocks/info-country.php',
                'category'          => 'maintisgroup',
                'icon'              => 'maintisgroup',
                'keywords'          => [ 'Инфо (страна)' ],
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
                'name'              => 'info',
                'title'             => 'Инфо',
                // 'description'       => __('A custom info.'),
                'render_template'   => 'template-parts/blocks/info.php',
                'category'          => 'maintisgroup',
                'icon'              => 'maintisgroup',
                'keywords'          => [ 'Инфо' ],
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
                'name'              => 'realestate-tax',
                'title'             => 'Объекты недвижимости (категории)',
                // 'description'       => __('A custom realestate-tax.'),
                'render_template'   => 'template-parts/blocks/realestate-tax.php',
                'category'          => 'maintisgroup',
                'icon'              => 'maintisgroup',
                'keywords'          => [ 'Объекты недвижимости' ],
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
                'name'              => 'realestate-tax-map',
                'title'             => 'Объекты недвижимости (на карте)',
                // 'description'       => __('A custom realestate-tax-map.'),
                'render_template'   => 'template-parts/blocks/realestate-tax-map.php',
                'category'          => 'maintisgroup',
                'icon'              => 'maintisgroup',
                'keywords'          => [ 'Объекты недвижимости' ],
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