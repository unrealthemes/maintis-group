<?php 
$slider = get_field('slider_arh_re');
$desc = get_field('desc_arh_re');
?>

<?php if ($desc) : ?>
    <div class="tabs_litle infa"> 
        <h3>Инфрастуктура района</h3>
        <div class="tabs"> 
            <!-- <ul> 
                <li>Рестораны</li>
                <li>Кафе</li>
                <li>Супермаркеты</li>
                <li>Торговые центры</li> 
            </ul>
            <div class="tabs_content">
                <div> <img src="../img/map2.jpg" alt="" /> </div>
                <div>Кафе</div> 
                <div>Супермаркеты</div> 
                <div>Торговые центры</div> 
            </div> -->
            
            <?php echo $desc; ?>

        </div>
    </div>
<?php endif; ?>