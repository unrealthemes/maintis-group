<?php

/**
 * requisites Block Template.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'requisites-' . $block['id'];

if ( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'requisites';
if ( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

if ( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$title = get_field('title_requisites');
$subtitle = get_field('subtitle_requisites');
$txt_l = get_field('txt_l_requisites');
$txt_r = get_field('txt_r_requisites');
$txt_btn = get_field('txt_btn_requisites');
$file = get_field('file_requisites');
?>

<?php if ( !empty( $_POST['query']['preview'] ) ) : ?>

    <figure>
        <img src="<?php echo THEME_URI; ?>'/img/gutenberg-preview/requisites.png'" alt="Preview" style="width:100%;">
    </figure>

<?php else : ?>

    <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">

        <?php if ( $title ) : ?>
            <h3><?php echo $title; ?></h3>
        <?php endif; ?>

        <div class="requisites_content block_white">

            <?php if ( $subtitle ) : ?>
                <h4><?php echo $subtitle; ?></h4>
            <?php endif; ?>

            <div class="requisites_block">


                <?php if ( $txt_l ) : ?>
                    <?php echo $txt_l; ?>
                <?php endif; ?>

                <?php if ( $txt_r ) : ?>
                    <?php echo $txt_r; ?>
                <?php endif; ?>

                <?php if ( $txt_btn && $file ) : ?>
                    <a class="btn" href="<?php echo esc_url($file['url']); ?>" download>
                        <?php echo $txt_btn; ?>
                    </a> 
                <?php endif; ?>

            </div>
            
            
        </div>
    </div>

<?php endif; ?>