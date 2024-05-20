<?php 
include_once 'Conexion.php';
class Cuota{
  var $objetos;
  var $acceso;
  public function __construct() {
    $db = new Conexion();
    $this->acceso = $db->pdo;
  }



  function crear($ingreso,$fecha,$consumo,$plazo,$pagador,$pago){
    $sql = "SELECT idusuario FROM cuota where idusuario=:nombre" ;
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':nombre'=>$pagador));
    $this->objetos = $query->fetchAll();
    if(!empty($this->objetos)){
      echo 'noadd';
    }else{
      $estado = '';
      if($ingreso > 0){
        $estado = 'pagado';
        if($estado == 'pagado'){
          $sql = "INSERT INTO cuota(ingreso,fecha_consumo,fecha_pago,fecha_plazo,idusuario,idpago,estado) VALUES(:ingreso,:consumo,:fecha,:plazo,:iduser,:idpago,:estado)" ;
          $query = $this->acceso->prepare($sql);
          $query->execute(array(
            ':ingreso'=>$ingreso,
            ':consumo'=>$consumo,
            ':fecha'=>$fecha,
            ':plazo'=>$plazo,
            ':iduser'=>$pagador,
            ':idpago'=>$pago,
            ':estado'=>$estado,
            ));
          echo 'add';
        }
      }else{
        $sql = "INSERT INTO cuota(ingreso,fecha_consumo,fecha_pago,fecha_plazo,idusuario,idpago) VALUES(:ingreso,:consumo,:fecha,:plazo,:iduser,:idpago)" ;
        $query = $this->acceso->prepare($sql);
        $query->execute(array(
          ':ingreso'=>$ingreso,
          ':consumo'=>$consumo,
          ':fecha'=>$fecha,
          ':plazo'=>$plazo,
          ':iduser'=>$pagador,
          ':idpago'=>$pago,
          ));
        echo 'add';
      }
    }
  }

  function editar($idcuota_mod,$ingreso_mod,$consumo_mod,$fecha_mod,$plazo_mod,$id_pag_mod,$id_metod_mod){
    $sql = "UPDATE cuota SET ingreso=:ingreso,fecha_consumo=:consumo,fecha_pago=:fecha,fecha_plazo=:plazo,idusuario=:iduser,idpago=:idpago where idcuota=:id";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':id'=>$idcuota_mod,
                          ':ingreso'=>$ingreso_mod,
                          ':consumo'=>$consumo_mod,
                          ':fecha'=>$fecha_mod,
                          ':plazo'=>$plazo_mod,
                          ':iduser'=>$id_pag_mod,
                          ':idpago'=>$id_metod_mod,
    ));
  }

  function buscar(){
    $sql = "SELECT ct.idcuota as idcuota,CASE 
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
    END as consumo,ct.fecha_pago as fecha_pago,ct.idusuario as user,ct.idpago as idpago,concat(u.nombre,' ',u.apellidos) as pagador,CONCAT('S/ ',ct.ingreso) as cancelar,tp.nombre as pago,ct.estado as estado FROM cuota ct 
    inner join usuario u on ct.idusuario = u.iduser 
    join tipo_pago tp on ct.idpago = tp.idpago  ORDER BY ct.fecha_pago DESC;" ;
    $query = $this->acceso->prepare($sql);
    $query->execute();
    $this->objetos = $query->fetchAll();
    return $this->objetos;
  }


  function obtener_fecha($idcuota){
    $sql = "SELECT * FROM cuota where idcuota=:idcuota ORDER BY idcuota DESC;" ;
    $query = $this->acceso->prepare($sql);
    $query->execute(array('idcuota'=>$idcuota));
    $this->objetos = $query->fetchAll();
    return $this->objetos;
  }

  function nopagado($idcuota,$ingreso){
    $sql = "SELECT ingreso FROM cuota where ingreso=:ingreso";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':ingreso'=>$ingreso));
    $this->objetos = $query->fetchAll();
    if(!empty($this->objetos)){
      $estado = 'pagado';
      $sql = "UPDATE cuota SET estado=:estado where idcuota=:id " ;
      $query = $this->acceso->prepare($sql);
      $query->execute(array(':id'=>$idcuota,':estado'=>$estado));
      echo 'cambiado';
    }else{
      echo 'nocambiado';
    }
    
  }

  function pagado($idcuota,$ingreso){
    $sql = "SELECT ingreso FROM cuota where ingreso=:ingreso";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':ingreso'=>$ingreso));
    $this->objetos = $query->fetchAll();
    if(!empty($this->objetos)){
      $estado = 'no pagado';
      $sql = "UPDATE cuota SET estado=:estado where idcuota=:id " ;
      $query = $this->acceso->prepare($sql);
      $query->execute(array(':id'=>$idcuota,':estado'=>$estado));
      echo 'cambiado';
    }else{
      echo 'nocambiado';
    }
    
    /*if(count($this->objetos) == 1){ // 1 <= 0
      
    }*/
    
  }
  
  /*function reporte_diaria(){
    $sql = "SELECT idcuota, u.dni as dni, concat(u.nombre,' ',u.apellidos) as nombres,CASE
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
   INNER JOIN tipo_pago tp on tp.idpago = ct.idpago where month(ct.fecha_consumo) = month(date_add(curdate(),INTERVAL -1 month)) and DATE_FORMAT(fecha_pago, '%Y-%m-%d') = date(curdate()) order by ct.idcuota;";
    $query = $this->acceso->prepare($sql);
    $query->execute();
    $this->objetos = $query->fetchAll();
    return $this->objetos;
  }

  function reporte_mensual(){
    $sql = "SELECT idcuota, u.dni as dni, concat(u.nombre,' ',u.apellidos) as nombres, CASE
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
    INNER JOIN tipo_pago tp on tp.idpago = ct.idpago where DATE_FORMAT(fecha_pago, '%Y-%m') = DATE_FORMAT(curdate(), '%Y-%m') and month(ct.fecha_consumo) = month(date_add(curdate(),INTERVAL -1 month)) and ct.idcuota not LIKE '' order by ct.idcuota;";
    $query = $this->acceso->prepare($sql);
    $query->execute();
    $this->objetos = $query->fetchAll();
    return $this->objetos;
  }
  function reporte_anual(){
    $sql = "SELECT idcuota, u.dni as dni, concat(u.nombre,' ',u.apellidos) as nombres,CASE
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
    INNER JOIN tipo_pago tp on tp.idpago = ct.idpago where year(ct.fecha_consumo) = year(date_add(curdate(),INTERVAL -1 year)) and year(fecha_pago)= year(curdate()) order by ct.idcuota;";
    $query = $this->acceso->prepare($sql);
    $query->execute();
    $this->objetos = $query->fetchAll();
    return $this->objetos;
  }*/


  function ingreso_diaria(){
    date_default_timezone_set('America/Lima');
    $fecha = date('Y-m-d');
    $sql = "SELECT CONCAT('S/ ',sum(ingreso)) as ingreso_diaria FROM cuota WHERE date(fecha_pago)= :fecha;" ;
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':fecha'=>$fecha));
    $this->objetos = $query->fetchAll();
    return $this->objetos;
  }

  function ingreso_mensual(){
    $sql = "SELECT CONCAT('S/ ',sum(ingreso)) as ingreso_mensual FROM cuota WHERE  year(fecha_pago)= year(curdate()) and month(fecha_pago) = month(curdate());" ;
    $query = $this->acceso->prepare($sql);
    $query->execute();
    $this->objetos = $query->fetchAll();
    return $this->objetos;
  }

  function ingreso_anual(){
    $sql = "SELECT CONCAT('S/ ',sum(ingreso)) as ingreso_anual FROM cuota WHERE  year(fecha_pago)= year(curdate());" ;
    $query = $this->acceso->prepare($sql);
    $query->execute();
    $this->objetos = $query->fetchAll();
    return $this->objetos;
  }

  function Usuario_mes_anual(){
    $sql = "SELECT sum(ingreso) as cantidad,month(fecha_pago) as mes FROM cuota WHERE year(fecha_pago) = year(date_add(curdate()-1,INTERVAL -1 year)) GROUP BY month(fecha_pago);" ;
    $query = $this->acceso->prepare($sql);
    $query->execute();
    $this->objetos = $query->fetchAll();
    return $this->objetos;
  }

  function usuario_mes(){
    $sql = "SELECT sum(ingreso) as cantidad,month(fecha_pago) as mes FROM cuota WHERE year(fecha_pago) = year(curdate()) GROUP BY month(fecha_pago);" ;
    $query = $this->acceso->prepare($sql);
    $query->execute();
    $this->objetos = $query->fetchAll();
    return $this->objetos;
  }

  function Usuario_mes_pago(){
    $sql = "SELECT COUNT(ct.idpago) as cantidad,concat(u.nombre,' ',u.apellidos) as nombres,tp.nombre as pago,month(fecha_pago) as mes FROM cuota ct
    INNER JOIN usuario u on u.iduser = ct.idusuario
    INNER JOIN tipo_pago tp on tp.idpago=ct.idpago
    WHERE year(fecha_pago)= year(curdate()) GROUP BY tp.nombre ORDER BY u.nombre  DESC;" ;
    $query = $this->acceso->prepare($sql);
    $query->execute();
    $this->objetos = $query->fetchAll();
    return $this->objetos;
  }

}