<?php

// Se agregan las clases para poder usarlas sin el namespace
use Main\Usuario;

require_once 'autoload.php';

$usuario = new Usuario('alejomongua', 'yo@alejodeveloper.com');

$usuario->login();
$usuario->isLoggedIn();