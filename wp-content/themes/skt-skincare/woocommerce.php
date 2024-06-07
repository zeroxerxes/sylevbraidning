<?php
/**
 * @package SKT Skincare
 */
get_header(); ?>
<div class="container">
			<div id="content_navigator">
    		<div class="page_content">
				<div class="woocommerce">
				<?php woocommerce_content(); ?>
                </div>
		   </div><!-- page_content-->
           </div>
    </div><!-- content -->
<?php get_footer(); ?>