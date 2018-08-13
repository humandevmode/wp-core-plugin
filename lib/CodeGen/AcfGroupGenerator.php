<?php

namespace Core\CodeGen;

use Core\CodeGen\AcfFields\BaseField;
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
      $fieldGenerator = BaseField::create($field);

      $trait->addStmt($fieldGenerator->createGetter());
      $trait->addStmt($fieldGenerator->createSetter());
    }

    $prettyPrinter = new PrettyPrinter\Standard();
    $code = $prettyPrinter->prettyPrintFile([$namespace->addStmt($trait)->getNode()]);

    return $code;
  }
}
