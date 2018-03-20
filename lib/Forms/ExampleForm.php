<?php

namespace Core\Forms;

class ExampleForm extends BaseForm {
	protected function _handle() {
		$this->addMessage('This works');
	}

	public function getEmail() {
		return $this->getField('user_email');
	}

	public function getLogin() {
		return $this->getField('user_login');
	}

	public function getFields() {
		return [
			'user_email' => [
				'label' => 'Email',
				'rules' => [Rule::notEmpty(), Rule::email()],
			],
			'user_login' => [
				'label' => 'Логин',
				'rules' => [Rule::notEmpty(), Rule::alnum()],
			],
		];
	}
}
