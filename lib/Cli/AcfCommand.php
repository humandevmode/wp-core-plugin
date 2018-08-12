<?php

namespace Core\Cli;

class AcfCommand extends BaseCommand
{
  protected $local = false;

  public function __construct()
  {
    global $argv;

    $this->local = in_array('--local', $argv);
  }

  public function exportJson()
  {
    print static::getJson();
  }

  public function exportPhp()
  {
    print static::getPhp();
  }

  public function dump()
  {
    $this->dumpPhp();
    $this->dumpJson();
  }

  public function dumpJson()
  {
    file_put_contents(CORE_DIR.'/data/acf_groups.json', static::getJson());
  }

  public function dumpPhp()
  {
    file_put_contents(CORE_DIR.'/inc/acf_groups.php', static::getPhp());
  }

  public function getGroups()
  {
    $groups = [];
    acf_update_setting('local', $this->local);
    foreach (acf_get_field_groups() as $group) {
      $group['fields'] = acf_get_fields($group);
      $group = acf_prepare_field_group_for_export($group);
      $groups[] = $group;
    }

    return $groups;
  }

  public function getJson()
  {
    return acf_json_encode($this->getGroups());
  }

  public function getPhp()
  {
    $result = "<?php\n\nif(function_exists('acf_add_local_field_group')) {"."\r\n"."\r\n";
    foreach ($this->getGroups() as $field_group) {
      $code = var_export($field_group, true);
      $result .= "acf_add_local_field_group({$code});"."\r\n"."\r\n";
    }
    $result .= '}';

    return $result;
  }

  public function import()
  {
    $content = file_get_contents(CORE_DIR.'/data/acf_groups.json');
    $json = json_decode($content, true);
    if (empty($json)) {
      return;
    }

    // if importing an auto-json, wrap field group in array
    if (isset($json['key'])) {
      $json = [$json];
    }

    $ids = [];
    $keys = [];
    $imported = [];

    foreach ($json as $field_group) {
      $keys[] = $field_group['key'];
    }

    // look for existing ids
    foreach ($keys as $key) {
      // attempt find ID
      $field_group = _acf_get_field_group_by_key($key);

      // bail early if no field group
      if (!$field_group) {
        continue;
      }

      $ids[$key] = $field_group['ID'];
    }

    acf_enable_local();
    acf_reset_local();

    foreach ($json as $field_group) {
      acf_add_local_field_group($field_group);
    }

    foreach ($keys as $key) {
      $field_group = acf_get_local_field_group($key);

      $id = acf_maybe_get($ids, $key);

      if ($id) {
        $field_group['ID'] = $id;
      }

      if (acf_have_local_fields($key)) {
        $field_group['fields'] = acf_get_local_fields($key);
      }

      $field_group = acf_import_field_group($field_group);

      $imported[] = [
        'ID' => $field_group['ID'],
        'title' => $field_group['title'],
        'updated' => $id ? 1 : 0,
      ];
    }
  }
}
