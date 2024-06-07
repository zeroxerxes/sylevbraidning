<?php
/**
 * Controls Tasks
 */

namespace Extendify\HelpCenter\Controllers;

defined('ABSPATH') || die('No direct access.');

use Extendify\Http;
use Extendify\Shared\Services\Sanitizer;

/**
 * The controller for tracking tour progress info
 */
class TourController
{
    /**
     * Return tasks from either database or source.
     *
     * @return \WP_REST_Response
     */
    public static function fetchTours()
    {
        $response = Http::get('/tours');
        return new \WP_REST_Response(
            $response,
            wp_remote_retrieve_response_code($response)
        );
    }

    /**
     * Return the data
     *
     * @return \WP_REST_Response
     */
    public static function get()
    {
        $data = get_option('extendify_assist_tour_progress', []);
        return new \WP_REST_Response($data);
    }

    /**
     * Persist the data
     *
     * @param \WP_REST_Request $request - The request.
     * @return \WP_REST_Response
     */
    public static function store($request)
    {
        $data = json_decode($request->get_param('state'), true);
        update_option('extendify_assist_tour_progress', Sanitizer::sanitizeArray($data));
        return new \WP_REST_Response($data);
    }
}
