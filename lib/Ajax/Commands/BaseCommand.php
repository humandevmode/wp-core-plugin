<?php

namespace Core\Ajax\Commands;

use Core\Ajax\BaseAjax;

class BaseCommand extends BaseAjax
{
  protected $data;

  public static function getKey()
  {
    return get_option('ajax_command_key');
  }

  /**
   * @throws \Exception
   */
  public function validateKey()
  {
    if (!isset($_REQUEST['key']) || $_REQUEST['key'] != static::getKey()) {
      $this->addLastError('key', 'Access denied');
    }
  }

  /**
   * @throws \Exception
   */
  public function validateData()
  {
    if (!isset($_REQUEST['data']) || empty($_REQUEST['data'])) {
      $this->addLastError('data', 'Data not set');
    }

    $data = $_REQUEST['data'];
    $data = stripslashes($data);
    $this->data = json_decode($data, true);
  }

  /**
   * @throws \Exception
   */
  public function validate()
  {
    $this->validateKey();
  }
}
