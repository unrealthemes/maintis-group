<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 */



/**
 * Get permalink by template name
 */

function ut_get_permalik_by_template( $template ) {

	$result = '';

	if ( ! empty( $template ) ) {
		$pages = get_pages( [
		    'meta_key'   => '_wp_page_template',
		    'meta_value' => $template
		] );
		$template_id = $pages[0]->ID;
		$page = get_post( $template_id );
		$result = get_permalink( $page );
	}
	
	return $result;
}



/**
 * Get permalink by template name
 */

function ut_get_page_id_by_template( $template ) {

	$result = '';

	if ( ! empty( $template ) ) {
		$pages = get_pages( [
		    'meta_key'   => '_wp_page_template',
		    'meta_value' => $template
		] );
		$result = $pages[0]->ID;
	}
	
	return $result;
}



/**
 * Get name menu by location
 */

function ut_get_title_menu_by_location( $location ) {

    if ( empty( $location ) ) {
    	return false;
	}
    $locations = get_nav_menu_locations();

    if ( ! isset( $locations[ $location ] ) ) {
    	return false;
	}
    $menu_obj = get_term( $locations[ $location ], 'nav_menu' );

    return $menu_obj->name;
}



/** 
 * Admin footer modification
 */   

function ut_remove_footer_admin() {

    echo '<span id="footer-thankyou">Тема разработана <a href="https://unrealthemes.site/" target="_blank"><img src="' . THEME_URI . '/img/unreal.png" width="130"/></a></span>';
}
add_filter('admin_footer_text', 'ut_remove_footer_admin');



/** 
 * Add options page ACF pro
 */ 

 if ( function_exists('acf_add_options_page') ) {
	acf_add_options_page([
		'page_title'    => __('Настройки темы'),
		'menu_title'    => __('Настройки темы'),
		'menu_slug'     => 'acf-options',
	]);
}



function ut_acf_json_save_point( $path ) {
	
    $path = get_stylesheet_directory() . '/acf-json';

    return $path;
}
add_filter('acf/settings/save_json', 'ut_acf_json_save_point');



/**
 * Custom excerpt
 */

// add_filter( 'excerpt_length', function() {
// 	return 23;
// } );

// add_filter('excerpt_more', function( $more ) {
// 	return '...';
// });



/**
 * Remove feature image and comment for post type "page"
 */

// function ut_cpt_support() {
//     remove_post_type_support( 'page', 'thumbnail' );
//     remove_post_type_support( 'page', 'comments' );
//     remove_post_type_support( 'page', 'comments' );
// }
// add_action( 'admin_init', 'ut_cpt_support' );



function ut_class_names( $classes ) {

	if ( is_front_page() ) {
		$classes[] = 'home';
	} /*elseif ( is_singular('post') || is_page_template('template-blog.php') ) {
		$classes[] = 'blog';
	} elseif ( is_singular('product') ) {
		$classes[] = 'curs_page';
	}*/

	return $classes;
}
add_filter( 'body_class','ut_class_names' );



/**
 * Declension of a word after a number
 *
 *     // Call examples:
 *     ut_num_decline( $num, 'книга,книги,книг' )
 *     ut_num_decline( $num, 'book,books' )
 *     ut_num_decline( $num, [ 'книга', 'книги', 'книг' ] )
 *     ut_num_decline( $num, [ 'book', 'books' ] )
 *
 * @param int|string   $number       The number followed by the word. You can specify a number in HTML tags.
 * @param string|array $titles       Declension options or first word for a multiple of 1.
 * @param bool         $show_number  Specify 00 here when you do not need to display the number itself.
 *
 * @return string For example: 1 книга, 2 книги, 10 книг.
 *
 * @version 3.1
 */
function ut_num_decline( $number, $titles, $show_number = true ) {

	if( is_string( $titles ) ){
		$titles = preg_split( '/, */', $titles );
	}

	// когда указано 2 элемента
	if( empty( $titles[2] ) ){
		$titles[2] = $titles[1];
	}

	$cases = [ 2, 0, 1, 1, 1, 2 ];

	$intnum = abs( (int) strip_tags( $number ) );

	$title_index = ( $intnum % 100 > 4 && $intnum % 100 < 20 )
		? 2
		: $cases[ min( $intnum % 10, 5 ) ];

	return ( $show_number ? "$number " : '' ) . $titles[ $title_index ];
}



function ut_breadcrumbs_args( $args ) {

	$my_args = [
		'markup' => [
			'wrappatt'  => '<ul>%s</ul>',
			'linkpatt'  => '<li><a href="%s">%s</a></li>',
			'titlepatt' => '<li>%s</li>',
			'seppatt'   => '',
		],
		'priority_tax' => [ 'department' ],
	];

	return $my_args + $args;
}
add_filter( 'kama_breadcrumbs_args', 'ut_breadcrumbs_args' );




function ut_breadcrumbs_change_elements( $elms, $class, $ptype ) {

	$elms['home_after'] = [];
	
	return $elms;
}
add_filter( 'kama_breadcrumbs_filter_elements', 'ut_breadcrumbs_change_elements', 10, 3 );