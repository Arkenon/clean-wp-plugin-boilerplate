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

use PluginName\App;
use PluginName\Persistence\Configurations\DI;

if ( is_readable( __DIR__ . '/vendor/autoload.php' ) ) {
	require_once __DIR__ . '/vendor/autoload.php';
}

define( 'PLUGIN_NAME_VERSION', get_file_data( __FILE__, array( 'version' => 'Version' ) )['version'] );
define( 'PLUGIN_NAME_PLUGIN_URL', rtrim( plugin_dir_url( __FILE__ ), '/' ) . '/' );
define( 'PLUGIN_NAME_PLUGIN_DIR_PATH', plugin_dir_path( __FILE__ ) );

//Run plugin
if ( class_exists( App::class ) ) {
	DI::container()->get( App::class )->run();
}

/*$data = DI::container()->get(\PluginName\Presentation\Controllers\TaxonomyController::class)->delete();
print_r($data);*/
