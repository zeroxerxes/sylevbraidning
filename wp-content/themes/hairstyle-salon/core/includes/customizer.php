<?php

if ( class_exists("Kirki")){

	// LOGO

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'slider',
		'settings'    => 'hairstyle_salon_logo_resizer',
		'label'       => esc_html__( 'Adjust Your Logo Size ', 'hairstyle-salon' ),
		'section'     => 'title_tagline',
		'default'     => 70,
		'choices'     => [
			'min'  => 10,
			'max'  => 300,
			'step' => 10,
		],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'hairstyle_salon_enable_logo_text',
		'section'     => 'title_tagline',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Enable / Disable Site Title and Tagline', 'hairstyle-salon' ) . '</h3>',
		'priority'    => 10,
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'        => 'switch',
		'settings'    => 'hairstyle_salon_display_header_title',
		'label'       => esc_html__( 'Site Title Enable / Disable Button', 'hairstyle-salon' ),
		'section'     => 'title_tagline',
		'default'     => '1',
		'priority'    => 10,
		'choices'     => [
			'on'  => esc_html__( 'Enable', 'hairstyle-salon' ),
			'off' => esc_html__( 'Disable', 'hairstyle-salon' ),
		],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'switch',
		'settings'    => 'hairstyle_salon_display_header_text',
		'label'       => esc_html__( 'Tagline Enable / Disable Button', 'hairstyle-salon' ),
		'section'     => 'title_tagline',
		'default'     => false,
		'priority'    => 10,
		'choices'     => [
			'on'  => esc_html__( 'Enable', 'hairstyle-salon' ),
			'off' => esc_html__( 'Disable', 'hairstyle-salon' ),
		],
	] );

	// FONT STYLE TYPOGRAPHY

	Kirki::add_panel( 'hairstyle_salon_panel_id', array(
	    'priority'    => 10,
	    'title'       => esc_html__( 'Typography', 'hairstyle-salon' ),
	) );

	Kirki::add_section( 'hairstyle_salon_font_style_section', array(
		'title'      => esc_attr__( 'Typography Option',  'hairstyle-salon' ),
		'priority'   => 2,
		'capability' => 'edit_theme_options',
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'hairstyle_salon_all_headings_typography',
		'section'     => 'hairstyle_salon_font_style_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Heading Of All Sections',  'hairstyle-salon' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'global', array(
		'type'        => 'typography',
		'settings'    => 'hairstyle_salon_all_headings_typography',
		'label'       => esc_attr__( 'Heading Typography',  'hairstyle-salon' ),
		'description' => esc_attr__( 'Select the typography options for your heading.',  'hairstyle-salon' ),
		'section'     => 'hairstyle_salon_font_style_section',
		'priority'    => 10,
		'default'     => array(
			'font-family'    => '',
			'variant'        => '',
		),
		'output' => array(
			array(
				'element' => array( 'h1','h2','h3','h4','h5','h6', ),
			),
		),
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'hairstyle_salon_body_content_typography',
		'section'     => 'hairstyle_salon_font_style_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Body Content',  'hairstyle-salon' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'global', array(
		'type'        => 'typography',
		'settings'    => 'hairstyle_salon_body_content_typography',
		'label'       => esc_attr__( 'Content Typography',  'hairstyle-salon' ),
		'description' => esc_attr__( 'Select the typography options for your content.',  'hairstyle-salon' ),
		'section'     => 'hairstyle_salon_font_style_section',
		'priority'    => 10,
		'default'     => array(
			'font-family'    => '',
			'variant'        => '',
		),
		'output' => array(
			array(
				'element' => array( 'body', ),
			),
		),
	) );


	// PANEL

	Kirki::add_panel( 'hairstyle_salon_panel_id', array(
	    'priority'    => 10,
	    'title'       => esc_html__( 'Theme Options', 'hairstyle-salon' ),
	) );

	// Additional Settings

	Kirki::add_section( 'hairstyle_salon_additional_settings', array(
	    'title'          => esc_html__( 'Additional Settings', 'hairstyle-salon' ),
	    'description'    => esc_html__( 'Scroll To Top', 'hairstyle-salon' ),
	    'panel'          => 'hairstyle_salon_panel_id',
	    'priority'       => 160,
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'settings'    => 'hairstyle_salon_scroll_enable_setting',
		'label'       => esc_html__( 'Here you can enable or disable your scroller.', 'hairstyle-salon' ),
		'section'     => 'hairstyle_salon_additional_settings',
		'default'     => '1',
		'priority'    => 10,
	] );

	new \Kirki\Field\Radio_Buttonset(
	[
		'settings'    => 'hairstyle_salon_scroll_top_position',
		'label'       => esc_html__( 'Alignment for Scroll To Top', 'hairstyle-salon' ),
		'section'     => 'hairstyle_salon_additional_settings',
		'default'     => 'Right',
		'priority'    => 10,
		'choices'     => [
			'Left'   => esc_html__( 'Left', 'hairstyle-salon' ),
			'Center' => esc_html__( 'Center', 'hairstyle-salon' ),
			'Right'  => esc_html__( 'Right', 'hairstyle-salon' ),
		],
	]
	);

	Kirki::add_field( 'theme_config_id', [
		'type'     => 'dashicons',
		'settings' => 'hairstyle_salon_scroll_top_icon',
		'label'    => esc_html__( 'Select Appropriate Scroll Top Icon', 'hairstyle-salon' ),
		'section'  => 'hairstyle_salon_additional_settings',
		'default'  => 'dashicons dashicons-arrow-up-alt',
		'priority' => 10,
	] );

	new \Kirki\Field\Select(
	[
		'settings'    => 'menu_text_transform_hairstyle_salon',
		'label'       => esc_html__( 'Menus Text Transform', 'hairstyle-salon' ),
		'section'     => 'hairstyle_salon_additional_settings',
		'default'     => 'CAPITALISE',
		'placeholder' => esc_html__( 'Choose an option', 'hairstyle-salon' ),
		'choices'     => [
			'CAPITALISE' => esc_html__( 'CAPITALISE', 'hairstyle-salon' ),
			'UPPERCASE' => esc_html__( 'UPPERCASE', 'hairstyle-salon' ),
			'LOWERCASE' => esc_html__( 'LOWERCASE', 'hairstyle-salon' ),

		],
	] );

	new \Kirki\Field\Select(
	[
		'settings'    => 'hairstyle_salon_menu_zoom',
		'label'       => esc_html__( 'Menu Transition', 'hairstyle-salon' ),
		'section'     => 'hairstyle_salon_additional_settings',
		'default' => 'None',
		'placeholder' => esc_html__( 'Choose an option', 'hairstyle-salon' ),
		'choices'     => [
			'None' => __('None','hairstyle-salon'),
            'Zoominn' => __('Zoom Inn','hairstyle-salon'),
            
		],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'slider',
		'settings'    => 'hairstyle_salon_container_width',
		'label'       => esc_html__( 'Theme Container Width', 'hairstyle-salon' ),
		'section'     => 'hairstyle_salon_additional_settings',
		'default'     => 100,
		'choices'     => [
			'min'  => 50,
			'max'  => 100,
			'step' => 1,
		],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'settings'    => 'hairstyle_salon_site_loader',
		'label'       => esc_html__( 'Here you can enable or disable your Site Loader.', 'hairstyle-salon' ),
		'section'     => 'hairstyle_salon_additional_settings',
		'default'     => false,
		'priority'    => 10,
	] );

	new \Kirki\Field\Select(
	[
		'settings'    => 'hairstyle_salon_page_layout',
		'label'       => esc_html__( 'Page Layout Setting', 'hairstyle-salon' ),
		'section'     => 'hairstyle_salon_additional_settings',
		'default' => 'Right Sidebar',
		'placeholder' => esc_html__( 'Choose an option', 'hairstyle-salon' ),
		'choices'     => [
			'Left Sidebar' => __('Left Sidebar','hairstyle-salon'),
            'Right Sidebar' => __('Right Sidebar','hairstyle-salon'),
            'One Column' => __('One Column','hairstyle-salon')
		],
	] );

	if ( class_exists("woocommerce")){

	// Woocommerce Settings

	Kirki::add_section( 'hairstyle_salon_woocommerce_settings', array(
			'title'          => esc_html__( 'Woocommerce Settings', 'hairstyle-salon' ),
			'description'    => esc_html__( 'Shop Page', 'hairstyle-salon' ),
			'panel'          => 'hairstyle_salon_panel_id',
			'priority'       => 160,
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'settings'    => 'hairstyle_salon_shop_sidebar',
		'label'       => esc_html__( 'Here you can enable or disable shop page sidebar.', 'hairstyle-salon' ),
		'section'     => 'hairstyle_salon_woocommerce_settings',
		'default'     => '1',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'settings'    => 'hairstyle_salon_product_sidebar',
		'label'       => esc_html__( 'Here you can enable or disable product page sidebar.', 'hairstyle-salon' ),
		'section'     => 'hairstyle_salon_woocommerce_settings',
		'default'     => '1',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'settings'    => 'hairstyle_salon_related_product_setting',
		'label'       => esc_html__( 'Here you can enable or disable your related products.', 'hairstyle-salon' ),
		'section'     => 'hairstyle_salon_woocommerce_settings',
		'default'     => true,
		'priority'    => 10,
	] );

	new \Kirki\Field\Number(
	[
		'settings' => 'hairstyle_salon_per_columns',
		'label'    => esc_html__( 'Product Per Row', 'hairstyle-salon' ),
		'section'  => 'hairstyle_salon_woocommerce_settings',
		'default'  => 3,
		'choices'  => [
			'min'  => 1,
			'max'  => 4,
			'step' => 1,
		],
	]
	);

	new \Kirki\Field\Number(
	[
		'settings' => 'hairstyle_salon_product_per_page',
		'label'    => esc_html__( 'Product Per Page', 'hairstyle-salon' ),
		'section'  => 'hairstyle_salon_woocommerce_settings',
		'default'  => 9,
		'choices'  => [
			'min'  => 1,
			'max'  => 15,
			'step' => 1,
		],
	]
	);

	new \Kirki\Field\Number(
	[
		'settings' => 'custom_related_products_number_per_row',
		'label'    => esc_html__( 'Related Product Per Column', 'hairstyle-salon' ),
		'section'  => 'hairstyle_salon_woocommerce_settings',
		'default'  => 3,
		'choices'  => [
			'min'  => 1,
			'max'  => 4,
			'step' => 1,
		],
	]
	);

	new \Kirki\Field\Number(
	[
		'settings' => 'custom_related_products_number',
		'label'    => esc_html__( 'Related Product Per Page', 'hairstyle-salon' ),
		'section'  => 'hairstyle_salon_woocommerce_settings',
		'default'  => 3,
		'choices'  => [
			'min'  => 1,
			'max'  => 10,
			'step' => 1,
		],
	]
	);

	new \Kirki\Field\Select(
	[
		'settings'    => 'hairstyle_salon_shop_page_layout',
		'label'       => esc_html__( 'Shop Page Layout Setting', 'hairstyle-salon' ),
		'section'     => 'hairstyle_salon_woocommerce_settings',
		'default' => 'Right Sidebar',
		'placeholder' => esc_html__( 'Choose an option', 'hairstyle-salon' ),
		'choices'     => [
			'Left Sidebar' => __('Left Sidebar','hairstyle-salon'),
            'Right Sidebar' => __('Right Sidebar','hairstyle-salon')
		],
	] );

	new \Kirki\Field\Select(
	[
		'settings'    => 'hairstyle_salon_product_page_layout',
		'label'       => esc_html__( 'Product Page Layout Setting', 'hairstyle-salon' ),
		'section'     => 'hairstyle_salon_woocommerce_settings',
		'default' => 'Right Sidebar',
		'placeholder' => esc_html__( 'Choose an option', 'hairstyle-salon' ),
		'choices'     => [
			'Left Sidebar' => __('Left Sidebar','hairstyle-salon'),
            'Right Sidebar' => __('Right Sidebar','hairstyle-salon')
		],
	] );

	new \Kirki\Field\Radio_Buttonset(
	[
		'settings'    => 'hairstyle_salon_woocommerce_pagination_position',
		'label'       => esc_html__( 'Woocommerce Pagination Alignment', 'hairstyle-salon' ),
		'section'     => 'hairstyle_salon_woocommerce_settings',
		'default'     => 'Center',
		'priority'    => 10,
		'choices'     => [
			'Left'   => esc_html__( 'Left', 'hairstyle-salon' ),
			'Center' => esc_html__( 'Center', 'hairstyle-salon' ),
			'Right'  => esc_html__( 'Right', 'hairstyle-salon' ),
		],
	]
	);

}

	// POST SECTION

	Kirki::add_section( 'hairstyle_salon_section_post', array(
	    'title'          => esc_html__( 'Post Settings', 'hairstyle-salon' ),
	    'description'    => esc_html__( 'Here you can get different post settings', 'hairstyle-salon' ),
	    'panel'          => 'hairstyle_salon_panel_id',
	    'priority'       => 160,
	) );

		new \Kirki\Field\Sortable(
	[
		'settings' => 'hairstyle_salon_archive_element_sortable',
		'label'    => __( 'Archive Post Page element Reordering', 'hairstyle-salon' ),
		'section'  => 'hairstyle_salon_section_post',
		'default'  => [ 'option1', 'option2', 'option3' ],
		'choices'  => [
			'option1' => esc_html__( 'Post Meta', 'hairstyle-salon' ),
			'option2' => esc_html__( 'Post Title', 'hairstyle-salon' ),
			'option3' => esc_html__( 'Post Content', 'hairstyle-salon' ),
		],
	]
	);

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'slider',
		'settings'    => 'hairstyle_salon_post_excerpt_number',
		'label'       => esc_html__( 'Post Content Range', 'hairstyle-salon' ),
		'section'     => 'hairstyle_salon_section_post',
		'default'     => 15,
		'choices'     => [
			'min'  => 0,
			'max'  => 100,
			'step' => 1,
		],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'settings'    => 'hairstyle_salon_pagination_setting',
		'label'       => esc_html__( 'Here you can enable or disable your Pagination.', 'hairstyle-salon' ),
		'section'     => 'hairstyle_salon_section_post',
		'default'     => true,
		'priority'    => 10,
	] );

		new \Kirki\Field\Select(
	[
		'settings'    => 'hairstyle_salon_archive_sidebar_layout',
		'label'       => esc_html__( 'Archive Post Sidebar Layout Setting', 'hairstyle-salon' ),
		'section'     => 'hairstyle_salon_section_post',
		'default' => 'Right Sidebar',
		'placeholder' => esc_html__( 'Choose an option', 'hairstyle-salon' ),
		'choices'     => [
			'Left Sidebar' => __('Left Sidebar','hairstyle-salon'),
            'Right Sidebar' => __('Right Sidebar','hairstyle-salon')
		],
	] );

	new \Kirki\Field\Select(
	[
		'settings'    => 'hairstyle_salon_single_post_sidebar_layout',
		'label'       => esc_html__( 'Single Post Sidebar Layout Setting', 'hairstyle-salon' ),
		'section'     => 'hairstyle_salon_section_post',
		'default' => 'Right Sidebar',
		'placeholder' => esc_html__( 'Choose an option', 'hairstyle-salon' ),
		'choices'     => [
			'Left Sidebar' => __('Left Sidebar','hairstyle-salon'),
            'Right Sidebar' => __('Right Sidebar','hairstyle-salon')
		],
	] );

	new \Kirki\Field\Select(
	[
		'settings'    => 'hairstyle_salon_search_sidebar_layout',
		'label'       => esc_html__( 'Search Page Sidebar Layout Setting', 'hairstyle-salon' ),
		'section'     => 'hairstyle_salon_section_post',
		'default' => 'Right Sidebar',
		'placeholder' => esc_html__( 'Choose an option', 'hairstyle-salon' ),
		'choices'     => [
			'Left Sidebar' => __('Left Sidebar','hairstyle-salon'),
            'Right Sidebar' => __('Right Sidebar','hairstyle-salon')
		],
	] );

	Kirki::add_field( 'hairstyle_salon_config', [
		'type'        => 'select',
		'settings'    => 'hairstyle_salon_post_column_count',
		'label'       => esc_html__( 'Grid Column for Archive Page', 'hairstyle-salon' ),
		'section'     => 'hairstyle_salon_section_post',
		'default'    => '2',
		'choices' => [
				'1' => __( '1 Column', 'hairstyle-salon' ),
				'2' => __( '2 Column', 'hairstyle-salon' ),
				'3' => __( '3 Column', 'hairstyle-salon' ),
				'4' => __( '4 Column', 'hairstyle-salon' ),
			],
	] );

	// Breadcrumb
	Kirki::add_section( 'hairstyle_salon_bradcrumb', array(
	    'title'          => esc_html__( 'Breadcrumb Settings', 'hairstyle-salon' ),
	    'description'    => esc_html__( 'Here you can get Breadcrumb settings', 'hairstyle-salon' ),
	    'panel'          => 'hairstyle_salon_panel_id',
	    'priority'       => 160,
	) );

	 Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'hairstyle_salon_enable_breadcrumb_heading',
		'section'     => 'hairstyle_salon_bradcrumb',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Enable / Disable Single Page Breadcrumb', 'hairstyle-salon' ) . '</h3>',
		'priority'    => 10,
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'        => 'switch',
		'settings'    => 'hairstyle_salon_breadcrumb_enable',
		'label'       => esc_html__( 'Breadcrumb Enable / Disable', 'hairstyle-salon' ),
		'section'     => 'hairstyle_salon_bradcrumb',
		'default'     => true,
		'priority'    => 10,
		'choices'     => [
			'on'  => esc_html__( 'Enable', 'hairstyle-salon' ),
			'off' => esc_html__( 'Disable', 'hairstyle-salon' ),
		],
	] );

	Kirki::add_field( 'theme_config_id', [
        'type'     => 'text',
        'default'     => '/',
        'settings' => 'hairstyle_salon_breadcrumb_separator' ,
        'label'    => esc_html__( 'Breadcrumb Separator',  'hairstyle-salon' ),
        'section'  => 'hairstyle_salon_bradcrumb',
    ] );

	// HEADER SECTION

	Kirki::add_section( 'hairstyle_salon_section_header', array(
	    'title'          => esc_html__( 'Header Settings', 'hairstyle-salon' ),
	    'description'    => esc_html__( 'Here you can add header information.', 'hairstyle-salon' ),
	    'panel'          => 'hairstyle_salon_panel_id',
	    'priority'       => 160,
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'hairstyle_salon_enable_search',
		'section'     => 'hairstyle_salon_section_header',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Enable / Disable Search Box', 'hairstyle-salon' ) . '</h3>',
		'priority'    => 10,
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'        => 'switch',
		'settings'    => 'hairstyle_salon_search_box_enable',
		'section'     => 'hairstyle_salon_section_header',
		'default'     => '1',
		'priority'    => 10,
		'choices'     => [
			'on'  => esc_html__( 'Enable', 'hairstyle-salon' ),
			'off' => esc_html__( 'Disable', 'hairstyle-salon' ),
		],
	] );

	// SLIDER SECTION

	Kirki::add_section( 'hairstyle_salon_blog_slide_section', array(
        'title'          => esc_html__( ' Slider Settings', 'hairstyle-salon' ),
        'description'    => esc_html__( 'You have to select post category to show slider.', 'hairstyle-salon' ),
        'panel'          => 'hairstyle_salon_panel_id',
        'priority'       => 160,
    ) );

    Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'hairstyle_salon_enable_heading',
		'section'     => 'hairstyle_salon_blog_slide_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Enable / Disable Slider', 'hairstyle-salon' ) . '</h3>',
		'priority'    => 10,
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'        => 'switch',
		'settings'    => 'hairstyle_salon_blog_box_enable',
		'label'       => esc_html__( 'Section Enable / Disable', 'hairstyle-salon' ),
		'section'     => 'hairstyle_salon_blog_slide_section',
		'default'     => '0',
		'priority'    => 10,
		'choices'     => [
			'on'  => esc_html__( 'Enable', 'hairstyle-salon' ),
			'off' => esc_html__( 'Disable', 'hairstyle-salon' ),
		],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'switch',
		'settings'    => 'hairstyle_salon_title_unable_disable',
		'label'       => esc_html__( 'Slide Title Enable / Disable', 'hairstyle-salon' ),
		'section'     => 'hairstyle_salon_blog_slide_section',
		'default'     => '1',
		'priority'    => 10,
		'choices'     => [
			'on'  => esc_html__( 'Enable', 'hairstyle-salon' ),
			'off' => esc_html__( 'Disable', 'hairstyle-salon' ),
		],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'switch',
		'settings'    => 'hairstyle_salon_button_unable_disable',
		'label'       => esc_html__( 'Slide Button Enable / Disable', 'hairstyle-salon' ),
		'section'     => 'hairstyle_salon_blog_slide_section',
		'default'     => '1',
		'priority'    => 10,
		'choices'     => [
			'on'  => esc_html__( 'Enable', 'hairstyle-salon' ),
			'off' => esc_html__( 'Disable', 'hairstyle-salon' ),
		],
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'hairstyle_salon_slider_heading',
		'section'     => 'hairstyle_salon_blog_slide_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Slider', 'hairstyle-salon' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
        'type'     => 'text',
        'settings' => 'hairstyle_salon_slider_extra_heading' ,
        'label'    => esc_html__( 'Extra Heading',  'hairstyle-salon' ),
        'section'  => 'hairstyle_salon_blog_slide_section',
    ] );

    Kirki::add_field( 'theme_config_id', [
		'type'        => 'number',
		'settings'    => 'hairstyle_salon_blog_slide_number',
		'label'       => esc_html__( 'Number of slides to show', 'hairstyle-salon' ),
		'section'     => 'hairstyle_salon_blog_slide_section',
		'default'     => 0,
		'choices'     => [
			'min'  => 1,
			'max'  => 5,
			'step' => 1,
		],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'select',
		'settings'    => 'hairstyle_salon_blog_slide_category',
		'label'       => esc_html__( 'Select the category to show slider ( Image Dimension 1600 x 600 )', 'hairstyle-salon' ),
		'section'     => 'hairstyle_salon_blog_slide_section',
		'default'     => '',
		'placeholder' => esc_html__( 'Select an category...', 'hairstyle-salon' ),
		'priority'    => 10,
		'choices'     => hairstyle_salon_get_categories_select(),
	] );

	new \Kirki\Field\Select(
	[
		'settings'    => 'hairstyle_salon_slider_content_alignment',
		'label'       => esc_html__( 'Slider Content Alignment', 'hairstyle-salon' ),
		'section'     => 'hairstyle_salon_blog_slide_section',
		'default'     => 'LEFT-ALIGN',
		'placeholder' => esc_html__( 'Choose an option', 'hairstyle-salon' ),
		'choices'     => [
			'LEFT-ALIGN' => esc_html__( 'LEFT-ALIGN', 'hairstyle-salon' ),
			'CENTER-ALIGN' => esc_html__( 'CENTER-ALIGN', 'hairstyle-salon' ),
			'RIGHT-ALIGN' => esc_html__( 'RIGHT-ALIGN', 'hairstyle-salon' ),
		],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'hairstyle_salon_header_phone_number_heading',
		'section'     => 'hairstyle_salon_blog_slide_section',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Add Phone Number', 'hairstyle-salon' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'label'    => esc_html__( 'Text', 'hairstyle-salon' ),
		'settings' => 'hairstyle_salon_header_phone_text',
		'section'  => 'hairstyle_salon_blog_slide_section',
		'default'  => '',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'label'    => esc_html__( 'Phone Number', 'hairstyle-salon' ),
		'settings' => 'hairstyle_salon_header_phone_number',
		'section'  => 'hairstyle_salon_blog_slide_section',
		'default'  => '',
		'sanitize_callback' => 'hairstyle_salon_sanitize_phone_number',
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'hairstyle_salon_enable_socail_link',
		'section'     => 'hairstyle_salon_blog_slide_section',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Social Media Link', 'hairstyle-salon' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'repeater',
		'section'     => 'hairstyle_salon_blog_slide_section',
		'row_label' => [
			'type'  => 'field',
			'value' => esc_html__( 'Social Icon', 'hairstyle-salon' ),
			'field' => 'link_text',
		],
		'button_label' => esc_html__('Add New Social Icon', 'hairstyle-salon' ),
		'settings'     => 'hairstyle_salon_social_links_settings',
		'default'      => '',
		'fields' 	   => [
			'link_text' => [
				'type'        => 'text',
				'label'       => esc_html__( 'Icon', 'hairstyle-salon' ),
				'description' => esc_html__( 'Add the fontawesome class ex: "fab fa-facebook-f".', 'hairstyle-salon' ),
				'default'     => '',
			],
			'link_url' => [
				'type'        => 'url',
				'label'       => esc_html__( 'Social Link', 'hairstyle-salon' ),
				'description' => esc_html__( 'Add the social icon url here.', 'hairstyle-salon' ),
				'default'     => '',
			],
		],
		'choices' => [
			'limit' => 5
		],
	] );

		new \Kirki\Field\Select(
	[
		'settings'    => 'hairstyle_salon_slider_opacity_color',
		'label'       => esc_html__( 'Slider Opacity Option', 'hairstyle-salon' ),
		'section'     => 'hairstyle_salon_blog_slide_section',
		'default'     => '0.5',
		'placeholder' => esc_html__( 'Choose an option', 'hairstyle-salon' ),
		'choices'     => [
			'0' => esc_html__( '0', 'hairstyle-salon' ),
			'0.1' => esc_html__( '0.1', 'hairstyle-salon' ),
			'0.2' => esc_html__( '0.2', 'hairstyle-salon' ),
			'0.3' => esc_html__( '0.3', 'hairstyle-salon' ),
			'0.4' => esc_html__( '0.4', 'hairstyle-salon' ),
			'0.5' => esc_html__( '0.5', 'hairstyle-salon' ),
			'0.6' => esc_html__( '0.6', 'hairstyle-salon' ),
			'0.7' => esc_html__( '0.7', 'hairstyle-salon' ),
			'0.8' => esc_html__( '0.8', 'hairstyle-salon' ),
			'0.9' => esc_html__( '0.9', 'hairstyle-salon' ),
			'1.0' => esc_html__( '1.0', 'hairstyle-salon' ),
			

		],
	] );

	 Kirki::add_field( 'theme_config_id', [
		'type'        => 'switch',
		'settings'    => 'hairstyle_salon_overlay_option',
		'label'       => esc_html__( 'Enable / Disable Slider Overlay', 'hairstyle-salon' ),
		'section'     => 'hairstyle_salon_blog_slide_section',
		'default'     => false,
		'priority'    => 10,
		'choices'     => [
			'on'  => esc_html__( 'Enable', 'hairstyle-salon' ),
			'off' => esc_html__( 'Disable', 'hairstyle-salon' ),
		],
	] );

	 Kirki::add_field( 'theme_config_id', [
		'type'        => 'color',
		'settings'    => 'hairstyle_salon_slider_image_overlay_color',
		'label'       => __( 'choose your Appropriate Overlay Color', 'hairstyle-salon' ),
		'section'     => 'hairstyle_salon_blog_slide_section',
		'default'     => '',
	] );

	//OUR SERVICES SECTION

	Kirki::add_section( 'hairstyle_salon_what_we_do_section', array(
	    'title'          => esc_html__( 'Our Services Settings', 'hairstyle-salon' ),
	    'description'    => esc_html__( 'Here you can add services post.', 'hairstyle-salon' ),
	    'panel'          => 'hairstyle_salon_panel_id',
	    'priority'       => 160,
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'hairstyle_salon_enable_heading',
		'section'     => 'hairstyle_salon_what_we_do_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Enable / Disable Our Services',  'hairstyle-salon' ) . '</h3>',
		'priority'    => 1,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'switch',
		'settings'    => 'hairstyle_salon_what_we_do_section_enable',
		'label'       => esc_html__( 'Section Enable / Disable',  'hairstyle-salon' ),
		'section'     => 'hairstyle_salon_what_we_do_section',
		'default'     => '0',
		'priority'    => 2,
		'choices'     => [
			'on'  => esc_html__( 'Enable',  'hairstyle-salon' ),
			'off' => esc_html__( 'Disable',  'hairstyle-salon' ),
		],
	] );

	Kirki::add_field( 'theme_config_id', [
        'type'     => 'text',
        'settings' => 'hairstyle_salon_what_we_do_short_heading' ,
        'label'    => esc_html__( 'Short Heading',  'hairstyle-salon' ),
        'section'  => 'hairstyle_salon_what_we_do_section',
    ] );

	Kirki::add_field( 'theme_config_id', [
        'type'     => 'text',
        'settings' => 'hairstyle_salon_what_we_do_heading' ,
        'label'    => esc_html__( 'Heading',  'hairstyle-salon' ),
        'section'  => 'hairstyle_salon_what_we_do_section',
    ] );

    Kirki::add_field( 'theme_config_id', [
		'type'        => 'number',
		'settings'    => 'hairstyle_salon_what_we_do_left_number',
		'label'       => esc_html__( 'Number of post to show', 'hairstyle-salon' ),
		'section'     => 'hairstyle_salon_what_we_do_section',
		'default'     => 0,
		'choices'     => [
			'min'  => 1,
			'max'  => 10,
			'step' => 1,
		],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'select',
		'settings'    => 'hairstyle_salon_what_we_do_left_category',
		'label'       => esc_html__( 'Select the category to show post', 'hairstyle-salon' ),
		'section'     => 'hairstyle_salon_what_we_do_section',
		'default'     => '',
		'placeholder' => esc_html__( 'Select an category...', 'hairstyle-salon' ),
		'priority'    => 10,
		'choices'     => hairstyle_salon_get_categories_select(),
	] );

	// FOOTER SECTION

	Kirki::add_section( 'hairstyle_salon_footer_section', array(
        'title'          => esc_html__( 'Footer Settings', 'hairstyle-salon' ),
        'description'    => esc_html__( 'Here you can change copyright text', 'hairstyle-salon' ),
        'panel'          => 'hairstyle_salon_panel_id',
        'priority'       => 160,
    ) );

    Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'hairstyle_salon_footer_enable_heading',
		'section'     => 'hairstyle_salon_footer_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Enable / Disable Footer Link', 'hairstyle-salon' ) . '</h3>',
		'priority'    => 10,
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'        => 'switch',
		'settings'    => 'hairstyle_salon_copyright_enable',
		'label'       => esc_html__( 'Section Enable / Disable', 'hairstyle-salon' ),
		'section'     => 'hairstyle_salon_footer_section',
		'default'     => '1',
		'priority'    => 10,
		'choices'     => [
			'on'  => esc_html__( 'Enable', 'hairstyle-salon' ),
			'off' => esc_html__( 'Disable', 'hairstyle-salon' ),
		],
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'hairstyle_salon_footer_text_heading',
		'section'     => 'hairstyle_salon_footer_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Footer Copyright Text', 'hairstyle-salon' ) . '</h3>',
		'priority'    => 10,
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'settings' => 'hairstyle_salon_footer_text',
		'section'  => 'hairstyle_salon_footer_section',
		'default'  => '',
		'priority' => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
	'type'        => 'custom',
	'settings'    => 'hairstyle_salon_footer_text_heading_2',
	'section'     => 'hairstyle_salon_footer_section',
		'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Footer Copyright Alignment', 'hairstyle-salon' ) . '</h3>',
	'priority'    => 10,
	] );

	new \Kirki\Field\Select(
	[
		'settings'    => 'hairstyle_salon_copyright_text_alignment',
		'label'       => esc_html__( 'Copyright text Alignment', 'hairstyle-salon' ),
		'section'     => 'hairstyle_salon_footer_section',
		'default'     => 'LEFT-ALIGN',
		'placeholder' => esc_html__( 'Choose an option', 'hairstyle-salon' ),
		'choices'     => [
			'LEFT-ALIGN' => esc_html__( 'LEFT-ALIGN', 'hairstyle-salon' ),
			'CENTER-ALIGN' => esc_html__( 'CENTER-ALIGN', 'hairstyle-salon' ),
			'RIGHT-ALIGN' => esc_html__( 'RIGHT-ALIGN', 'hairstyle-salon' ),

		],
	] );

	Kirki::add_field( 'theme_config_id', [
	'type'        => 'custom',
	'settings'    => 'hairstyle_salon_footer_text_heading_1',
	'section'     => 'hairstyle_salon_footer_section',
		'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Footer Copyright Background Color', 'hairstyle-salon' ) . '</h3>',
	'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'color',
		'settings'    => 'hairstyle_salon_copyright_bg',
		'label'       => __( 'Choose Your Copyright Background Color', 'hairstyle-salon' ),
		'section'     => 'hairstyle_salon_footer_section',
		'default'     => '',
	] );
}