<?php
/**
 * Blossom Spa Custom functions and definitions
 *
 * @package Blossom_Spa
 */

if ( ! function_exists( 'blossom_spa_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function blossom_spa_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Blossom Spa, use a find and replace
	 * to change 'blossom-spa' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'blossom-spa', get_template_directory() . '/languages' );

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

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary'   => esc_html__( 'Primary', 'blossom-spa' )
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-list',
		'gallery',
		'caption',
	) );
    
    // Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'blossom_spa_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
    
	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support( 
        'custom-logo', 
        array( 
            'height'      => 70, /** change height as per theme requirement */
            'width'       => 70, /** change width as per theme requirement */
            'flex-height' => true,
            'flex-width'  => true,
            'header-text' => array( 'site-title', 'site-description' ) 
        ) 
    );
    
    /**
     * Add support for custom header.
    */
    add_theme_support( 'custom-header', apply_filters( 'blossom_spa_custom_header_args', array(
		'default-image' => get_template_directory_uri() . '/images/banner-img.jpg',
        'video'         => true,
		'width'         => 1920,
		'height'        => 700,
        'header-text'   => false,
	) ) );

    // Register default headers.
    register_default_headers( array(
        'default-banner' => array(
            'url'           => '%s/images/banner-img.jpg',
            'thumbnail_url' => '%s/images/banner-img.jpg',
            'description'   => esc_html_x( 'Default Banner', 'header image description', 'blossom-spa' ),
        ),
    ) );
 
    /**
     * Add Custom Images sizes.
    */    
    add_image_size( 'blossom-spa-schema', 600, 60 );    
    add_image_size( 'blossom-spa-single', 1920, 700, true );
    add_image_size( 'blossom-spa-service', 480, 324, true );
    add_image_size( 'blossom-spa-team', 270, 300, true );
    add_image_size( 'blossom-spa-pagination', 370, 247, true );
    add_image_size( 'blossom-spa-blog-list', 640, 480, true );
    add_image_size( 'blossom-spa-blog-classic', 776, 517, true );
    add_image_size( 'blossom-spa-blog-classic-full', 1170, 517, true );
    add_image_size( 'blossom-spa-related', 110, 83, true );    
    
    /** Starter Content */
    $starter_content = array(
        // Specify the core-defined pages to create and add custom thumbnails to some of them.
		'posts' => array( 
            'home', 
            'blog', 
        ),
		
        // Default to a static front page and assign the front and posts pages.
		'options' => array(
			'show_on_front' => 'page',
			'page_on_front' => '{{home}}',
			'page_for_posts' => '{{blog}}',
		),
        
        // Set up nav menus for each of the two areas registered in the theme.
		'nav_menus' => array(
			// Assign a menu to the "top" location.
			'primary' => array(
				'name' => __( 'Primary', 'blossom-spa' ),
				'items' => array(
					'page_home',
					'page_blog',
				)
			)
		),
    );
    
    $starter_content = apply_filters( 'blossom_spa_starter_content', $starter_content );

	add_theme_support( 'starter-content', $starter_content );
    
    // Add theme support for Responsive Videos.
    add_theme_support( 'jetpack-responsive-videos' );

    // Add excerpt support for pages
    add_post_type_support( 'page', 'excerpt' );

    // Remove widget block.
    remove_theme_support( 'widgets-block-editor' );
}
endif;
add_action( 'after_setup_theme', 'blossom_spa_setup' );

if( ! function_exists( 'blossom_spa_content_width' ) ) :
/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function blossom_spa_content_width() {
	/** 
     * content width as per theme.
    */
    $GLOBALS['content_width'] = apply_filters( 'blossom_spa_content_width', 767 );
}
endif;
add_action( 'after_setup_theme', 'blossom_spa_content_width', 0 );

if( ! function_exists( 'blossom_spa_template_redirect_content_width' ) ) :
/**
* Adjust content_width value according to template.
*
* @return void
*/
function blossom_spa_template_redirect_content_width(){
	$sidebar = blossom_spa_sidebar();
    if( $sidebar ){	   
        $GLOBALS['content_width'] = 767;       
	}else{
        if( is_singular() ){
            if( blossom_spa_sidebar( true ) === 'full-width centered' ){
                $GLOBALS['content_width'] = 767;
            }else{
                $GLOBALS['content_width'] = 1170;                
            }                
        }else{
            $GLOBALS['content_width'] = 1170;
        }
	}
}
endif;
add_action( 'template_redirect', 'blossom_spa_template_redirect_content_width' );

