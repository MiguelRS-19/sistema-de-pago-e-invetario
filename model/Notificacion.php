<?php 
include_once 'Conexion.php';
class Notificacion{
  var $objetos;
  var $acceso;
  public function __construct() {
    $db = new Conexion();
    $this->acceso = $db->pdo;
  }

  function notificacion(){
    $sql = "SELECT idcuenta,fecha_plazo,DATE_ADD(fecha_plazo, INTERVAL 7 DAY) AS fecha,CONCAT('S/',ct.deuda) as deuda,CONCAT('S/',ct.saldo) as saldo, concat(c.nombre,' ',c.apellido) as nombre,ct.estado as estatus FROM cuenta ct
    INNER JOIN cliente c on c.idcliente = ct.idcliente where ct.estado ='Pendiente' order by idcuenta desc";
    $query = $this->acceso->prepare($sql);
    $query->execute();
    $this->objetos = $query->fetchAll();
    return $this->objetos;
  }

}