<?php

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

	public function setShowUi( bool $show_ui ): self {
		return $this->setArgument( 'show_ui', $show_ui );
	}

	public function setShowInMenu( bool $show_in_menu ): self {
		return $this->setArgument( 'show_in_menu', $show_in_menu );
	}

	public function setShowInQuickEdit( bool $show_in_quick_edit ): self {
		return $this->setArgument( 'show_in_quick_edit', $show_in_quick_edit );
	}

	public function setShowTagcloud( bool $show_tagcloud ): self {
		return $this->setArgument( 'show_tagcloud', $show_tagcloud );
	}

	public function setShowInRestApi( bool $show_in_rest ): self {
		return $this->setArgument( 'show_in_rest', $show_in_rest );
	}

	public function setRewrite( ?array $rewrite = null ): self {
		if ( $rewrite === null ) {
			$rewrite = [ 'slug' => $this->taxonomy ];
		}

		return $this->setArgument( 'rewrite', $rewrite );
	}

	public function register(): void {
		if ( ! empty( $this->labels ) ) {
			$this->args['labels'] = $this->labels;
		}

		if ( ! taxonomy_exists( $this->taxonomy ) ) {
			register_taxonomy( $this->taxonomy, $this->object_type, $this->args );
		}
	}
}
