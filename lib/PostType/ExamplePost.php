<?php

namespace Core\PostType;

class ExamplePost extends BasePost {
	const TYPE = 'example';

	public function getArgs() {
		return [
			'labels' => [
				'menu_name' => 'Examples',
				'name' => 'ExamplePost',
				'singular_name' => 'ExamplePost',
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
//			'supports' => [
//				'title',
//				'editor',
//				'thumbnail'
//				'amp'
//			],
			'menu_position' => 3,
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'has_archive' => false,
			'query_var' => true,
			'can_export' => true,
			'menu_icon' => 'dashicons-admin-site',
		];
	}
}
