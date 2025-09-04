<?php
/**
 * Main plugin class
 * Runs on plugins_loaded action
 * @package PluginName
 * @since 1.0.0
 */

namespace PluginName;

use DI\DependencyException;
use DI\NotFoundException;
use Exception;
use PluginName\Infrastructure\Services\BlockService;
use PluginName\Infrastructure\Services\CustomFieldService;
use PluginName\Infrastructure\Services\MailService;
use PluginName\Infrastructure\Services\PostTypeService;
use PluginName\Infrastructure\Services\TaxonomyService;
use PluginName\Persistence\Configurations\DI;
use PluginName\Presentation\ControllerInit;

defined( 'ABSPATH' ) || exit;

final class App {

	/**
	 * List of services to be initialized
	 * @var array
	 * @since 1.0.0
	 */
	private array $services = [
		BlockService::class,
		PostTypeService::class,
		TaxonomyService::class,
		CustomFieldService::class,
		MailService::class
	];

	/**
	 * Include Presentation layer base class - ControllerInit.php
	 * Contains all controllers
	 * @var array
	 * @since 1.0.0
	 */
	private array $controllers = [
		ControllerInit::class
	];

	/**
	 * Run all services and controllers
	 * @return void
	 * @since 1.0.0
	 */
	public function run(): void {
		//Define a hook runs before initializing the plugin
		do_action( 'plugin_name_before_init' );

		// Load all services
		add_action( 'plugins_loaded', [ $this, 'initPluginServices' ] );

		//Load all controllers
		add_action( 'init', [ $this, 'initPluginControllers' ], 5 );

		//Define a hook runs after initializing the plugin
		do_action( 'plugin_name_after_init' );
	}

	/**
	 * Initialize all services and controllers
	 * @throws DependencyException
	 * @throws NotFoundException
	 * @throws Exception
	 * @since 1.0.0
	 */
	public function initPluginServices(): void
	{
		//Initialize all services
		foreach ( $this->services as $service ) {
			DI::container()->get( $service );
		}
	}

	/**
	 * Initialize all controllers
	 * @throws Exception
	 * @throws DependencyException
	 * @throws NotFoundException
	 * @since 1.0.0
	 */
	public function initPluginControllers(): void
	{
		//Initialize all controllers
		foreach ( $this->controllers as $controller ) {
			DI::container()->get( $controller );
		}
	}
}
