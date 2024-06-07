<?php 
/**
 * Nail Salon Lite functions and definitions
 *
 * @package Nail Salon Lite
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! function_exists( 'nail_salon_lite_setup' ) ) : 
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function nail_salon_lite_setup() {
	$GLOBALS['content_width'] = apply_filters( 'nail_salon_lite_content_width', 640 );
	load_theme_textdomain( 'nail-salon-lite', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support('woocommerce');
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'title-tag' );
	add_post_type_support( 'page', 'excerpt' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
	add_theme_support( 'custom-logo', array(
		'height'      => 55,
		'width'       => 150,
		'flex-height' => true,
	) );	
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'nail-salon-lite' )			
	) );
	add_theme_support( 'custom-background', array(
		'default-color' => 'ffffff'
	) );
	add_editor_style( 'editor-style.css' );
} 
endif; // nail_salon_lite_setup
add_action( 'after_setup_theme', 'nail_salon_lite_setup' );
function nail_salon_lite_widgets_init() { 	
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'nail-salon-lite' ),
		'description'   => esc_html__( 'Appears on sidebar', 'nail-salon-lite' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',		
		'before_title'  => '<h3 class="widget-title titleborder"><span>',
		'after_title'   => '</span></h3>',
		'after_widget'  => '</aside>',
	) ); 
	
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 1', 'nail-salon-lite' ),
		'description'   => esc_html__( 'Appears on page footer', 'nail-salon-lite' ),
		'id'            => 'fc-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',		
		'before_title'  => '<h5>',
		'after_title'   => '</h5>',
		'after_widget'  => '</aside>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 2', 'nail-salon-lite' ),
		'description'   => esc_html__( 'Appears on page footer', 'nail-salon-lite' ),
		'id'            => 'fc-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',		
		'before_title'  => '<h5>',
		'after_title'   => '</h5>',
		'after_widget'  => '</aside>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 3', 'nail-salon-lite' ),
		'description'   => esc_html__( 'Appears on page footer', 'nail-salon-lite' ),
		'id'            => 'fc-3',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',		
		'before_title'  => '<h5>',
		'after_title'   => '</h5>',
		'after_widget'  => '</aside>',
	) );		
		
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 4', 'nail-salon-lite' ),
		'description'   => esc_html__( 'Appears on page footer', 'nail-salon-lite' ),
		'id'            => 'fc-4',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',		
		'before_title'  => '<h5>',
		'after_title'   => '</h5>',
		'after_widget'  => '</aside>',
	) );		
}
add_action( 'widgets_init', 'nail_salon_lite_widgets_init' );

/**
 * Retrieve webfont URL to load fonts locally.
 */
function nail_salon_lite_get_fonts_url() {
	$font_families = array(
		'Poppins:100,100italic,200,200italic,300,300italic,400,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic',
		'Playfair Display:400,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic',
		'Assistant:200,300,400,500,600,700,800',
	);

	$query_args = array(
		'family'  => urlencode( implode( '|', $font_families ) ),
		'subset'  => urlencode( 'latin,latin-ext' ),
		'display' => urlencode( 'swap' ),
	);

	return apply_filters( 'nail_salon_lite_get_fonts_url', add_query_arg( $query_args, 'https://fonts.googleapis.com/css' ) );
}

add_action( 'wp_enqueue_scripts', 'nail_salon_lite_enqueue_styles' );
function nail_salon_lite_enqueue_styles() {
  wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' ); 
} 

add_action( 'wp_enqueue_scripts', 'nail_salon_lite_child_styles', 99);
function nail_salon_lite_child_styles() {
  wp_enqueue_style( 'nail-salon-lite-child-style', get_stylesheet_directory_uri()."/css/responsive.css" );
} 

function nail_salon_lite_admin_style() {
  wp_enqueue_script('nail-salon-lite-admin-script', get_stylesheet_directory_uri()."/js/nail-salon-lite-admin-script.js");
}
add_action('admin_enqueue_scripts', 'nail_salon_lite_admin_style');

function nail_salon_lite_admin_about_page_css_enqueue($hook) {
   if ( 'appearance_page_nail_salon_lite_guide' != $hook ) {
        return;
    }
    wp_enqueue_style( 'nail-salon-lite-about-page-style', get_stylesheet_directory_uri() . '/css/nail-salon-lite-about-page-style.css' );
}
add_action( 'admin_enqueue_scripts', 'nail_salon_lite_admin_about_page_css_enqueue' );

/**
 * Show notice on theme activation
 */
