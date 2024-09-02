<?php

namespace PluginName\Application\Interfaces;

defined( 'ABSPATH' ) || exit;

use PluginName\Application\DTOs\Taxonomy\TaxonomyDto;

interface TaxonomyServiceInterface {
	/**
	 * @param string $term
	 * @param string $taxonomy
	 * @param array $args
	 *
	 * @return TaxonomyDto|bool
	 */
	public function create( string $term, string $taxonomy, array $args = [] );

	/**
	 * @param int $term_id
	 * @param string $taxonomy
	 * @param array $args
	 *
	 * @return TaxonomyDto|bool
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
	 * @return TaxonomyDto|bool
	 */
	public function get( int $id, string $taxonomy = '' );

	/**
	 * @param array $args
	 *
	 * @return array|bool|string
	 */
	public function getList( array $args );
}
