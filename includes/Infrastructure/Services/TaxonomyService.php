<?php
/**
 * Taxonomy service
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
use PluginName\Infrastructure\Taxonomies\TaxonomyGenre;
use PluginName\Persistence\Configurations\DI;

defined('ABSPATH') || exit;

class TaxonomyService
{
	public function __construct()
	{
		add_action('init', [$this, 'registerTaxonomies']);
	}

	/**
	 * Register taxonomies. You can add more taxonomies here.
	 * @return void
	 * @throws NotFoundException
	 * @throws Exception
	 * @throws DependencyException
	 * @since 1.0.0
	 */
	public function registerTaxonomies()
	{
		DI::container()->get(TaxonomyGenre::class)->register();
	}
}
