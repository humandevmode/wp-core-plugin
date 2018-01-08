<?php

namespace Core\Query;

use Core\Model\PostModel;

class PageQuery extends BaseQuery {
	public function __construct(array $query = []) {
		$query['post_type'] = 'page';
		parent::__construct($query);
	}

	public function getModel() {
		return new PostModel($this->post);
	}
}
