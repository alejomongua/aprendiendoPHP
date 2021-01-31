<?php

require_once __DIR__ . '/../models/Usuario.php';

class UsuariosController {
  public function index() {
    echo 'Controlador de usuarios, listado [TO DO]';
  }

  public function new() {
    require_once __DIR__ . '/../views/usuarios/new.php';
  }

  public function create() {
    if (isset($_POST)) {
      var_dump($_POST);
    }
  }
}