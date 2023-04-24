<?php

/**
 * blocks4 Block Template.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'blocks4-' . $block['id'];

if ( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'jobs jobs_two';
if ( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

if ( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$blocks = get_field('blocks4');
?>

<?php if ( !empty( $_POST['query']['preview'] ) ) : ?>

    <figure>
        <img src="<?php echo THEME_URI; ?>'/img/gutenberg-preview/blocks4.png'" alt="Preview" style="width:100%;">
    </figure>

<?php else : ?>

    <?php if ( $blocks ) : ?>
        
        <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">  
            <div class="jobs_row"> 

                <?php 
                foreach ($blocks as $block) : 
                    $img_url = wp_get_attachment_url( $block['img_id_block4'], 'full' );
                ?>

                    <div class="jobs_item block_white">
                        <div class="jobs_nomber">

                            <?php if ($img_url) : ?>
                                <img src="<?php echo esc_attr($img_url); ?>" alt="<?php echo $block['name_block4']; ?>"> 
                            <?php endif; ?>

                        </div>

                        <?php if ( $block['name_block4'] ) : ?>
                            <div class="jobs_title">
                                <?php echo nl2br($block['name_block4']); ?>
                            </div>
                        <?php endif; ?>

                        <?php if ( $block['txt_block4'] ) : ?>
                            <div class="jobs_desc">
                                <?php echo nl2br($block['txt_block4']); ?>
                            </div>
                        <?php endif; ?>

                    </div>
  
                <?php endforeach; ?>
                                        
            </div>
        </div>

    <?php endif; ?>

<?php endif; ?>