<?php

namespace PluginName\Persistence\Repositories;

defined( 'ABSPATH' ) || exit;

use PluginName\Common\Services\Mapper;
use PluginName\Domain\Models\Post;
use PluginName\Domain\Repositories\PostRepositoryInterface;
use ReflectionException;
use WP_Post;

class PostRepository implements PostRepositoryInterface {
	private Mapper $mapper;
	private string $model; //Model for custom post types. Default is Post.

	public function __construct( Mapper $mapper, string $model = Post::class ) {
		$this->mapper = $mapper;
		$this->model  = $model;
	}

	/**
	 * Create a new model
	 *
	 * @param array $args
	 *
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
	 * Update a model
	 *
	 * @param array $args
	 *
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
	 * Delete a model
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
	 * Get a model
	 *
	 * @param int $id
	 *
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
	 * Get a list of models
	 *
	 * @param array $args
	 *
	 * @return object[]|bool
	 * @throws ReflectionException
	 */
	public function getList( array $args ): array {
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
