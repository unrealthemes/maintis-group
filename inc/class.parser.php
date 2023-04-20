<?php

ini_set('max_execution_time', '6000'); //10 часов
set_time_limit(0);

class UT_Parser {

    private static $_instance = null; 

    private $limit_post = 1;
    private $chatgpt_key = 'YOUR_API_KEY';

    static public function get_instance() {

        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __construct() {

        add_action( 'admin_menu', [$this, 'settings_page'] );

        add_action( 'insert_realestate', [$this, 'insert_realestate_handler'], 10, 1 );

        // Automatically Delete Woocommerce Images After Deleting a Product
        // add_action( 'before_delete_post', [$this, 'delete_post_images'], 10, 1 );

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

    public function delete_post_images( $post_id ) {

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

        if ( $status && $page == 1 && $type == 'realestate' ) {
            $this->set_shedule_insert_realestate( 1 );
            // $this->insert_realestate_handler(1);
        } 

    }

    public function insert_realestate_handler($page) {

        $start = microtime(true);
        global $wpdb;

        require_once THEME_DIR . '/lib/phpQuery/phpQuery.php';
        $posts_url = 'https://www.kalinka-realty.ru/back/api/v1/catalog/filter?sort=date_desc&count=' . $this->limit_post . '&page=' . $page;
        $posts = $this->get_data_by_url($posts_url);

        error_log(print_r('COUNT = ' . count($posts['list']), true));
        error_log(print_r('PAGE = ' . $page, true));
        
        // if ( ! count($posts['list']) ) {
        if ( $page > 2000 ) {
            error_log(print_r('CLEAR CRON', true));
            wp_clear_scheduled_hook( 'insert_realestate', [$page-1] );
            wp_clear_scheduled_hook( 'insert_realestate', [$page] );
            wp_clear_scheduled_hook( 'insert_realestate' );
            update_option( 'parser_status_posts', false );

            return false;
        } 

        update_option( 'parser_status_posts', true );
            
        foreach ($posts['list'] as $realestate) {

            $realestate_id = $realestate['id'];
            $duplicate = $wpdb->get_row("SELECT post_id FROM $wpdb->postmeta WHERE meta_key = '_realestate_id' AND meta_value = $realestate_id", ARRAY_A);

            if ( $duplicate ) {
                continue;
            }

            $post_data = array(
                'post_title'    => sanitize_text_field( $realestate['title'] ),
                // 'post_content'  => '',
                'post_type'     => 'realestate',
                'post_status'   => 'publish',
                'post_author'   => 1,
            );
            $post_id = wp_insert_post( $post_data );
            update_post_meta( $post_id, '_realestate_id', $realestate_id );
            $thumb_id_il = null;
            $thumb_id_s = null;
            $thumb_id_rc = null;

            if ( is_wp_error($post_id) ) {
                continue;
            }

            $realestate_url = 'https://www.kalinka-realty.ru' . $realestate['url'];
            $doc = phpQuery::newDocument(file_get_contents($realestate_url));

            foreach ($realestate as $field => $value) {

                if ( $field == 'badges' ) { // array

                    if ( ! empty($value) ) { 
                        wp_set_object_terms( $post_id, $value, 'badges' );
                    }
                    
                } else if ( $field == 'typeMarket' ) { // title, slug

                    update_field( $field, $value['title'], $post_id );

                } else if ( $field == 'type' ) { // title, slug

                    update_field( $field, $value['title'], $post_id );

                } else if ( $field == 'finishing' ) { // title, slug

                    if ( ! empty($value) ) { 
                        wp_set_object_terms( $post_id, $value['title'], 'finishing' );
                    }

                } else if ( $field == 'department' ) { // title, slug, code

                    if ( ! empty($value) ) { 
                        wp_set_object_terms( $post_id, $value['title'], 'department' );
                    }

                } else if ( $field == 'country' ) { // title, latitude, longitude

                    if ( ! empty($value) ) { 
                        wp_set_object_terms( $post_id, $value['title'], 'country' );
                    }

                } else if ( $field == 'tags' ) { // array ?

                    if ( ! empty($value) ) { 
                        wp_set_object_terms( $post_id, $value, 'tags' );
                    }

                } else if ( $field == 'city' ) { // title

                    if ( ! empty($value) ) { 
                        wp_set_object_terms( $post_id, $value['title'], 'city' );
                    }

                } else if ( $field == 'highway' ) { // title

                    if ( ! empty($value) ) { 
                        wp_set_object_terms( $post_id, $value['title'], 'highway' );
                    }

                } else if ( $field == 'residentialComplex' ) { // url, title, imageLinks -> type, pathDetail

                    if ( ! empty($value['imageLinks']) ) {
                        $imgs = [];
                        foreach ( (array)$value['imageLinks'] as $img ) {
                            $imgs[] = $this->upload_file_by_url($img['pathDetail']);
                        }
                        update_field( 'slider_arh_re', $imgs, $post_id );
                        $thumb_id_rc = end($imgs);
                    }
                    $desc_arch = $doc->find('.page-object-rc .base-text-more__text.base-text-more__text--part div')->html();
                    update_field( 'title_arh_re', $value['title'], $post_id );
                    update_field( 'desc_arh_re', $desc_arch, $post_id ); // TO DO

                } else if ( $field == 'settlement' ) { // imageLinks -> type, pathDetail

                    if ( ! empty($value['imageLinks']) ) {
                        $imgs = [];
                        foreach ( (array)$value['imageLinks'] as $img ) {
                            $imgs[] = $this->upload_file_by_url($img['pathDetail']);
                        }
                        update_field( 'slider_infr_re', $imgs, $post_id );
                        $thumb_id_s = end($imgs);
                    }

                } else if ( $field == 'imageLinks' ) { // type i and p, pathDetail

                    $imgs_i = [];
                    $imgs_p = [];
                    $desc_m = $doc->find('.hidden-sm .base-text-more__text.base-text-more__text--part div')->html();
                    foreach ( (array)$value as $img ) {
                        if ( $img['type'] == 'i' ) {
                            $imgs_i[] = $this->upload_file_by_url($img['pathDetail']);
                        } else {
                            $imgs_p[] = $this->upload_file_by_url($img['pathDetail']);
                        }
                    }
                    update_field( 'slider_re', $imgs_i, $post_id );
                    update_field( 'plan_slider_re', $imgs_p, $post_id );
                    update_field( 'desc_slider_re', $desc_m, $post_id );
                    $thumb_id_il = end($imgs_i);

                } else {
                    update_field( $field, $value, $post_id );
                }
            }

            // save thumbnail
            if ( $thumb_id_il ) {
                set_post_thumbnail( $post_id, $thumb_id_il );
            } else if ( $thumb_id_rc ) {
                set_post_thumbnail( $post_id, $thumb_id_rc );
            } else if ( $thumb_id_s ) {
                set_post_thumbnail( $post_id, $thumb_id_s );
            }

            // save map data
            if ( $realestate['address'] && $realestate['latitude'] && $realestate['longitude'] ) {
                // {"center_lat":49.98627977791932,"center_lng":36.24499566360995,"zoom":10,"type":"hybrid","marks":[{"id":1,"content":"Это Харьков","type":"Point","coords":[49.978213096378816,36.26169120153875],"circle_size":0}]}
                $map_array = [
                    "center_lat" => $realestate['latitude'],
                    "center_lng" => $realestate['longitude'],
                    "zoom" => 14,
                    "type" => "map", // "hybrid",
                    "marks" => [
                        [
                            "id" => 1,
                            // "content" => $realestate['address'],
                            "type" => "Point",
                            "coords" => [
                                $realestate['latitude'],
                                $realestate['longitude']
                            ],
                            "circle_size" => 0
                        ]
                    ]
                ];
                update_field( 'map_slider_re', json_encode($map_array), $post_id );
            }
            update_field( 'characteristics_re', true, $post_id );

        }

        $page++;
        $time = microtime(true) - $start; 
        error_log(print_r($time, true)); 
        error_log(print_r('============================', true));
        
        // start next iteration
        $this->set_shedule_insert_realestate($page);
    }

    public function set_shedule_insert_realestate($page) {

        // date_default_timezone_set('Asia/Tbilisi');
        date_default_timezone_set('UTC');
        $interval = 'every_15_minutes';
        $time = time();
        // remove shadule event for create new shedule with another interval
        wp_clear_scheduled_hook( 'insert_realestate', [$page-1] );
        wp_clear_scheduled_hook( 'insert_realestate', [$page] );
        wp_schedule_event( $time, $interval, 'insert_realestate', [$page]);
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