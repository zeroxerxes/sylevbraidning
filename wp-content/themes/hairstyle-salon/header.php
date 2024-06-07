<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

<meta http-equiv="Content-Type" content="<?php echo esc_attr(get_bloginfo('html_type')); ?>; charset=<?php echo esc_attr(get_bloginfo('charset')); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.2, user-scalable=yes" />

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<?php
	if ( function_exists( 'wp_body_open' ) )
	{
		wp_body_open();
	}else{
		do_action('wp_body_open');
	}
?>

<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'hairstyle-salon' ); ?></a>

<?php if ( get_theme_mod('hairstyle_salon_site_loader', false) == true ) : ?>
	<div class="cssloader">
    	<div class="sh1"></div>
    	<div class="sh2"></div>
    	<h1 class="lt"><?php esc_html_e( 'loading',  'hairstyle-salon' ); ?></h1>
    </div>
<?php endif; ?>

<header id="site-navigation">
	<div class="container">
		<div class="row">
			<div class="col-lg-3 col-md-3 col-sm-4 align-self-center">
				<div class="logo text-center text-md-start">
		    		<div class="logo-image">
		    			<?php the_custom_logo(); ?>
			    	</div>
			    	<div class="logo-content">
				    	<?php
				    		if ( get_theme_mod('hairstyle_salon_display_header_title', true) == true ) :
					      		echo '<a href="' . esc_url(home_url('/')) . '" title="' . esc_attr(get_bloginfo('name')) . '">';
					      			echo esc_html(get_bloginfo('name'));
					      		echo '</a>';
					      	endif;

					      	if ( get_theme_mod('hairstyle_salon_display_header_text', false) == true ) :
				      			echo '<span>'. esc_html(get_bloginfo('description')) . '</span>';
				      		endif;
			    		?>
					</div>
				</div>
			</div>
			<div class="col-lg-8 col-md-8 col-sm-8 text-center align-self-center">
				<button class="menu-toggle my-2 py-2 px-3" aria-controls="top-menu" aria-expanded="false" type="button">
					<span aria-hidden="true"><?php esc_html_e( 'Menu', 'hairstyle-salon' ); ?></span>
				</button>
				<nav id="main-menu" class="close-panal">
					<?php
						wp_nav_menu( array(
							'theme_location' => 'main-menu',
							'container' => 'false'
						));
					?>
					<button class="close-menu my-2 p-2" type="button">
						<span aria-hidden="true"><i class="fa fa-times"></i></span>
					</button>
				</nav>
			</div>
			<div class="col-lg-1 col-md-1 col-sm-1 align-self-center serch-box">
				<?php if ( get_theme_mod('hairstyle_salon_search_box_enable', true) == true ) : ?>
                    <div class="header-search text-center">
                        <a class="open-search-form" href="#search-form"><i class="fa fa-search" aria-hidden="true"></i></a>
                        <div class="search-form"><?php get_search_form();?></div>
                    </div>
                <?php endif; ?>
			</div>
		</div>
	</div>
</header>
