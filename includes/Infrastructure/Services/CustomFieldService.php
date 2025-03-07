<?php
/**
 * Custom Field service class for plugin
 * @package PluginName
 * @subpackage Infrastructure\Services
 * @since 1.0.0
 */

namespace PluginName\Infrastructure\Services;

use DI\DependencyException;
use DI\NotFoundException;
use Exception;
use PluginName\Infrastructure\CustomFields\Book\CustomFieldISBN;
use PluginName\Persistence\Configurations\DI;

defined( 'ABSPATH' ) || exit;

class CustomFieldService {
	public function __construct() {
		$this->addMetaBoxes();
	}

	/**
	 * @throws DependencyException
	 * @throws NotFoundException
	 * @throws Exception
	 */
	public function addMetaBoxes() {
		DI::container()->get( CustomFieldISBN::class )->register();
	}
}
