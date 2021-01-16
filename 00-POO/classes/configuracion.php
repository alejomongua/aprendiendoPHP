<?php

// Clases estáticas

class Configuracion {
  // Definición de constantes
  // No se usa el $
  const PROTOCOLO = 'http://';

  // atributos estáticos
  private static $color;
  private static $host;
  private static $identificador;

  public function getColor() {
    return self::$color;
  }

  public function setColor($color) {
    self::$color = $color;
  }

  public function getHost() {
    return self::$host;
  }

  public function setHost($host) {
    self::$host = $host;
  }

  public function getIdentificador() {
    return self::$identificador;
  }

  public function setIdentificador($identificador) {
    self::$identificador = $identificador;
  }

  // Métodos estáticos
  public static function printConfig() {
    // Se accede a las propiedades usando :: en vez de ->
    // se usa self en vez de $this
    echo 'Color '.self::$color."\n";
    echo 'Host '.self::$host."\n";
    echo 'Identificador '.self::$identificador."\n";
  }
}

