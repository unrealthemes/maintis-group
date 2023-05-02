<?php 
$salePriceRub = $args['salePriceRub'];
$salePriceUsd = $args['salePriceUsd'];
$salePriceEur = $args['salePriceEur'];
$salePriceSquareRub = $args['salePriceSquareRub'];
$salePriceSquareUsd = $args['salePriceSquareUsd'];
$salePriceSquareEur = $args['salePriceSquareEur'];
?>

<div class="deils_moble hiden_ps"> 
    <div class="price_block">
     
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
  
    </div> 
   
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
    
</div>