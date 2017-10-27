<?php

namespace Core\PostType;

use Core\Taxonomy;

class Example extends BaseType {
	public static function getName() {
		return 'example';
	}

	public static function getArgs() {
		return [
			'labels' => [
				'menu_name' => 'Examples',
				'name' => 'Example',
				'singular_name' => 'Example',
				'add_new' => 'Add new',
				'add_new_item' => 'Add new',
				'edit_item' => 'Edit',
				'new_item' => 'New',
				'view_item' => 'View',
				'search_items' => 'Search',
				'not_found' => 'Ничего не найдено',
				'not_found_in_trash' => 'Ничего не найдено',
			],
			'hierarchical' => false,
			'supports' => [
//				'title',
//				'editor',
//				'thumbnail'
			],
			'menu_position' => 3,
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'has_archive' => true,
			'query_var' => true,
			'can_export' => true,
			'menu_icon' => 'dashicons-admin-site',
		];
	}

	public function registerTaxonomies() {
		$this->registerTaxonomy(Taxonomy\Example::class);
	}
}
