<?php

namespace Core\Model;

use DateTime;
use DateTimeZone;
use WP_Post;

class PostModel {
	/**
	 * @var WP_Post
	 */
	protected $post;

	public function __construct(WP_Post $post) {
		$this->post = $post;
	}

	public function getID() {
		return $this->post->ID;
	}

	public function getStatus() {
		return $this->post->post_status;
	}

	public function getType() {
		return $this->post->post_type;
	}

	public function getName() {
		return $this->post->post_name;
	}

	public function getTitle() {
		return get_the_title($this->post);
	}

	public function getPermalink($raw = false) {
		$result = get_permalink($this->post);
		$result = $raw ? $result : esc_url(apply_filters('the_permalink', $result));

		return $result;
	}

	public function hasThumbnail() {
		return has_post_thumbnail($this->post);
	}

	public function getThumbnail($size = 'post-thumbnail', $attr = '') {
		return get_the_post_thumbnail($this->post, $size, $attr);
	}

	public function hasContent() {
		return !empty($this->post->post_content);
	}

	public function getContent($raw = false) {
		global $post;

		$orig_post = $post;
		$post = $this->post;
		$content = get_the_content();
		$content = $raw ? $content : str_replace(']]>', ']]&gt;', apply_filters('the_content', $content));
		$post = $orig_post;

		return $content;
	}

	public function getMeta(string $key, bool $single = true) {
		return get_post_meta($this->getID(), $key, $single);
	}

	public function getExcerpt($raw = false) {
		$result = get_the_excerpt($this->post);
		$result = $raw ? $result : apply_filters('the_excerpt', $result);

		return $result;
	}

	public function getDate($format = '', $raw = false) {
		$result = get_the_date('', $this->post);
		$result = $raw ? $result : apply_filters('the_date', $result, $format, '', '');

		return $result;
	}

	public function getTime($format = '', $raw = false) {
		$result = get_the_time($format, $this->post);
		$result = $raw ? $result : apply_filters('the_time', $result, $format);

		return $result;
	}

	public function getDateTime() {
		return new DateTime($this->post->post_date);
	}

	public function getGmtDateTime() {
		return new DateTime($this->post->post_date_gmt, new DateTimeZone('GMT'));
	}

	public function getModifiedDateTime() {
		return new DateTime($this->post->post_modified);
	}

	public function getGmtModifiedDateTime() {
		return new DateTime($this->post->post_modified_gmt, new DateTimeZone('GMT'));
	}
}
