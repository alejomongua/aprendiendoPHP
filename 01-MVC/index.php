<?php

require_once __DIR__ . '/app/controllers/autoload.php';

const ROOT_CONTROLLER = 'UsuariosController';
const DEFAULT_ACTION = 'index';

$nombreControlador = isset($_GET['controller']) ? $_GET['controller'] . 'Controller' : ROOT_CONTROLLER;

function raise404() {
  # To do: Mostrar página 404
  throw new Exception('Error 404');
}

if (!class_exists($nombreControlador)) {
  raise404();
}

$controlador = new $nombreControlador;

$action = isset($_GET['action']) ? $_GET['action'] : DEFAULT_ACTION;

if (!method_exists($controlador, $action)) {
  raise404();
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  require_once __DIR__ . '/app/views/layout/header.php';
  require_once __DIR__ . '/app/views/layout/menu.php';
  require_once __DIR__ . '/app/views/layout/sidebar.php';
}

$controlador->$action();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  require_once __DIR__ . '/app/views/layout/footer.php';
}