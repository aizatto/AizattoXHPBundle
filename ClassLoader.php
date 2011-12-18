<?php

namespace Aizatto\Bundle\XHPBundle;

class ClassLoader
{

  private
    $prefix,
    $path;

  public function __construct($prefix, $path) {
    $this->prefix = 'xhp_'.$prefix.'__';
    $this->path = $path;
  }

  public function register($prepend = false) {
    spl_autoload_register(
      array($this, 'loadClass'),
      true,
      true);
  }

  public function loadClass($class) {
    if (strpos($class, $this->prefix) !== 0) {
      return false;
    }

    $class = substr($class, strlen($this->prefix));
    $path = str_replace(
      array('__', '_'),
      array(DIRECTORY_SEPARATOR, '-'),
      $class);
    $path .= '.php';

    require $this->path.DIRECTORY_SEPARATOR.$path;
  }

}
