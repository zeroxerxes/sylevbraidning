<?php
/**
 * Api routes
 */

if (!defined('ABSPATH')) {
    die('No direct access.');
}

use Extendify\ApiRouter;
use Extendify\Assist\Controllers\DomainsSuggestionController;
use Extendify\Assist\Controllers\GlobalsController;
use Extendify\Assist\Controllers\RecommendationsController;
use Extendify\Assist\Controllers\RouterController;
use Extendify\Assist\Controllers\TasksController;

use Extendify\HelpCenter\Controllers\TourController;
use Extendify\HelpCenter\Controllers\RouterController as HelpCenterRouterController;
use Extendify\HelpCenter\Controllers\SupportArticlesController;

use Extendify\Draft\Controllers\ImageController;
use Extendify\Draft\Controllers\UserSettingsController;
use Extendify\Draft\Controllers\RouterController as DraftRouterController;

use Extendify\Launch\Controllers\DataController;
use Extendify\Launch\Controllers\WPController;

use Extendify\Library\Controllers\SiteController;

use Extendify\Shared\Controllers\UserSelectionController;
use Extendify\Shared\Controllers\UserSettingsController as SharedUserSettingsController;


\add_action(
    'rest_api_init',
    function () {
        // Library.
        ApiRouter::get('/library/settings', [SiteController::class, 'get']);
        ApiRouter::post('/library/settings', [SiteController::class, 'store']);
        ApiRouter::post('/library/settings/single', [SiteController::class, 'single']);
        // TODO: Remove this after a few months.
        ApiRouter::post('/library/settings/add-utils-to-global-styles', [SiteController::class, 'addUtilsToGlobalStyles']);

        // Launch.
        ApiRouter::post('/launch/options', [WPController::class, 'updateOption']);
        ApiRouter::get('/launch/options', [WPController::class, 'getOption']);
        ApiRouter::get('/launch/active-plugins', [WPController::class, 'getActivePlugins']);
        ApiRouter::get('/launch/goals', [DataController::class, 'getGoals']);
        ApiRouter::get('/launch/suggested-plugins', [DataController::class, 'getSuggestedPlugins']);
        ApiRouter::get('/launch/ping', [DataController::class, 'ping']);
        ApiRouter::get('/launch/prefetch-assist-data', [WPController::class, 'prefetchAssistData']);
        ApiRouter::post('/launch/create-navigation', [WPController::class, 'createNavigationWithMeta']);

        // Assist.
        ApiRouter::get('/assist/recommendations', [RecommendationsController::class, 'fetchRecommendations']);
        ApiRouter::get('/assist/recommendations-data', [RecommendationsController::class, 'get']);
        ApiRouter::post('/assist/recommendations-data', [RecommendationsController::class, 'store']);
        ApiRouter::get('/assist/task-data', [TasksController::class, 'get']);
        ApiRouter::post('/assist/task-data', [TasksController::class, 'store']);
        ApiRouter::post('/assist/router-data', [RouterController::class, 'store']);
        ApiRouter::get('/assist/router-data', [RouterController::class, 'get']);
        ApiRouter::get('/assist/global-data', [GlobalsController::class, 'get']);
        ApiRouter::post('/assist/global-data', [GlobalsController::class, 'store']);
        ApiRouter::post('/assist/delete-domains-recommendations', [DomainsSuggestionController::class, 'deleteCache']);

        // Help Center.
        ApiRouter::get('/help-center/tours', [TourController::class, 'fetchTours']);
        ApiRouter::get('/help-center/tour-data', [TourController::class, 'get']);
        ApiRouter::post('/help-center/tour-data', [TourController::class, 'store']);
        ApiRouter::post('/help-center/router-data', [HelpCenterRouterController::class, 'store']);
        ApiRouter::get('/help-center/router-data', [HelpCenterRouterController::class, 'get']);
        ApiRouter::get('/help-center/support-articles', [SupportArticlesController::class, 'articles']);
        ApiRouter::get('/help-center/support-article', [SupportArticlesController::class, 'article']);
        ApiRouter::get('/help-center/support-articles-data', [SupportArticlesController::class, 'get']);
        ApiRouter::post('/help-center/support-articles-data', [SupportArticlesController::class, 'store']);
        ApiRouter::get('/help-center/get-redirect', [SupportArticlesController::class, 'getRedirect']);

        // Draft.
        ApiRouter::get('/draft/user-settings', [UserSettingsController::class, 'get']);
        ApiRouter::post('/draft/user-settings', [UserSettingsController::class, 'store']);
        ApiRouter::post('/draft/upload-image', [ImageController::class, 'uploadMedia']);
        ApiRouter::post('/draft/router-data', [DraftRouterController::class, 'store']);
        ApiRouter::get('/draft/router-data', [DraftRouterController::class, 'get']);

        // Shared.
        ApiRouter::get('/shared/user-selections-data', [UserSelectionController::class, 'get']);
        ApiRouter::post('/shared/user-selections-data', [UserSelectionController::class, 'store']);
        ApiRouter::post('/shared/update-user-meta', [SharedUserSettingsController::class, 'updateUserMeta']);
    }
);
