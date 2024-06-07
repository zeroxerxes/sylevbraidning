<?php


$hairstyle_salon_custom_css = '';

	/*---------------------------text-transform-------------------*/

	$hairstyle_salon_text_transform = get_theme_mod( 'menu_text_transform_hairstyle_salon','CAPITALISE');
    if($hairstyle_salon_text_transform == 'CAPITALISE'){

		$hairstyle_salon_custom_css .='#main-menu ul li a{';

			$hairstyle_salon_custom_css .='text-transform: capitalize ; font-size: 15px;';

		$hairstyle_salon_custom_css .='}';

	}else if($hairstyle_salon_text_transform == 'UPPERCASE'){

		$hairstyle_salon_custom_css .='#main-menu ul li a{';

			$hairstyle_salon_custom_css .='text-transform: uppercase ; font-size: 15px;';

		$hairstyle_salon_custom_css .='}';

	}else if($hairstyle_salon_text_transform == 'LOWERCASE'){

		$hairstyle_salon_custom_css .='#main-menu ul li a{';

			$hairstyle_salon_custom_css .='text-transform: lowercase ; font-size: 15px;';

		$hairstyle_salon_custom_css .='}';
	}

	/*---------------------------menu-zoom-------------------*/

		$hairstyle_salon_menu_zoom = get_theme_mod( 'hairstyle_salon_menu_zoom','None');

    if($hairstyle_salon_menu_zoom == 'None'){

		$hairstyle_salon_custom_css .='#main-menu ul li a{';

			$hairstyle_salon_custom_css .='';

		$hairstyle_salon_custom_css .='}';

	}else if($hairstyle_salon_menu_zoom == 'Zoominn'){

		$hairstyle_salon_custom_css .='#main-menu ul li a:hover{';

			$hairstyle_salon_custom_css .='transition: all 0.3s ease-in-out !important; transform: scale(1.2) !important; color: #f5516d;';

		$hairstyle_salon_custom_css .='}';
	}

	/*---------------------------Container Width-------------------*/

$hairstyle_salon_container_width = get_theme_mod('hairstyle_salon_container_width');

		$hairstyle_salon_custom_css .='body{';

			$hairstyle_salon_custom_css .='width: '.esc_attr($hairstyle_salon_container_width).'%; margin: auto';

		$hairstyle_salon_custom_css .='}';


	/*---------------------------Slider-content-alignment-------------------*/

$hairstyle_salon_slider_content_alignment = get_theme_mod( 'hairstyle_salon_slider_content_alignment','LEFT-ALIGN');

 if($hairstyle_salon_slider_content_alignment == 'LEFT-ALIGN'){

		$hairstyle_salon_custom_css .='.blog_box{';

			$hairstyle_salon_custom_css .='text-align:left;';

		$hairstyle_salon_custom_css .='}';


	}else if($hairstyle_salon_slider_content_alignment == 'CENTER-ALIGN'){

		$hairstyle_salon_custom_css .='.blog_box{';

			$hairstyle_salon_custom_css .='text-align:center;';

		$hairstyle_salon_custom_css .='}';


	}else if($hairstyle_salon_slider_content_alignment == 'RIGHT-ALIGN'){

		$hairstyle_salon_custom_css .='.blog_box{';

			$hairstyle_salon_custom_css .='text-align:right;';

		$hairstyle_salon_custom_css .='}';

	}

	/*---------------------------Copyright Text alignment-------------------*/

$hairstyle_salon_copyright_text_alignment = get_theme_mod( 'hairstyle_salon_copyright_text_alignment','LEFT-ALIGN');

 if($hairstyle_salon_copyright_text_alignment == 'LEFT-ALIGN'){

		$hairstyle_salon_custom_css .='.copy-text p{';

			$hairstyle_salon_custom_css .='text-align:left;';

		$hairstyle_salon_custom_css .='}';


	}else if($hairstyle_salon_copyright_text_alignment == 'CENTER-ALIGN'){

		$hairstyle_salon_custom_css .='.copy-text p{';

			$hairstyle_salon_custom_css .='text-align:center;';

		$hairstyle_salon_custom_css .='}';


	}else if($hairstyle_salon_copyright_text_alignment == 'RIGHT-ALIGN'){

		$hairstyle_salon_custom_css .='.copy-text p{';

			$hairstyle_salon_custom_css .='text-align:right;';

		$hairstyle_salon_custom_css .='}';

	}

		/*---------------------------related Product Settings-------------------*/


