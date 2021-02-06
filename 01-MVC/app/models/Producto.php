<?php

require_once __DIR__ . '/Base.php';

class Producto extends Base {
  const IMAGES_FOLDER_RELATIVE_PATH = '/uploads/images/productos/';
  const IMAGES_FOLDER = __DIR__ . '/../..' . Producto::IMAGES_FOLDER_RELATIVE_PATH;
  const IMAGES_FOLDER_URL = BASE_URL . Producto::IMAGES_FOLDER_RELATIVE_PATH;

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
    return intval($this->precio);
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

  public function getImagenUrl() {
    return Producto::IMAGES_FOLDER_URL . $this->imagen;
  }

  public function setImagen($imagen) {
    $this->imagen = Base::$conexion->escapeString($imagen);
  }

  public function show() {
    
    echo '<a href="' . BASE_URL . 'Productos/show&id=' . $this->id . '">';
    echo '<div class="box">';
    echo '<article class="media">';
    echo '<div class="media-left">';
    if ($this->imagen) {
      echo '<figure class="image is-128x128 is-clipped">';
      echo '<img src="' . $this->getImagenUrl() . '" alt="Image">';
      echo '</figure>';
    }
    echo '</div>';
    echo '<div class="media-content">';
    echo '<div class="content">';
    echo '<p>';
    echo '<strong>' . $this->nombre . '</strong> <span>' . $this->precio . '</span> <small class="is-italic">' . $this->stock . ' disponibles</small>';
    echo '<br>';
    echo $this->descripcion;
    echo '</p>';
    echo '</div>';
    echo '</div>';
    echo '</article>';
    echo '</div>';
    echo '</a>';
  }

  public static function find($id) {
    $result = parent::findBy(self::$tableName, self::$atributos, 'id', $id);
    if ($result) {
      return new Producto($result);
    }
  }

  public static function listado($opciones = null) {
    $result = parent::filter(self::$tableName, self::$atributos, $opciones);

    $salida = array();
    for($i = 0; $i < count($result); $i++) {
      array_push($salida, new Producto($result[$i]));
    }

    return $salida;
  }

  public static function randomSample(int $limit = 10) {
    return self::listado(['ordenar' => 'random', 'limitar' => $limit]);
  }
}
