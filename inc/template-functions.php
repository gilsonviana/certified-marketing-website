<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Orange
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function orange_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'orange_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function orange_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'orange_pingback_header' );

function orange_header(){
global $orange;

$orange_preloader_opt					 = '';
$orange_homepage_opt					 = '';

if ( isset( $orange['orange_preloader_opt'] ) ) {
	$orange_preloader_opt = $orange['orange_preloader_opt'];
}
if ( isset( $orange['orange_homepage_opt'] ) ) {
	$orange_homepage_opt = $orange['orange_homepage_opt'];
}	
$orange_custom_logo_id = get_theme_mod( 'custom_logo' );
$orange_custom_logo = wp_get_attachment_image_src( $orange_custom_logo_id , 'full' );	
	
?>


	<?php if($orange_preloader_opt == '1' && !$orange_homepage_opt == '1') { ?>
		
	<!-- START PRELOADER -->
		<div class="preloader">
			<div class="status">
				<div class="status-mes"></div>
			</div>
		</div>
	<!-- END PRELOADER -->	

<?php }elseif($orange_preloader_opt == '1' && $orange_homepage_opt == '1'){ ?>	

<?php if(is_front_page()) {?>
	<!-- START PRELOADER -->
	<div class="preloader">
		<div class="status">
			<div class="status-mes"></div>
		</div>
	</div>
	<!-- END PRELOADER -->	
<?php } } ?>	

<!-- START NAVBAR -->
<div class="navbar navbar-default navbar-fixed-top menu-top">
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only"><?php esc_html_e('Toggle navigation' , 'orange');?></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					
					<?php if(get_custom_logo()){ ?>
						<a class="navbar-brand" href="<?php echo esc_url(home_url('/'));?>"><img src="<?php echo esc_url($orange_custom_logo[0]);?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"></a>          
					<?php }else{ ?>	
						<a class="navbar-brand" href="<?php echo esc_url(home_url('/'));?>"><img src="<?php echo esc_url(get_template_directory_uri());?>/assets/img/logo.png" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"></a>          
					<?php } ?>	
				
				</div>
			</div>
			<div class="col-md-9">
				<div class="navbar-collapse collapse">
					<nav class="mainmenu">
						<?php orange_main_menu();?>
					</nav>
				</div>	
			</div>
		</div> 
	</div><!--- END CONTAINER -->
</div> 	
<!-- END NAVBAR -->			
<?php	
}

function orange_fot_bg_url(){
global $orange;

$orange_footer_bg_img					 = '';	

if ( isset( $orange['orange_footer_bg_img']['url'] ) ) {
	$orange_footer_bg_img = $orange['orange_footer_bg_img']['url'];
}

$orange_default_bg= get_template_directory_uri() . '/assets/img/bg/contact-bg.jpg';

	if($orange_footer_bg_img){
		echo esc_url($orange_footer_bg_img);
	}else{
		echo esc_url($orange_default_bg);
	}

}


