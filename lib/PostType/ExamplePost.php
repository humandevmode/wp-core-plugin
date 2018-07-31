<?php

namespace Core\PostType;

class ExamplePost extends BasePost
{
  const TYPE = 'example';

  public function getArgs()
  {
    return [
      'labels' => [
        'menu_name' => 'Примеры',
        'name' => 'Примеры',
        'singular_name' => 'Пример',
      ],
      'supports' => [
        'amp',
        'title',
        'editor',
        'thumbnail',
      ],
      'public' => true,
      'has_archive' => false,
      'menu_icon' => 'dashicons-admin-site',
    ];
  }
}
