<?php

/**
 * banner Block Template.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'banner-' . $block['id'];

if ( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'top_baner';

if ( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

if ( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$bg_id = get_field('bg_id_banner');
$bg_url = wp_get_attachment_url( $bg_id, 'full' );
$text = get_field('text_banner');
$text_link = get_field('text_link_banner');
$link = get_field('link_banner');
?>

<?php if ( !empty( $_POST['query']['preview'] ) ) : ?>

    <figure>
        <img src="<?php echo THEME_URI; ?>/img/gutenberg-preview/banner.png" alt="Preview" style="width:100%;">
    </figure>

<?php else : ?>
        
    <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>" style="background: url('<?php echo $bg_url; ?>') no-repeat center center;background-size: cover;">  
        <div class="top_baner_vn">

            <?php echo $text; ?>

            <?php if ( $text_link && $link ) : ?>
                <a href="<?php echo esc_url($link); ?>" class="btn_blue">
                    <?php echo esc_html($text_link); ?>
                </a>
            <?php endif; ?>

        </div>
    </div>
    

<?php endif; ?>