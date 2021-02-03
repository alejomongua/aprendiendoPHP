<?php

require_once __DIR__ . '/../models/Usuario.php';

function usuarioIdentificado() {
  if (array_key_exists('usuario', $_SESSION) && $_SESSION['usuario']){
    return unserialize($_SESSION['usuario']);
  }
}

function usuarioAdministrador() {
  $usuario = usuarioIdentificado();
  if (!$usuario) {
    return false;
  }

  return $usuario->getRol() === 'Admin';
}

function soloAdmin() {
  if (!usuarioAdministrador()) {
    $_SESSION['danger'] = 'No autorizado';
    header('Location: ' . BASE_URL);
    die();
  }
}

function raise404() {
  http_response_code(404);
  echo '<h1 class="title">Pagina no encontrada</h1>';
  die();
}