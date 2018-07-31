<?php

namespace Core\Taxonomy;

use Core\PostType\ExamplePost;

class ExampleTaxonomy extends BaseTaxonomy
{
  const TYPE = 'example';

  public function getPostTypes()
  {
    return [
      ExamplePost::TYPE,
    ];
  }

  public function getArgs()
  {
    return [
      'labels' => [
        'menu_name' => 'ExamplePost',
        'name' => 'ExamplePost',
        'singular_name' => 'ExamplePost',
      ],
      'public' => true,
      'hierarchical' => true,
    ];
  }
}
