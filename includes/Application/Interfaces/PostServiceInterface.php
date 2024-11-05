<?php
/**
 * Post Service Interface
 *
 * This interface defines the methods that should be implemented by the Post Service
 *
 * @package PluginName
 * @subpackage PluginName\Application\Interfaces
 * @since 1.0.0
 */

namespace PluginName\Application\Interfaces;

defined( 'ABSPATH' ) || exit;

interface PostServiceInterface {
	/**
	 * @template TModel
	 *
	 * Create a new model (Post, Page, Custom Post Type)
	 *
	 * @param array $args
	 *
	 * @psalm-return TModel|bool
	 * @return object|bool
	 * @since 1.0.0
	 */
	public function create( array $args );

	/**
	 * @template TModel
	 *
	 * Update a model (Post, Page, Custom Post Type)
	 *
	 * @param array $args
	 *
	 * @psalm-return TModel|bool
	 * @return object|bool
	 * @since 1.0.0
	 */
	public function update( array $args );

	/**
	 * Delete a model (Post, Page, Custom Post Type)
	 *
	 * @param int $id
	 * @param bool $forceDelete
	 *
	 * @return bool
	 * @since 1.0.0
	 */
	public function delete( int $id, bool $forceDelete = false ): bool;

	/**
	 * @template TModel
	 *
	 * Get a model (Post, Page, Custom Post Type)
	 *
	 * @param int $id
	 *
	 * @psalm-return TModel|bool
	 * @return bool|object
	 * @since 1.0.0
	 */
	public function get( int $id );

	/**
	 * @template TModel
	 *
	 * Get a list of models (Posts, Pages, Custom Post Types)
	 *
	 * @param array $args
	 *
	 * @psalm-return TModel[]|bool
	 * @return object[]|bool
	 * @since 1.0.0
	 */
	public function getList( array $args );
}
