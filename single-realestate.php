<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package unreal-themes
 */

get_header();

    while ( have_posts() ) :
        the_post();

        $number_lot = get_field('lotid');
        $desc_slider = get_field('desc_slider_re');
        ?>

        <div class="container"> 
            <div class="breadcrumb"> 
                <?php do_action( 'echo_kama_breadcrumbs' ) ?>
            </div>
            <div class="content_pages">

                <div class="back_btn_wrap">
                	<a class="back_btn" onclick="window.history.back(); return false;" >
                        <svg width="5" height="9" viewBox="0 0 5 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 1L2.11564 3.19842C1.58327 3.81952 1.31708 4.13008 1.31708 4.5C1.31708 4.86992 1.58327 5.18048 2.11564 5.80158L4 8" stroke="#00AEF0" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                        Назад
                    </a>
                </div>

                <div class="row">
                    <div class="content_left">
                        
                        <?php if ( $number_lot ) : ?>
                            <div class="form_number hiden_ps">
                                № лота <?php echo $number_lot; ?>
                            </div>  
                        <?php endif; ?>

                        <?php the_title('<h1>', '</h1>'); ?>
                        
                        <?php get_template_part('template-parts/realestate/share'); ?>

                        <?php 
                        get_template_part(
                            'template-parts/realestate/slider', 
                            'main',
                            [
                                'salePriceRub' => ( ! empty(get_field('salePriceRub')) ) ? get_field('salePriceRub') : get_field('rentPriceRub'),
                                'salePriceUsd' => ( ! empty(get_field('salePriceUsd')) ) ? get_field('salePriceUsd') : get_field('rentPriceUsd'),
                                'salePriceEur' => ( ! empty(get_field('salePriceEur')) ) ? get_field('salePriceEur') : get_field('rentPriceEur'),
                                'salePriceSquareRub' => get_field('salePriceSquareRub'),
                                'salePriceSquareUsd' => get_field('salePriceSquareUsd'),
                                'salePriceSquareEur' => get_field('salePriceSquareEur'),
                            ]
                        ); 
                        ?>
                        
                        <?php 
                        get_template_part(
                            'template-parts/realestate/sidebar', 
                            'mobile',
                            [
                                'salePriceRub' => ( ! empty(get_field('salePriceRub')) ) ? get_field('salePriceRub') : get_field('rentPriceRub'),
                                'salePriceUsd' => ( ! empty(get_field('salePriceUsd')) ) ? get_field('salePriceUsd') : get_field('rentPriceUsd'),
                                'salePriceEur' => ( ! empty(get_field('salePriceEur')) ) ? get_field('salePriceEur') : get_field('rentPriceEur'),
                                'salePriceSquareRub' => get_field('salePriceSquareRub'),
                                'salePriceSquareUsd' => get_field('salePriceSquareUsd'),
                                'salePriceSquareEur' => get_field('salePriceSquareEur'),
                            ]
                        ); 
                        ?>
                        
                        <?php if ($desc_slider) : ?>
                            <div class="more_text_litle">
                                <?php echo $desc_slider; ?>
                            </div> 

                            <?php if ( strlen($desc_slider) > 1595 ) : ?>
                                <div class="learn_more_text_litle">
                                    <a class="learn_morebtn_text_litle btn" href="#">Показать еще</a>
                                </div> 
                            <?php endif; ?>

                        <?php endif; ?>
                        
                        <?php get_template_part('template-parts/realestate/about'); ?>

                        <?php get_template_part('template-parts/realestate/architecture'); ?>

                        <?php // get_template_part('template-parts/realestate/infrastructure'); ?>

                    </div>
                    
                    <?php 
                    get_template_part(
                        'template-parts/realestate/sidebar', 
                        'desctop',
                        [
                            'salePriceRub' => ( ! empty(get_field('salePriceRub')) ) ? get_field('salePriceRub') : get_field('rentPriceRub'),
                            'salePriceUsd' => ( ! empty(get_field('salePriceUsd')) ) ? get_field('salePriceUsd') : get_field('rentPriceUsd'),
                            'salePriceEur' => ( ! empty(get_field('salePriceEur')) ) ? get_field('salePriceEur') : get_field('rentPriceEur'),
                            'salePriceSquareRub' => get_field('salePriceSquareRub'),
                            'salePriceSquareUsd' => get_field('salePriceSquareUsd'),
                            'salePriceSquareEur' => get_field('salePriceSquareEur'),
                        ]
                    ); 
                    ?>

                </div>
                
                <?php get_template_part('template-parts/realestate/best-deals'); ?>

                <?php get_template_part('template-parts/realestate/recently-viewed'); ?>

            </div>
        </div>

        <?php 
    endwhile; 

    get_template_part('template-parts/modals/share'); 

get_footer();