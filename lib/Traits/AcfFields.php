<?php

namespace Core\Traits;

trait AcfFields
{
  abstract public function getID();

  public function getField(string $key)
  {
    return get_field($key, $this->getID());
  }

  public function updateField(string $key, $value)
  {
    update_field($key, $value, $this->getID());
  }

  public function deleteField(string $key)
  {
    delete_field($key, $this->getID());
  }
}
