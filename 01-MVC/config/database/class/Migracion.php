<?php

require_once __DIR__ . '/Conexion.php';
require_once __DIR__ . '/../../constants.php';

class Migracion {
  /*
   * Al usar la propiedad $conexion como variable de instancia se tiene un
   * problema potencial no se como se va a comportar si varios usuarios hacen
   * consultas diferentes al mismo tiempo.
   * Creería yo que no importa y que cada petición crea sus propias instancias
   * de la aplicación, pero desconozco el funcionamiento interno de PHP.
   * Solo se que esto lo hago con fines didácticos, porque para cosas más
   * "reales" usaré un framework.
   */
  static private $conexion;
  static private $verificado;
  public $id;
  public $titulo;
  public $creada_en;

  public function __construct(array $campos) {
    if (self::$conexion == null) self::$conexion = new Conexion();

    // Detectar si la tabla de migraciones existe
    self::comprobarTabla();

    $this->id = array_key_exists('id', $campos) ? $campos['id'] : null;
    $this->titulo = array_key_exists('titulo', $campos) ? $campos['titulo'] : null;
    $this->creada_en = array_key_exists('creada_en', $campos) ? $campos['creada_en'] : null;
  }

  static public function comprobarTabla() {
    if (self::$verificado) return;

    if (self::$conexion == null) self::$conexion = new Conexion();

    self::$conexion->query('information_schema.tables', array(
      'condiciones' => array(
        'table_schema' => CONFIG_DB_NAME,
        'table_name' => 'migraciones',
      ),
      'limitar' => 1
    ));
    
    if (!self::$conexion->fetchOne()) {
      // Si no existe hay que crearla
      $sql = file_get_contents (__DIR__ . '/../crear_tabla_migraciones.sql');
      self::$conexion->sqlQuery($sql);
    }

    self::$verificado = true;
  }

  public static function listar() {
    if (self::$conexion == null) self::$conexion = new Conexion();

    self::$conexion->query('migraciones');

    $salida = array();
    while ($object = self::$conexion->fetchOne()) {
      array_push($salida, new Migracion(array(
        'id' => $object->id,
        'titulo' => $object->titulo,
        'creada_en' => $object->creada_en
      )));
    }

    return $salida;
  }

  public static function last() {
    if (self::$conexion == null) self::$conexion = new Conexion();

    $ultimo = self::$conexion->last('migraciones');

    if ($ultimo) {
      return new Migracion(array(
        'id' => $ultimo->id,
        'titulo' => $ultimo->titulo,
        'creada_en' => $ultimo->creada_en
      ));
    }

    return null;
  }

  public static function encontrarPorTitulo(string $titulo) {
    if (self::$conexion == null) self::$conexion = new Conexion();

    self::$conexion->query('migraciones', array(
      'limitar' => 1,
      'condiciones' => array(
        'titulo' => $titulo
      ),
    ));

    if ($objeto = self::$conexion->fetchOne()) {
      return new Migracion(array(
        'id' => $objeto->id,
        'titulo' => $objeto->titulo,
        'creada_en' => $objeto->creada_en
      ));
    }

    return null;
  }

  public function ejecutar() {
    $file = MIGRATIONS_DIR . "/$this->titulo.sql";
    $sql = file_get_contents($file);
    self::$conexion->sqlQuery($sql);
    $this->guardar();
  }

  private function guardar() {
    if ($this->id) {
      self::$conexion->actualizar('migraciones', $this->id, array(
        'titulo' => $this.titulo
      ));
    } else {
      $this->creada_en = date('Y-m-d H:i:s');
      self::$conexion->insertar('migraciones', array(
        'titulo' => $this->titulo,
        'creada_en' => $this->creada_en,
      ));
      $ultima = self::$conexion->last('migraciones');
      $this->id = $ultima->id;
    }
  }
}