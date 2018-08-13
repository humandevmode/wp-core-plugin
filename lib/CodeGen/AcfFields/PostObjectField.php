<?php

namespace Core\CodeGen\AcfFields;

use PhpParser\Node;

class PostObjectField extends BaseField
{
  public function createGetter()
  {
    $field = $this->field;
    if ($field['return_format'] == 'object') {
      $return_type = $field['multiple'] ? '\WP_Post[]' : '\WP_Post';
    }
    else {
      $return_type = $field['multiple'] ? 'array' : 'int';
    }

    return $this->factory->method('get'.$this->toCamelCase($this->field['name'], true))
      ->makePublic()
      ->setReturnType($return_type)
      ->addStmt(new Node\Stmt\Return_(
          $this->factory->methodCall(
            new Node\Expr\Variable('this'),
            new Node\Identifier('getField'),
            [new Node\Arg(new Node\Scalar\String_($this->field['name']))])
        )
      );
  }

  public function createSetter()
  {
    return $this->factory->method('set'.$this->toCamelCase($this->field['name'], true))
      ->makePublic()
      ->addParam($this->factory->param('value'))
      ->addStmt($this->factory->methodCall(
        new Node\Expr\Variable('this'),
        new Node\Identifier('updateField'),
        [
          new Node\Arg(new Node\Scalar\String_($this->field['name'])),
          new Node\Arg(new Node\Expr\Variable('value')),
        ]
      )
      );
  }
}
