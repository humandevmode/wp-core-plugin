<?php

namespace Core\Query;

use Core\PostType\ExamplePost;

class ExampleQuery extends BaseQuery {
	public function __construct(array $query = []) {
		$query['post_type'] = ExamplePost::TYPE;
		parent::__construct($query);
	}
}
