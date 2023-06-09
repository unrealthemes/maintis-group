<?php 
$post_id = get_the_ID();
$thumbnail = get_the_post_thumbnail($post_id, 'full'); 
$thumbnail = ($thumbnail) ? $thumbnail : '<img src="' . THEME_URI . '/img/default-image.png" alt="' . get_the_title() . '">';
$area = get_field('area', $post_id);
$rooms = get_field('rooms', $post_id);
$bedrooms = get_field('bedrooms', $post_id);
$bathrooms = get_field('bathrooms', $post_id);
$floor = get_field('floor', $post_id);
$total_floor = get_field('totalFloor', $post_id);
$number_lot = get_field('lotid', $post_id);
$address = get_field('address', $post_id);
$price_rub = get_field('salePriceRub', $post_id);
$show = ( isset($args['count']) && $args['count'] > 6 ) ? 'style="display:none;"' : '';
$class = ( isset($args['class']) ) ? $args['class'] : '';
?>

<div class="item <?php echo $class; ?>" <?php echo $show; ?>>   
    <div class="object_item_vn">  
        <div class="object_item_img">
            <a href="<?php the_permalink(); ?>">
                <?php echo $thumbnail; ?>
            </a>
        </div> 
        <div class="object_desc"> 
            <div class="object_item_desc">

                <?php if ($number_lot) : ?>
                    <div class="object_item_data">
                        № лота <?php echo $number_lot; ?>
                    </div>
                <?php endif; ?>

                <div class="object_item_title">

                    <?php if ($price_rub) : ?>
                        <div class="item_title_price">
                            <?php echo number_format($price_rub, 0, '.', ' '); ?> ₽
                        </div>
                    <?php endif; ?>

                    <?php if ($area) : ?>
                        <div class="item_title_area">
                            <?php echo $area; ?> м<sup>2</sup>
                        </div>
                    <?php endif; ?>

                </div>
                <div class="item_title_name">
                    <a href="<?php the_permalink(); ?>">
                        <?php the_title(); ?>
                    </a>
                </div>

                <?php if ($address) : ?>
                    <div class="item_title_details">
                        <?php echo $address; ?>
                    </div>
                <?php endif; ?>

            </div>

            <?php if ( $rooms || $bedrooms || $bathrooms || $floor ) : ?>
                <ul class="object_ul">

                    <?php if ($rooms) : ?>
                        <li class="object_li">
                            <div class="object_li_title">Комнат</div> <?php echo $rooms; ?>
                        </li> 
                    <?php endif; ?>

                    <?php if ($bedrooms) : ?>
                        <li class="object_li">
                            <div class="object_li_title">Спален</div> <?php echo $bedrooms; ?>
                        </li> 
                    <?php endif; ?>

                    <?php if ($bathrooms) : ?>
                        <li class="object_li">
                            <div class="object_li_title">С/У</div> <?php echo $bathrooms; ?>
                        </li> 
                    <?php endif; ?>

                    <?php if ($floor) : ?>
                        <li class="object_li">
                            <div class="object_li_title">Этаж</div>  
                            <?php 
                            if ($total_floor) :
                                echo $floor . '/' . $total_floor; 
                            else :
                                echo $floor; 
                            endif;
                            ?>
                        </li> 
                    <?php endif; ?>

                </ul>
            <?php endif; ?>
            
        </div>
    </div>
</div>