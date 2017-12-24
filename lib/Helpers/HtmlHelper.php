<?php

namespace Core\Helpers;

class HtmlHelper {
	public static function generateData(array $attributes) {
		$result = '';
		foreach ($attributes as $key => $value) {
			$result .= " data-{$key}=\"{$value}\"";
		}

		return trim($result);
	}
}
