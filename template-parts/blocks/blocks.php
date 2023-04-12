<?php

/**
 * blocks Block Template.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'blocks-' . $block['id'];

if ( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'di_top_list';
if ( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

if ( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$blocks = get_field('blocks');
?>

<?php if ( !empty( $_POST['query']['preview'] ) ) : ?>

    <figure>
        <img src="<?php echo THEME_URI; ?>'/img/gutenberg-preview/blocks.png'" alt="Preview" style="width:100%;">
    </figure>

<?php else : ?>

    <?php if ( $blocks ) : ?>
        
        <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">  
                    
            <?php foreach ($blocks as $block) : ?>
                <div class="item block_white">

                    <?php if ($block['title_block']) : ?>
                        <strong><?php echo $block['title_block']; ?></strong>
                    <?php endif; ?>
                    
                    <?php echo nl2br($block['txt_block']); ?>

                </div>   
            <?php endforeach; ?>
                                        
        </div>

    <?php endif; ?>

    

<?php endif; ?>


