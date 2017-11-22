<?php

namespace Core\Model;

use DateTime;

class BaseModel {
	/**
	 * @var \WP_Post
	 */
	protected $post;

	public function __construct($post) {
		$this->post = get_post($post);
	}

	public function getID() {
		return $this->post->ID;
	}

	public function getTitle() {
		return $this->post->post_title;
	}

	public function getDate() {
		return new DateTime($this->post->post_date);
	}

	public function getDateGMT() {
		return new DateTime($this->post->post_date_gmt);
	}
}