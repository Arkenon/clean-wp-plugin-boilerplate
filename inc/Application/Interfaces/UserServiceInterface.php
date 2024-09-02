<?php

namespace PluginName\Application\Interfaces;

defined( 'ABSPATH' ) || exit;

use PluginName\Application\DTOs\User\UserDto;

interface UserServiceInterface {
	/**
	 * @param array $args
	 *
	 * @return UserDto|bool
	 */
	public function create( array $args );

	/**
	 * @param array $args
	 *
	 * @return UserDto|bool
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
	 * @return UserDto|bool
	 */
	public function get( int $id );

	/**
	 * @param array $args
	 *
	 * @return array|bool
	 */
	public function getList( array $args );
}
