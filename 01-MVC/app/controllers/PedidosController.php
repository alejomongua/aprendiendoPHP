<?php

require_once __DIR__ . '/../helpers/sessionHelpers.php';
require_once __DIR__ . '/../models/Pedido.php';

class PedidosController {
  public function index() {
    soloAdmin();
    $pedidos = Pedido::listado();
    require_once __DIR__ . '/../views/pedidos/index.php';
  }

  public function new() {
    if (!array_key_exists('carrito', $_SESSION) || !$_SESSION['carrito']) {
      $_SESSION['danger'] = 'Por favor agregue algunos productos al carrito para realizar el pedido';
      header('Location: ' . BASE_URL);
      die();
    }
    identificarse();
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

    require_once __DIR__ . '/../views/pedidos/new.php';
  }

  public function create() {
    if (!array_key_exists('carrito', $_SESSION) || !$_SESSION['carrito']) {
      $_SESSION['danger'] = 'Por favor agregue algunos productos al carrito para realizar el pedido';
      header('Location: ' . BASE_URL);
      die();
    }
    $usuario = identificarse();
    $pedido = new Pedido();
    if (!array_key_exists('departamento', $_POST) || $_POST['departamento'] === '') {
      $_SESSION['danger'] = 'Hubo un error al intentar registrar el pedido, departamento es un campo obligatorio';
    }
    if (!array_key_exists('ciudad', $_POST) || $_POST['ciudad'] === '') {
      $_SESSION['danger'] = 'Hubo un error al intentar registrar el pedido, ciudad es un campo obligatorio';
    }
    if (!array_key_exists('direccion', $_POST) || $_POST['direccion'] === '') {
      $_SESSION['danger'] = 'Hubo un error al intentar registrar el pedido, direccion es un campo obligatorio';
    }

    if (!array_key_exists('danger', $_SESSION)) {
      $totalCarrito = 0;

      foreach ($_SESSION['carrito'] as $productoId => $cantidad) {
        $producto = Producto::find($productoId);

        if (!$producto) {
          http_response_code(500);
          echo '<h1 class="title">Hay un error, el producto ' . $productoId . ' no existe. Por favor comuníquese con el administrador del sistema</h1>';
          require_once __DIR__ . '/../views/layout/footer.php';
          die();
        }

        $totalCarrito += $producto->getPrecio() * $cantidad;

        $pedido->addProducto($producto->getId(), $cantidad);
      }

      $pedido->setDepartamento($_POST['departamento']);
      $pedido->setCiudad($_POST['ciudad']);
      $pedido->setDireccion($_POST['direccion']);
      $pedido->setUsuarioId($usuario->getId());
      $pedido->setCoste($totalCarrito);
      $pedido->setEstado('Creado');


      if ($pedido->save()) {
        $_SESSION['success'] = 'El pedido ha sido realizado exitosamente';
        $_SESSION['carrito'] = array();
        header('Location: ' . BASE_URL . 'Pedidos/confirmacion&id=' . $pedido->getId());
        return;
      }
      $_SESSION['danger'] = 'Hubo un error al intentar registrar el pedido';
    }

    header('Location: ' . BASE_URL . 'Pedidos/new');
  }

  public function show() {
    $usuarioActual = identificarse();

    $pedido = PedidosController::encontrarPedido('id');

    if ($usuarioActual->getId() !== $pedido->getUsuarioId() && $usuarioActual->getRol() !== 'Admin') {
      $_SESSION['danger'] = 'No autorizado';
      header('Location: ' . BASE_URL);
      die();
    }
    require_once __DIR__ . '/../views/pedidos/show.php';
  }

  public function edit() {
    soloAdmin();
    $pedido = PedidosController::encontrarPedido('id');
    require_once __DIR__ . '/../views/pedidos/edit.php';
  }

  public function destroy() {
    soloAdmin();
    $pedido = PedidosController::encontrarPedido('id');
  }

  public function update() {
    soloAdmin();
    $pedido = PedidosController::encontrarPedido('id');

    if (!array_key_exists('estado', $_POST) || !in_array($_POST['estado'], Pedido::ESTADOS)) {
      $_SESSION['danger'] = 'Hubo un error al intentar registrar el pedido, estado no es válido';
      header('Location: ' . BASE_URL . 'Pedidos/new');
      return;
    }

    $pedido->setEstado($_POST['estado']);

    if ($pedido->save()) {
      $_SESSION['success'] = 'El estado del pedido ha sido actualizado exitosamente';
      header('Location: ' . BASE_URL . 'Pedidos/index');
      return;
    }
    $_SESSION['danger'] = 'Hubo un error al intentar registrar el pedido';

  }

  public function confirmacion() {
    $usuarioActual = identificarse();

    $pedido = PedidosController::encontrarPedido('id');

    if ($usuarioActual->getId() !== $pedido->getUsuarioId() && $usuarioActual->getRol() !== 'Admin') {
      $_SESSION['danger'] = 'No autorizado';
      header('Location: ' . BASE_URL);
      die();
    }
    require_once __DIR__ . '/../views/pedidos/confirmacion.php';
  }

  public static function encontrarPedido(string $llave) {
    if (!array_key_exists($llave, $_GET)) {
      raise404();
    }
    $pedido = Pedido::find(intval($_GET[$llave]));
    
    if (!$pedido) {
        raise404();
    }

    return $pedido;
  }

}