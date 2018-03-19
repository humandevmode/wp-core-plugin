<?php

namespace Core\Forms;

use Respect\Validation\Validator;

class ExampleForm extends BaseForm {
	public function getFields() {
		return [
			'user_email' => [
				'label' => 'email адрес',
				'rules' => [
					[
						'validator' => Validator::notEmpty(),
						'code' => 'empty',
						'error' => 'Поле "%s" обязательно к заполнению',
						'level' => 'last'
					],
					[
						'validator' => Validator::email(),
						'code' => 'invalid',
						'error' => 'Невалидный email адрес'
					],
				]
			],
			'user_login' => [
				'label' => 'login',
				'rules' => [
//					[
//						'validator' => Validator::notEmpty(),
//						'code' => 'empty',
//						'error' => 'Поле "%s" обязательно к заполнению',
//						'level' => 'last'
//					],
//					[
//						'validator' => Validator::alnum(),
//						'code' => 'invalid',
//						'error' => 'Поле "%s" может содержать только буквы, цифры и пробел'
//					],
					[
						'validator' => Validator::optional(Validator::alnum()),
						'error' => 'Поле "%s" может содержать только буквы, цифры и пробел'
					],
				]
			]
		];
	}

	public function _handle() {

	}

	/**
	 * @throws \Exception
	 */
	public function _validate() {
		foreach ($this->getFields() as $field => $config) {
			$label = $config['label'] ?? '';
			foreach ($config['rules'] as $rule) {
				/** @var Validator $validator */
				if (!isset($rule['validator'])) {
					continue;
				}
				$value = $this->getField($field);
				$validator = $rule['validator'];
				$code = $rule['code'] ?? 'invalid';
				$error = $rule['error'] ?? 'Поле имеет некорректное значение';
				$error = sprintf($error, $label);
				$level = $rule['level'] ?? 'info';
				if (!$validator->validate($value)) {
					$this->addError($field, $code, $error);
					if ($level == 'last') {
						break;
					}
					elseif ($level == 'fatal') {
						return;
					}
				}
			}
		}
	}
}
