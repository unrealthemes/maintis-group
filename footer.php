<?php 
$logo_id = get_field('logo_footer', 'option');
$phone = get_field('phone_footer', 'option');
$soc_network = get_field('soc_network_footer', 'option');
$form = get_field('form_footer', 'option');
?>
	
	</main>
		<footer> 
			<div class="container">
				<div class="row_di">
					<div class="footer_top">
						<div class="footer_top_row">
							<div class="footer_left">

								<?php if ( $logo_id ) : ?>
									<div class="footer_logo">
										<a href="<?php echo esc_url( home_url('/') ); ?>" rel="home">
											<?php 
												$logo_url = wp_get_attachment_url( $logo_id, 'full' );
												if ( get_post_mime_type($logo_id) == 'image/svg+xml' ) :
													echo file_get_contents( $logo_url );
												else :
													echo '<img src="' . $logo_url . '" alt="Mantis Group logo">';
												endif;
											?>
										</a>
									</div> 
								<?php endif; ?> 

								<?php if ($phone) : ?>
									<div class="footer_tel"> 
										<a href="tel:<?php echo esc_attr($phone); ?>">
											<?php echo esc_html($phone); ?>
										</a> 
									</div>
								<?php endif; ?>

								<?php if ($soc_network) : ?>
									<div class="footer_soc">
										<?php echo $soc_network; ?>
									</div>
								<?php endif; ?>

								<?php if ( $form ) : ?>
									<div class="footer_btn">
										<a data-fancybox data-src="#write_us" href="javascript:;" class="btn">
											Написать нам
										</a>
									</div>
								<?php endif; ?>

							</div>
							<div class="footer_menu">
								<div>
									<div class="footer_menu_title">
										<?php echo ut_get_title_menu_by_location('footer_1'); ?>
									</div>
									<?php
										if ( has_nav_menu('footer_1') ) {
											wp_nav_menu( [
												'theme_location' => 'footer_1',
												'container'      => false,
												// 'walker'         => new UT_Mega_Menu(),
												'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
											] );
										}
									?> 
								</div>
								<div>
									<div class="footer_menu_title">
										<?php echo ut_get_title_menu_by_location('footer_2'); ?>
									</div>
									<?php
										if ( has_nav_menu('footer_2') ) {
											wp_nav_menu( [
												'theme_location' => 'footer_2',
												'container'      => false,
												// 'walker'         => new UT_Mega_Menu(),
												'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
											] );
										}
									?> 
								</div>
								<div>
									<div class="footer_menu_title">
										<?php echo ut_get_title_menu_by_location('footer_3'); ?>
									</div>
									<?php
										if ( has_nav_menu('footer_3') ) {
											wp_nav_menu( [
												'theme_location' => 'footer_3',
												'container'      => false,
												// 'walker'         => new UT_Mega_Menu(),
												'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
											] );
										}
									?> 
								</div>
								<div>
									<div class="footer_menu_title">
										<?php echo ut_get_title_menu_by_location('footer_4'); ?>
									</div>
									<?php
										if ( has_nav_menu('footer_4') ) {
											wp_nav_menu( [
												'theme_location' => 'footer_4',
												'container'      => false,
												// 'walker'         => new UT_Mega_Menu(),
												'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
											] );
										}
									?> 
								</div>
							</div> 
						</div>
					</div>
					<div class="footer_niz">
						<?php
							if ( has_nav_menu('copyright') ) {
								wp_nav_menu( [
									'theme_location' => 'copyright',
									'container'      => false,
									// 'walker'         => new UT_Mega_Menu(),
									'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
								] );
							}
						?> 
					</div>
				</div>
			</div>
		</footer>

		<div id="back-to-top" title="Back to top">
			<svg width="16" height="8" viewBox="0 0 16 8" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M15 6.5L8 1.5L1 6.5" stroke="#00AEF0" stroke-width="2"></path>
			</svg>
		</div>

		<?php 
		// include modal
		if ( $form ) : 
			get_template_part('template-parts/modals/write-us', null, ['form' => $form]);
		endif; 
		?>
		
		<?php wp_footer(); ?>

    </body>
</html>   