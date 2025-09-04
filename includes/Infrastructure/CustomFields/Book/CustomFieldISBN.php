<?php
/**
 * Custom Fields for Post Type Book
 * @package PluginName
 * @subpackage PluginName\Infrastructure\CustomFields\Book
 * @since 1.0.0
 */

namespace PluginName\Infrastructure\CustomFields\Book;

defined( 'ABSPATH' ) || exit;

use PluginName\Common\Helpers\Helper;
use PluginName\Common\Tools\CustomFieldBuilder;
use PluginName\Infrastructure\PostTypes\PostTypeBook;

class CustomFieldISBN extends CustomFieldBuilder {
	private Helper $helper;
	public static string $meta_key_ = 'plugin_name_book_isbn';

	public function __construct( Helper $helper ) {
		parent::__construct( self::$meta_key_ );

		$this->helper = $helper;

		$this->setTitle( esc_html__( 'Book ISBN', 'plugin-name' ) )
		     ->setScreen( [ PostTypeBook::$slug ] )
		     ->setContext( 'side' )
		     ->setPriority( 'high' );
	}

	public function renderCallback( $post, $args ): void {
		wp_nonce_field( $this->meta_key . '_nonce', $this->meta_key . '_nonce' );
		$value        = get_post_meta( $post->ID, $this->meta_key, true );
		$html         = '<label for="' . $this->meta_key . '">' . esc_html__( 'ISBN', 'plugin-name' ) . ':</label> ';
		$html         .= '<input type="text" id="' . $this->meta_key . '" name="' . $this->meta_key . '" value="' . esc_attr( $value ) . '">';
		$allowed_html = [
			'input' => [
				'type'  => [],
				'id'    => [],
				'name'  => [],
				'value' => []
			],
			'label' => [
				'for' => []
			]
		];

		echo wp_kses( $html, $allowed_html );
	}

	public function saveMetaBox( int $post_id ): void {
		if ( ! $this->verifyNonce() || ! $this->canSaveData() ) {
			return;
		}

		$isbn = $this->helper->sanitize( $this->meta_key, 'post', 'text' );

		if ( isset( $isbn ) ) {
			update_post_meta( $post_id, $this->meta_key, $isbn );
		}
	}
}
