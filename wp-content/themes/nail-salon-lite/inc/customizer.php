<?php
/**
 * Nail Salon Lite Theme Customizer
 *
 * @package Nail Salon Lite
 */
 
function nail_salon_lite_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'nail_salon_lite_custom_header_args', array(
		'default-text-color'     => '949494',
		'width'                  => 1600,
		'height'                 => 230,
		'wp-head-callback'       => 'nail_salon_lite_header_style',
 		'default-text-color' => false,
 		'header-text' => false,
	) ) );
}
add_action( 'after_setup_theme', 'nail_salon_lite_custom_header_setup' );
if ( ! function_exists( 'nail_salon_lite_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see nail_salon_lite_custom_header_setup().
 */
function nail_salon_lite_header_style() {
	?>    
	<style type="text/css">
	<?php
		//Check if user has defined any header image.
		if ( get_header_image() ) :
	?>
		.header {
			background: url(<?php echo esc_url(get_header_image()); ?>) no-repeat;
			background-position: center top;
			background-size:cover;
		}
	<?php endif; ?>	
	</style>
	<?php
}
endif; // nail_salon_lite_header_style 

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */ 
/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
 
function nail_salon_lite_customize_register( $wp_customize ) {
	//Add a class for titles
    class nail_salon_lite_Info extends WP_Customize_Control {
        public $type = 'info';
        public $label = '';
        public function render_content() {
        ?>
			<h3 style="text-decoration: underline; color: #DA4141; text-transform: uppercase;"><?php echo esc_html( $this->label ); ?></h3>
        <?php
        }
    }
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->add_setting('color_scheme',array(
			'default'	=> '#e19776',
			'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control(
		new WP_Customize_Color_Control($wp_customize,'color_scheme',array(
			'label' => esc_html__('Color Scheme','nail-salon-lite'),			
			'section' => 'colors',
			'settings' => 'color_scheme'
		))
	);
	
		$wp_customize->add_setting('header_bg_color',array(
			'default'	=> '#0f0f0f',
			'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control(
		new WP_Customize_Color_Control($wp_customize,'header_bg_color',array(
			'label' => esc_html__('Heder Background Color','nail-salon-lite'),				
			'section' => 'colors',
			'settings' => 'header_bg_color'
		))
	);
	
		$wp_customize->add_setting('footer_bg_color',array(
			'default'	=> '#fef9f6',
			'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control(
		new WP_Customize_Color_Control($wp_customize,'footer_bg_color',array(
			'label' => esc_html__('Footer Background Color','nail-salon-lite'),				
			'section' => 'colors',
			'settings' => 'footer_bg_color'
		))
	);	

		$wp_customize->add_setting('footer_text_color',array(
			'default'	=> '#21201f',
			'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control(
		new WP_Customize_Color_Control($wp_customize,'footer_text_color',array(
			'label' => esc_html__('Footer Text Color','nail-salon-lite'),				
			'section' => 'colors',
			'settings' => 'footer_text_color'
		))
	);	
	
	// Header Button
		 $wp_customize->add_section('header_button',array(
			'title'	=> esc_html__('Header Button','nail-salon-lite'),					
			'priority'		=> null
	));
	
	$wp_customize->add_setting('header_btntext',array(
			'default'	=> null,
			'sanitize_callback'	=> 'sanitize_text_field'	
	));
	
	$wp_customize->add_control('header_btntext',array(
			'label'	=> esc_html__('Button Text','nail-salon-lite'),
			'section'	=> 'header_button',
			'setting'	=> 'header_btntext'
	));	
	
	$wp_customize->add_setting('header_btn_link',array(
			'default'	=> null,
			'sanitize_callback'	=> 'esc_url_raw'	
	));
	
	$wp_customize->add_control('header_btn_link',array(
			'label'	=> esc_html__('Button Link','nail-salon-lite'),
			'section'	=> 'header_button',
			'setting'	=> 'header_btn_link'
	));
	
	// Hide Header Button
	$wp_customize->add_setting('hide_header_btn',array(
			'sanitize_callback' => 'nail_salon_lite_sanitize_checkbox',
			'default' => true,
	));	 
	$wp_customize->add_control( 'hide_header_btn', array(
    	   'section'   => 'header_button',    	 
		   'label'	=> esc_html__('Uncheck To Show Button In Header','nail-salon-lite'),
    	   'type'      => 'checkbox'
     )); 	
	 // Hide Header Button 	
	
	// Transparent Header
	$wp_customize->add_section('header_transparent',array(
			'title'	=> esc_html__('Homepage Header Transparent','nail-salon-lite'),					
			'priority'		=> null
	));	

	$wp_customize->add_setting('one_header_transparent',array(
			'sanitize_callback' => 'nail_salon_lite_sanitize_checkbox',
			'default' => true,
	));	 
	$wp_customize->add_control( 'one_header_transparent', array(
    	   'section'   => 'header_transparent',    	 
		   'label'	=> esc_html__('Uncheck To Enable Transparent Header','nail-salon-lite'),
    	   'type'      => 'checkbox'
     ));	
	 // Transparent Header
	 
	// Inner Page Banner Settings
	$wp_customize->add_section('inner_page_banner',array(
			'title'	=> esc_html__('Inner Page Banner Settings','nail-salon-lite'),					
			'priority'		=> null
	));	
	
	$wp_customize->add_setting('inner_page_banner_thumb',array(
			'default'	=> null,
			'sanitize_callback'	=> 'esc_url_raw'	
	));
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'inner_page_banner_thumb', array(
        'section' => 'inner_page_banner',
		'label'	=> esc_html__('Upload Default Banner Image','nail-salon-lite'),
        'settings' => 'inner_page_banner_thumb',
        'button_labels' => array(// All These labels are optional
                    'select' => 'Select Image',
                    'remove' => 'Remove Image',
                    'change' => 'Change Image',
                    )
    )));

	$wp_customize->add_setting('inner_page_banner_option',array(
			'sanitize_callback' => 'nail_salon_lite_sanitize_checkbox',
			'default' => true,
	));	 
	$wp_customize->add_control( 'inner_page_banner_option', array(
    	   'section'   => 'inner_page_banner',    	 
		   'label'	=> esc_html__('Uncheck To Show Inner Page Banner On All Inner Pages. For Display Different Banner Image On Each Page Set Page Featured Image. Set Image Size (1400 X 335) For Better Resolution.','nail-salon-lite'),
    	   'type'      => 'checkbox'
     ));	
	 // Inner Page Banner Settings
	 
	 
	// Inner Post Banner Settings
	$wp_customize->add_section('inner_post_banner',array(
			'title'	=> esc_html__('Single Post Banner Settings','nail-salon-lite'),					
			'priority'		=> null
	));	
	
	$wp_customize->add_setting('inner_post_banner_thumb',array(
			'default'	=> null,
			'sanitize_callback'	=> 'esc_url_raw'	
	));
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'inner_post_banner_thumb', array(
        'section' => 'inner_post_banner',
		'label'	=> esc_html__('Upload Default Banner Image','nail-salon-lite'),
        'settings' => 'inner_post_banner_thumb',
        'button_labels' => array(// All These labels are optional
                    'select' => 'Select Image',
                    'remove' => 'Remove Image',
                    'change' => 'Change Image',
                    )
    )));

	$wp_customize->add_setting('inner_post_banner_option',array(
			'sanitize_callback' => 'nail_salon_lite_sanitize_checkbox',
			'default' => true,
	));	 
	$wp_customize->add_control( 'inner_post_banner_option', array(
    	   'section'   => 'inner_post_banner',    	 
		   'label'	=> esc_html__('Uncheck To Show Inner Post Banner On Single Posts. For Display Different Banner Image On Each Post Set Post Featured Image. Set Image Size (1400 X 335) For Better Resolution.','nail-salon-lite'),
    	   'type'      => 'checkbox'
     ));	
	 // Inner Page Banner Settings	 
	 
	$wp_customize->add_section('footer_text_copyright',array(
			'title'	=> esc_html__('Footer Copyright Text','nail-salon-lite'),				
			'priority'		=> null
	));
	
	$wp_customize->add_setting('footer_text',array(
			'default'	=> null,
			'sanitize_callback'	=> 'sanitize_text_field'	
	));
	$wp_customize->add_control('footer_text',array(
			'label'	=> esc_html__('Add Copyright Text Here','nail-salon-lite'),
			'section'	=> 'footer_text_copyright',
			'setting'	=> 'footer_text'
	));		 
}
add_action( 'customize_register', 'nail_salon_lite_customize_register' );
//Integer
function nail_salon_lite_sanitize_integer( $input ) {
    if( is_numeric( $input ) ) {
        return intval( $input );
    }
}
function nail_salon_lite_sanitize_checkbox( $checked ) {
	// Boolean check.
	return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

//setting inline css.
function nail_salon_lite_custom_css() {
    wp_enqueue_style(
        'nail-salon-lite-custom-style',
        get_stylesheet_directory_uri() . '/css/nail-salon-lite-custom-style.css' 
    );
        $color = esc_html(get_theme_mod( 'color_scheme' ));
		$headerbgcolor = esc_html(get_theme_mod( 'header_bg_color' )); 
		$footerbgcolor = esc_html(get_theme_mod( 'footer_bg_color' ));
		$footertextcolor = esc_html(get_theme_mod( 'footer_text_color' )); 

        $custom_css = "
					#sidebar ul li a:hover,
					.footerarea a:hover,
					.blog_lists h4 a:hover,
					.recent-post h6 a:hover,
					.recent-post a:hover,
					.design-by a,
					.postmeta a:hover,
					.tagcloud a,
					.blocksbox:hover h3,
					.rdmore a,
					.main-navigation ul li:hover a, .main-navigation ul li a:focus, .main-navigation ul li a:hover, .main-navigation ul li.current-menu-item a, .main-navigation ul li.current_page_item a
					{ 
						 color: {$color} !important;
					}

					.pagination .nav-links span.current, .pagination .nav-links a:hover,
					#commentform input#submit:hover,
					.wpcf7 input[type='submit'],
					input.search-submit,
					.recent-post .morebtn:hover, 
					.read-more-btn,
					.woocommerce-product-search button[type='submit'],
					.head-info-area,
					.designs-thumb,
					.hometwo-block-button,
					.aboutmore,
					.service-thumb-box,
					.view-all-btn a:hover
					{ 
					   background-color: {$color} !important;
					}

					.titleborder span:after{border-bottom-color: {$color} !important;}
					.header{background-color: {$headerbgcolor};}
					.copyright-area{background-color: {$footerbgcolor} !important;}
					.copyright-wrapper{color: {$footertextcolor} !important;}
				";
        wp_add_inline_style( 'nail-salon-lite-custom-style', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'nail_salon_lite_custom_css' );          
/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function nail_salon_lite_customize_preview_js() {
	wp_enqueue_script( 'nail_salon_lite_customizer', get_template_directory_uri() . '/js/customize-preview.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'nail_salon_lite_customize_preview_js' );