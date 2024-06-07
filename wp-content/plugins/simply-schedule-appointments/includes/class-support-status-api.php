<?php
/**
 * Simply Schedule Appointments Support Status Api.
 *
 * @since   2.1.6
 * @package Simply_Schedule_Appointments
 */

/**
 * Simply Schedule Appointments Support Status Api.
 *
 * @since 2.1.6
 */
class SSA_Support_Status_Api extends WP_REST_Controller {
	/**
	 * Parent plugin class
	 *
	 * @var   class
	 * @since 1.0.0
	 */
	protected $plugin = null;

	/**
	 * Constructor
	 *
	 * @since  1.0.0
	 * @param  object $plugin Main plugin object.
	 * @return void
	 */
	public function __construct( $plugin ) {
		$this->plugin = $plugin;
		$this->hooks();
	}

	/**
	 * Initiate our hooks
	 *
	 * @since  1.0.0
	 * @return void
	 */
	public function hooks() {
		$this->register_routes();
	}


	/**
	 * Register the routes for the objects of the controller.
	 */
	public function register_routes() {
		$version = '1';
		$namespace = 'ssa/v' . $version;
		$base = 'support_status';
		register_rest_route( $namespace, '/' . $base, array(
			array(
				'methods'         => WP_REST_Server::READABLE,
				'callback'        => array( $this, 'get_items' ),
				'permission_callback' => array( $this, 'get_items_permissions_check' ),
				'args'            => array(

				),
			),
		) );

		register_rest_route( $namespace, '/' . 'support_ticket', array(
			array(
				'methods'         => WP_REST_Server::CREATABLE,
				'callback'        => array( $this, 'create_support_ticket' ),
				'permission_callback' => array( $this, 'get_items_permissions_check' ),
				'args'            => array(

				),
			),
		) );

		register_rest_route( $namespace, '/' . 'support_debug/wp', array(
			array(
				'methods'         => WP_REST_Server::READABLE,
				'callback'        => array( $this, 'get_wp_debug_log_content' ),
				'permission_callback' => array( $this, 'get_items_permissions_check' ),
				'args'            => array(

				),
			),
		) );

		register_rest_route( $namespace, '/' . 'support_debug/wp/delete', array(
			array(
				'methods'         => WP_REST_Server::CREATABLE,
				'callback'        => array( $this, 'empty_wp_debug_log_content' ),
				'permission_callback' => array( $this, 'get_items_permissions_check' ),
				'args'            => array(

				),
			),
		) );


		register_rest_route( $namespace, '/' . 'support_debug/ssa', array(
			array(
				'methods'         => WP_REST_Server::READABLE,
				'callback'        => array( $this, 'get_ssa_debug_log_content' ),
				'permission_callback' => array( $this, 'get_items_permissions_check' ),
				'args'            => array(

				),
			),
		) );

		register_rest_route( $namespace, '/' . 'support_debug/ssa/delete', array(
			array(
				'methods'         => WP_REST_Server::CREATABLE,
				'callback'        => array( $this, 'empty_ssa_debug_log_content' ),
				'permission_callback' => array( $this, 'get_items_permissions_check' ),
				'args'            => array(

				),
			),
		) );

		register_rest_route( $namespace, '/' . 'support_debug/logs', array(
			array(
				'methods'         => WP_REST_Server::READABLE,
				'callback'        => array( $this, 'get_debug_log_urls' ),
				'permission_callback' => array( $this, 'get_items_permissions_check' ),
				'args'            => array(

				),
			),
		) );

		register_rest_route( $namespace, '/' . 'support/export', array(
			array(
				'methods'         => WP_REST_Server::READABLE,
				'callback'        => array( $this, 'get_export_code' ),
				'permission_callback' => array( $this, 'get_items_permissions_check' ),
				'args'            => array(

				),
			),
		) );

		register_rest_route( $namespace, '/' . 'support/import', array(
			array(
				'methods'         => WP_REST_Server::CREATABLE,
				'callback'        => array( $this, 'import_data_api' ),
				'permission_callback' => array( $this, 'get_items_permissions_check' ),
				'args'            => array(

				),
			),
		) );

		register_rest_route(
			$namespace,
			'/fetch-guides',
			array(
				array(
					'methods'             => WP_REST_Server::READABLE,
					'callback'            => array( $this, 'get_guides' ),
					'permission_callback' => array( $this, 'get_items_permissions_check' ),
				),
			)
		);

		register_rest_route( $namespace, '/user/check', array(
			'methods'             => WP_REST_Server::READABLE,
			'callback'            => array( $this, 'check_user_login_status' ),
			'permission_callback' => '__return_true',
		) );
	}

