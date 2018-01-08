<?php

namespace Core\Query;

use Core\Model\PostModel;

class PostQuery extends BaseQuery {
	public function __construct(array $query = []) {
		$query['post_type'] = 'post';
		parent::__construct($query);
	}

	public function getModel() {
		return new PostModel($this->post);
	}
}
