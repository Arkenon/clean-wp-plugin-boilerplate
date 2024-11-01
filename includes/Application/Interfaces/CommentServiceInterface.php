<?php
/**
 * Comment Service Interface
 *
 * This interface defines the methods that should be implemented by the Comment Service
 *
 * @package PluginName
 * @subpackage PluginName\Application\Interfaces
 * @since 1.0.0
 */

namespace PluginName\Application\Interfaces;

defined( 'ABSPATH' ) || exit;

interface CommentServiceInterface {
	/**
	 * Create a new model
	 *
	 * @param array $args
	 *
	 * @return object|bool
	 * @since 1.0.0
	 */
	public function create( array $args );

	/**
	 * Update a model
	 *
	 * @param array $args
	 *
	 * @return object|bool
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
	 * @return object|bool
	 * @since 1.0.0
	 */
	public function get( int $id );

	/**
	 * Get a list of models
	 *
	 * @param array $args
	 *
	 * @return object[]|bool
	 * @since 1.0.0
	 */
	public function getList( array $args );
}
