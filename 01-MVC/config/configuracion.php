<?php

/*
 * En este archivo se guardan configuraciones generales del sistema
 */

// Se importa un archivo de secretos que no está en el repo
require_once __DIR__.'/secretos.php';
require_once __DIR__.'/constants.php';

// DATABASE

const CONFIG_DB_NAME = SECRETS_DB_NAME;
const CONFIG_DB_HOST = SECRETS_DB_HOST;
const CONFIG_DB_USER = SECRETS_DB_USER;
const CONFIG_DB_PASS = SECRETS_DB_PASS;