if ( is_admin() && isset($_GET['activated'] ) && $pagenow == "themes.php" ) {
	add_action( 'admin_notices', 'nail_salon_lite_activation_notice' );
}
function nail_salon_lite_activation_notice(){
    ?>
    <div class="notice notice-info is-dismissible"> 
        <div class="skt-skincare-notice-container">
        	<div class="skt-skincare-notice-img"><img src="<?php echo esc_url( NAIL_SALON_LITE_SKTTHEMES_THEME_URI . 'images/icon-skt-templates.png' ); ?>" alt="<?php echo esc_attr('SKT Templates');?>" ></div>
            <div class="skt-skincare-notice-content">
            <div class="skt-skincare-notice-heading"><?php echo esc_html__('Thank you for installing Nail Salon Lite!', 'nail-salon-lite'); ?></div>
            <p class="largefont"><?php echo esc_html__('Nail Salon Lite comes with 150+ ready to use Elementor templates. Install the SKT Templates plugin to get started.', 'nail-salon-lite'); ?></p>
            </div>
            <div class="skt-skincare-clear"></div>
        </div>
    </div>
    <?php
}


require_once get_stylesheet_directory() . '/class-tgm-plugin-activation.php';
add_action( 'tgmpa_register', 'nail_salon_lite_register_required_plugins' );
 
function nail_salon_lite_register_required_plugins() {
	$plugins = array(
		array(
			'name'      => 'SKT Templates',
			'slug'      => 'skt-templates',
			'required'  => false,
		),
		array(
			'name'      => 'WooCommerce',
			'slug'      => 'woocommerce',
			'required'  => false,
		)
	);

	$config = array(
		'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'skt-install-plugins',   // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}


if ( ! function_exists( 'nail_salon_lite_the_custom_logo' ) ) :
/**
 * Displays the optional custom logo.
 *
 * Does nothing if the custom logo is not available.
 *
 */
function nail_salon_lite_the_custom_logo() {
	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}
}
endif;

define('NAIL_SALON_LITE_SKTTHEMES_URL','https://www.sktthemes.org');
define('NAIL_SALON_LITE_SKTTHEMES_PRO_THEME_URL','https://www.sktthemes.org/shop/nail-salon-wordpress-theme/');
define('NAIL_SALON_LITE_SKTTHEMES_FREE_THEME_URL','https://www.sktthemes.org/shop/free-nail-art-salon-wordpress-theme');
define('NAIL_SALON_LITE_SKTTHEMES_THEME_DOC','https://www.sktthemesdemo.net/documentation/skt-skincare-doc/');
define('NAIL_SALON_LITE_SKTTHEMES_LIVE_DEMO','https://sktperfectdemo.com/themepack/nailsalon/');
define('NAIL_SALON_LITE_SKTTHEMES_THEMES','https://www.sktthemes.org/themes');
define('NAIL_SALON_LITE_SKTTHEMES_THEME_URI', trailingslashit( esc_url( get_template_directory_uri() ) ) );

function nail_salon_lite_remove_parent_function(){	 
	remove_action( 'admin_notices', 'skt_skincare_activation_notice');
	remove_action( 'admin_menu', 'skt_skincare_abouttheme');
	remove_action( 'customize_register', 'skt_skincare_customize_register');
	remove_action( 'wp_enqueue_scripts', 'skt_skincare_custom_css');
	remove_action( 'tgmpa_register', 'skt_skincare_register_required_plugins' );
}
add_action( 'init', 'nail_salon_lite_remove_parent_function' );

function nail_salon_lite_remove_parent_theme_stuff() {
    remove_action( 'after_setup_theme', 'skt_skincare_setup' );
}
add_action( 'after_setup_theme', 'nail_salon_lite_remove_parent_theme_stuff', 0 );

require_once get_stylesheet_directory() . '/inc/about-themes.php';  
require_once get_stylesheet_directory() . '/inc/customizer.php'; 

add_action( 'wp_enqueue_scripts', 'nail_salon_lite_custom_enqueue_wc_cart_fragments' );
function nail_salon_lite_custom_enqueue_wc_cart_fragments() {
    wp_enqueue_script( 'wc-cart-fragments' );
}

add_filter( 'woocommerce_add_to_cart_fragments', 'nail_salon_lite_mini_cart_count');
function nail_salon_lite_mini_cart_count($fragments){
    ob_start();
    ?>
    <div id="mini-cart-count">
        <?php echo esc_html(WC()->cart->get_cart_contents_count()); ?>
    </div>
    <?php
        $fragments['#mini-cart-count'] = ob_get_clean();
    return $fragments;
}

add_filter( 'woocommerce_add_to_cart_fragments', 'nail_salon_lite_refresh_cart_total');
function nail_salon_lite_refresh_cart_total( $fragments ) {
		ob_start();
	?>
		<div id="mini-cart-total">
			<?php echo esc_html_e('Total', 'nail-salon-lite'); ?>
				<div class="clear"></div>
				<?php echo wp_kses_post(WC()->cart->get_cart_total()); ?>
		</div>
		<?php
				$fragments['#mini-cart-total'] = ob_get_clean();
		return $fragments;
}