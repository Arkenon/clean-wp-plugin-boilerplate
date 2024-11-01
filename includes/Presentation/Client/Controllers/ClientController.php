<?php
/**
 * Controller for frontend actions, scripts and styles
 * @package PluginName
 * @subpackage Presentation\Client\Controllers
 * @since 1.0.0
 */

namespace PluginName\Presentation\Client\Controllers;

use PluginName\Persistence\Constants\Constants;

defined( 'ABSPATH' ) || exit;

class ClientController {
	public function __construct() {
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueueScripts' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueueStyles' ] );
	}

	/**
	 * Enqueue scripts for the admin area
	 * @return void
	 * @since 1.0.0
	 */
	public function enqueueScripts(): void {
		//Public scripts
		wp_enqueue_script( 'plugin-name-client', Constants::INCLUDES_URL . '/Presentation/Admin/Assets/Js/plugin-name-client.js', array( 'jquery' ), PLUGIN_NAME_VERSION, true );
	}

	/**
	 * Enqueue styles for the admin area
	 * @return void
	 * @since 1.0.0
	 */
	public function enqueueStyles(): void {
		//Public styles
		wp_enqueue_style( 'plugin-name-client', Constants::INCLUDES_URL . '/Presentation/Admin/Assets/Css/plugin-name-client.css', array(), PLUGIN_NAME_VERSION );
	}
}
