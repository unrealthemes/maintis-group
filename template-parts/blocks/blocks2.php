<?php

/**
 * blocks Block Template.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'blocks2-' . $block['id'];

if ( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'top_baner_for';

if ( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

if ( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$title = get_field('title_blocks2');
$blocks = get_field('blocks2');
?>

<?php if ( !empty( $_POST['query']['preview'] ) ) : ?>

    <figure>
        <img src="<?php echo THEME_URI; ?>/img/gutenberg-preview/blocks2.png" alt="Preview" style="width:100%;">
    </figure>

<?php else : ?>

    <?php if ( $blocks ) : ?>
        
        <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">  
                   
            <?php if ($title) : ?>
                <h3><?php echo esc_html($title); ?></h3>
            <?php endif; ?> 

            <div class="top_baner_two">

                <?php 
                foreach ($blocks as $block) : 
                    $img_url = wp_get_attachment_url( $block['img_id_block2'], 'full' );
                ?>

                    <a href="<?php echo esc_url($block['url_block2']); ?>" class="top_baner_two_item"> 

                        <?php if ($img_url) : ?>
                            <img src="<?php echo esc_attr($img_url); ?>" alt="<?php echo $block['title_block2']; ?>"> 
                        <?php endif; ?>

                        <div class="top_baner_two_item_vn">
                            <strong><?php echo nl2br($block['title_block2']); ?></strong>
                            <?php echo nl2br($block['txt_block2']); ?>
                        </div>
                    </a>

                <?php endforeach; ?>   

            </div>
        </div>

    <?php endif; ?>

    

<?php endif; ?>


