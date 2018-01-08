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

	public function getTitle() {
		return get_the_title($this->post);
	}

	public function getName() {
		return $this->post->post_name;
	}

	public function getUrl() {
		return get_permalink($this->post);
	}

	public function getThumb($size = 'post-thumbnail', $attr = '') {
		return get_the_post_thumbnail($this->post, $size, $attr);
	}

	protected function getMeta(string $key, bool $single = true) {
		return get_post_meta($this->getID(), $key, $single);
	}

	public function hasContent() {
		return !empty($this->post->post_content);
	}

	public function getContent() {
		global $post;

		$orig_post = $post;
		$post = $this->post;
		$content = get_the_content();
		$post = $orig_post;

		return $content;
	}

	public function getDate($format) {
		return (new DateTime($this->post->post_date))->format($format);
	}

	public function getModifiedDate($format) {
		return (new DateTime($this->post->post_modified))->format($format);
	}

	public function getDateTime($gmt = false) {
		if ($gmt) {
			return new DateTime($this->post->post_date_gmt, new DateTimeZone('GMT'));
		}

		return new DateTime($this->post->post_date);
	}

	public function getModifiedDateTime($gmt = false) {
		if ($gmt) {
			return new DateTime($this->post->post_modified_gmt, new DateTimeZone('GMT'));
		}

		return new DateTime($this->post->post_modified);
	}

	public function getStatus() {
		return $this->post->post_status;
	}

	public function getType() {
		return $this->post->post_type;
	}
}
