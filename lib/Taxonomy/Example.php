<?php

namespace Core\Taxonomy;

class Example extends BaseTaxonomy {
	public static function getName() {
		return 'example';
	}

	public static function getArgs() {
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

	public function registerFields() {

	}
}
