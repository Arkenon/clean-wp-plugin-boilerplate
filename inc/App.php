<?php

namespace PluginName;

use DI\DependencyException;
use DI\NotFoundException;
use Exception;
use PluginName\Infrastructure\Services\ActivationService;
use PluginName\Infrastructure\Services\AssetService;
use PluginName\Infrastructure\Services\BlockService;
use PluginName\Infrastructure\Services\CustomFieldService;
use PluginName\Infrastructure\Services\DeactivationService;
use PluginName\Infrastructure\Services\i18nService;
use PluginName\Infrastructure\Services\MailService;
use PluginName\Infrastructure\Services\PostTypeService;
use PluginName\Infrastructure\Services\TaxonomyService;
use PluginName\Persistence\Configurations\DI;

defined( 'ABSPATH' ) || exit;

class App {
	public function run() {
		//Activation
		register_activation_hook( __FILE__, [ $this, 'initActivation' ] );
		//Deactivation
		register_deactivation_hook( __FILE__, [ $this, 'initDeactivation' ] );
		//Services
		add_action( 'plugins_loaded', [ $this, 'initPluginServices' ] );
	}

	/**
	 * @throws DependencyException
	 * @throws NotFoundException
	 * @throws Exception
	 */
	public function initActivation() {
		DI::container()->get( ActivationService::class )->activate();
	}

	/**
	 * @throws DependencyException
	 * @throws NotFoundException
	 * @throws Exception
	 */
	public function initDeactivation() {
		DI::container()->get( DeactivationService::class )->deactivate();
	}

	/**
	 * @throws DependencyException
	 * @throws NotFoundException
	 * @throws \Exception
	 */
	public function initPluginServices() {
		do_action( 'plugin_name_before_init' );

		$services = [
			AssetService::class,
			BlockService::class,
			i18nService::class,
			PostTypeService::class,
			TaxonomyService::class,
			CustomFieldService::class,
			MailService::class
		];

		foreach ( $services as $service ) {
			DI::container()->get( $service );
		}

		do_action( 'plugin_name_after_init' );
	}
}
