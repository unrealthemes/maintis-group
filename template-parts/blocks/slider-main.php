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
$className = 'home_block top_list_block';
if ( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

if ( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$title = get_field('title_ms');
$blocks = get_field('blocks_ms');
?>

<?php if ( !empty( $_POST['query']['preview'] ) ) : ?>

    <figure>
        <img src="<?php echo THEME_URI; ?>/img/gutenberg-preview/slider-main.png" alt="Preview" style="width:100%;">
    </figure>

<?php else : ?>

    <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">  
        <div class="row_di">  
            <div class="top_list carousel_v2">

                <?php if ( $title ) : ?>
                    <div class="block_title">
                        <h1><?php echo $title; ?></h1>
                    </div>
                <?php endif; ?>

                <?php if ( $blocks ) : ?>
                    <div class="row"> 
                        <div class="owl_top_list  owl-carousel owl-theme gallery">
                            
                            <?php 
                            foreach ( $blocks as $block ) :
                                $img_id = $block['img_blocks_ms'];

                            ?>

                                <div class="item">  
                                    <a href="<?php echo esc_url($block['url_blocks_ms']); ?>">
                                        <div class="item_vn"> 

                                            <?php 
                                            if ($img_id) :
                                                $img_url = wp_get_attachment_url( $img_id, 'full' );
                                            ?>
                                                <img src="<?php echo esc_attr($img_url); ?>" alt="Image" > 
                                            <?php endif; ?>

                                            <div class="item_desc">

                                                <?php if ( $block['name_blocks_ms'] ) : ?>
                                                    <div class="item_title">
                                                        <?php echo esc_html($block['name_blocks_ms']); ?>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if ( $block['txt_blocks_ms'] ) : ?>
                                                    <div class="item_title_desc">
                                                        <?php echo esc_html($block['txt_blocks_ms']); ?>
                                                    </div> 
                                                <?php endif; ?> 

                                            </div> 
                                        </div> 
                                    </a> 
                                </div>
                            <?php endforeach; ?> 
                            
                        </div>
                        <div class="owl_navigation owl_top_list_navigation"></div>
                    </div> 
                <?php endif; ?>

            </div> 
        </div>
    </div> 

<?php endif; ?>


