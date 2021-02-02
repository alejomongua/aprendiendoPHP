<?php

require_once __DIR__ . '/../../config/database/class/Conexion.php';

class Base {
  static protected $conexion;
  private $tableName;
  private $atributos;
  protected $id;

  public function __construct(string $tableName, array $atributos, $data=null) {
    if (self::$conexion == null) self::$conexion = new Conexion();

    $this->tableName = $tableName;
    $this->atributos = $atributos;
    if ($data) {
      for($i = 0; $i < count($this->atributos); $i++) {
        $atributo = $this->atributos[$i];

        if (isset($data[$atributo])) {
          $this->{$atributo} = $data[$atributo];
        }
      }
    }
  }

  public function save() {
    if ($this->id) {
      if (property_exists($this, 'actualizado_en')) {
        $this->actualizado_en = date('Y-m-d H:i:s');
      }
      $array = $this->toArray();
      unset($array['id']);
      if (!self::$conexion->actualizar($this->tableName, $this->id, $array)) {
        # throw new Exception('Error al actualizar');
        return false;
      }
    } else {
      if (property_exists($this, 'creado_en')) {
        $this->creado_en = date('Y-m-d H:i:s');
      }
      if (!self::$conexion->insertar($this->tableName, $this->toArray())){
        # throw new Exception('Error al insertar');
        return false;
      }
      
      $ultima = self::$conexion->last($this->tableName);
      $this->id = $ultima->id;
    }
    return true;
  }

  public function toArray() {
    $array = [];

    foreach($this->atributos as $atributo) {
      $array[$atributo] = $this->{$atributo};
    }

    return $array;
  }

  public function getId() {
    return $this->id;
  }

  public static function query(string $tabla, $opciones = null) {
    if (self::$conexion == null) self::$conexion = new Conexion();

    self::$conexion->query($tabla, $opciones);
  }

  public static function fetchOne() {
    return self::$conexion->fetchOne();
  }

  public static function findBy(string $tableName, array $atributos, string $field, $value) {
    Base::query($tableName, [
      'condiciones' => [
        $field => $value
      ],
      'limitar' => 1
    ]);

    $result = Base::fetchOne();

    $array = [];

    foreach($atributos as $atributo) {
      $array[$atributo] = $result->{$atributo};
    }

    return $array;
  }

  public static function filter($tableName, $atributos, $opciones = null) {
    Base::query($tableName, $opciones);

    $salida = [];

    while($result = Base::fetchOne()) {
      
      $array = [];
  
      foreach($atributos as $atributo) {
        $array[$atributo] = $result->{$atributo};
      }
  
      array_push($salida, $array);
    }

    return $salida;
  }
}