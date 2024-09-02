<?php

namespace PluginName\Domain\Repositories;

defined( 'ABSPATH' ) || exit;

use PluginName\Domain\Entities\Comment;

interface CommentRepositoryInterface {
	/**
	 * @param array $args
	 *
	 * @return Comment|bool
	 */
	public function create( array $args );

	/**
	 * @param array $args
	 *
	 * @return Comment|bool
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
	 * @return Comment|bool
	 */
	public function get( int $id );

	/**
	 * @param array $args
	 *
	 * @return array|bool
	 */
	public function getList( array $args );
}
