<?php

namespace PluginName\Infrastructure\PostTypes;

use PluginName\Common\Services\PostTypeBuilder;

defined( 'ABSPATH' ) || exit;

class PostTypeBook extends PostTypeBuilder {

	public static string $slug = 'book';

	public function __construct() {
		parent::__construct( self::$slug );

		$labels = [
			'name'               => esc_html__( 'Book', 'plugin-name' ),
			'singular_name'      => esc_html__( 'Book', 'plugin-name' ),
			'menu_name'          => esc_html__( 'Book', 'plugin-name' ),
			'name_admin_bar'     => esc_html__( 'Book', 'plugin-name' ),
			'add_new'            => esc_html__( 'Add New', 'plugin-name' ),
			'add_new_item'       => esc_html__( 'Add New Book', 'plugin-name' ),
			'new_item'           => esc_html__( 'New Book', 'plugin-name' ),
			'edit_item'          => esc_html__( 'Edit Book', 'plugin-name' ),
			'view_item'          => esc_html__( 'View Book', 'plugin-name' ),
			'all_items'          => esc_html__( 'Books', 'plugin-name' ),
			'search_items'       => esc_html__( 'Search Book', 'plugin-name' ),
			'parent_item_colon'  => esc_html__( 'Parent Book:', 'plugin-name' ),
			'not_found'          => esc_html__( 'No book found.', 'plugin-name' ),
			'not_found_in_trash' => esc_html__( 'No book found in trash.', 'plugin-name' ),
		];

		$args = [
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'show_in_rest'       => true,
			'menu_icon'          => 'dashicons-book',
			'query_var'          => true,
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => true,
			'supports'           => [ 'title', 'author', 'editor', 'comments' ],
			'taxonomies'         => [],
		];

		$this->setLabels( $labels )
		     ->setArguments( $args );
	}
}
