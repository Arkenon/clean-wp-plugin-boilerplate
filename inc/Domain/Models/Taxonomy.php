<?php

namespace PluginName\Domain\Models;

defined('ABSPATH') || exit;

class Taxonomy
{
	public int $term_id;

	public ?string $name;

	public ?string $slug;

	public ?string $term_group;

	public ?int $term_taxonomy_id;

	public ?string $taxonomy;

	public ?string $description;

	public ?int $parent;

	public ?int $count;

	public ?string $filter;
}
