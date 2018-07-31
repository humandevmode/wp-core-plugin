<?php

namespace Core;

class Log
{
  const POST_TYPE = 'core_log';
  const TAXONOMY = 'core_log_level';

  public static function register()
  {
    add_action('init', function () {
      static::register_post_type();
      static::register_taxonomy();
    });
  }

  protected static function register_post_type()
  {
    register_post_type(static::POST_TYPE, [
      'labels' => [
        'name' => 'Logs',
      ],
      'public' => false,
      'show_ui' => true,
      'rewrite' => false,
      'supports' => [
        'title',
        'editor',
      ],
      'can_export' => false,
    ]);
  }

  protected static function register_taxonomy()
  {
    register_taxonomy(static::TAXONOMY, static::POST_TYPE, [
      'public' => true,
    ]);
  }

  public static function info($message, array $args = [])
  {
    return static::insert('info', $message, $args);
  }

  public static function error($message, array $args = [])
  {
    return static::insert('error', $message, $args);
  }

  public static function warning($message, array $args = [])
  {
    return static::insert('warning', $message, $args);
  }

  protected static function insert(string $level, string $message, array $args = [])
  {
    $args = wp_parse_args($args, [
      'post_type' => static::POST_TYPE,
      'post_title' => $message,
      'post_content' => sprintf('<pre>%s</pre>', var_export($args, true)),
      'post_status' => 'publish',
    ]);

    $post_id = wp_insert_post($args);

    if (is_int($post_id)) {
      wp_set_object_terms($post_id, $level, static::TAXONOMY);
    }

    return $post_id;
  }
}
