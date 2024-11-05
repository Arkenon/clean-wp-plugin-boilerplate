<?php
/**
 * Data Transfer Object for Book post type.
 * Extends PostDto
 * @package PluginName
 * @subpackage PluginName\Application\DTOs\Post
 * @since 1.0.0
 */

namespace PluginName\Application\DTOs\Post;

defined( 'ABSPATH' ) || exit;

class BookDto extends PostDto {
	public ?string $isbn;
}
