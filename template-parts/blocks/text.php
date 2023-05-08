<?php

/**
 * text Block Template.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'text-' . $block['id'];

if ( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'home_block';

if ( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

if ( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$text = get_field('txt_text');
?>

<?php if ( !empty( $_POST['query']['preview'] ) ) : ?>

    <figure>
        <img src="<?php echo THEME_URI; ?>/img/gutenberg-preview/text.png" alt="Preview" style="width:100%;">
    </figure>

<?php else : ?>

    <?php if ( $text ) : ?>
        
        <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">  
            <div class="row_di"> 
                <div class="more_text">
                    <?php echo $text; ?>
                </div> 

                <?php if ( strlen($text) > 585 ) : ?>
                    <div class="learn_more_text">
                        <a class="learn_morebtn_text btn" href="#">Показать еще</a>
                    </div> 
                <?php endif; ?>

            </div>
        </div>   

    <?php endif; ?>

<?php endif; ?>