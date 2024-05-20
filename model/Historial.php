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
    $sql = "SELECT idhistorial as id,concat(c.nombre,' ',c.apellido) as cliente,
    ht.descripcion as descripcion,CASE 
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
  END as consumo,ht.fecha_pago as fecha,CONCAT('S/',deuda) as deuda, CONCAT('S/',abono) as abono,
  CONCAT('S/',saldo) as saldo,CONCAT('S/',vuelto) as vuelto,
  concat(u.nombre,' ',u.apellido) as usuario,tp.nombre as medios,ht.estado as estado, ht.Opcion as opcion FROM historial ht 
  inner join cliente c on ht.idcliente = c.idcliente
  inner join tipo_pago tp on tp.idpago = ht.idpago
  inner join usuario u on ht.idusuario = u.idusuario WHERE c.idcliente=:id;" ;
    $query = $this->acceso->prepare($sql);
    $variables = array(
      ':id'=>$id
    );
    $query->execute($variables);
    $this->objetos = $query->fetchAll();
    return $this->objetos;
  }

  function calculo($id){
    $sql = "SELECT CONCAT('S/',sum(deuda)) as importe,CONCAT('S/',sum(abono)) as abono,
    CONCAT('S/',sum(saldo)) as saldo, CONCAT('S/',sum(vuelto)) as vuelto
    FROM historial ht 
    inner join cliente c on ht.idcliente = c.idcliente WHERE c.idcliente=:id and ht.Opcion ='Editado';" ;
    $query = $this->acceso->prepare($sql);
    $variables = array(
      ':id'=>$id
    );
    $query->execute($variables);
    $this->objetos = $query->fetchAll();
    return $this->objetos;
  }


}