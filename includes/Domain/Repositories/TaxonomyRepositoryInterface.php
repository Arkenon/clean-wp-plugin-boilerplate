<?php
/**
 * Taxonomy repository interface
 * Contains methods for CRUD operations on Taxonomy model
 * @package PluginName
 * @subpackage Domain\Repositories
 * @since 1.0.0
 */

namespace PluginName\Domain\Repositories;

defined( 'ABSPATH' ) || exit;

interface TaxonomyRepositoryInterface {
	/**
	 * @template TModel
	 *
	 * Create a new model (Taxonomy, Custom Taxonomy)
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
	 * @template TModel
	 *
	 * Update a model (Taxonomy, Custom Taxonomy)
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
	 * Delete a model (Taxonomy, Custom Taxonomy)
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
	 * Get a model (Taxonomy, Custom Taxonomy)
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
	 * Get a list of models (Taxonomies, Custom Taxonomies)
	 *
	 * @param array $args
	 *
	 * @psalm-return TModel[]|bool
	 * @return object[]|bool
	 * @since 1.0.0
	 */
	public function getList( array $args );
}
