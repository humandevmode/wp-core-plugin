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
  protected function error($message)
  {
    WP_CLI::error($message);
  }
}
