<?php
	
require get_template_directory() . '/core/includes/class-tgm-plugin-activation.php';

/**
 * Recommended plugins.
 */
function hairstyle_salon_register_recommended_plugins() {
	$plugins = array(
		array(
			'name'             => __( 'Kirki Customizer Framework', 'hairstyle-salon' ),
			'slug'             => 'kirki',
			'required'         => false,
			'force_activation' => false,
		),
	);
	$config = array();
	hairstyle_salon_tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'hairstyle_salon_register_recommended_plugins' );