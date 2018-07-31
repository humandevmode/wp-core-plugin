<?php

namespace Core\Traits;

trait MetaData
{
  abstract public function getID();

  abstract public function getMetaType();

  public function getMeta(string $key): string
  {
    return get_metadata($this->getMetaType(), $this->getID(), $key, true);
  }

  public function getMetaArray(string $key): array
  {
    return get_metadata($this->getMetaType(), $this->getID(), $key, false);
  }

  public function updateMeta(string $meta_key, $meta_value, $prev_value = '')
  {
    return update_metadata($this->getMetaType(), $this->getID(), $meta_key, $meta_value, $prev_value);
  }

  public function deleteMeta(string $meta_key, $meta_value = '')
  {
    return delete_metadata($this->getMetaType(), $this->getID(), $meta_key, $meta_value);
  }

  public function increaseMeta(string $key, int $add = 1)
  {
    return $this->updateMeta($key, (int)$this->getMeta($key) + $add);
  }
}
