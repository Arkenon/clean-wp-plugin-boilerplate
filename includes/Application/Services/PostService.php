<?php
/**
 * Post Service
 *
 * This class implements the methods defined in the Post Service Interface and includes the methods to interact with the Post Repository
 *
 * @package PluginName
 * @subpackage PluginName\Application\Services
 * @since 1.0.0
 */

namespace PluginName\Application\Services;

defined( 'ABSPATH' ) || exit;

use PluginName\Application\DTOs\Post\PostDto;
use PluginName\Application\Interfaces\PostServiceInterface;
use PluginName\Common\Services\Mapper;
use PluginName\Domain\Repositories\PostRepositoryInterface;
use ReflectionException;
use WP_Post;

class PostService implements PostServiceInterface {
	private PostRepositoryInterface $repository;
	private Mapper $mapper;
	private string $model; //Model for custom post types. Default is PostDto.

	public function __construct( PostRepositoryInterface $repository, Mapper $mapper, string $model = PostDto::class ) {
		$this->repository = $repository;
		$this->mapper     = $mapper;
		$this->model      = $model;
	}

	/**
	 * @template TModel
	 *
	 *  Create a DTO for the related model (Post, Page, Custom Post Type)
	 *
	 * @param array $args
	 *
	 * @psalm-return TModel|bool
	 * @return object|bool
	 * @throws ReflectionException
	 * @since 1.0.0
	 */
	public function create( array $args ) {
		$post = $this->repository->create( $args );

		if ( ! $post ) {
			return false;
		}

		return $this->mapper->mapObjectToObject( $post, $this->model );
	}

	/**
	 * @template TModel
	 *
	 * Update a DTO for the related model (Post, Page, Custom Post Type)
	 *
	 * @param array $args
	 *
	 * @psalm-return TModel|bool
	 * @return object|bool
	 * @throws ReflectionException
	 * @since 1.0.0
	 */
	public function update( array $args ) {
		$post = $this->repository->update( $args );

		if ( ! $post ) {
			return false;
		}

		return $this->mapper->mapObjectToObject( $post, $this->model );
	}

	/**
	 * Delete the related model (Post, Page, Custom Post Type)
	 *
	 * @param int $id
	 * @param bool $forceDelete
	 *
	 * @return bool
	 * @since 1.0.0
	 */
	public function delete( int $id, bool $forceDelete = false ): bool {
		return $this->repository->delete( $id, $forceDelete );
	}

	/**
	 * @template TModel
	 *
	 * Get a DTO for the related model (Post, Page, Custom Post Type)
	 *
	 * @param int $id
	 *
	 * @psalm-return TModel|bool
	 * @return object|bool
	 * @throws ReflectionException
	 * @since 1.0.0
	 */
	public function get( int $id ) {
		$post = $this->repository->get( $id );

		if ( ! $post ) {
			return false;
		}

		return $this->mapper->mapObjectToObject( $post, $this->model );
	}

	/**
	 * @template TModel
	 *
	 * Get a list of DTOs for the related model (Posts, Pages, Custom Post Types)
	 *
	 * @param array $args
	 *
	 * @psalm-return TModel[]|bool
	 * @return object[]|bool
	 * @throws ReflectionException
	 * @since 1.0.0
	 */
	public function getList( array $args ) {
		$posts = $this->repository->getList( $args );

		if ( ! $posts ) {
			return false;
		}

		$postList  = [];
		$firstPost = reset( $posts );
		if ( $firstPost instanceof WP_Post ) {
			foreach ( $posts as $post ) {
				$mappedPost = $this->mapper->mapObjectToObject( $post, $this->model );
				$postList[] = $mappedPost;
			}

			return $postList;
		}

		return $posts;
	}
}
