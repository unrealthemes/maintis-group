<?php

/**
 * about-complex Block Template.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'about-complex-' . $block['id'];

if ( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'block_white o_komplecse';
if ( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

if ( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// $about-complex = get_field('txt_about-complex');
?>

<?php if ( !empty( $_POST['query']['preview'] ) ) : ?>

    <figure>
        <img src="<?php echo THEME_URI; ?>'/img/gutenberg-preview/realestate/about-complex.png'" alt="Preview" style="width:100%;">
    </figure>

<?php else : ?>

    <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">  
        <h3>О комплексе</h3>
        <ul>
            <li><span>Класс комплекса</span> <strong>Deluxe</strong></li>
            <li><span>Паркинг</span></li>
            <li><span>Видеонаблюдение</span></li>
            <li><span>Огороженная территория</span></li>
            <li><span>Пожарная сигнализация</span></li>
            <li><span>Количество машиномест</span><strong>22</strong></li> 
            <li><span>Ландшафтное озеленение</span></li>
            <li><span>Охрана</span></li>
            <li><span>Благоустроенный внутренний двор</span></li> 
        </ul>
    </div> 

<?php endif; ?>


