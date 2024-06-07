<?php
//about theme info
add_action( 'admin_menu', 'skt_skincare_abouttheme' );
function skt_skincare_abouttheme() {    	
	add_theme_page( esc_html__('About Theme', 'skt-skincare'), esc_html__('About Theme', 'skt-skincare'), 'edit_theme_options', 'skt_skincare_guide', 'skt_skincare_mostrar_guide');   
} 
//guidline for about theme
function skt_skincare_mostrar_guide() { 
	//custom function about theme customizer
	$return = add_query_arg( array()) ;
?>
<div class="wrapper-info">
	<div class="col-left">
   		   <div class="col-left-area">
			  <?php esc_html_e('Theme Information', 'skt-skincare'); ?>
		   </div>
          <p><?php esc_html_e('SKT Skin Care caters to cosmetics shop, fashion Stores, beauty Stores, Spa Products Online, Salon Equipments, Makeup Kits, eCommerce Gifts Stores, Clothing Business, and fragrance products, Perfumes Shop, skincare creams, beauty salon, beauty spa, beauty center shop, face creams, handmade foundation, organic cosmetic shop, cosmetic store, cosmetic products, beauty products, cosmetics makeup, eye care, lip care, neck creams, body care, wellness, massage, healing, meditation reiki, health, yoga, feminine, girly, woman, baby care. Is easy to use, flexible, lightweight and includes call to action. SEO friendly, responsive and made with Gutenberg block editor.','skt-skincare'); ?></p>
          <a href="<?php echo esc_url(SKT_SKINCARE_SKTTHEMES_PRO_THEME_URL); ?>"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/free-vs-pro.png" alt="" /></a>
	</div><!-- .col-left -->
	<div class="col-right">			
			<div class="centerbold">
				<hr />
				<a href="<?php echo esc_url(SKT_SKINCARE_SKTTHEMES_LIVE_DEMO); ?>" target="_blank"><?php esc_html_e('Live Demo', 'skt-skincare'); ?></a> | 
				<a href="<?php echo esc_url(SKT_SKINCARE_SKTTHEMES_PRO_THEME_URL); ?>"><?php esc_html_e('Buy Pro', 'skt-skincare'); ?></a> | 
				<a href="<?php echo esc_url(SKT_SKINCARE_SKTTHEMES_THEME_DOC); ?>" target="_blank"><?php esc_html_e('Documentation', 'skt-skincare'); ?></a>
                <div class="space5"></div>
				<hr />                
                <a href="<?php echo esc_url(SKT_SKINCARE_SKTTHEMES_THEMES); ?>" target="_blank"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/sktskill.jpg" alt="" /></a>
			</div>		
	</div><!-- .col-right -->
</div><!-- .wrapper-info -->
<?php } ?>