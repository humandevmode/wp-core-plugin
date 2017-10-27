<?php
/**
 * Created by PhpStorm.
 * User: studio
 * Date: 19.06.2017
 * Time: 11:08
 */

namespace Core\Helpers;

class Spintax {
	public function process($text) {
		return preg_replace_callback('/\{(((?>[^\{\}]+)|(?R))*)\}/x', [$this, 'replace'], $text);
	}

	public function replace($text) {
		$text = $this->process($text[1]);
		$parts = explode('|', $text);

		return $parts[array_rand($parts)];
	}
}
