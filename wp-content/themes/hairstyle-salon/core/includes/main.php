<?php

/**
* Get started notice
*/

add_action( 'wp_ajax_hairstyle_salon_dismissed_notice_handler', 'hairstyle_salon_ajax_notice_handler' );

/**
 * AJAX handler to store the state of dismissible notices.
 */
function hairstyle_salon_ajax_notice_handler() {
    if ( isset( $_POST['type'] ) ) {
        // Pick up the notice "type" - passed via jQuery (the "data-notice" attribute on the notice)
        $type = sanitize_text_field( wp_unslash( $_POST['type'] ) );
        // Store it in the options table
        update_option( 'dismissed-' . $type, TRUE );
    }
}

function hairstyle_salon_deprecated_hook_admin_notice() {
        // Check if it's been dismissed...
        if ( ! get_option('dismissed-get_started', FALSE ) ) {  ?>
            <?php
            $current_screen = get_current_screen();
				if ($current_screen->id !== 'appearance_page_hairstyle-salon-guide-page') {
             $hairstyle_salon_comments_theme = wp_get_theme(); ?>
            <div class="hairstyle-salon-notice-wrapper updated notice notice-get-started-class is-dismissible" data-notice="get_started">
			<div class="hairstyle-salon-notice">
				<div class="hairstyle-salon-notice-img">
					<img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/admin-logo.png'); ?>" alt="<?php esc_attr_e('logo', 'hairstyle-salon'); ?>">
				</div>
				<div class="hairstyle-salon-notice-content">
					<div class="hairstyle-salon-notice-heading"><?php esc_html_e('Thanks for installing ','hairstyle-salon'); ?><?php echo esc_html( $hairstyle_salon_comments_theme ); ?></div>
					<p><?php printf(__('To avail the benefits of the premium edition, kindly click on <a href="%s">More Options</a>.', 'hairstyle-salon'), esc_url(admin_url('themes.php?page=hairstyle-salon-guide-page'))); ?></p>
				</div>
			</div>
		</div>
        <?php }
	}
}

add_action( 'admin_notices', 'hairstyle_salon_deprecated_hook_admin_notice' );

add_action( 'admin_menu', 'hairstyle_salon_getting_started' );
function hairstyle_salon_getting_started() {
	add_theme_page( esc_html__('Get Started', 'hairstyle-salon'), esc_html__('Get Started', 'hairstyle-salon'), 'edit_theme_options', 'hairstyle-salon-guide-page', 'hairstyle_salon_test_guide');
}

function hairstyle_salon_admin_enqueue_scripts() {
	wp_enqueue_style( 'hairstyle-salon-admin-style', esc_url( get_template_directory_uri() ).'/css/main.css' );
	wp_enqueue_script( 'hairstyle-salon-admin-script', get_template_directory_uri() . '/js/hairstyle-salon-admin-script.js', array( 'jquery' ), '', true );
    wp_localize_script( 'hairstyle-salon-admin-script', 'hairstyle_salon_ajax_object',
        array( 'ajax_url' => admin_url( 'admin-ajax.php' ) )
    );
}
add_action( 'admin_enqueue_scripts', 'hairstyle_salon_admin_enqueue_scripts' );

if ( ! defined( 'HAIRSTYLE_SALON_DOCS_FREE' ) ) {
define('HAIRSTYLE_SALON_DOCS_FREE',__('https://demo.misbahwp.com/docs/hairstyle-salon-free-docs/','hairstyle-salon'));
}
if ( ! defined( 'HAIRSTYLE_SALON_DOCS_PRO' ) ) {
define('HAIRSTYLE_SALON_DOCS_PRO',__('https://demo.misbahwp.com/docs/hairstyle-salon-pro-docs/','hairstyle-salon'));
}
if ( ! defined( 'HAIRSTYLE_SALON_BUY_NOW' ) ) {
define('HAIRSTYLE_SALON_BUY_NOW',__('https://www.misbahwp.com/products/hairstyle-wordpress-theme/','hairstyle-salon'));
}
if ( ! defined( 'HAIRSTYLE_SALON_SUPPORT_FREE' ) ) {
define('HAIRSTYLE_SALON_SUPPORT_FREE',__('https://wordpress.org/support/theme/hairstyle-salon','hairstyle-salon'));
}
if ( ! defined( 'HAIRSTYLE_SALON_REVIEW_FREE' ) ) {
define('HAIRSTYLE_SALON_REVIEW_FREE',__('https://wordpress.org/support/theme/hairstyle-salon/reviews/#new-post','hairstyle-salon'));
}
if ( ! defined( 'HAIRSTYLE_SALON_DEMO_PRO' ) ) {
define('HAIRSTYLE_SALON_DEMO_PRO',__(' https://demo.misbahwp.com/hairstyle-salon/','hairstyle-salon'));
}
if( ! defined( 'HAIRSTYLE_SALON_THEME_BUNDLE' ) ) {
define('HAIRSTYLE_SALON_THEME_BUNDLE',__('https://www.misbahwp.com/products/wordpress-bundle/','hairstyle-salon'));
}


