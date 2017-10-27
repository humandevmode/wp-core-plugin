<?php

namespace Core\Taxonomy;

abstract class BaseTaxonomy {
	public function __construct($postType) {
		register_taxonomy(static::getName(), $postType, $this->getArgs());

		if (method_exists($this, 'createUrl')) {
			add_filter('term_link', [$this, '_createUrl'], 1, 3);
		}

		if (method_exists($this, 'registerFields')) {
			add_action('cmb2_admin_init', [$this, 'registerFields']);
		}
	}

	abstract static function getName();

	abstract static function getArgs();

	public function _createUrl($url, $term, $taxonomy) {
		if ($taxonomy == static::getName()) {
			return call_user_func_array([$this, 'createUrl'], [$url, $term, $taxonomy]);
		}

		return $url;
	}
}
