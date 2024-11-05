<?php
/**
 * Book model for Book post type
 * Extends Post model
 * @package PluginName
 * @subpackage Domain\Models
 * @since 1.0.0
 */

namespace PluginName\Domain\Models;

defined( 'ABSPATH' ) || exit;

class Book extends Post {
	public ?string $isbn;
}
