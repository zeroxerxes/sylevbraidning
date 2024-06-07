<?php if ( get_theme_mod('hairstyle_salon_blog_box_enable') ) : ?>

<?php $hairstyle_salon_args = array(
  'post_type' => 'post',
  'post_status' => 'publish',
  'category_name' =>  get_theme_mod('hairstyle_salon_blog_slide_category'),
  'posts_per_page' => get_theme_mod('hairstyle_salon_blog_slide_number'),
); ?>

<div class="slider">
  <div class="owl-carousel">
    <?php $hairstyle_salon_arr_posts = new WP_Query( $hairstyle_salon_args );
    if ( $hairstyle_salon_arr_posts->have_posts() ) :
      while ( $hairstyle_salon_arr_posts->have_posts() ) :
        $hairstyle_salon_arr_posts->the_post();
        ?>
        <div class="blog_inner_box">
          <?php
            if ( has_post_thumbnail() ) :
              the_post_thumbnail();
            else:
              ?>
              <div class="slider-alternate">
                <img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/banner.png'; ?>">
              </div>
              <?php
            endif;
          ?>
          <div class="blog_box pt-3 pt-md-0">
            <?php if ( get_theme_mod('hairstyle_salon_slider_extra_heading') ) : ?>
              <h5><?php echo esc_html(get_theme_mod('hairstyle_salon_slider_extra_heading'));?></h5>
            <?php endif; ?>
            <?php if ( get_theme_mod('hairstyle_salon_title_unable_disable',true) ) : ?>
              <h3 class="my-3"><?php the_title(); ?></a></h3>
            <?php endif; ?>
            <p class="mb-0"><?php echo wp_trim_words( get_the_content(), 20 ); ?></p>
            <?php if ( get_theme_mod('hairstyle_salon_button_unable_disable',true) ) : ?>
              <p class="slider-button mt-4">
                <a href="<?php echo esc_url(get_permalink($post->ID)); ?>"><?php esc_html_e('Read More','hairstyle-salon'); ?></a>
              </p>
            <?php endif; ?>
          </div>
          <div class="right-slider-box">
            <div class="social-links mt-4">
              <?php $hairstyle_salon_settings = get_theme_mod( 'hairstyle_salon_social_links_settings' ); ?>
              <?php if ( is_array($hairstyle_salon_settings) || is_object($hairstyle_salon_settings) ){ ?>
                <?php foreach( $hairstyle_salon_settings as $hairstyle_salon_setting ) { ?>
                  <a href="<?php echo esc_url( $hairstyle_salon_setting['link_url'] ); ?>">
                    <i class="<?php echo esc_attr( $hairstyle_salon_setting['link_text'] ); ?>"></i>
                  </a>
                <?php } ?>
              <?php } ?>
            </div>
            <div class="phone-box">
              <?php if ( get_theme_mod('hairstyle_salon_header_phone_text') || get_theme_mod('hairstyle_salon_header_phone_number') ) : ?>
                <div class="row">
                  <div class="col-lg-3 col-md-3 col-sm-3 align-self-center">
                    <i class="fas fa-phone"></i>
                  </div>
                  <div class="col-lg-9 col-md-9 col-sm-9 align-self-center">
                    <h6><?php echo esc_html( get_theme_mod('hairstyle_salon_header_phone_text' ) ); ?></h6>
                    <p class="mb-0"><?php echo esc_html( get_theme_mod('hairstyle_salon_header_phone_number' ) ); ?></p>
                  </div>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
      <?php
    endwhile;
    wp_reset_postdata();
    endif; ?>
  </div>
</div>

<?php endif; ?>