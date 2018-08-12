<?php

namespace Core\Helpers;

class StringHelper
{
  public static function ucFirst($str, $encoding = 'UTF-8', $otherLower = false)
  {
    $first = mb_strtoupper(mb_substr($str, 0, 1, $encoding), $encoding);
    if ($otherLower) {
      $other = mb_strtolower(mb_substr($str, 1, mb_strlen($str, $encoding), $encoding), $encoding);
    } else {
      $other = mb_substr($str, 1, mb_strlen($str, $encoding), $encoding);
    }

    return $first.$other;
  }

  public static function spintax($text)
  {
    return preg_replace_callback('/\{(((?>[^\{\}]+)|(?R))*)\}/x', function ($text) {
      $text = static::spintax($text[1]);
      $parts = explode('|', $text);

      return $parts[array_rand($parts)];
    }, $text);
  }

  public static function toCamelCase($str, $capitalise_first_char = false)
  {
    if ($capitalise_first_char) {
      $str[0] = mb_strtoupper($str[0]);
    }

    return preg_replace_callback('/[\s_-]([a-z])/', function ($match) {
      return mb_strtoupper($match[1]);
    }, $str);
  }
}
