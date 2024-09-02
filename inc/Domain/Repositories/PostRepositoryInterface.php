<?php

namespace PluginName\Domain\Repositories;

defined( 'ABSPATH' ) || exit;

use PluginName\Domain\Entities\Post;

interface PostRepositoryInterface {
	/**
	 * @param array $args
	 *
	 * @return Post|bool
	 */
	public function create( array $args );

	/**
	 * @param array $args
	 *
	 * @return Post|bool
	 */
	public function update( array $args );

	/**
	 * @param int $id
	 * @param bool $forceDelete
	 *
	 * @return bool
	 */
	public function delete( int $id, bool $forceDelete = false ): bool;

	/**
	 * @param int $id
	 *
	 * @return Post|bool
	 */
	public function get( int $id );

	/**
	 * @param array $args
	 *
	 * @return array|bool
	 */
	public function getList( array $args );
}
