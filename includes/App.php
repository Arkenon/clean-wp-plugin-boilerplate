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
use PluginName\Infrastructure\Services\i18nService;
use PluginName\Infrastructure\Services\MailService;
use PluginName\Infrastructure\Services\PostTypeService;
use PluginName\Infrastructure\Services\TaxonomyService;
use PluginName\Persistence\Configurations\DI;
use PluginName\Presentation\ControllerInit;

defined( 'ABSPATH' ) || exit;

final class App {

	/**
	 * List of services to be initialized on 'plugins_loaded' action
	 * @var array
	 * @since 1.0.0
	 */
	private array $pluginsLoaded = [
		BlockService::class,
		PostTypeService::class,
		TaxonomyService::class,
		CustomFieldService::class,
		MailService::class
	];

	/**
	 * List of services to be initialized on 'init' action
	 * Made required with WordPress 6.7
	 * @var array
	 * @since 1.0.0
	 */
	private array $init = [
		i18nService::class,
	];

	/**
	 * Include Presentation layer base class - ControllerInit.php
	 * Contains all controllers
	 * @var array
	 * @since 1.0.0
	 */
	private array $controllerInit = [
		ControllerInit::class
	];

	/**
	 * Run all services and controllers
	 * @return void
	 * @since 1.0.0
	 */
	public function run(): void {
		//Services
		add_action( 'init', [ $this, 'coreInit' ] );
		add_action( 'plugins_loaded', [ $this, 'initPluginServices' ] );
	}

	/**
	 * Initialize all services and controllers
	 * @throws DependencyException
	 * @throws NotFoundException
	 * @throws Exception
	 * @since 1.0.0
	 */
	public function initPluginServices() {
		//Define a hook runs before initializing the plugin
		do_action( 'plugin_name_after_init' );

		$classes = array_merge( $this->pluginsLoaded, $this->controllerInit );

		foreach ( $classes as $class ) {
			DI::container()->get( $class );
		}
		//Define a hook runs after initializing the plugin
		do_action( 'plugin_name_after_init' );
	}

	/**
	 * @throws DependencyException
	 * @throws NotFoundException
	 * @throws Exception
	 */
	public function coreInit() {
		foreach ( $this->init as $class ) {
			DI::container()->get( $class );
		}
	}
}
