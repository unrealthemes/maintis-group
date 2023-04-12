<?php 
$form = $args['form'];
$contact_form = WPCF7_ContactForm::get_instance( $form->ID );
?>

<div class="b_modal modal_contact mfp-hide zoom-anim-dialog" id="write_us">
    <div class="container">
        <div class="section_inner flex row">
            <div class="sidebar_block">
                <div class="section_title">
                    <h2>Написать нам</h2>
                </div>
            </div>
                <div class="section_content">
                    <div class="request">
                        <div class="form_wrap">
                            <?php echo do_shortcode( $contact_form->shortcode() ); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>