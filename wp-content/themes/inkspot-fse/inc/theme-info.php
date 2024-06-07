<?php
/**
 * Add Theme info Page
 */

function inkspot_fse_menu() {
	add_theme_page( esc_html__( 'Inkspot FSE', 'inkspot-fse' ), esc_html__( 'About Inkspot FSE', 'inkspot-fse' ), 'edit_theme_options', 'about-inkspot-fse', 'inkspot_fse_theme_page_display' );
}
add_action( 'admin_menu', 'inkspot_fse_menu' );

function inkspot_fse_admin_theme_style() {
	wp_enqueue_style('inkspot-fse-custom-admin-style', esc_url(get_template_directory_uri()) . '/assets/css/admin-styles.css');
}
add_action('admin_enqueue_scripts', 'inkspot_fse_admin_theme_style');

/**
 * Display About page
 */
function inkspot_fse_theme_page_display() {
	$theme = wp_get_theme();

	if ( is_child_theme() ) {
		$theme = wp_get_theme()->parent();
	} ?>

		<div class="Grace-wrapper">
			<div class="Grcae-info-holder">
				<div class="Grcae-info-holder-content">
					<div class="Grace-Welcome">
						<h1 class="welcomeTitle"><?php esc_html_e( 'About Theme Info', 'inkspot-fse' ); ?></h1>                        
						<div class="featureDesc">
							<?php echo esc_html__( 'The Inkspot FSE is a free tattoo artists WordPress theme for tattoo artist, tattoo studios, piercing expert, beard dresser, hairdresser and other similar websites can use it best.', 'inkspot-fse' ); ?>
						</div>
						
                        <h1 class="welcomeTitle"><?php esc_html_e( 'Theme Features', 'inkspot-fse' ); ?></h1>

                        <h2><?php esc_html_e( 'Block Compatibale', 'inkspot-fse' ); ?></h2>
                        <div class="featureDesc">
                            <?php echo esc_html__( 'The built-in customizer panel quickly change aspects of the design and display changes live before saving them.', 'inkspot-fse' ); ?>
                        </div>
                        
                        <h2><?php esc_html_e( 'Responsive Ready', 'inkspot-fse' ); ?></h2>
                        <div class="featureDesc">
                            <?php echo esc_html__( 'The themes layout will automatically adjust and fit on any screen resolution and looks great on any device. Fully optimized for iPhone and iPad.', 'inkspot-fse' ); ?>
                        </div>
                        
                        <h2><?php esc_html_e( 'Cross Browser Compatible', 'inkspot-fse' ); ?></h2>
                        <div class="featureDesc">
                            <?php echo esc_html__( 'Our themes are tested in all mordern web browsers and compatible with the latest version including Chrome,Firefox, Safari, Opera, IE11 and above.', 'inkspot-fse' ); ?>
                        </div>
                        
                        <h2><?php esc_html_e( 'E-commerce', 'inkspot-fse' ); ?></h2>
                        <div class="featureDesc">
                            <?php echo esc_html__( 'Fully compatible with WooCommerce plugin. Just install the plugin and turn your site into a full featured online shop and start selling products.', 'inkspot-fse' ); ?>
                        </div>

					</div> <!-- .Grace-Welcome -->
				</div> <!-- .Grcae-info-holder-content -->
				
				
				<div class="Grcae-info-holder-sidebar">
                        <div class="sidebarBX">
                            <h2 class="sidebarBX-title"><?php echo esc_html__( 'Get Inkspot PRO', 'inkspot-fse' ); ?></h2>
                            <p><?php echo esc_html__( 'More features availbale on Premium version', 'inkspot-fse' ); ?></p>
                            <a href="<?php echo esc_url( 'https://gracethemes.com/themes/tattoo-studio-wordpress-theme/' ); ?>" target="_blank" class="button"><?php esc_html_e( 'Get the PRO Version &rarr;', 'inkspot-fse' ); ?></a>
                        </div>


						<div class="sidebarBX">
							<h2 class="sidebarBX-title"><?php echo esc_html__( 'Important Links', 'inkspot-fse' ); ?></h2>

							<ul class="themeinfo-links">
                                <li>
									<a href="<?php echo esc_url( 'https://gracethemesdemo.com/inkspot/' ); ?>" target="_blank"><?php echo esc_html__( 'Demo Preview', 'inkspot-fse' ); ?></a>
								</li>                               
								<li>
									<a href="<?php echo esc_url( 'https://gracethemesdemo.com/documentation/inkspot/#homepage-lite' ); ?>" target="_blank"><?php echo esc_html__( 'Documentation', 'inkspot-fse' ); ?></a>
								</li>
								
								<li>
									<a href="<?php echo esc_url( 'https://gracethemes.com/wordpress-themes/' ); ?>" target="_blank"><?php echo esc_html__( 'View Our Premium Themes', 'inkspot-fse' ); ?></a>
								</li>
							</ul>
						</div>

						<div class="sidebarBX">
							<h2 class="sidebarBX-title"><?php echo esc_html__( 'Leave us a review', 'inkspot-fse' ); ?></h2>
							<p><?php echo esc_html__( 'If you are satisfied with Inkspot FSE, please give your feedback.', 'inkspot-fse' ); ?></p>
							<a href="https://wordpress.org/support/theme/inkspot-fse/reviews/" class="button" target="_blank"><?php esc_html_e( 'Submit a review', 'inkspot-fse' ); ?></a>
						</div>

				</div><!-- .Grcae-info-holder-sidebar -->	

			</div> <!-- .Grcae-info-holder -->
		</div><!-- .Grace-wrapper -->
<?php } ?>