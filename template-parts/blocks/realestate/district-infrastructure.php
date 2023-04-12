<?php

/**
 * district-infrastructure Block Template.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'district-infrastructure-' . $block['id'];

if ( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'tabs_litle infa';
if ( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

if ( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// $district-infrastructure = get_field('txt_district-infrastructure');
?>

<?php if ( !empty( $_POST['query']['preview'] ) ) : ?>

    <figure>
        <img src="<?php echo THEME_URI; ?>'/img/gutenberg-preview/realestate/district-infrastructure.png'" alt="Preview" style="width:100%;">
    </figure>

<?php else : ?>

    <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">  
        <h3>Инфрастуктура района</h3>
        <div class="tabs"> 
            <ul> 
                <li>Рестораны</li>
                <li>Кафе</li>
                <li>Супермаркеты</li>
                <li>Торговые центры</li> 
            </ul>
            <div class="tabs_content">
                <div> 
                    <img src="<?php echo THEME_URI; ?>/img/map2.jpg" alt="" />
                </div>
                <div>Кафе</div> 
                <div>Супермаркеты</div> 
                <div>Торговые центры</div> 
            </div>
            <p>Компания создана в 1999 году как инновационный и динамичный бренд в сфере элитной недвижимости Москвы. Kalinka – многократный победитель авторитетной международной премии International Property Awards. Удельный вес на рынке элитной жилой недвижимости Москвы – 25%, на рынке консалтинговых услуг – 85%. Экосистема Kalinka включает несколько бизнес-юнитов.</p>
            <p>Мы ежедневно работаем с покупателями и продавцами элитной недвижимости, знаем весь путь клиента от первого обращения до заключения сделки. Более 60% проектов в элитном сегменте рынка Москвы реализованы с участием Kalinka Consulting. Жилые комплексы «Поклонная 9» и Victory Park Residences</p>
        </div>
    </div>

<?php endif; ?>


