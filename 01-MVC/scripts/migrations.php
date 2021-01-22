<?php

/*
 * Este script sirve para manejar las migraciones de la base de datos
 * Se debe ejecutar desde la línea de comandos
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

require_once __DIR__ . '/../config/constants.php';
require_once DATABASE_DIR . '/class/Migracion.php';

function scanMigrationsDir() {
  $files = scandir(MIGRATIONS_DIR);
  natcasesort($files);
  $salida = array();
  foreach ($files as $file) {
    if ($coincidencia = preg_filter(PATRON_MIGRACION_FILE, '$1', $file)) {
      array_push($salida, $coincidencia);
    }
  }
  return $salida;
}

function runPendingMigrations() {
  /*
   * Verifica si hay migraciones pendientes y las ejecuta
   */
  $files = scanMigrationsDir();
  foreach ($files as $file) {
    $migracion = Migracion::encontrarPorTitulo($file);
    if (!$migracion) {
      $migracion = new Migracion(array('titulo' => $file));
      $migracion->ejecutar();
    }
  }
}

if (count($argv) < 2) {
  echo 'Debe especificar una acción: [run|new|status|help]' . PHP_EOL;
  exit(-2);
}

Migracion::comprobarTabla();

switch($argv[1]) {
  case 'run':
    echo 'Ejecutando migraciones...' . PHP_EOL;
    $myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
    runPendingMigrations();
  break;
  case 'new':
    echo 'Creando migración...' . PHP_EOL;
    $timestamp = date('YmdHi');
    $myfile = fopen(MIGRATIONS_DIR . "/$timestamp.sql", 'w') or die('No se puede crear el archivo');
    fwrite($myfile, '/* Escriba aquí sus migraciones */');
    fclose($myfile);
    echo "Migración $timestamp creada" . PHP_EOL;
  break;
  case 'status':
    echo 'to do' . PHP_EOL;
  break;
  case 'help':
    echo 'Las opciones son:' . PHP_EOL;
    echo '  run     Ejecuta las migraciones pendientes'.  PHP_EOL;
    echo '  new     Crea un nuevo archivo de migración'.  PHP_EOL;
    echo '  status  Muestra el estado actual de las migraciones'.  PHP_EOL;
    echo '  help    Muestra este mensaje de ayuda'.  PHP_EOL;
  break;
  default:
    echo 'Acción incorrecta, las opciones son:' . PHP_EOL;
    echo '  run     Ejecuta las migraciones pendientes'.  PHP_EOL;
    echo '  new     Crea un nuevo archivo de migración'.  PHP_EOL;
    echo '  status  Muestra el estado actual de las migraciones'.  PHP_EOL;
    echo '  help    Muestra este mensaje de ayuda'.  PHP_EOL;
    exit(-1);
};
