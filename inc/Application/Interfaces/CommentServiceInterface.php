<?php

namespace PluginName\Application\Interfaces;

defined( 'ABSPATH' ) || exit;

use PluginName\Application\DTOs\Comment\CommentDto;

interface CommentServiceInterface {
	/**
	 * Create a new DTO for the related model
	 *
	 * @param array $args
	 *
	 * @return CommentDto|bool
	 * @since 1.0.0
	 */
	public function create( array $args );

	/**
	 * Update a DTO for the related model
	 *
	 * @param array $args
	 *
	 * @return CommentDto|bool
	 * @since 1.0.0
	 */
	public function update( array $args );

	/**
	 * Delete a DTO for the related model
	 *
	 * @param int $id
	 * @param bool $forceDelete
	 *
	 * @return bool
	 * @since 1.0.0
	 */
	public function delete( int $id, bool $forceDelete = false ): bool;

	/**
	 * Get a DTO for the related model
	 *
	 * @param int $id
	 *
	 * @return CommentDto|bool
	 * @since 1.0.0
	 */
	public function get( int $id );

	/**
	 * Get a list of DTOs for the related model
	 *
	 * @param array $args
	 *
	 * @return array
	 * @since 1.0.0
	 */
	public function getList( array $args ): array;
}
