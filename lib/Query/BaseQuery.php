<?php

namespace Core\Query;

use Core\Models\BasePost;
use WP_Query;

class BaseQuery extends WP_Query {
	public function getModel() {
		return $this->createModel($this->post);
	}

	public function createModel(\WP_Post $post) {
		return new BasePost($post);
	}

	public function getModelsGenerator() {
		foreach ($this->posts as $post) {
			yield $this->createModel($post);
		}
	}
}
