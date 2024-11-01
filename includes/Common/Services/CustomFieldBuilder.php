<?php

namespace PluginName\Common\Services;

defined( 'ABSPATH' ) || exit;

abstract class CustomFieldBuilder {
	protected string $meta_key;
	protected string $title;
	protected array $screen;
	protected string $context;
	protected string $priority;
	protected array $callback_args;

	public function __construct( string $meta_key ) {
		$this->meta_key      = $meta_key;
		$this->title         = '';
		$this->screen        = [ 'post' ];
		$this->context       = 'advanced';
		$this->priority      = 'default';
		$this->callback_args = [];
	}

	public function setTitle( string $title ): self {
		$this->title = $title;

		return $this;
	}

	public function setScreen( array $screen ): self {
		$this->screen = $screen;

		return $this;
	}

	public function setContext( string $context ): self {
		$this->context = $context;

		return $this;
	}

	public function setPriority( string $priority ): self {
		$this->priority = $priority;

		return $this;
	}

	public function setCallbackArgs( array $args ): self {
		$this->callback_args = $args;

		return $this;
	}

	public function register(): void {
		add_action( 'add_meta_boxes', [ $this, 'addMetaBox' ] );
		add_action( 'save_post', [ $this, 'saveMetaBox' ] );
	}

	public function addMetaBox(): void {
		foreach ( $this->screen as $screen ) {
			add_meta_box(
				$this->meta_key,
				$this->title,
				[ $this, 'renderCallback' ],
				$screen,
				$this->context,
				$this->priority,
				$this->callback_args
			);
		}
	}

	abstract public function renderCallback( $post, $args ): void;

	abstract public function saveMetaBox( $post_id ): void;

	protected function verifyNonce(): bool {
		$nonce = $this->meta_key . '_nonce';

		return isset( $_POST[ $nonce ] ) && wp_verify_nonce( $_POST[ $nonce ], $nonce );
	}

	protected function canSaveData(): bool {
		return ! defined( 'DOING_AUTOSAVE' ) || ! DOING_AUTOSAVE;
	}
}
