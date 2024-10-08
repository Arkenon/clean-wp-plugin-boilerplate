<?php

namespace PluginName\Persistence\Repositories;

defined( 'ABSPATH' ) || exit;

use PluginName\Common\Services\Mapper;
use PluginName\Domain\Entities\Taxonomy;
use PluginName\Domain\Repositories\TaxonomyRepositoryInterface;
use ReflectionException;
use WP_Term;

class TaxonomyRepository implements TaxonomyRepositoryInterface {
	private Mapper $mapper;

	public function __construct( Mapper $mapper ) {
		$this->mapper = $mapper;
	}

	/**
	 * Create a new model
	 *
	 * @param string $term
	 * @param string $taxonomy
	 * @param array $args
	 *
	 * @return Taxonomy|bool
	 * @throws ReflectionException
	 * @since 1.0.0
	 */
	public function create( string $term, string $taxonomy, array $args = [] ) {
		$created_term = wp_insert_term( $term, $taxonomy, $args );

		if ( is_wp_error( $created_term ) ) {
			return false;
		}

		return $this->get( $created_term['term_taxonomy_id'] );

	}

	/**
	 * Update a model
	 *
	 * @param int $term_id
	 * @param string $taxonomy
	 * @param array $args
	 *
	 * @return Taxonomy|bool
	 * @throws ReflectionException
	 * @since 1.0.0
	 */
	public function update( int $term_id, string $taxonomy, array $args = [] ) {
		$updated_term = wp_update_term( $term_id, $taxonomy, $args );

		if ( is_wp_error( $updated_term ) ) {
			return false;
		}

		return $this->get( $updated_term['term_taxonomy_id'] );
	}

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
	public function delete( int $term_id, string $taxonomy, array $args = [] ): bool {
		$delete = wp_delete_term( $term_id, $taxonomy, $args );

		if ( ! $delete || is_wp_error( $delete ) || $delete === 0 ) {
			return false;
		}

		return true;
	}

	/**
	 * Get a model
	 *
	 * @param int $id
	 * @param string $taxonomy
	 *
	 * @return Taxonomy|bool
	 * @throws ReflectionException
	 * @since 1.0.0
	 */
	public function get( int $id, string $taxonomy = '' ) {
		if ( ! empty( $taxonomy ) ) {
			$term = get_term_by( 'term_id', $id, $taxonomy );
		} else {
			$term = get_term_by( 'term_taxonomy_id', $id, $taxonomy );
		}

		if ( ! $term ) {
			return false;
		}

		return $this->mapper->mapObjectToObject( $term, Taxonomy::class );
	}

	/**
	 * Get a list of models
	 *
	 * @param array $args
	 *
	 * @return array|bool
	 * @throws ReflectionException
	 * @since 1.0.0
	 */
	public function getList( array $args ): array {
		$terms = get_terms( $args );

		$termList = [];
		if ( ! is_wp_error( $terms ) ) {

			if ( is_array( $terms ) ) {
				$firstTerm = reset( $terms );
				if ( $firstTerm instanceof WP_Term ) {
					foreach ( $terms as $term ) {
						$mappedTerm = $this->mapper->mapObjectToObject( $term, Taxonomy::class );
						$termList[] = $mappedTerm;
					}

					return $termList;
				}
			}

			return $terms;
		} else {
			return false;
		}
	}

}