function hairstyle_salon_test_guide() { ?>
	<?php $hairstyle_salon_theme = wp_get_theme(); ?>

	<div class="wrap" id="main-page">
		<div id="lefty">
			<div id="admin_links">
				<a href="<?php echo esc_url( HAIRSTYLE_SALON_DOCS_FREE ); ?>" target="_blank" class="blue-button-1"><?php esc_html_e( 'Documentation', 'hairstyle-salon' ) ?></a>
				<a href="<?php echo esc_url( admin_url('customize.php') ); ?>" id="customizer" target="_blank"><?php esc_html_e( 'Customize', 'hairstyle-salon' ); ?> </a>
				<a class="blue-button-1" href="<?php echo esc_url( HAIRSTYLE_SALON_SUPPORT_FREE ); ?>" target="_blank" class="btn3"><?php esc_html_e( 'Support', 'hairstyle-salon' ) ?></a>
				<a class="blue-button-2" href="<?php echo esc_url( HAIRSTYLE_SALON_REVIEW_FREE ); ?>" target="_blank" class="btn4"><?php esc_html_e( 'Review', 'hairstyle-salon' ) ?></a>
			</div>
			<div id="description">
				<h3><?php esc_html_e('Welcome! Thank you for choosing ','hairstyle-salon'); ?><?php echo esc_html( $hairstyle_salon_theme ); ?>  <span><?php esc_html_e('Version: ', 'hairstyle-salon'); ?><?php echo esc_html($hairstyle_salon_theme['Version']);?></span></h3>
				<img class="img_responsive" style="width: 100%;" src="<?php echo esc_url( $hairstyle_salon_theme->get_screenshot() ); ?>" />
				<div id="description-insidee">
					<?php
						$hairstyle_salon_theme = wp_get_theme();
						echo wp_kses_post( apply_filters( 'misbah_theme_description', esc_html( $hairstyle_salon_theme->get( 'Description' ) ) ) );
					?>
				</div>
			</div>
		</div>

		<div id="righty">
			<div class="postboxx donate">
				<div class="postboxx donate">
				<h3 class="hndle"><?php esc_html_e( 'Upgrade to Premium', 'hairstyle-salon' ); ?></h3>
				<div class="insidee">
					<p><?php esc_html_e('Discover upgraded pro features with premium version click to upgrade.','hairstyle-salon'); ?></p>
					<div id="admin_pro_links">
						<a class="blue-button-2" href="<?php echo esc_url( HAIRSTYLE_SALON_BUY_NOW ); ?>" target="_blank"><?php esc_html_e( 'Go Pro', 'hairstyle-salon' ); ?></a>
						<a class="blue-button-1" href="<?php echo esc_url( HAIRSTYLE_SALON_DEMO_PRO ); ?>" target="_blank"><?php esc_html_e( 'Live Demo', 'hairstyle-salon' ) ?></a>
						<a class="blue-button-2" href="<?php echo esc_url( HAIRSTYLE_SALON_DOCS_PRO ); ?>" target="_blank"><?php esc_html_e( 'Pro Docs', 'hairstyle-salon' ) ?></a>
					</div>
				</div>

				<h3 class="hndle bundle"><?php esc_html_e( 'Go For Theme Bundle', 'hairstyle-salon' ); ?></h3>
				<div class="insidee theme-bundle">
					<p class="offer"><?php esc_html_e('Get 80+ Perfect WordPress Theme In A Single Package at just $79."','hairstyle-salon'); ?></p>
					<p class="coupon"><?php esc_html_e('Get Our Theme Pack of 80+ WordPress Themes At 15% Off','hairstyle-salon'); ?><span class="coupon-code"><?php esc_html_e('"Bundleup15"','hairstyle-salon'); ?></span></p>
					<div id="admin_pro_linkss">
						<a class="blue-button-1" href="<?php echo esc_url( HAIRSTYLE_SALON_THEME_BUNDLE ); ?>" target="_blank"><?php esc_html_e( 'Theme Bundle', 'hairstyle-salon' ) ?></a>
					</div>
				</div>
				<div class="d-table">
			    <ul class="d-column">
			      <li class="feature"><?php esc_html_e('Features','hairstyle-salon'); ?></li>
			      <li class="free"><?php esc_html_e('Pro','hairstyle-salon'); ?></li>
			      <li class="plus"><?php esc_html_e('Free','hairstyle-salon'); ?></li>
			    </ul>
			    <ul class="d-row">
			      <li class="points"><?php esc_html_e('24hrs Priority Support','hairstyle-salon'); ?></li>
			      <li class="right"><span class="dashicons dashicons-yes"></span></li>
			      <li class="wrong"><span class="dashicons dashicons-yes"></span></li>
			    </ul>
			    <ul class="d-row">
			      <li class="points"><?php esc_html_e('LearnPress Campatiblity','hairstyle-salon'); ?></li>
			      <li class="right"><span class="dashicons dashicons-yes"></span></li>
			      <li class="wrong"><span class="dashicons dashicons-yes"></span></li>
			    </ul>
			    <ul class="d-row">
			      <li class="points"><?php esc_html_e('Kirki Framework','hairstyle-salon'); ?></li>
			      <li class="right"><span class="dashicons dashicons-yes"></span></li>
			      <li class="wrong"><span class="dashicons dashicons-yes"></span></li>
			    </ul>
			    <ul class="d-row">
			      <li class="points"><?php esc_html_e('Advance Posttype','hairstyle-salon'); ?></li>
			      <li class="right"><span class="dashicons dashicons-yes"></span></li>
			      <li class="wrong"><span class="dashicons dashicons-no"></span></li>
			    </ul>
			    <ul class="d-row">
			      <li class="points"><?php esc_html_e('One Click Demo Import','hairstyle-salon'); ?></li>
			      <li class="right"><span class="dashicons dashicons-yes"></span></li>
			      <li class="wrong"><span class="dashicons dashicons-no"></span></li>
			    </ul>
			    <ul class="d-row">
			      <li class="points"><?php esc_html_e('Section Reordering','hairstyle-salon'); ?></li>
			      <li class="right"><span class="dashicons dashicons-yes"></span></li>
			      <li class="wrong"><span class="dashicons dashicons-no"></span></li>
			    </ul>
			    <ul class="d-row">
			      <li class="points"><?php esc_html_e('Enable / Disable Option','hairstyle-salon'); ?></li>
			      <li class="right"><span class="dashicons dashicons-yes"></span></li>
			      <li class="wrong"><span class="dashicons dashicons-yes"></span></li>
			    </ul>
			    <ul class="d-row">
			      <li class="points"><?php esc_html_e('Multiple Sections','hairstyle-salon'); ?></li>
			      <li class="right"><span class="dashicons dashicons-yes"></span></li>
			      <li class="wrong"><span class="dashicons dashicons-no"></span></li>
			    </ul>
			    <ul class="d-row">
			      <li class="points"><?php esc_html_e('Advance Color Pallete','hairstyle-salon'); ?></li>
			      <li class="right"><span class="dashicons dashicons-yes"></span></li>
			      <li class="wrong"><span class="dashicons dashicons-no"></span></li>
			    </ul>
			    <ul class="d-row">
			      <li class="points"><?php esc_html_e('Advance Widgets','hairstyle-salon'); ?></li>
			      <li class="right"><span class="dashicons dashicons-yes"></span></li>
			      <li class="wrong"><span class="dashicons dashicons-yes"></span></li>
			    </ul>
			    <ul class="d-row">
			      <li class="points"><?php esc_html_e('Page Templates','hairstyle-salon'); ?></li>
			      <li class="right"><span class="dashicons dashicons-yes"></span></li>
			      <li class="wrong"><span class="dashicons dashicons-no"></span></li>
			    </ul>
			    <ul class="d-row">
			      <li class="points"><?php esc_html_e('Advance Typography','hairstyle-salon'); ?></li>
			      <li class="right"><span class="dashicons dashicons-yes"></span></li>
			      <li class="wrong"><span class="dashicons dashicons-no"></span></li>
			    </ul>
			    <ul class="d-row">
			      <li class="points"><?php esc_html_e('Section Background Image / Color ','hairstyle-salon'); ?></li>
			      <li class="right"><span class="dashicons dashicons-yes"></span></li>
			      <li class="wrong"><span class="dashicons dashicons-no"></span></li>
			    </ul>
	  		</div>
			</div>
		</div>
	</div>

<?php } ?>
