<?php

/**
 * filter Block Template.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'filter-' . $block['id'];

if ( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'home_block';
if ( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

if ( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// $title = get_field('title_ms');
// $blocks = get_field('blocks_ms');
?>

<?php if ( !empty( $_POST['query']['preview'] ) ) : ?>

    <figure>
        <img src="<?php echo THEME_URI; ?>/img/gutenberg-preview/filter.png" alt="Preview" style="width:100%;">
    </figure>

<?php else : ?>

    <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">  
        <div class="row_di"> 
            <div class="tabs">
                <ul> 
                    <li>Городская</li>
                    <li>Загородная</li>
                    <li>ОАЭ</li>
                    <li>Коммерческая</li>
                </ul>
                <div class="tabs_content">
                    <div>
                        <div class="catalog_filter_top_wrap"> 
               
                            <div class="catalog_filter_top_row"> 

                                <div class="filter">
                                    <div class="prod_checbox">   
                                        <input type="radio" id="radio1" name="radios" value="Продажа" checked>
                                        <label for="radio1">Продажа</label> 
                                        <input type="radio" id="radio2" name="radios" value="Аренда">
                                        <label for="radio2">Аренда</label>  
                                    </div> 
                                </div>

                                <div class="dropdown">
                                    <div class="dropdown-toggle" >
                                        Новостройки и вторичка 
                                    </div> 
                                    <div class="dropdown-menu dicustom-checkbox">
                                        <div class="dropdown-search">
                                            <input type="text" placeholder="Поиск...">
                                        </div>
                                    
                                        <label class="dropdown-item"><input type="checkbox"   value="Новостройки и вторичка">  
                                            <div class="dicustom-checkbox__label">
                                                Новостройки и вторичка
                                            </div>
                                            </label>
                                        <label class="dropdown-item"><input type="checkbox" value="Новостройки">  
                                            <div class="dicustom-checkbox__label">
                                                Новостройки
                                            </div>
                                            </label>
                                        <label class="dropdown-item"><input type="checkbox" value="Вторичка">  
                                            <div class="dicustom-checkbox__label">
                                                Вторичка
                                            </div>
                                            </label>
                                    </div>
                                </div>

                                <div class="dropdown dropdown_2">
                                        <div class="dropdown-toggle" >
                                            Все типы
                                        </div> 
                                        <div class="dropdown-menu dicustom-checkbox">
                                            <div class="dropdown-search">
                                                <input type="text" placeholder="Поиск...">
                                            </div>
                                        
                                            <label class="dropdown-item"><input type="checkbox" value="Все типы">  
                                                <div class="dicustom-checkbox__label">
                                                    Все типы
                                                </div>
                                                </label>
                                            <label class="dropdown-item"><input type="checkbox" value="Тип 1">  
                                                <div class="dicustom-checkbox__label">
                                                    Тип 1
                                                </div>
                                                </label>
                                            <label class="dropdown-item"><input type="checkbox" value="Тип 2">  
                                                <div class="dicustom-checkbox__label">
                                                    Тип 2
                                                </div>
                                                </label>
                                            <label class="dropdown-item"><input type="checkbox" value="Тип 3">  
                                                <div class="dicustom-checkbox__label">
                                                    Тип 3
                                                </div>
                                                </label>
                                        </div>
                                </div>
                                
                                <div class="dropdown dropdown_3">
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
                                </div>

                            </div>
                              
                            <div class="catalog_filter_niz_row">
 
                                <div class="base-range-input__wrap">
                                    <div class="base-range-input__label-wrap">
                                        <label class="base-range-input__label">
                                            <input placeholder="Цена от" class="base-range-input__control">
                                        </label>
                                    </div>
                                    
                                    <div class="base-range-input__delimiter">- до</div>
                                    
                                    <div class="base-range-input__label-wrap">
                                        <div class="base-range-input__label">
                                            <input placeholder="" class="base-range-input__control">
                                        </div>
                                    </div>
                                    <div class="base-currency">
                                        <button type="button" class="base-currency__btn"> ₽ </button>
                                        <div class="base-currency__dropdown">
                                            <button type="button" class="base-currency__dropdown-item"> ₽ </button>
                                            <button type="button" class="base-currency__dropdown-item"> $ </button>
                                            <button type="button" class="base-currency__dropdown-item"> € </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="base-range-input__wrap">
                                    <div class="base-range-input__label-wrap">
                                        <label class="base-range-input__label">
                                            <input placeholder="Цена от" class="base-range-input__control">
                                        </label>
                                    </div>
                                    
                                    <div class="base-range-input__delimiter">- до</div>
                                    
                                    <div class="base-range-input__label-wrap">
                                        <div class="base-range-input__label">
                                            <input placeholder="" class="base-range-input__control">
                                        </div>
                                    </div>
                                    <div class="base-size">
                                        м²
                                    </div>
                                </div>
                                
                                <button class="btn_blue">Показать 2086</button>
                            </div>    
                        </div>
                    </div>
                    <div>Второе содержимое</div>
                    <div>Третье содержимое</div>
                    <div>4 содержимое</div>
                </div>
            </div>
        </div>
        
        <div class="row home_cat">
            <a href="#">Квартиры жк вишневый сад</a>
            <a href="#">Купить квартиру в центре москвы</a>
            <a href="#">Квартиры жк садовые кварталы</a>
            <a href="#">Двухуровневые квартиры в москве</a>
            <a href="#">Купить лофт в Москве</a>
            <a href="#">Купить квартиру на патриарших прудах </a>
            <a href="#">Купить пентхаус в москве</a>
            <a href="#">Двухуровневые апартаменты купить</a>
            <a href="#">Купить апартаменты в москва сити</a>
        </div>
        
    </div>

<?php endif; ?>


