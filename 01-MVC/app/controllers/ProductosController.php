<?php

require_once __DIR__ . '/../models/Producto.php';
require_once __DIR__ . '/../helpers/utilHelpers.php';

class ProductosController {
  public function index() {
    soloAdmin();
    $productos = Producto::listado();
    require_once __DIR__ . '/../views/productos/index.php';
  }

  public function new() {
    $accion = 'create';
    $producto = null;
    require_once __DIR__ . '/../views/productos/new.php';
    require_once __DIR__ . '/../views/productos/form.php';
  }

  public function create() {
    soloAdmin();
    $producto = new Producto();
    if (!array_key_exists('nombre', $_POST) || $_POST['nombre'] === '') {
      $_SESSION['danger'] = 'Registro fallido, nombre es un campo obligatorio';
    }
    if (!array_key_exists('categoria_id', $_POST) || $_POST['categoria_id'] === '') {
      $_SESSION['danger'] = 'Registro fallido, categoria_id es un campo obligatorio';
    }
    if (!array_key_exists('precio', $_POST) || $_POST['precio'] === '') {
      $_SESSION['danger'] = 'Registro fallido, precio es un campo obligatorio';
    }
    if (!array_key_exists('stock', $_POST) || $_POST['stock'] === '') {
      $_SESSION['danger'] = 'Registro fallido, stock es un campo obligatorio';
    }

    if (!array_key_exists('danger', $_SESSION)) {
      $producto->setNombre($_POST['nombre']);
      $producto->setStock($_POST['stock']);
      $producto->setPrecio($_POST['precio']);
      $producto->setCategoriaId($_POST['categoria_id']);
      if (array_key_exists('descripcion', $_POST)) {
        $producto->setDescripcion($_POST['descripcion']);
      }

      // Imagen del producto
      if (array_key_exists('imagen', $_FILES)) {
        $imageFile = $_FILES['imagen'];
        $mimeType = $imageFile['type'];
        if (preg_match('/^image\/(jpg|jpeg|gif|png)$/', $mimeType)) {
          if (!is_dir(Producto::IMAGES_FOLDER)) {
            mkdir(Producto::IMAGES_FOLDER, 0755, true);
            var_dump(Producto::IMAGES_FOLDER);
            die();
          }

          $randString = generateRandomString();
          $filename = $randString . '-' . $imageFile['name'];
          move_uploaded_file($imageFile['tmp_name'], Producto::IMAGES_FOLDER . $filename);
          $producto->setImagen($filename);
        }
      }

      if ($producto->save()) {
        $_SESSION['success'] = 'Registro exitoso';
        header('Location: ' . BASE_URL . 'Productos/index');
        return;
      }
      $_SESSION['danger'] = 'Registro fallido';
    }

    header('Location: ' . BASE_URL . '/Productos/new');
  }

  public function update() {
    soloAdmin();
    $producto = self::encontrarProducto();

    if (array_key_exists('nombre', $_POST) && $_POST['nombre'] !== '') {
      $producto->setNombre($_POST['nombre']);
    }
    if (array_key_exists('categoria_id', $_POST) && $_POST['categoria_id'] !== '') {
      $producto->setCategoriaId($_POST['categoria_id']);
    }
    if (array_key_exists('precio', $_POST) && $_POST['precio'] !== '') {
      $producto->setPrecio($_POST['precio']);
    }
    if (array_key_exists('stock', $_POST) && $_POST['stock'] !== '') {
      $producto->setStock($_POST['stock']);
    }
    if (array_key_exists('descripcion', $_POST)) {
      $producto->setDescripcion($_POST['descripcion']);
    }

    // Imagen del producto
    if (array_key_exists('imagen', $_FILES)) {
      $imageFile = $_FILES['imagen'];
      $mimeType = $imageFile['type'];
      if (preg_match('/^image\/(jpg|jpeg|gif|png)$/', $mimeType)) {
        if (!is_dir(Producto::IMAGES_FOLDER)) {
          mkdir(Producto::IMAGES_FOLDER, 0755, true);
        }

        $randString = generateRandomString();
        $filename = $randString . '-' . $imageFile['name'];
        move_uploaded_file($imageFile['tmp_name'], Producto::IMAGES_FOLDER . $filename);
        $producto->setImagen($filename);
      }
    }

    if ($producto->save()) {
      $_SESSION['success'] = 'Producto actualizado';
      header('Location: ' . BASE_URL . 'Productos/index');
      return;
    }
    $_SESSION['danger'] = 'Error al actualizar el registro';

    header('Location: ' . BASE_URL . '/Productos/edit&id=' . $producto->getId());
  }

  public function edit() {
    soloAdmin();
    $producto = self::encontrarProducto();
    $accion = 'update&id=' . $producto->getId();
    require_once __DIR__ . '/../views/productos/edit.php';
    require_once __DIR__ . '/../views/productos/form.php';
  }

  public function show() {
    $producto = self::encontrarProducto();
    require_once __DIR__ . '/../views/productos/show.php';
  }

  public function destroy() {
    soloAdmin();
    
    $producto = self::encontrarProducto();

    if ($producto->destroy()) {
      $_SESSION['danger'] = 'Hubo un error al eliminar el registro';
    } else {
      $_SESSION['success'] = 'Registro eliminado exitosamente';
    }

    header('Location: ' . BASE_URL . 'Productos/index');
  }

  public static function encontrarProducto() {
    if (!array_key_exists('id', $_GET)) {
      raise404();
    }
    $producto = Producto::find(intval($_GET['id']));

    if (!$producto) {
      raise404();
    }

    return $producto;
  }
}