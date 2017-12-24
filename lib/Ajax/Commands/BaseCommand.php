<?php

namespace Core\Ajax\Commands;

use Core\Ajax\BaseAjax;

class BaseCommand extends BaseAjax {
	protected $data;
	protected static $key = '349750a956bca7fd888d3af18b3ee30e';

	public static function getKey() {
		return static::$key;
	}

	public function validateKey() {
		if (!isset($_REQUEST['key']) || $_REQUEST['key'] != static::getKey()) {
			$this->addError('key', 'Access denied', true);
		}
	}

	public function validateData() {
		if (!isset($_REQUEST['data']) || empty($_REQUEST['data'])) {
			$this->addError('data', 'Data not set', true);
		}

		$data = $_REQUEST['data'];
		$data = stripslashes($data);
		$this->data = json_decode($data, true);
	}

	public function validate() {
		$this->validateKey();
	}
}
