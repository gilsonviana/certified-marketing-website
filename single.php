<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package orange
 */

get_header(); 
orange_single_banner();
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main">
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<div class="main_blog_area">
						<?php
						while ( have_posts() ) : the_post();

							get_template_part( 'template-parts/content', get_post_format() );
							
							?>
							<center>
							<?php previous_post_link( '<span class="orange_preview_post">%link</span>', esc_html('Previous Post' , 'orange'), TRUE );?>
							<?php next_post_link( '<span class="orange_next_post">%link</span>', esc_html('Next Post' , 'orange'), TRUE );?>
							</center>
							<?php

							// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ) :
								comments_template();
							endif;

						endwhile; // End of the loop.
						?>

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
