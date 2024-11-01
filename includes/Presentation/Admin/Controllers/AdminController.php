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

class AdminController {
	public function __construct() {
		add_action( 'admin_enqueue_scripts', [ $this, 'enqueueScripts' ] );
		add_action( 'admin_enqueue_scripts', [ $this, 'enqueueStyles' ] );
		add_action( 'admin_menu', [ $this, 'addMenu' ] );
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
	 * Render HTML output for dashboard
	 * @return void
	 * @since 1.0.0
	 */
	public function renderDashboard(): void {
		ob_start();
		try {
			include Constants::INCLUDES_PATH . 'Presentation/Admin/Views/admin-menu-content.php';
			echo wp_kses_post( ob_get_clean() );
		} catch ( Exception $e ) {
			ob_end_clean();
		}
	}
}
