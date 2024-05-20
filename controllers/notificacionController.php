<?php 
include '../model/Notificacion.php';
$notification = new Notificacion();

if($_POST['funcion'] == 'notificacion'){
  $notification-> notificacion();
  $json = array();
  foreach ($notification->objetos as $objeto) {
    $fecha = new DateTime($objeto->fecha);
    $fecha_plazo = new DateTime($objeto->fecha_plazo);
    $est_pago = $objeto->estatus;
    $diferencia = $fecha_plazo ->diff($fecha);
    $mes = $diferencia ->m;
    $dia = $diferencia ->d;
    $verificado = $diferencia ->invert; //invert tiene valor 0 y 1
    if($verificado==0){
      if($est_pago == 'Pendiente'){
        if($dia <= 7){
          $estado = 'danger';
          $mes = $mes *(-1);
          $dia = $dia *(-1);
        }
      }
    }else{
      if($verificado==1){
        if($mes > 1 || $dia <= 7){ // 8 <= 7
          $estado = 'danger';
        }else{
          if($dia <= 3){
            $estado = 'warning';
          }
        }

      }
    }
    $json [] = array(
      'id'=>$objeto->idcuenta,
      'fecha'=>$objeto->fecha_plazo,
      'deuda'=>$objeto->deuda,
      'saldo'=>$objeto->saldo,
      'nombre'=>$objeto->nombre,
      'estatus'=>$objeto->estatus,
      'mes'=>$mes,
      'dia'=>$dia,
      'estado'=> $estado,
    );
  }
  $jsonstring = json_encode($json);
  echo $jsonstring;
}


