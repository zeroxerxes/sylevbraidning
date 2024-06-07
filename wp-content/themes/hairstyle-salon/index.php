<?php get_header(); ?>

<div id="content">
    <div class="feature-header">
      <div class="feature-post-thumbnail">
        <div class="slider-alternate">
          <img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/banner.png'; ?>">
        </div>
        <h1 class="post-title feature-header-title"><?php echo(esc_html_e('Archive Post','hairstyle-salon')); ?></h1>
        <?php if ( get_theme_mod('hairstyle_salon_breadcrumb_enable',true) ) : ?>
          <div class="bread_crumb text-center">
            <?php hairstyle_salon_breadcrumb();  ?>
          </div>
        <?php endif; ?>
      </div>
    </div>
  <div class="container">
    <div class="row">
      <?php if(get_theme_mod('hairstyle_salon_archive_sidebar_layout', 'Right Sidebar') == 'Right Sidebar'){ ?>
      <div class="col-lg-8 col-md-8 mt-5">
        <div class="row">
          <?php
            if ( have_posts() ) :

              while ( have_posts() ) :

                the_post();
                get_template_part( 'template-parts/content', get_post_format() );

              endwhile;

            else:

              esc_html_e( 'Sorry, no post found on this archive.', 'hairstyle-salon' );

            endif;

            get_template_part( 'template-parts/pagination' );
          ?>
        </div>
      </div>
      <div class="col-lg-4 col-md-4">
        <?php get_sidebar(); ?>
      </div>
      <?php } elseif(get_theme_mod('hairstyle_salon_archive_sidebar_layout', 'Right Sidebar') == 'Left Sidebar'){ ?>
      <div class="col-lg-4 col-md-4">
        <?php get_sidebar(); ?>
      </div>
       <div class="col-lg-8 col-md-8 mt-5">
        <div class="row">
          <?php
            if ( have_posts() ) :

              while ( have_posts() ) :

                the_post();
                get_template_part( 'template-parts/content', get_post_format() );

              endwhile;

            else:

              esc_html_e( 'Sorry, no post found on this archive.', 'hairstyle-salon' );

            endif;

            get_template_part( 'template-parts/pagination' );
          ?>
        </div>
      </div>
      <?php } ?>
    </div>
  </div>
</div>

<?php get_footer(); ?>