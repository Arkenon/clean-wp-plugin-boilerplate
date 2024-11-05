<?php
/**
 * Post repository
 *
 * Implements the PostRepositoryInterface
 *
 * @since 1.0.0
 * @package PluginName
 * @subpackage Persistence\Repositories
 */

namespace PluginName\Persistence\Repositories;

defined( 'ABSPATH' ) || exit;

use PluginName\Common\Services\Mapper;
use PluginName\Domain\Models\Post;
use PluginName\Domain\Repositories\PostRepositoryInterface;
use ReflectionException;
use WP_Post;

class PostRepository implements PostRepositoryInterface {
	protected Mapper $mapper;
	protected string $model; //Model for custom post types. Default is Post.

	public function __construct( Mapper $mapper, string $model = Post::class ) {
		$this->mapper = $mapper;
		$this->model  = $model;
	}

	/**
	 * @template TModel
	 *
	 * Create a new model (Post, Page, Custom Post Type)
	 *
	 * @param array $args
	 *
	 * @psalm-return TModel|bool
	 * @return object|bool
	 * @throws ReflectionException
	 * @since 1.0.0
	 */
	public function create( array $args ) {
		$postId = wp_insert_post( $args, true );

		if ( is_wp_error( $postId ) ) {
			return false;
		}

		return $this->get( $postId );
	}

	/**
	 * @template TModel
	 *
	 * Update a model (Post, Page, Custom Post Type)
	 *
	 * @param array $args
	 *
	 * @psalm-return TModel|bool
	 * @return object|bool
	 * @throws ReflectionException
	 * @since 1.0.0
	 */
	public function update( array $args ) {
		$postId = wp_update_post( $args, true );

		if ( is_wp_error( $postId ) ) {
			return false;
		}

		return $this->get( $postId );
	}

	/**
	 * Delete a model (Post, Page, Custom Post Type)
	 *
	 * @param int $id
	 * @param bool $forceDelete
	 *
	 * @return bool
	 * @since 1.0.0
	 */
	public function delete( int $id, bool $forceDelete = false ): bool {
		$getPost = get_post( $id );
		if ( $getPost !== null ) {
			$delete = wp_delete_post( $id, $forceDelete );

			return is_object( $delete );
		} else {
			return false;
		}

	}

	/**
	 * @template TModel
	 *
	 * Get a model (Post, Page, Custom Post Type)
	 *
	 * @param int $id
	 *
	 * @psalm-return TModel|bool
	 * @return bool|object
	 * @throws ReflectionException
	 */
	public function get( int $id ) {
		$getPost = get_post( $id );

		if ( $getPost !== null ) {
			return $this->mapper->mapObjectToObject( $getPost, $this->model );
		} else {
			return false;
		}
	}

	/**
	 * @template TModel
	 *
	 * Get a list of models (Posts, Pages, Custom Post Types)
	 *
	 * @param array $args
	 *
	 * @psalm-return TModel[]|bool
	 * @return object[]|bool
	 * @throws ReflectionException
	 */
	public function getList( array $args ) {
		$getPosts = get_posts( $args );

		$posts = [];
		if ( count( $getPosts ) > 0 ) {
			$firstPost = reset( $getPosts );
			if ( $firstPost instanceof WP_Post ) {
				foreach ( $getPosts as $post ) {
					$mappedPost = $this->mapper->mapObjectToObject( $post, $this->model );
					$posts[]    = $mappedPost;
				}

				return $posts;
			}

			return $getPosts;
		} else {
			return false;
		}
	}
}
