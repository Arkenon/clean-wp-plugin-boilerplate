<?php
/**
 * Admin controller class
 * Creates main menu and submenus for admin area
 * @package PluginName
 * @subpackage Presentation\Admin\Controllers
 * @since 1.0.0
 */

namespace PluginName\Presentation\Admin\Controllers;

use Exception;
use PluginName\Persistence\Constants\Constants;

defined( 'ABSPATH' ) || exit;

final class AdminController {
	public function __construct() {
		add_action( 'admin_enqueue_scripts', [ $this, 'enqueueScripts' ] );
		add_action( 'admin_enqueue_scripts', [ $this, 'enqueueStyles' ] );
		add_action( 'admin_menu', [ $this, 'addMenu' ] );
		add_action( 'admin_init', [ $this, 'registerOptions' ] );
	}

	/**
	 * Enqueue scripts for the admin area
	 * @return void
	 * @since 1.0.0
	 */
	public function enqueueScripts(): void {
		//Admin scripts
		wp_enqueue_script( 'plugin-name-admin', Constants::INCLUDES_URL . '/Presentation/Admin/Assets/Js/plugin-name-admin.js', array( 'jquery' ), PLUGIN_NAME_VERSION, true );
	}

	/**
	 * Enqueue styles for the admin area
	 * @return void
	 * @since 1.0.0
	 */
	public function enqueueStyles(): void {
		//Admin styles
		wp_enqueue_style( 'plugin-name-admin', Constants::INCLUDES_URL . '/Presentation/Admin/Assets/Css/plugin-name-admin.css', array(), PLUGIN_NAME_VERSION );
	}

	/**
	 * Add a menu for the plugin
	 * @return void
	 * @since 1.0.0
	 */
	public function addMenu() {
		add_menu_page(
			esc_html__( 'Plugin Name Menu', 'plugin-name' ),
			esc_html__( 'Plugin Name', 'plugin-name' ),
			'manage_options',
			'plugin-name',
			[ $this, 'renderDashboard' ],
			'dashicons-admin-generic',
		);
	}

	/**
	 * Register options for the dashboard page
	 * @return void
	 * @since    1.0.0
	 */
	public function registerOptions(): void {

		// Register option 1
		register_setting( 'plugin-name-settings-group', 'plugin_name_settings_one' );

		// Register option 2
		register_setting( 'plugin-name-settings-group', 'plugin_name_settings_two' );

	}

	/**
	 * Render HTML output for dashboard
	 * @return void
	 * @since 1.0.0
	 */
	public function renderDashboard(): void {
		ob_start();
		try {
			include Constants::INCLUDES_PATH . 'Presentation/Admin/Views/admin-menu-content.php';
			echo ob_get_clean();
		} catch ( Exception $e ) {
			ob_end_clean();
		}
	}
}
