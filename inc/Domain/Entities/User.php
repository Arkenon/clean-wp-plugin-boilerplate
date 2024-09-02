<?php

namespace PluginName\Domain\Entities;

defined('ABSPATH') || exit;

class User
{
	public int $ID;

	public ?string $user_login;

	public ?string $user_pass;

	public ?string $user_nicename;

	public ?string $user_email;

	public ?string $user_url;

	public ?string $user_registered;

	public ?string $user_activation_key;

	public ?string $user_status;

	public ?string $display_name;

	public ?string $nickname;

	public ?string $user_description;

	public ?string $first_name;

	public ?string $last_name;

	public ?int $user_level;

	public ?array $caps;

	public ?string $cap_key;

	public ?array $roles;

	public ?array $allcaps;
}
