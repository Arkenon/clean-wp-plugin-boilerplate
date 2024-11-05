<?php
/**
 * Book repository for Book post type
 *
 * Implements the PostRepositoryInterface
 *
 * @since 1.0.0
 * @package PluginName
 * @subpackage Persistence\Repositories
 */

namespace PluginName\Persistence\Repositories;

defined( 'ABSPATH' ) || exit;

use PluginName\Common\Services\Mapper;
use PluginName\Domain\Models\Book;

use PluginName\Domain\Repositories\BookRepositoryInterface;
use PluginName\Infrastructure\PostTypes\PostTypeBook;
use ReflectionException;
use WP_Query;

class BookRepository extends PostRepository implements BookRepositoryInterface {
	protected Mapper $mapper;
	protected string $model; //Model for custom post types. Default is Post.

	public function __construct( Mapper $mapper, string $model = Book::class ) {
		parent::__construct( $mapper, $model );
		$this->mapper = $mapper;
		$this->model  = $model;
	}

	/**
	 * Get Book by ISBN
	 *
	 * @param string $isbn
	 *
	 * @return Book|null
	 * @throws ReflectionException
	 * @since 1.0.0
	 */
	public function getByIsbn( string $isbn ): ?Book {
		$args = [
			'post_type'      => PostTypeBook::$slug,
			'posts_per_page' => 1, // Get only one post
			'meta_query'     => [
				[
					'key'     => 'plugin_name_book_isbn',
					'value'   => $isbn,
					'compare' => '='
				]
			]
		];

		$book = $this->getList( $args )[0] ?? null;

		if ( $book !== null ) {
			$get_isbn   = get_post_meta( $book->ID, 'plugin_name_book_isbn', true );
			$book->isbn = $get_isbn;
		}

		return $book;
	}
}
