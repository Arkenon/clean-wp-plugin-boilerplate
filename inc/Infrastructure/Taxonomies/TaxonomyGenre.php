<?php

namespace PluginName\Infrastructure\Taxonomies;

use PluginName\Common\Services\TaxonomyBuilder;
use PluginName\Infrastructure\PostTypes\PostTypeBook;

defined( 'ABSPATH' ) || exit;

class TaxonomyGenre extends TaxonomyBuilder {
	public static string $slug = 'genre';

	public function __construct() {
		parent::__construct( self::$slug, [ PostTypeBook::$slug ] );

		$this->setPublic( true )
		     ->setHierarchical( true )
		     ->setShowUi( true )
		     ->setShowInMenu( true )
		     ->setShowInQuickEdit( true )
		     ->setShowTagcloud( true )
		     ->setShowInRestApi( true )
		     ->setRewrite( [ 'slug' => 'genres' ] )
		     ->setLabel( 'name', 'Genres' )
		     ->setLabel( 'singular_name', 'Genre' )
		     ->setLabel( 'search_items', 'Search Genres' )
		     ->setLabel( 'all_items', 'All Genres' )
		     ->setLabel( 'parent_item', 'Parent Genre' )
		     ->setLabel( 'parent_item_colon', 'Parent Genre:' )
		     ->setLabel( 'edit_item', 'Edit Genre' )
		     ->setLabel( 'update_item', 'Update Genre' )
		     ->setLabel( 'add_new_item', 'Add New Genre' )
		     ->setLabel( 'new_item_name', 'New Genre Name' )
		     ->setLabel( 'menu_name', 'Genres' );
	}
}
