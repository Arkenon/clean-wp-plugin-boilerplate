<?php

namespace PluginName\Application\Interfaces;

defined( 'ABSPATH' ) || exit;

use PluginName\Application\DTOs\Post\PostDto;

interface PostServiceInterface {
	/**
	 * @param array $args
	 *
	 * @return PostDto|bool
	 */
	public function create( array $args );

	/**
	 * @param array $args
	 *
	 * @return PostDto|bool
	 */
	public function update( array $args );

	/**
	 * @param int $id
	 * @param bool $forceDelete
	 *
	 * @return bool
	 */
	public function delete( int $id, bool $forceDelete = true ): bool;

	/**
	 * @param int $id
	 *
	 * @return PostDto|bool
	 */
	public function get( int $id );

	/**
	 * @param array $args
	 *
	 * @return array|bool
	 */
	public function getList( array $args );
}
