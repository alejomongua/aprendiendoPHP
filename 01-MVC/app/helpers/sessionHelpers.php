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