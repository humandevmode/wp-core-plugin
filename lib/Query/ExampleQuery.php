<?php

namespace Core\Query;

use Core\Model\ExampleModel;
use Core\PostType\ExamplePost;

class ExampleQuery extends BaseQuery {
	public function __construct(array $query = []) {
		$query['post_type'] = ExamplePost::TYPE;
		parent::__construct($query);
	}

	public function getModel() {
		return new ExampleModel($this->post);
	}
}
