<?php

/*-----------------------------------------------------------------------------------*/
/* Enqueue script and styles */
/*-----------------------------------------------------------------------------------*/

function hairstyle_salon_enqueue_google_fonts() {

	require_once get_theme_file_path( 'core/includes/wptt-webfont-loader.php' );

	wp_enqueue_style(
		'google-fonts-K2D',
		wptt_get_webfont_url( 'https://fonts.googleapis.com/css2?family=K2D:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap' ),
		array(),
		'1.0'
	);

	wp_enqueue_style(
		'google-fonts-outfit',
		wptt_get_webfont_url( 'https://fonts.googleapis.com/css2?family=Outfit:wght@100;200;300;400;500;600;700;800;900&display=swap' ),
		array(),
		'1.0'
	);
}
add_action( 'wp_enqueue_scripts', 'hairstyle_salon_enqueue_google_fonts' );

if (!function_exists('hairstyle_salon_enqueue_scripts')) {

	function hairstyle_salon_enqueue_scripts() {

		wp_enqueue_style(
			'bootstrap-css',
			get_template_directory_uri() . '/css/bootstrap.css',
			array(),'4.5.0'
		);

		wp_enqueue_style(
			'fontawesome-css',
			get_template_directory_uri() . '/css/fontawesome-all.css',
			array(),'4.5.0'
		);

		wp_enqueue_style(
			'owl.carousel-css',
			get_template_directory_uri() . '/css/owl.carousel.css',
			array(),'2.3.4'
		);

		wp_enqueue_style( 'hairstyle-salon-block-style', get_theme_file_uri('/css/blocks.css') );

		wp_enqueue_style('hairstyle-salon-style', get_stylesheet_uri(), array() );

		wp_style_add_data('hairstyle-salon-style', 'rtl', 'replace');

		wp_enqueue_style(
			'hairstyle-salon-media-css',
			get_template_directory_uri() . '/css/media.css',
			array(),'2.3.4'
		);

		wp_enqueue_style(
			'hairstyle-salon-woocommerce-css',
			get_template_directory_uri() . '/css/woocommerce.css',
			array(),'2.3.4'
		);

		wp_enqueue_script(
			'hairstyle-salon-navigation',
			get_template_directory_uri() . '/js/navigation.js',
			FALSE,
			'1.0',
			TRUE
		);

		wp_enqueue_script(
			'owl.carousel-js',
			get_template_directory_uri() . '/js/owl.carousel.js',
			array('jquery'),
			'2.3.4',
			TRUE
		);

		wp_enqueue_script(
			'hairstyle-salon-script',
			get_template_directory_uri() . '/js/script.js',
			array('jquery'),
			'1.0',
			TRUE
		);

		if ( is_singular() ) wp_enqueue_script( 'comment-reply' );

		$hairstyle_salon_css = '';

		if ( get_header_image() ) :

			$hairstyle_salon_css .=  '
				#site-navigation,.page-template-frontpage #site-navigation{
					background-image: url('.esc_url(get_header_image()).');
					-webkit-background-size: cover !important;
					-moz-background-size: cover !important;
					-o-background-size: cover !important;
					background-size: cover !important;
				}';

		endif;

		wp_add_inline_style( 'hairstyle-salon-style', $hairstyle_salon_css );

		// Theme Customize CSS.
	require get_template_directory(). '/core/includes/inline.php';
	wp_add_inline_style( 'hairstyle-salon-style',$hairstyle_salon_custom_css );

	}

	add_action( 'wp_enqueue_scripts', 'hairstyle_salon_enqueue_scripts' );
}

/*-----------------------------------------------------------------------------------*/
/* Setup theme */
/*-----------------------------------------------------------------------------------*/

