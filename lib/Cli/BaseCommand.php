<?php

namespace Core\Cli;

use WP_CLI;
use WP_CLI_Command;

class BaseCommand extends WP_CLI_Command
{
  /**
   * @param $message
   */
  protected function success($message)
  {
    WP_CLI::success($message);
  }

  /**
   * @param $message
   *
   * @throws WP_CLI\ExitException
   */
  protected function lastError($message)
  {
    WP_CLI::error($message);
  }

  protected function error($message)
  {
    try {
      WP_CLI::error($message);
    } catch (\Exception $exception) {

    }
  }
}