	public function check_user_login_status( $request ) {

		$data = array(
			'is_user_logged_in' => is_user_logged_in(),
		);
		
		$response = array(
			'response_code' => 200,
			'error' => '',
			'data' => $data
		);

		return new WP_REST_Response( $response, 200 );
	}


	public function create_support_ticket( $request ) {
		$params = $request->get_params();
		$debug_logs_hash = SSA_Debug::get_site_unique_hash_for_debug_logs();
		if ( ! empty( $params['include_active_plugins'] ) ) {
			$params['active_plugins'] = array();
			$active_plugins = get_option( 'active_plugins' );
			sort( $active_plugins );
			foreach ($active_plugins as $active_plugin) {
				if ( strpos( $active_plugin, '/' ) ) {
					$active_plugin = substr( $active_plugin, 0, strpos( $active_plugin, '/' ) );
				}
				$params['active_plugins'][] = $active_plugin;
			}
			unset( $params['include_active_plugins'] );
		}

		if ( ! empty( $params['include_settings'] ) ) {
			$params['site_hash_for_debug_logs'] = $debug_logs_hash;
			unset( $params['include_settings'] );
		}

		$response = wp_remote_post( 'https://api.simplyscheduleappointments.com/support_ticket/', array(
		    'sslverify' => false,
			'headers' => array(
				'content-type' => 'application/json',
			),
			'body' => json_encode( $params ),
		) );
		
		$response_code = wp_remote_retrieve_response_code($response);
		if( $response_code > 299 || $response_code < 200 ) {
			ssa_debug_log( "Failed to submit support ticket - invalid response code - response: " .print_r ( $response, true), 100 ); //phpcs:ignore
			return new WP_Error( 'failed_submission', __( 'Your support ticket failed to be sent, please send details to support@ssaplugin.com',  'simply-schedule-appointments' ), $debug_logs_hash );
		}
		
		$response = wp_remote_retrieve_body( $response );
		if ( empty( $response ) ) {
			ssa_debug_log( "Failed to submit support ticket - response empty - response: " .print_r ( $response, true), 100 ); //phpcs:ignore
			return new WP_Error( 'empty_response', __( 'No response', 'simply-schedule-appointments' ), $debug_logs_hash );
		}
		$response = json_decode( $response, true );
		if ( ! is_array( $response ) ) {
			$response = json_decode( $response, true );
		}

		if ($response['status'] != 'success' ) {
			ssa_debug_log( "Failed to submit support ticket - status != success - response: " .print_r ( $response, true), 100 ); //phpcs:ignore
			return new WP_Error( 'failed_submission', __( 'Your support ticket failed to be sent, please send details to support@ssaplugin.com', 'simply-schedule-appointments' ), $debug_logs_hash );
		}

		return $response;
	}

	public function get_items_permissions_check( $request ) {
		return current_user_can( 'ssa_manage_site_settings' );
	}

	public function get_items( $request ) {
		$params = $request->get_params();

		return array(
			'response_code' => 200,
			'error' => '',
			'data' => array(
				'site_status' => $this->plugin->support_status->get_site_status(),
			),
		);
	}

	/**
	 * Gets the default debug.log contents.
	 *
	 * @param WP_REST_Request $request
	 * @return WP_REST_Response
	 */
	public function get_wp_debug_log_content( WP_REST_Request $request ) {
		$developer_settings = $this->plugin->developer_settings->get();
		if( $developer_settings && isset( $developer_settings['debug_mode'] ) && $developer_settings['debug_mode'] ) {
			$path = ini_get('error_log');
			// return $path;
			if ( file_exists( $path ) && is_writeable( $path ) ) {
				$content = file_get_contents( $path );

				return new WP_REST_Response( $content, 200 );
			} 
		}

		return new WP_REST_Response( "", 200 );
	}


	/**
	 * Deletes the default debug.log file.
	 *
	 * @param WP_REST_Request $request
	 * @return WP_REST_Response
	 */
	public function empty_wp_debug_log_content( WP_REST_Request $request ) {
		$path = ini_get('error_log');
		if ( file_exists( $path ) && is_writeable( $path ) ) {
			unlink( $path );

			return new WP_REST_Response( __( 'Debug Log file successfully cleared.' ), 200 );
		} else {
			return new WP_REST_Response( __( 'Debug Log file not found.' ), 200 );
		}
	}

