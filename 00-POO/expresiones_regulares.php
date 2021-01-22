<?php

$prueba = '202101121223.sql';


$salida = preg_filter($regex, '$1', $prueba);

var_dump($salida);
echo '<br />';
var_dump($prueba);

echo '<br />';
echo '<br />';
echo '<br />';


const MIGRATIONS_DIR = __DIR__ . '/../01-MVC/config/database/migrations';

$files = scandir(MIGRATIONS_DIR);
var_dump($files);
echo '<br />';
foreach ($files as $file) {
  if ($coincidencia = preg_filter($regex, '$1', $file)) {
    echo '<h1>';
    echo($coincidencia);
    echo '</h1>';
    continue;
  }
  var_dump($file);    
  echo '<br />';
}
