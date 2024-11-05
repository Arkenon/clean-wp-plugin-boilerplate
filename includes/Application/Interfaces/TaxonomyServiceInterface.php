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
	 * @template TModel
	 *
	 * Create a new DTO for the related model (Taxonomy, Custom Taxonomy)
	 *
	 * @param string $term
	 * @param string $taxonomy
	 * @param array $args
	 *
	 * @psalm-return TModel|bool
	 * @return object|bool
	 * @since 1.0.0
	 */
	public function create( string $term, string $taxonomy, array $args = [] );

	/**
	 * @template TModel
	 *
	 * Update a DTO for the related model (Taxonomy, Custom Taxonomy)
	 *
	 * @param int $term_id
	 * @param string $taxonomy
	 * @param array $args
	 *
	 * @psalm-return TModel|bool
	 * @return object|bool
	 * @since 1.0.0
	 */
	public function update( int $term_id, string $taxonomy, array $args = [] );

	/**
	 * Delete a DTO for the related model (Taxonomy, Custom Taxonomy)
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
	 * @template TModel
	 *
	 * Get a DTO for the related model (Taxonomy, Custom Taxonomy)
	 *
	 * @param int $id
	 * @param string $taxonomy
	 *
	 * @psalm-return TModel|bool
	 * @return object|bool
	 * @since 1.0.0
	 */
	public function get( int $id, string $taxonomy = '' );

	/**
	 * @template TModel
	 *
	 * Get a list of DTOs for the related model (Taxonomies, Custom Taxonomies)
	 *
	 * @param array $args
	 *
	 * @psalm-return TModel[]|bool
	 * @return object[]|bool
	 * @since 1.0.0
	 */
	public function getList( array $args );
}
