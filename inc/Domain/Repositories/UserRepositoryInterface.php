<?php

namespace PluginName\Domain\Repositories;

defined( 'ABSPATH' ) || exit;

use PluginName\Domain\Entities\User;

interface UserRepositoryInterface {
	/**
	 * Create a new model
	 *
	 * @param array $args
	 *
	 * @return User|bool
	 * @since 1.0.0
	 */
	public function create( array $args );

	/**
	 * Update a model
	 *
	 * @param array $args
	 *
	 * @return User|bool
	 * @since 1.0.0
	 */
	public function update( array $args );

	/**
	 * Delete a model
	 *
	 * @param int $id
	 * @param int|null $reAssing
	 *
	 * @return bool
	 * @since 1.0.0
	 */
	public function delete( int $id, int $reAssing = null ): bool;

	/**
	 * Get a model
	 *
	 * @param int $id
	 *
	 * @return User|bool
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
