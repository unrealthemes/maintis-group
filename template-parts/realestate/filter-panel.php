<?php 
global $wp_query;

$current_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$parse_curr_link = parse_url( $current_link );
$reset_link = home_url('/' . $parse_curr_link['path']);
$tax_obj = $wp_query->get_queried_object();
$countries = get_terms( 'country', [
    'orderby' => 'name',
    'order' => 'ASC',
    'hide_empty' => 1,
] ); 
$cities = get_terms( 'city', [
    'orderby' => 'name',
    'order' => 'ASC',
    'hide_empty' => 1,
] ); 
$districts = get_terms( 'district', [
    'orderby' => 'name',
    'order' => 'ASC',
    'hide_empty' => 1,
] ); 
$site_dstricts = get_terms( 'site_dstrict', [
    'orderby' => 'name',
    'order' => 'ASC',
    'hide_empty' => 1,
] ); 
$departments = get_terms( 'department', [
    'orderby' => 'name',
    'order' => 'ASC',
    'hide_empty' => 1,
] ); 
$highways = get_terms( 'highway', [
    'orderby' => 'name',
    'order' => 'ASC',
    'hide_empty' => 1,
] ); 
$finishings = get_terms( 'finishing', [
    'orderby' => 'name',
    'order' => 'ASC',
    'hide_empty' => 1,
] ); 

if ( isset($_GET['dealType']) && 'Продажа' == $_GET['dealType'] ) {
    $deal_type_checked = 'checked';
} else if ( ! isset($_GET['dealType']) ) {
    $deal_type_checked = 'checked';
} else {
    $deal_type_checked = '';
}
?>

