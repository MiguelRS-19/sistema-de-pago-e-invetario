<?php 
include_once 'Conexion.php';
class Empresa{
  var $objetos;
  var $acceso;
  public function __construct() {
    $db = new Conexion();
    $this->acceso = $db->pdo;
  }

   //Funcion obtener empresa
  function empresa(){
    $sql = "SELECT nombre_comercial as nombre, direccion, telefono,correo,igv FROM empresa;" ;
    $query = $this->acceso->prepare($sql);
    $query->execute();
    $this->objetos = $query->fetchAll();
    return $this->objetos;
  }


}