<?php

ini_set('max_execution_time', '6000'); //10 часов
set_time_limit(0);

class UT_Parser {

    private static $_instance = null; 

    private $limit_courses = 20;
    private $limit_reviews = 10;
    private $chatgpt_key = 'YOUR_API_KEY';

    static public function get_instance() {

        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __construct() {

        // add_action( 'after_setup_theme', [$this, 'insert_scholls_attribute'] );
        add_action( 'admin_menu', [$this, 'settings_page'] );

        // wp cron for update table Gepha api products
        add_action( 'gepha_update_woo_products', [$this, 'insert_courses'], 10, 1 );
        add_action( 'gepha_insert_product_reviews', [$this, 'insert_course_reviews'], 10, 1 );
        add_action( 'gepha_insert_school_reviews', [$this, 'insert_school_reviews'], 10, 1 );
        add_action( 'gepha_insert_rewrite_school_reviews', [$this, 'insert_rewrite_school_reviews'], 10, 1 );
        add_action( 'gepha_insert_rewrite_course_reviews', [$this, 'insert_rewrite_course_reviews'], 10, 1 );

        // Automatically Delete Woocommerce Images After Deleting a Product
        // add_action( 'before_delete_post', [$this, 'delete_product_images'], 10, 1 );

        //prevents html from being stripped from term descriptions 
        // foreach ( array( 'pre_term_description' ) as $filter ) {
        //     remove_filter( $filter, 'wp_filter_kses' );
        // }

        //prevents html being stripped out when using the term description function (http://codex.wordpress.org/Function_Reference/term_description).
        // foreach ( array( 'term_description' ) as $filter ) {
        //     remove_filter( $filter, 'wp_kses_data' );
        // }

        // add custom interval
        add_filter( 'cron_schedules', [$this, 'add_cron_recurrence_interval'] );

    }

    public function delete_product_images( $post_id ) {

        $product = wc_get_product( $post_id );

        if ( !$product ) {
            return;
        }

        $featured_image_id = $product->get_image_id();
        $image_galleries_id = $product->get_gallery_image_ids();

        if ( !empty( $featured_image_id ) ) {
            wp_delete_post( $featured_image_id );
        }

        if ( !empty( $image_galleries_id ) ) {
            foreach ( $image_galleries_id as $single_image_id ) {
                wp_delete_post( $single_image_id );
            }
        }

    }

    public function settings_page() {

        add_submenu_page( 
            'edit.php?post_type=realestate',
            'Парсер', 
            'Парсер', 
            'edit_posts', 
            'parser_data', 
            [$this, 'data_display'], 
            20, 
            124
        );
    }

    public function data_display() {

        $page = isset( $_GET['parser_page'] ) ? abs( (int)$_GET['parser_page'] ) : 0;
        $status = ( isset( $_GET['parser'] ) && $_GET['parser'] == 1 ) ? true : false;
        $type = $_GET['type'] ?? false;

        get_template_part('template-parts/admin/parser-data-table');

        // if ( $status && $page == 1 && $type == 'courses' ) {
        //     $this->set_shedule_update_woo_products( 1 );
        // } elseif ( $status && $page == 1 && $type == 'course-reviews' ) {
        //     $this->set_shedule_insert_product_reviews($page);
        // } elseif ( $status && $page == 1 && $type == 'school-reviews' ) {
        //     $this->set_shedule_insert_school_reviews($page);
        // } elseif ( $status && $page == 1 && $type == 'rewrite-course-reviews' ) {
        //     $this->set_shedule_insert_rewrite_course_reviews($page);
        // } elseif ( $status && $page == 1 && $type == 'rewrite-school-reviews' ) {
        //     $this->set_shedule_insert_rewrite_school_reviews($page);
        // }

    }

    public function insert_rewrite_school_reviews($page) {

        global $wpdb;   
        $start = microtime(true);
        update_option( 'parser_status_school_views', true ); 

        $table = $wpdb->prefix . 'school_comments';
        $items_per_page = 5;
        $offset = ( $page * $items_per_page ) - $items_per_page;
        $reviews = $wpdb->get_results("SELECT * FROM $table WHERE rewrite != 1 OR rewrite IS NULL ORDER BY comment_date DESC LIMIT $offset, $items_per_page", 'ARRAY_A');
        // $wpdb->query("ALTER TABLE $table ADD rewrite BOOLEAN after comment_approved");

        if ( ! $reviews ) {
            $time = microtime(true) - $start; 
            error_log(print_r('CLEAR CRON', true));
            wp_clear_scheduled_hook( 'gepha_insert_rewrite_school_reviews', [$page-1] );
            wp_clear_scheduled_hook( 'gepha_insert_rewrite_school_reviews', [$page] );
            wp_clear_scheduled_hook( 'gepha_insert_rewrite_school_reviews' );
            update_option( 'parser_status_school_views', false );
            
            return false;
        }

        $page++;
        foreach ( $reviews as $review ) {
            $content = strip_tags($review['comment_content']);
            $content = str_replace(["\r\n", "\r", "\n", "'"], '', $content);
            $content = mb_strimwidth($content, 0, 150, ''); // substr($content, 0, 300);
            $prompt[] = 'rewrite this text in Russian no more than 250 characters: "' . $content . '"';
        }

        if ( $prompt ) {
            $result = $this->rewrite_review($prompt);   

            if ( $result ) {
                foreach ( $reviews as $key => $review ) {
                    $text = $result[ $key ]->text;  
                    $wpdb->update( 
                        $table,
                        [ 
                            'comment_content' => $text,
                            'rewrite' => 1 
                        ],
                        [ 'comment_ID' => $review['comment_ID'] ]
                    );
                }
            } 
        } 

        $time = microtime(true) - $start; 
        error_log(print_r(count($reviews), true)); 
        error_log(print_r($time, true)); 
        error_log(print_r('============================', true));
        // start next iteration
        $this->set_shedule_insert_rewrite_school_reviews($page);

    }
    
    public function insert_rewrite_course_reviews($page) {

        update_option( 'parser_status_course_views', true );
        $start = microtime(true);
        $prompt = [];
        $per_page = 5;
        $pagenum = $page;
        $offset = ($pagenum - 1) * $per_page;
        $query = new WP_Comment_Query;
        $comments = $query->query( [
            'offset' => $offset,
            'number' => $per_page,
            'no_found_rows' => false,
            'meta_query' => array(
                'relation' => 'OR',
                array(
                    'key' => '_rewrite',
                    'value' => true,
                    'compare' => '!='
                ),
                array(
                    'key' => '_rewrite',
                    'compare' => 'NOT EXISTS'
                )
            )
        ] );

        if ( ! $comments ) {
            $time = microtime(true) - $start; 
            error_log(print_r('CLEAR CRON', true));
            wp_clear_scheduled_hook( 'gepha_insert_rewrite_course_reviews', [$page-1] );
            wp_clear_scheduled_hook( 'gepha_insert_rewrite_course_reviews', [$page] );
            wp_clear_scheduled_hook( 'gepha_insert_rewrite_course_reviews' );
            update_option( 'parser_status_course_views', false );
            
            return false;
        }

        $page++;
        foreach ( $comments as $comment ) {
            $content = strip_tags($comment->comment_content);
            $content = str_replace(["\r\n", "\r", "\n", "'"], '', $content);
            $content = mb_strimwidth($content, 0, 150, ''); // substr($content, 0, 300);
            $prompt[] = 'rewrite this text in Russian no more than 250 characters: "' . $content . '"';
        }

        if ( $prompt ) {
            $result = $this->rewrite_review($prompt);

            if ( $result ) {
                foreach ( $comments as $key => $comment ) {
                    $text = $result[ $key ]->text;
                    $data = [
                        'comment_ID' => $comment->comment_ID,
                        'comment_content' => $text,
                    ];
                    wp_update_comment( $data );
                    update_comment_meta( $comment->comment_ID, '_rewrite', true );
                }
            } 
        } 

        $time = microtime(true) - $start; 
        error_log(print_r(count($comments), true)); 
        error_log(print_r($time, true)); 
        error_log(print_r('============================', true));
        // start next iteration
        $this->set_shedule_insert_rewrite_course_reviews($page);
    }

    public function insert_school_reviews($page) {

        global $wpdb;
        // $start = microtime(true);
        $table = $wpdb->prefix . 'school_comments';
        $reviews_url = 'https://adminagregator.obrazoval.ru/api/reviews?perPage=' . $this->limit_reviews . '&page=' . $page . '&with[0]=content&with[1]=reviewable';
        $reviews = $this->get_data_by_url($reviews_url);
        
        update_option( 'parser_status_school_views', true );

        // https://adminagregator.obrazoval.ru/api/reviews?perPage=2000&page=1&filter[platform][0]=SkillFactory&filter[platform][1]=Коалиция&with[0]=content&with[1]=reviewable
        // error_log(print_r('COUNT = ' . count($reviews['data']), true));
        // error_log(print_r('PAGE = ' . $page, true));
        
        if ( ! count($reviews['data']) ) {
            error_log(print_r('CLEAR CRON', true));
            wp_clear_scheduled_hook( 'gepha_insert_school_reviews', [$page-1] );
            wp_clear_scheduled_hook( 'gepha_insert_school_reviews', [$page] );
            wp_clear_scheduled_hook( 'gepha_insert_school_reviews' );
            update_option( 'parser_status_school_views', false );

            return false;
        }
            
        foreach ($reviews['data'] as $review) {

            $term = term_exists( $review['reviewableTitle'], 'pa_onlajn-platforma' );

            if ( $term == 0 || $term == null ) {
                continue;
            }

            $review_id = $review['id'];
            $duplicate = $wpdb->get_row("SELECT comment_ID FROM $table WHERE comment_ID = $review_id", ARRAY_A);

            if ( $duplicate ) {
                continue;
            }

            $comment_author    = ! isset( $review['author'] ) ? '' : $review['author'];
            $comment_date      = ! isset( $review['date'] ) ? current_time( 'mysql' ) : $review['date'];
            $comment_date_gmt  = ! isset( $review['date'] ) ? get_gmt_from_date( $review['date'] ) : $review['date'];
            $comment_school_ID = ! isset( $term['term_id'] ) ? 0 : $term['term_id'];
            $comment_rating    = ! isset( $review['rate'] ) ? 0 : $review['rate'];
            $comment_approved  = 1;
            $user_id = 0;
            // $comment_content = $this->rerate_review($review['content']);
            $comment_content = $review['content'];
            $comment_content = ( empty($comment_content) || $comment_content == '.' ) ? $review['content'] : $comment_content;
            $compacted = [
                'comment_school_ID' => $comment_school_ID,
            ];
            $compacted += compact(
                'comment_author',
                'comment_date',
                'comment_date_gmt',
                'comment_content',
                'comment_rating',
                'comment_approved',
                'user_id'
            );

            if ( ! $wpdb->insert( $table, $compacted ) ) {
                continue;
            }
        }

        $page++;
        // $time = microtime(true) - $start; 

        // error_log(print_r($time, true)); 
        // error_log(print_r('============================', true));

        // start next iteration
        $this->set_shedule_insert_school_reviews($page);
        
    }

    public function insert_courses($page) {

        // $start = microtime(true);
        global $wpdb;

        require_once THEME_DIR . '/lib/phpQuery/phpQuery.php';
        $courses_url = 'https://adminagregator.obrazoval.ru/api/courses?with[0]=image&with[1]=owners&with[2]=compilations&perPage=' . $this->limit_courses . '&page=' . $page . '&sort=sort-asc';
        $courses = $this->get_data_by_url($courses_url);
        $tax_school_name = 'pa_onlajn-platforma';
        $tax_category_name = 'product_cat';

        // error_log(print_r('COUNT = ' . count($courses['data']), true));
        // error_log(print_r('PAGE = ' . $page, true));
        
        if ( ! count($courses['data']) ) {
            error_log(print_r('CLEAR CRON', true));
            wp_clear_scheduled_hook( 'gepha_update_woo_products', [$page-1] );
            wp_clear_scheduled_hook( 'gepha_update_woo_products', [$page] );
            wp_clear_scheduled_hook( 'gepha_update_woo_products' );
            update_option( 'parser_status_courses', false );

            return false;
        } 

        update_option( 'parser_status_courses', true );
            
        foreach ($courses['data'] as $course) {

            $courser_id = $course['id'];
            $duplicate = $wpdb->get_row("SELECT post_id FROM $wpdb->postmeta WHERE meta_key = '_course_id' AND meta_value = $courser_id", ARRAY_A);

            if ( $duplicate ) {
                continue;
            }

            $course_url = 'https://obrazoval.ru/courses/' . $course['slug'];
            $doc = phpQuery::newDocument(file_get_contents($course_url));

            $product = new WC_Product_Simple();
            $product->set_name( $course['title'] ); 
            $product->set_slug( $course['slug'] );
            $product->set_regular_price( $course['price'] ); 
            $product->set_short_description( $course['summary'] );
            $product->set_stock_status( 'instock' );
        
            // save category
            if ($course['section']) {
                $category = get_term_by( 'name', $course['section'], $tax_category_name );
                $cat_ids = ( $category->parent != 0 ) ? [ $category->term_id, $category->parent ] : [ $category->term_id ];
                $product->set_category_ids( $cat_ids );
            }

            // save media
            $img_id = $this->upload_file_by_url( $course['image'] );
            $product->set_image_id( $img_id );

            // save schools
            if ($course['owners']) {
                foreach ($course['owners'] as $owner) {
                    if ( term_exists( $owner['slug'], $tax_school_name ) ) { // Проверяем, существует ли такоe значение в указанном атрибуте
                        $term_id = get_term_by( 'slug', $owner['slug'], $tax_school_name )->term_id;
                        $this->set_attr_product( $product, $tax_school_name, $term_id );
                    }
                }
            }

            // save attributes
            $attr_name = null;
            $attrs = $doc->find('.l-features.b-bordered--no-hover')->children();
            foreach ($attrs as $attr) {
                $pq_attr = pq($attr);
                $label_attr = $pq_attr->find('.l-features__title');
                $value_attr = $pq_attr->find('.l-features__value');
                $label = trim($label_attr->text());
                $value = trim($value_attr->text());

                if ( $label == 'Сложность' ) {
                    $attr_name = 'pa_slozhnost'; 
                } elseif ( $label == 'Тип обучения' ) {
                    $attr_name = 'pa_tip-obucheniya'; 
                } elseif ( $label == 'Формат обучения' ) {
                    $attr_name = 'pa_format-obucheniya'; 
                } elseif ( $label == 'Трудоустройство' ) {
                    $attr_name = 'pa_trudoustrojstvo'; 
                } elseif ( $label == 'Сертификат' ) {
                    $attr_name = 'pa_sertifikat'; 
                } else {
                    continue;
                }

                $term = get_term_by( 'name', $value, $attr_name );
                if ( ! $term ) {
                    $term = wp_insert_term( $value, $attr_name, [] );
                    $term_id = $term['term_id'];
                } else {
                    $term_id = $term->term_id;
                }
                $this->set_attr_product( $product, $attr_name, $term_id );
            }

            $product->save();

            // save descriptions
            $desc_1 = $doc->find('.show-hide.b-title__large.q-mt-xs .show-hide__content')->html();
            $desc_2 = $doc->find('.b-title__course.q-mb-sm')->parent()->find('.show-hide__content.hidden-blur')->html();
            update_field( 'desc_whoisthecoursefor', $desc_1, $product->get_id() );
            update_field( 'desc_program', $desc_2, $product->get_id() );
            // // $certificate = $doc->find('.l-skills-doc .q-img')->html(); // ->attr('src');

            // save skills
            $skills = $doc->find('.l-skills__items')->children(); 
            if (! empty($skills)) {
                foreach ($skills as $skill) {
                    $pq_skill = pq($skill);
                    $label_skill = $pq_skill->find('.l-skills__item-name')->text();
                    if (! empty($label_skill)) {
                        add_row('skills', ['txt_skills' => $label_skill], $product->get_id());
                    }
                }
            }

            // save installment
            $installment = $doc->find('.l-course__installment')->text();
            if (! empty($installment)) {
                update_field( 'installment_plan_main', true, $product->get_id() );
            }

            // update_post_meta($product->get_id(), '_course_thumbnail_src', $course['image']);
            update_post_meta($product->get_id(), '_course_id', $course['id']);
            update_field( 'start_course', $course['startedAt'], $product->get_id() );
            update_field( 'link_course', $course['externalUrl'], $product->get_id() );
            update_field( 'show_organization', true, $product->get_id() );
            update_field( 'title_price', 'Стоимость курса', $product->get_id() );
            update_field( 'title_whoisthecoursefor', 'Кому подойдёт этот курс', $product->get_id() );
            update_field( 'title_organization', 'Образовательная организация', $product->get_id() );
            update_field( 'main_title_skills', 'Что вы получите после обучения', $product->get_id() );
            update_field( 'title_skills', 'Приобретаемые навыки', $product->get_id() );
            update_field( 'title_program', 'Программа курса', $product->get_id() );

            if ($course['duration']) {
                update_field( 'duration_course', $course['duration']. ',', $product->get_id() );
            } else {
                update_field( 'duration_course', '', $product->get_id() );
            }
        }

        $page++;
        // wp_redirect( home_url() . '/wp-admin/edit.php?post_type=product&page=parser_data&parser_page=' . $page . '&parser=1' );
        // exit();

        // теперь в переменной $time содержится float со значением выполнения скрипта в секундах. дело осталось за банальными number_format() и echo.
        // $time = microtime(true) - $start; 
        // error_log(print_r($time, true)); 
        // error_log(print_r('============================', true));

        // start next iteration
        $this->set_shedule_update_woo_products($page);
    }
    
    public function insert_course_reviews($page) {

        // $start = microtime(true);
        global $wpdb;

        $reviews_url = 'https://adminagregator.obrazoval.ru/api/reviews?perPage=' . $this->limit_reviews . '&page=' . $page . '&filter[only_course_reviews]=true&with[0]=content&with[1]=reviewable';
        $reviews = $this->get_data_by_url($reviews_url);
        update_option( 'parser_status_course_views', true );

        error_log(print_r('COUNT = ' . count($reviews['data']), true));
        error_log(print_r('PAGE = ' . $page, true));
        
        if ( ! count($reviews['data']) ) {
            error_log(print_r('CLEAR CRON', true));
            wp_clear_scheduled_hook( 'gepha_insert_product_reviews', [$page-1] );
            wp_clear_scheduled_hook( 'gepha_insert_product_reviews', [$page] );
            wp_clear_scheduled_hook( 'gepha_insert_product_reviews' );
            update_option( 'parser_status_course_views', false );

            return false;
        }
            
        foreach ($reviews['data'] as $review) {

            $review_id = $review['id'];
            // $duplicate = $wpdb->get_row("SELECT comment_id FROM $wpdb->commentmeta WHERE meta_key = '_review_id' AND meta_value = $review_id", ARRAY_A);
            $duplicate = get_comment_meta( $review_id, '_review_id', true );

            if ( $duplicate ) {
                continue;
            }

            $reviewableId = $review['reviewableId'];
            $course_data = $wpdb->get_row("SELECT post_id FROM $wpdb->postmeta WHERE meta_key = '_course_id' AND meta_value = $reviewableId", ARRAY_A);

            if ( ! $course_data ) {
                continue;
            }

            // $content = $this->rerate_review($review['content']);
            // $content = ( empty($content) || $content == '.' ) ? $review['content'] : $content;
            $content = $review['content'];
            $data = [
                'comment_post_ID' => $course_data['post_id'],
                'comment_author' => $review['author'],
                'comment_author_email' => '',
                'comment_content' => $content,
                'comment_date' => $review['date'],
                'comment_approved' => 1,
                'comment_type' => 'review',
            ];
            $comment_id = wp_insert_comment( wp_slash($data) );
            update_comment_meta( $comment_id, 'rating', intval($review['rate']) );
            update_comment_meta( $comment_id, '_review_id', $comment_id );
            update_comment_meta( $comment_id, 'vote', random_int(0, 30) );
            // error_log(print_r($review['author'], true));
        }

        $page++;
        // $time = microtime(true) - $start; 

        // error_log(print_r($time, true)); 
        // error_log(print_r('============================', true));

        // start next iteration
        $this->set_shedule_insert_product_reviews($page);
    }

    public function set_attr_product( $product, $taxonomy, $term_id ) {

        $attributes = (array)$product->get_attributes();

        if ( array_key_exists( $taxonomy, $attributes ) ) {  // Если наш атрибут имеется у этого товара
            foreach ( $attributes as $key => $attribute ) {
                // $key - таксономия атрибута (с приставкой pa_)
                // $attribute - объект WC_Product_Attribute
                if ( $key == $taxonomy ) { //Если это наш атрибут
                    $options = (array)$attribute->get_options();  // Получаем массив из ID значений этого атрибута
                    $options[] = $term_id;   // Добавляем туда ещё и наше значение
                    $attribute->set_options($options); //Применяем новый набор значений к этому атрибуту
                    $attributes[$key] = $attribute; // Теперь заменяем наш атрибут новым в массиве атрибутов
                    break;
                }
            }
            $product->set_attributes( $attributes ); //Применяем к товару подкорректированный массив атрибутов
        } else {
            // Если наш атрибут у этого товара отсутствует
            // создаем новы атрибут
            $attribute = new WC_Product_Attribute();
            $attribute->set_id( sizeof( $attributes) + 1 );
            $attribute->set_name( $taxonomy );
            $attribute->set_options( [ $term_id ] );
            $attribute->set_position( sizeof( $attributes) + 1 );
            $attribute->set_visible( true );
            $attribute->set_variation( false );
            $attributes[] = $attribute;  // Добавляем к массиву атрибутов - наш
            $product->set_attributes( $attributes ); //Применяем к товару подкорректированный массив атрибутов
        }
    }

    public function insert_scholls_attribute() {

        require_once THEME_DIR . '/lib/phpQuery/phpQuery.php';
        $schools_url = 'https://adminagregator.obrazoval.ru/api/owners?with[0]=image&with[1]=counters&with[2]=fields&with[3]=rating&perPage=500&sort=overallRate-desc';
        $schools = $this->get_data_by_url($schools_url);
        $tax_name = 'pa_onlajn-platforma';

        if (isset($schools['data'])) {
            foreach ($schools['data'] as $school) {

                $school_url = 'https://obrazoval.ru/owners/' . $school['slug'];
                $doc = phpQuery::newDocument(file_get_contents($school_url));

                $elem = $doc->find('.show-hide__content');
	            $full_desc = $elem->html();

                $term_ids = wp_insert_term( 
                    $school['name'], 
                    $tax_name, 
                    [
                        'description' => $full_desc,
                        'parent'      => 0,
                        'slug'        => $school['slug'],
                    ]
                );

                if ( is_wp_error( $term_ids ) ){
                    echo $term_ids->get_error_message();
                }

                $school_obj = get_term_by('id', $term_ids['term_id'], $tax_name);

                // $school['id']
                // $school['icon']
                // $school['image']
                // $school['externalUrl']
                update_term_meta( $term_ids['term_id'], 'school_id', $school_obj->term_id );
                update_field( 'link_school', $school['externalUrl'], $tax_name . '_' . $school_obj->term_id );
                // save media
                $img_id = $this->upload_file_by_url( $school['image'] );
                update_field( 'img_school', $img_id, $tax_name . '_' . $school_obj->term_id );

                // echo '<pre>';
                // print_r( $full_desc );
                // echo '</pre>';
            
            }
        }

    }

    public function upload_file_by_url( $image_url ) {

        // it allows us to use download_url() and wp_handle_sideload() functions
        require_once( ABSPATH . 'wp-admin/includes/file.php' );
    
        // download to temp dir
        $temp_file = download_url( $image_url );
    
        if( is_wp_error( $temp_file ) ) {
            return false;
        }
    
        // move the temp file into the uploads directory
        $file = array(
            'name'     => basename( $image_url ),
            'type'     => mime_content_type( $temp_file ),
            'tmp_name' => $temp_file,
            'size'     => filesize( $temp_file ),
        );
        $sideload = wp_handle_sideload(
            $file,
            array(
                'test_form'   => false // no needs to check 'action' parameter
            )
        );
    
        if( ! empty( $sideload[ 'error' ] ) ) {
            // you may return error message if you want
            return false;
        }
    
        // it is time to add our uploaded image into WordPress media library
        $attachment_id = wp_insert_attachment(
            array(
                'guid'           => $sideload[ 'url' ],
                'post_mime_type' => $sideload[ 'type' ],
                'post_title'     => basename( $sideload[ 'file' ] ),
                'post_content'   => '',
                'post_status'    => 'inherit',
            ),
            $sideload[ 'file' ]
        );
    
        if( is_wp_error( $attachment_id ) || ! $attachment_id ) {
            return false;
        }
    
        // update medatata, regenerate image sizes
        require_once( ABSPATH . 'wp-admin/includes/image.php' );
    
        wp_update_attachment_metadata(
            $attachment_id,
            wp_generate_attachment_metadata( $attachment_id, $sideload[ 'file' ] )
        );
    
        return $attachment_id;
    
    }

    public function get_data_by_url( $url ) {
		
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);

        return json_decode($result, true);
	}

