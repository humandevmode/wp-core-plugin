<?php

namespace Core\Forms;

use Respect\Validation\Validator;

class Rule {
	public static function notEmpty(array $args = []) {
		return wp_parse_args($args, [
			'validator' => Validator::notEmpty(),
			'code' => 'empty',
			'error' => 'Поле "%s" обязательно к заполнению',
			'level' => 'last',
		]);
	}

	public static function email(array $args = []) {
		return wp_parse_args($args, [
			'validator' => Validator::email(),
			'code' => 'invalid',
			'error' => 'Невалидный email адрес',
		]);
	}

	public static function alnum(array $args = []) {
		return wp_parse_args($args, [
			'validator' => Validator::alnum(),
			'code' => 'invalid',
			'error' => 'Поле "%s" может содержать только буквы, цифры и пробел',
		]);
	}
}