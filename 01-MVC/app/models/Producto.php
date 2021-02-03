<?php

require_once __DIR__ . '/Base.php';

class Producto extends Base {
  const IMAGES_FOLDER = __DIR__ . '/../../uploads/images/productos/';

  protected $nombre;
  protected $categoria_id;
  protected $descripcion;
  protected $precio;
  protected $stock;
  protected $oferta;
  protected $creado_en;
  protected $imagen;

  static private $atributos = [
    'id',
    'nombre',
    'categoria_id',
    'descripcion',
    'precio',
    'stock',
    'oferta',
    'creado_en',
    'imagen',
  ];

  static private $tableName = 'productos';

  public function __construct($data = null) {
    parent::__construct(self::$tableName, self::$atributos, $data);
  }

  public function getNombre() {
    return $this->nombre;
  }

  public function setNombre($nombre) {
    $this->nombre = Base::$conexion->escapeString($nombre);
  }

  public function getDescripcion() {
    return $this->descripcion;
  }

  public function setDescripcion($descripcion) {
    $this->descripcion = Base::$conexion->escapeString($descripcion);
  }

  public function getPrecio() {
    return $this->precio;
  }

  public function setPrecio($precio) {
    $this->precio = intval($precio);
  }

  public function getStock() {
    return $this->stock;
  }

  public function setStock($stock) {
    $this->stock = intval($stock);
  }

  public function getOferta() {
    return $this->oferta;
  }

  public function setOferta($oferta) {
    $this->oferta = Base::$conexion->escapeString($oferta);
  }

  public function getCategoriaId() {
    return $this->categoria_id;
  }

  public function getCategoria() {
    return Categoria::find($this->categoria_id);
  }

  public function setCategoriaId($categoriaId) {
    $this->categoria_id = intval($categoriaId);
  }

  public function getImagen() {
    return $this->imagen;
  }

  public function setImagen($imagen) {
    $this->imagen = Base::$conexion->escapeString($imagen);
  }

  public static function find($id) {
    $result = parent::findBy(self::$tableName, self::$atributos, 'id', $id);
    return new Producto($result);
  }

  public function listado() {
    $result = parent::filter(self::$tableName, self::$atributos);

    $salida = array();
    for($i = 0; $i < count($result); $i++) {
      array_push($salida, new Producto($result[$i]));
    }

    return $salida;
  }
}
