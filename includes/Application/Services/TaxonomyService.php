<?php
/**
 * Taxonomy Service
 *
 * This class implements the Taxonomy Service Interface and includes methods to interact with the Taxonomy Repository
 *
 * @package PluginName
 * @subpackage PluginName\Application\Services
 * @since 1.0.0
 */

namespace PluginName\Application\Services;

defined( 'ABSPATH' ) || exit;

use PluginName\Application\Interfaces\TaxonomyServiceInterface;
use PluginName\Application\DTOs\Taxonomy\TaxonomyDto;
use PluginName\Common\Tools\Mapper;
use PluginName\Domain\Repositories\TaxonomyRepositoryInterface;
use ReflectionException;
use WP_Term;

class TaxonomyService implements TaxonomyServiceInterface {
	private TaxonomyRepositoryInterface $repository;
	private Mapper $mapper;
	private string $model;

	public function __construct( TaxonomyRepositoryInterface $repository, Mapper $mapper, string $model = TaxonomyDto::class ) {
		$this->repository = $repository;
		$this->mapper     = $mapper;
		$this->model      = $model;
	}

	/**
	 * @template TModel
	 *
	 * Create a new DTO for a related model (Taxonomies, Custom Taxonomies)
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
		$term_ = $this->repository->create( $term, $taxonomy, $args );

		if ( ! $term_ ) {
			return false;
		}

		return $this->mapper->mapObjectToObject( $term_, $this->model );
	}

	/**
	 * @template TModel
	 *
	 * Update a DTO for a related model (Taxonomies, Custom Taxonomies)
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
		$term_ = $this->repository->update( $term_id, $taxonomy, $args );

		if ( ! $term_ ) {
			return false;
		}

		return $this->mapper->mapObjectToObject( $term_, $this->model );
	}

	/**
	 * Delete the related model (Taxonomies, Custom Taxonomies)
	 *
	 * @param int $term_id
	 * @param string $taxonomy
	 * @param array $args
	 *
	 * @return bool
	 * @since 1.0.0
	 */
	public function delete( int $term_id, string $taxonomy, array $args = [] ): bool {
		return $this->repository->delete( $term_id, $taxonomy, $args );
	}

	/**
	 * @template TModel
	 *
	 * Get a DTO for a related model (Taxonomies, Custom Taxonomies)
	 *
	 * @param int $id
	 * @param string $taxonomy
	 *
	 * @psalm-return TModel|bool
	 * @return object|bool
	 * @throws ReflectionException
	 */
	public function get( int $id, string $taxonomy = '' ) {
		$term_ = $this->repository->get( $id, $taxonomy );

		if ( ! $term_ ) {
			return false;
		}

		return $this->mapper->mapObjectToObject( $term_, $this->model );
	}

	/**
	 * @template TModel
	 *
	 * Get a list of DTOs for a related model (Taxonomies, Custom Taxonomies)
	 *
	 * @param array $args
	 *
	 * @psalm-return TModel[]|bool
	 * @return object[]|bool
	 * @throws ReflectionException
	 * @since 1.0.0
	 */
	public function getList( array $args ) {
		$terms = $this->repository->getList( $args );

		if ( ! $terms ) {
			return false;
		}

		$termList  = [];
		$firstTerm = reset( $terms );
		if ( $firstTerm instanceof WP_Term ) {
			foreach ( $terms as $term ) {
				$mappedTerm = $this->mapper->mapObjectToObject( $term, $this->model );
				$termList[] = $mappedTerm;
			}

			return $termList;
		}

		return $terms;
	}
}
