<?php

namespace Core\Query;

class PageQuery extends BaseQuery {
	public function __construct(array $query = []) {
		$query['post_type'] = 'page';
		parent::__construct($query);
	}
}
