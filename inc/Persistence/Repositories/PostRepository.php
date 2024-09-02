<?php

namespace PluginName\Persistence\Repositories;

defined( 'ABSPATH' ) || exit;

use PluginName\Common\Services\Mapper;
use PluginName\Domain\Entities\Post;
use PluginName\Domain\Repositories\PostRepositoryInterface;
use ReflectionException;
use WP_Post;

class PostRepository implements PostRepositoryInterface {
	private Mapper $mapper;

	public function __construct( Mapper $mapper ) {
		$this->mapper = $mapper;
	}

	/**
	 * @param array $args
	 *
	 * @return Post|bool
	 * @throws ReflectionException
	 */
	public function create( array $args ) {
		$postId = wp_insert_post( $args, true );

		if ( is_wp_error( $postId ) ) {
			return false;
		}

		return $this->get( $postId );
	}

	/**
	 * @param array $args
	 *
	 * @return Post|bool
	 * @throws ReflectionException
	 */
	public function update( array $args ) {
		$postId = wp_update_post( $args, true );

		if ( is_wp_error( $postId ) ) {
			return false;
		}

		return $this->get( $postId );
	}

	/**
	 * @param int $id
	 * @param bool $forceDelete
	 *
	 * @return bool
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
	 * @param int $id
	 *
	 * @return Post|bool
	 * @throws ReflectionException
	 */
	public function get( int $id ) {
		$getPost = get_post( $id );

		if ( $getPost !== null ) {
			return $this->mapper->mapObjectToObject( $getPost, Post::class );
		} else {
			return false;
		}
	}

	/**
	 * @param array $args
	 *
	 * @return array|bool
	 * @throws ReflectionException
	 */
	public function getList( array $args ) {
		$getPosts = get_posts( $args );

		$posts = [];
		if ( count( $getPosts ) > 0 ) {
			$firstPost = reset( $getPosts );
			if ( $firstPost instanceof WP_Post ) {
				foreach ( $getPosts as $post ) {
					$mappedPost = $this->mapper->mapObjectToObject( $post, Post::class );
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
