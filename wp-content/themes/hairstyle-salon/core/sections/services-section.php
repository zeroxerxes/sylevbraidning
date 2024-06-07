<?php if ( get_theme_mod('hairstyle_salon_what_we_do_section_enable') ) : ?>

<?php $hairstyle_salon_left_args = array(
  'post_type' => 'post',
  'post_status' => 'publish',
  'category_name' =>  get_theme_mod('hairstyle_salon_what_we_do_left_category'),
  'posts_per_page' => get_theme_mod('hairstyle_salon_what_we_do_left_number'),
); ?>

	<div id="our_services" class="py-5">
		<div class="container">
			<?php if ( get_theme_mod('hairstyle_salon_what_we_do_short_heading') ) : ?>
    		<h6 class="text-center"><?php echo esc_html(get_theme_mod('hairstyle_salon_what_we_do_short_heading'));?></h6>
    	<?php endif; ?>
			<?php if ( get_theme_mod('hairstyle_salon_what_we_do_heading') ) : ?>
    		<h2 class="text-center mb-5"><?php echo esc_html(get_theme_mod('hairstyle_salon_what_we_do_heading'));?></h2>
    	<?php endif; ?>
			<div class="row">
				<?php $hairstyle_salon_arr_posts = new WP_Query( $hairstyle_salon_left_args );
			    if ( $hairstyle_salon_arr_posts->have_posts() ) :
			      while ( $hairstyle_salon_arr_posts->have_posts() ) :
			        $hairstyle_salon_arr_posts->the_post(); ?>
			        <div class="col-lg-4 col-md-4 col-sm-4">
								<div class="services-box mb-4">
									<?php
				            if ( has_post_thumbnail() ) :
				              the_post_thumbnail();
				            endif;
				          ?>
				          <div class="box-inner">
										<h3 class="mb-3"><?php the_title(); ?></h3>
										<p><?php echo wp_trim_words( get_the_content(), 20 ); ?></p>
			              <a href="<?php echo esc_url(get_permalink($post->ID)); ?>"><?php esc_html_e('Read More','hairstyle-salon'); ?></a>
			    				</div>
								</div>
							</div>
			    <?php
			    endwhile;
			    wp_reset_postdata();
			    endif; ?>
			</div>
		</div>
	</div>
<?php endif; ?>