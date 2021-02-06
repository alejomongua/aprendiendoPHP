<?php

require_once __DIR__ . '/../models/Categoria.php';

class CategoriasController {
  public function index() {
    soloAdmin();
    $categorias = Categoria::listado();
    require_once __DIR__ . '/../views/categorias/index.php';
  }

  public function new() {
    require_once __DIR__ . '/../views/categorias/new.php';
  }

  public function create() {
    soloAdmin();
    $categoria = new Categoria();
    if (!array_key_exists('nombre', $_POST) || $_POST['nombre'] === '') {
      $_SESSION['danger'] = 'Registro fallido, nombre es un campo obligatorio';
    }

    if (!array_key_exists('danger', $_SESSION)) {
      $categoria->setNombre($_POST['nombre']);

      if ($categoria->save()) {
        $_SESSION['success'] = 'Registro exitoso';
        header('Location: ' . BASE_URL . 'Categorias/index');
        return;
      }
      $_SESSION['danger'] = 'Registro fallido';
    }

    header('Location: ' . BASE_URL . '/Categorias/new');
  }

  public function edit() {
    soloAdmin();
    if (!array_key_exists('id', $_GET)) {
      var_dump($_GET);
      raise404();
    }
    $categoria = Categoria::find(intval($_GET['id']));

    if (!$categoria) {
      echo 'DOS';
      raise404();
    }

    require_once __DIR__ . '/../views/categorias/edit.php';
  }

  public function show() {
    $categoria = Categoria::find(intval($_GET['id']));

    if (!$categoria) {
      echo 'DOS';
      raise404();
    }

    require_once __DIR__ . '/../views/categorias/show.php';
  }
}