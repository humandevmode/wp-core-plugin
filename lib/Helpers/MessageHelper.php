<?php

namespace Core\Helpers;

class MessageHelper {
	protected static $errors;

	public static function getErrors() {
		if (!isset(static::$errors)) {
			static::$errors = require __DIR__ . '/../../data/messages.php';
		}

		return static::$errors;
	}

	public static function get($name, $default = 'Ошибка') {
		$errors = static::getErrors();
		if (isset($errors[$name])) {
			return $errors[$name];
		}

		return $default;
	}
}