<?php

require_once __DIR__ . '/../../configuracion.php';

const ALPHANUMERIC_REGEX = '/^[a-zA-Z]+[a-zA-Z0-9._]+$/';

function checkTableName(string $tabla) {
  if (!preg_match(ALPHANUMERIC_REGEX, $tabla)) {
    throw new Exception('El nombre de la tabla no es válido');
  }
}

class Conexion {
  private $conexion;
  private $currentQuery;

  public function __construct() {
    $this->conexion = new mysqli(CONFIG_DB_HOST, CONFIG_DB_USER, CONFIG_DB_PASS, CONFIG_DB_NAME);

    $this->sqlQuery("set names 'utf8'");
    $this->currentQuery = null;
  }

  /*
   * Esta función sirve para ejecutar consultas simples en una sola tabla
   * la clausula WHERE únicamente acepta igualdad
   */
  public function query(string $tabla, $opciones = null) {
    // Sanitizar las entradas

    checkTableName($tabla);

    if (is_null($opciones)) {
      $opciones = array();
    }

    $camposSanitizados = array();
    if (array_key_exists('campos', $opciones) && count($opciones['campos'])) {
      foreach ($opciones['campos'] as $campo) {
        if (preg_match(ALPHANUMERIC_REGEX, $campo)) {
          array_push($camposSanitizados, $campo);
        }
      }
    }

    $sqlcampos = count($camposSanitizados) ? implode(', ', $camposSanitizados) : '*';
    $sqlquery = "select $sqlcampos from $tabla";

    // where
    $camposSanitizados = array();
    if (array_key_exists('condiciones', $opciones) && count($opciones['condiciones'])) {
      foreach ($opciones['condiciones'] as $condicion => $valor) {
        if (preg_match(ALPHANUMERIC_REGEX, $condicion)) {
          if (is_string($valor)) {
            array_push($camposSanitizados, "$condicion = '" .
                       $this->conexion->escape_string($valor) . "'");
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

    if (array_key_exists('ordenar', $opciones) && count($opciones['ordenar'])) {
      foreach ($opciones['ordenar'] as $orden => $modo) {
        if (preg_match(ALPHANUMERIC_REGEX, $orden)) {
          array_push($camposSanitizados, "$orden " . 
                     (strtolower($modo) === 'desc' ? 'desc' : 'asc'));
        }
      }
    }

    if (count($camposSanitizados)) {
      $sqlquery .= ' order by ' . implode(', ', $camposSanitizados);
    }

    if (array_key_exists('limitar', $opciones) && is_int($opciones['limitar'])) {
      $sqlquery .= ' limit ' . $opciones['limitar'];
    }

    $this->sqlQuery($sqlquery);
  }

  /*
   * Función genérica para ejecutar una consulta 
   */
  public function sqlQuery(string $query) {
    if (DEBUG_MODE_ON) {
      echo $query . PHP_EOL;
    }

    $this->currentQuery = $this->conexion->query($query);
  }

  /*
   * Trae un registro de la última consulta ejecutada
   */
  public function fetchOne() {
    if ($this->currentQuery) {
      return $this->currentQuery->fetch_object();
    }

    return null;
  }

  /*
   * Trae un solo elemento de una tabla dada, con el ID
   */
  public function find(string $tabla, int $id) {
    checkTableName($tabla);

    $this->sqlQuery("select * from $tabla where id = $id limit 1");
    return $this->fetchOne();
  }

  /*
   * Trae el último elemento de una tabla dada
   */
  public function last(string $tabla) {
    checkTableName($tabla);

    $this->sqlQuery("select * from $tabla order by id desc limit 1");
    return $this->fetchOne();
  }

  /*
   * Cuenta la cantidad de registros en una tabla
   */
  public function count(string $tabla) {
    checkTableName($tabla);

    $this->sqlQuery("select count(id) as count from $tabla");
    $resultado = $this->fetchOne();
    return $resultado['count'];
  }

  public function actualizar(string $tabla, int $id, array $campos) {
    checkTableName($tabla);

    $sqlquery = "update $tabla";

    $camposSanitizados = array();
    if (count($campos)) {
      foreach ($campos as $campo => $valor) {
        if (preg_match(ALPHANUMERIC_REGEX, $campo)) {
          if (is_string($valor)) {
            array_push($camposSanitizados, "$campo = '" .
                       $this->conexion->escape_string($valor) . "'");
            continue;
          }
          array_push($camposSanitizados, "$campo = $valor");
        }
      }
    }

    if (count($camposSanitizados)) {
      $sqlquery .= ' set ' . implode(', ', $camposSanitizados);
    }

    $sqlquery .= " where id = $id";
    $this->sqlQuery($sqlquery);
  }

  public function insertar(string $tabla, array $campos) {
    checkTableName($tabla);

    $sqlquery = "insert into $tabla ";

    $camposSanitizados = array();
    $nombresCampos = array();
    if (count($campos)) {
      foreach ($campos as $campo => $valor) {
        if (preg_match(ALPHANUMERIC_REGEX, $campo)) {
          array_push($nombresCampos, $campo);
          if (is_string($valor)) {
            array_push($camposSanitizados, "'" . $this->conexion->escape_string($valor) . "'");
            continue;
          }
          array_push($camposSanitizados, $valor);
        }
      }
    }

    if (count($camposSanitizados)) {
      $sqlquery .= '(' . implode(', ', $nombresCampos) . ') ';
      $sqlquery .= 'values (' . implode(', ', $camposSanitizados) . ')';
    }

    $this->sqlQuery($sqlquery);
  }
}
