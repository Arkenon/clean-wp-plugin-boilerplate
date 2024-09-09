<?php

namespace PluginName\Presentation\Admin\Controllers;

defined( 'ABSPATH' ) || exit;

class AdminController {
	public function __construct() {
		add_action( 'admin_menu', [ $this, 'addMenu' ] );
	}

	public function addMenu() {
		add_menu_page(
			esc_html__( 'Plugin Name Menu', 'plugin-name' ),
			esc_html__( 'Plugin Name', 'plugin-name' ),
			'manage_options',
			'plugin-name',
			[ $this, 'renderDashboard' ],
			'dashicons-admin-generic',
			6
		);
	}

	public function renderDashboard() {
		$content = include PLUGIN_NAME_PLUGIN_DIR_PATH . 'inc/Presentation/Admin/Views/admin-menu-content.php';

		echo $content;
	}
}
