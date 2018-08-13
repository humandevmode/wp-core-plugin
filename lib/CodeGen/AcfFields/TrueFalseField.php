<?php

namespace Core\CodeGen\AcfFields;

use PhpParser\Node;

class TrueFalseField extends BaseField
{
  public function createGetter()
  {
    return $this->factory->method('get'.$this->toCamelCase($this->field['name'], true))
      ->makePublic()
      ->setReturnType('bool')
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
      ->addParam($this->factory->param('value')->setTypeHint('bool'))
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
