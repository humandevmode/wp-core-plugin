<?php

namespace Core\Query;

class PostQuery extends BaseQuery {
	public function __construct(array $query = []) {
		$query['post_type'] = 'post';
		parent::__construct($query);
	}
}
