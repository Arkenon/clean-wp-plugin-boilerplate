<?php

namespace PluginName\Application\Interfaces;

defined( 'ABSPATH' ) || exit;

use PluginName\Application\DTOs\Comment\CommentDto;

interface CommentServiceInterface {
	/**
	 * @param array $args
	 *
	 * @return CommentDto|bool
	 */
	public function create( array $args );

	/**
	 * @param array $args
	 *
	 * @return CommentDto|bool
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
	 * @return CommentDto|bool
	 */
	public function get( int $id );

	/**
	 * @param array $args
	 *
	 * @return array|bool
	 */
	public function getList( array $args );
}
