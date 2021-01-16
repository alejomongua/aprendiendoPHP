<?php

require_once('utilidades.php');

// Sintaxis de clases en PHP

// Definición de la clase
class Persona {
  // Se invoca un trait para tener disponibles sus métodos
  use Utilidades;
  // Propiedades, precedidas por su visibilidad
  public $nombre;
  // Valor por defecto (mala práctica, debe hacerse en el constructor)
  public $tipo_documento = 'C';
  // Propiedades protegidas, son accesibles desde las clases que hereden
  protected $genero;
  // Propiedades privadas, únicamente accesibles dentro de esta instancia
  private $sueldo;
  
  // Métodos:
  // Constructor, atajo en VSCode: con
  // Un argumento tipado y otro argumento con valor por defecto,
  // el valor por defecto únicamente puede ser null
  public function __construct(String $nombre, $sueldo = null) {
    $this->sueldo = $sueldo;
    $this->nombre = $nombre;
  }

  // Destructor, se ejecuta automáticamente 
  public function __destruct() {
    echo 'Chao '.$this->nombre."\n";
  }

  // toString debe retornar un string, esta función es llamada
  // automáticamente al convertir implícitamente en string
  public function toString() {
    return $this->nombre;
  }

  // Esta función se llama cuando se intenta ejecutar un
  // método que no exista
  public function __call($name, $arguments) {
    return 'No existe el método '.$name;
  }

  // atajo con VSCode: con
  // this es la palabra reservada para referirse a esta instancia
  public function getSueldo() {
    return $this->sueldo;
  }
};
