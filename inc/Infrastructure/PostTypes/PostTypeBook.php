<?php

namespace PluginName\Infrastructure\PostTypes;

use PluginName\Common\Services\PostTypeBuilder;

defined( 'ABSPATH' ) || exit;

class PostTypeBook extends PostTypeBuilder {

	public static string $slug = 'book';

	public function __construct() {
		parent::__construct( self::$slug );

		$this->setPublic( true )
		     ->setHierarchical( false )
		     ->setSupports( [ 'title', 'editor', 'thumbnail' ] )
		     ->setMenuIcon( 'dashicons-book-alt' )
		     ->setRewrite( 'books' )
		     ->setLabel( 'name', 'Books' )
		     ->setLabel( 'singular_name', 'Book' )
		     ->setLabel( 'add_new', 'Add New Book' )
		     ->setLabel( 'add_new_item', 'Add New Book' )
		     ->setLabel( 'edit_item', 'Edit Book' )
		     ->setLabel( 'new_item', 'New Book' )
		     ->setLabel( 'view_item', 'View Book' )
		     ->setLabel( 'search_items', 'Search Books' )
		     ->setLabel( 'not_found', 'No books found' )
		     ->setLabel( 'not_found_in_trash', 'No books found in Trash' )
		     ->setArgument( 'show_in_rest', true );
	}
}
