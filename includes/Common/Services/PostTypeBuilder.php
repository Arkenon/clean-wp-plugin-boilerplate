<?php
/**
 * PostTypeBuilder class
 * This class is responsible for creating post types.
 * @package PluginName
 * @subpackage PluginName\Common\Services
 * @since 1.0.0
 */

namespace PluginName\Common\Services;

defined( 'ABSPATH' ) || exit;

class PostTypeBuilder {
	private string $post_type;
	private array $args;
	private array $labels;

	public function __construct( string $post_type ) {
		$this->post_type = $post_type;
		$this->args      = [];
		$this->labels    = [];
	}

	/**
	 * Register the post type
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function register(): void {
		if ( ! empty( $this->labels ) ) {
			$this->args['labels'] = $this->labels;
		}

		if ( ! post_type_exists( $this->post_type ) ) {
			register_post_type( $this->post_type, $this->args );
			flush_rewrite_rules();
		}
	}

	/**
	 * Set the post type arguments
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
	 * Set the post type labels
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
