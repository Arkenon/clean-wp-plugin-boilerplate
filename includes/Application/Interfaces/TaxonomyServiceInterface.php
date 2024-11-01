<?php
/**
 * Taxonomy Service Interface
 *
 * This interface defines the methods that should be implemented by the Taxonomy Service
 *
 * @package PluginName
 * @subpackage PluginName\Application\Interfaces
 * @since 1.0.0
 */

namespace PluginName\Application\Interfaces;

defined( 'ABSPATH' ) || exit;

interface TaxonomyServiceInterface {
	/**
	 * Create a new DTO for the related model
	 *
	 * @param string $term
	 * @param string $taxonomy
	 * @param array $args
	 *
	 * @return object|bool
	 * @since 1.0.0
	 */
	public function create( string $term, string $taxonomy, array $args = [] );

	/**
	 * Update a DTO for the related model
	 *
	 * @param int $term_id
	 * @param string $taxonomy
	 * @param array $args
	 *
	 * @return object|bool
	 * @since 1.0.0
	 */
	public function update( int $term_id, string $taxonomy, array $args = [] );

	/**
	 * Delete a DTO for the related model
	 *
	 * @param int $term_id
	 * @param string $taxonomy
	 * @param array $args
	 *
	 * @return bool
	 * @since 1.0.0
	 */
	public function delete( int $term_id, string $taxonomy, array $args = [] ): bool;

	/**
	 * Get a DTO for the related model
	 *
	 * @param int $id
	 * @param string $taxonomy
	 *
	 * @return object|bool
	 * @since 1.0.0
	 */
	public function get( int $id, string $taxonomy = '' );

	/**
	 * Get a list of DTOs for the related model
	 *
	 * @param array $args
	 *
	 * @return object[]|bool
	 * @since 1.0.0
	 */
	public function getList( array $args );
}
