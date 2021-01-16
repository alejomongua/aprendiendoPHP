<?php

// Clase abstracta
abstract class Dispositivo {
  public $encendido;

  abstract public function encender();
  
  abstract public function apagar();
}
