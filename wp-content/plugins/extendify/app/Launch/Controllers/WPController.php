<?php
/**
 * WP Controller
 */

namespace Extendify\Launch\Controllers;

defined('ABSPATH') || die('No direct access.');

use Extendify\Shared\Services\Sanitizer;

/**
 * The controller for interacting with WordPress.
 */
class WPController
{
    /**
     * Persist the data
     *
     * @param \WP_REST_Request $request - The request.
     * @return \WP_REST_Response
     */
    public static function updateOption($request)
    {
        $params = $request->get_json_params();
        \update_option($params['option'], Sanitizer::sanitizeUnknown($params['value']));

        return new \WP_REST_Response(['success' => true]);
    }

    /**
     * Get a setting from the options table
     *
     * @param \WP_REST_Request $request - The request.
     * @return \WP_REST_Response
     */
    public static function getOption($request)
    {
        $value = \get_option($request->get_param('option'), null);
        return new \WP_REST_Response([
            'success' => true,
            'data' => $value,
        ]);
    }

    /**
     * Get the list of active plugins slugs
     *
     * @return \WP_REST_Response
     */
    public static function getActivePlugins()
    {
        return new \WP_REST_Response([
            'success' => true,
            'data' => array_values(\get_option('active_plugins', [])),
        ]);
    }

    /**
     * This function will force the regenerating of the cache.
     *
     * @return \WP_REST_Response
     */
    public static function prefetchAssistData()
    {
        if (class_exists(\Extendify\Assist\DataProvider\ResourceData::class)) {
            (new \Extendify\Assist\DataProvider\ResourceData())->cache();
        }

        return new \WP_REST_Response(true, 200);
    }

    /**
     * Create a post of type wp_navigation with meta.
     *
     * @param \WP_REST_Request $request - The request.
     * @return \WP_REST_Response
     */
    public static function createNavigationWithMeta($request)
    {
        $post = \wp_insert_post([
            'post_type' => 'wp_navigation',
            'post_title' => Sanitizer::sanitizeText($request->get_param('title')),
            'post_name' => Sanitizer::sanitizeText($request->get_param('slug')),
            'post_status' => 'publish',
            'post_content' => Sanitizer::sanitizePostContent($request->get_param('content')),
        ]);

        \add_post_meta($post, 'made_with_extendify_launch', 1);

        return new \WP_REST_Response([
            'success' => true,
            'id' => $post,
        ]);
    }
}
