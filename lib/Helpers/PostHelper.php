<?php

namespace Core\Helpers;

use WP_Error;
use WP_Post;

class PostHelper {
	public static function sortByDate(WP_Post $post1, WP_Post $post2, $order = SORT_ASC) {
		if ($order == SORT_DESC) {
			return date('U', $post2->post_date) <=> date('U', $post1->post_date);
		}

		return date('U', $post1->post_date) <=> date('U', $post2->post_date);
	}

	/**
	 * @param string $slug
	 * @param array $args
	 * @return int|WP_Error
	 * @throws \Exception
	 */
	public static function ensurePageExist(string $slug, array $args = []) {
		$page = get_page_by_path($slug);

		if ($page instanceof WP_Post) {
			return $page->ID;
		}

		$args = wp_parse_args($args, [
			'post_name' => $slug,
			'post_title' => $slug,
			'post_status' => 'publish',
			'post_type' => 'page',
		]);

		$result = wp_insert_post([
			'post_name' => $args['post_name'],
			'post_title' => $args['post_title'],
			'post_type' => $args['post_type'],
			'post_status' => $args['post_status'],
		]);
		if (is_int($result)) {
			return $result;
		}

		throw new \Exception(sprintf('Can\'t create page "%s"', $slug));
	}
}
