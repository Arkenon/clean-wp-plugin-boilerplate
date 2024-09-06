<?php

namespace PluginName\Application\UseCases;

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

	public function __construct( PostRepositoryInterface $repository, Mapper $mapper ) {
		$this->repository = $repository;
		$this->mapper     = $mapper;
	}

	/**
	 * @param array $args
	 *
	 * @return PostDto|bool
	 * @throws ReflectionException
	 */
	public function create( array $args ) {
		$post = $this->repository->create( $args );

		if ( ! $post ) {
			return false;
		}

		return $this->mapper->mapObjectToObject( $post, PostDto::class );
	}

	/**
	 * @param array $args
	 *
	 * @return PostDto|bool
	 * @throws ReflectionException
	 */
	public function update( array $args ) {
		$post = $this->repository->update( $args );

		if ( ! $post ) {
			return false;
		}

		return $this->mapper->mapObjectToObject( $post, PostDto::class );
	}

	public function delete( int $id, bool $forceDelete = false ): bool {
		return $this->repository->delete( $id, $forceDelete );
	}

	/**
	 * @param int $id
	 *
	 * @return PostDto|bool
	 * @throws ReflectionException
	 */
	public function get( int $id ) {
		$post = $this->repository->get( $id );

		if ( ! $post ) {
			return false;
		}

		return $this->mapper->mapObjectToObject( $post, PostDto::class );
	}

	/**
	 * @param array $args
	 *
	 * @return array|bool
	 * @throws ReflectionException
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
				$mappedPost = $this->mapper->mapObjectToObject( $post, PostDto::class );
				$postList[] = $mappedPost;
			}

			return $postList;
		}

		return $posts;
	}
}
