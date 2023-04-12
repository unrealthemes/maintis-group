<?php

/**
 * title Block Template.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'title-' . $block['id'];

if ( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'page_header';
if ( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

if ( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$title = get_field('h1_title');
?>

<?php if ( !empty( $_POST['query']['preview'] ) ) : ?>

    <figure>
        <img src="<?php echo THEME_URI; ?>'/img/gutenberg-preview/title.png'" alt="Preview" style="width:100%;">
    </figure>

<?php else : ?>

    <?php if ( $title ) : ?>
        
        <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">  
            <div class="page_title">
                <h1><?php echo $title; ?></h1>
            </div>
        </div>

    <?php endif; ?>

    

<?php endif; ?>


