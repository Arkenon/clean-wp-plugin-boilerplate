<?php

namespace PluginName\Domain\Repositories;

defined( 'ABSPATH' ) || exit;

use PluginName\Domain\Entities\User;

interface UserRepositoryInterface {
	/**
	 * @param array $args
	 *
	 * @return User|bool
	 */
	public function create( array $args );

	/**
	 * @param array $args
	 *
	 * @return User|bool
	 */
	public function update( array $args );

	/**
	 * @param int $id
	 * @param int|null $reAssing
	 *
	 * @return bool
	 */
	public function delete( int $id, int $reAssing = null ): bool;

	/**
	 * @param int $id
	 *
	 * @return User|bool
	 */
	public function get( int $id );

	/**
	 * @param array $args
	 *
	 * @return array|bool
	 */
	public function getList( array $args );
}
