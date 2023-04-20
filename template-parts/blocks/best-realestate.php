<?php

/**
 * best_re Block Template.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'best_re-' . $block['id'];

if ( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'object_container di home_block';
if ( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

if ( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$title = get_field('title_bre');
$count = get_field('count_bre');
?>

<?php if ( !empty( $_POST['query']['preview'] ) ) : ?>

    <figure>
        <img src="<?php echo THEME_URI; ?>/img/gutenberg-preview/best-re.png" alt="Preview" style="width:100%;">
    </figure>

<?php else : ?>

    <?php 
    $args = [
        'post_type' => 'realestate',
        'post_status' => 'publish',
        'posts_per_page' => $count,
        'orderby' => 'meta_value_num',
        'order' => 'DESC',
        'meta_key' => 'post_views',
    ];
    $loop = new WP_Query( $args );

    if ( $loop->have_posts() ) : 
    ?>  

        <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">  
            <div class="row_di"> 
                <div class="object"> 
                    
                    <?php if ($title) : ?>
                        <div class="block_title"> 
                            <h3><?php echo $title; ?></h3>
                        </div> 
                    <?php endif; ?>
                    
                    <div class="row_di">
                        <div class="row_10_di object_list">

                            <?php 
                            while ( $loop->have_posts() ) : 
                                $loop->the_post(); 
                                get_template_part('template-parts/realestate/realestate', 'item');
                            endwhile; 
                            ?> 

                        </div>
                        <div class="learn_more">
                            <a class="learn_morebtn btn" href="#">Показать еще</a>
                        </div>  
                    </div>
                </div> 
            </div>
        </div> 

    <?php 
    endif; 
    wp_reset_postdata(); 
    ?>

<?php endif; ?>


