<?php 
$number_lot = get_field('lotid');
$salePriceRub = $args['salePriceRub'];
$salePriceUsd = $args['salePriceUsd'];
$salePriceEur = $args['salePriceEur'];
$salePriceSquareRub = $args['salePriceSquareRub'];
$salePriceSquareUsd = $args['salePriceSquareUsd'];
$salePriceSquareEur = $args['salePriceSquareEur'];
$badges = wp_get_post_terms(get_the_ID(), 'badges');
?> 

<a class="btn_blue sidebar_btn" href="#" onclick="return false"> 
    <span>Запланировать просмотр</span>  
</a> 

<div class="sidebar"> 
    <a href="#" onclick="return false" class="open_popup_content_close"></a>
    
    <div class="content_right_vn block_white">
        <div class="di_form">

            <?php if ( $number_lot ) : ?>
                <div class="form_number">№ лота <?php echo $number_lot; ?></div>  
            <?php endif; ?>
            
            <?php if ($salePriceRub) : ?>
                <div class="price price_v">
                    <?php echo number_format($salePriceRub, 0, '.', ' '); ?> ₽
                </div>
            <?php else : ?>
                <div class="price price_v">
                    Цена по запросу
                </div>
            <?php endif; ?>
            
            <?php if ($salePriceSquareRub) : ?>
                <div class="price_two price_s">
                    <?php echo number_format($salePriceSquareRub, 0, '.', ' '); ?> ₽/м²
                </div>
            <?php endif; ?>
            
            <?php if ($badges) : ?>
                <?php foreach ($badges as $badge) : ?>
                    <div class="form_row">
                        <div class="prod_checbox">   
                            <!-- <input type="checkbox" id="checkbox" name="checkbox" value="С терассой" > -->
                            <label for="checkbox"><?php echo esc_html($badge->name); ?></label>  
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
            
            <?php if ($salePriceSquareRub || $salePriceRub) : ?>
                <div class="form_row">
                    <div class="prod_radio">   
                        <input  type="radio" 
                                id="radio1" 
                                class="change-price"
                                name="radios" 
                                value="₽" 
                                data-symbol="₽/м²"
                                data-price="<?php echo $salePriceRub; ?>"
                                data-price-square="<?php echo $salePriceSquareRub; ?>"
                                checked>
                        <label for="radio1">₽</label>  
                        
                        <input  type="radio" 
                                id="radio2" 
                                class="change-price"
                                name="radios" 
                                value="$"
                                data-symbol="$/м²"
                                data-price="<?php echo $salePriceUsd; ?>"
                                data-price-square="<?php echo $salePriceSquareUsd; ?>"
                                >
                        <label for="radio2">$</label>  
                        
                        <input  type="radio" 
                                id="radio3" 
                                class="change-price"
                                name="radios" 
                                value="€"
                                data-symbol="€/м²"
                                data-price="<?php echo $salePriceEur; ?>"
                                data-price-square="<?php echo $salePriceSquareEur; ?>"
                                >
                        <label for="radio3">€</label>  
                    </div> 
                </div>
            <?php endif; ?>
            
            <?php echo do_shortcode('[contact-form-7 id="28096" title="Объекты недвижимости"]'); ?>
    
            <div class="form_row">
                <p>Нажимая на кнопку вы соглашаетесь с <a href="<?php echo esc_url( get_privacy_policy_url() ); ?>" target="_blank">политикой конфиденциальности</a></p>
            </div> 
            
        </div>
    </div>
</div>