<?php

namespace PluginName\Application\DTOs\Taxonomy;

defined('ABSPATH') || exit;

class TaxonomyDto
{
	public int $term_id;

	public ?string $name;

	public ?string $slug;

	public ?string $description;

	public ?int $parent;

	public ?int $count;
}
