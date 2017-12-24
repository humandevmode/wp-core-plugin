<?php

namespace Core\Helpers;

class StringHelper {
	public static function ucFirst($str, $encoding = 'UTF-8', $otherLower = false) {
		$first = mb_strtoupper(mb_substr($str, 0, 1, $encoding), $encoding);
		if ($otherLower) {
			$other = mb_strtolower(mb_substr($str, 1, mb_strlen($str, $encoding), $encoding), $encoding);
		}
		else {
			$other = mb_substr($str, 1, mb_strlen($str, $encoding), $encoding);
		}

		return $first . $other;
	}

	public static function spintax($text) {
		return preg_replace_callback('/\{(((?>[^\{\}]+)|(?R))*)\}/x', function ($text) {
			$text = static::spintax($text[1]);
			$parts = explode('|', $text);

			return $parts[array_rand($parts)];
		}, $text);
	}
}
