<?php 
$args = [
	'post_type' => 'realestate',
	'post_status' => 'publish',
	'posts_per_page' => 10,
    'orderby' => 'meta_value_num',
    'order' => 'DESC',
    'meta_key' => 'post_views',
];
$loop = new WP_Query( $args );

if ( $loop->have_posts() ) : 
?>

    <div class=" home_block top_list_block">
        <div class="row_di">  
            <div class="top_list carousel_v2">
                <div class="block_title"> 
                    <h3>Лучшие предложения</h3>
                </div> 
                <div class="list_view owl-carousel"> 

                    <?php 
                    while ( $loop->have_posts() ) : 
                        $loop->the_post(); 
                        get_template_part('template-parts/realestate/realestate', 'item');
                    endwhile; 
                    ?>
                        
                </div>
                <div class="owl_navigation owl_nav_1"></div>  
            </div> 
        </div>
    </div> 

<?php 
endif; 
wp_reset_postdata(); 
?>