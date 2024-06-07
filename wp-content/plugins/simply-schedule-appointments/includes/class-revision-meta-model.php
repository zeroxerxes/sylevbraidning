<?php
/**
 * Simply Schedule Appointment Revision Meta Model.
 *
 * @since   6.1.0
 * @package Simply_Schedule_Appointments
 */

/**
 * Simply Schedule Appointment Revision Meta Model.
 *
 * @since 6.1.0
 */
class SSA_Revision_Meta_Model extends SSA_Db_Model {
	protected $slug    = 'revision_meta';
	protected $version = '1.3.9';

	/**
	 * Parent plugin class.
	 *
	 * @since 6.1.0
	 *
	 * @var   Simply_Schedule_Appointments
	 */
	protected $plugin = null;


	/**
	 * Constructor.
	 *
	 * @since  6.1.0
	 *
	 * @param  Simply_Schedule_Appointments $plugin Main plugin object.
	 */
	public function __construct( $plugin ) {

		parent::__construct( $plugin );

		$this->hooks();
	}


	/**
	 * Initiate our hooks.
	 *
	 * @since  6.1.0
	 */
	public function hooks() {
	}

	public function get_pluralized_slug() {
		return 'revision_meta';
	}

	public function belongs_to() {
		return array(
			'Revision' => array(
				'model'       => $this->plugin->revision_model,
				'foreign_key' => 'revision_id',
			),
		);
	}


	protected $schema = array(
		'revision_id'       => array(
			'field'            => 'revision_id',
			'label'            => 'Revision ID',
			'default_value'    => 0,
			'format'           => '%d',
			'mysql_type'       => 'BIGINT',
			'mysql_length'     => 20,
			'mysql_unsigned'   => true,
			'mysql_allow_null' => false,
			'mysql_extra'      => '',
			'cache_key'        => false,
		),
		'meta_key'          => array(
			'field'            => 'meta_key',
			'label'            => 'Meta Key',
			'default_value'    => '',
			'format'           => '%s',
			'mysql_type'       => 'VARCHAR',
			'mysql_length'     => '32',
			'mysql_unsigned'   => false,
			'mysql_allow_null' => false,
			'mysql_extra'      => '',
			'cache_key'        => false,
		),

		'meta_value_before' => array(
			'field'            => 'meta_value_before',
			'label'            => 'Meta Value Before',
			'default_value'    => '',
			'format'           => '%s',
			'mysql_type'       => 'TEXT',
			'mysql_length'     => false,
			'mysql_unsigned'   => false,
			'mysql_allow_null' => false,
			'mysql_extra'      => '',
			'cache_key'        => false,
			'encoder'          => 'json_serialize',
		),
		'meta_value'        => array(
			'field'            => 'meta_value',
			'label'            => 'Meta Value',
			'default_value'    => '',
			'format'           => '%s',
			'mysql_type'       => 'TEXT',
			'mysql_length'     => false,
			'mysql_unsigned'   => false,
			'mysql_allow_null' => false,
			'mysql_extra'      => '',
			'cache_key'        => false,
			'encoder'          => 'json_serialize',
		),
	);

	public $indexes = array(
		'revision_id' => array( 'revision_id' ),
		'meta_key'    => array( 'meta_key' ),
	);

	public function filter_where_conditions( $where, $args ) {
		global $wpdb;
		if ( ! empty( $args['revision_id'] ) ) {
			if( is_array( $args['revision_id'] ) ) {
				$revision_ids = implode( ',', array_map('intval', $args['revision_id'] ) );
			} else {
				$revision_ids = intval( $args['revision_id'] );
			}
			$where .= " AND `revision_id` IN( $revision_ids ) ";
		}

		if ( ! empty( $args['meta_key'] ) ) {
			$where .=  $wpdb->prepare( ' AND meta_key=%s', sanitize_text_field( $args['meta_key'] ) );
		}

		if ( ! empty( $args['meta_value_before'] ) ) {
			$where .=  $wpdb->prepare( ' AND meta_value_before=%s', sanitize_text_field( $args['meta_value_before'] ) );
		}

		if ( ! empty( $args['meta_value'] ) ) {
			$where .=  $wpdb->prepare( ' AND meta_value=%s', sanitize_text_field( $args['meta_value'] ) );
		}

		return $where;
	}

	public function create_item_permissions_check( $request ) {
		// only ssa code should interact with this class
		return false;
	}

	/**
	 * Check if a given request has access to update a specific item
	 *
	 * @param WP_REST_Request $request Full data about the request.
	 * @return WP_Error|bool
	 */
	public function update_item_permissions_check( $request ) {
		// only ssa code should interact with this class
		return false;
	}
}
