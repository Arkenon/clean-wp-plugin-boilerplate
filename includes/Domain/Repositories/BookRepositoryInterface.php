<?php
/**
 * Book repository interface for Book post type
 * Contains methods for CRUD operations on Book model
 * @package PluginName
 * @subpackage Domain\Repositories
 * @since 1.0.0
 */

namespace PluginName\Domain\Repositories;

use PluginName\Domain\Models\Book;

defined( 'ABSPATH' ) || exit;

interface BookRepositoryInterface extends PostRepositoryInterface {
	/**
	 * Get Book by ISBN
	 *
	 * @param string $isbn
	 *
	 * @return Book|null
	 * @since 1.0.0
	 */
	public function getByIsbn( string $isbn ): ?Book;
}
