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

$site_dstricts = get_terms( 'site_dstrict', [
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
                    
                    <input type="radio" id="radio1" name="dealType" value="Продажа" checked>
                    <label for="radio1">Продажа</label> 

                    <input type="radio" id="radio2" name="dealType" value="Аренда">
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