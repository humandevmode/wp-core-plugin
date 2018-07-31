<?php

namespace Core\Query;

use Core\Models\PostModel;
use WP_Query;

class BaseQuery extends WP_Query
{
  public function createModel(\WP_Post $post)
  {
    return new PostModel($post);
  }

  public function each()
  {
    foreach ($this->posts as $post) {
      yield $this->createModel($post);
    }
  }

  public function getModel()
  {
    return $this->createModel($this->post);
  }

  public function getModels()
  {
    return iterator_to_array($this->each(), false);
  }
}
