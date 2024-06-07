<?php 
/**
 * Newsletter class
 *
 * @author   Magazine3
 * @category Admin
 * @path     controllers/admin/newsletter
 * @Version 1.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

class wpdbbkp_ads_newsletter {
        
	function __construct () {
                add_filter( 'wpdbbkp_localize_filter',array($this,'wpdbbkp_add_localize_footer_data'),10,2);
                add_action('wp_ajax_wpdbbkp_subscribe_to_news_letter', array($this, 'wpdbbkp_subscribe_to_news_letter'));
        }
        
        function wpdbbkp_subscribe_to_news_letter(){

                if ( ! isset( $_POST['wpdbbkp_security_nonce'] ) ){
                    return; 
                }
                if ( !wp_verify_nonce( $_POST['wpdbbkp_security_nonce'], 'wpdbbkp_ajax_check_nonce' ) ){
                   return;  
                }
                if( ! current_user_can( 'manage_options' ) ) { 
                   return;
                }

                if(isset($_POST['email'])){
                        
                    $api_url = 'http://magazine3.company/wp-json/api/central/email/subscribe';

		    $api_params = array(
		        'name'    => sanitize_text_field($_POST['name']),
		        'email'   => sanitize_email($_POST['email']),
		        'website' => sanitize_text_field($_POST['website']),
		        'type'    => 'wpdbbkp'
                    );
                    
		    $response = wp_remote_post( $api_url, array( 'timeout' => 15, 'sslverify' => false, 'body' => $api_params ) );
                    if ( ! is_wp_error( $response ) ) {
                        $response = wp_remote_retrieve_body( $response );                    
                        echo $response;
                    }else{
                        echo esc_html__('Unable to submit form, please try again','wpdbbkp') ;
                    }

                }else{
                        echo esc_html__('Email id required','wpdbbkp');                        
                }                        

                wp_die();
        }
	        
        function wpdbbkp_add_localize_footer_data($object, $object_name){
            
        $dismissed = explode (',', get_user_meta (wp_get_current_user()->ID, 'dismissed_wp_pointers', true));
        $do_tour   = !in_array ('wpdbbkp_subscribe_pointer', $dismissed);
        
        if ($do_tour) {
                wp_enqueue_style ('wp-pointer');
                wp_enqueue_script ('wp-pointer');						
	}
                        
        if($object_name == 'wpdbbkp_localize_data'){
                        
                global $current_user;                
		$tour     = array ();
                $tab      = isset($_GET['tab']) ? esc_attr($_GET['tab']) : '';                   
                
                if (!array_key_exists($tab, $tour)) {                
			                                           			            	
                        $object['do_tour']            = $do_tour;        
                        $object['get_home_url']       = get_home_url();                
                        $object['current_user_email'] = $current_user->user_email;                
                        $object['current_user_name']  = $current_user->display_name;        
			$object['displayID']          = '#menu-settings';                        
                        $object['button1']            = esc_html('No Thanks','wpdbbkp');
                        $object['button2']            = false;
                        $object['function_name']      = '';                        
		}
		                                                                                                                                                    
        }
        return $object;
         
    }
       
}
$wpdbbkp_ads_newsletter = new wpdbbkp_ads_newsletter();
?>