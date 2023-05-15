<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package unreal-themes
 */

get_header();

global $wp_query;

$params = [];
$find_txt = 'Найдено ' . ut_num_decline( $wp_query->found_posts, [ 'объект', 'объекта', 'объектов' ] );

// echo '<pre style="background:red;color:#fff;">';
// print_r( $wp_query );
// echo '</pre>';

?>

	<div class="container">

		<div class="page_header">  
			<div class="breadcrumb"> 
				<?php do_action( 'echo_kama_breadcrumbs' ); ?>
			</div>
			<div class="block_title">
				<?php the_archive_title( '<h1>', '</h1>' ); ?>
			</div>
		</div>

		<?php get_template_part('template-parts/realestate/filter-panel'); ?>

		<div class=" object_container cat_block">
            <div class="row_di"> 
                 
                <div class="cat_short_object"> 
                    <div class="block_title">
                        <h3><?php echo $find_txt; ?></h3> 
                    </div>        
                    
					<?php if ( have_posts() ) : ?>

						<div class="cat_short">

							<?php get_template_part('template-parts/realestate/sort'); ?>
							
							<div class="tabs"> 
			
								<ul> 
									<li>
										<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path opacity="0.9" d="M8.33333 2.5H2.5V8.33333H8.33333V2.5Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
											<path opacity="0.9" d="M17.4998 2.5H11.6665V8.33333H17.4998V2.5Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
											<path opacity="0.9" d="M17.4998 11.6667H11.6665V17.5H17.4998V11.6667Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
											<path opacity="0.9" d="M8.33333 11.6667H2.5V17.5H8.33333V11.6667Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
										</svg>
										<span>Плиткой</span>
									</li>
									<li id="init_map_filter">
										<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M2.5 5L7.5 2.5L12.5 5L17.5 2.5V15L12.5 17.5L7.5 15L2.5 17.5V5Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
											<path d="M7.5 2.5V15" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
											<path d="M12.5 5V17.5" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
										</svg> 
										<span>На карте</span>
									</li> 
								</ul>

								<?php // if ( have_posts() ) : ?>

									<div class="tabs_content">

										<div> 
											<div class="row_di">
												<div class="row_10_di object_list">

													<?php
													while ( have_posts() ) :
														the_post();
														get_template_part('template-parts/realestate/realestate', 'item');
														$lat = get_field('latitude', get_the_ID());
														$lng = get_field('longitude', get_the_ID());
														
														if ( $lat && $lng ) :
															$params[] = [ $lat, $lng ];
														endif;
													endwhile;
													?>
													
												</div>

												<!-- <div class="load_more_btn">
													<a class="learn_morebtn btn" href="#">Показать еще</a>
												</div>  -->

												<?php 
												the_posts_pagination([
													'prev_text' => '',
													'next_text' => '',
												]); 
												?>

											</div> 
											
										</div>

										<div>
											<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=0e22f693-ee8a-440d-96d7-df33d2b9e0a2" ></script>
											<div id="yandex-map-filter" 
												style="height:600px;width:100%;"
												data-status=""
												data-params="<?php echo esc_attr( wp_json_encode($params) ); ?>"
											>
												<img src="<?php echo THEME_URI; ?>/img/map-preloader.gif" alt="Map preloader">
											</div>
										</div>
										
									</div>

								<?php // else : ?>

									<?php // get_template_part( 'template-parts/content', 'none' ); ?>

								<?php // endif; ?>
										
							</div> 
						</div>   

					<?php endif; ?>

                </div>
            </div>
        </div>  

		<?php if ( get_the_archive_description() ) : ?>
			<div class="home_block cat_text">
            	<div class="row_di">
					<?php the_archive_description(); ?>
				</div>   
			</div> 
		<?php endif; ?>

		<?php get_template_part('template-parts/realestate/recently-viewed'); ?>

	</div>

<?php
get_footer();