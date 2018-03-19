<?php

namespace Core\Cli;

use Core\Forms\ExampleForm;
use Core\Helpers\HtmlHelper;

class ExampleCommand extends BaseCommand {
	public function run() {
		$form = new ExampleForm([
			'user_login' => '11#',
			'user_email' => 'Hello@gmail.com',
			'site' => 'https://привет.рф/'
		]);
		$form->validate();
		var_dump($form->getErrors());
	}
}
