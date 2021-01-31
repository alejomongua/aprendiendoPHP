<?php

require_once __DIR__ . '/Base.php';

class Usuario extends Base {
  protected $nombre;
  protected $apellidos;
  protected $password;
  protected $email;
  protected $rol;
  protected $imagen;

  public function __construct($data = null) {
    $atributos = [
      'nombre',
      'apellidos',
      'password',
      'email',
      'rol',
      'imagen',
    ];
    parent::__construct('usuarios', $atributos, $data);
  }

  public function getNombre() {
    return $this->nombre;
  }

  public function getApellidos() {
    return $this->apellido;
  }

  public function getRol() {
    return $this->rol;
  }

  public function getImagen() {
    return $this->imagen;
  }

  public function getPassword() {
    return $this->password;
  }

  public function getEmail() {
    return $this->email;
  }

  public function setNombre($nombre) {
    $this->nombre = Base::$conexion->escape_string($nombre);
  }

  public function setApellidos($apellidos) {
    $this->apellidos = Base::$conexion->escape_string($apellidos);
  }

  public function setRol($rol) {
    $this->rol = Base::$conexion->escape_string($rol);
  }

  public function setImagen($imagen) {
    $this->imagen = Base::$conexion->escape_string($imagen);
  }

  public function setPassword($password) {
    $this->password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 10]);
  }

  public function setEmail($email) {
    $this->email = Base::$conexion->escape_string($email);
  }
}
