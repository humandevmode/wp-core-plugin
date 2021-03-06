<?php

/**
 * Plugin Name: Core Functionality
 * Description: This contains all your site's core functionality so that it is theme independent.
 * Version: 0.0.1
 */

require __DIR__.'/vendor/autoload.php';
require __DIR__.'/inc/acf_groups.php';
require __DIR__.'/inc/actions.php';
require __DIR__.'/inc/filters.php';
require __DIR__.'/inc/helpers.php';

use Core\Cli;
use Core\Install;
use Core\Log;

define('CORE_DIR', __DIR__);

register_activation_hook(__FILE__, [Install::class, 'init']);

Log::register();

if (class_exists('WP_CLI')) {
  try {
    WP_CLI::add_command('acf', Cli\AcfCommand::class);
    WP_CLI::add_command('dev', Cli\DevCommand::class);
  } catch (Exception $exception) {
  }
}
