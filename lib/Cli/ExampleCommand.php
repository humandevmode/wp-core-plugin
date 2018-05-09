<?php

namespace Core\Cli;

use Core\Log;

class ExampleCommand extends BaseCommand {
	public function run() {
		Log::error('Test');
	}
}
