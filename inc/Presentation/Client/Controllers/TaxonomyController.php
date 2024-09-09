<?php

namespace PluginName\Presentation\Client\Controllers;

use PluginName\Application\DTOs\Taxonomy\TaxonomyDto;
use PluginName\Application\Interfaces\TaxonomyServiceInterface;

defined( 'ABSPATH' ) || exit;

class TaxonomyController {

	private TaxonomyServiceInterface $service;

	public function __construct( TaxonomyServiceInterface $service ) {
		$this->service = $service;
	}

	/**
	 * Add new term
	 * @return TaxonomyDto|bool
	 * @since 1.0.0
	 */
	public function create() {
		return $this->service->create( esc_html__( 'New Term', 'plugin-name' ), 'category' );
	}

	/**
	 * Update term
	 *
	 * @return TaxonomyDto|bool
	 * @since 1.0.0
	 */
	public function update() {
		return $this->service->update( 5, 'category', [ 'name' => esc_html__( 'Updated Term Name', 'plugin-name' ) ] );
	}

	/**
	 * Get term by id
	 *
	 * @return TaxonomyDto|bool
	 * @since 1.0.0
	 */
	public function delete(): bool {

		return $this->service->delete( 5, 'category' );
	}

	/**
	 * Get term by id
	 *
	 * @return array
	 * @since 1.0.0
	 */
	public function getList(): array {
		$args = [
			'taxonomy' => 'category',

		];

		return $this->service->getList( $args );
	}
}
