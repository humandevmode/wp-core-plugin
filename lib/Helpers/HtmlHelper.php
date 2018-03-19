<?php

namespace Core\Helpers;

class HtmlHelper {
	public static function img(array $attributes, bool $skipEmpty = false) {
		return sprintf('<img %s>', static::attr($attributes, $skipEmpty));
	}

	public static function input(array $attributes, bool $skipEmpty = false) {
		$attributes['type'] = $attributes['type'] ?? 'text';

		return sprintf('<input %s>', static::attr($attributes, $skipEmpty));
	}

	public static function radio(array $attributes, bool $skipEmpty = false) {
		$attributes['type'] = 'radio';

		return static::input($attributes, $skipEmpty);
	}

	public static function checkbox(array $attributes, bool $skipEmpty = false) {
		$attributes['type'] = 'checkbox';

		return static::input($attributes, $skipEmpty);
	}

	public static function link(string $anchor, array $attributes) {
		$attributes['href'] = isset($attributes['href']) ? esc_url($attributes['href']) : '';

		return sprintf('<a %s>%s</a>', static::attr($attributes), $anchor);
	}

	public static function externalLink(string $anchor, array $attributes) {
		$attributes = wp_parse_args($attributes, [
			'rel' => 'noopener nofollow',
			'target' => '_blank'
		]);

		return static::link($anchor, $attributes);
	}

	public static function attr(array $attributes, bool $skipEmpty = false) {
		$result = [];
		foreach ($attributes as $key => $value) {
			if ($key == 'props') {
				continue;
			}
			if (!$skipEmpty || !empty($value)) {
				$result[] = sprintf('%s="%s"', $key, esc_attr($value));
			}
		}
		$props = $attributes['props'] ?? [];
		foreach ($props as $key => $value) {
			if (is_int($key)) {
				$result[] = $value;
			}
			elseif ($value) {
				$result[] = $key;
			}
		}

		return implode(' ', $result);
	}
}
