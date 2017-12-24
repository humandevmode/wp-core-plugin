<?php

namespace Core\Taxonomy;

abstract class BaseTaxonomy {
	const TYPE = '';

	public function __construct() {
		add_action('init', [$this, 'register']);

		if (method_exists($this, 'createUrl')) {
			add_filter('term_link', [$this, '_createUrl'], 1, 3);
		}

		if (method_exists($this, 'registerFields')) {
			add_action('cmb2_admin_init', [$this, 'registerFields']);
		}
	}

	abstract function getArgs();

	abstract function getPostTypes();

	public function register() {
		register_taxonomy(static::TYPE, $this->getPostTypes(), $this->getArgs());
	}

	public function _createUrl($url, $term, $taxonomy) {
		if ($taxonomy == static::TYPE) {
			return call_user_func_array([$this, 'createUrl'], [$url, $term, $taxonomy]);
		}

		return $url;
	}
}
