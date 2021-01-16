<?php

// Se agregan las clases para poder usarlas sin el namespace
// Se le puede poner un alias a la clase
use Main\Usuario as Alias;

require_once 'autoload.php';

$usuario = new Alias('alejomongua', 'yo@alejodeveloper.com');

$usuario->login();
$usuario->isLoggedIn();
echo '<br />';
$usuario->logout();
$usuario->isLoggedIn();

echo '<h1>Información</h1>';
$usuario->classInfo();
