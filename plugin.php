<?php declare( strict_types=1 );
/**
 * Plugin Name:       Clean Wp Plugin Boilerplate
 * Description:       Modern plugin boilerplate for WordPress. Uses clean architecture.
 * Requires at least: 6.1
 * Requires PHP:      7.4
 * Version:           1.0.0
 * Author:            Kadim Gültekin
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       plugin-name
 *
 * @package PluginName
 */

defined( 'ABSPATH' ) || exit;

use DI\DependencyException;
use DI\NotFoundException;
use PluginName\App;
use PluginName\Infrastructure\Services\ActivationService;
use PluginName\Infrastructure\Services\DeactivationService;
use PluginName\Persistence\Configurations\DI;


if ( is_readable( __DIR__ . '/vendor/autoload.php' ) ) {
	require_once __DIR__ . '/vendor/autoload.php';
}

define( 'PLUGIN_NAME_VERSION', get_file_data( __FILE__, array( 'version' => 'Version' ) )['version'] );
define( 'PLUGIN_NAME_URL', rtrim( plugin_dir_url( __FILE__ ), '/' ) . '/' );
define( 'PLUGIN_NAME_PATH', plugin_dir_path( __FILE__ ) );

//Activation
if ( ! function_exists( 'pluginNameInitActivation' ) ) {
	/**
	 * @throws DependencyException
	 * @throws NotFoundException
	 * @throws Exception
	 * @since 1.0.0
	 */
	function pluginNameInitActivation(): void {
		DI::container()->get( ActivationService::class )->activate();
	}

	register_activation_hook( __FILE__, 'pluginNameInitActivation' );
}

//Deactivation
if ( ! function_exists( 'pluginNameInitDeactivation' ) ) {
	/**
	 * @throws DependencyException
	 * @throws NotFoundException
	 * @throws Exception
	 * @since 1.0.0
	 */
	function pluginNameInitDeactivation(): void {
		DI::container()->get( DeactivationService::class )->deactivate();
	}

	register_deactivation_hook( __FILE__, 'pluginNameInitDeactivation' );
}

//Run plugin
if ( class_exists( App::class ) ) {
	/**
	 * @throws DependencyException
	 * @throws NotFoundException
	 * @throws Exception
	 */
	try {
		DI::container()->get( App::class )->run();
	} catch ( DependencyException|Exception $e ) {
		wp_die( $e->getMessage() );
	}
}
