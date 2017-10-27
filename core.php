<?php

/**
 * Plugin Name: Core Functionality
 * Description: This contains all your site's core functionality so that it is theme independent.
 * Version: 0.0.1
 */

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/vendor/webdevstudios/cmb2/init.php';
require __DIR__ . '/inc/actions.php';
require __DIR__ . '/inc/filters.php';
require __DIR__ . '/inc/helpers.php';

use Core\Cli;
use Core\Install;

register_activation_hook(__FILE__, [Install::class, 'init']);

$postTypes = [
];

if (class_exists('WP_CLI')) {
	WP_CLI::add_command('tmp', Cli\Tmp::class);
}
