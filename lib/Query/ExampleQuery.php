<?php

namespace Core\Query;

use Core\PostType\Example;

class ExampleQuery extends BaseQuery {
	public function __construct(array $query = []) {
		$query['post_type'] = Example::TYPE;
		parent::__construct($query);
	}
}
