<?php
/**
 * Post type service
 *
 * @package PluginName
 * @subpackage Infrastructure\Services
 * @since 1.0.0
 *
 */

namespace PluginName\Infrastructure\Services;

use DI\DependencyException;
use DI\NotFoundException;
use Exception;
use PluginName\Infrastructure\PostTypes\PostTypeBook;
use PluginName\Persistence\Configurations\DI;

defined( 'ABSPATH' ) || exit;

class PostTypeService {
	public function __construct() {
		add_action( 'init', [ $this, 'registerPostTypes' ] );
	}

	/**
	 * Register post types
	 * @return void
	 * @throws NotFoundException
	 * @throws Exception
	 * @throws DependencyException
	 * @since 1.0.0
	 */
	public function registerPostTypes() {
		DI::container()->get( PostTypeBook::class )->register();
	}
}