	/**
	 * Gets the ssa_debug.log contents.
	 *
	 * @param WP_REST_Request $request
	 * @return WP_REST_Response
	 */	
	public function get_ssa_debug_log_content( WP_REST_Request $request ) {
		$developer_settings = $this->plugin->developer_settings->get();
		if( $developer_settings && isset( $developer_settings['ssa_debug_mode'] ) && $developer_settings['ssa_debug_mode'] ) {
			$path = $this->plugin->support_status->get_log_file_path( 'debug' );
			if ( file_exists( $path ) && is_readable( $path ) ) {
				$content = file_get_contents( $path );

				return new WP_REST_Response( $content, 200 );
			} 
		}

		return new WP_REST_Response( "", 200 );
	}

	/**
	 * Deletes the ssa_debug.log file.
	 *
	 * @param WP_REST_Request $request
	 * @return void
	 */
	public function empty_ssa_debug_log_content( WP_REST_Request $request ) {
		$path = $this->plugin->support_status->get_log_file_path( 'debug' );
		if ( file_exists( $path ) && is_writeable( $path ) ) {
			unlink( $path );

			return new WP_REST_Response( __( 'Debug Log file successfully cleared.' ), 200 );
		} else {
			return new WP_REST_Response( __( 'Debug Log file not found or could not be removed.' ), 200 );
		}

	}


	/**
	 * Returns the urls for all debug log files.
	 *
	 * @return WP_REST_Response
	 */
	public function get_debug_log_urls() {
		$logs = array(
			'wp' => null,
			'ssa' => null,
		);

		$path = ini_get('error_log');
		if ( file_exists( $path ) && is_readable( $path ) ) {
			$logs['wp'] = str_replace(
				wp_normalize_path( untrailingslashit( ABSPATH ) ),
				site_url(),
				wp_normalize_path( $path )
			);
		}

		$ssa_path = $this->plugin->support_status->get_log_file_path( 'debug' );
		if ( file_exists( $ssa_path ) && is_readable( $ssa_path ) ) {
			$logs['ssa'] = str_replace(
				wp_normalize_path( untrailingslashit( ABSPATH ) ),
				site_url(),
				wp_normalize_path( $ssa_path )
			);
		}

		return new WP_REST_Response( $logs, 200 );
	}

	/**
	 * Pulls plugin settings, Appointment Types and Appointments and returns a JSON payload to be imported into another SSA plugin.
	 *
	 * @param WP_REST_Request $request the Request payload.
	 * @return WP_REST_Response
	 */
	public function get_export_code( WP_REST_Request $request ) {
		$params = $request->get_params();

		$payload = array();

		if ( isset( $params['settings'] ) && 'true' === $params['settings'] ) {
			$payload['settings'] = $this->plugin->settings->get();
			foreach ( $payload['settings']['notifications']['notifications'] as &$notification ) {
				$subject = empty( $notification['subject'] ) ? null : $notification['subject'];
				$notification['subject'] = wp_strip_all_tags( $subject );
				$notification['message'] = str_ireplace(
					array(
						'&quot;',
					),
					array(
						'"',
					),
					$notification['message']
				);
				// TODO if this happens again: use html entities functions instead.
			}
		}

		if ( isset( $params['appointment_types'] ) && 'true' === $params['appointment_types'] ) {
			$payload['resource_groups'] = $this->plugin->resource_group_model->query(
				array(
					'number' => -1,
					'order'  => 'ASC',
				)
			);

			$payload['resources'] = $this->plugin->resource_model->query(
				array(
					'number' => -1,
					'order'  => 'ASC',
				)
			);

			$payload['resource_group_resources'] = $this->plugin->resource_group_resource_model->query(
				array(
					'number' => -1,
					'order'  => 'ASC',
				)
			);

			$payload['staff'] = $this->plugin->staff_model->query(
				array(
					'number' => -1,
					'order'  => 'ASC',
				)
			);

			$payload['appointment_types'] = $this->plugin->appointment_type_model->query(
				array(
					'order'  => 'ASC', // necessary for keeping integrity with the order of rows inserted on the database.
					'number' => -1,
				)
			);

			$payload['staff_appointment_types'] = $this->plugin->staff_appointment_type_model->query(
				array(
					'number' => -1,
					'order'  => 'ASC',
				)
			);

			$payload['resource_group_appointment_types'] = $this->plugin->resource_group_appointment_type_model->query(
				array(
					'number' => -1,
					'order'  => 'ASC',
				)
			);

			$payload['appointment_type_labels'] = $this->plugin->appointment_type_label_model->query(
				array(
					'number' => -1,
					'order'  => 'ASC',
				)
			);
		}

		if ( isset( $params['appointments'] ) && 'true' === $params['appointments'] ) {
			$appointments = $this->plugin->appointment_model->query(
				array(
					'order'          => 'ASC', // necessary for keeping integrity with the order of rows inserted on the database.
					'number'         => isset( $params['appointments_limit'] ) ? (int) $params['appointments_limit'] : -1,
					'start_date_min' => isset( $params['future_appointments_only'] ) && 'true' === $params['future_appointments_only'] ? gmdate( 'Y-m-d H:i:s' ) : null,
				)
			);

			if ( ! empty( $params['anonymize_customer_information'] ) && 'true' === $params['anonymize_customer_information'] ) {
				foreach ( $appointments as &$appointment ) {
					foreach ( $appointment['customer_information'] as $key => &$value ) {
						switch ( $key ) {
							case 'Phone':
								$value = '123-456-7890';
								break;
							case 'Email':
								$value = substr( sha1( $value ), 0, 10 ) . '@mailinator.com';
								break;
							default:
								if ( is_array( $value ) ) {
									$value = json_encode( $value );
								}
								$value = substr( sha1( $value ), 0, 10 );
								break;
						}
					}
				}
			}

			$payload['appointments'] = $appointments;
			// import meta data as well.
			$payload['appointment_meta'] = $this->plugin->appointment_meta_model->query( 
				array(
					'order'  => 'ASC', // necessary for keeping integrity with the order of rows inserted on the database.
					'number' => -1,
				)
			);

			$payload['staff_appointments'] = $this->plugin->staff_appointment_model->query(
				array(
					'number' => -1,
					'order'  => 'ASC',
				)
			);

			$payload['resource_appointments'] = $this->plugin->resource_appointment_model->query(
				array(
					'number' => -1,
					'order'  => 'ASC',
				)
			);

		} elseif ( isset( $params['appointment_types'] ) && 'true' === $params['appointment_types'] ) {
			$payload['appointments']       = array();
			$payload['appointment_meta']   = array();
			$payload['staff_appointments'] = array();
		}

		// Backup export code. Conditional to avoid replacing a proper backup when generating export code to send to support.
		if ( ! isset( $params['backup'] ) || 'false' !== $params['backup'] ) {
			$this->plugin->support_status->save_export_backup( $payload );
		}

		return new WP_REST_Response( $payload, 200 );
	}

