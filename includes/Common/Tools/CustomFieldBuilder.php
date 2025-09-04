<?php
/**
 * Custom Field Builder class
 * This class is responsible for creating custom fields in the WordPress admin area.
 * @package PluginName
 * @subpackage PluginName\Common\Tools
 * @since 1.0.0
 */

namespace PluginName\Common\Tools;

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

	/**
	 * Register the meta box.
	 * @return void
	 * @since 1.0.0
	 */
	public function register(): void {
		add_action( 'add_meta_boxes', [ $this, 'addMetaBox' ] );
		add_action( 'save_post', [ $this, 'saveMetaBox' ] );
	}

	/**
	 * Set the title of the meta box.
	 *
	 * @param string $title
	 *
	 * @return $this
	 * @since 1.0.0
	 */
	public function setTitle( string $title ): self {
		$this->title = $title;

		return $this;
	}

	/**
	 * Set the screen(s) on which the meta box will be shown.
	 *
	 * @param array $screen
	 *
	 * @return $this
	 * @since 1.0.0
	 */
	public function setScreen( array $screen ): self {
		$this->screen = $screen;

		return $this;
	}

	/**
	 * Set the context within the screen where the boxes should display.
	 *
	 * @param string $context
	 *
	 * @return $this
	 * @since 1.0.0
	 */
	public function setContext( string $context ): self {
		$this->context = $context;

		return $this;
	}

	/**
	 * Set the priority within the context where the boxes should display.
	 *
	 * @param string $priority
	 *
	 * @return $this
	 * @since 1.0.0
	 */
	public function setPriority( string $priority ): self {
		$this->priority = $priority;

		return $this;
	}

	/**
	 * Set the arguments to pass into the callback function.
	 *
	 * @param array $args
	 *
	 * @return $this
	 * @since 1.0.0
	 */
	public function setCallbackArgs( array $args ): self {
		$this->callback_args = $args;

		return $this;
	}


	/**
	 * Add the meta box.
	 *
	 * @return void
	 * @since 1.0.0
	 */
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

	/**
	 * Abstract method to render the meta box.
	 *
	 * @param $post
	 * @param $args
	 *
	 * @return void
	 * @since 1.0.0
	 */
	abstract public function renderCallback( $post, $args ): void;

	/**
	 * Abstract method to save the meta box.
	 *
	 * @param int $post_id
	 *
	 * @return void
	 * @since 1.0.0
	 */
	abstract public function saveMetaBox( int $post_id ): void;

	protected function verifyNonce(): bool {
		$nonce = $this->meta_key . '_nonce';

		return isset( $_POST[ $nonce ] ) && wp_verify_nonce( $_POST[ $nonce ], $nonce );
	}

	/**
	 * Check if the data can be saved.
	 * @return bool
	 * @since 1.0.0
	 */
	protected function canSaveData(): bool {
		return ! defined( 'DOING_AUTOSAVE' ) || ! DOING_AUTOSAVE;
	}
}