    /**
    * Method to delete Woo Product
    * 
    * @param int $id the product ID.
    * @param bool $force true to permanently delete product, false to move to trash.
    * @return \WP_Error|boolean
    */
    public function delete_product($id, $force = FALSE) {

        $product = wc_get_product($id);
    
        if(empty($product))
            return new WP_Error(999, sprintf(__('No %s is associated with #%d', 'woocommerce'), 'product', $id));
    
        // If we're forcing, then delete permanently.
        if ($force)
        {
            if ($product->is_type('variable'))
            {
                foreach ($product->get_children() as $child_id)
                {
                    $child = wc_get_product($child_id);
                    $child->delete(true);
                }
            }
            elseif ($product->is_type('grouped'))
            {
                foreach ($product->get_children() as $child_id)
                {
                    $child = wc_get_product($child_id);
                    $child->set_parent_id(0);
                    $child->save();
                }
            }
    
            $product->delete(true);
            $result = $product->get_id() > 0 ? false : true;
        }
        else
        {
            $product->delete();
            $result = 'trash' === $product->get_status();
        }
    
        if (!$result)
        {
            return new WP_Error(999, sprintf(__('This %s cannot be deleted', 'woocommerce'), 'product'));
        }
    
        // Delete parent product transients.
        if ($parent_id = wp_get_post_parent_id($id))
        {
            wc_delete_product_transients($parent_id);
        }
        return true;
    }

