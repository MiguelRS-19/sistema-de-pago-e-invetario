<?php 
include_once 'Conexion.php';
class Historial{
  var $objetos;
  var $acceso;
  public function __construct() {
    $db = new Conexion();
    $this->acceso = $db->pdo;
  }


  function ver($id){
    $sql = "SELECT idhistorial as id,concat(u.nombre,' ',u.apellidos) as pagador,CASE 
    WHEN MONTH(fecha_consumo) = 1 THEN DATE_FORMAT(fecha_consumo, 'ENERO - %Y')
    WHEN MONTH(fecha_consumo) = 2 THEN DATE_FORMAT(fecha_consumo, 'FEBRERO - %Y')
    WHEN MONTH(fecha_consumo) = 3 THEN DATE_FORMAT(fecha_consumo, 'MARZO - %Y')
    WHEN MONTH(fecha_consumo) = 4 THEN DATE_FORMAT(fecha_consumo, 'ABRIL - %Y')
    WHEN MONTH(fecha_consumo) = 5 THEN DATE_FORMAT(fecha_consumo, 'MAYO - %Y')
    WHEN MONTH(fecha_consumo) = 6 THEN DATE_FORMAT(fecha_consumo, 'JUNIO - %Y')
    WHEN MONTH(fecha_consumo) = 7 THEN DATE_FORMAT(fecha_consumo, 'JULIO - %Y')
    WHEN MONTH(fecha_consumo) = 8 THEN DATE_FORMAT(fecha_consumo, 'AGOSTO - %Y')
    WHEN MONTH(fecha_consumo) = 9 THEN DATE_FORMAT(fecha_consumo, 'SEPTIEMBRE - %Y')
    WHEN MONTH(fecha_consumo) = 10 THEN DATE_FORMAT(fecha_consumo, 'OCTUBRE - %Y')
    WHEN MONTH(fecha_consumo) = 11 THEN DATE_FORMAT(fecha_consumo, 'NOVIEMBRE - %Y')
    WHEN MONTH(fecha_consumo) = 12 THEN DATE_FORMAT(fecha_consumo, 'DICIEMBRE - %Y')
  END as consumo,CONCAT('S/ ',ingreso) as cancelar FROM historial ht 
  inner join usuario u on ht.idusuario = u.iduser WHERE idusuario =:id;" ;
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':id'=>$id));
    $this->objetos = $query->fetchAll();
    return $this->objetos;
  }

  function calcular_ingreso($id){
    $sql = "SELECT CONCAT('S/ ',sum(ingreso)) as total FROM historial ht 
    inner join usuario u on ht.idusuario = u.iduser WHERE idusuario =:id;" ;
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':id'=>$id));
    $this->objetos = $query->fetchAll();
    return $this->objetos;
  }


}