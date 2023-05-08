<?php 
$current_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$options = [
    'popular' => 'Популярные',
    'price_low_high' => 'Увеличение цены',
    'price_high_low' => 'Уменьшение цены',
    'date' => 'По дате',
    'alphabet_a_z' => 'По названию от А до Я',
    'alphabet_z_a' => 'По названию от Я до А',
];
?>

<div class="mobile_short">
    <select name="sort" id="sort">

        <?php foreach ($options as $slug => $option) : ?>
            <option value="<?php echo $slug; ?>" <?php echo ( (isset($_GET['sort']) && $slug == $_GET['sort']) ? 'selected' : '' ); ?>>
                <?php echo $option; ?>
            </option>
        <?php endforeach; ?>

    </select>
    <a href="#" class="block_button" onclick="return false">
        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M9.1665 4.16666H17.4998" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M9.1665 7.5H14.9998" stroke="blackopen_popup" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M9.1665 10.8333H12.4998" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M2.5 14.1667L5 16.6667L7.5 14.1667" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M5 15V3.33334" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg> 

        <?php if ( isset($_GET['sort']) && ! empty($_GET['sort']) ) : ?>
            <span>
                <?php echo $options[ $_GET['sort'] ]; ?>
            </span>
        <?php else : ?>
            <span>Сортировка</span>
        <?php endif; ?>

    </a> 
    <div class="big">

        <?php foreach ($options as $slug => $option) : ?>

            <a href="<?php echo $current_link . '&sort=' . $slug; ?>">
                <?php echo $option; ?>
            </a>

        <?php endforeach; ?>

    </div>  
</div>