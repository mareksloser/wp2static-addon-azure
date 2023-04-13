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


use Msloser\Wp2staticAddonAzure\Base\Activate;
use Msloser\Wp2staticAddonAzure\Base\Deactivate;
use Msloser\Wp2staticAddonAzure\Base\Uninstall;
use Msloser\Wp2staticAddonAzure\Init;

// If this file is called directly, abort!!!
defined( 'ABSPATH' ) or die();

if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
    require_once( __DIR__ . '/vendor/autoload.php' );
}

/**
 * Activate the plugin.
 */
register_activation_hook(__FILE__, [Activate::class, 'activate']);

/**
 * Deactivation hook.
 */
register_deactivation_hook(__FILE__, [Deactivate::class, 'deactivate']);

/**
 * Uninstall hook.
 */
register_uninstall_hook(__FILE__, [Uninstall::class, 'uninstall']);

Init::instance();