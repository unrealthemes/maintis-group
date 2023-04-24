<?php

/**
 * info Block Template.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'info-' . $block['id'];

if ( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'garant block_white';
if ( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

if ( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$blocks = get_field('blocks_info');
$txt_l = get_field('txt_l_info');
$txt_r = get_field('txt_r_info');
$txt_link = get_field('txt_link_info');
$link = get_field('link_info');
?>

<?php if ( !empty( $_POST['query']['preview'] ) ) : ?>

    <figure>
        <img src="<?php echo THEME_URI; ?>/img/gutenberg-preview/info.png" alt="Preview" style="width:100%;">
    </figure>

<?php else : ?>

    <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">  
        <div class="garant_col">

            <?php if ($blocks) : ?>
                <div class="garant_brand">
                    <?php 
                    foreach ($blocks as $block) : 
                        $img_url = wp_get_attachment_url( $block['img_id_blocks_info'], 'full' );
                    ?>
                        <a href="<?php echo esc_url($block['link_blocks_info']); ?>">
                            <img src="<?php echo esc_attr($img_url); ?>" alt="Image">
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <div class="garant_text">

                <?php echo $txt_l; ?>

                <?php if ( $txt_link && $link ) : ?>
                    <a href="<?php echo esc_url($link); ?>" class="btn">
                        <?php echo esc_html($txt_link); ?>
                    </a>
                <?php endif; ?>

            </div>
            
        </div>
        <div class="garant_col">
            <?php echo $txt_r; ?>
        </div> 
    </div>

<?php endif; ?>