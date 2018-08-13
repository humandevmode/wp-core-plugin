<?php

namespace Core\CodeGen\AcfFields;

use PhpParser\BuilderFactory;
use PhpParser\Node;

class BaseField
{
  protected $field;
  protected $factory;

  public function __construct(array $field)
  {
    $this->field = $field;
    $this->factory = new BuilderFactory();
  }

  /**
   * @param array $field
   *
   * @return BaseField
   */
  public static function create(array $field)
  {
    $assoc = [
      'true_false' => TrueFalseField::class,
      'post_object' => PostObjectField::class
    ];
    $class = $assoc[$field['type']] ?? static::class;

    return new $class($field);
  }

  public function createGetter()
  {
    return $this->factory->method('get'.$this->toCamelCase($this->field['name'], true))
      ->makePublic()
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

  protected function toCamelCase($str, $capitalise_first_char = false)
  {
    if ($capitalise_first_char) {
      $str[0] = mb_strtoupper($str[0]);
    }

    return preg_replace_callback('/[\s_-]([a-z])/', function ($match) {
      return mb_strtoupper($match[1]);
    }, $str);
  }
}
