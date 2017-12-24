<<<<<<< HEAD
<?php

namespace Core\Model;

use DateTime;
use DateTimeZone;
use WP_Post;

class BaseModel {
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

	public function getStatus() {
		return $this->post->post_status;
	}

	public function getDate() {
		return new DateTime($this->post->post_date);
	}

	public function getDateGMT() {
		return new DateTime($this->post->post_date_gmt, new DateTimeZone('GMT'));
	}
=======
<?php

namespace Core\Model;

use DateTime;
use DateTimeZone;
use WP_Post;

class BaseModel {
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

	public function getStatus() {
		return $this->post->post_status;
	}

	public function getDate() {
		return new DateTime($this->post->post_date);
	}

	public function getDateGMT() {
		return new DateTime($this->post->post_date_gmt, new DateTimeZone('GMT'));
	}
>>>>>>> 364a7df1116aabe8458efce063faef03bb71ee18
}