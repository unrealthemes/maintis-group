<?php 
$number_lot = get_field('lotid');
$salePriceRub = $args['salePriceRub'];
$salePriceUsd = $args['salePriceUsd'];
$salePriceEur = $args['salePriceEur'];
$salePriceSquareRub = $args['salePriceSquareRub'];
$salePriceSquareUsd = $args['salePriceSquareUsd'];
$salePriceSquareEur = $args['salePriceSquareEur'];
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
            
            <div class="price price_v">
                <?php echo number_format($salePriceRub, 0, '.', ' '); ?> ₽
            </div>
            
            <div class="price_two price_s">
                <?php echo number_format($salePriceSquareRub, 0, '.', ' '); ?> ₽/м²
            </div>
            
            <div class="form_row">
                <div class="prod_checbox">   
                    <input type="checkbox" id="checkbox" name="checkbox" value="С терассой" >
                    <label for="checkbox">С терассой</label>  
                </div>
            </div>
            
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
            
            <div class="form_row">
                <input type="text" name="name" value="" placeholder="ФИО" />
            </div>
              
            <div class="form_row">  
                <input type="tel" id="phone" name="phone" placeholder="+7">  
            </div>
            
            <div class="form_row">
                <input type="text" name="phone" value="" placeholder="Эл. Почта" />
            </div>                            
            
            <div class="form_row">
                <input type="text" name="phone" value="" placeholder="Удобное время для связи" />
            </div>
                
            <div class="form_row">
                <div class="form_row_soc">   
                    <input type="radio" id="radio4" name="form_row_soc" value="TG" checked="">
                    <label for="radio4">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_29_1089)">
                                <path opacity="0.3" d="M10 20C15.5228 20 20 15.5228 20 10C20 4.47716 15.5228 0 10 0C4.47716 0 0 4.47716 0 10C0 15.5228 4.47716 20 10 20Z" fill="black"/>
                                <path d="M4.16185 9.9133C4.16185 9.9133 9.16185 7.8613 10.8959 7.13874C11.5607 6.84974 13.815 5.92486 13.815 5.92486C13.815 5.92486 14.8555 5.52026 14.7688 6.5029C14.7399 6.90754 14.5087 8.3237 14.2775 9.8555C13.9306 12.0231 13.5549 14.3931 13.5549 14.3931C13.5549 14.3931 13.4971 15.0578 13.0058 15.1734C12.5145 15.289 11.7052 14.7688 11.5607 14.6532C11.4451 14.5665 9.39305 13.2659 8.64161 12.6301C8.43929 12.4567 8.20809 12.1099 8.67049 11.7052C9.71097 10.7515 10.9537 9.5665 11.7052 8.81506C12.052 8.46822 12.3988 7.65898 10.9537 8.64162C8.90173 10.0578 6.87861 11.3873 6.87861 11.3873C6.87861 11.3873 6.41617 11.6763 5.54913 11.4162C4.68205 11.1561 3.67049 10.8093 3.67049 10.8093C3.67049 10.8093 2.97689 10.3757 4.16185 9.9133Z" fill="white"/>
                            </g>
                            <defs>
                                <clipPath id="clip0_29_1089">
                                    <rect width="20" height="20" fill="white"/>
                                </clipPath>
                            </defs>
                        </svg>
                        TG
                    </label>  
                    
                    <input type="radio" id="radio5" name="form_row_soc" value="WA" />
                    <label for="radio5">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path opacity="0.3" d="M17.0732 2.91667C15.1916 1.04167 12.6829 0 10.0348 0C4.52961 0 0.0696853 4.44444 0.0696853 9.93056C0.0696853 11.6667 0.557491 13.4028 1.39373 14.8611L0 20L5.29617 18.6111C6.75958 19.375 8.36237 19.7917 10.0348 19.7917C15.5401 19.7917 20 15.3472 20 9.86111C19.9303 7.29167 18.9547 4.79167 17.0732 2.91667ZM14.8432 13.4722C14.6341 14.0278 13.6585 14.5833 13.1707 14.6528C12.7526 14.7222 12.1951 14.7222 11.6376 14.5833C11.2892 14.4444 10.8014 14.3056 10.2439 14.0278C7.73519 12.9861 6.13241 10.4861 5.99303 10.2778C5.85366 10.1389 4.94774 8.95833 4.94774 7.70833C4.94774 6.45833 5.57491 5.90278 5.78397 5.625C5.99303 5.34722 6.27178 5.34722 6.48084 5.34722C6.62021 5.34722 6.82927 5.34722 6.96864 5.34722C7.10801 5.34722 7.31707 5.27778 7.52613 5.76389C7.73519 6.25 8.22299 7.5 8.29268 7.56944C8.36237 7.70833 8.36237 7.84722 8.29268 7.98611C8.22299 8.125 8.15331 8.26389 8.01393 8.40278C7.87456 8.54167 7.73519 8.75 7.6655 8.81944C7.52613 8.95833 7.38676 9.09722 7.52613 9.30555C7.6655 9.58333 8.15331 10.3472 8.91986 11.0417C9.89547 11.875 10.662 12.1528 10.9408 12.2917C11.2195 12.4306 11.3589 12.3611 11.4983 12.2222C11.6376 12.0833 12.1254 11.5278 12.2648 11.25C12.4042 10.9722 12.6132 11.0417 12.8223 11.1111C13.0314 11.1806 14.2857 11.8056 14.4948 11.9444C14.7735 12.0833 14.9129 12.1528 14.9826 12.2222C15.0523 12.4306 15.0523 12.9167 14.8432 13.4722Z" fill="black"/>
                        </svg>
                        WA
                    </label>  
                    
                    <input type="radio" id="radio6" name="form_row_soc" value="Звонок" />
                    <label for="radio6">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_29_1081)">
                                <path opacity="0.3" d="M10 20C15.5228 20 20 15.5228 20 10C20 4.47716 15.5228 0 10 0C4.47716 0 0 4.47716 0 10C0 15.5228 4.47716 20 10 20Z" fill="black"/>
                                <path d="M13.7927 15.9415C14.3736 15.8524 15.5354 15.1397 15.7844 14.4271C16.0334 13.7144 16.0334 13.0908 15.9504 12.8236C15.8674 12.7345 15.7014 12.6454 15.3695 12.4673L15.3694 12.4673C15.1205 12.2891 13.6267 11.4873 13.3777 11.3983C13.1288 11.3092 12.8798 11.2201 12.7138 11.5764C12.5478 11.9328 11.9669 12.6454 11.8009 12.8236C11.635 13.0018 11.469 13.0908 11.137 12.9127C10.8051 12.7345 9.89219 12.3782 8.73035 11.3092C7.81748 10.4184 7.23656 9.43845 7.07058 9.08211C6.9046 8.81487 7.07058 8.6367 7.23655 8.45854C7.31954 8.36945 7.48552 8.1022 7.6515 7.92404C7.81747 7.74587 7.90046 7.56771 7.98345 7.38954C8.06644 7.21138 8.06644 7.03321 7.98345 6.85505C7.90046 6.76596 7.31955 5.16248 7.07058 4.5389C6.82161 3.91532 6.57264 4.0044 6.40667 4.0044H5.82575H5.82575C5.57678 4.0044 5.24483 4.0044 4.99586 4.36073C4.7469 4.71706 4 5.42972 4 7.03321C4 8.6367 5.07885 10.1511 5.24483 10.3293C5.41081 10.5965 7.31955 13.8035 10.3071 15.1397C10.971 15.4961 11.552 15.6742 11.9669 15.8524C12.6308 16.0306 13.2947 16.0306 13.7927 15.9415Z" fill="white"/>
                            </g>
                            <defs>
                                <clipPath id="clip0_29_1081">
                                    <rect width="20" height="20" fill="white"/>
                                </clipPath>
                            </defs>
                        </svg> 
                        Звонок
                    </label>  
                </div> 
            </div> 
            
            <div class="form_row">
                <img src="<?php echo THEME_URI; ?>/img/capcha.jpg" alt="" />
            </div>
            
            <div class="form_row form_row_a">
                <a href="#" class="btn_blue">Запланировать просмотр</a>
                <!-- <a href="#" class="btn">Скачать презентацию</a> -->
            </div> 
    
            <div class="form_row">
                <p>Нажимая на кнопку вы соглашаетесь с <a href="#" target="_blank">политикой конфиденциальности</a></p>
            </div> 
            
        </div>
    </div>
</div>