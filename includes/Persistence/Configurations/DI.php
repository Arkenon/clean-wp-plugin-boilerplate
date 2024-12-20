<?php
/**
 * Dependency Injection Container Configurations
 * @package PluginName
 * @subpackage Persistence\Configurations
 * @since 1.0.0
 */

namespace PluginName\Persistence\Configurations;

defined( 'ABSPATH' ) || exit;

use DI\Container;
use DI\ContainerBuilder;
use Exception;
use PluginName\Application\Interfaces\BookServiceInterface;
use PluginName\Application\Interfaces\CommentServiceInterface;
use PluginName\Application\Interfaces\PostServiceInterface;
use PluginName\Application\Interfaces\TaxonomyServiceInterface;
use PluginName\Application\Interfaces\UserServiceInterface;
use PluginName\Application\Services\BookService;
use PluginName\Application\Services\CommentService;
use PluginName\Application\Services\PostService;
use PluginName\Application\Services\TaxonomyService;
use PluginName\Application\Services\UserService;
use PluginName\Domain\Repositories\BookRepositoryInterface;
use PluginName\Domain\Repositories\CommentRepositoryInterface;
use PluginName\Domain\Repositories\PostRepositoryInterface;
use PluginName\Domain\Repositories\TaxonomyRepositoryInterface;
use PluginName\Domain\Repositories\UserRepositoryInterface;
use PluginName\Persistence\Repositories\BookRepository;
use PluginName\Persistence\Repositories\CommentRepository;
use PluginName\Persistence\Repositories\PostRepository;
use PluginName\Persistence\Repositories\TaxonomyRepository;
use PluginName\Persistence\Repositories\UserRepository;
use function DI\autowire;

class DI {
	/**
	 * Dependency Injection Container
	 * Add definitions and return the DI container
	 * @return Container
	 * @throws Exception
	 * @since 1.0.0
	 */
	public static function container(): Container {
		$containerBuilder = new ContainerBuilder();
		$containerBuilder->useAutowiring( true );

		$containerBuilder->addDefinitions( [

			/*Autowire all classes (Interfaces and Implementations)*/

			//Post
			PostRepositoryInterface::class     => autowire( PostRepository::class ),
			PostServiceInterface::class        => autowire( PostService::class ),

			//Book (Custom Post Type)
			BookRepositoryInterface::class     => autowire( BookRepository::class ),
			BookServiceInterface::class        => autowire( BookService::class ),

			//Comment
			CommentRepositoryInterface::class  => autowire( CommentRepository::class ),
			CommentServiceInterface::class     => autowire( CommentService::class ),

			//Taxonomy
			TaxonomyRepositoryInterface::class => autowire( TaxonomyRepository::class ),
			TaxonomyServiceInterface::class    => autowire( TaxonomyService::class ),

			//User
			UserRepositoryInterface::class     => autowire( UserRepository::class ),
			UserServiceInterface::class        => autowire( UserService::class ),

		] );

		return $containerBuilder->build();
	}
}
