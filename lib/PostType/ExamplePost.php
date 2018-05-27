<?php

namespace Core\PostType;

class ExamplePost extends BasePost {
	const TYPE = 'example';

	public function getArgs() {
		return [
			'labels' => $this->getLabels(),
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
			'show_in_rest' => false,
//			'rest_base' => static::TYPE,
			'menu_icon' => 'dashicons-admin-site',
		];
	}
}
