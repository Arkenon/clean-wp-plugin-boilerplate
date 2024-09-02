<?php

namespace PluginName\Persistence\Configurations;

defined('ABSPATH') || exit;

use DI\Container;
use DI\ContainerBuilder;
use Exception;
use PluginName\Application\Interfaces\CommentServiceInterface;
use PluginName\Application\Interfaces\PostServiceInterface;
use PluginName\Application\Interfaces\TaxonomyServiceInterface;
use PluginName\Application\Interfaces\UserServiceInterface;
use PluginName\Application\UseCases\CommentManager;
use PluginName\Application\UseCases\PostManager;
use PluginName\Application\UseCases\TaxonomyManager;
use PluginName\Application\UseCases\UserManager;
use PluginName\Domain\Repositories\CommentRepositoryInterface;
use PluginName\Domain\Repositories\PostRepositoryInterface;
use PluginName\Domain\Repositories\TaxonomyRepositoryInterface;
use PluginName\Domain\Repositories\UserRepositoryInterface;
use PluginName\Persistence\Repositories\CommentRepository;
use PluginName\Persistence\Repositories\PostRepository;
use PluginName\Persistence\Repositories\TaxonomyRepository;
use PluginName\Persistence\Repositories\UserRepository;
use function DI\autowire;

class DI
{
	/**
	 * @throws Exception
	 */
	public static function container(): Container {
		$containerBuilder = new ContainerBuilder();
		$containerBuilder->useAutowiring(true);

		$containerBuilder->addDefinitions([

			//Comment
			CommentRepositoryInterface::class => autowire(CommentRepository::class),
			CommentServiceInterface::class => autowire(CommentManager::class),
			//Post
			PostRepositoryInterface::class => autowire(PostRepository::class),
			PostServiceInterface::class => autowire(PostManager::class),
			//Taxonomy
			TaxonomyRepositoryInterface::class => autowire(TaxonomyRepository::class),
			TaxonomyServiceInterface::class => autowire(TaxonomyManager::class),
			//User
			UserRepositoryInterface::class => autowire(UserRepository::class),
			UserServiceInterface::class => autowire(UserManager::class),

		]);

		return $containerBuilder->build();
	}
}
