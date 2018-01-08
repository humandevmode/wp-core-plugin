<?php

namespace Core\Query;

use Core\Model\PostModel;
use WP_Query;

class BaseQuery extends WP_Query {
	public function __construct(array $query) {
		if (isset($query['date_query'])) {
			$query['date_query'] = $this->replaceDateQuery($query['date_query']);
		}
		parent::__construct($query);
	}

	protected function replaceDateQuery($date_query) {
		$replaces = [
			'_yesterday' => [
				'after' => 'yesterday -1 sec',
				'before' => 'today',
			],
			'_today' => [
				'after' => 'today -1 sec',
				'before' => 'tomorrow',
			],
			'_today_future' => [
				'after' => 'now',
				'before' => 'tomorrow'
			],
			'_tomorrow' => [
				'after' => 'tomorrow -1 sec',
				'before' => 'tomorrow +1 day',
			]
		];

		if (is_string($date_query) && isset($replaces[$date_query])) {
			$date_query = $replaces[$date_query];
		}

		return $date_query;
	}
}
