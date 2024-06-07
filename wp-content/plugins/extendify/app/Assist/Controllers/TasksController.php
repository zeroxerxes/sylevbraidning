<?php
/**
 * Controls Tasks
 */

namespace Extendify\Assist\Controllers;

defined('ABSPATH') || die('No direct access.');

use Extendify\Shared\Services\Sanitizer;

/**
 * The controller for plugin dependency checking, etc
 */
class TasksController
{
    /**
     * Return the data
     *
     * @return \WP_REST_Response
     */
    public static function get()
    {
        $data = get_option('extendify_assist_tasks', []);
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
        update_option('extendify_assist_tasks', Sanitizer::sanitizeArray($data));
        return new \WP_REST_Response($data);
    }

    /**
     * Returns remaining incomplete tasks.
     *
     * @return int
     */
    public function getRemainingCount()
    {
        $tasks = get_option('extendify_assist_tasks', []);
        if (!isset($tasks['state']['seenTasks'])) {
            return 0;
        }

        $seenTasks = count($tasks['state']['seenTasks']);
        $completedTasks = count($tasks['state']['completedTasks']);
        return max(($seenTasks - $completedTasks), 0);
    }
}
