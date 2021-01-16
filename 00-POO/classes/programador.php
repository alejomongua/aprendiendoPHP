<?php

require_once('persona.php');

// Sintaxis para heredar otra clase
class Programador extends Persona {
  public $lenguajes;

  public function __construct(Array $lenguajes) {
    $this->lenguajes = $lenguajes;
    parent::__construct('Programador');
  }

  public function mostrarLenguajes() {
    echo "Sabe estos lenguajes: \n";
    for ($i = 0; $i < count($this->lenguajes); $i++) {
      echo '* '.$this->lenguajes[$i]."\n";
    }
  }
}
