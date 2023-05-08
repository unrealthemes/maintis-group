<?php 
// $args = [
//     'post_type' => 'realestate',
//     'post_status' => 'publish',
//     'posts_per_page' => -1,
//     'tax_query' => [
//         [
//             'taxonomy' => 'city',
//             'field' => 'name',
//             'terms' => 'Москва',
//         ]
//     ]
// ];
// $loop = new WP_Query( $args );
// wp_reset_postdata(); 

$highways = get_terms( 'highway', [
    'orderby' => 'name',
    'order' => 'ASC',
    'hide_empty' => 1,
] ); 
?>

<form id="realestate_block_form" action="<?php echo home_url('/city/moskva/'); ?>" method="get">

    <input type="hidden" name="ut_city[]" value="Москва">

    <div class="catalog_filter_top_wrap"> 

        <div class="catalog_filter_top_row"> 

            <div class="filter">
                <div class="prod_checbox">   
                    
                    <input type="radio" id="radio1" name="dealType" value="Продажа" <?php echo ( (isset($_GET['dealType']) && 'Продажа' == $_GET['dealType']) ? 'checked' : '' ); ?>>
                    <label for="radio1">Продажа</label> 

                    <input type="radio" id="radio2" name="dealType" value="Аренда" <?php echo ( (isset($_GET['dealType']) && 'Аренда' == $_GET['dealType']) ? 'checked' : '' ); ?>>
                    <label for="radio2">Аренда</label> 

                </div> 
            </div>

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
            
            <!-- <div class="dropdown dropdown_3">
                <div class="dropdown-toggle">
                    Все районы
                </div> 
                <div class="dropdown-menu dicustom-checkbox">
                    <div class="dropdown-search">
                        <input type="text" placeholder="Поиск...">
                    </div>
                    
                    <label class="dropdown-item"><input type="checkbox" value="Все районы 1">  
                        <div class="dicustom-checkbox__label">
                            Все районы 1
                        </div>
                        </label>
                    <label class="dropdown-item"><input type="checkbox" value="Все районы 2">  
                        <div class="dicustom-checkbox__label">
                            Все районы 2
                        </div>
                        </label>
                    <label class="dropdown-item"><input type="checkbox" value="Все районы 3">  
                        <div class="dicustom-checkbox__label">
                            Все районы 3
                        </div>
                        </label>
                    <label class="dropdown-item"><input type="checkbox" value="Все районы 4">  
                        <div class="dicustom-checkbox__label">
                            Все районы
                        </div>
                    </label>
                </div>
            </div> -->

        </div>
            
        <div class="catalog_filter_niz_row">

            <!-- Price -->
            <div class="base-range-input__wrap">
                <div class="base-range-input__label-wrap">
                    <label class="base-range-input__label">
                        <input type="number" min="1" name="price_from" placeholder="Цена от" class="base-range-input__control">
                    </label>
                </div>
                
                <div class="base-range-input__delimiter">- до</div>
                
                <div class="base-range-input__label-wrap">
                    <div class="base-range-input__label">
                        <input type="number" min="1" name="price_to" placeholder="" class="base-range-input__control">
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
                <div class="base-size">
                    м²
                </div>
            </div>
            
            <button type="submit" class="btn_blue btn_block_found_posts">Показать <?php // echo $loop->found_posts; ?></button>
        </div>    
    </div>
</form>