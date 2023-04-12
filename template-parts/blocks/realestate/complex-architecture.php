<?php

/**
 * complex-architecture Block Template.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'complex-architecture-' . $block['id'];

if ( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'tabs_litle arhi';
if ( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

if ( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// $complex-architecture = get_field('txt_complex-architecture');
?>

<?php if ( !empty( $_POST['query']['preview'] ) ) : ?>

    <figure>
        <img src="<?php echo THEME_URI; ?>'/img/gutenberg-preview/realestate/complex-architecture.png'" alt="Preview" style="width:100%;">
    </figure>

<?php else : ?>

    <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">  
        <h3>Архитектура комплекса</h3>
        <div class="tabs"> 
            <ul> 
                <li>
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path opacity="0.9" d="M12.0834 2.33334H7.91675L5.83341 4.83334H3.33341C2.89139 4.83334 2.46746 5.00894 2.1549 5.3215C1.84234 5.63406 1.66675 6.05798 1.66675 6.50001V14C1.66675 14.442 1.84234 14.866 2.1549 15.1785C2.46746 15.4911 2.89139 15.6667 3.33341 15.6667H16.6667C17.1088 15.6667 17.5327 15.4911 17.8453 15.1785C18.1578 14.866 18.3334 14.442 18.3334 14V6.50001C18.3334 6.05798 18.1578 5.63406 17.8453 5.3215C17.5327 5.00894 17.1088 4.83334 16.6667 4.83334H14.1667L12.0834 2.33334Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path opacity="0.9" d="M10 12.3333C11.3807 12.3333 12.5 11.2141 12.5 9.83334C12.5 8.45263 11.3807 7.33334 10 7.33334C8.61929 7.33334 7.5 8.45263 7.5 9.83334C7.5 11.2141 8.61929 12.3333 10 12.3333Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg> 
                    <span>Фото</span>
                </li>
                <li>
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_36_1394)">
                            <path d="M9.16675 15.8333H3.33341C2.89139 15.8333 2.46746 15.6577 2.1549 15.3451C1.84234 15.0326 1.66675 14.6087 1.66675 14.1666V5.83329C1.66675 5.39127 1.84234 4.96734 2.1549 4.65478C2.46746 4.34222 2.89139 4.16663 3.33341 4.16663H7.50008" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M10.8333 4.16663H16.6666C17.1086 4.16663 17.5325 4.34222 17.8451 4.65478C18.1577 4.96734 18.3333 5.39127 18.3333 5.83329V14.1666C18.3333 14.6087 18.1577 15.0326 17.8451 15.3451C17.5325 15.6577 17.1086 15.8333 16.6666 15.8333H12.4999" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M10 12.5C11.3807 12.5 12.5 11.3807 12.5 10C12.5 8.61929 11.3807 7.5 10 7.5C8.61929 7.5 7.5 8.61929 7.5 10C7.5 11.3807 8.61929 12.5 10 12.5Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M15 18.3334L12.5 15.8334L15 13.3334" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M5 1.66663L7.5 4.16663L5 6.66663" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </g>
                        <defs>
                            <clipPath id="clip0_36_1394">
                                <rect width="20" height="20" fill="white"/>
                            </clipPath>
                        </defs>
                    </svg> 
                    <span>Панорама улицы</span>
                </li> 
            </ul>
            <div class="tabs_content">
                <div>
                    <div class="item_galery"> 
                        <div id="arhi_carousel" class="owl-carousel owl-theme">
                            <div class="item">
                                <img src="<?php echo THEME_URI; ?>/img/image6.jpg" alt="" />
                            </div>
                            <div class="item">
                                <img src="<?php echo THEME_URI; ?>/img/Screenshot_1.png" alt="" />
                            </div>
                            <div class="item">
                                <img src="<?php echo THEME_URI; ?>/img/image6.jpg" alt="" />
                            </div>
                            <div class="item">
                                <img src="<?php echo THEME_URI; ?>/img/image6.jpg" alt="" />
                            </div>
                            <div class="item">
                                <img src="<?php echo THEME_URI; ?>/img/image6.jpg" alt="" />
                            </div>
                            <div class="item">
                                <img src="<?php echo THEME_URI; ?>/img/image6.jpg" alt="" />
                            </div>
                            <div class="item">
                                <img src="<?php echo THEME_URI; ?>/img/image6.jpg" alt="" />
                            </div>
                            <div class="item">
                                <img src="<?php echo THEME_URI; ?>/img/image6.jpg"  alt="" />
                            </div>
                        </div> 
                    </div>
                </div>
                <div>Панорама улицы</div> 
            </div>
            <p>Компания создана в 1999 году как инновационный и динамичный бренд в сфере элитной недвижимости Москвы. Kalinka – многократный победитель авторитетной международной премии International Property Awards. Удельный вес на рынке элитной жилой недвижимости Москвы – 25%, на рынке консалтинговых услуг – 85%. Экосистема Kalinka включает несколько бизнес-юнитов.</p>
            <p>Мы ежедневно работаем с покупателями и продавцами элитной недвижимости, знаем весь путь клиента от первого обращения до заключения сделки. Более 60% проектов в элитном сегменте рынка Москвы реализованы с участием Kalinka Consulting. Жилые комплексы «Поклонная 9» и Victory Park Residences</p>
        </div>
    </div>

<?php endif; ?>


