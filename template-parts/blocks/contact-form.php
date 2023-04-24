<?php

/**
 * contact-form Block Template.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'contact-form-' . $block['id'];

if ( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'block_contact';
if ( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

if ( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$img_id = get_field('img_id_cf');
$img_url = wp_get_attachment_url( $img_id, 'full' );
$title = get_field('title_cf');
$form = get_field('form_cf');
?>

<?php if ( !empty( $_POST['query']['preview'] ) ) : ?>

    <figure>
        <img src="<?php echo THEME_URI; ?>/img/gutenberg-preview/contact-form.png" alt="Preview" style="width:100%;">
    </figure>

<?php else : ?>

    <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>" style="background: url('<?php echo THEME_URI; ?>/img/top_image.jpg') no-repeat center center;background-size: cover;">  
        <div class="block_contact_text">

            <?php if ($title) : ?>
                <h3><?php echo esc_html($title); ?></h3> 
            <?php endif; ?>

            <?php 
            if ( $form ) : 
                $contact_form = WPCF7_ContactForm::get_instance( $form->ID );
                echo do_shortcode( $contact_form->shortcode() ); 
            endif; 
            ?>

            <p>Нажимая на кнопку вы соглашаетесь с <a href="<?php echo esc_url( get_privacy_policy_url() ); ?>" target="_blank">политикой конфиденциальности</a></p>
            
        </div>

        <?php if ($img_url) : ?>
            <img src="<?php echo esc_attr($img_url); ?>" alt="Image">
        <?php endif; ?>

    </div>

<?php endif; ?>