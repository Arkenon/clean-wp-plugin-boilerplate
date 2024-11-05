<?php
/**
 * Comment Service
 *
 * This class implements the Comment Service Interface and includes methods to interact with the Comment Repository
 *
 * @package PluginName
 * @subpackage PluginName\Application\Services
 * @since 1.0.0
 */

namespace PluginName\Application\Services;

defined( 'ABSPATH' ) || exit;

use PluginName\Application\DTOs\Comment\CommentDto;
use PluginName\Application\Interfaces\CommentServiceInterface;
use PluginName\Common\Services\Mapper;
use PluginName\Domain\Repositories\CommentRepositoryInterface;
use ReflectionException;

class CommentService implements CommentServiceInterface {

	private CommentRepositoryInterface $repository;
	private Mapper $mapper;

	public function __construct( CommentRepositoryInterface $repository, Mapper $mapper ) {
		$this->repository = $repository;
		$this->mapper     = $mapper;
	}

	/**
	 * Create a new DTO for a related model
	 *
	 * @param array $args
	 *
	 * @return CommentDto|bool
	 * @throws ReflectionException
	 * @since 1.0.0
	 */
	public function create( array $args ) {
		$comment = $this->repository->create( $args );

		if ( ! $comment ) {
			return false;
		}

		return $this->mapper->mapObjectToObject( $comment, CommentDto::class );
	}

	/**
	 * Update a DTO for a related model
	 *
	 * @param array $args
	 *
	 * @return CommentDto|bool
	 * @throws ReflectionException
	 * @since 1.0.0
	 */
	public function update( array $args ) {
		$comment = $this->repository->update( $args );

		if ( ! $comment ) {
			return false;
		}

		return $this->mapper->mapObjectToObject( $comment, CommentDto::class );
	}

	/**
	 * Delete the related model
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
	 * Get a DTO for the related model
	 *
	 * @param int $id
	 *
	 * @return CommentDto|bool
	 * @throws ReflectionException
	 * @since 1.0.0
	 */
	public function get( int $id ) {
		$comment = $this->repository->get( $id );

		if ( ! $comment ) {
			return false;
		}

		return $this->mapper->mapObjectToObject( $comment, CommentDto::class );

	}

	/**
	 * Get a list of DTOs for the related model
	 *
	 * @param array $args
	 *
	 * @return CommentDto[]|bool
	 * @throws ReflectionException
	 * @since 1.0.0
	 */
	public function getList( array $args ) {
		$comments = $this->repository->getList( $args );

		if ( ! $comments ) {
			return false;
		}

		$commentList = [];
		foreach ( $comments as $comment ) {
			$mappedComment = $this->mapper->mapObjectToObject( $comment, CommentDto::class );
			$commentList[] = $mappedComment;
		}

		return $commentList;
	}
}
