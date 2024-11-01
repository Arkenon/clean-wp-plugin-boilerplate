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
use PluginName\Presentation\Program;

defined( 'ABSPATH' ) || exit;

class App {

	/**
	 * List of services to be initialized
	 * @var array
	 * @since 1.0.0
	 */
	private array $services = [
		BlockService::class,
		i18nService::class,
		PostTypeService::class,
		TaxonomyService::class,
		CustomFieldService::class,
		MailService::class
	];

	/**
	 * Include Presentation layer base class - Program.php
	 * Contains all controllers
	 * @var array
	 * @since 1.0.0
	 */
	private array $program = [
		Program::class
	];

	/**
	 * Run all services and controllers
	 * @return void
	 * @since 1.0.0
	 */
	public function run(): void {
		//Init all services and controllers on plugins_loaded hook
		add_action( 'plugins_loaded', [ $this, 'initPluginServices' ] );
	}

	/**
	 * Initialize all services and controllers
	 * @return void
	 * @throws NotFoundException
	 * @throws Exception
	 * @throws DependencyException
	 * @since 1.0.0
	 */
	public function initPluginServices(): void {

		//Define a hook runs before initializing the plugin
		do_action( 'plugin_name_before_init' );

		$services_and_controllers = array_merge( $this->services, $this->program );

		foreach ( $services_and_controllers as $item ) {
			DI::container()->get( $item );
		}
		//Define a hook runs after initializing the plugin
		do_action( 'plugin_name_after_init' );

	}
}
