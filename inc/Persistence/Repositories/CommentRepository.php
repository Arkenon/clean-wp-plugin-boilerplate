<?php

namespace PluginName\Persistence\Repositories;

defined( 'ABSPATH' ) || exit;

use PluginName\Common\Services\Mapper;
use PluginName\Domain\Entities\Comment;
use PluginName\Domain\Repositories\CommentRepositoryInterface;
use ReflectionException;

class CommentRepository implements CommentRepositoryInterface {
	private Mapper $mapper;

	public function __construct( Mapper $mapper ) {
		$this->mapper = $mapper;
	}

	/**
	 * @param array $args
	 *
	 * @return Comment|bool
	 * @throws ReflectionException
	 */
	public function create( array $args ) {
		$commentId = wp_insert_comment( $args );

		if ( ! $commentId ) {
			return false;
		}

		return $this->get( $commentId );
	}

	/**
	 * @param array $args
	 *
	 * @return Comment|bool
	 * @throws ReflectionException
	 */
	public function update( array $args ) {
		$update = wp_update_comment( $args );

		if ( ! $update || is_wp_error( $update ) || $update === 0 ) {
			return false;
		}

		return $this->get( $args['comment_ID'] );
	}

	/**
	 * @param int $id
	 * @param bool $forceDelete
	 *
	 * @return bool
	 */
	public function delete( int $id, bool $forceDelete = false ): bool {
		return wp_delete_comment( $id, $forceDelete );
	}

	/**
	 * @param int $id
	 *
	 * @return Comment|bool
	 * @throws ReflectionException
	 */
	public function get( int $id ) {
		$comment = get_comment( $id );

		if ( count( $comment ) > 0 ) {
			return $this->mapper->mapObjectToObject( $comment, Comment::class );
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
		$comments = get_comments( $args );

		$commentList = [];
		if ( count( $comments ) > 0 ) {
			if ( $args['fields'] !== 'ids' ) {
				foreach ( $comments as $comment ) {
					$mappedComment = $this->mapper->mapObjectToObject( $comment, Comment::class );
					$commentList[] = $mappedComment;
				}

				return $commentList;
			}

			return $comments;
		} else {
			return false;
		}
	}
}
