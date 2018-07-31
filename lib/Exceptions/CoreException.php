<?php

namespace Core\Exceptions;

class CoreException extends \Exception
{
  protected $data = [];

  public function __construct($message = '', array $data = [], $code = 0, \Throwable $previous = null)
  {
    parent::__construct($message, $code, $previous);
    $this->data = $data;
  }

  public function getData()
  {
    return $this->data;
  }
}
