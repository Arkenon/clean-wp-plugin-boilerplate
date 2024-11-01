<?php
/**
 * Data Transfer Object for Post object.
 *
 * @package PluginName
 * @subpackage PluginName\Application\DTOs\Post
 * @since 1.0.0
 */

namespace PluginName\Application\DTOs\Post;

defined( 'ABSPATH' ) || exit;

class PostDto {
	public int $ID;
	public ?int $post_author;
	public ?string $post_date;
	public ?string $post_content;
	public ?string $post_title;
	public ?string $post_excerpt;
	public ?string $post_status;
}
