<?php 
$m_slider = get_field('slider_re');
$map = get_field('map_slider_re');
$plan_slider = get_field('plan_slider_re');
?>

<div class="tabs_litle tabs_galery"> 
    <div class="tabs"> 
       
        <ul> 

            <?php if ($m_slider) : ?>
                <li>
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path opacity="0.9" d="M12.0834 2.33334H7.91675L5.83341 4.83334H3.33341C2.89139 4.83334 2.46746 5.00894 2.1549 5.3215C1.84234 5.63406 1.66675 6.05798 1.66675 6.50001V14C1.66675 14.442 1.84234 14.866 2.1549 15.1785C2.46746 15.4911 2.89139 15.6667 3.33341 15.6667H16.6667C17.1088 15.6667 17.5327 15.4911 17.8453 15.1785C18.1578 14.866 18.3334 14.442 18.3334 14V6.50001C18.3334 6.05798 18.1578 5.63406 17.8453 5.3215C17.5327 5.00894 17.1088 4.83334 16.6667 4.83334H14.1667L12.0834 2.33334Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path opacity="0.9" d="M10 12.3333C11.3807 12.3333 12.5 11.2141 12.5 9.83334C12.5 8.45263 11.3807 7.33334 10 7.33334C8.61929 7.33334 7.5 8.45263 7.5 9.83334C7.5 11.2141 8.61929 12.3333 10 12.3333Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg> 
                    <span>Фото</span>
                </li>
            <?php endif; ?>

            <?php if ($map) : ?>
                <li>
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.5 5L7.5 2.5L12.5 5L17.5 2.5V15L12.5 17.5L7.5 15L2.5 17.5V5Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M7.5 2.5V15" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M12.5 5V17.5" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg> 
                    <span>На карте</span>
                </li>
            <?php endif; ?>

            <?php if ($plan_slider) : ?>
                <li>
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M14 17.5H15.8333C16.7538 17.5 17.5 16.7538 17.5 15.8333V4.16667C17.5 3.24619 16.7538 2.5 15.8333 2.5L4.16667 2.5C3.24619 2.5 2.5 3.24619 2.5 4.16667L2.5 15.8333C2.5 16.7538 3.24619 17.5 4.16667 17.5H10" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M2.5 7.5L17.5 7.5" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M7.5 17.5L7.5 7.5" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg> 
                    <span>Планировка</span>
                </li> 
            <?php endif; ?>

        </ul>

        <div class="tabs_content">

            <?php if ($m_slider) : ?>
                <div>
                    <div class="item_galery"> 
                        <div id="sync1" class="owl-carousel owl-theme">

                            <?php 
                            foreach ($m_slider as $m_slider_img_id) : 
                                $m_slider_img_url = wp_get_attachment_url( $m_slider_img_id, 'full' );
                            ?>
                                <div class="item">
                                    <img src="<?php echo $m_slider_img_url; ?>" alt="Main slider" />
                                </div>
                            <?php endforeach; ?>

                        </div>
                        
                        <div id="sync2" class="owl-carousel owl-theme">

                            <?php 
                            foreach ($m_slider as $m_slider_img_id) : 
                                $m_slider_img_url = wp_get_attachment_url( $m_slider_img_id, 'medium' );
                            ?>
                                <div class="item">
                                    <img src="<?php echo $m_slider_img_url; ?>" alt="Main slider" />
                                </div>
                            <?php endforeach; ?>

                        </div>
                    
                    </div>
                </div>
            <?php endif; ?>

            <?php if ($map) : ?>
                <div>
                    <?php echo $map; ?>
                </div>
            <?php endif; ?>
            
            <?php if ($plan_slider) : ?>
                <div>
                    <div class="item_galery"> 
                        <div id="sync3" class="owl-carousel owl-theme">

                            <?php 
                            foreach ($plan_slider as $plan_slider_img_id) : 
                                $plan_slider_img_url = wp_get_attachment_url( $plan_slider_img_id, 'full' );
                            ?>
                                <div class="item">
                                    <img src="<?php echo $plan_slider_img_url; ?>" alt="Plan slider" />
                                </div>
                            <?php endforeach; ?>

                        </div>
                        
                        <div id="sync4" class="owl-carousel owl-theme">

                            <?php 
                            foreach ($plan_slider as $plan_slider_img_id) : 
                                $plan_slider_img_url = wp_get_attachment_url( $plan_slider_img_id, 'medium' );
                            ?>
                                <div class="item">
                                    <img src="<?php echo $plan_slider_img_url; ?>" alt="Plan slider" />
                                </div>
                            <?php endforeach; ?>

                        </div>
                    
                    </div>
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>