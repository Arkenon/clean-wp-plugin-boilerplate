<?php

namespace PluginName\Domain\Repositories;

defined( 'ABSPATH' ) || exit;

use PluginName\Domain\Entities\Taxonomy;

interface TaxonomyRepositoryInterface {
	/**
	 * Create a new model
	 *
	 * @param string $term
	 * @param string $taxonomy
	 * @param array $args
	 *
	 * @return Taxonomy|bool
	 * @since 1.0.0
	 */
	public function create( string $term, string $taxonomy, array $args = [] );

	/**
	 * Update a model
	 *
	 * @param int $term_id
	 * @param string $taxonomy
	 * @param array $args
	 *
	 * @return Taxonomy|bool
	 * @since 1.0.0
	 */
	public function update( int $term_id, string $taxonomy, array $args = [] );

	/**
	 * Delete a model
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
	 * Get a model
	 *
	 * @param int $id
	 * @param string $taxonomy
	 *
	 * @return Taxonomy|bool
	 * @since 1.0.0
	 */
	public function get( int $id, string $taxonomy = '' );

	/**
	 * Get a list of models
	 *
	 * @param array $args
	 *
	 * @return array
	 * @since 1.0.0
	 */
	public function getList( array $args ): array;
}
