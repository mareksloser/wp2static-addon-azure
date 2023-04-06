<?php
/**
 * Plugin Name: WP2Static Add-on: Azure
 * Plugin URI: https://wp2static.com
 * Description: Microsoft Azure Cloud Storage as a deployment option for WP2Static.
 * Version: 0.2
 * Author: Marek Šloser
 * Author URI: https://www.nakit.cz
 * Text Domain: wp2static-addon-azure
 * Domain Path: /languages
 **/


use Msloser\Wp2staticAddonAzure\Init;

// If this file is called directly, abort!!!
defined( 'ABSPATH' ) or die();

if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
    require_once( __DIR__ . '/vendor/autoload.php' );
}

/**
 * Activate the plugin.
 */
function wp2static_addon_azure_activate(): void
{
    do_action(
        'wp2static_register_addon',
        'wp2static-addon-azure',
        'deploy',
        'Azure Deployment',
        'https://github.com/mareksloser/wp2static-addon-azure',
        'Adds Microsoft Azure Cloud Storage as a deployment option for WP2Static'
    );
}
register_activation_hook( __FILE__, 'wp2static_addon_azure_activate' );

/**
 * Deactivation hook.
 */
function wp2static_addon_azure_deactivate(): void
{
}
register_deactivation_hook( __FILE__, 'wp2static_addon_azure_deactivate' );

Init::instance();