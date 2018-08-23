<?php

namespace Core\PostType;

use WP_Post;

abstract class BasePost
{
  const TYPE = '';

  public static function register()
  {
    static::init();

    add_action('init', [static::class, '_register']);

    if (method_exists(static::class, 'registerFields')) {
      add_action('cmb2_admin_init', [static::class, 'registerFields']);
    }

    if (method_exists(static::class, 'createUrl')) {
      add_filter('post_type_link', [static::class, '_createUrl'], 10, 3);
    }
    if (method_exists(static::class, 'beforeInsert')) {
      add_filter('wp_insert_post_data', [static::class, '_beforeInsert']);
    }

    if (method_exists(static::class, 'afterInsert')) {
      add_action('wp_insert_post', [static::class, '_afterInsert'], 10, 3);
    }
  }

  abstract static function getArgs();

  public static function init()
  {
  }

  protected static function _register()
  {
    register_post_type(static::TYPE, static::getArgs());
  }

  public function _beforeInsert($data)
  {
    if ($data['post_type'] == static::TYPE) {
      $data = call_user_func_array([$this, 'beforeInsert'], [$data]);
    }

    return $data;
  }

  public function _afterInsert(int $post_id, WP_Post $post, bool $update)
  {
    if ($post->post_type === static::TYPE) {
      call_user_func_array([$this, 'afterInsert'], [$post_id, $post, $update]);
    }
  }

  public function _createUrl($url, WP_Post $post, $leavename, $sample)
  {
    if ($post->post_type == static::TYPE) {
      return call_user_func_array([$this, 'createUrl'], [$url, $post, $leavename, $sample]);
    }

    return $url;
  }
}
