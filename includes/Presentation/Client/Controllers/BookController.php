<?php
/**
 * Controller for Book post type
 * Include all the actions related to Book post type such as AJAX actions, REST API actions, etc.
 * @package PluginName
 * @subpackage Presentation\Client\Controllers
 * @since 1.0.0
 */

namespace PluginName\Presentation\Client\Controllers;

use PluginName\Application\Interfaces\BookServiceInterface;
use PluginName\Common\Helpers\Helper;

defined( 'ABSPATH' ) || exit;

final class BookController {
	private BookServiceInterface $book_service;

	public function __construct( BookServiceInterface $book_service ) {
		add_action( 'wp_ajax_plugin_name_get_book_by_isbn', [ $this, 'getBookByIsbn' ] );
		add_action( 'wp_ajax_nopriv_plugin_name_get_book_by_isbn', [ $this, 'getBookByIsbn' ] );
		$this->book_service = $book_service;
	}

	/**
	 * Get Book by ISBN by AJAX action
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function getBookByIsbn() {
		// Check the nonce for security
		check_ajax_referer( 'plugin-name-nonce' );

		// Sanitize the ISBN
		$isbn = Helper::sanitize( 'isbn', 'post' );

		// Get the book by ISBN from Book Service
		$book = $this->book_service->getByIsbn( $isbn );

		if ( null === $book ) {
			// Return error if book not found
			wp_send_json_error( esc_html__( 'Book not found', 'plugin-name' ) );
		}

		// Return the BookDto in JSON format
		wp_send_json( $book );
	}
}
