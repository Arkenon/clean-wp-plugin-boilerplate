<?php
/**
 * TaxonomyBuilder class
 * This class is responsible for creating taxonomies.
 * @package PluginName
 * @subpackage PluginName\Common\Services
 * @since 1.0.0
 */

namespace PluginName\Common\Services;

defined( 'ABSPATH' ) || exit;

class TaxonomyBuilder {
	private string $taxonomy;
	private array $object_type;
	private array $args;
	private array $labels;

	public function __construct( string $taxonomy, array $object_type ) {
		$this->taxonomy    = $taxonomy;
		$this->object_type = $object_type;
		$this->args        = [];
		$this->labels      = [];
	}

	/**
	 * Register the taxonomy
	 * @return void
	 * @since 1.0.0
	 */
	public function register(): void {
		if ( ! empty( $this->labels ) ) {
			$this->args['labels'] = $this->labels;
		}

		if ( ! taxonomy_exists( $this->taxonomy ) ) {
			register_taxonomy( $this->taxonomy, $this->object_type, $this->args );
		}
	}

	/**
	 * Set the taxonomy arguments
	 *
	 * @param array $args
	 *
	 * @return $this
	 * @since 1.0.0
	 */
	public function setArguments( array $args ): self {
		$this->args = $args;

		return $this;
	}

	/**
	 * Set the taxonomy labels
	 *
	 * @param array $labels
	 *
	 * @return $this
	 * @since 1.0.0
	 */
	public function setLabels( array $labels ): self {
		$this->labels = $labels;

		return $this;
	}
}
