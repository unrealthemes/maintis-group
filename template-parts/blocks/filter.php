<?php

/**
 * filter Block Template.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'filter-' . $block['id'];

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

$pages = get_field('pages_filter');
$links = get_field('links_filter');
?>

<?php if ( !empty( $_POST['query']['preview'] ) ) : ?>

    <figure>
        <img src="<?php echo THEME_URI; ?>/img/gutenberg-preview/filter.png" alt="Preview" style="width:100%;">
    </figure>

<?php else : ?>

    <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">  
        <div class="row_di"> 
            <div class="tabs">
                <ul> 
                    <li>Москва</li>

                    <?php if ($pages) : ?>
                        <?php foreach ($pages as $page) : ?>
                            <li>
                                <a href="<?php echo esc_url(get_the_permalink($page)); ?>">
                                    <?php echo esc_html(get_the_title($page)); ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?>

                </ul>
                <div class="tabs_content">

                    <div>
                        <?php get_template_part('template-parts/blocks/filter', 'panel'); ?> 
                    </div>

                    <!-- <div>Второе содержимое</div>
                    <div>Третье содержимое</div>
                    <div>4 содержимое</div> -->

                </div>
            </div>
        </div>
        
        <?php if ($links) : ?>
            <div class="row home_cat">
            
                <?php foreach ($links as $link) : ?>
                    <a href="<?php echo esc_url($link['link_links_filter']); ?>">
                        <?php echo esc_html($link['txt_links_filter']); ?>
                    </a>
                <?php endforeach; ?>

            </div>
        <?php endif; ?>
        
    </div>

<?php endif; ?>