<?php

/**
 * contacts-info Block Template.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'contacts-info-' . $block['id'];

if ( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'o_ofice';
if ( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

if ( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$bg_id = get_field('logo_contacts_info');
$bg_url = ($bg_id) ? 'background: url(' .  wp_get_attachment_url( $bg_id, 'full' ) . ') no-repeat;background-size: cover;' : '';
$title = get_field('title_contacts_info');
$address = get_field('address_contacts_info');
$shedule = get_field('shedule_contacts_info');
$email = get_field('email_contacts_info');
$phone = get_field('phone_contacts_info');
$form = get_field('form_contacts_info');
?>

<?php if ( !empty( $_POST['query']['preview'] ) ) : ?>

    <figure>
        <img src="<?php echo THEME_URI; ?>'/img/gutenberg-preview/contacts-info.png'" alt="Preview" style="width:100%;">
    </figure>

<?php else : ?>

    <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>" style="<?php echo esc_attr($bg_url); ?>">
        <div class="contact_info"> 

            <?php if ( $title ) : ?>
                <h4><?php echo esc_html($title); ?></h4>
            <?php endif; ?>
            
            <?php if ( $address ) : ?>
                <div class="contact_item">
                    <div class="contact_item_title">Адрес</div>
                    <div class="contact_item_content">
                        <?php echo esc_html($address); ?>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ( $shedule ) : ?>
                <div class="contact_item">
                    <div class="contact_item_title">Время работы</div>
                    <div class="contact_item_content">
                        <?php echo esc_html($shedule); ?>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ( $email ) : ?>
                <div class="contact_item">
                    <div class="contact_item_title">Эл. Почта</div>
                    <div class="contact_item_content">
                        <a href="mailto:<?php echo esc_attr($email); ?>">
                            <?php echo esc_html($email); ?>
                        </a>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ( $phone ) : ?>
                <div class="contact_item tel">
                    <div class="contact_item_title">Телефон</div>
                    <div class="contact_item_content ">
                        <a href="tel:<?php echo esc_attr($phone); ?>">
                            <?php echo esc_html($phone); ?>
                        </a>
                    </div>
                </div>
            <?php endif; ?>
            
            <?php if ( $form ) : ?>
                <a class="btn" data-fancybox data-src="#contact" href="javascript:;">
                    Заказать звонок
                </a>
            <?php endif; ?>
            
        </div>
    </div>   

    <?php 
    // include modal
    if ( $form ) : 
        get_template_part('template-parts/modals/contact', null, ['form' => $form]);
    endif; 
    ?>

<?php endif; ?>