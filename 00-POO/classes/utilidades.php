<?php

// Traits: métodos comunes que se pueden compartir entre clases
trait Utilidades {
  public function mostrarNombre() {
    echo $this->nombre."\n";
  }
}

// Para acceder a las utilidades se puede hacer uso de la
// palabra reservada use