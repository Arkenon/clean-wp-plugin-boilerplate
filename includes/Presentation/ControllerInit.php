<?php
/**
 * Base class for Presentation layer
 * Contains all controllers
 * @since 1.0.0
 * @package PluginName
 * @subpackage Presentation
 */

namespace PluginName\Presentation;

defined( 'ABSPATH' ) || exit;

use Exception;
use PluginName\Persistence\Configurations\DI;
use PluginName\Presentation\Admin\Controllers\AdminController;
use PluginName\Presentation\Client\Controllers\BookController;
use PluginName\Presentation\Client\Controllers\ClientController;

final class ControllerInit {

	/**
	 * List of controllers to be initialized for Admin
	 * @var array
	 * @since 1.0.0
	 */
	private array $adminControllers =  [
		AdminController::class,
	];

	/**
	 * List of controllers to be initialized for Client
	 * @var array
	 * @since 1.0.0
	 */
	private array $clientControllers  = [
		ClientController::class,
		BookController::class
	];

	/**
	 * Initialize the program
	 * @throws Exception
	 * @since 1.0.0
	 */
	public function __construct() {
		// Initialize controllers
		$this->initControllers();
	}

	/**
	 * Initialize controllers
	 * @throws Exception
	 * @since 1.0.0
	 */
	public function initControllers() {
		// Initialize controllers for admin area
		if ( is_admin() ) {
			foreach ( $this->adminControllers as $controller ) {
				DI::container()->get( $controller );
			}
		}

		// Initialize controllers for client area
		foreach ( $this->clientControllers as $controller ) {
			DI::container()->get( $controller );
		}
	}
}
