<?php

namespace PluginName\Domain\Entities;

defined('ABSPATH') || exit;

class Post
{
	public int $ID;

	public ?int $post_author;

	public ?string $post_date;

	public ?string $post_content;

	public ?string $post_title;

	public ?string $post_excerpt;

	public ?string $post_status;

	public ?string $comment_status;

	public ?string $ping_status;

	public ?string $post_password;

	public ?string $post_name;

	public ?string $to_ping;

	public ?string $pinged;

	public ?string $post_modified;

	public ?string $post_content_filtered;

	public ?int $post_parent;

	public ?string $guid;

	public ?int $menu_order;

	public ?string $post_type;

	public ?string $post_mime_type;

	public ?int $comment_count;

}
