<?php

namespace PluginName\Infrastructure\CustomFields\Book;

defined( 'ABSPATH' ) || exit;

use PluginName\Common\Helpers\Helper;
use PluginName\Common\Services\CustomFieldBuilder;
use PluginName\Infrastructure\PostTypes\PostTypeBook;

class CustomFieldISBN extends CustomFieldBuilder {
	private Helper $helper;
	public static string $meta_key = 'book_isbn';

	public function __construct( Helper $helper ) {
		parent::__construct( self::$meta_key );

		$this->helper = $helper;

		$this->setTitle( 'Book ISBN' )
		     ->setScreen( [ PostTypeBook::$slug ] )
		     ->setContext( 'side' )
		     ->setPriority( 'high' );
	}

	public function renderCallback( $post, $args ): void {
		wp_nonce_field( $this->id . '_nonce', $this->id . '_nonce' );
		$value = get_post_meta( $post->ID, $this->id, true );
		echo '<label for="' . $this->id . '">' . esc_html__( 'ISBN', 'plugin-name' ) . ':</label> ';
		echo '<input type="text" id="' . $this->id . '" name="' . $this->id . '" value="' . esc_attr( $value ) . '">';
	}

	public function saveMetaBox( $post_id ): void {
		if ( ! $this->verifyNonce() || ! $this->canSaveData() ) {
			return;
		}

		$isbn = $this->helper->sanitize( $this->id, 'post', 'text' );

		if ( isset( $isbn ) ) {
			update_post_meta( $post_id, $this->id, $isbn );
		}
	}
}
