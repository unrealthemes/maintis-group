<?php

/**
 * contacts Block Template.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'contacts-' . $block['id'];

if ( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'contact_block';
if ( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

if ( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$logo_id = get_field('logo_contacts');
$address = get_field('address_contacts');
$shedule = get_field('shedule_contacts');
$email = get_field('email_contacts');
$soc_network = get_field('soc_network_contacts');
$phone = get_field('phone_contacts');
$form = get_field('form_contacts');
$map = get_field('y_m_contacts');
?>

<?php if ( !empty( $_POST['query']['preview'] ) ) : ?>

    <figure>
        <img src="<?php echo THEME_URI; ?>'/img/gutenberg-preview/contacts.png'" alt="Preview" style="width:100%;">
    </figure>

<?php else : ?>

    <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
        <div class="contact_info">

            <?php 
            if ( $logo_id ) : 
                $logo_url = wp_get_attachment_url( $logo_id, 'full' );
            ?>
                <div class="contact_info_logo">
                    <a href="<?php echo esc_url( home_url('/') ); ?>"> 
                        <img src="<?php echo esc_attr($logo_url) ?>" alt="Mantis Group logo">
                    </a>
                </div> 
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

            <?php if ( $soc_network ) : ?>
                <div class="contact_item">
                    <div class="contact_item_title">Соц. сети</div>
                    <div class="contact_soc">
                        <?php echo $soc_network; ?>
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

        <?php if ( $map ) : ?>
            <div class="contact_map" id="map">
                <?php echo $map; ?>
            </div>
        <?php endif; ?>

    </div> 

    <?php 
    // include modal
    if ( $form ) : 
        get_template_part('template-parts/modals/contact', null, ['form' => $form]);
    endif; 
    ?>

<?php endif; ?>