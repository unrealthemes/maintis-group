<?php

/**
 * about Block Template.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'about-' . $block['id'];

if ( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'top_image';
if ( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

if ( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$title = get_field('title_about');
$desc = get_field('desc_about');
$form = get_field('form_about');
$name = get_field('name_about');
$position = get_field('position_about');
$avatar_id = get_field('avatar_about');
?>

<?php if ( !empty( $_POST['query']['preview'] ) ) : ?>

    <figure>
        <img src="<?php echo THEME_URI; ?>'/img/gutenberg-preview/about.png'" alt="Preview" style="width:100%;">
    </figure>

<?php else : ?>

    <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">  
        <div class="top_image_vn">
            <div class="top_image_bd"> 

                <?php echo $title; ?>

                <?php if ( $desc ) : ?>
                    <div class="top_image_text">
                        <?php echo $desc; ?>
                    </div>
                <?php endif; ?>
                
                <?php if ( $form ) : ?>
                    <a data-fancybox data-src="#write_us" href="javascript:;" class="btn_blue">
                        Связаться с нами
                    </a>
                <?php endif; ?>
                
                <div class="man_name">

                    <?php if ( $position || $name ) : ?>
                        <div class="top_image_img_text">
                            <strong><?php echo $name; ?></strong>
                            <?php echo $position; ?>
                        </div>
                    <?php endif; ?>

                    <?php 
                    if ( $avatar_id ) : 
                        $avatar_url = wp_get_attachment_url( $avatar_id, 'full' );
                    ?>
                        <div class="top_image_img">
                            <img src="<?php echo esc_attr($avatar_url) ?>" alt="<?php echo esc_attr($name); ?>">
                        </div>
                    <?php endif; ?>

                </div>

            </div>
        </div>
    </div>
    

<?php endif; ?>


