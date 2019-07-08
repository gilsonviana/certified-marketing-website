<?php


// File Security Check
if ( ! defined( 'ABSPATH' ) ) {
   exit;
}

get_header();
orange_shop_banner();

?>

<div id="primary" class="content-area">
	<main id="main" class="site-main">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="main_blog_area">
						<?php
						if ( have_posts() ) :
							woocommerce_content();
						endif;
						?>

					</div> 
				</div> <!-- End Col  -->
				

			</div>
		</div>
	</main><!-- #main -->
</div><!-- #primary -->
  
<?php
get_footer();
?>
