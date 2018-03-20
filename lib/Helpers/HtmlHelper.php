<?php

namespace Core\Helpers;

class HtmlHelper {
	public static function img(array $attributes, bool $skipEmpty = false) {
		return sprintf('<img %s>', static::attr($attributes, $skipEmpty));
	}

	public static function ul(array $list, array $attributes = [], bool $skipEmpty = false) {
		$html = '';
		foreach ($list as $item) {
			$html .= sprintf('<li>%s</li>', $item);
		}

		return sprintf('<ul %s>%s</ul>', static::attr($attributes, $skipEmpty), $html);
	}

	public static function input(array $attributes = [], bool $skipEmpty = false) {
		$attributes['type'] = $attributes['type'] ?? 'text';

		return sprintf('<input %s>', static::attr($attributes, $skipEmpty));
	}

	public static function radio(array $attributes = [], bool $skipEmpty = false) {
		$attributes['type'] = 'radio';

		return static::input($attributes, $skipEmpty);
	}

	public static function checkbox(array $attributes = [], bool $skipEmpty = false) {
		$attributes['type'] = 'checkbox';

		return static::input($attributes, $skipEmpty);
	}

	public static function link(string $anchor, array $attributes = []) {
		$attributes['href'] = isset($attributes['href']) ? esc_url($attributes['href']) : '';

		return sprintf('<a %s>%s</a>', static::attr($attributes), $anchor);
	}

	public static function externalLink(string $anchor, array $attributes = []) {
		$attributes = wp_parse_args($attributes, [
			'rel' => 'noopener nofollow',
			'target' => '_blank',
		]);

		return static::link($anchor, $attributes);
	}

	public static function attr(array $attributes = [], bool $skipEmpty = false) {
		$result = [];
		foreach ($attributes as $key => $value) {
			if ($key == 'props') {
				continue;
			}
			if (is_string($value)) {
				if (!empty($value) || !$skipEmpty) {
					$result[] = sprintf('%s="%s"', $key, esc_attr($value));
				}
			}
			elseif (is_array($value)) {
				$result2 = [];
				foreach ($value as $key2 => $value2) {
					if (is_int($key2)) {
						$result2[] = esc_attr($value2);
					}
					elseif (is_string($key2) && is_bool($value2) && $value2) {
						$result2[] = esc_attr($key2);
					}
				}
				$value = implode(' ', $result2);
				$result[] = sprintf('%s="%s"', $key, $value);
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
