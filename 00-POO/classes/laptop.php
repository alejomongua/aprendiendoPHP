<?php

require_once('ordenador.php');

// Implementa una interface
class Laptop implements Ordenador {
  public $encendido;

  public function encender() {
    $this->encendido = true;
  }
  
  public function apagar(){
    $this->encendido = false;
  }

  public function reiniciar() {
    $this->encendido = false;
    $this->encendido = true;
  }
  
  public function instalarPrograma(){
    echo 'Instalando programa'."\n";
  }

}
