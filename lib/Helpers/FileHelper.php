<?php

namespace Core\Helpers;

class FileHelper
{
  public static function removeDirectory($dir, $options = [])
  {
    if (!is_dir($dir)) {
      return;
    }
    if (isset($options['traverseSymlinks']) && $options['traverseSymlinks'] || !is_link($dir)) {
      if (!($handle = opendir($dir))) {
        return;
      }
      while (($file = readdir($handle)) !== false) {
        if ($file === '.' || $file === '..') {
          continue;
        }
        $path = $dir.DIRECTORY_SEPARATOR.$file;
        if (is_dir($path)) {
          static::removeDirectory($path, $options);
        } else {
          static::unlink($path);
        }
      }
      closedir($handle);
    }
    if (is_link($dir)) {
      static::unlink($dir);
    } else {
      rmdir($dir);
    }
  }

  public static function unlink($path)
  {
    $isWindows = DIRECTORY_SEPARATOR === '\\';
    if (!$isWindows) {
      return unlink($path);
    }
    if (is_link($path) && is_dir($path)) {
      return rmdir($path);
    }
    try {
      return unlink($path);
    } catch (\Throwable $e) {
      return false;
    }
  }
}
