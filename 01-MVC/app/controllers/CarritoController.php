<?php

require_once __DIR__ . '/../helpers/viewsHelpers.php';
require_once __DIR__ . '/../helpers/sessionHelpers.php';
require_once __DIR__ . '/../models/Producto.php';

class CarritoController {
  public function index() {
    self::inicializarCarrito();
    $carrito = $_SESSION['carrito'];
    $totalCarrito = 0;
    $productos = [];

    foreach ($carrito as $productoId => $cantidad) {
      $producto = Producto::find($productoId);

      if (!$producto) {
        http_response_code(500);
        echo '<h1 class="title">Hay un error, el producto ' . $productoId . ' no existe. Por favor comuníquese con el administrador del sistema</h1>';
        require_once __DIR__ . '/../views/layout/footer.php';
        die();
      }

      $productos[$productoId] = $producto;
      $totalCarrito += $producto->getPrecio() * $cantidad;
    }
    require_once __DIR__ . '/../views/carrito/index.php';
  }

  public function add() {
    self::inicializarCarrito();
    if (!array_key_exists('producto', $_GET)) {
      raise404();
    }

    $producto = ProductosController::encontrarProducto('producto');

    if (!array_key_exists($_GET['producto'], $_SESSION['carrito'])) {
      $_SESSION['carrito'][$_GET['producto']] = 0;
    }

    $_SESSION['carrito'][$_GET['producto']] += 1;

    $_SESSION['success'] = 'Agregado ' . $producto->getNombre() . ' al carrito';

    redirect('Carrito/index');
  }

  public function remove() {
    self::inicializarCarrito();

    redirect('Carrito/index');
    if (!array_key_exists($_GET['producto'], $_SESSION['carrito'])) {
      $_SESSION['danger'] = 'El elemento no existe en el carrito';
      return;
    }

    unset($_SESSION['carrito'][$_GET['producto']]);
    $_SESSION['success'] = 'Producto eliminado del carrito';
  }

  public function clear() {
    $_SESSION['carrito'] = array();

    $_SESSION['success'] = 'Carrito de compras vaciado';

    redirect('');
  }

  public static function inicializarCarrito() {
    if (!array_key_exists('carrito', $_SESSION) || !is_array($_SESSION['carrito'])) {
      $_SESSION['carrito'] = array();
    }
  }
}
