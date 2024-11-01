<?php
/**
 * Data Transfer Object for Comment object.
 *
 * @package PluginName
 * @subpackage PluginName\Application\DTOs\Comment
 * @since 1.0.0
 */

namespace PluginName\Application\DTOs\Comment;

defined( 'ABSPATH' ) || exit;

class CommentDto {
	public int $comment_ID;
	public ?int $comment_post_ID;
	public ?string $comment_author;
	public ?string $comment_author_email;
	public ?string $comment_author_url;
	public ?string $comment_author_IP;
	public ?string $comment_date;
	public ?string $comment_content;
	public ?string $comment_approved;
	public ?string $comment_agent;
	public ?string $comment_type;
	public ?int $comment_parent;
	public ?int $user_id;
	public ?string $avatar_url;
}
