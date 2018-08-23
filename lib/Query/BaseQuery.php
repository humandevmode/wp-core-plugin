<?php

namespace Core\Query;

use Core\Models\BaseModel;
use WP_Query;

class BaseQuery extends WP_Query
{
  protected $post_type = 'post';

  public function __construct(array $query = [])
  {
    $query['post_type'] = $query['post_type'] ?? $this->post_type;
    parent::__construct($query);
  }

  public static function create(array $query = [])
  {
    return new static($query);
  }

  public function createModel(\WP_Post $post)
  {
    return new BaseModel($post);
  }

  public function getModel()
  {
    return $this->createModel($this->post);
  }

  /**
   * @return \Generator|BaseModel[]
   */
  public function eachModel()
  {
    foreach ($this->posts as $post) {
      yield $this->createModel($post);
    }
  }

  /**
   * @return BaseModel[]
   */
  public function getModels()
  {
    return iterator_to_array($this->eachModel(), false);
  }
}
