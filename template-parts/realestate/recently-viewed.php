<?php 
$cooki = 'astx_recent_posts';
$viewed_realestate = isset( $_COOKIE[ $cooki ] ) ? json_decode( $_COOKIE[ $cooki ], true ) : null;

if ( empty( $viewed_realestate ) ) {
    return;
}

$args = [
	'post_type' => 'realestate',
	'post_status' => 'publish',
	'posts_per_page' => 10,
];
$args['post__in'] = $viewed_realestate;
$args['orderby'] = 'rand';

$loop = new WP_Query( $args );

if ( $loop->have_posts() ) : 
?>

    <div class=" home_block top_list_block">
        <div class="row_di">  
            <div class="top_list carousel_v2">
                <div class="block_title">
                    <h3>Недавно просмотренные</h3>
                </div> 
                <div class="list_view_2 owl-carousel"> 

                    <?php 
                    while ( $loop->have_posts() ) : 
                        $loop->the_post(); 
                        get_template_part('template-parts/realestate/realestate', 'item');
                    endwhile; 
                    ?>
                        
                </div>
                <div class="owl_navigation owl_nav_2"></div>  
            </div> 
        </div>     
    </div>    

<?php 
endif; 
wp_reset_postdata(); 
?>