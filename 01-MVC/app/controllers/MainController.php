<?php

class Maincontroller {
  public function index() {
    echo '<h1 class="title">Bienvenido</h1>';
  }

  public function error404() {
    http_response_code(404);
    echo '<h1 class="title">Pagina no encontrada</h1>';
  }

  public function error500() {
    echo '<h1 class="title">Error en la aplicación</h1>';
  }
}