    public function set_shedule_update_woo_products($page) {

        // date_default_timezone_set('Asia/Tbilisi');
        date_default_timezone_set('UTC');
        $interval = 'every_15_minutes';
        $time = time();
        // remove shadule event for create new shedule with another interval
        wp_clear_scheduled_hook( 'gepha_update_woo_products', [$page-1] );
        wp_clear_scheduled_hook( 'gepha_update_woo_products', [$page] );
        wp_schedule_event( $time, $interval, 'gepha_update_woo_products', [$page]);
    }
    
    public function set_shedule_insert_product_reviews($page) {

        // date_default_timezone_set('Asia/Tbilisi');
        date_default_timezone_set('UTC');
        $interval = 'every_15_minutes';
        $time = time();
        // remove shadule event for create new shedule with another interval
        wp_clear_scheduled_hook( 'gepha_insert_product_reviews', [$page-1] );
        wp_clear_scheduled_hook( 'gepha_insert_product_reviews', [$page] );
        wp_schedule_event( $time, $interval, 'gepha_insert_product_reviews', [$page]);
    }
    
    public function set_shedule_insert_school_reviews($page) {

        // date_default_timezone_set('Asia/Tbilisi');
        date_default_timezone_set('UTC');
        $interval = 'every_15_minutes';
        $time = time();
        // remove shadule event for create new shedule with another interval
        wp_clear_scheduled_hook( 'gepha_insert_school_reviews', [$page-1] );
        wp_clear_scheduled_hook( 'gepha_insert_school_reviews', [$page] );
        wp_schedule_event( $time, $interval, 'gepha_insert_school_reviews', [$page]);
    }
    