function orange_footer(){
global $orange;

$orange_footer_email_address					 = '';
$orange_footer_phone_number					 = '';
$orange_footer_address_info					 = '';
$orange_footer_fb_link					 = '';
$orange_footer_tw_link					 = '';
$orange_footer_gplus_link					 = '';
$orange_footer_linke_link					 = '';
$orange_footer_youtube_link					 = '';
$orange_footer_skype_link					 = '';
$orange_copywrite_text					 = '';

if ( isset( $orange['orange_footer_email_address'] ) ) {
	$orange_footer_email_address = $orange['orange_footer_email_address'];
}
if ( isset( $orange['orange_footer_phone_number'] ) ) {
	$orange_footer_phone_number = $orange['orange_footer_phone_number'];
}
if ( isset( $orange['orange_footer_address_info'] ) ) {
	$orange_footer_address_info = $orange['orange_footer_address_info'];
}
if ( isset( $orange['orange_footer_fb_link'] ) ) {
	$orange_footer_fb_link = $orange['orange_footer_fb_link'];
}
if ( isset( $orange['orange_footer_tw_link'] ) ) {
	$orange_footer_tw_link = $orange['orange_footer_tw_link'];
}
if ( isset( $orange['orange_footer_gplus_link'] ) ) {
	$orange_footer_gplus_link = $orange['orange_footer_gplus_link'];
}
if ( isset( $orange['orange_footer_linke_link'] ) ) {
	$orange_footer_linke_link = $orange['orange_footer_linke_link'];
}
if ( isset( $orange['orange_footer_youtube_link'] ) ) {
	$orange_footer_youtube_link = $orange['orange_footer_youtube_link'];
}
if ( isset( $orange['orange_footer_skype_link'] ) ) {
	$orange_footer_skype_link = $orange['orange_footer_skype_link'];
}

if ( isset( $orange['orange_copywrite_text'] ) ) {
	$orange_copywrite_text = $orange['orange_copywrite_text'];
}
	
?>
<!-- START ADDRESS  -->
<section class="contact-address section-padding" style="background-image: url(<?php echo orange_fot_bg_url();?>); background-size:cover; background-position: center center;background-attachment:fixed;">
	<div class="container">
		<div class="row">
			<div class="col-md-offset-3 text-center col-xs-12 col-md-6">
				<div class="address">
					
					<h2>
						<?php if($orange_footer_email_address){
							echo esc_html($orange_footer_email_address);
						}else{ ?>
							<?php esc_html_e('example@example.com' , 'orange');?>
						<?php } ?>
					</h2>
					<h1>
						<?php if($orange_footer_phone_number){
							echo esc_html($orange_footer_phone_number);
						}else{ ?>
							<?php esc_html_e('1234-123-123' , 'orange');?>
						<?php } ?>					

					</h1>
					<h3>
						<?php if($orange_footer_address_info){
							echo orange_wp_kses($orange_footer_address_info);
						}else{ ?>
							<?php esc_html_e('3481 Melrose Place, Beverly Hills CA 90210' , 'orange');?>
						<?php } ?>						
										
					</h3>
				</div>
				<div class="footer_social">
					<ul>
						<?php if($orange_footer_fb_link){ ?>
							<li><a class="f_facebook" href="<?php echo esc_url($orange_footer_fb_link);?>"><i class="fa fa-facebook"></i></a></li>
						<?php } if($orange_footer_tw_link){ ?>
							<li><a class="f_twitter" href="<?php echo esc_url($orange_footer_tw_link);?>"><i class="fa fa-twitter"></i></a></li>
						<?php } if($orange_footer_gplus_link){ ?>
							<li><a class="f_google" href="<?php echo esc_url($orange_footer_gplus_link);?>"><i class="fa fa-instagram"></i></a></li>
						<?php } if($orange_footer_linke_link){ ?>
							<li><a class="f_linkedin" href="<?php echo esc_url($orange_footer_linke_link);?>"><i class="fa fa-linkedin"></i></a></li>
						<?php }if($orange_footer_youtube_link){ ?>
							<li><a class="f_youtube" href="<?php echo esc_url($orange_footer_youtube_link);?>"><i class="fa fa-youtube"></i></a></li>
						<?php } if($orange_footer_skype_link){ ?>
							<li><a class="f_skype" href="<?php echo esc_url($orange_footer_skype_link);?>"><i class="fa fa-skype"></i></a></li>
						<?php } ?>
					
					</ul>
				</div>
				<div class="footer_copyright">
					<p>
						<?php if($orange_copywrite_text){
							echo orange_wp_kses($orange_copywrite_text);
						}else{ ?>
							<?php esc_html_e('&copy; 2017 orange. All Rights Reserved.' , 'orange');?>
						<?php } ?>					
					
					
					</p>
				</div>
			</div><!-- END COL  -->
		</div><!--END  ROW  -->
	</div><!-- END CONTAINER  -->
</section>
<!-- END ADDRESS -->

<?php	
}



function orange_banner_url_option(){
global $orange;
$orange_home_banner_img						 = '';

if ( isset( $orange['orange_home_banner_img']['url'] ) ) {
	$orange_home_banner_img = $orange['orange_home_banner_img']['url'];
}
$orange_default_bannar_image = get_template_directory_uri() . '/assets/img/bg/banner-bg.jpg';
$orange_meta_upload_bannar = get_post_meta(get_the_ID(), '_orange_banner_img', true);
	
	 if($orange_meta_upload_bannar){
		 echo esc_url($orange_meta_upload_bannar);
		}elseif($orange_home_banner_img){
			echo esc_url($orange_home_banner_img);
		}else{ 
		echo esc_url($orange_default_bannar_image);
	}
}

function orange_banner_img_opt(){
	global $orange;
	
	$orange_banner_opt					 = '';

	if ( isset( $orange['orange_banner_opt'] ) ) {
		$orange_banner_opt = $orange['orange_banner_opt'];
	}
	
	return $orange_banner_opt;
	
}

function orange_blog_banner(){ 
global $orange;

$orange_blog_page_text					 = '';

if ( isset( $orange['orange_blog_page_text'] ) ) {
	$orange_blog_page_text = $orange['orange_blog_page_text'];
}

?>
	<!-- START TITLE TOP -->
	<section class="section-content section-padding" <?php if(orange_banner_img_opt() == '1'){ ?>style="background-image: url(<?php orange_banner_url_option();?>); "<?php } ?>>	
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">

					<?php if($orange_blog_page_text){ ?>
						<h1 class="section-blog-title"><?php echo esc_html($orange_blog_page_text);?></h1>
					<?php }else{ ?>
						<h1 class="section-blog-title"><?php esc_html_e('Blog ' , 'orange'); ?></h1>
					<?php } ?>
						<p><a href="<?php echo esc_url(home_url('/'));?>"><?php esc_html_e('Home - ' , 'orange');?></a> <?php if($orange_blog_page_text){ echo esc_html($orange_blog_page_text);}else{ esc_html_e('Blog ' , 'orange'); }?></p>	
								
				</div>
			</div>
		</div>
	</section>
	<!-- END TITLE TOP -->	
<?php }


