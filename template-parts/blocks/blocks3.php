<?php

/**
 * blocks Block Template.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'blocks3-' . $block['id'];

if ( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'jobs';

if ( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

if ( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$title = get_field('title_blocks3');
$blocks = get_field('blocks3');
$text_link = get_field('txt_link_blocks3');
$link = get_field('link_blocks3');
?>

<?php if ( !empty( $_POST['query']['preview'] ) ) : ?>

    <figure>
        <img src="<?php echo THEME_URI; ?>/img/gutenberg-preview/blocks3.png" alt="Preview" style="width:100%;">
    </figure>

<?php else : ?>

    <?php if ( $blocks ) : ?>

        <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">

            <?php if ($title) : ?>
                <h3><?php echo esc_html($title); ?></h3>
            <?php endif; ?> 

            <div class="jobs_row">

                <?php foreach ($blocks as $key => $block) : ?>

                    <div class="jobs_item block_white">
                        <div class="jobs_nomber"><?php echo $key + 1; ?></div>
                        <div class="jobs_title"><?php echo nl2br($block['name_block3']); ?></div>
                        <div class="jobs_desc"><?php echo nl2br($block['txt_block3']); ?></div>
                    </div>

                <?php endforeach; ?>
                
            </div>

            <?php if ( $text_link && $link ) : ?>
                <a href="<?php echo esc_url($link); ?>" class="btn_blue">
                    <?php echo esc_html($text_link); ?>
                </a>
            <?php endif; ?>

        </div>   
        
    <?php endif; ?>

<?php endif; ?>