    public function set_shedule_insert_rewrite_school_reviews($page) {

        // date_default_timezone_set('Asia/Tbilisi');
        date_default_timezone_set('UTC');
        $interval = 'every_15_minutes';
        $time = time();
        // remove shadule event for create new shedule with another interval
        wp_clear_scheduled_hook( 'gepha_insert_rewrite_school_reviews', [$page-1] );
        wp_clear_scheduled_hook( 'gepha_insert_rewrite_school_reviews', [$page] );
        wp_schedule_event( $time, $interval, 'gepha_insert_rewrite_school_reviews', [$page]);
    }
    
    public function set_shedule_insert_rewrite_course_reviews($page) {

        // date_default_timezone_set('Asia/Tbilisi');
        date_default_timezone_set('UTC');
        $interval = 'every_15_minutes';
        $time = time();
        // remove shadule event for create new shedule with another interval
        wp_clear_scheduled_hook( 'gepha_insert_rewrite_course_reviews', [$page-1] );
        wp_clear_scheduled_hook( 'gepha_insert_rewrite_course_reviews', [$page] );
        wp_schedule_event( $time, $interval, 'gepha_insert_rewrite_course_reviews', [$page]);
    }

    public function add_cron_recurrence_interval( $schedules ) {

        $schedules['every_1_minute'] = [
            'interval'  => 60,
            'display'   => __( 'Every 1 Minute' )
        ];
 
        $schedules['every_15_minutes'] = [
            'interval'  => 900,
            'display'   => __( 'Every 15 Minutes' )
        ];

        $schedules['every_25_minutes'] = [
            'interval'  => 1500,
            'display'   => __( 'Every 25 Minutes' )
        ];
        
        $schedules['1_hour'] = [
            'interval'  => 3600,
            'display'   => __( '1 Hour' )
        ];

        $schedules['2_hours'] = [
            'interval'  => 7200,
            'display'   => __( '2 Hours' )
        ];

        $schedules['4_hours'] = [
            'interval'  => 14400,
            'display'   => __( '4 Hours' )
        ];

        $schedules['12_hours'] = [
            'interval'  => 43200,
            'display'   => __( '12 Hours' )
        ];

        $schedules['every_4_days'] = [
            'interval'  => 345600,
            'display'   => __( 'Every 4 Days' )
        ];

        $schedules['every_7_days'] = [
            'interval'  => 604800,
            'display'   => __( 'Every 7 Days' )
        ];
         
        return $schedules;
    }

