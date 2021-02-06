<?php

require_once __DIR__ . '/Base.php';
require_once __DIR__ . '/Producto.php';

class Categoria extends Base {
  protected $nombre;

  static private $atributos = [
    'id',
    'nombre',
  ];

  static private $tableName = 'categorias';

  public function __construct($data = null) {
    parent::__construct(self::$tableName, self::$atributos, $data);
  }

  public function getNombre() {
    return $this->nombre;
  }

  public function setNombre($nombre) {
    $this->nombre = Base::$conexion->escapeString($nombre);
  }

  public function productos() {
    return Producto::listado(['condiciones' => ['categoria_id' => $this->id]]);
  }

  public static function find($id) {
    $result = parent::findBy(self::$tableName, self::$atributos, 'id', $id);
    return new Categoria($result);
  }

  public static function listado() {
    $result = parent::filter(self::$tableName, self::$atributos);

    $salida = array();
    for($i = 0; $i < count($result); $i++) {
      array_push($salida, new Categoria($result[$i]));
    }

    return $salida;
  }
}
