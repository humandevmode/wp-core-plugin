<?php

namespace Core\Forms;

abstract class BaseForm {
	protected $data = [];
	protected $errors = [];
	protected $nonceName = '_wpnonce';
	protected $nonceAction = '_form';

	public function __construct(array $data = []) {
		$this->data = $data;
	}

	public function setData(array $data) {
		$this->data = $data;
	}

	public function addError($field, $code, $message) {
		$this->errors[] = compact('field', 'code', 'message');
	}

	public function handle() {
		try {
			$this->_validate();
			$this->_handle();
		}
		catch (\Exception $exception) {

		}
	}

	abstract protected function _handle();

	abstract protected function _validate();

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

	public function getErrorsByField($field) {
		return array_filter($this->errors, function ($value) use ($field) {
			return $value == $field;
		});
	}

	public function getErrorsByCode($code) {
		return array_filter($this->errors, function ($value) use ($code) {
			return $value == $code;
		});
	}

	public function getErrorsMessage() {
		return array_map(function ($value) {
			return $value['message'];
		}, $this->errors);
	}

	public function hasErrors() {
		return !empty($this->errors);
	}

	public function getNonceField() {
		return wp_nonce_field($this->nonceAction, $this->nonceName, true, false);
	}

	public function getNonceAction() {
		return $this->getField($this->nonceName);
	}

	public function getField($key, $default = '') {
		return isset($this->data[$key]) ? $this->data[$key] : $default;
	}
}
