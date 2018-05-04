<?php

namespace Core\Ajax;

use WP_Error;
use Exception;

class BaseAjax {
	protected $errors;
	protected $messages;
	protected $response;
	protected static $action;
	protected static $nonceName = '_wpnonce';

	public function __construct() {
		$this->errors = new WP_Error();
		$this->messages = [];
		$this->addActions();
	}

	protected function addActions() {
		add_action('wp_ajax_' . static::getAction(), [$this, '_handle']);
		add_action('wp_ajax_nopriv_' . static::getAction(), [$this, '_handle']);
	}

	public function _handle() {
		try {
			$this->_validate();
			$this->handle();
			wp_send_json_success([
				'messages' => $this->messages,
				'response' => $this->response,
			]);
		} catch (Exception $err) {
			$errors = $this->errors;
			wp_send_json_error($errors);
		}
	}

	public function handle() {

	}

	public function _validate() {
		$this->validate();

		if ($this->errors->errors) {
			throw new Exception();
		}
	}

	public function validate() {

	}

	public static function getNonceAction() {
		return static::getAction() . '_Nonce';
	}

	public static function getNonceName() {
		return static::$nonceName;
	}

	public static function getAction() {
		return static::getShortName(2);
	}

	protected static function getShortName($count = 1) {
		$parts = explode('\\', static::class);

		return implode('_', array_slice($parts, count($parts) - $count));
	}

	public function verifyNonce() {
		if (isset($_REQUEST[static::$nonceName]) && wp_verify_nonce($_REQUEST[static::$nonceName], $this->getNonceAction())) {
			return true;
		}

		return false;
	}

	public function getErrors() {
		return $this->errors;
	}

	public function addError($code, $message) {
		$this->errors->add($code, $message);
	}

	/**
	 * @param $code
	 * @param $message
	 * @throws Exception
	 */
	public function addLastError($code, $message) {
		$this->addError($code, $message);
		throw new Exception();
	}

	public function addMessage($code, $message) {
		$this->messages[] = [
			'code' => $code,
			'message' => $message
		];
	}
}
