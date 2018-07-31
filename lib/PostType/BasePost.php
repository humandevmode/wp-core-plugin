<?php

namespace Core\PostType;

use WP_Post;

abstract class BasePost
{
  const TYPE = '';

  public function __construct()
  {
    $this->init();

    add_action('init', [$this, 'register']);

    if (method_exists($this, 'registerFields')) {
      add_action('cmb2_admin_init', [$this, 'registerFields']);
    }

    if (method_exists($this, 'createUrl')) {
      add_filter('post_type_link', [$this, '_createUrl'], 10, 3);
    }
    if (method_exists($this, 'beforeInsert')) {
      add_filter('wp_insert_post_data', [$this, '_beforeInsert']);
    }

    if (method_exists($this, 'afterInsert')) {
      add_action('wp_insert_post', [$this, '_afterInsert'], 10, 3);
    }
  }

  abstract function getArgs();

  public function init()
  {
  }

  public function register()
  {
    register_post_type(static::TYPE, $this->getArgs());
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
