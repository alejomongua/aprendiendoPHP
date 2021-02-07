<?php

require_once __DIR__ . '/../models/Usuario.php';

class UsuariosController {
  private function renderView(string $view) {
    require_once __DIR__ . '/../views/usuarios/' . $view . '.php';
  }

  public function index() {
    echo 'Controlador de usuarios, listado [TO DO]';
  }

  public function new() {
    $this->renderView('new');
  }

  public function create() {
    $usuario = new Usuario();
    if (!array_key_exists('nombre', $_POST) || $_POST['nombre'] === '') {
      $_SESSION['danger'] = 'Registro fallido, nombre es un campo obligatorio';
    }
    if (!array_key_exists('apellidos', $_POST) || $_POST['apellidos'] === '') {
      $_SESSION['danger'] = 'Registro fallido, apellidos es un campo obligatorio';
    }
    if (!array_key_exists('email', $_POST) || $_POST['email'] === '') {
      $_SESSION['danger'] = 'Registro fallido, email es un campo obligatorio';
    }
    if (!array_key_exists('password', $_POST) || $_POST['password'] === '') {
      $_SESSION['danger'] = 'Registro fallido, password es un campo obligatorio';
    }

    if (!array_key_exists('danger', $_SESSION)) {
      $usuario->setNombre($_POST['nombre']);
      $usuario->setApellidos($_POST['apellidos']);
      $usuario->setEmail($_POST['email']);
      $usuario->setPassword($_POST['password']);

      if (array_key_exists('rol', $_POST)) {
        $usuario->setRol($_POST['rol']);
      }
      if (array_key_exists('imagen', $_POST)) {
        $usuario->setImagen($_POST['imagen']);
      }

      if ($usuario->save()) {
        $_SESSION['success'] = 'Registro exitoso';
        header('Location: ' . BASE_URL);
        return;
      }
      $_SESSION['danger'] = 'Registro fallido';
    }

    header('Location: ' . BASE_URL . '/Usuarios/new');
  }

  public function login() {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
      if (array_key_exists('usuario', $_SESSION) && $_SESSION['usuario']) {
        $_SESSION['danger'] = 'El usuario ya está identificado';
        header('Location:' . BASE_URL);
        return;
      }

      $this->renderView('login');
      return;
    }

    # Si es post, procese el login
    if (!array_key_exists('email', $_POST) || !array_key_exists('password', $_POST) ||
        $_POST['email'] === '' || $_POST['password'] === '') {
      $_SESSION['danger'] = 'Ingrese el correo electrónico y la contraseña';
      header('Location:' . BASE_URL . 'Usuarios/login');
      return;
    }

    $usuario = Usuario::findByEmail($_POST['email']);

    if (!$usuario) {
      $_SESSION['danger'] = 'Combinación de correo/contraseña incorrectos';
      header('Location:' . BASE_URL . 'Usuarios/login');
      return;
    }

    $login = $usuario->verifyLogin($_POST['password']);

    if (!$login) {
      $_SESSION['danger'] = 'Combinación de correo/contraseña incorrectos';
      header('Location:' . BASE_URL . 'Usuarios/login');
      return;
    }

    session_regenerate_id(true);
    $_SESSION['success'] = 'Bienvenido ' . $usuario->getNombre();
    $_SESSION['usuario'] = serialize($usuario);
    if (array_key_exists('retornar_a', $_SESSION)) {
      header('Location:' . $_SESSION['retornar_a']);
      unset($_SESSION['retornar_a']);
      return;
    }
    header('Location:' . BASE_URL);
  }

  public function logout() {
    if (array_key_exists('usuario', $_SESSION) && $_SESSION['usuario']) {
      session_regenerate_id(true);
      unset($_SESSION['usuario']);
      $_SESSION['success'] = 'Ha cerrado su sesión';
    } else {
      $_SESSION['danger'] = 'No hay sesión iniciada';
    }
    header('Location:' . BASE_URL);
  }
}