if( ! function_exists( 'blossom_spa_scripts' ) ) :
/**
 * Enqueue scripts and styles.
 */
function blossom_spa_scripts() {
	// Use minified libraries if SCRIPT_DEBUG is false
    $build  = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '/build' : '';
    $suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
    
    if( blossom_spa_is_woocommerce_activated() )
    wp_enqueue_style( 'blossom-spa-woocommerce', get_template_directory_uri(). '/css' . $build . '/woocommerce' . $suffix . '.css', array(), BLOSSOM_SPA_THEME_VERSION );
    
    wp_enqueue_style( 'animate', get_template_directory_uri(). '/css' . $build . '/animate' . $suffix . '.css', array(), '3.5.2' );
    wp_enqueue_style( 'owl-carousel', get_template_directory_uri(). '/css' . $build . '/owl.carousel' . $suffix . '.css', array(), '2.2.1' );
    wp_enqueue_style( 'perfect-scrollbar', get_template_directory_uri(). '/css' . $build . '/perfect-scrollbar' . $suffix . '.css', array(), '3.1.5' );
    if ( get_theme_mod( 'ed_localgoogle_fonts', false ) && ! is_customize_preview() && ! is_admin() && get_theme_mod( 'ed_preload_local_fonts', false ) ) {
        blossom_spa_preload_local_fonts( blossom_spa_fonts_url() );
    }
    wp_enqueue_style( 'blossom-spa-google-fonts', blossom_spa_fonts_url(), array(), null );
    wp_enqueue_style( 'blossom-spa', get_stylesheet_uri(), array(), BLOSSOM_SPA_THEME_VERSION );

    wp_enqueue_script( 'all', get_template_directory_uri() . '/js' . $build . '/all' . $suffix . '.js', array( 'jquery' ), '6.1.1', true );
    wp_enqueue_script( 'v4-shims', get_template_directory_uri() . '/js' . $build . '/v4-shims' . $suffix . '.js', array( 'jquery', 'all' ), '6.1.1', true );
    wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/js' . $build . '/owl.carousel' . $suffix . '.js', array( 'jquery' ), '2.2.1', true );
    wp_enqueue_script( 'owlcarousel2-a11ylayer', get_template_directory_uri() . '/js' . $build . '/owlcarousel2-a11ylayer' . $suffix . '.js', array( 'jquery', 'owl-carousel' ), '0.2.1', true );
    wp_enqueue_script( 'perfect-scrollbar', get_template_directory_uri() . '/js' . $build . '/perfect-scrollbar' . $suffix . '.js', array( 'jquery' ), '1.3.0', true );
	wp_enqueue_script( 'blossom-spa', get_template_directory_uri() . '/js' . $build . '/custom' . $suffix . '.js', array( 'jquery' ), BLOSSOM_SPA_THEME_VERSION, true );
    
    wp_enqueue_script( 'blossom-spa-modal', get_template_directory_uri() . '/js' . $build . '/modal-accessibility' . $suffix . '.js', array( 'jquery' ), BLOSSOM_SPA_THEME_VERSION, true );
    $array = array( 
        'rtl'           => is_rtl(),
    );
    
    wp_localize_script( 'blossom-spa', 'blossom_spa_data', $array );
    
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
endif;
add_action( 'wp_enqueue_scripts', 'blossom_spa_scripts' );

if( ! function_exists( 'blossom_spa_admin_scripts' ) ) :
/**
 * Enqueue admin scripts and styles.
*/
function blossom_spa_admin_scripts(){

    wp_enqueue_style( 'blossom-spa-admin', get_template_directory_uri() . '/inc/css/admin.css', '', BLOSSOM_SPA_THEME_VERSION );
}
endif; 
add_action( 'admin_enqueue_scripts', 'blossom_spa_admin_scripts' );

if( ! function_exists( 'blossom_spa_body_classes' ) ) :
/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function blossom_spa_body_classes( $classes ) {
    
    // Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}
    
    // Adds a class of custom-background-image to sites with a custom background image.
    if ( get_background_image() ) {
        $classes[] = 'custom-background-image';
    }
    
    // Adds a class of custom-background-color to sites with a custom background color.
    if ( get_background_color() != 'ffffff' ) {
        $classes[] = 'custom-background-color';
    }
    
    if( is_home() || is_archive() || is_search() ){
        $classes[] = get_theme_mod( 'blog_page_layout', 'list-layout' );
    }

    if( is_single() || is_page() ){
        $classes[] = 'underline';
    }
    
    $classes[] = blossom_spa_sidebar( true );
    
	return $classes;
}
endif;
add_filter( 'body_class', 'blossom_spa_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function blossom_spa_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'blossom_spa_pingback_header' );

if( ! function_exists( 'blossom_spa_change_comment_form_default_fields' ) ) :
/**
 * Change Comment form default fields i.e. author, email & url.
 * https://blog.josemcastaneda.com/2016/08/08/copy-paste-hurting-theme/
*/
function blossom_spa_change_comment_form_default_fields( $fields ){    
    // get the current commenter if available
    $commenter = wp_get_current_commenter();
 
    // core functionality
    $req = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );    
 
    // Change just the author field
    $fields['author'] = '<p class="comment-form-author"><label class="screen-reader-text">' . esc_html__( 'Full Name', 'blossom-spa' ) . '</label><input id="author" name="author" placeholder="' . esc_attr__( 'Name*', 'blossom-spa' ) . '" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>';
    
    $fields['email'] = '<p class="comment-form-email"><label class="screen-reader-text">' . esc_html__( 'Email', 'blossom-spa' ) . '</label><input id="email" name="email" placeholder="' . esc_attr__( 'Email*', 'blossom-spa' ) . '" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>';
    
    $fields['url'] = '<p class="comment-form-url"><label class="screen-reader-text">' . esc_html__( 'Website', 'blossom-spa' ) . '</label><input id="url" name="url" placeholder="' . esc_attr__( 'Website', 'blossom-spa' ) . '" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>'; 
    
    return $fields;    
}
endif;
add_filter( 'comment_form_default_fields', 'blossom_spa_change_comment_form_default_fields' );

if( ! function_exists( 'blossom_spa_change_comment_form_defaults' ) ) :
/**
 * Change Comment Form defaults
 * https://blog.josemcastaneda.com/2016/08/08/copy-paste-hurting-theme/
*/
function blossom_spa_change_comment_form_defaults( $defaults ){    
    $defaults['comment_field']      = '<p class="comment-form-comment"><label class="screen-reader-text">' . esc_html__( 'Comment', 'blossom-spa' ) . '</label><textarea id="comment" name="comment" placeholder="' . esc_attr__( 'Comment', 'blossom-spa' ) . '" cols="45" rows="8" aria-required="true"></textarea></p>';
    $defaults['title_reply']        = esc_html__( 'Leave A Comment', 'blossom-spa' );
    $defaults['title_reply_before'] = '<h3 id="reply-title" class="comment-reply-title"><span>';
    $defaults['title_reply_after']  = '</span></h3>';
    
    return $defaults;    
}
endif;
add_filter( 'comment_form_defaults', 'blossom_spa_change_comment_form_defaults' );

if ( ! function_exists( 'blossom_spa_excerpt_more' ) ) :
/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... * 
 */
function blossom_spa_excerpt_more( $more ) {
	return is_admin() ? $more : ' &hellip; ';
}

endif;
add_filter( 'excerpt_more', 'blossom_spa_excerpt_more' );

if ( ! function_exists( 'blossom_spa_excerpt_length' ) ) :
/**
 * Changes the default 55 character in excerpt 
*/
function blossom_spa_excerpt_length( $length ) {
	$excerpt_length = get_theme_mod( 'excerpt_length', 30 );
    return is_admin() ? $length : absint( $excerpt_length );    
}
endif;
add_filter( 'excerpt_length', 'blossom_spa_excerpt_length', 999 );

if( ! function_exists( 'blossom_spa_get_the_archive_title' ) ) :
/**
 * Filter Archive Title
*/
function blossom_spa_get_the_archive_title( $title ){

    $ed_prefix = get_theme_mod( 'ed_prefix_archive', true );
    if( is_post_type_archive( 'product' ) ){
        $title = '<h1 class="page-title">' . get_the_title( get_option( 'woocommerce_shop_page_id' ) ) . '</h1>';
    }else{
        if( is_category() ){
            if( $ed_prefix ) {
                $title = '<h1 class="page-title"><span>' . esc_html( single_cat_title( '', false ) ) . '</span></h1>';
            }else{
                $title = '<span class="sub-title">'. esc_html__( 'CATEGORY','blossom-spa' ) . '</span><h1 class="page-title"><span>' . esc_html( single_cat_title( '', false ) ) . '</span></h1>';
            }
        }
        elseif( is_tag() ){
            if( $ed_prefix ) {
                $title = '<h1 class="page-title"><span>' . esc_html( single_tag_title( '', false ) ) . '</span></h1>';
            }else{
                $title = '<span class="sub-title">'. esc_html__( 'TAGS','blossom-spa' ) . '</span><h1 class="page-title"><span>' . esc_html( single_tag_title( '', false ) ) . '</span></h1>';
            }
        }elseif( is_year() ){
            if( $ed_prefix ){
                $title = '<h1 class="page-title"><span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'blossom-spa' ) ) . '</span></h1>';                   
            }else{
                $title = '<span class="sub-title">'. esc_html__( 'Year','blossom-spa' ) . '</span><h1 class="page-title"><span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'blossom-spa' ) ) . '</span></h1>';
            }
        }elseif( is_month() ){
            if( $ed_prefix ){
                $title = '<h1 class="page-title"><span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'blossom-spa' ) ) . '</span></h1>';                                   
            }else{
                $title = '<span class="sub-title">'. esc_html__( 'Month','blossom-spa' ) . '</span><h1 class="page-title"><span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'blossom-spa' ) ) . '</span></h1>';
            }
        }elseif( is_day() ){
            if( $ed_prefix ){
                $title = '<h1 class="page-title"><span>' . get_the_date( _x( 'F j, Y', 'daily archives date format', 'blossom-spa' ) ) . '</span></h1>';                                   
            }else{
                $title = '<span class="sub-title">'. esc_html__( 'Day','blossom-spa' ) . '</span><h1 class="page-title"><span>' . get_the_date( _x( 'F j, Y', 'daily archives date format', 'blossom-spa' ) ) .  '</span></h1>';
            }
        }elseif( is_post_type_archive() ) {
            if( $ed_prefix ){
                $title = '<h1 class="page-title"><span>'  . post_type_archive_title( '', false ) . '</span></h1>';                            
            }else{
                $title = '<span class="sub-title">'. esc_html__( 'Archives','blossom-spa' ) . '</span><h1 class="page-title"><span>'  . post_type_archive_title( '', false ) . '</span></h1>';
            }
        }elseif( is_tax() ) {
            $tax = get_taxonomy( get_queried_object()->taxonomy );
            if( $ed_prefix ){
                $title = '<h1 class="page-title"><span>' . single_term_title( '', false ) . '</span></h1>';                                   
            }else{
                $title = '<span class="sub-title">' . $tax->labels->singular_name . '</span><h1 class="page-title"><span>' . single_term_title( '', false ) . '</span></h1>';
            }
        }
    }    
    return $title;
}
endif;
add_filter( 'get_the_archive_title', 'blossom_spa_get_the_archive_title' );

if( ! function_exists( 'blossom_spa_remove_archive_description' ) ) :
/**
 * filter the_archive_description & get_the_archive_description to show post type archive
 * @param  string $description original description
 * @return string post type description if on post type archive
 */
function blossom_spa_remove_archive_description( $description ){
    $ed_shop_archive_description = get_theme_mod( 'ed_shop_archive_description', false );
    if( is_post_type_archive( 'product' ) ) {
        if( ! $ed_shop_archive_description ){
            $description = '';
        }
    }
    return $description;
}
endif;
add_filter( 'get_the_archive_description', 'blossom_spa_remove_archive_description' );

if( ! function_exists( 'blossom_spa_get_comment_author_link' ) ) :
/**
 * Filter to modify comment author link
 * @link https://developer.wordpress.org/reference/functions/get_comment_author_link/
 */
function blossom_spa_get_comment_author_link( $return, $author, $comment_ID ){
    $comment = get_comment( $comment_ID );
    $url     = get_comment_author_url( $comment );
    $author  = get_comment_author( $comment );
 
    if ( empty( $url ) || 'http://' == $url )
        $return = '<span itemprop="name">'. esc_html( $author ) .'</span>';
    else
        $return = '<span itemprop="name"><a href=' . esc_url( $url ) . ' rel="external nofollow noopener" class="url" itemprop="url">' . esc_html( $author ) . '</a></span>';

    return $return;
}
endif;
add_filter( 'get_comment_author_link', 'blossom_spa_get_comment_author_link', 10, 3 );

if( ! function_exists( 'blossom_spa_search_form' ) ) :
/**
 * Search Form
*/
function blossom_spa_search_form(){ 
    $placeholder = is_404() ? _x( 'Try searching for what you were looking for...', 'placeholder', 'blossom-spa' ) : _x( 'Search...', 'placeholder', 'blossom-spa' );
    $placeholder = is_search() ? '' : $placeholder;
    $form = '<form role="search" method="get" class="search-form" action="' . esc_url( home_url( '/' ) ) . '"><label><span class="screen-reader-text">' . esc_html__( 'Search for:', 'blossom-spa' ) . '</span><input type="search" class="search-field" placeholder="' . esc_attr( $placeholder ) . '" value="' . esc_attr( get_search_query() ) . '" name="s" /></label><input type="submit" id="submit-field" class="search-submit" value="'. esc_attr_x( 'Search', 'submit button', 'blossom-spa' ) .'" /></form>';
 
    return $form;
}
endif;
add_filter( 'get_search_form', 'blossom_spa_search_form' );

if( ! function_exists( 'blossom_spa_admin_notice' ) ) :
/**
 * Adding admin Notice
 */
function blossom_spa_admin_notice() {
    global $pagenow;
    $theme_args      = wp_get_theme();
    $meta            = get_option( 'blossom-spa-update-notice' );
    $name            = $theme_args->__get( 'Name' );
    $current_screen  = get_current_screen();
    $dismissnonce = wp_create_nonce( 'blossom-spa-update-notice' );
    
    if ( is_admin() && 'themes.php' == $pagenow && !$meta ) {
        
        if( $current_screen->id !== 'dashboard' && $current_screen->id !== 'themes' ) {
            return;
        }

        if ( is_network_admin() ) {
            return;
        }

        if ( ! current_user_can( 'manage_options' ) ) {
            return;
        } ?>

        <div class="welcome-message notice notice-info">
            <div class="notice-wrapper">
                <div class="notice-text">
                    <h3><?php esc_html_e( 'Congratulations!', 'blossom-spa' ); ?></h3>
                    <p><?php printf( __( '%1$s is now installed and ready to use. Click below to see theme documentation, plugins to install and other details to get started.', 'blossom-spa' ), esc_html( $name ) ) ; ?></p>
                    <p><a href="<?php echo esc_url( admin_url( 'themes.php?page=blossom-spa-getting-started' ) ); ?>" class="button button-primary" style="text-decoration: none;"><?php esc_html_e( 'Go to the getting started.', 'blossom-spa' ); ?></a></p>
                    <p class="dismiss-link"><strong><a href="?blossom-spa-update-notice=1&_wpnonce=<?php echo esc_attr( $dismissnonce ); ?>"><?php esc_html_e( 'Dismiss','blossom-spa' ); ?></a></strong></p>
                </div>
            </div>
        </div>
    <?php }
}
endif;
add_action( 'admin_notices', 'blossom_spa_admin_notice' );

if( ! function_exists( 'blossom_spa_ignore_admin_notice' ) ) :
/**
 * ignore notice
 */
function blossom_spa_ignore_admin_notice() {

    if ( ! current_user_can('manage_options')) {
        return;
    }

    if ( ( isset( $_GET['blossom-spa-update-notice'] ) && $_GET['blossom-spa-update-notice'] = '1' ) && wp_verify_nonce( $_GET['_wpnonce'], 'blossom-spa-update-notice' ) ) {

        update_option( 'blossom-spa-update-notice', true );
    }
}
endif;
add_action( 'admin_init', 'blossom_spa_ignore_admin_notice' );

if ( ! function_exists( 'blossom_spa_get_fontawesome_ajax' ) ) :
/**
 * Return an array of all icons.
 */
function blossom_spa_get_fontawesome_ajax() {
    // Bail if the nonce doesn't check out
    if ( ! isset( $_POST['blossom_spa_customize_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['blossom_spa_customize_nonce'] ), 'blossom_spa_customize_nonce' ) ) {
        wp_die();
    }

    // Do another nonce check
    check_ajax_referer( 'blossom_spa_customize_nonce', 'blossom_spa_customize_nonce' );

    // Bail if user can't edit theme options
    if ( ! current_user_can( 'edit_theme_options' ) ) {
        wp_die();
    }

    // Get all of our fonts
    $fonts = blossom_spa_get_fontawesome_list();
    
    ob_start();
    if( $fonts ){ ?>
        <ul class="font-group">
            <?php 
                foreach( $fonts as $font ){
                    echo '<li data-font="' . esc_attr( $font ) . '"><i class="' . esc_attr( $font ) . '"></i></li>';                        
                }
            ?>
        </ul>
        <?php
    }
    echo ob_get_clean();

    // Exit
    wp_die();
}
endif;
add_action( 'wp_ajax_blossom_spa_get_fontawesome_ajax', 'blossom_spa_get_fontawesome_ajax' );