	/**
	 * Receives a JSON formatted string via POST on our REST API endpoint, and runs the import process.
	 *
	 * @param WP_REST_Request $request the request object.
	 * @return WP_REST_Response
	 */
	public function import_data_api( WP_REST_Request $request ) {
		$json = $request->get_param( 'content' );

		// verify if JSON data is valid.
		$decoded = json_decode( $json, true );

		if ( ! is_object( $decoded ) && ! is_array( $decoded ) ) {
			return new WP_REST_Response( __( 'Invalid data format.'), 500 );
		}

		if ( json_last_error() !== JSON_ERROR_NONE ) {
			return new WP_REST_Response( __( 'Invalid data format.'), 500 );
		}

		$import = $this->plugin->support_status->import_data( $decoded );

		// if any error happens while trying to import appointment type data, return.
		if ( is_wp_error( $import ) ) {
			return new WP_REST_Response( $import->get_error_messages(), 500 );
		}

		// everything was successfully imported.
		return new WP_REST_Response( __( 'Data successfully imported!' ), 200 );
	}

	/**
	 * Checks transients to see if a request to ssa.com/guides is cached. If not, calls the API and caches the response.
	 *
	 * @since 5.4.0
	 *
	 * @param WP_REST_Request $request the request object.
	 * @return WP_REST_Response
	 */
	public function get_guides( WP_REST_Request $request ) {
		$params = $request->get_params();

		// $build a string to use as a transient key.
		$transient_key = array();
		foreach ( $params as $key => $value ) {
			$transient_key[] .= $key . ':' . $value;
		}
		$transient_key  = implode( '|', $transient_key );
		$transient_name = 'ssa_guides_' . $transient_key;

		$cached_response = get_transient( $transient_name );

		if ( false === $cached_response ) {
			$response = wp_safe_remote_get(
				'https://simplyscheduleappointments.com/wp-json/ssa/v1/guides',
				array(
					'body' => $params,
				)
			);

			if ( is_wp_error( $response ) ) {
				return new WP_REST_Response( $response->get_error_messages(), 500 );
			}

			// check if the response is valid.
			if ( strpos( $response['body'], 'rest_forbidden' ) !== false ) {
				return new WP_REST_Response( __( 'Invalid data format.' ), 500 );
			}

			$cached_response = json_decode( $response['body'], true );

			set_transient( $transient_name, $cached_response, WEEK_IN_SECONDS );
		}

		return new WP_REST_Response( $cached_response, 200 );
	}
}