function orange_shop_banner(){ 
global $orange;

$orange_shop_page_text					 = '';

if ( isset( $orange['orange_shop_page_text'] ) ) {
	$orange_shop_page_text = $orange['orange_shop_page_text'];
}

?>
	<!-- START TITLE TOP -->
	<section class="section-content section-padding" <?php if(orange_banner_img_opt() == '1'){ ?>style="background-image: url(<?php orange_banner_url_option();?>); "<?php } ?>>	
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					<h1 class="section-blog-title">
					<?php 
						if(is_shop()){	
							if($orange_shop_page_text){
								echo esc_html($orange_shop_page_text);
							}else{
								esc_html_e('Shop' ,'keeway');
							}
							
						}else{
							the_title();
						}
				
					?>
					</h1>
					
					<p><a href="<?php echo esc_url(home_url('/'));?>"><?php esc_html_e('Home - ' , 'orange');?></a> <?php if($orange_shop_page_text){ echo esc_html($orange_shop_page_text);}else{ esc_html_e('Shop ' , 'orange'); }?></p>	
								
				</div>
			</div>
		</div>
	</section>
	<!-- END TITLE TOP -->	
<?php }

function orange_archive_banner(){ 
global $orange;

$orange_archive_text					 = '';


if ( isset( $orange['orange_archive_text'] ) ) {
	$orange_archive_text = $orange['orange_archive_text'];
}

?>
	<!-- START TITLE TOP -->
	<section class="section-content section-padding" <?php if(orange_banner_img_opt() == '1'){ ?>style="background-image: url(<?php orange_banner_url_option();?>); "<?php } ?>>
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					<?php if($orange_archive_text){ ?>
						<h1 class="section-blog-title"><?php echo esc_html($orange_archive_text);?></h1>
					<?php }else{ ?>
						<h1 class="section-blog-title"><?php esc_html_e('Archive ' , 'orange'); ?></h1>
					<?php } ?>
						<p><a href="<?php echo esc_url(home_url('/'));?>"><?php esc_html_e('Home - ' , 'orange');?></a> <?php the_archive_title();?></p>	
			
				</div>
			</div>
		</div>
	</section>
	<!-- END TITLE TOP -->	
<?php }


function orange_search_banner(){ 
global $orange;

$orange_search_text					 = '';

if ( isset( $orange['orange_search_text'] ) ) {
	$orange_search_text = $orange['orange_search_text'];
}
?>
	<!-- START TITLE TOP -->
	<section class="section-content section-padding" <?php if(orange_banner_img_opt() == '1'){ ?>style="background-image: url(<?php orange_banner_url_option();?>); "<?php } ?>>
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
			
					<?php if($orange_search_text){ ?>
						<h1 class="section-blog-title"><?php echo esc_html($orange_search_text);?></h1>
					<?php }else{ ?>
						<h1 class="section-blog-title"><?php esc_html_e('Search ' , 'orange'); ?></h1>
					<?php } ?>
					<p><a href="<?php echo esc_url(home_url('/'));?>"><?php esc_html_e('Home - ' , 'orange');?></a> <?php echo esc_html(get_search_query());?></p>	
								
				</div>
			</div>
		</div>
	</section>
	<!-- END TITLE TOP -->	
<?php }

function orange_404_banner(){ 
global $orange;

$orange_404_text					 = '';
$orange_404_content					 = '';

if ( isset( $orange['orange_404_text'] ) ) {
	$orange_404_text = $orange['orange_404_text'];
}

if ( isset( $orange['orange_404_content'] ) ) {
	$orange_404_content = $orange['orange_404_content'];
}

?>
	<!-- START TITLE TOP -->
	<section class="section-content section-padding" <?php if(orange_banner_img_opt() == '1'){ ?>style="background-image: url(<?php orange_banner_url_option();?>); "<?php } ?>>	
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
			
					<h1 class="section-blog-title">
					<?php 
						if($orange_404_text){
							echo esc_html($orange_404_text); 
						}else{
							esc_html_e('404 ' , 'orange'); 
						}
						
					?>
					</h1>
					<p><a href="<?php echo esc_url(home_url('/'));?>"><?php esc_html_e('Home - ' , 'orange');?></a> 
					<?php 
						if($orange_404_content){
							echo esc_html($orange_404_content);
						}else{
							esc_html_e('Content Not Found' , 'orange');
						}

					?></p>	
							
				</div>
			</div>
		</div>
	</section>
	<!-- END TITLE TOP -->	
<?php }



function orange_single_banner(){ 

?>
	<!-- START TITLE TOP -->
	<section class="section-content section-padding" <?php if(orange_banner_img_opt() == '1'){ ?>style="background-image: url(<?php orange_banner_url_option();?>); "<?php } ?>>
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					<h1 class="section-blog-title"><?php the_title();?></h1>
					<p><a href="<?php echo esc_url(home_url('/'));?>"><?php esc_html_e('Home - ' , 'orange');?></a> <?php the_title();?></p>	
									
				</div>
			</div>
		</div>
	</section>
	<!-- END TITLE TOP -->	
<?php }

function orange_author(){
	echo '<a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a>';
} 
