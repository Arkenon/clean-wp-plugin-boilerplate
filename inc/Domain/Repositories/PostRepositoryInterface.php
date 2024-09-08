<?php

namespace PluginName\Domain\Repositories;

defined( 'ABSPATH' ) || exit;

use PluginName\Domain\Entities\Post;

interface PostRepositoryInterface {
	/**
	 * Create a new model
	 *
	 * @param array $args
	 *
	 * @return Post|bool
	 * @since 1.0.0
	 */
	public function create( array $args );

	/**
	 * Update a model
	 *
	 * @param array $args
	 *
	 * @return Post|bool
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
	 * @return Post|bool
	 * @since 1.0.0
	 */
	public function get( int $id );

	/**
	 * Get a list of models
	 *
	 * @param array $args
	 *
	 * @return array
	 * @since 1.0.0
	 */
	public function getList( array $args ): array;
}
