<?php
/**
 * Comment repository
 *
 * Implements the CommentRepositoryInterface
 *
 * @since 1.0.0
 * @package PluginName
 * @subpackage Persistence\Repositories
 */

namespace PluginName\Persistence\Repositories;

defined( 'ABSPATH' ) || exit;

use PluginName\Common\Services\Mapper;
use PluginName\Domain\Models\Comment;
use PluginName\Domain\Repositories\CommentRepositoryInterface;
use ReflectionException;

class CommentRepository implements CommentRepositoryInterface {
	private Mapper $mapper;

	public function __construct( Mapper $mapper ) {
		$this->mapper = $mapper;
	}

	/**
	 * Create a new model
	 *
	 * @param array $args
	 *
	 * @return Comment|bool
	 * @throws ReflectionException
	 * @since 1.0.0
	 */
	public function create( array $args ) {
		$commentId = wp_insert_comment( $args );

		if ( ! $commentId ) {
			return false;
		}

		return $this->get( $commentId );
	}

	/**
	 * Update a model
	 *
	 * @param array $args
	 *
	 * @return Comment|bool
	 * @throws ReflectionException
	 * @since 1.0.0
	 */
	public function update( array $args ) {
		$update = wp_update_comment( $args );

		if ( ! $update || is_wp_error( $update ) || $update === 0 ) {
			return false;
		}

		return $this->get( $args['comment_ID'] );
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
		return wp_delete_comment( $id, $forceDelete );
	}

	/**
	 * Get a model
	 *
	 * @param int $id
	 *
	 * @return Comment|bool
	 * @throws ReflectionException
	 * @since 1.0.0
	 */
	public function get( int $id ) {
		$comment = get_comment( $id );

		if ( is_object( $comment ) && $comment->comment_ID > 0 ) {
			return $this->mapper->mapObjectToObject( $comment, Comment::class );
		} else {
			return false;
		}
	}

	/**
	 * Get a list of models
	 *
	 * @param array $args
	 *
	 * @return Comment[]|bool
	 * @throws ReflectionException
	 * @since 1.0.0
	 */
	public function getList( array $args ) {
		$comments = get_comments( $args );

		$commentList = [];
		if ( count( $comments ) > 0 ) {
			if ( isset( $args['fields'] ) && $args['fields'] !== 'ids' ) {
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
