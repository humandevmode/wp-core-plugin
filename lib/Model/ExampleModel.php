<?php

namespace Core\Model;

class ExampleModel extends PostModel {
	public function getMirrorUrl($raw = false) {
		$result = $this->getMeta('mirror');
		$result = $raw ? $result : esc_url($result);

		return $result;
	}
}
