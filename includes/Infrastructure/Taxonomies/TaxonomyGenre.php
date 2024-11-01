<?php
/**
 * Register Genre Category taxonomy
 * @package PluginName
 * @subpackage Infrastructure\Taxonomies
 * @since 1.0.0
 */

namespace PluginName\Infrastructure\Taxonomies;

use PluginName\Common\Services\TaxonomyBuilder;
use PluginName\Infrastructure\PostTypes\PostTypeBook;

defined( 'ABSPATH' ) || exit;

class TaxonomyGenre extends TaxonomyBuilder {
	public static string $slug = 'genre';

	public function __construct() {
		parent::__construct( self::$slug, [ PostTypeBook::$slug ] );

		$labels = [
			'name'              => esc_html__( 'Genre', 'plugin-name' ),
			'singular_name'     => esc_html__( 'Genre', 'plugin-name' ),
			'search_items'      => esc_html__( 'Search Genre', 'plugin-name' ),
			'all_items'         => esc_html__( 'All Genres', 'plugin-name' ),
			'parent_item'       => esc_html__( 'Parent Genre', 'plugin-name' ),
			'parent_item_colon' => esc_html__( 'Parent Genre:', 'plugin-name' ),
			'edit_item'         => esc_html__( 'Edit Genre', 'plugin-name' ),
			'update_item'       => esc_html__( 'Update Genre', 'plugin-name' ),
			'add_new_item'      => esc_html__( 'Add New Genre', 'plugin-name' ),
			'new_item_name'     => esc_html__( 'New Genre Name', 'plugin-name' ),
			'menu_name'         => esc_html__( 'Genre', 'plugin-name' ),
		];

		$args = [
			'hierarchical'      => true,
			'public'            => true,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => [ 'slug' => self::$slug ],
		];

		$this->setLabels( $labels )
		     ->setArguments( $args );
	}
}