<form id="realestate_form" action="" method="get">

    <?php if ( isset($tax_obj->taxonomy) && ! empty($tax_obj->taxonomy) ) : ?>
        <input type="hidden" name="current_tax" value="<?php echo esc_attr($tax_obj->taxonomy); ?>">
        <input type="hidden" name="current_term" value="<?php echo esc_attr($tax_obj->slug); ?>">
    <?php endif; ?>

    <div class="row_di cat_filter"> 
        <div class="catalog_filter_top_row"> 

            <!-- Type Market -->
            <div class="filter">
                <div class="prod_checbox">  

                    <input type="radio" id="radio1" name="dealType" value="Продажа" <?php echo $deal_type_checked; ?>>
                    <label for="radio1">Продажа</label> 

                    <input type="radio" id="radio2" name="dealType" value="Аренда" <?php echo ( (isset($_GET['dealType']) && 'Аренда' == $_GET['dealType']) ? 'checked' : '' ); ?>>
                    <label for="radio2">Аренда</label> 

                </div> 
            </div>

            <!-- Country -->
            <?php if ($countries) : ?>
                <div class="dropdown">
                    <div class="dropdown_title">Страна</div>
                    <div class="dropdown-toggle" >
                        Все страны
                    </div> 
                    <div class="dropdown-menu dicustom-checkbox">
                        <div class="dropdown-search">
                            <input type="text" placeholder="Поиск...">
                        </div>
                        
                        <?php foreach ($countries as $country) : ?>
                            <label class="dropdown-item">
                                <input  type="checkbox" 
                                        name="ut_country[]" 
                                        value="<?php echo esc_attr($country->name); ?>"
                                        <?php echo ( (isset($_GET['ut_country']) && in_array($country->name, $_GET['ut_country'])) ? 'checked' : '' ); ?>>  
                                <div class="dicustom-checkbox__label">
                                    <?php echo esc_html($country->name); ?>
                                </div>
                            </label>
                        <?php endforeach ?>

                    </div>
                </div>
            <?php endif; ?>
                
            <!-- City -->
            <?php if ($cities) : ?>
                <div class="dropdown">
                    <div class="dropdown_title">Город</div>
                    <div class="dropdown-toggle" >
                        Все города
                    </div> 
                    <div class="dropdown-menu dicustom-checkbox">
                        <div class="dropdown-search">
                            <input type="text" placeholder="Поиск...">
                        </div>
                        
                        <?php foreach ($cities as $city) : ?>
                            <label class="dropdown-item">
                                <input  type="checkbox" 
                                        name="ut_city[]" 
                                        value="<?php echo esc_attr($city->name); ?>"
                                        <?php echo ( (isset($_GET['ut_city']) && in_array($city->name, $_GET['ut_city'])) ? 'checked' : '' ); ?>>  
                                <div class="dicustom-checkbox__label">
                                    <?php echo esc_html($city->name); ?>
                                </div>
                            </label>
                        <?php endforeach ?>

                    </div>
                </div>
            <?php endif; ?>
            
            <!-- Price -->
            <div class="dropdown">
                <div class="dropdown_title">Цена</div>    
                <div class="base-range-input__wrap">
                    
                    <div class="base-range-input__label-wrap">
                        <label class="base-range-input__label">
                            <input type="number" min="1" name="price_from" placeholder="От" class="base-range-input__control" value="<?php echo ( (isset($_GET['price_from']) ) ? $_GET['price_from'] : '' ); ?>">
                        </label>
                    </div>
                    
                    <div class="base-range-input__delimiter">- до</div>
                    
                    <div class="base-range-input__label-wrap">
                        <div class="base-range-input__label">
                            <input type="number" min="1" name="price_to" placeholder="" class="base-range-input__control" value="<?php echo ( (isset($_GET['price_to']) ) ? $_GET['price_to'] : '' ); ?>">
                        </div>
                    </div>
                    <div class="base-currency">

                        <?php if ( isset($_GET['currency_symbol']) && ! empty($_GET['currency_symbol']) ) : ?>
                            <button type="button" class="base-currency__btn">
                                
                                <?php if ($_GET['currency_symbol'] == 'rub') : ?>
                                    ₽ 
                                <?php elseif ($_GET['currency_symbol'] == 'usd') : ?>
                                    $ 
                                <?php elseif ($_GET['currency_symbol'] == 'eur') : ?>
                                    € 
                                <?php endif; ?>

                            </button>
                        <?php else : ?>
                            <button type="button" class="base-currency__btn"> ₽ </button>
                        <?php endif; ?>

                        <div class="base-currency__dropdown">
                            <button type="button" class="base-currency__dropdown-item <?php echo ( (isset($_GET['currency_symbol']) && 'rub' == $_GET['currency_symbol']) ? 'active' : '' ); ?>" data-currency="rub"> ₽ </button>
                            <button type="button" class="base-currency__dropdown-item <?php echo ( (isset($_GET['currency_symbol']) && 'usd' == $_GET['currency_symbol']) ? 'active' : '' ); ?>" data-currency="usd"> $ </button>
                            <button type="button" class="base-currency__dropdown-item <?php echo ( (isset($_GET['currency_symbol']) && 'eur' == $_GET['currency_symbol']) ? 'active' : '' ); ?>" data-currency="eur"> € </button>
                        </div>
                    </div>
                    <select name="currency_symbol" id="currency_symbol">
                        <option value="rub" <?php echo ( (isset($_GET['currency_symbol']) && 'rub' == $_GET['currency_symbol']) ? 'selected' : '' ); ?>> ₽ </option>
                        <option value="usd" <?php echo ( (isset($_GET['currency_symbol']) && 'usd' == $_GET['currency_symbol']) ? 'selected' : '' ); ?>> $ </option>
                        <option value="eur" <?php echo ( (isset($_GET['currency_symbol']) && 'eur' == $_GET['currency_symbol']) ? 'selected' : '' ); ?>> € </option>
                    </select>
                </div>
            </div>
            
            <div class="filter_resault">
                <a href="#" class="open_popup" onclick="return false">
                    <svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="0.5" y="0.5" width="49" height="49" rx="24.5" fill="white"/>
                        <path d="M35 17H15L23 26.46V33L27 35V26.46L35 17Z" stroke="#00AEF0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <rect x="0.5" y="0.5" width="49" height="49" rx="24.5" stroke="#00AEF0"/>
                    </svg> 
                </a>
                <a href="<?php echo esc_url($reset_link); ?>" class="btn clear">Сбросить</a> 
            </div>
        </div>
    </div>

    <div class="open_popup_content">
        <div class="open_popup_content_close"> </div>
        <h4>Фильтры</h4>
            
        <!-- <div class="rowfilter_2">
            <a href="#" class="btn"> 
                <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4.99984 3H14.9998L18.3332 8L9.99984 18.8333L1.6665 8L4.99984 3Z" stroke="#00AEF0" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M10 18.8333L13.3333 8L10.8333 3" stroke="#00AEF0" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M9.99984 18.8333L6.6665 8L9.1665 3" stroke="#00AEF0" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M1.6665 8H18.3332" stroke="#00AEF0" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg> 
                <span>Эксклюзив</span>
                <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle opacity="0.3" cx="10" cy="10.5" r="9.5" stroke="black"></circle>
                <path opacity="0.3" d="M9.05726 13.1364V13.0767C9.06389 12.4437 9.13018 11.9399 9.25613 11.5653C9.38207 11.1908 9.56105 10.8875 9.79306 10.6555C10.0251 10.4235 10.3035 10.2098 10.6283 10.0142C10.8238 9.89489 10.9995 9.75402 11.1553 9.59162C11.311 9.4259 11.4337 9.23532 11.5232 9.01989C11.616 8.80445 11.6624 8.56581 11.6624 8.30398C11.6624 7.97917 11.5861 7.69744 11.4337 7.45881C11.2812 7.22017 11.0774 7.03622 10.8222 6.90696C10.567 6.7777 10.2836 6.71307 9.97203 6.71307C9.70025 6.71307 9.43842 6.76941 9.18652 6.8821C8.93463 6.99479 8.72417 7.17211 8.55513 7.41406C8.3861 7.65601 8.28832 7.97254 8.26181 8.36364H7.00897C7.03548 7.80019 7.18132 7.31794 7.44647 6.9169C7.71493 6.51586 8.06792 6.20928 8.50542 5.99716C8.94623 5.78504 9.4351 5.67898 9.97203 5.67898C10.5554 5.67898 11.0625 5.79498 11.4933 6.02699C11.9275 6.259 12.2623 6.57718 12.4976 6.98153C12.7362 7.38589 12.8556 7.84659 12.8556 8.36364C12.8556 8.72822 12.7992 9.058 12.6865 9.35298C12.5771 9.64796 12.4181 9.91146 12.2093 10.1435C12.0038 10.3755 11.7552 10.581 11.4635 10.7599C11.1718 10.9422 10.9382 11.1345 10.7625 11.3366C10.5869 11.5355 10.4593 11.7725 10.3797 12.0476C10.3002 12.3227 10.2571 12.6657 10.2504 13.0767V13.1364H9.05726ZM9.69363 16.0795C9.44836 16.0795 9.2379 15.9917 9.06223 15.8161C8.88657 15.6404 8.79874 15.4299 8.79874 15.1847C8.79874 14.9394 8.88657 14.7289 9.06223 14.5533C9.2379 14.3776 9.44836 14.2898 9.69363 14.2898C9.93889 14.2898 10.1494 14.3776 10.325 14.5533C10.5007 14.7289 10.5885 14.9394 10.5885 15.1847C10.5885 15.3471 10.5471 15.4962 10.4642 15.6321C10.3847 15.768 10.277 15.8774 10.1411 15.9602C10.0085 16.0398 9.85935 16.0795 9.69363 16.0795Z" fill="black"></path>
                </svg> 
            </a>
            <a href="#" class="btn btn_red"> 
                <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M14 6.5L6 14.5" stroke="#E45231" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M7.5 9.5C8.32843 9.5 9 8.82843 9 8C9 7.17157 8.32843 6.5 7.5 6.5C6.67157 6.5 6 7.17157 6 8C6 8.82843 6.67157 9.5 7.5 9.5Z" stroke="#E45231" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M12.5 14.5C13.3284 14.5 14 13.8284 14 13C14 12.1716 13.3284 11.5 12.5 11.5C11.6716 11.5 11 12.1716 11 13C11 13.8284 11.6716 14.5 12.5 14.5Z" stroke="#E45231" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                <rect x="0.75" y="1.25" width="18.5" height="18.5" rx="9.25" stroke="#E45231" stroke-width="1.5"></rect>
                </svg> 
                <span>Скидки</span>
                <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle opacity="0.3" cx="10" cy="10.5" r="9.5" stroke="black"></circle>
                <path opacity="0.3" d="M9.05726 13.1364V13.0767C9.06389 12.4437 9.13018 11.9399 9.25613 11.5653C9.38207 11.1908 9.56105 10.8875 9.79306 10.6555C10.0251 10.4235 10.3035 10.2098 10.6283 10.0142C10.8238 9.89489 10.9995 9.75402 11.1553 9.59162C11.311 9.4259 11.4337 9.23532 11.5232 9.01989C11.616 8.80445 11.6624 8.56581 11.6624 8.30398C11.6624 7.97917 11.5861 7.69744 11.4337 7.45881C11.2812 7.22017 11.0774 7.03622 10.8222 6.90696C10.567 6.7777 10.2836 6.71307 9.97203 6.71307C9.70025 6.71307 9.43842 6.76941 9.18652 6.8821C8.93463 6.99479 8.72417 7.17211 8.55513 7.41406C8.3861 7.65601 8.28832 7.97254 8.26181 8.36364H7.00897C7.03548 7.80019 7.18132 7.31794 7.44647 6.9169C7.71493 6.51586 8.06792 6.20928 8.50542 5.99716C8.94623 5.78504 9.4351 5.67898 9.97203 5.67898C10.5554 5.67898 11.0625 5.79498 11.4933 6.02699C11.9275 6.259 12.2623 6.57718 12.4976 6.98153C12.7362 7.38589 12.8556 7.84659 12.8556 8.36364C12.8556 8.72822 12.7992 9.058 12.6865 9.35298C12.5771 9.64796 12.4181 9.91146 12.2093 10.1435C12.0038 10.3755 11.7552 10.581 11.4635 10.7599C11.1718 10.9422 10.9382 11.1345 10.7625 11.3366C10.5869 11.5355 10.4593 11.7725 10.3797 12.0476C10.3002 12.3227 10.2571 12.6657 10.2504 13.0767V13.1364H9.05726ZM9.69363 16.0795C9.44836 16.0795 9.2379 15.9917 9.06223 15.8161C8.88657 15.6404 8.79874 15.4299 8.79874 15.1847C8.79874 14.9394 8.88657 14.7289 9.06223 14.5533C9.2379 14.3776 9.44836 14.2898 9.69363 14.2898C9.93889 14.2898 10.1494 14.3776 10.325 14.5533C10.5007 14.7289 10.5885 14.9394 10.5885 15.1847C10.5885 15.3471 10.5471 15.4962 10.4642 15.6321C10.3847 15.768 10.277 15.8774 10.1411 15.9602C10.0085 16.0398 9.85935 16.0795 9.69363 16.0795Z" fill="black"></path>
                </svg> 
            </a>
            <a href="#" class="btn btn_gren"> 
                <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M10.8197 12.0128H5.56472V10.7102H10.7998C11.2506 10.7102 11.6234 10.6357 11.9184 10.4865C12.2134 10.334 12.4321 10.1252 12.5747 9.86009C12.7172 9.59162 12.7884 9.28338 12.7884 8.93537C12.7884 8.59067 12.7172 8.28243 12.5747 8.01065C12.4321 7.73887 12.2151 7.52509 11.9234 7.36932C11.6317 7.21023 11.2638 7.13068 10.8197 7.13068H8.65208V16H7.12083V5.81818H10.8197C11.5919 5.81818 12.2366 5.95739 12.7536 6.2358C13.274 6.5142 13.6634 6.88873 13.922 7.35938C14.1838 7.83002 14.3147 8.35369 14.3147 8.9304C14.3147 9.51373 14.1821 10.0391 13.917 10.5064C13.6552 10.9704 13.2641 11.3383 12.7437 11.6101C12.2267 11.8786 11.5853 12.0128 10.8197 12.0128ZM10.8943 12.8679V14.1754H5.56472V12.8679H10.8943Z" fill="#0EC18B"></path>
                <rect x="0.75" y="1.25" width="18.5" height="18.5" rx="9.25" stroke="#0EC18B" stroke-width="1.5"></rect>
                </svg> 
                <span>Зафиксировано в рублях</span>
                <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle opacity="0.3" cx="10" cy="10.5" r="9.5" stroke="black"></circle>
                <path opacity="0.3" d="M9.05726 13.1364V13.0767C9.06389 12.4437 9.13018 11.9399 9.25613 11.5653C9.38207 11.1908 9.56105 10.8875 9.79306 10.6555C10.0251 10.4235 10.3035 10.2098 10.6283 10.0142C10.8238 9.89489 10.9995 9.75402 11.1553 9.59162C11.311 9.4259 11.4337 9.23532 11.5232 9.01989C11.616 8.80445 11.6624 8.56581 11.6624 8.30398C11.6624 7.97917 11.5861 7.69744 11.4337 7.45881C11.2812 7.22017 11.0774 7.03622 10.8222 6.90696C10.567 6.7777 10.2836 6.71307 9.97203 6.71307C9.70025 6.71307 9.43842 6.76941 9.18652 6.8821C8.93463 6.99479 8.72417 7.17211 8.55513 7.41406C8.3861 7.65601 8.28832 7.97254 8.26181 8.36364H7.00897C7.03548 7.80019 7.18132 7.31794 7.44647 6.9169C7.71493 6.51586 8.06792 6.20928 8.50542 5.99716C8.94623 5.78504 9.4351 5.67898 9.97203 5.67898C10.5554 5.67898 11.0625 5.79498 11.4933 6.02699C11.9275 6.259 12.2623 6.57718 12.4976 6.98153C12.7362 7.38589 12.8556 7.84659 12.8556 8.36364C12.8556 8.72822 12.7992 9.058 12.6865 9.35298C12.5771 9.64796 12.4181 9.91146 12.2093 10.1435C12.0038 10.3755 11.7552 10.581 11.4635 10.7599C11.1718 10.9422 10.9382 11.1345 10.7625 11.3366C10.5869 11.5355 10.4593 11.7725 10.3797 12.0476C10.3002 12.3227 10.2571 12.6657 10.2504 13.0767V13.1364H9.05726ZM9.69363 16.0795C9.44836 16.0795 9.2379 15.9917 9.06223 15.8161C8.88657 15.6404 8.79874 15.4299 8.79874 15.1847C8.79874 14.9394 8.88657 14.7289 9.06223 14.5533C9.2379 14.3776 9.44836 14.2898 9.69363 14.2898C9.93889 14.2898 10.1494 14.3776 10.325 14.5533C10.5007 14.7289 10.5885 14.9394 10.5885 15.1847C10.5885 15.3471 10.5471 15.4962 10.4642 15.6321C10.3847 15.768 10.277 15.8774 10.1411 15.9602C10.0085 16.0398 9.85935 16.0795 9.69363 16.0795Z" fill="black"></path>
                </svg> 
            </a>
            
        </div> -->
            
        <div class="popup_filter">
            <div class="filter_row">
                
                <!-- District -->
                <?php if ($districts) : ?>
                    <div class="dropdown">
                        <div class="dropdown_title">Округ</div>
                        <div class="dropdown-toggle" >
                            Все округа
                        </div> 
                        <div class="dropdown-menu dicustom-checkbox">
                            <div class="dropdown-search">
                                <input type="text" placeholder="Поиск...">
                            </div>
                            
                            <?php foreach ($districts as $district) : ?>
                                <label class="dropdown-item">
                                    <input  type="checkbox" 
                                            name="ut_district[]" 
                                            value="<?php echo esc_attr($district->name); ?>"
                                            <?php echo ( (isset($_GET['ut_district']) && in_array($district->name, $_GET['ut_district'])) ? 'checked' : '' ); ?>>  
                                    <div class="dicustom-checkbox__label">
                                        <?php echo esc_html($district->name); ?>
                                    </div>
                                </label>
                            <?php endforeach ?>

                        </div>
                    </div>
                <?php endif; ?>
                
                <!-- Site District -->
                <?php if ($site_dstricts) : ?>
                    <div class="dropdown">
                        <div class="dropdown_title">Район</div>
                        <div class="dropdown-toggle" >
                            Все районы
                        </div> 
                        <div class="dropdown-menu dicustom-checkbox">
                            <div class="dropdown-search">
                                <input type="text" placeholder="Поиск...">
                            </div>
                            
                            <?php foreach ($site_dstricts as $site_dstrict) : ?>
                                <label class="dropdown-item">
                                    <input  type="checkbox" 
                                            name="ut_site_dstrict[]" 
                                            value="<?php echo esc_attr($site_dstrict->name); ?>"
                                            <?php echo ( (isset($_GET['ut_site_dstrict']) && in_array($site_dstrict->name, $_GET['ut_site_dstrict'])) ? 'checked' : '' ); ?>>  
                                    <div class="dicustom-checkbox__label">
                                        <?php echo esc_html($site_dstrict->name); ?>
                                    </div>
                                </label>
                            <?php endforeach ?>

                        </div>
                    </div>
                <?php endif; ?>
                
                <!-- Departament -->
                <?php if ($departments) : ?>
                    <div class="dropdown">
                        <div class="dropdown_title">Департамент</div>
                        <div class="dropdown-toggle" >
                            Все департаменты
                        </div> 
                        <div class="dropdown-menu dicustom-checkbox">
                            <div class="dropdown-search">
                                <input type="text" placeholder="Поиск...">
                            </div>
                            
                            <?php foreach ($departments as $department) : ?>
                                <label class="dropdown-item">
                                    <input  type="checkbox" 
                                            name="ut_department[]" 
                                            value="<?php echo esc_attr($department->name); ?>"
                                            <?php echo ( (isset($_GET['ut_department']) && in_array($department->name, $_GET['ut_department'])) ? 'checked' : '' ); ?>>  
                                    <div class="dicustom-checkbox__label">
                                        <?php echo esc_html($department->name); ?>
                                    </div>
                                </label>
                            <?php endforeach ?>

                        </div>
                    </div>
                <?php endif; ?>
                
                <!-- Highway -->
                <?php if ($highways) : ?>
                    <div class="dropdown">
                        <div class="dropdown_title">Шоссе</div>
                        <div class="dropdown-toggle" >
                            Все шоссе
                        </div> 
                        <div class="dropdown-menu dicustom-checkbox">
                            <div class="dropdown-search">
                                <input type="text" placeholder="Поиск...">
                            </div>
                            
                            <?php foreach ($highways as $highway) : ?>
                                <label class="dropdown-item">
                                    <input  type="checkbox" 
                                            name="ut_highway[]" 
                                            value="<?php echo esc_attr($highway->name); ?>"
                                            <?php echo ( (isset($_GET['ut_highway']) && in_array($highway->name, $_GET['ut_highway'])) ? 'checked' : '' ); ?>>  
                                    <div class="dicustom-checkbox__label">
                                        <?php echo esc_html($highway->name); ?>
                                    </div>
                                </label>
                            <?php endforeach ?>

                        </div>
                    </div>
                <?php endif; ?>

                <!-- Area -->
                <div class="dropdown">
                    <div class="dropdown_title">Площадь</div>    
                    <div class="base-range-input__wrap">
                        <div class="base-range-input__label-wrap">
                            <label class="base-range-input__label">
                                <input type="number" min="1" placeholder="от" name="area_from" class="base-range-input__control" value="<?php echo ( (isset($_GET['area_from']) ) ? $_GET['area_from'] : '' ); ?>">
                            </label>
                        </div>
                        <div class="base-range-input__delimiter">- до</div>
                        <div class="base-range-input__label-wrap">
                            <div class="base-range-input__label">
                                <input type="number" min="1" placeholder="" name="area_to" class="base-range-input__control" value="<?php echo ( (isset($_GET['area_to']) ) ? $_GET['area_to'] : '' ); ?>">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bedrooms -->
                <div class="dropdown">
                    <div class="dropdown_title">Количество спален</div>
                    <div class="dropdown-toggle" >
                        Любое
                    </div> 
                    <div class="dropdown-menu dicustom-checkbox">
                        <div class="dropdown-search">
                            <input type="text" placeholder="Поиск...">
                        </div>
                        
                        <?php for ($i = 1; $i <= 15; $i++) : ?>
                            <label class="dropdown-item">
                                <input type="checkbox" name="ut_bedrooms[]" value="<?php echo $i; ?>" <?php echo ( (isset($_GET['ut_bedrooms']) && in_array($i, $_GET['ut_bedrooms'])) ? 'checked' : '' ); ?>>  
                                <div class="dicustom-checkbox__label">
                                    <?php echo $i; ?>
                                </div>
                            </label>
                        <?php endfor; ?>

                    </div>
                </div>
                
                <!-- Rooms -->
                <div class="dropdown">
                    <div class="dropdown_title">Количество комнат</div>
                    <div class="dropdown-toggle" >
                        Любое
                    </div> 
                    <div class="dropdown-menu dicustom-checkbox">
                        <div class="dropdown-search">
                            <input type="text" placeholder="Поиск...">
                        </div>
                        
                        <?php for ($i = 1; $i <= 20; $i++) : ?>
                            <label class="dropdown-item">
                                <input type="checkbox" name="ut_rooms[]" value="<?php echo $i; ?>" <?php echo ( (isset($_GET['ut_rooms']) && in_array($i, $_GET['ut_rooms'])) ? 'checked' : '' ); ?>>  
                                <div class="dicustom-checkbox__label">
                                    <?php echo $i; ?>
                                </div>
                            </label>
                        <?php endfor; ?>

                    </div>
                </div>
                
                <!-- Bathrooms -->
                <div class="dropdown">
                    <div class="dropdown_title">Количество ванных</div>
                    <div class="dropdown-toggle" >
                        Любое
                    </div> 
                    <div class="dropdown-menu dicustom-checkbox">
                        <div class="dropdown-search">
                            <input type="text" placeholder="Поиск...">
                        </div>
                        
                        <?php for ($i = 1; $i <= 20; $i++) : ?>
                            <label class="dropdown-item">
                                <input type="checkbox" name="ut_bathrooms[]" value="<?php echo $i; ?>" <?php echo ( (isset($_GET['ut_bathrooms']) && in_array($i, $_GET['ut_bathrooms'])) ? 'checked' : '' ); ?>>  
                                <div class="dicustom-checkbox__label">
                                    <?php echo $i; ?>
                                </div>
                            </label>
                        <?php endfor; ?>

                    </div>
                </div>
                
                <!-- Floor -->
                <div class="dropdown">
                    <div class="dropdown_title">Этаж</div>    
                    <div class="base-range-input__wrap">
                        <div class="base-range-input__label-wrap">
                            <label class="base-range-input__label">
                                <input type="number" min="1" placeholder="от" name="floor_from" class="base-range-input__control" value="<?php echo ( (isset($_GET['floor_from']) ) ? $_GET['floor_from'] : '' ); ?>">
                            </label>
                        </div>
                        <div class="base-range-input__delimiter">- до</div>
                        <div class="base-range-input__label-wrap">
                            <div class="base-range-input__label">
                                <input type="number" min="1" placeholder="" name="floor_to" class="base-range-input__control" value="<?php echo ( (isset($_GET['floor_to']) ) ? $_GET['floor_to'] : '' ); ?>">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Finishing -->
                <?php if ($finishings) : ?>
                    <div class="dropdown">
                        <div class="dropdown_title">Отделкa</div>
                        <div class="dropdown-toggle" >
                            Все варианты
                        </div> 
                        <div class="dropdown-menu dicustom-checkbox">
                            <div class="dropdown-search">
                                <input type="text" placeholder="Поиск...">
                            </div>
                            
                            <?php foreach ($finishings as $finishing) : ?>
                                <label class="dropdown-item">
                                    <input type="checkbox" name="ut_finishing[]" value="<?php echo esc_attr($finishing->name); ?>" <?php echo ( (isset($_GET['ut_finishing']) && in_array($finishing->name, $_GET['ut_finishing'])) ? 'checked' : '' ); ?>>  
                                    <div class="dicustom-checkbox__label">
                                        <?php echo esc_html($finishing->name); ?>
                                    </div>
                                </label>
                            <?php endforeach; ?>

                        </div>
                    </div>
                <?php endif; ?>

                <!-- Type Market -->
                <div class="dropdown">
                    <div class="dropdown_title">Рынок</div>
                    <div class="dropdown-toggle" >
                        Любое
                    </div> 
                    <div class="dropdown-menu dicustom-checkbox">
                        <div class="dropdown-search">
                            <input type="text" placeholder="Поиск...">
                        </div>

                        <label class="dropdown-item">
                            <input type="checkbox" name="ut_typeMarket[]" value="Новостройки и вторичка" <?php echo ( (isset($_GET['ut_typeMarket']) && in_array('Новостройки и вторичка', $_GET['ut_typeMarket'])) ? 'checked' : '' ); ?>>  
                            <div class="dicustom-checkbox__label">
                                Новостройки и вторичка
                            </div>
                        </label>
                        <label class="dropdown-item">
                            <input type="checkbox" name="ut_typeMarket[]" value="Первичный" <?php echo ( (isset($_GET['ut_typeMarket']) && in_array('Первичный', $_GET['ut_typeMarket'])) ? 'checked' : '' ); ?>>  
                            <div class="dicustom-checkbox__label">
                                Первичный
                            </div>
                        </label>
                        <label class="dropdown-item">
                            <input type="checkbox" name="ut_typeMarket[]" value="Вторичный" <?php echo ( (isset($_GET['ut_typeMarket']) && in_array('Вторичный', $_GET['ut_typeMarket'])) ? 'checked' : '' ); ?>>  
                            <div class="dicustom-checkbox__label">
                                Вторичный
                            </div>
                        </label>

                    </div>
                </div>
                
                <!-- Type -->
                <div class="dropdown">
                    <div class="dropdown_title">Объект</div>
                    <div class="dropdown-toggle" >
                        Все типы
                    </div> 
                    <div class="dropdown-menu dicustom-checkbox">
                        <div class="dropdown-search">
                            <input type="text" placeholder="Поиск...">
                        </div>

                        <label class="dropdown-item">
                            <input type="checkbox" name="ut_type[]" value="Апартаменты" <?php echo ( (isset($_GET['ut_type']) && in_array('Апартаменты', $_GET['ut_type'])) ? 'checked' : '' ); ?>>  
                            <div class="dicustom-checkbox__label">
                                Апартаменты
                            </div>
                        </label>
                        <label class="dropdown-item">
                            <input type="checkbox" name="ut_type[]" value="Арендный бизнес" <?php echo ( (isset($_GET['ut_type']) && in_array('Арендный бизнес', $_GET['ut_type'])) ? 'checked' : '' ); ?>>  
                            <div class="dicustom-checkbox__label">
                                Арендный бизнес
                            </div>
                        </label>
                        <label class="dropdown-item">
                            <input type="checkbox" name="ut_type[]" value="Дом" <?php echo ( (isset($_GET['ut_type']) && in_array('Дом', $_GET['ut_type'])) ? 'checked' : '' ); ?>>  
                            <div class="dicustom-checkbox__label">
                                Дом
                            </div>
                        </label>
                        <label class="dropdown-item">
                            <input type="checkbox" name="ut_type[]" value="Квартира" <?php echo ( (isset($_GET['ut_type']) && in_array('Квартира', $_GET['ut_type'])) ? 'checked' : '' ); ?>>  
                            <div class="dicustom-checkbox__label">
                                Квартира
                            </div>
                        </label>
                        <label class="dropdown-item">
                            <input type="checkbox" name="ut_type[]" value="Лофт" <?php echo ( (isset($_GET['ut_type']) && in_array('Лофт', $_GET['ut_type'])) ? 'checked' : '' ); ?>>  
                            <div class="dicustom-checkbox__label">
                                Лофт
                            </div>
                        </label>
                        <label class="dropdown-item">
                            <input type="checkbox" name="ut_type[]" value="Машиноместо" <?php echo ( (isset($_GET['ut_type']) && in_array('Машиноместо', $_GET['ut_type'])) ? 'checked' : '' ); ?>>  
                            <div class="dicustom-checkbox__label">
                                Машиноместо
                            </div>
                        </label>
                        <label class="dropdown-item">
                            <input type="checkbox" name="ut_type[]" value="Особняк" <?php echo ( (isset($_GET['ut_type']) && in_array('Особняк', $_GET['ut_type'])) ? 'checked' : '' ); ?>>  
                            <div class="dicustom-checkbox__label">
                                Особняк
                            </div>
                        </label>
                        <label class="dropdown-item">
                            <input type="checkbox" name="ut_type[]" value="Пентхаус" <?php echo ( (isset($_GET['ut_type']) && in_array('Пентхаус', $_GET['ut_type'])) ? 'checked' : '' ); ?>>  
                            <div class="dicustom-checkbox__label">
                                Пентхаус
                            </div>
                        </label>
                        <label class="dropdown-item">
                            <input type="checkbox" name="ut_type[]" value="Помещение свободного назначения" <?php echo ( (isset($_GET['ut_type']) && in_array('Помещение свободного назначения', $_GET['ut_type'])) ? 'checked' : '' ); ?>>  
                            <div class="dicustom-checkbox__label">
                                Помещение свободного назначения
                            </div>
                        </label>
                        <label class="dropdown-item">
                            <input type="checkbox" name="ut_type[]" value="Пулл машиномест" <?php echo ( (isset($_GET['ut_type']) && in_array('Пулл машиномест', $_GET['ut_type'])) ? 'checked' : '' ); ?>>  
                            <div class="dicustom-checkbox__label">
                                Пулл машиномест
                            </div>
                        </label>
                        <label class="dropdown-item">
                            <input type="checkbox" name="ut_type[]" value="Резиденция" <?php echo ( (isset($_GET['ut_type']) && in_array('Резиденция', $_GET['ut_type'])) ? 'checked' : '' ); ?>>  
                            <div class="dicustom-checkbox__label">
                                Резиденция
                            </div>
                        </label>
                        <label class="dropdown-item">
                            <input type="checkbox" name="ut_type[]" value="Таунхаус" <?php echo ( (isset($_GET['ut_type']) && in_array('Таунхаус', $_GET['ut_type'])) ? 'checked' : '' ); ?>>  
                            <div class="dicustom-checkbox__label">
                                Таунхаус
                            </div>
                        </label>

                    </div>
                </div>
    
            </div>
            
            <div class="filter_row_btn">
                <button type="submit" class="btn_blue btn_found_posts">Показать <?php echo $wp_query->found_posts; ?></button>
                <a href="<?php echo esc_url($reset_link); ?>" class="btn clear">Сбросить</a> 
            </div> 
        </div> 
    </div>


    <div class="rowfilter_2">

        <input type="checkbox" id="eksklyuziv" name="ut_badges" value="Эксклюзив" <?php echo ( (isset($_GET['ut_badges']) && 'Эксклюзив' == $_GET['ut_badges']) ? 'checked' : '' ); ?>>
        <label class="btn" for="eksklyuziv"> 
            <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M4.99984 3H14.9998L18.3332 8L9.99984 18.8333L1.6665 8L4.99984 3Z" stroke="#00AEF0" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M10 18.8333L13.3333 8L10.8333 3" stroke="#00AEF0" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M9.99984 18.8333L6.6665 8L9.1665 3" stroke="#00AEF0" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M1.6665 8H18.3332" stroke="#00AEF0" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg> 
            <span>Эксклюзив</span>
            <!-- <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle opacity="0.3" cx="10" cy="10.5" r="9.5" stroke="black"/>
                <path opacity="0.3" d="M9.05726 13.1364V13.0767C9.06389 12.4437 9.13018 11.9399 9.25613 11.5653C9.38207 11.1908 9.56105 10.8875 9.79306 10.6555C10.0251 10.4235 10.3035 10.2098 10.6283 10.0142C10.8238 9.89489 10.9995 9.75402 11.1553 9.59162C11.311 9.4259 11.4337 9.23532 11.5232 9.01989C11.616 8.80445 11.6624 8.56581 11.6624 8.30398C11.6624 7.97917 11.5861 7.69744 11.4337 7.45881C11.2812 7.22017 11.0774 7.03622 10.8222 6.90696C10.567 6.7777 10.2836 6.71307 9.97203 6.71307C9.70025 6.71307 9.43842 6.76941 9.18652 6.8821C8.93463 6.99479 8.72417 7.17211 8.55513 7.41406C8.3861 7.65601 8.28832 7.97254 8.26181 8.36364H7.00897C7.03548 7.80019 7.18132 7.31794 7.44647 6.9169C7.71493 6.51586 8.06792 6.20928 8.50542 5.99716C8.94623 5.78504 9.4351 5.67898 9.97203 5.67898C10.5554 5.67898 11.0625 5.79498 11.4933 6.02699C11.9275 6.259 12.2623 6.57718 12.4976 6.98153C12.7362 7.38589 12.8556 7.84659 12.8556 8.36364C12.8556 8.72822 12.7992 9.058 12.6865 9.35298C12.5771 9.64796 12.4181 9.91146 12.2093 10.1435C12.0038 10.3755 11.7552 10.581 11.4635 10.7599C11.1718 10.9422 10.9382 11.1345 10.7625 11.3366C10.5869 11.5355 10.4593 11.7725 10.3797 12.0476C10.3002 12.3227 10.2571 12.6657 10.2504 13.0767V13.1364H9.05726ZM9.69363 16.0795C9.44836 16.0795 9.2379 15.9917 9.06223 15.8161C8.88657 15.6404 8.79874 15.4299 8.79874 15.1847C8.79874 14.9394 8.88657 14.7289 9.06223 14.5533C9.2379 14.3776 9.44836 14.2898 9.69363 14.2898C9.93889 14.2898 10.1494 14.3776 10.325 14.5533C10.5007 14.7289 10.5885 14.9394 10.5885 15.1847C10.5885 15.3471 10.5471 15.4962 10.4642 15.6321C10.3847 15.768 10.277 15.8774 10.1411 15.9602C10.0085 16.0398 9.85935 16.0795 9.69363 16.0795Z" fill="black"/>
            </svg>  -->
        </label>

        <input type="checkbox" id="sale" name="ut_sale" value="1" <?php echo ( (isset($_GET['ut_sale']) && '1' == $_GET['ut_sale']) ? 'checked' : '' ); ?>>
        <label for="sale" class="btn btn_red"> 
            <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M14 6.5L6 14.5" stroke="#E45231" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M7.5 9.5C8.32843 9.5 9 8.82843 9 8C9 7.17157 8.32843 6.5 7.5 6.5C6.67157 6.5 6 7.17157 6 8C6 8.82843 6.67157 9.5 7.5 9.5Z" stroke="#E45231" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M12.5 14.5C13.3284 14.5 14 13.8284 14 13C14 12.1716 13.3284 11.5 12.5 11.5C11.6716 11.5 11 12.1716 11 13C11 13.8284 11.6716 14.5 12.5 14.5Z" stroke="#E45231" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <rect x="0.75" y="1.25" width="18.5" height="18.5" rx="9.25" stroke="#E45231" stroke-width="1.5"/>
            </svg> 
            <span>Скидки</span>
            <!-- <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle opacity="0.3" cx="10" cy="10.5" r="9.5" stroke="black"/>
                <path opacity="0.3" d="M9.05726 13.1364V13.0767C9.06389 12.4437 9.13018 11.9399 9.25613 11.5653C9.38207 11.1908 9.56105 10.8875 9.79306 10.6555C10.0251 10.4235 10.3035 10.2098 10.6283 10.0142C10.8238 9.89489 10.9995 9.75402 11.1553 9.59162C11.311 9.4259 11.4337 9.23532 11.5232 9.01989C11.616 8.80445 11.6624 8.56581 11.6624 8.30398C11.6624 7.97917 11.5861 7.69744 11.4337 7.45881C11.2812 7.22017 11.0774 7.03622 10.8222 6.90696C10.567 6.7777 10.2836 6.71307 9.97203 6.71307C9.70025 6.71307 9.43842 6.76941 9.18652 6.8821C8.93463 6.99479 8.72417 7.17211 8.55513 7.41406C8.3861 7.65601 8.28832 7.97254 8.26181 8.36364H7.00897C7.03548 7.80019 7.18132 7.31794 7.44647 6.9169C7.71493 6.51586 8.06792 6.20928 8.50542 5.99716C8.94623 5.78504 9.4351 5.67898 9.97203 5.67898C10.5554 5.67898 11.0625 5.79498 11.4933 6.02699C11.9275 6.259 12.2623 6.57718 12.4976 6.98153C12.7362 7.38589 12.8556 7.84659 12.8556 8.36364C12.8556 8.72822 12.7992 9.058 12.6865 9.35298C12.5771 9.64796 12.4181 9.91146 12.2093 10.1435C12.0038 10.3755 11.7552 10.581 11.4635 10.7599C11.1718 10.9422 10.9382 11.1345 10.7625 11.3366C10.5869 11.5355 10.4593 11.7725 10.3797 12.0476C10.3002 12.3227 10.2571 12.6657 10.2504 13.0767V13.1364H9.05726ZM9.69363 16.0795C9.44836 16.0795 9.2379 15.9917 9.06223 15.8161C8.88657 15.6404 8.79874 15.4299 8.79874 15.1847C8.79874 14.9394 8.88657 14.7289 9.06223 14.5533C9.2379 14.3776 9.44836 14.2898 9.69363 14.2898C9.93889 14.2898 10.1494 14.3776 10.325 14.5533C10.5007 14.7289 10.5885 14.9394 10.5885 15.1847C10.5885 15.3471 10.5471 15.4962 10.4642 15.6321C10.3847 15.768 10.277 15.8774 10.1411 15.9602C10.0085 16.0398 9.85935 16.0795 9.69363 16.0795Z" fill="black"/>
            </svg>  -->
        </label>

        <!-- <a href="#" class="btn btn_gren"> 
            <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M10.8197 12.0128H5.56472V10.7102H10.7998C11.2506 10.7102 11.6234 10.6357 11.9184 10.4865C12.2134 10.334 12.4321 10.1252 12.5747 9.86009C12.7172 9.59162 12.7884 9.28338 12.7884 8.93537C12.7884 8.59067 12.7172 8.28243 12.5747 8.01065C12.4321 7.73887 12.2151 7.52509 11.9234 7.36932C11.6317 7.21023 11.2638 7.13068 10.8197 7.13068H8.65208V16H7.12083V5.81818H10.8197C11.5919 5.81818 12.2366 5.95739 12.7536 6.2358C13.274 6.5142 13.6634 6.88873 13.922 7.35938C14.1838 7.83002 14.3147 8.35369 14.3147 8.9304C14.3147 9.51373 14.1821 10.0391 13.917 10.5064C13.6552 10.9704 13.2641 11.3383 12.7437 11.6101C12.2267 11.8786 11.5853 12.0128 10.8197 12.0128ZM10.8943 12.8679V14.1754H5.56472V12.8679H10.8943Z" fill="#0EC18B"/>
            <rect x="0.75" y="1.25" width="18.5" height="18.5" rx="9.25" stroke="#0EC18B" stroke-width="1.5"/>
            </svg> 
            <span>Зафиксировано в рублях</span>
            <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle opacity="0.3" cx="10" cy="10.5" r="9.5" stroke="black"/>
            <path opacity="0.3" d="M9.05726 13.1364V13.0767C9.06389 12.4437 9.13018 11.9399 9.25613 11.5653C9.38207 11.1908 9.56105 10.8875 9.79306 10.6555C10.0251 10.4235 10.3035 10.2098 10.6283 10.0142C10.8238 9.89489 10.9995 9.75402 11.1553 9.59162C11.311 9.4259 11.4337 9.23532 11.5232 9.01989C11.616 8.80445 11.6624 8.56581 11.6624 8.30398C11.6624 7.97917 11.5861 7.69744 11.4337 7.45881C11.2812 7.22017 11.0774 7.03622 10.8222 6.90696C10.567 6.7777 10.2836 6.71307 9.97203 6.71307C9.70025 6.71307 9.43842 6.76941 9.18652 6.8821C8.93463 6.99479 8.72417 7.17211 8.55513 7.41406C8.3861 7.65601 8.28832 7.97254 8.26181 8.36364H7.00897C7.03548 7.80019 7.18132 7.31794 7.44647 6.9169C7.71493 6.51586 8.06792 6.20928 8.50542 5.99716C8.94623 5.78504 9.4351 5.67898 9.97203 5.67898C10.5554 5.67898 11.0625 5.79498 11.4933 6.02699C11.9275 6.259 12.2623 6.57718 12.4976 6.98153C12.7362 7.38589 12.8556 7.84659 12.8556 8.36364C12.8556 8.72822 12.7992 9.058 12.6865 9.35298C12.5771 9.64796 12.4181 9.91146 12.2093 10.1435C12.0038 10.3755 11.7552 10.581 11.4635 10.7599C11.1718 10.9422 10.9382 11.1345 10.7625 11.3366C10.5869 11.5355 10.4593 11.7725 10.3797 12.0476C10.3002 12.3227 10.2571 12.6657 10.2504 13.0767V13.1364H9.05726ZM9.69363 16.0795C9.44836 16.0795 9.2379 15.9917 9.06223 15.8161C8.88657 15.6404 8.79874 15.4299 8.79874 15.1847C8.79874 14.9394 8.88657 14.7289 9.06223 14.5533C9.2379 14.3776 9.44836 14.2898 9.69363 14.2898C9.93889 14.2898 10.1494 14.3776 10.325 14.5533C10.5007 14.7289 10.5885 14.9394 10.5885 15.1847C10.5885 15.3471 10.5471 15.4962 10.4642 15.6321C10.3847 15.768 10.277 15.8774 10.1411 15.9602C10.0085 16.0398 9.85935 16.0795 9.69363 16.0795Z" fill="black"/>
            </svg> 
        </a>  -->

    </div>
</form>