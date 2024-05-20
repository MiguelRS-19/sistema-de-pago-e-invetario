<?php
class Conexion{
  private $servidor = "localhost";
  private $db = "dbservicio1";//"u395705038_servicio_telec"
  private $puerto = 3306;
  private $charset = 'utf8';
  private $usuario = "root";//"u395705038_servicio_telec"
  private $contrasena = "";//"Telecomunicacion123@"
  public $pdo = null;
  private $atributos = [PDO::ATTR_CASE=>PDO::CASE_LOWER,PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,PDO::ATTR_ORACLE_NULLS=>PDO::NULL_EMPTY_STRING,PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_OBJ];

  function __construct(){
    $this->pdo = new PDO("mysql:dbname={$this->db}; host={$this->servidor}; port={$this->puerto}; charset={$this->charset}", $this->usuario, $this->contrasena, $this->atributos);
  }

}
