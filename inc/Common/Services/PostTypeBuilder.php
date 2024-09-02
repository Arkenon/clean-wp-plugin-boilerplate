<?php

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
	 * @param string $key
	 * @param mixed $value
	 *
	 * @return $this
	 */
	public function setArgument( string $key, $value ): self {
		$this->args[ $key ] = $value;

		return $this;
	}

	public function setLabel( string $key, string $value ): self {
		$this->labels[ $key ] = $value;

		return $this;
	}

	public function setPublic( bool $is_public ): self {
		return $this->setArgument( 'public', $is_public );
	}

	public function setHierarchical( bool $is_hierarchical ): self {
		return $this->setArgument( 'hierarchical', $is_hierarchical );
	}

	public function setSupports( array $supports ): self {
		return $this->setArgument( 'supports', $supports );
	}

	public function setMenuIcon( string $icon ): self {
		return $this->setArgument( 'menu_icon', $icon );
	}

	public function setRewrite( ?string $slug = null ): self {
		if ( $slug === null ) {
			$slug = $this->post_type;
		}

		return $this->setArgument( 'rewrite', [ 'slug' => $slug ] );
	}

	public function register(): void {
		if ( ! empty( $this->labels ) ) {
			$this->args['labels'] = $this->labels;
		}

		if ( ! post_type_exists( $this->post_type ) ) {
			register_post_type( $this->post_type, $this->args );
			flush_rewrite_rules();
		}
	}
}
