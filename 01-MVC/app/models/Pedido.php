<?php

require_once __DIR__ . '/Base.php';

class Pedido extends Base {
  const IMAGES_FOLDER_RELATIVE_PATH = '/uploads/images/pedidos/';
  const IMAGES_FOLDER = __DIR__ . '/../..' . Pedido::IMAGES_FOLDER_RELATIVE_PATH;
  const IMAGES_FOLDER_URL = BASE_URL . Pedido::IMAGES_FOLDER_RELATIVE_PATH;

  protected $usuario_id;
  protected $departamento;
  protected $ciudad;
  protected $direccion;
  protected $coste;
  protected $estado;
  protected $creado_en;
  private $productos;

  static private $atributos = [
    'id',
    'usuario_id',
    'departamento',
    'ciudad',
    'direccion',
    'coste',
    'estado',
    'creado_en',
  ];

  static private $tableName = 'pedidos';

  public function __construct($data = null) {
    parent::__construct(self::$tableName, self::$atributos, $data);
    $this->productos = [];
    if ($this->id) {
      Base::query('lineas_pedidos', [
        'condiciones' => [
          'pedido_id' => $this->id
        ]
      ]);

      while ($linea = Base::fetchOne()) {
        $this->addProducto($linea->producto_id, $linea->unidades);
      }
    }
  }

  public function getDepartamento() {
    return $this->departamento;
  }

  public function setDepartamento($departamento) {
    $this->departamento = Base::$conexion->escapeString($departamento);
  }

  public function getCiudad() {
    return $this->ciudad;
  }

  public function setCiudad($ciudad) {
    $this->ciudad = Base::$conexion->escapeString($ciudad);
  }

  public function getCoste() {
    return intval($this->coste);
  }

  public function setCoste($coste) {
    $this->coste = intval($coste);
  }

  public function getDireccion() {
    return $this->direccion;
  }

  public function setDireccion($direccion) {
    $this->direccion = intval($direccion);
  }

  public function getEstado() {
    return $this->estado;
  }

  public function setEstado($estado) {
    $this->estado = Base::$conexion->escapeString($estado);
  }

  public function getFecha() {
    return $this->creado_en;
  }

  public function getUsuarioId() {
    return $this->usuario_id;
  }

  public function getUsuario() {
    return Usuario::find($this->usuario_id);
  }

  public function setUsuarioId($usuarioId) {
    $this->usuario_id = intval($usuarioId);
  }

  public function getProductos() {
    $productos = [];
    foreach($this->productos as $producto => $cantidad) {
      array_push($productos, Producto::find($producto));
    }

    return $productos;
  }

  public function getListaProductos() {
    return $this->productos;
  }

  public function addProducto(int $nuevoProductoId, $cantidad) {
    $this->productos[$nuevoProductoId] = $cantidad;
  }

  public function save() {
    $result = parent::save();

    if (!$result) {
      return false;
    }

    foreach($this->productos as $producto => $cantidad) {
      $insertar = [
        'pedido_id' => $this->id,
        'producto_id' => $producto,
        'unidades' => $cantidad,
      ];
      $result = Base::insertar('lineas_pedidos', $insertar);

      if (!$result) {
        return false;
      }
    }

    return true;
  }

  public static function find(int $id) {
    $result = parent::findBy(self::$tableName, self::$atributos, 'id', $id);
    if ($result) {
      return new Pedido($result);
    }
  }

  public static function findByUsuarioId(int $idUsuario) {
    return Pedido::listado([
      'condiciones' => [
        'usuario_id' => $idUsuario
      ]
    ]);
  }

  public static function listado($opciones = null) {
    $result = parent::filter(self::$tableName, self::$atributos, $opciones);

    $salida = array();
    for($i = 0; $i < count($result); $i++) {
      array_push($salida, new Pedido($result[$i]));
    }

    return $salida;
  }
}
