<?php

namespace Core\Query;

use Core\Models\PostModel;

/**
 * Class PostQuery
 * @package Core\Query
 *
 * @method PostModel getModel()
 * @method PostModel[] getModels()
 * @method \Generator|PostModel[] eachModels()
 */
class PostQuery extends BaseQuery
{
  public function createModel(\WP_Post $post)
  {
    return new PostModel($post);
  }
}
