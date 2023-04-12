<?php
/**
 * Template name: Home
 */

get_header(); 

if (have_posts()) : 

    while (have_posts()) : the_post(); 

        //get_template_part('template-parts/home/slider'); 

    endwhile; 

endif; 

get_footer();