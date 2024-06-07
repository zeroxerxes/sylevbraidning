<?php
//about theme info
add_action( 'admin_menu', 'nail_salon_lite_abouttheme' );
function nail_salon_lite_abouttheme() {    	
	add_theme_page( esc_html__('About Theme', 'nail-salon-lite'), esc_html__('About Theme', 'nail-salon-lite'), 'edit_theme_options', 'nail_salon_lite_guide', 'nail_salon_lite_mostrar_guide');   
} 
//guidline for about theme
function nail_salon_lite_mostrar_guide() { 
	//custom function about theme customizer
	$return = add_query_arg( array()) ;
?>
<div class="wrapper-info">
	<div class="col-left">
   		   <div class="col-left-area">
			  <?php esc_html_e('Theme Information', 'nail-salon-lite'); ?>
		   </div>
          <p><?php esc_html_e('Nail Salon WordPress theme for beauty salons, beauty shops, beauty spas, cosmetics, hairdressers, barber, hair stylist, health, lifestyle, massage, salon, spa booking, wellness, and cosmetic stores. Nail spas, nail bars, makeup bars, and nail polish templates, nail care, eyebrow tattooing, eyelash, brow bar, manicure, pedicure, waxing, threading, massage, steam bath, hair care and other saloon related services, skincare products, hair and body cosmetics, fragrances, and health and beauty items. Easy to use via Elementor. Simple, flexible and scalable.','nail-salon-lite'); ?></p>
          <a href="<?php echo esc_url(NAIL_SALON_LITE_SKTTHEMES_PRO_THEME_URL); ?>"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/free-vs-pro.png" alt="" /></a>
	</div><!-- .col-left -->
	<div class="col-right">			
			<div class="centerbold">
				<hr />
				<a href="<?php echo esc_url(NAIL_SALON_LITE_SKTTHEMES_LIVE_DEMO); ?>" target="_blank"><?php esc_html_e('Live Demo', 'nail-salon-lite'); ?></a> | 
				<a href="<?php echo esc_url(NAIL_SALON_LITE_SKTTHEMES_PRO_THEME_URL); ?>"><?php esc_html_e('Buy Pro', 'nail-salon-lite'); ?></a> | 
				<a href="<?php echo esc_url(NAIL_SALON_LITE_SKTTHEMES_THEME_DOC); ?>" target="_blank"><?php esc_html_e('Documentation', 'nail-salon-lite'); ?></a>
                <div class="space5"></div>
				<hr />                
                <a href="<?php echo esc_url(NAIL_SALON_LITE_SKTTHEMES_THEMES); ?>" target="_blank"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/sktskill.jpg" alt="" /></a>
			</div>		
	</div><!-- .col-right -->
</div><!-- .wrapper-info -->
<?php } ?>