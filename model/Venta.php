<?php 
include_once 'Conexion.php';
class Venta{
  var $objetos;
  var $acceso;
  public function __construct() {
    $db = new Conexion();
    $this->acceso = $db->pdo;
  }

  function crear($id,$total,$fecha,$vendedor){
    $sql = "INSERT INTO venta(fecha,total,vendedor,idcliente) VALUES(:fecha,:total,:vendedor,:cliente)";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(
      ':fecha'=>$fecha,
      ':total'=>$total,
      ':vendedor'=>$vendedor,
      ':cliente'=>$id,
    ));
  }

  function ultima_venta(){
    $sql = "SELECT MAX(idventa) as ultima_venta FROM venta" ;
    $query = $this->acceso->prepare($sql);
    $query->execute();
    $this->objetos = $query->fetchAll();
    return $this->objetos;
  }

  function borrar($idventa){
    $sql = "DELETE FROM venta WHERE idventa=:idventa";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(
      ':idventa'=>$idventa
    ));
    //echo 'delete';
  }

  //Funcion de venta
  function obtener_venta(){
    $sql = "SELECT v.idventa as id,fecha, cl.numero as dni, CONCAT(cl.nombre,' ',cl.apellido) as cliente,
    CONCAT('S/',v.total) as total,concat(u.nombre,' ',u.apellido) as vendedor FROM venta v
    INNER JOIN cliente cl on cl.idcliente = v.idcliente 
    INNER JOIN usuario u on u.idusuario = v.vendedor ORDER BY v.fecha DESC";
    $query = $this->acceso->prepare($sql);
    $query->execute();
    $this->objetos = $query->fetchAll();
    return $this->objetos;
  }

  function encontrar_cliente($id){
    $sql = "SELECT * FROM cliente where idcliente=:id;";
    $query = $this->acceso->prepare($sql);
    $variables = array(
      'id'=>$id
    );
    $query->execute($variables);
    $this->objetos = $query->fetchAll();
    return $this->objetos;
  }

  function obtener_id($id_venta){
    $sql = "SELECT v.idventa as id,fecha, cl.numero as dni, CONCAT(cl.nombre,' ',cl.apellido) as cliente
    ,concat(u.nombre,' ',u.apellido) as vendedor,total FROM venta v
    INNER JOIN cliente cl on cl.idcliente = v.idcliente 
    INNER JOIN usuario u on u.idusuario = v.vendedor WHERE idventa =:id" ;
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':id'=>$id_venta));
    $this->objetos = $query->fetchAll();
    return $this->objetos;
  }


}