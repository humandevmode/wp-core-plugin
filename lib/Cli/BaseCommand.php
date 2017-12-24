<<<<<<< HEAD
<?php

namespace Core\Cli;

use WP_CLI;
use WP_CLI_Command;

class BaseCommand extends WP_CLI_Command {
	protected function success($message) {
		WP_CLI::success($message);
	}

	protected function error($message) {
		WP_CLI::error($message);
	}
=======
<?php

namespace Core\Cli;

use WP_CLI;
use WP_CLI_Command;

class BaseCommand extends WP_CLI_Command {
	protected function success($message) {
		WP_CLI::success($message);
	}

	protected function error($message) {
		WP_CLI::error($message);
	}
>>>>>>> 364a7df1116aabe8458efce063faef03bb71ee18
}