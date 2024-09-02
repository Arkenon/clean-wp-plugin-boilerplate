<?php

namespace PluginName\Infrastructure\Services;

use DI\DependencyException;
use DI\NotFoundException;
use Exception;
use PluginName\Infrastructure\PostTypes\PostTypeBook;
use PluginName\Persistence\Configurations\DI;

defined('ABSPATH') || exit;

class PostTypeService
{
	public function __construct()
	{
		add_action('init', [$this, 'registerPostTypes']);
	}

	/**
	 * @throws DependencyException
	 * @throws NotFoundException
	 * @throws Exception
	 */
	public function registerPostTypes()
	{
		DI::container()->get(PostTypeBook::class)->register();
	}

}
