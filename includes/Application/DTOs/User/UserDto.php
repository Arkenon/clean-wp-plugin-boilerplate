<?php
/**
 * Data Transfer Object for User object.
 *
 * @package PluginName
 * @subpackage PluginName\Application\DTOs\User
 * @since 1.0.0
 */

namespace PluginName\Application\DTOs\User;

defined( 'ABSPATH' ) || exit;

class UserDto {
	public int $ID;
	public ?string $user_login;
	public ?string $user_nicename;
	public ?string $user_email;
	public ?string $user_status;
	public ?string $display_name;
	public ?string $nickname;
	public ?string $user_description;
	public ?string $first_name;
	public ?string $last_name;
}
