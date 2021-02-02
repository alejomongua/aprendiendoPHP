<?php

session_start();

require_once __DIR__ . '/app/controllers/autoload.php';
require_once __DIR__ . '/config/configuracion.php';
require_once __DIR__ . '/app/helpers/sessionHelpers.php';

const ROOT_CONTROLLER = 'MainController';
const DEFAULT_ACTION = 'index';

$nombreControlador = isset($_GET['controller']) ? $_GET['controller'] . 'Controller' : ROOT_CONTROLLER;

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  require_once __DIR__ . '/app/views/layout/header.php';
  require_once __DIR__ . '/app/views/layout/menu.php';
  require_once __DIR__ . '/app/views/layout/flash.php';
  require_once __DIR__ . '/app/views/layout/sidebar.php';
}

if (!file_exists(__DIR__ . '/app/controllers/' . $nombreControlador . '.php')) {
  $nombreControlador = ROOT_CONTROLLER;
  $controlador = new $nombreControlador;
  $action = 'error404';
} else {
  $controlador = new $nombreControlador;
  
  $action = isset($_GET['action']) ? $_GET['action'] : DEFAULT_ACTION;
  
  if (!method_exists($controlador, $action)) {
    $nombreControlador = ROOT_CONTROLLER;
    $controlador = new $nombreControlador;
    $action = 'error404';
  }
}

$controlador->$action();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  require_once __DIR__ . '/app/views/layout/footer.php';
}