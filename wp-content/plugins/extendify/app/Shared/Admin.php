<?php
/**
 * Help Center Script loader.
 */

namespace Extendify\Shared;

defined('ABSPATH') || die('No direct access.');

use Extendify\Config;
use Extendify\PartnerData;
use Extendify\Shared\Services\Escaper;
use Extendify\Shared\Controllers\UserSelectionController;

/**
 * This class handles any file loading for the admin area.
 */
class Admin
{
    /**
     * Adds various actions to set up the page
     *
     * @return void
     */
    public function __construct()
    {
        \add_action('init', [$this, 'addExtraMetaFields']);
        \add_action('admin_enqueue_scripts', [$this, 'loadGlobalScripts']);
        \add_action('wp_enqueue_scripts', [$this, 'loadGlobalScripts']);
    }

    /**
     * Adds scripts to every page
     *
     * @return void
     */
    public function loadGlobalScripts()
    {
        \wp_enqueue_media();

        $version = constant('EXTENDIFY_DEVMODE') ? uniqid() : Config::$version;
        \wp_register_script(Config::$slug . '-shared-scripts', '', [], $version, true);
        \wp_enqueue_script(Config::$slug . '-shared-scripts');

        $partnerData = PartnerData::getPartnerData();
        $userConsent = get_user_meta(get_current_user_id(), 'extendify_ai_consent', true);
        $htmlWhitelist = [
            'a' => [
                'target' => [],
                'href' => [],
                'rel' => [],
            ],
        ];

        if (!function_exists('get_plugins')) {
            require_once ABSPATH . 'wp-admin/includes/plugin.php';
        }

        \wp_add_inline_script(
            Config::$slug . '-shared-scripts',
            'window.extSharedData = ' . \wp_json_encode([
                'root' => \esc_url_raw(rest_url(Config::$slug . '/' . Config::$apiVersion)),
                'home' => \esc_url_raw(\get_home_url()),
                'nonce' => \esc_attr(\wp_create_nonce('wp_rest')),
                'devbuild' => (bool) constant('EXTENDIFY_DEVMODE'),
                'assetPath' => \esc_url(EXTENDIFY_URL . 'public/assets'),
                'siteId' => \esc_attr(\get_option('extendify_site_id', '')),
                'siteCreatedAt' => \esc_attr(get_user_option('user_registered', 1)),
                'themeSlug' => \esc_attr(\get_option('stylesheet')),
                'version' => \esc_attr(Config::$version),
                'siteTitle' => \esc_attr(\get_bloginfo('name')),
                'siteType' => Escaper::recursiveEscAttr(\get_option('extendify_siteType', [])),
                'adminUrl' => \esc_url_raw(\admin_url()),
                'wpLanguage' => \esc_attr(\get_locale()),
                'wpVersion' => \esc_attr(\get_bloginfo('version')),
                'isBlockTheme' => function_exists('wp_is_block_theme') ? (bool) wp_is_block_theme() : false,
                'userId' => \esc_attr(\get_current_user_id()),
                'partnerLogo' => \esc_attr(PartnerData::$logo),
                'partnerId' => \esc_attr(PartnerData::$id),
                'partnerName' => \esc_attr(PartnerData::$name),
                'userData' => [
                    'userSelectionData' => \wp_json_encode((UserSelectionController::get()->get_data() ?? [])),
                ],
                'showAIConsent' => isset($partnerData['showAIConsent']) ? (bool) $partnerData['showAIConsent'] : false,
                'consentTermsHTML' => \wp_kses((html_entity_decode(($partnerData['consentTermsHTML'] ?? '')) ?? ''), $htmlWhitelist),
                'userGaveConsent' => $userConsent ? (bool) $userConsent : false,
                'installedPlugins' => array_map('esc_attr', array_keys(\get_plugins())),
                'activePlugins' => array_map('esc_attr', array_values(\get_option('active_plugins', []))),
                'frontPage' => \esc_attr(\get_option('page_on_front', 0)),
                'globalStylesPostID' => \esc_attr(\WP_Theme_JSON_Resolver::get_user_global_styles_post_id()),
                'showLocalizedCopy' => (bool) array_key_exists('showLocalizedCopy', $partnerData),
            ]),
            'before'
        );

        $cssColorVars = PartnerData::cssVariableMapping();
        $cssString = implode('; ', array_map(function ($k, $v) {
            return "$k: $v";
        }, array_keys($cssColorVars), $cssColorVars));
        \wp_register_style(Config::$slug . '-shared-styles', '', [], $version, 'all');
        \wp_enqueue_style(Config::$slug . '-shared-styles');
        \wp_add_inline_style(Config::$slug . '-shared-styles', wp_strip_all_tags("body { $cssString; }"));
    }

    /**
     * Adds additional meta fields to post types
     *
     * @return void
     */
    public function addExtraMetaFields()
    {
        // Add a tag to pages that were made with Launch.
        register_post_meta('page', 'made_with_extendify_launch', [
            'single' => true,
            'type' => 'boolean',
            'show_in_rest' => true,
        ]);
    }
}
