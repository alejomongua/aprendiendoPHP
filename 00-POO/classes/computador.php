<?php
require_once('dispositivo.php');
// Clase abstracta
class Computador extends Dispositivo{
  public $encendido;

  public function encender() {
    $this->encendido = true;
  }
  
  public function apagar(){
    $this->encendido = false;
  }
}
