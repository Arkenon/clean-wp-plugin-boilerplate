<?php

namespace PluginName\Presentation\Public\Controllers;

use PluginName\Application\DTOs\Taxonomy\TaxonomyDto;
use PluginName\Application\Interfaces\TaxonomyServiceInterface;

defined( 'ABSPATH' ) || exit;

class TaxonomyController {

	private TaxonomyServiceInterface $service;

	public function __construct( TaxonomyServiceInterface $service ) {
		$this->service = $service;
	}

	/**
	 * @return TaxonomyDto|bool
	 */
	public function create() {

		return $this->service->create( esc_html__( 'New Term', 'plugin-name' ), 'category' );
	}

	/**
	 * @return TaxonomyDto|bool
	 */
	public function update() {

		return $this->service->update( 5, 'category', [ 'name' => esc_html__( 'Updated Term Name', 'plugin-name' ) ] );
	}

	public function delete(): bool {

		return $this->service->delete( 5, 'category' );
	}

	/**
	 * @return bool|array
	 */
	public function getList() {
		$args = [
			'taxonomy' => 'category',

		];

		return $this->service->getList( $args );

	}
}
