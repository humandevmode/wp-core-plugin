<?php

namespace Core\Forms;

abstract class BaseForm {
	protected $data = [];
	protected $errors = [];
	protected $messages = [];
	protected $success = false;
	protected $nonceName = '_wpnonce';
	protected $nonceAction = '_form';

	public function __construct(array $data = []) {
		$this->data = $data;
	}

	public function setData(array $data) {
		$this->data = $data;
	}

	protected function isCurrentForm() {
		return $this->getField('action') == $this->getAction();
	}

	public function handle() {
		if (!$this->isCurrentForm()) {
			return;
		}
		try {
			if ($this->validate()) {
				$this->_handle();
			}
			if (!$this->hasErrors()) {
				$this->success = true;
			}
		} catch (\Exception $exception) {
			if (!$this->hasErrors()) {
				$this->addError('unknown', 'unknown', 'Извините, что-то пошло не так...');
			}
		}
	}

	abstract public function getFields();

	abstract protected function _handle();

	/**
	 * @return bool
	 */
	public function validate() {
		if (!$this->verifyNonce()) {
			$this->addError('unknown', 'invalid', 'Извините, ошибка безопасности');

			return false;
		}
		foreach ($this->getFields() as $field => $config) {
			$label = $config['label'] ?? '';
			foreach ($config['rules'] as $rule) {
				/** @var \Respect\Validation\Validator $validator */
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
						return false;
					}
				}
			}
		}

		return !$this->hasErrors();
	}

	public function getUrl() {
		return '#';
	}

	public function isSuccess() {
		return $this->success;
	}

	public function getMessages() {
		return $this->messages;
	}

	public function getMessage($default = '', $index = 0) {
		return $this->messages[$index] ?? $default;
	}

	public function addMessage(string $message) {
		$this->messages[] = $message;
	}

	public function addError(string $field, string $code, string $message) {
		$this->errors[] = compact('field', 'code', 'message');
	}

	/**
	 * @param string $field
	 * @param string $code
	 * @param string $message
	 * @throws \Exception
	 */
	public function addLastError(string $field, string $code, string $message) {
		$this->addError($field, $code, $message);
		throw new \Exception($message);
	}

	public function getErrors() {
		return $this->errors;
	}

	public function fieldHasError($field) {
		foreach ($this->errors as $error) {
			if ($error['field'] == $field) {
				return true;
			}
		}

		return false;
	}

	public function getErrorsByField($field) {
		$result = [];
		foreach ($this->errors as $error) {
			if ($error['field'] == $field) {
				$result[$error['code']] = $error['message'];
			}
		}

		return $result;
	}

	public function getErrorsByCode($code) {
		$result = [];
		foreach ($this->errors as $error) {
			if ($error['code'] == $code) {
				$result[$error['field']] = $error['message'];
			}
		}

		return $result;
	}

	public function getErrorsMessage() {
		return array_map(function ($value) {
			return $value['message'];
		}, $this->errors);
	}

	public function hasErrors() {
		return !empty($this->errors);
	}

	public function getAction() {
		return end(explode('\\', static::class));
	}

	public function getNonceField() {
		return wp_nonce_field($this->nonceAction, $this->nonceName, true, false);
	}

	public function verifyNonce() {
		return wp_verify_nonce($this->getField($this->nonceName), $this->nonceAction);
	}

	public function getNonceAction() {
		return $this->getField($this->nonceName);
	}

	public function getField($key, $default = '') {
		return isset($this->data[$key]) ? $this->data[$key] : $default;
	}

	public function getHiddenFields() {
		$result = sprintf('<input type="hidden" name="action" value="%s">', static::getAction());
		$result .= $this->getNonceField();

		return $result;
	}
}
