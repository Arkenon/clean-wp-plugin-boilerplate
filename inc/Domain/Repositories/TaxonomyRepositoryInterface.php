<?php

namespace PluginName\Domain\Repositories;

defined( 'ABSPATH' ) || exit;

use PluginName\Domain\Entities\Taxonomy;

interface TaxonomyRepositoryInterface {
	/**
	 * @param string $term
	 * @param string $taxonomy
	 * @param array $args
	 *
	 * @return Taxonomy|bool
	 */
	public function create( string $term, string $taxonomy, array $args = [] );

	/**
	 * @param int $term_id
	 * @param string $taxonomy
	 * @param array $args
	 *
	 * @return Taxonomy|bool
	 */
	public function update( int $term_id, string $taxonomy, array $args = [] );

	/**
	 * @param int $term_id
	 * @param string $taxonomy
	 * @param array $args
	 *
	 * @return bool
	 */
	public function delete( int $term_id, string $taxonomy, array $args = [] ): bool;

	/**
	 * @param int $id
	 * @param string $taxonomy
	 *
	 * @return Taxonomy|bool
	 */
	public function get( int $id, string $taxonomy = '' );

	/**
	 * @param array $args
	 *
	 * @return array|bool|string
	 */
	public function getList( array $args );
}
