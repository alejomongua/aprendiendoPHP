<?php
  // Autoloader. Evita tener que cargar archivo por archivo las clases
  function app_autoloader($class) {
    // Es necesario cambiar el separador para que funcione en Linux
    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    require_once 'classes/' . strtolower($class) . '.php';
  }

  spl_autoload_register('app_autoloader');
