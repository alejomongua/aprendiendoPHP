<?php

require_once __DIR__ . '/../helpers/viewsHelpers.php';
require_once __DIR__ . '/../models/Producto.php';

class MainController {
  public function index() {
    $productos = Producto::randomSample();
    require_once __DIR__ . '/../views/main/index.php';
  }

  public function error404() {
    http_response_code(404);
    echo '<h1 class="title">Pagina no encontrada</h1>';
  }

  public function error500() {
    echo '<h1 class="title">Error en la aplicación</h1>';
  }

  public function administrar() {
    renderView('main/administrar');
  }
}