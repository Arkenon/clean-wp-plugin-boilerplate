<?php
/**
 * Taxonomy repository
 *
 * Implements the TaxonomyRepositoryInterface
 *
 * @since 1.0.0
 * @package PluginName
 * @subpackage Persistence\Repositories
 */

namespace PluginName\Persistence\Repositories;

defined( 'ABSPATH' ) || exit;

use PluginName\Common\Services\Mapper;
use PluginName\Domain\Models\Taxonomy;
use PluginName\Domain\Repositories\TaxonomyRepositoryInterface;
use ReflectionException;
use WP_Term;

class TaxonomyRepository implements TaxonomyRepositoryInterface {
	private Mapper $mapper;
	private string $model; //Model for custom taxonomies. Default is Taxonomy.

	public function __construct( Mapper $mapper, string $model = Taxonomy::class ) {
		$this->mapper = $mapper;
		$this->model  = $model;
	}

	/**
	 * @template TModel
	 *
	 * Create a new model (Taxonomy, Custom Taxonomy)
	 *
	 * @param string $term
	 * @param string $taxonomy
	 * @param array $args
	 *
	 * @psalm-return TModel|bool
	 * @return object|bool
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
	 * Delete a model (Taxonomy, Custom Taxonomy)
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
	 * @template TModel
	 *
	 * Get a model (Taxonomy, Custom Taxonomy)
	 *
	 * @param int $id
	 * @param string $taxonomy
	 *
	 * @psalm-return TModel|bool
	 * @return object|bool
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

		return $this->mapper->mapObjectToObject( $term, $this->model );
	}

	/**
	 * @template TModel
	 *
	 * Get a list of models (Taxonomies, Custom Taxonomies)
	 *
	 * @param array $args
	 *
	 * @psalm-return TModel[]|bool
	 * @return object[]|bool
	 * @throws ReflectionException
	 * @since 1.0.0
	 */
	public function getList( array $args ) {
		$terms = get_terms( $args );

		$termList = [];
		if ( ! is_wp_error( $terms ) ) {

			if ( is_array( $terms ) ) {
				$firstTerm = reset( $terms );
				if ( $firstTerm instanceof WP_Term ) {
					foreach ( $terms as $term ) {
						$mappedTerm = $this->mapper->mapObjectToObject( $term, $this->model );
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
