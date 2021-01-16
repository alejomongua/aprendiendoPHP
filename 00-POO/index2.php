<?php

require_once 'autoload.php';

$usuario = new Main\Usuario('alejomongua', 'yo@alejodeveloper.com');

$usuario->isLoggedIn();