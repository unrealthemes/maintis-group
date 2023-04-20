<?php

/**
 * info-country Block Template.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'info-country-' . $block['id'];

if ( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'content_pages';
if ( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

if ( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$bg_id = get_field('img_ic');
$bg_url = wp_get_attachment_url( $bg_id, 'full' );
$title = get_field('title_ic');
$desc = get_field('desc_ic');
$text_link = get_field('text_link_ic');
$link = get_field('link_ic');
$cities = get_field('cities_ic');
$form = get_field('form_ic');
?>

<?php if ( !empty( $_POST['query']['preview'] ) ) : ?>

    <figure>
        <img src="<?php echo THEME_URI; ?>'/img/gutenberg-preview/info-country.png'" alt="Preview" style="width:100%;">
    </figure>

<?php else : ?>

    <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">

        <!-- <div class="back_btn_wrap">
            <a class="back_btn" onclick="window.history.back(); return false;" >
                <svg width="5" height="9" viewBox="0 0 5 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4 1L2.11564 3.19842C1.58327 3.81952 1.31708 4.13008 1.31708 4.5C1.31708 4.86992 1.58327 5.18048 2.11564 5.80158L4 8" stroke="#00AEF0" stroke-width="2" stroke-linecap="round"/>
                </svg>
                Назад
            </a>
        </div> -->

        <div class="row">

            <div class="content_left"> 

                <div class="top_baner" style="background: url('<?php echo $bg_url; ?>') no-repeat center center;background-size: cover;">
                    <div class="top_baner_vn">

                        <?php if ($title) : ?>
                            <h1><?php echo nl2br($title); ?></h1>
                        <?php endif; ?>

                        <?php if ($desc) : ?>
                            <p><?php echo nl2br($desc); ?></p>
                        <?php endif; ?>

                        <?php if ($text_link && $link) : ?>
                            <a href="<?php echo esc_url($link); ?>" class="btn_blue">
                                <?php echo $text_link; ?>
                            </a>
                        <?php endif; ?>

                    </div>
                </div>
                
                <?php if ($cities) : ?>
                    <div class="top_baner_two">

                        <?php foreach ($cities as $city) : ?>
                            <a href="<?php echo esc_url($city['link_cities_ic']); ?>" class="top_baner_two_item"> 

                                <?php 
                                if ($city['img_cities_ic']) :
                                    $img_url = wp_get_attachment_url( $city['img_cities_ic'], 'full' );
                                ?>
                                    <img src="<?php echo esc_attr($img_url); ?>" alt="" /> 
                                <?php endif; ?>

                                <div class="top_baner_two_item_vn">

                                    <?php if ($city['name_cities_ic']) : ?>
                                        <strong><?php echo esc_html($city['name_cities_ic']); ?></strong>
                                    <?php endif; ?>

                                    <?php echo nl2br($city['desc_cities_ic']); ?>
                                </div>
                            </a>
                        <?php endforeach; ?>
                        
                    </div>
                <?php endif; ?>

            </div>
            
            <?php 
            if ($form) : 
                $contact_form = WPCF7_ContactForm::get_instance( $form->ID );
                $title = get_field('title_form_ic');
                $txt = get_field('txt_form_ic');
            ?>

                <!-- <a class="btn_blue sidebar_btn" href="#" onclick="return false"> 
                    <span>Запланировать просмотр</span>  
                </a>  -->
            
                <div class="sidebar"> 
                    <a href="#" onclick="return false" class="open_popup_content_close"></a>
                    
                    <div class="content_right_vn block_white">
                        <div class="di_form">

                            <div class=" form_row_top">

                                <?php if ($title) : ?>
                                    <div class="form_number">
                                        <?php echo esc_html($title); ?>
                                    </div>  
                                <?php endif; ?>

                                <?php if ($txt) : ?>
                                    <p><?php echo esc_html($txt); ?></p> 
                                <?php endif; ?>

                            </div>

                            <?php echo do_shortcode( $contact_form->shortcode() ); ?>

                            <div class="form_row">
                                <p>Нажимая на кнопку вы соглашаетесь с <a href="<?php echo esc_url( get_privacy_policy_url() ); ?>" target="_blank">политикой конфиденциальности</a></p>
                            </div> 

                        </div>
                    </div>
                </div>
            <?php endif; ?>
    
        </div>
    </div> 

<?php endif; ?>