<?php 
$show = get_field('characteristics_re');

if ($show) : 
    $ceiling_height = get_field('ceilingHeight');
    $area = get_field('area');
    $area_land = get_field('areaLand');
    $rooms = get_field('rooms');
    $bedrooms = get_field('bedrooms');
    $bathrooms = get_field('bathrooms');
    $floor = get_field('floor');
    $total_floor = get_field('totalFloor');
    $balcony_quantity = get_field('balconyQuantity');
    $fireplace = get_field('fireplace');
    $cabinet = get_field('cabinet');
    $terrace = get_field('terrace');
    $lake = get_field('lake');
    $forest = get_field('forest');
    $swimming_pool = get_field('swimmingPool');
    $number_of_levels = get_field('numberOfLevels');
    $parking_quantity = get_field('parkingQuantity');
    $type_market = get_field('typeMarket');
    $distance_to_mkad = get_field('distanceToMkad');
    $investment_potentsial = get_field('investmentPotentsial');
?>
    <div class="block_white o_komplecse">
        <h3>О комплексе</h3>
        <ul>

            <?php if ($ceiling_height) : ?>
                <li>
                    <span>
                        Высота потолков
                    </span>
                    <strong>
                        <?php echo $ceiling_height; ?>
                    </strong>
                </li> 
            <?php endif; ?>
            
            <?php if ($area) : ?>
                <li>
                    <span>
                        Площадь
                    </span>
                    <strong>
                        <?php echo $area; ?> м<sup>2</sup>
                    </strong>
                </li> 
            <?php endif; ?>
            
            <?php if ($area_land) : ?>
                <li>
                    <span>
                        Площадь земли
                    </span>
                    <strong>
                        <?php echo $area_land; ?>
                    </strong>
                </li> 
            <?php endif; ?>
            
            <?php if ($rooms) : ?>
                <li>
                    <span>
                        Комнаты
                    </span>
                    <strong>
                        <?php echo $rooms; ?>
                    </strong>
                </li> 
            <?php endif; ?>
            
            <?php if ($bedrooms) : ?>
                <li>
                    <span>
                        Спальни
                    </span>
                    <strong>
                        <?php echo $bedrooms; ?>
                    </strong>
                </li> 
            <?php endif; ?>
            
            <?php if ($bathrooms) : ?>
                <li>
                    <span>
                        Ванные 
                    </span>
                    <strong>
                        <?php echo $bathrooms; ?>
                    </strong>
                </li> 
            <?php endif; ?>
           
            <?php if ($floor) : ?>
                <li>
                    <span>
                        Этаж 
                    </span>
                    <strong>
                        <?php 
                        if ($total_floor) :
                            echo $floor . '/' . $total_floor; 
                        else :
                            echo $floor; 
                        endif;
                        ?>
                    </strong>
                </li> 
            <?php endif; ?>

            <?php if ($balcony_quantity) : ?>
                <li>
                    <span>
                        Балконы 
                    </span>
                    <strong>
                        <?php echo $balcony_quantity; ?>
                    </strong>
                </li> 
            <?php endif; ?>
            
            <?php if ($fireplace) : ?>
                <li>
                    <span>
                        Камин 
                    </span>
                </li> 
            <?php endif; ?>
            
            <?php if ($cabinet) : ?>
                <li>
                    <span>
                        Кабинет 
                    </span>
                </li> 
            <?php endif; ?>
            
            <?php if ($terrace) : ?>
                <li>
                    <span>
                        Терраса 
                    </span>
                </li> 
            <?php endif; ?>
            
            <?php if ($lake) : ?>
                <li>
                    <span>
                        Озеро 
                    </span>
                </li> 
            <?php endif; ?>
            
            <?php if ($forest) : ?>
                <li>
                    <span>
                        Лес 
                    </span>
                </li> 
            <?php endif; ?>
            
            <?php if ($swimming_pool) : ?>
                <li>
                    <span>
                        Басейн 
                    </span>
                </li> 
            <?php endif; ?>

            <?php if ($number_of_levels) : ?>
                <li>
                    <span>
                        Количество уровней 
                    </span>
                    <strong>
                        <?php echo $number_of_levels; ?>
                    </strong>
                </li> 
            <?php endif; ?>
            
            <?php if ($parking_quantity) : ?>
                <li>
                    <span>
                        Парковка
                    </span>
                    <strong>
                        <?php echo $parking_quantity; ?>
                    </strong>
                </li> 
            <?php endif; ?>
           
            <?php if ($type_market) : ?>
                <li>
                    <span>
                        Рынок
                    </span>
                    <strong>
                        <?php echo $type_market; ?>
                    </strong>
                </li> 
            <?php endif; ?>
           
            <?php if ($distance_to_mkad) : ?>
                <li>
                    <span>
                        До МКАД
                    </span>
                    <strong>
                        <?php echo $distance_to_mkad; ?>
                    </strong>
                </li> 
            <?php endif; ?>
           
            <?php if ($investment_potentsial) : ?>
                <li>
                    <span>
                        Инвестиционный потенциал
                    </span>
                    <strong>
                        <?php echo $investment_potentsial; ?>
                    </strong>
                </li> 
            <?php endif; ?>

        </ul>
    </div>
<?php endif; ?>