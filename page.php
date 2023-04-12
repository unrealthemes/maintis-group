<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package unreal-themes
 */

get_header();

	while ( have_posts() ) :
		the_post();
		?>

		<div class="container">
            <div class="row_di">
				<div class="simple_page">
					<div class="simple_page_content">
						<?php the_content(); ?>
					</div>
				</div>
			</div>
		</div>

		<?php
	endwhile;

get_footer();