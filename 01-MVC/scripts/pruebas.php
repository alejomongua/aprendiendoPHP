<?php

/*
 * Este script me sirve para hacer pruebas de todo tipo
 * 
 * php scripts/migrations.php run - Ejecuta las migraciones pendientes
 * php scripts/migrations.php new     Crea un nuevo archivo de migración
 * php scripts/migrations.php status  Muestra el estado actual de las migraciones
 * php scripts/migrations.php help    Muestra la ayuda
 */


if (PHP_SAPI !== 'cli') {
  http_response_code(404);
  exit('Nada que ver por aquí');
}

require_once __DIR__ . '/../app/models/Usuario.php';

$usuario = Usuario::findByEmail('admin@example.com');
//$usuario = Usuario::find(1);

var_dump($usuario);
