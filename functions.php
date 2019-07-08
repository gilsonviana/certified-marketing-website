<?php
/**
 * Orange functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Orange
 */

define( 'ORANGEDIRPATH' , get_template_directory_uri());
 
if ( ! function_exists( 'orange_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function orange_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Orange, use a find and replace
		 * to change 'orange' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'orange', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'orange_image_370_420', 370,420, true );
		add_image_size( 'orange_image_1920_1200', 1920,1200, true );
		add_image_size( 'orange_image_1200_800', 1200,800, true );
		add_image_size( 'orange_image_90_90', 90,90, true );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'orange' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'orange_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		add_theme_support( 'post-formats', array(
			'audio',
			'video',
		) );	
			
		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/*
		 * Set woocommerce support  
		 * 
		 */
		add_theme_support( 'woocommerce' );	
		
		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
	add_editor_style( array( 'assets/css/editor-style.css' , orange_google_fonts_url()) );
endif;
add_action( 'after_setup_theme', 'orange_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function orange_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'orange_content_width', 640 );
}
add_action( 'after_setup_theme', 'orange_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function orange_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'orange' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'orange' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'orange_widgets_init' );

/**
 *
 * Registering Google Fonts
 *
 */


 function orange_google_fonts_url() {

    $font_url = '';

    if ( 'off' !== _x( 'on', 'Google font: on or off', 'orange' ) ) {
        $font_url = add_query_arg( 'family', urlencode( 'Roboto|Raleway:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic|Raleway:400,100,200,300,600,500,700,800,900&subset=latin,latin-ext' ), "//fonts.googleapis.com/css" );
    }

    return $font_url;

}

/**
 * Enqueue scripts and styles.
 */
function orange_scripts() {
global $orange;

$orange_scroll_opt					 = '';

if ( isset( $orange['orange_scroll_opt'] ) ) {
	$orange_scroll_opt = $orange['orange_scroll_opt'];
}
	
	wp_enqueue_style( 'orange-google-fonts', orange_google_fonts_url(), array(), null );
	wp_enqueue_style('bootstrap' , ORANGEDIRPATH. '/assets/bootstrap/css/bootstrap.min.css');
	wp_enqueue_style('themify-icons' , ORANGEDIRPATH. '/assets/fonts/themify-icons.css');
	wp_enqueue_style('font-awesome' , ORANGEDIRPATH. '/assets/fonts/font-awesome.min.css');
	wp_enqueue_style('owl-carousel' , ORANGEDIRPATH. '/assets/owlcarousel/css/owl.carousel.css');
	wp_enqueue_style('owl-theme' , ORANGEDIRPATH. '/assets/owlcarousel/css/owl.theme.css');
	wp_enqueue_style('magnific-popup' , ORANGEDIRPATH. '/assets/css/magnific-popup.css');
	wp_enqueue_style('aos' , ORANGEDIRPATH. '/assets/css/aos.css');
	wp_enqueue_style('orange-main-style' , ORANGEDIRPATH. '/assets/css/style.css');
	wp_enqueue_style( 'orange-style', get_stylesheet_uri() );

	// Load JS Files
	wp_enqueue_script( 'html5shiv', ORANGEDIRPATH . '/js/html5shiv.min.js', array(), '3.7.2' );	
	wp_script_add_data( 'html5shiv', 'conditional', 'lt IE 9' ); 	
	wp_enqueue_script( 'respond', ORANGEDIRPATH . '/js/respond.min.js', array(), '1.4.2' );
	wp_script_add_data( 'respond', 'conditional', 'lt IE 9' );
	
	wp_enqueue_script( 'bootstrap', ORANGEDIRPATH . '/assets/bootstrap/js/bootstrap.min.js', array('jquery'), '9685', true );
	wp_enqueue_script( 'modernizr', ORANGEDIRPATH . '/assets/js/modernizr-2.8.3.min.js', array('jquery'), '9685', true );
	wp_enqueue_script( 'owl-carousel', ORANGEDIRPATH . '/assets/owlcarousel/js/owl.carousel.min.js', array('jquery'), '9685', true );
	wp_enqueue_script( 'magnific-popup', ORANGEDIRPATH . '/assets/js/jquery.magnific-popup.min.js', array('jquery'), '9685', true );
	wp_enqueue_script( 'mixitup', ORANGEDIRPATH . '/assets/js/jquery.mixitup.min.js', array('jquery'), '9685', true );
	wp_enqueue_script( 'jquery-stellar', ORANGEDIRPATH . '/assets/js/jquery.stellar.min.js', array('jquery'), '9685', true );
	
	if($orange_scroll_opt == true){
		wp_enqueue_script( 'scrolltopcontrol', ORANGEDIRPATH . '/assets/js/scrolltopcontrol.js', array('jquery'), '9685', true );
	}
	
	wp_enqueue_script( 'aos', ORANGEDIRPATH . '/assets/js/aos.js', array('jquery'), '9685', true );
	wp_enqueue_script( 'ripples-min', ORANGEDIRPATH . '/assets/js/ripples-min.js', array('jquery'), '9685', true );
	wp_enqueue_script( 'scripts', ORANGEDIRPATH . '/assets/js/scripts.js', array('jquery'), '9685', true );
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'orange_scripts' );


function orange_main_menu() {
		wp_nav_menu( array(
		'theme_location'    => 'menu-1',
		'depth'             => 5,
		'container'         => false,
		'menu_class'        => 'nav navbar-nav navbar-right',
		'fallback_cb'       => 'orange_navwalker::fallback',
		
		)
	); 	
}

function orange_wp_kses($val){
	return wp_kses($val, array(
	
	'p' => array(),
	'span' => array(),
	'div' => array(),
	'strong' => array(),
	'b' => array(),
	'br' => array(),
	'h1' => array(),
	'i' => array(
		'class' =>array()
	),	
	'ul' => array(
		'class' =>array()
	),	
	'ul' => array(
		'id' =>array()
	),	
	'li' => array(
		'class' =>array()
	),	
	'li' => array(
		'id' =>array()
	),
	'h2' => array(),
	'h3' => array(),
	'h4' => array(),
	'h5' => array(),
	'h6' => array(),
	'a'=> array('href' => array(),'target' => array()),
	'iframe'=> array('src' => array(),'height' => array(),'width' => array()),
	
	), '');
}

// modify search widget
function orange_my_search_form( $form ) {
	$form = '
		
			
			<form role="search" method="get" id="searchform" class="searchform" action="' . esc_url(home_url( '/' )) . '" >
				<div class="input-group">
					<input type="text" value="' . esc_attr(get_search_query()) . '" name="s" id="s" class="form-control search_field" placeholder="' . esc_attr__('Search...' , 'orange') .'">
					<span class="input-group-btn">
						<button class="btn btn-default search_btn" type="submit"><i class="fa fa-search"></i></button>
					</span>
				</div>
			</form>
			
		
        ';
	return $form;
}
add_filter( 'get_search_form', 'orange_my_search_form' );

// comment list modify

function orange_comments($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>

<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
	<div class="single_comment">
		<div class="row">
      
      <?php if(get_avatar($comment)){ ?>
			<div class="col-md-2">
				<div class="comment_avatar">
					<?php echo get_avatar( $comment, 80 ); ?>
				</div>
			</div>
			<?php } ?>
      
			<div class="col-md-10">
				<div class="text-left comment_content">				
					<h5 class="comment_title"><?php comment_author_link() ?> <span><?php echo esc_html(' - '); echo esc_html(get_comment_date('F j, Y')); ?> <?php echo esc_html(get_comment_date('g:i')); ?></span></h5>
					<?php if ($comment->comment_approved == '0') : ?>
					<p><em><?php esc_html_e('Your comment is awaiting modeorangen.','orange'); ?></em></p>
					<?php endif; ?>
					 <div class="main_comment_text"><?php comment_text(); ?></div>	
					<div class="creply_link"> <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?></div>					 
				</div>
			</div>
		</div>
		
	</div>				
</li>


<?php } 

// comment box title change
add_filter( 'comment_form_defaults', 'orange_remove_comment_form_allowed_tags' );
function orange_remove_comment_form_allowed_tags( $defaults ) {

	$defaults['comment_notes_after'] = '';
	$defaults['comment_notes_before'] = '';
	return $defaults;

}

function orange_comment_reform ($arg) {

$arg['title_reply'] = esc_html__('Write your comment Here','orange');
$arg['comment_field'] = '<div class="row"><div class="form-group col-md-12"><textarea id="comment" class="comment_field form-control" name="comment" cols="77" rows="3" placeholder="'. esc_html__("Write your Comment", "orange").'" aria-required="true"></textarea></div></div>';


return $arg;

}
add_filter('comment_form_defaults','orange_comment_reform');

// comment form modify

function orange_modify_comment_form_fields($fields){
	$commenter = wp_get_current_commenter();
	$req	   = get_option( 'require_name_email' );

	$fields['author'] = '<div class="row"><div class="form-group col-md-4"><input type="text" name="author" id="author" value="'. esc_attr( $commenter['comment_author'] ) .'" placeholder="'. esc_attr__("Your Name *", "orange").'" size="22" tabindex="1"'. ( $req ? 'aria-required="true"' : '' ).' class="input-name form-control" /></div>';

	$fields['email'] = '<div class="form-group col-md-4"><input type="text" name="email" id="email" value="'. esc_attr( $commenter['comment_author_email'] ) .'" placeholder="'.esc_attr__("Your Email *", "orange").'" size="22" tabindex="2"'. ( $req ? 'aria-required="true"' : '' ).' class="input-email form-control"  /></div>';
	
	$fields['url'] = '<div class="form-group col-md-4"><input type="text" name="url" id="url" value="'. esc_attr( $commenter['comment_author_url'] ) .'" placeholder="'. esc_attr__("Website", "orange").'" size="22" tabindex="2"'. ( $req ? 'aria-required="false"' : '' ).' class="input-url form-control"  /></div></div>';

	return $fields;
}
add_filter('comment_form_default_fields','orange_modify_comment_form_fields');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Navwalker additions.
 */
require get_template_directory() . '/inc/navwalker.php';

/* Call Files */
require get_template_directory() . '/inc/class-tgm-plugin-activation.php';
require get_template_directory() . '/inc/install-plugin.php';
require get_template_directory() . '/inc/demo_install.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}
function orange_excerpt_length( $length ) {
    return 33;
}
add_filter( 'excerpt_length', 'orange_excerpt_length', 999 );

