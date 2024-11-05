<?php
/**
 * Comment repository interface*
 * Contains methods for CRUD operations on Comment model
 * @package PluginName
 * @subpackage Domain\Repositories
 * @since 1.0.0
 */

namespace PluginName\Domain\Repositories;

use PluginName\Domain\Models\Comment;

defined( 'ABSPATH' ) || exit;

interface CommentRepositoryInterface {
	/**
	 * Create a new model
	 *
	 * @param array $args
	 *
	 * @return Comment|bool
	 * @since 1.0.0
	 */
	public function create( array $args );

	/**
	 * Update a model
	 *
	 * @param array $args
	 *
	 * @return Comment|bool
	 * @since 1.0.0
	 */
	public function update( array $args );

	/**
	 * Delete a model
	 *
	 * @param int $id
	 * @param bool $forceDelete
	 *
	 * @return bool
	 * @since 1.0.0
	 */
	public function delete( int $id, bool $forceDelete = false ): bool;

	/**
	 * Get a model
	 *
	 * @param int $id
	 *
	 * @return Comment|bool
	 * @since 1.0.0
	 */
	public function get( int $id );

	/**
	 * Get a list of models
	 *
	 * @param array $args
	 *
	 * @return Comment[]|bool
	 * @since 1.0.0
	 */
	public function getList( array $args );
}