if (!function_exists('hairstyle_salon_after_setup_theme')) {

	function hairstyle_salon_after_setup_theme() {

		load_theme_textdomain( 'hairstyle-salon', get_stylesheet_directory() . '/languages' );
		if ( ! isset( $hairstyle_salon_content_width ) ) $hairstyle_salon_content_width = 900;

		register_nav_menus( array(
			'main-menu' => esc_html__( 'Main menu', 'hairstyle-salon' ),
		));

		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'woocommerce' );
		add_theme_support( 'align-wide' );
		add_theme_support('title-tag');
		add_theme_support('automatic-feed-links');
		add_theme_support( 'wp-block-styles' );
		add_theme_support('post-thumbnails');
		add_theme_support( 'custom-background', array(
		  'default-color' => 'f3f3f3'
		));

		add_theme_support( 'custom-logo', array(
			'height'      => 70,
			'width'       => 70,
		) );

		add_theme_support( 'custom-header', array(
			'header-text' => false,
			'width' => 1920,
			'height' => 100
		));

		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		add_theme_support( 'post-formats', array('image','video','gallery','audio',) );

		add_editor_style( array( '/css/editor-style.css' ) );
	}

	add_action( 'after_setup_theme', 'hairstyle_salon_after_setup_theme', 999 );

}

require get_template_directory() .'/core/includes/theme-breadcrumb.php';
require get_template_directory() .'/core/includes/main.php';
require get_template_directory() .'/core/includes/tgm.php';
require get_template_directory() . '/core/includes/customizer.php';
load_template( trailingslashit( get_template_directory() ) . '/core/includes/class-upgrade-pro.php' );

/*-----------------------------------------------------------------------------------*/
/* Enqueue theme logo style */
/*-----------------------------------------------------------------------------------*/
function hairstyle_salon_logo_resizer() {

    $hairstyle_salon_theme_logo_size_css = '';
    $hairstyle_salon_logo_resizer = get_theme_mod('hairstyle_salon_logo_resizer');

	$hairstyle_salon_theme_logo_size_css = '
		.custom-logo{
			height: '.esc_attr($hairstyle_salon_logo_resizer).'px !important;
			width: '.esc_attr($hairstyle_salon_logo_resizer).'px !important;
		}
	';
    wp_add_inline_style( 'hairstyle-salon-style',$hairstyle_salon_theme_logo_size_css );

}
add_action( 'wp_enqueue_scripts', 'hairstyle_salon_logo_resizer' );

/*-----------------------------------------------------------------------------------*/
/* Enqueue Global color style */
/*-----------------------------------------------------------------------------------*/
function hairstyle_salon_global_color() {

    $hairstyle_salon_theme_color_css = '';
    $hairstyle_salon_copyright_bg = get_theme_mod('hairstyle_salon_copyright_bg');

	$hairstyle_salon_theme_color_css = '
    .copyright {
			background: '.esc_attr($hairstyle_salon_copyright_bg).';
		}
	';
    wp_add_inline_style( 'hairstyle-salon-style',$hairstyle_salon_theme_color_css );
    wp_add_inline_style( 'hairstyle-salon-woocommerce-css',$hairstyle_salon_theme_color_css );

}
add_action( 'wp_enqueue_scripts', 'hairstyle_salon_global_color' );


/*-----------------------------------------------------------------------------------*/
/* Get post comments */
/*-----------------------------------------------------------------------------------*/

