<?php
/**
 * Data Transfer Object for Taxonomy object.
 *
 * @package PluginName
 * @subpackage PluginName\Application\DTOs\Taxonomy
 * @since 1.0.0
 */

namespace PluginName\Application\DTOs\Taxonomy;

defined( 'ABSPATH' ) || exit;

class TaxonomyDto {
	public int $term_id;
	public ?string $name;
	public ?string $slug;
	public ?string $description;
	public ?int $parent;
	public ?int $count;
}
