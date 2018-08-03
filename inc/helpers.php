<?php

use Core\Helpers\HtmlHelper;

function is_pjax()
{
  return isset($_SERVER['HTTP_X_PJAX']);
}

function html_attr($attributes)
{
  return HtmlHelper::attr($attributes);
}

function html_data($data)
{
  return html_attr(['data' => $data]);
}

function html_class($class)
{
  return HtmlHelper::attr(['class' => $class]);
}

function html_val(array $values)
{
  $result = [];
  foreach ($values as $value => $show) {
    if (is_string($value) && $show) {
      $result[] = htmlentities($value);
    }
  }

  return implode(' ', $result);
}

function html_prop($props)
{
  return HtmlHelper::attr(['props' => $props]);
}

function html_external(string $href)
{
  return html_attr([
    'href' => $href,
    'target' => '_blank',
    'rel' => 'noopener nofollow',
  ]);
}
