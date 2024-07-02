<?php 
include_once 'Conexion.php';
class Cuenta{
  var $objetos;
  var $acceso;
  public function __construct() {
    $db = new Conexion();
    $this->acceso = $db->pdo;
  }


  //Funcion de listar usuario a la vista del gestion usuario
  function obtener_cuentas(){
    $sql = "SELECT ct.idcuenta as idcuenta,descripcion,CASE 
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
  END as consumo,ct.fecha_pago as fecha_pago,c.idcliente as idcliente,ct.idusuario as idusuario,
  ct.idpago as idpago,concat(c.nombre,' ',c.apellido) as cliente,concat(u.nombre,' ',u.apellido) as usuario,
  CONCAT('S/',ct.deuda) as deuda,CONCAT('S/',ct.abono) as abono, CONCAT('S/',ct.saldo) as saldo,
  CONCAT('S/',ct.vuelto) as vuelto,tp.nombre as medios,ct.estado as estado FROM cuenta ct 
  inner join cliente c on c.idcliente = ct.idcliente 
  inner join usuario u on ct.idusuario = u.idusuario 
  inner join tipo_pago tp on ct.idpago = tp.idpago  ORDER BY ct.fecha_pago DESC";
    $query = $this->acceso->prepare($sql);
    $query->execute();
    $this->objetos = $query->fetchAll();
    return $this->objetos;
  }

  //Funcion de llenar al select de tipo documento
  function rellenar_docum(){
    $sql = "SELECT * FROM tipo_documento;";
    $query = $this->acceso->prepare($sql);
    $query->execute();
    $this->objetos = $query->fetchAll();
    return $this->objetos;
  }

   //Funcion de registrar cliente
  function Registrar($nombre,$consumo,$fecha_pago,$plazo,$deuda,$monto,$saldo,$vuelto,$idcliente,$id_pago,$idusuario,$estado){
      $sql = "INSERT INTO cuenta(descripcion,fecha_consumo,fecha_pago,fecha_plazo,deuda,abono,saldo,vuelto,idcliente,idpago,idusuario,estado) VALUES(:nombre,:consumo,:fecha,:plazo,:deuda,:monto,:saldo,:vuelto,:idcliente,:idpago,:idusuario,:estado)" ;
      $variables = array(
        ':nombre'=>$nombre,
        ':consumo'=>$consumo,
        ':fecha'=>$fecha_pago,
        ':plazo'=>$plazo,
        ':deuda'=>$deuda,
        ':monto'=>$monto,
        ':saldo'=>$saldo,
        ':vuelto'=>$vuelto,
        ':idcliente'=>$idcliente,
        ':idpago'=>$id_pago,
        ':idusuario'=>$idusuario,
        ':estado'=>$estado,
      );
      $query = $this->acceso->prepare($sql);
      $query->execute($variables);
  }


  //Funcion Editar cliente
  function editar_cuentas($id,$fecha_pago_mod,$plazo_mod,$monto_actual,$saldo,$vuelto,$id_pago_mod,$idusuario,$estado){
    $sql = "UPDATE cuenta SET fecha_pago=:pago,fecha_plazo=:plazo,abono=:monto,saldo=:saldo,vuelto=:vuelto,idpago=:idpago,idusuario=:usuario, estado=:estado where idcuenta=:id";
    $query = $this->acceso->prepare($sql);
    $variables =array(
      ':id'=>$id,
      ':pago'=>$fecha_pago_mod,
      ':plazo'=>$plazo_mod,
      ':monto'=>$monto_actual,
      ':saldo'=>$saldo,
      ':vuelto'=>$vuelto,
      ':idpago'=>$id_pago_mod,
      ':usuario'=>$idusuario,
      ':estado'=>$estado
      );
    $query->execute($variables);
  }

  
  function ingreso_diaria(){
    date_default_timezone_set('America/Lima');
    $fecha = date('Y-m-d');
    $sql = "SELECT CONCAT('S/',sum(deuda)) as ingreso_diaria FROM cuenta WHERE date(fecha_pago)=:fecha;" ;
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':fecha'=>$fecha));
    $this->objetos = $query->fetchAll();
    return $this->objetos;
  }

  function ingreso_mensual(){
    $sql = "SELECT CONCAT('S/',sum(deuda)) as ingreso_mensual FROM cuenta WHERE  year(fecha_pago)= year(curdate()) and month(fecha_pago) = month(curdate());" ;
    $query = $this->acceso->prepare($sql);
    $query->execute();
    $this->objetos = $query->fetchAll();
    return $this->objetos;
  }

  function ingreso_anual(){
    $sql = "SELECT CONCAT('S/',sum(deuda)) as ingreso_anual FROM cuenta WHERE  year(fecha_pago)= year(curdate());" ;
    $query = $this->acceso->prepare($sql);
    $query->execute();
    $this->objetos = $query->fetchAll();
    return $this->objetos;
  }

  function Cliente_mes_anual(){
    $sql = "SELECT sum(deuda) as cantidad,month(fecha_pago) as mes FROM cuenta WHERE year(fecha_pago) = year(date_add(curdate()-1,INTERVAL -1 year)) GROUP BY month(fecha_pago);" ;
    $query = $this->acceso->prepare($sql);
    $query->execute();
    $this->objetos = $query->fetchAll();
    return $this->objetos;
  }

  function cliente_mes(){
    $sql = "SELECT sum(deuda) as cantidad,month(fecha_pago) as mes FROM cuenta WHERE year(fecha_pago) = year(curdate()) GROUP BY month(fecha_pago);" ;
    $query = $this->acceso->prepare($sql);
    $query->execute();
    $this->objetos = $query->fetchAll();
    return $this->objetos;
  }

  function medios_mas_utilizada(){
    $sql = "SELECT ct.idpago,COUNT(*) as cantidad,concat(c.nombre,' ',c.apellido) as nombres,tp.nombre as pago,month(fecha_pago) as mes FROM cuenta ct
    INNER JOIN cliente c on c.idcliente = ct.idcliente
    INNER JOIN tipo_pago tp on tp.idpago=ct.idpago
    WHERE year(fecha_pago)= year(curdate()) GROUP BY tp.nombre ORDER BY c.nombre  DESC;" ;
    $query = $this->acceso->prepare($sql);
    $query->execute();
    $this->objetos = $query->fetchAll();
    return $this->objetos;
  }

}