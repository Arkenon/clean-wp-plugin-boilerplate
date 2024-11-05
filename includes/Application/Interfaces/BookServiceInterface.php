<?php
/**
 * Book Service Interface for Book post type
 *
 * This interface defines the methods that should be implemented by the Book Service
 *
 * @package PluginName
 * @subpackage PluginName\Application\Interfaces
 * @since 1.0.0
 */

namespace PluginName\Application\Interfaces;

use PluginName\Application\DTOs\Post\BookDto;

defined( 'ABSPATH' ) || exit;

interface BookServiceInterface extends PostServiceInterface {
	/**
	 * Get Book by ISBN
	 *
	 * @param string $isbn
	 *
	 * @return BookDto|null
	 * @since 1.0.0
	 */
	public function getByIsbn( string $isbn ): ?BookDto;
}