if (!function_exists('hairstyle_salon_comment')) :
    /**
     * Template for comments and pingbacks.
     *
     * Used as a callback by wp_list_comments() for displaying the comments.
     */
    function hairstyle_salon_comment($comment, $args, $depth){

        if ('pingback' == $comment->comment_type || 'trackback' == $comment->comment_type) : ?>

            <li id="comment-<?php comment_ID(); ?>" <?php comment_class('media'); ?>>
            <div class="comment-body">
                <?php esc_html_e('Pingback:', 'hairstyle-salon');
                comment_author_link(); ?><?php edit_comment_link(__('Edit', 'hairstyle-salon'), '<span class="edit-link">', '</span>'); ?>
            </div>

        <?php else : ?>

        <li id="comment-<?php comment_ID(); ?>" <?php comment_class(empty($args['has_children']) ? '' : 'parent'); ?>>
            <article id="div-comment-<?php comment_ID(); ?>" class="comment-body media mb-4">
                <a class="pull-left" href="#">
                    <?php if (0 != $args['avatar_size']) echo get_avatar($comment, $args['avatar_size']); ?>
                </a>
                <div class="media-body">
                    <div class="media-body-wrap card">
                        <div class="card-header">
                            <h5 class="mt-0"><?php /* translators: %s: author */ printf('<cite class="fn">%s</cite>', get_comment_author_link() ); ?></h5>
                            <div class="comment-meta">
                                <a href="<?php echo esc_url(get_comment_link($comment->comment_ID)); ?>">
                                    <time datetime="<?php comment_time('c'); ?>">
                                        <?php /* translators: %s: Date */ printf( esc_html__('%1$s at %2$s', 'hairstyle-salon'), esc_html( get_comment_date() ), esc_html( get_comment_time() ) ); ?>
                                    </time>
                                </a>
                                <?php edit_comment_link( __( 'Edit', 'hairstyle-salon' ), '<span class="edit-link">', '</span>' ); ?>
                            </div>
                        </div>

                        <?php if ('0' == $comment->comment_approved) : ?>
                            <p class="comment-awaiting-moderation"><?php esc_html_e('Your comment is awaiting moderation.', 'hairstyle-salon'); ?></p>
                        <?php endif; ?>

                        <div class="comment-content card-block">
                            <?php comment_text(); ?>
                        </div>

                        <?php comment_reply_link(
                            array_merge(
                                $args, array(
                                    'add_below' => 'div-comment',
                                    'depth' => $depth,
                                    'max_depth' => $args['max_depth'],
                                    'before' => '<footer class="reply comment-reply card-footer">',
                                    'after' => '</footer><!-- .reply -->'
                                )
                            )
                        ); ?>
                    </div>
                </div>
            </article>

            <?php
        endif;
    }
endif; // ends check for hairstyle_salon_comment()

if (!function_exists('hairstyle_salon_widgets_init')) {

	function hairstyle_salon_widgets_init() {

		register_sidebar(array(

			'name' => esc_html__('Sidebar','hairstyle-salon'),
			'id'   => 'hairstyle-salon-sidebar',
			'description'   => esc_html__('This sidebar will be shown next to the content.', 'hairstyle-salon'),
			'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="title">',
			'after_title'   => '</h4>'

		));

		register_sidebar(array(

			'name' => esc_html__('Footer sidebar','hairstyle-salon'),
			'id'   => 'hairstyle-salon-footer-sidebar',
			'description'   => esc_html__('This sidebar will be shown next at the bottom of your content.', 'hairstyle-salon'),
			'before_widget' => '<div id="%1$s" class="col-lg-3 col-md-3 %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="title">',
			'after_title'   => '</h4>'

		));

	}

	add_action( 'widgets_init', 'hairstyle_salon_widgets_init' );

}

function hairstyle_salon_get_categories_select() {
	$teh_cats = get_categories();
	$results = array();
	$count = count($teh_cats);
	for ($i=0; $i < $count; $i++) {
	if (isset($teh_cats[$i]))
  		$results[$teh_cats[$i]->slug] = $teh_cats[$i]->name;
	else
  		$count++;
	}
	return $results;
}

function hairstyle_salon_sanitize_phone_number( $phone ) {
	return preg_replace( '/[^\d+]/', '', $phone );
}

// Change number or products per row to 3
add_filter('loop_shop_columns', 'hairstyle_salon_loop_columns');
if (!function_exists('hairstyle_salon_loop_columns')) {
	function hairstyle_salon_loop_columns() {
		$hairstyle_salon_columns = get_theme_mod( 'hairstyle_salon_per_columns', 3 );
		return $hairstyle_salon_columns;
	}
}

//Change number of products that are displayed per page (shop page)
add_filter( 'loop_shop_per_page', 'hairstyle_salon_per_page', 20 );
function hairstyle_salon_per_page( $hairstyle_salon_cols ) {
  	$hairstyle_salon_cols = get_theme_mod( 'hairstyle_salon_product_per_page', 9 );
	return $hairstyle_salon_cols;
}

// Add filter to modify the number of related products
add_filter( 'woocommerce_output_related_products_args', 'hairstyle_salon_products_args' );
function hairstyle_salon_products_args( $args ) {
    $args['posts_per_page'] = get_theme_mod( 'custom_related_products_number', 6 );
    $args['columns'] = get_theme_mod( 'custom_related_products_number_per_row', 3 );
    return $args;
}

add_action('after_switch_theme', 'hairstyle_salon_setup_options');
function hairstyle_salon_setup_options () {
    update_option('dismissed-get_started', FALSE );
}

?>