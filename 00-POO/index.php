<?php
// No es necesario cerrar la etiqueta php, pero se puede cerrar con
// signo de interrogación seguido de mayor que

// La función built-in header permite agregar cabeceras a la respuesta
// En este caso quiero que la respuesta sea en texto plano y no html
header('Content-type: text/plain');

// Este es el 'import' de php. Se usa require_once y no require para
// que lo importe una sola vez así se intente importar varias veces en
// una misma petición
/*
require_once 'programador.php';
require_once 'configuracion.php';
require_once 'computador.php';
*/

// Se usa el autoloader en vez de cargar cada clase
require_once 'autoload.php';

// Instancio la clase con una sintaxis parecida a la de javascript
$yo = new Persona('Luis');
$otro = new Persona('Pepito', 100000);

// Acceder a las propiedades como en c++
// Las comillas dobles permiten interpolar las variables, como en Ruby
echo "$yo->nombre\n";
// Pero la interpolación no funciona con funciones
echo $otro->getSueldo()."\n";

// var_dump es una función built-in que sirve para depurar, me vuelca
// la información de la variable en la pantalla
var_dump($yo);


// Instancia un programador
$prog = new Programador(['php', 'javascript', 'ruby', 'python', 'go']);

$prog->mostrarLenguajes();

// Se llaman los métodos de la clase estática
Configuracion::setColor('blanco');
Configuracion::setHost('localhost');
Configuracion::setIdentificador(100);

// También se puede instanciar
$configuracion = new Configuracion();
$configuracion::printConfig();

// Si creo otra instancia voy a modificar todas las instancias
$configuracion2 = new Configuracion();
Configuracion::setColor('negro');
$configuracion::printConfig();

// Las constantes se acceden igual que los atriburos estáticos
echo Configuracion::PROTOCOLO;
echo Configuracion::getHost();

// También se puede acceder a las constantes desde la instancia:
echo "\n\n";
echo $configuracion2::PROTOCOLO;
echo $configuracion2::getHost();
echo "\n";

// Se instancia una clase que hereda de clase abstracta
$computador = new Computador();
$computador->encender();
if ($computador->encendido){
  echo "Computador encendido";
} else {
  echo "Computador apagado";
}

echo "\n\n";

// Capturar una excepción
try {
  // Arrojar una excepción
  throw new Exception('Error para capturar');
} catch (Exception $error) {
  echo "Ha habido un error: $error\n";
} finally {
  echo "Acabó con o sin errores\n";
}