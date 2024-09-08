<?php

namespace PluginName\Application\Services;

defined( 'ABSPATH' ) || exit;

use PluginName\Application\Interfaces\TaxonomyServiceInterface;
use PluginName\Application\DTOs\Taxonomy\TaxonomyDto;
use PluginName\Common\Services\Mapper;
use PluginName\Domain\Repositories\TaxonomyRepositoryInterface;
use ReflectionException;
use WP_Term;


class TaxonomyService implements TaxonomyServiceInterface {
	private TaxonomyRepositoryInterface $repository;
	private Mapper $mapper;

	public function __construct( TaxonomyRepositoryInterface $repository, Mapper $mapper ) {
		$this->repository = $repository;
		$this->mapper     = $mapper;
	}

	/**
	 * Create a new DTO for a related model
	 *
	 * @param string $term
	 * @param string $taxonomy
	 * @param array $args
	 *
	 * @return TaxonomyDto|bool
	 * @throws ReflectionException
	 * @since 1.0.0
	 */
	public function create( string $term, string $taxonomy, array $args = [] ) {
		$term_ = $this->repository->create( $term, $taxonomy, $args );

		if ( ! $term_ ) {
			return false;
		}

		return $this->mapper->mapObjectToObject( $term_, TaxonomyDto::class );
	}

	/**
	 * Update a DTO for a related model
	 *
	 * @param int $term_id
	 * @param string $taxonomy
	 * @param array $args
	 *
	 * @return TaxonomyDto|bool
	 * @throws ReflectionException
	 * @since 1.0.0
	 */
	public function update( int $term_id, string $taxonomy, array $args = [] ) {
		$term_ = $this->repository->update( $term_id, $taxonomy, $args );

		if ( ! $term_ ) {
			return false;
		}

		return $this->mapper->mapObjectToObject( $term_, TaxonomyDto::class );
	}

	public function delete( int $term_id, string $taxonomy, array $args = [] ): bool {
		return $this->repository->delete( $term_id, $taxonomy, $args );
	}

	/**
	 * @param int $id
	 * @param string $taxonomy
	 *
	 * @return TaxonomyDto|bool
	 * @throws ReflectionException
	 */
	public function get( int $id, string $taxonomy = '' ) {
		$term_ = $this->repository->get( $id, $taxonomy );

		if ( ! $term_ ) {
			return false;
		}

		return $this->mapper->mapObjectToObject( $term_, TaxonomyDto::class );
	}

	/**
	 * Get a list of DTOs for a related model
	 *
	 * @param array $args
	 *
	 * @return array|bool
	 * @throws ReflectionException
	 * @since 1.0.0
	 */
	public function getList( array $args ): array {
		$terms = $this->repository->getList( $args );

		if ( ! $terms ) {
			return false;
		}

		$termList  = [];
		$firstTerm = reset( $terms );
		if ( $firstTerm instanceof WP_Term ) {
			foreach ( $terms as $term ) {
				$mappedTerm = $this->mapper->mapObjectToObject( $term, TaxonomyDto::class );
				$termList[] = $mappedTerm;
			}

			return $termList;
		}

		return $terms;
	}
}
