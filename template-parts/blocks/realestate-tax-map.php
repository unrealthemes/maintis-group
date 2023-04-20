<?php

/**
 * realestate-tax-map Block Template.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'realestate-tax-map-' . $block['id'];

if ( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'object_container cat_block';
if ( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

if ( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$title = get_field('title_rtaxm');
$country = get_field('country_rtaxm');
$departments = get_field('department_rtaxm');
?>

<?php if ( !empty( $_POST['query']['preview'] ) ) : ?>

    <figure>
        <img src="<?php echo THEME_URI; ?>/img/gutenberg-preview/realestate-tax-map.png" alt="Preview" style="width:100%;">
    </figure>

<?php else : ?>

    <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">  

        <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=0e22f693-ee8a-440d-96d7-df33d2b9e0a2" ></script>

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
                            <?php 
                            foreach ($departments as $department) : 
                                $tab_id = 'map_' . $department->term_id . '_' . $department->slug;
                            ?>
                                <li data-id="<?php echo esc_attr($tab_id); ?>" class="tab_map">
                                    <?php echo esc_html($department->name); ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>   
                        <div class="tabs_content">

                            <?php 
                            foreach ($departments as $count_tax => $department) : 
                                $params = [];
                                $map_id = 'map_' . $department->term_id . '_' . $department->slug;
                                $args = [
                                    'post_type' => 'realestate',
                                    'post_status' => 'publish',
                                    'posts_per_page' => -1,
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
                                      
                                    <?php 
                                    while ( $loop->have_posts() ) : 
                                        $loop->the_post(); 
                                        $lat = get_field('latitude', get_the_ID());
                                        $lng = get_field('longitude', get_the_ID());
                                        
                                        if ( $lat && $lng ) :
                                            $params[] = [ $lat, $lng ];
                                        endif;
                                    endwhile; 
                                    ?> 

                                    <div class="yandex--map" 
                                         id="<?php echo esc_attr($map_id); ?>"
                                         data-count="<?php echo esc_attr($count_tax + 1); ?>"
                                         data-status=""
                                         data-params="<?php echo esc_attr( wp_json_encode($params) ); ?>"
                                    ></div>
                                                 
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

<?php endif; ?>