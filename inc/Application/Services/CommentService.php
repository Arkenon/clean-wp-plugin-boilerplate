<?php

namespace PluginName\Application\UseCases;

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
	 * @param array $args
	 *
	 * @return CommentDto|bool
	 * @throws ReflectionException
	 */
	public function create( array $args ) {
		$comment = $this->repository->create( $args );

		if ( ! $comment ) {
			return false;
		}

		return $this->mapper->mapObjectToObject( $comment, CommentDto::class );
	}

	/**
	 * @param array $args
	 *
	 * @return CommentDto|bool
	 * @throws ReflectionException
	 */
	public function update( array $args ) {
		$comment = $this->repository->update( $args );

		if ( ! $comment ) {
			return false;
		}

		return $this->mapper->mapObjectToObject( $comment, CommentDto::class );
	}

	public function delete( int $id, bool $forceDelete = false ): bool {
		return $this->repository->delete( $id, $forceDelete );
	}

	/**
	 * @param int $id
	 *
	 * @return CommentDto|bool
	 * @throws ReflectionException
	 */
	public function get( int $id ) {
		$comment = $this->get( $id );

		if ( ! $comment ) {
			return false;
		}

		return $this->mapper->mapObjectToObject( $comment, CommentDto::class );

	}

	/**
	 * @param array $args
	 *
	 * @return array|bool
	 * @throws ReflectionException
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
