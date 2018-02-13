<?php

namespace Core\Helpers;

use WP_Post;
use DateTime;

class PostHelper {
	/**
	 * @param WP_Post[] $posts
	 * @param int $order
	 * @return WP_Post[]
	 */
	public static function sortByDate(array $posts, $order = SORT_ASC) {
		usort($posts, function (WP_Post $post1, WP_Post $post2) use ($order) {
			$time1 = get_the_time('U', $post1);
			$time2 = get_the_time('U', $post2);
			if ($time1 > $time2) {
				return $order == SORT_ASC ? 1 : -1;
			}
			elseif ($time1 < $time2) {
				return $order == SORT_ASC ? -1 : 1;
			}

			return 0;
		});

		return $posts;
	}

	/**
	 * @param WP_Post[] $posts
	 * @param DateTime $date
	 * @return array
	 */
	public static function filterByDate(array $posts, DateTime $date) {
		$day = $date->format('Y-m-d');

		return array_filter($posts, function (WP_Post $post) use ($day) {
			if (date('Y-m-d', strtotime($post->post_date)) == $day) {
				return true;
			}

			return false;
		});
	}

	public static function groupByTerm() {

	}
}