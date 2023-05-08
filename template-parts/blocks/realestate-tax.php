<?php

/**
 * realestate-tax Block Template.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'realestate-tax-' . $block['id'];

if ( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'object_container';
if ( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

if ( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$title = get_field('title_rtax');
$country = get_field('country_rtax');
$departments = get_field('department_rtax');
?>

<?php if ( !empty( $_POST['query']['preview'] ) ) : ?>

    <figure>
        <img src="<?php echo THEME_URI; ?>/img/gutenberg-preview/realestate-tax.png" alt="Preview" style="width:100%;">
    </figure>

<?php else : ?>

    <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">  
        <div class="row_d contact_niz">  

            <div class="cat_short_object"> 

                <?php if ($title) : ?>
                    <div class="block_title">
                        <h3><?php echo esc_html($title); ?></h3> 
                    </div>  
                <?php endif; ?>

                <?php if ($departments) : ?>
                    <div class="cat_short">  
                        <div class="tabs"> 
                            <ul> 
                                <?php foreach ($departments as $department) : ?>
                                    <li><?php echo esc_html($department->name); ?></li>
                                <?php endforeach; ?>
                            </ul>
                                
                            <div class="tabs_content">

                                <?php 
                                foreach ($departments as $department) : 
                                    $args = [
                                        'post_type' => 'realestate',
                                        'post_status' => 'publish',
                                        'posts_per_page' => 24,
                                        'tax_query' => [
                                            'relation' => 'AND',
                                            [
                                                'taxonomy' => $department->taxonomy,
                                                'field'    => 'slug',
                                                'terms'    => $department->slug,
                                            ],
                                            [
                                                'taxonomy' => $country->taxonomy,
                                                'field'    => 'slug',
                                                'terms'    => $country->slug,
                                            ],
                                        ],
                                    ];
                                    $loop = new WP_Query( $args );
                                
                                    if ( $loop->have_posts() ) : 
                                ?>
                                    <div> 
                                        <div class="row_di">
                                            <div class="row_10_di object_list">
                                            
                                                <?php 
                                                $j = 1;
                                                while ( $loop->have_posts() ) : 
                                                    $loop->the_post(); 
                                                    get_template_part('template-parts/realestate/realestate', 'item', ['count' => $j]);
                                                    $j++;
                                                endwhile; 
                                                ?> 
                                                
                                            </div>
                                             
                                            <div class="learn_more_cat">
                                                <a class="show_more_btn btn" href="#">Показать еще</a>
                                            </div>   

                                        </div>       
                                    </div>

                                <?php 
                                    endif; 
                                    wp_reset_postdata(); 
                                endforeach;
                                ?>
                                
                            </div>
                                    
                        </div> 
                    </div>
                <?php endif; ?>
                                
            </div>
        </div>
    </div>

<?php endif; ?>