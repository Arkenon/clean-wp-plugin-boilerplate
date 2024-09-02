<?php

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
	 * @throws DependencyException
	 * @throws NotFoundException
	 * @throws Exception
	 */
	public function registerTaxonomies()
	{
		DI::container()->get(TaxonomyGenre::class)->register();
	}

}
