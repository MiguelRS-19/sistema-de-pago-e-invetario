<?php 
include_once 'Conexion.php';
class ingresoDiaria{
  var $objetos;
  var $acceso;
  public function __construct() {
    $db = new Conexion();
    $this->acceso = $db->pdo;
  }

  function reporte_diaria($fecha_d){
    $sql = "SELECT idcuenta, c.numero as dni, concat(c.nombre,' ',c.apellido) as cliente,CASE
    WHEN MONTH(ct.fecha_consumo) = 1 THEN DATE_FORMAT(ct.fecha_consumo, 'ENERO - %Y')
    WHEN MONTH(ct.fecha_consumo) = 2 THEN DATE_FORMAT(ct.fecha_consumo, 'FEBRERO - %Y')
    WHEN MONTH(ct.fecha_consumo) = 3 THEN DATE_FORMAT(ct.fecha_consumo, 'MARZO - %Y')
    WHEN MONTH(ct.fecha_consumo) = 4 THEN DATE_FORMAT(ct.fecha_consumo, 'ABRIL - %Y')
    WHEN MONTH(ct.fecha_consumo) = 5 THEN DATE_FORMAT(ct.fecha_consumo, 'MAYO - %Y')
    WHEN MONTH(ct.fecha_consumo) = 6 THEN DATE_FORMAT(ct.fecha_consumo, 'JUNIO - %Y')
    WHEN MONTH(ct.fecha_consumo) = 7 THEN DATE_FORMAT(ct.fecha_consumo, 'JULIO - %Y')
    WHEN MONTH(ct.fecha_consumo) = 8 THEN DATE_FORMAT(ct.fecha_consumo, 'AGOSTO - %Y')
    WHEN MONTH(ct.fecha_consumo) = 9 THEN DATE_FORMAT(ct.fecha_consumo, 'SEPTIEMBRE - %Y')
    WHEN MONTH(ct.fecha_consumo) = 10 THEN DATE_FORMAT(ct.fecha_consumo, 'OCTUBRE - %Y')
    WHEN MONTH(ct.fecha_consumo) = 11 THEN DATE_FORMAT(ct.fecha_consumo, 'NOVIEMBRE - %Y')
    WHEN MONTH(ct.fecha_consumo) = 12 THEN DATE_FORMAT(ct.fecha_consumo, 'DICIEMBRE - %Y')
  ELSE 'Mes Desconocido'
  END as mes, date(ct.fecha_pago) as fecha, CONCAT('S/',ct.deuda) as deuda,ct.saldo as saldo,tp.nombre as pago,
  concat(u.nombre,' ',u.apellido) as usuario,ct.estado as estado FROM cuenta ct
  inner JOIN cliente c on ct.idcliente = c.idcliente
  inner JOIN usuario u on ct.idusuario = u.idusuario
  INNER JOIN tipo_pago tp on tp.idpago = ct.idpago where ct.fecha_pago = :fecha order by ct.idcuenta;";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':fecha'=>$fecha_d));
    $this->objetos = $query->fetchAll();
    return $this->objetos;
  }

}

/**SELECT idcuota, u.dni as dni, concat(u.nombre,' ',u.apellidos) as nombres,CASE
    WHEN MONTH(ct.fecha_consumo) = 1 THEN DATE_FORMAT(ct.fecha_consumo, 'ENERO - %Y')
    WHEN MONTH(ct.fecha_consumo) = 2 THEN DATE_FORMAT(ct.fecha_consumo, 'FEBRERO - %Y')
    WHEN MONTH(ct.fecha_consumo) = 3 THEN DATE_FORMAT(ct.fecha_consumo, 'MARZO - %Y')
    WHEN MONTH(ct.fecha_consumo) = 4 THEN DATE_FORMAT(ct.fecha_consumo, 'ABRIL - %Y')
    WHEN MONTH(ct.fecha_consumo) = 5 THEN DATE_FORMAT(ct.fecha_consumo, 'MAYO - %Y')
    WHEN MONTH(ct.fecha_consumo) = 6 THEN DATE_FORMAT(ct.fecha_consumo, 'JUNIO - %Y')
    WHEN MONTH(ct.fecha_consumo) = 7 THEN DATE_FORMAT(ct.fecha_consumo, 'JULIO - %Y')
    WHEN MONTH(ct.fecha_consumo) = 8 THEN DATE_FORMAT(ct.fecha_consumo, 'AGOSTO - %Y')
    WHEN MONTH(ct.fecha_consumo) = 9 THEN DATE_FORMAT(ct.fecha_consumo, 'SEPTIEMBRE - %Y')
    WHEN MONTH(ct.fecha_consumo) = 10 THEN DATE_FORMAT(ct.fecha_consumo, 'OCTUBRE - %Y')
    WHEN MONTH(ct.fecha_consumo) = 11 THEN DATE_FORMAT(ct.fecha_consumo, 'NOVIEMBRE - %Y')
    WHEN MONTH(ct.fecha_consumo) = 12 THEN DATE_FORMAT(ct.fecha_consumo, 'DICIEMBRE - %Y')
   ELSE 'Mes Desconocido'
 END as mes, date(ct.fecha_pago) as fecha, CONCAT('S/ ',ct.ingreso) as cancelar,tp.nombre as pago,ct.estado as estado FROM cuota ct
   inner JOIN usuario u on ct.idusuario = u.iduser
   INNER JOIN tipo_pago tp on tp.idpago = ct.idpago where month(ct.fecha_consumo) = month(date_add(curdate(),INTERVAL -1 month)) and DATE_FORMAT(fecha_pago, '%Y-%m-%d') = date(curdate()) order by ct.idcuota;
 */