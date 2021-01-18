<?php

defined('APP_RAN') or die();

require_once 'configuraciones.php';

const ALPHANUMERIC_REGEX = '/^[a-zA-Z]+[a-zA-Z0-9._]+$/';

class database
{
  private $conexion;
  private $currentQuery;

  public function __construct()
  {
    $this->conexion = new mysqli(CONFIG_DB_HOST, CONFIG_DB_USER, CONFIG_DB_PASS, CONFIG_DB_NAME);

    $this->conexion->query("set names 'utf8'");
    $this->currentQuery = null;
  }

  /*
   * Esta función sirve para ejecutar consultas simples en una sola tabla
   * la clausula WHERE únicamente acepta igualdad
   */
  public function query($tabla, $campos = null, $condiciones = null, $ordenar = null)
  {
    // Sanitizar las entradas
    if (!preg_match(ALPHANUMERIC_REGEX, $tabla)) {
      throw new Exception('El nombre de la tabla no es válido');
    }

    $camposSanitizados = array();
    if ($campos && count($campos)) {
      foreach ($campos as $campo) {
        if (preg_match(ALPHANUMERIC_REGEX, $campo)) {
          array_push($camposSanitizados, $campo);
        }
      }
    }

    $sqlcampos = count($camposSanitizados) ? implode(', ', $camposSanitizados) : '*';
    $sqlquery = "select $sqlcampos from $tabla";

    // where
    $camposSanitizados = array();
    if ($condiciones and count($condiciones)) {
      foreach ($condiciones as $condicion => $valor) {
        if (preg_match(ALPHANUMERIC_REGEX, $condicion)) {
          if (is_string($valor)) {
            array_push($camposSanitizados, "$condicion = '" . $this->conexion->escape_string($valor) . "'");
            continue;
          }
          array_push($camposSanitizados, "$condicion = $valor");
        }
      }
    }

    if (count($camposSanitizados)) {
      $sqlquery .= ' where ' . implode(' and ', $camposSanitizados);
    }

    // order by
    $camposSanitizados = array();

    if ($ordenar and count($ordenar)) {
      foreach ($ordenar as $orden => $modo) {
        if (preg_match(ALPHANUMERIC_REGEX, $orden)) {
          array_push($camposSanitizados, "$orden " . (strtolower($modo) === 'desc' ? 'desc' : 'asc'));
        }
      }
    }

    if (count($camposSanitizados)) {
      $sqlquery .= ' order by ' . implode(', ', $camposSanitizados);
    }

    $this->currentQuery = $this->conexion->query($sqlquery);
  }

  /*
   * Función genérica para ejecutar una consulta 
   */
  public function sqlQuery(string $query)
  {
    $this->currentQuery = $this->conexion->query($query);
  }

  /*
   * Trae un registro de la última consulta ejecutada
   */
  public function fetchOne()
  {
    if (!$this->currentQuery) {
      throw new Exception('No hay consulta en curso');
    }

    return $this->currentQuery->fetch_object();
  }
}
