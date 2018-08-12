<?php

namespace Core\CodeGen;

use PhpParser\BuilderFactory;
use PhpParser\Node;
use PhpParser\PrettyPrinter;

class AcfGroupGenerator
{
  protected $group;

  public function __construct(array $group)
  {
    $this->group = $group;
  }

  public function getCode()
  {
    $factory = new BuilderFactory;
    $namespace = $factory->namespace('Core\Models\Fields');
    $trait = $factory->trait($this->group['key']);
    $trait->addStmt(new Node\Stmt\TraitUse([
      new Node\Name('\Core\Traits\AcfFields')
    ]));

    foreach ($this->group['fields'] as $field) {
      $trait->addStmt(
        $factory->method('get'.$this->toCamelCase($field['name'], true))
          ->makePublic()
          ->addStmt(new Node\Stmt\Return_(
              $factory->methodCall(
                new Node\Expr\Variable('this'),
                new Node\Identifier('getField'),
                [new Node\Arg(new Node\Scalar\String_($field['name']))])
            )
          )
      );

      $trait->addStmt(
        $factory->method('set'.$this->toCamelCase($field['name'], true))
          ->makePublic()
          ->addParam($factory->param('value'))
          ->addStmt($factory->methodCall(
              new Node\Expr\Variable('this'),
              new Node\Identifier('updateField'),
              [
                new Node\Arg(new Node\Scalar\String_($field['name'])),
                new Node\Arg(new Node\Expr\Variable('value')),
              ]
            )
          )
      );
    }

    $prettyPrinter = new PrettyPrinter\Standard();
    $code = $prettyPrinter->prettyPrintFile([$namespace->addStmt($trait)->getNode()]);

    return $code;
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
