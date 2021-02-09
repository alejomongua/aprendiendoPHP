<?php

require_once __DIR__ . '/Base.php';

class Usuario extends Base {
  protected $nombre;
  protected $apellidos;
  protected $password;
  protected $email;
  protected $rol;
  protected $imagen;

  static private $atributos = [
    'id',
    'nombre',
    'apellidos',
    'password',
    'email',
    'rol',
    'imagen',
  ];

  static private $tableName = 'usuarios';

  public function __construct($data = null) {
    parent::__construct(self::$tableName, self::$atributos, $data);
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

  public function getNombreCompleto() {
    return $this->nombre . ' ' . $this->apellido;
  }

  public function setNombre($nombre) {
    $this->nombre = Base::$conexion->escapeString($nombre);
  }

  public function setApellidos($apellidos) {
    $this->apellidos = Base::$conexion->escapeString($apellidos);
  }

  public function setRol($rol) {
    $this->rol = Base::$conexion->escapeString($rol);
  }

  public function setImagen($imagen) {
    $this->imagen = Base::$conexion->escapeString($imagen);
  }

  public function setPassword($password) {
    $this->password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 10]);
  }

  public function setEmail($email) {
    $this->email = Base::$conexion->escapeString($email);
  }

  public static function findByEmail($email) {
    $result = parent::findBy(self::$tableName, self::$atributos, 'email', $email);

    return new Usuario($result);
  }

  public static function find($id) {
    $result = parent::findBy(self::$tableName, self::$atributos, 'id', $id);
    return new Usuario($result);
  }

  public function verifyLogin(string $password) {
    return password_verify($password, $this->password);
  }
}