    public function rerate_review($zapyt) {

        $headers = [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $this->chatgpt_key . ''
        ];
        $data = [
            'model' => 'text-davinci-003',
            'prompt' => $zapyt,
            'max_tokens' => 1024,
            'temperature' => 0.8
        ];
        $ch = curl_init("https://api.openai.com/v1/completions");
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        if (curl_error($ch)) {
            $generate_txt = '';
        } else {
            $response = json_decode(curl_exec($ch), true);
            error_log(print_r($response, true));
            $generate_txt = $response['choices'][0]['text']; // тут буде відповідь від ChatGPT
        }
        curl_close($ch);

        return $generate_txt;
    }
    
    public function rewrite_review($prompt) {

        $url = 'https://api.openai.com/v1/completions';
        $headers = array(
            'Content-Type: application/json',
            'Authorization: Bearer ' . $this->chatgpt_key,
        );

        // Set the prompts and parameters for the API request
        $data = array(
            'model' => 'text-davinci-003',
            'prompt' => $prompt,
            // [
            //     'rewrite this text in Russian no more than 250 characters without line breaks "Всем доброго дня. Хочу поделиться фидбеком о курсе java-разработчик. Хочу похвалить подачу материала, объясняют все крайне понятно и подробно для новичков, но и лишней воды нет. Лекции не затянутые, смотреть приятно, а главное быстро получаешь новые знания, которые потом оттачиваешь на практических заданиях. Их кстати довольно много, у меня они занимают большую часть обучения. К менторам часто хожу с вопросами, когда что-то не понятно. Отвечают всегда в течение дня, очень дружелюбные и всегда готовы помочь"',
            //     'rewrite this text in Russian no more than 250 characters without line breaks "Пришел на курс по питону по рекомендации знакомого, он в айтишке работает и меня зазывал, рассказывал много про питон. Я полазил, повыбирал курсы, посравнивал отзывы. Остановился на продуктстаре из-за цены и материалов, которые они предлагали. Плюс подкупила гарантия трудоустройства, много людей писали про нее в отзывах. Что скажу: курс своих денег стоит. Лекции смотрелись быстро, основную часть обучения занимала сама практика. Мой знакомый подсказал мне проект для портфолио, поэтому все дз я делал для этого проекта. Хорошая обратная связь от ментора, всегда отвечал в течение суток и давал развернутый фидбек по моим ошибкам. Курсом крайне доволен, готов рекомендовать к приобритению"',
            //     'rewrite this text in Russian no more than 250 characters without line breaks "Обучаюсь в МАЕД на курсе «Менеджер по маркетплейсам». Выбирала школу по высокому рейтингу, адекватной стоимости курса, удобной форме оплаты и рада, что не ошиблась. Получаю новые для меня знания и навыки в профессии благодаря обширной базе курса. Удобная форма подачи материала, можно обучаться в своем режиме. Много домашних заданий для закрепления знаний, ссылок на материалы для получения дополнительной информации. Каждую неделю проводятся вебинары. Спасибо МАЕД и кураторам курса!"',
            //     'rewrite this text in Russian no more than 500 characters without line breaks "Закончил обучаться на большом курсе по Java, вчера получил свой диплом. Хочу похвалить менторов, за то что терпиливо отвечали на все вопросы, ежедневно правили мои работы и поддерживали, когда чувствовал спад мотивации. По программе нареканий нет, все четко, подробно и понятно. Занимался на протяжении 10 месяцев по 2 часа после работы, где-то чуть больше, где-то меньше. Сейчас активно ищу работу с карьерным центром, девушка-консультант отзывчивая и со всем максимально помогает. Часто рекоммендую курсы своим знакомым, и всем остальным тоже советую, не прогадаете."',
            //     'rewrite this text in Russian no more than 250 characters without line breaks "Достоинства: Кураторы Подача Недостатки: Для меня не было В декабре 2022 закончил курс "дизайн логотипа и фирменного стиля". Круто, что доступ к курсу не пропадает после его прохождения, интересующие моменты всегда можно освежить. Приятная подача лекционного материала, понятные презентации с примерами. До этого имел опыт прохождения курсов на других платформах, хочется похвалить звук и приятную обратную связь. Благодаря курсу узнал новые фишки для себя. Курс хорошо подойдёт начинающим дизайнерам, даёт грамотное погружение в профессию. Топ за свои деньги"',
            // ],
            'max_tokens' => 1024,
            'temperature' => 1, // 0.8
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        // Handle the API response
        if ($response) {
            $json = json_decode($response);

            if ($json->choices) {
                return $json->choices;
                // foreach ($json->choices as $choice) {
                    // $text = $choice->text;
                    // $text = str_replace('<br>', '', $text);
                    // echo $text . "\n\n\n";
                // }
            } else {
                return false;
            }

        } else {
            return false;
        }
    }
    
} 