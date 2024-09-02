<?php

namespace PluginName\Application\DTOs\Post;

defined('ABSPATH') || exit;

class PostDto
{
	public int $ID;

	public ?int $post_author;

	public ?string $post_date;

	public ?string $post_content;

	public ?string $post_title;

	public ?string $post_excerpt;

	public ?string $post_status;
}
