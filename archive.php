<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package orange
 */

get_header(); 
orange_archive_banner();
?>

	
<div id="primary" class="content-area">
	<main id="main" class="site-main">
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<div class="main_blog_area">
					<?php
					if ( have_posts() ) :

						/* Start the Loop */
						while ( have_posts() ) : the_post();

							/*
							 * Include the Post-Format-specific template for the content.
							 * If you want to override this in a child theme, then include a file
							 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
							 */
							get_template_part( 'template-parts/content', get_post_format() );

						endwhile;

						the_posts_pagination();

					else :

						get_template_part( 'template-parts/content', 'none' );

					endif; ?>
					</div> 
				</div> <!-- End Col  -->
				
				<div class="col-md-4">
					<div class="main_sidebar_area">
						<?php get_sidebar();?>
					</div>
				</div><!-- End Col  -->
			</div>
		</div>
	</main><!-- #main -->
</div><!-- #primary -->
<?php

get_footer();
