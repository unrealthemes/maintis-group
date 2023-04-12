<?php

/**
 * documents Block Template.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'documents-' . $block['id'];

if ( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'home_block top_list_block';
if ( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

if ( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$title = get_field('title_documents');
$documents = get_field('documents');
?>

<?php if ( !empty( $_POST['query']['preview'] ) ) : ?>

    <figure>
        <img src="<?php echo THEME_URI; ?>'/img/gutenberg-preview/documents.png'" alt="Preview" style="width:100%;">
    </figure>

<?php else : ?>

    <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">  
        <div class="row_di">  
            <div class="top_list carousel_v2">

                <?php if ($title) : ?>
                    <div class="block_title">
                        <h3><?php echo $title; ?></h3>
                    </div>
                <?php endif; ?>

                <?php if ($documents) : ?>
                    <div class="list_view_3 owl-carousel"> 

                        <?php 
                        foreach ($documents as $key => $img) : 

                            if ( $img['mime_type'] == 'application/pdf' ) { // pdf file
                                $preview = $img['icon'];
                            } else {
                                $preview = $img['sizes']['medium_large'];
                            }
                        ?>
                            <div class="item">
                                <a href="<?php echo esc_attr($img['url']); ?>" data-fancybox="documentation">
                                    <img src="<?php echo esc_attr($preview); ?>" alt="Document">
                                </a>
                            </div>    
                        <?php endforeach; ?>
                        
                    </div>
                    <div class="owl_navigation owl_nav_3"></div> 
                <?php endif; ?>

            </div> 
        </div>
    </div>
    

<?php endif; ?>


