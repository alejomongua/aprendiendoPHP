<?php
  function controllersAutoloader($class) {
    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    require_once $class . '.php';
  }

  spl_autoload_register('controllersAutoloader');
