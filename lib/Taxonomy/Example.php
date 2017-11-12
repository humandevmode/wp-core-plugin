<?php

namespace Core\Taxonomy;

use Core\PostType;

class Example extends BaseTaxonomy {
	const TYPE = 'Example';

	public function getPostTypes() {
		return [
			PostType\Example::TYPE
		];
	}

	public function getArgs() {
		return [
			'labels' => [
				'menu_name' => 'Example',
				'name' => 'Example',
				'singular_name' => 'Example',
			],
			'public' => true,
			'hierarchical' => true
		];
	}
}
