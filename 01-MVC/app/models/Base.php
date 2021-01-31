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
    array_unshift($atributos, 'id');
    $this->atributos = $atributos;
    if ($data) {
      for($i = 0; $i < count($atributos); $i++) {
        $atributo = $atributos[$i];

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
        throw new Exception('Error al actualizar');
      }
    } else {
      if (property_exists($this, 'creado_en')) {
        $this->creado_en = date('Y-m-d H:i:s');
      }
      if (!self::$conexion->insertar($this->tableName, $this->toArray())){
        throw new Exception('Error al insertar');
      }
      
      $ultima = self::$conexion->last($this->tableName);
      $this->id = $ultima->id;
    }
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
}