$hairstyle_salon_related_product_setting = get_theme_mod('hairstyle_salon_related_product_setting',true);

	if($hairstyle_salon_related_product_setting == false){

		$hairstyle_salon_custom_css .='.related.products, .related h2{';

			$hairstyle_salon_custom_css .='display: none;';

		$hairstyle_salon_custom_css .='}';
	}

	/*---------------------------Scroll to Top Alignment Settings-------------------*/

	$hairstyle_salon_scroll_top_position = get_theme_mod( 'hairstyle_salon_scroll_top_position','Right');

	if($hairstyle_salon_scroll_top_position == 'Right'){

		$hairstyle_salon_custom_css .='.scroll-up{';

			$hairstyle_salon_custom_css .='right: 20px;';

		$hairstyle_salon_custom_css .='}';

	}else if($hairstyle_salon_scroll_top_position == 'Left'){

		$hairstyle_salon_custom_css .='.scroll-up{';

			$hairstyle_salon_custom_css .='left: 20px;';

		$hairstyle_salon_custom_css .='}';

	}else if($hairstyle_salon_scroll_top_position == 'Center'){

		$hairstyle_salon_custom_css .='.scroll-up{';

			$hairstyle_salon_custom_css .='right: 50%;left: 50%;';

		$hairstyle_salon_custom_css .='}';
	}

	/*---------------------------Pagination Settings-------------------*/


	$hairstyle_salon_pagination_setting = get_theme_mod('hairstyle_salon_pagination_setting',true);

	if($hairstyle_salon_pagination_setting == false){

		$hairstyle_salon_custom_css .='.nav-links{';

			$hairstyle_salon_custom_css .='display: none;';

		$hairstyle_salon_custom_css .='}';
	}

		/*--------------------------- Slider Opacity -------------------*/

	$hairstyle_salon_slider_opacity_color = get_theme_mod( 'hairstyle_salon_slider_opacity_color','0.5');

	if($hairstyle_salon_slider_opacity_color == '0'){

		$hairstyle_salon_custom_css .='.blog_inner_box img{';

			$hairstyle_salon_custom_css .='opacity:0';

		$hairstyle_salon_custom_css .='}';

		}else if($hairstyle_salon_slider_opacity_color == '0.1'){

		$hairstyle_salon_custom_css .='.blog_inner_box img{';

			$hairstyle_salon_custom_css .='opacity:0.1';

		$hairstyle_salon_custom_css .='}';

		}else if($hairstyle_salon_slider_opacity_color == '0.2'){

		$hairstyle_salon_custom_css .='.blog_inner_box img{';

			$hairstyle_salon_custom_css .='opacity:0.2';

		$hairstyle_salon_custom_css .='}';

		}else if($hairstyle_salon_slider_opacity_color == '0.3'){

		$hairstyle_salon_custom_css .='.blog_inner_box img{';

			$hairstyle_salon_custom_css .='opacity:0.3';

		$hairstyle_salon_custom_css .='}';

		}else if($hairstyle_salon_slider_opacity_color == '0.4'){

		$hairstyle_salon_custom_css .='.blog_inner_box img{';

			$hairstyle_salon_custom_css .='opacity:0.4';

		$hairstyle_salon_custom_css .='}';

		}else if($hairstyle_salon_slider_opacity_color == '0.5'){

		$hairstyle_salon_custom_css .='.blog_inner_box img{';

			$hairstyle_salon_custom_css .='opacity:0.5';

		$hairstyle_salon_custom_css .='}';

		}else if($hairstyle_salon_slider_opacity_color == '0.6'){

		$hairstyle_salon_custom_css .='.blog_inner_box img{';

			$hairstyle_salon_custom_css .='opacity:0.6';

		$hairstyle_salon_custom_css .='}';

		}else if($hairstyle_salon_slider_opacity_color == '0.7'){

		$hairstyle_salon_custom_css .='.blog_inner_box img{';

			$hairstyle_salon_custom_css .='opacity:0.7';

		$hairstyle_salon_custom_css .='}';

		}else if($hairstyle_salon_slider_opacity_color == '0.8'){

		$hairstyle_salon_custom_css .='.blog_inner_box img{';

			$hairstyle_salon_custom_css .='opacity:0.8';

		$hairstyle_salon_custom_css .='}';

		}else if($hairstyle_salon_slider_opacity_color == '0.9'){

		$hairstyle_salon_custom_css .='.blog_inner_box img{';

			$hairstyle_salon_custom_css .='opacity:0.9';

		$hairstyle_salon_custom_css .='}';

		}else if($hairstyle_salon_slider_opacity_color == '1.0'){

		$hairstyle_salon_custom_css .='.blog_inner_box img{';

			$hairstyle_salon_custom_css .='opacity:0.9';

		$hairstyle_salon_custom_css .='}';

		}

	/*---------------------- Slider Image Overlay ------------------------*/

	$hairstyle_salon_overlay_option = get_theme_mod('hairstyle_salon_overlay_option', true);

	if($hairstyle_salon_overlay_option == false){

		$hairstyle_salon_custom_css .='.blog_inner_box img{';

			$hairstyle_salon_custom_css .='opacity:0.5;';

		$hairstyle_salon_custom_css .='}';
	}

	$hairstyle_salon_slider_image_overlay_color = get_theme_mod('hairstyle_salon_slider_image_overlay_color', true);

	if($hairstyle_salon_slider_image_overlay_color != false){

		$hairstyle_salon_custom_css .='.blog_inner_box{';

			$hairstyle_salon_custom_css .='background-color: '.esc_attr($hairstyle_salon_slider_image_overlay_color).';';

		$hairstyle_salon_custom_css .='}';
	}

		/*---------------------------woocommerce pagination alignment settings-------------------*/

	$hairstyle_salon_woocommerce_pagination_position = get_theme_mod( 'hairstyle_salon_woocommerce_pagination_position','Center');

	if($hairstyle_salon_woocommerce_pagination_position == 'Left'){

		$hairstyle_salon_custom_css .='.woocommerce nav.woocommerce-pagination{';

			$hairstyle_salon_custom_css .='text-align: left;';

		$hairstyle_salon_custom_css .='}';

	}else if($hairstyle_salon_woocommerce_pagination_position == 'Center'){

		$hairstyle_salon_custom_css .='.woocommerce nav.woocommerce-pagination{';

			$hairstyle_salon_custom_css .='text-align: center;';

		$hairstyle_salon_custom_css .='}';

	}else if($hairstyle_salon_woocommerce_pagination_position == 'Right'){

		$hairstyle_salon_custom_css .='.woocommerce nav.woocommerce-pagination{';

			$hairstyle_salon_custom_css .='text-align: right;';

		$hairstyle_salon_custom_css .='}';
	}

