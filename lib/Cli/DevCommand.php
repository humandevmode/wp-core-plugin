<?php

namespace Core\Cli;

class DevCommand extends BaseCommand
{
  public function createCPT($args, $kvargs)
  {
    $name = $kvargs['name'] ?? $args[0] ?? null;
    if (is_null($name)) {
      $this->error('Name must be set');
      return;
    }
  }
}
