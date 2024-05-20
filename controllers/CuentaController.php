<?php 
include_once '../model/Cuenta.php';
include_once '../util/config/config.php';
require_once('../vendor/autoload.php');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
session_start();
$cuenta = new Cuenta();
date_default_timezone_set('America/Lima');

if($_POST['funcion'] == 'obtener_cuentas'){
  $json = array();
  $cuenta-> obtener_cuentas();
  //var_dump($cliente->objetos);
  foreach ($cuenta->objetos as $objeto) {
    $json []= array(
      'id'=>$objeto->idcuenta,
      'nombre'=>$objeto->descripcion,
      'consumo'=>$objeto->consumo,
      'fecha_pago'=>$objeto->fecha_pago,
      'cliente'=>$objeto->cliente,
      'deuda'=>$objeto->deuda,
      'monto'=>$objeto->abono,
      'saldo'=>$objeto->saldo,
      'vuelto'=>$objeto->vuelto,
      'medios'=>$objeto->medios,
      'usuario'=>$objeto->usuario,
      'estado'=>$objeto->estado
    );
  }
  $jsonstring = json_encode($json);
  echo $jsonstring;
}
else if($_POST['funcion'] == 'obtener_docum'){
  $usuario-> rellenar_docum();
  $json = array();
  foreach ($usuario->objetos as $objeto) {
    $json [] = array(
      'id'=>$objeto->idtipo_doc,
      'nombre'=>$objeto->nombre
    );
  }
  $jsonstring = json_encode($json);
  echo $jsonstring;
}
else if($_POST['funcion'] == 'registro_cuentas'){
  $mensaje = '';
  if(!empty($_SESSION['id'])){
    $idusuario = $_SESSION['id'];
    $cliente = $_POST['cliente'];
    $nombre = $_POST['nombre'];
    $consumo = $_POST['consumo'];
    $fecha_pago = $_POST['fecha'];
    $plazo = $_POST['plazo'];
    $deuda = $_POST['deuda'];
    $monto = $_POST['monto'];
    $id_medios = $_POST['id_medios'];
    $formateado = str_replace(" ","+",$id_medios);
    $id_pago = openssl_decrypt($formateado,CODE,KEY);
    $formateados = str_replace(" ","+",$cliente);
    $idcliente = openssl_decrypt($formateados,CODE,KEY);
    if(is_numeric($id_pago)){
      if(is_numeric($idcliente)){
        if ($monto >= 50) {
          $saldo = 0;
          $estado = 'Cancelado';
          $vuelto = $monto - $deuda;
          $cuenta-> Registrar($nombre,$consumo,$fecha_pago,$plazo,$deuda,$monto,$saldo,$vuelto,$idcliente,$id_pago,$idusuario,$estado);
          $mensaje = 'success';
        } else if($deuda < 100){
          $vuelto = 0;
          $saldo = $deuda - $monto;
          if($saldo <=0){
            $estado = 'Cancelado';
            $cuenta-> Registrar($nombre,$consumo,$fecha_pago,$plazo,$deuda,$monto,$saldo,$vuelto,$idcliente,$id_pago,$idusuario,$estado);
            $mensaje = 'success';
          }else{
            $estado = 'Pendiente';
            $cuenta-> Registrar($nombre,$consumo,$fecha_pago,$plazo,$deuda,$monto,$saldo,$vuelto,$idcliente,$id_pago,$idusuario,$estado);
            $mensaje = 'success';
          }
        }
      }else{
        $mensaje = 'error_decrypt';
      }
    }else{
      $mensaje = 'error_decrypt';
    }

  }else{
    $mensaje = 'error_sesion';
  }
  $json = array(
    'mensaje'=>$mensaje,
  );
  $jsonstring = json_encode($json);
  echo $jsonstring;
}else if($_POST['funcion'] == 'editar_cuentas'){
  $mensaje = '';
  if(!empty($_SESSION['id'])){
    $idusuario = $_SESSION['id'];
    $id = $_POST['id'];
    $fecha_pago_mod = $_POST['fecha_mod'];
    $plazo_mod = $_POST['plazo_mod'];
    $deuda_mod = $_POST['deuda_mod'];
    $monto_mod = $_POST['monto_mod'];
    $monto_nuevo = $_POST['monto_nuevo'];
    $medios_mod = $_POST['medios'];
    $formateado = str_replace(" ","+",$medios_mod);
    $id_pago_mod = openssl_decrypt($formateado,CODE,KEY);
    if(is_numeric($id_pago_mod)){
      if ($monto_nuevo >= 50) {
        $saldo = 0;
        $monto_actual = $monto_mod + $monto_nuevo;
        $estado = 'Cancelado';
        $vuelto = ($monto_mod + $monto_nuevo) - $deuda_mod;
        $cuenta-> editar_cuentas($id,$fecha_pago_mod,$plazo_mod,$monto_actual,$saldo,$vuelto,$id_pago_mod,$idusuario,$estado);
        $mensaje = 'success';
      } else if($deuda_mod < 100){
        $vuelto = 0;
        $monto_actual = $monto_mod + $monto_nuevo;
        $saldo = $deuda_mod - ($monto_mod + $monto_nuevo);
        if($saldo <= 0){
          $estado = 'Cancelado';
          $cuenta-> editar_cuentas($id,$fecha_pago_mod,$plazo_mod,$monto_actual,$saldo,$vuelto,$id_pago_mod,$idusuario,$estado);
          $mensaje = 'success';
        }else{
          $estado = 'Pendiente';
          $cuenta-> editar_cuentas($id,$fecha_pago_mod,$plazo_mod,$monto_actual,$saldo,$vuelto,$id_pago_mod,$idusuario,$estado);
          $mensaje = 'success';
        }
      }
    }else{
      $mensaje = 'error_decrypt';
    }

  }else{
    $mensaje = 'error_sesion';
  }
  $json = array(
    'mensaje'=>$mensaje,
  );
  $jsonstring = json_encode($json);
  echo $jsonstring;
}
else if($_POST['funcion'] == 'eliminar'){
  $mensaje = '';
  if(!empty($_SESSION['id'])){
    $id_sesion = $_SESSION['id'];
    $id = $_POST['id'];
    //eliminar el cliente
    $cliente->borrar($id);
    $mensaje = 'success';
  }else{
    $mensaje = 'error_sesion';
  }
  $json = array(
    'mensaje'=>$mensaje,
  );
  $jsonstring = json_encode($json);
  echo $jsonstring;
}
else if($_POST['funcion'] == 'activar_cliente'){
  $mensaje = '';
  if(!empty($_SESSION['id'])){
    $id_sesion = $_SESSION['id'];
    $id = $_POST['id'];
    $cliente->activar($id);
    $mensaje = 'success';
  }else{
    $mensaje = 'error_sesion';
  }
  $json = array(
    'mensaje'=>$mensaje,
    'funcion'=>"activar usuario"
  );
  $jsonstring = json_encode($json);
  echo $jsonstring;
}

else if($_POST['funcion'] == 'obtener_cliente'){
  $json = array();
  $cliente-> obtener_clientes();
  //var_dump($cliente->objetos);
  foreach ($cliente->objetos as $objeto) {
    $json []= array(
      'id'=>openssl_encrypt($objeto->idcliente,CODE,KEY),
      'nombre'=>$objeto->nombre.' '.$objeto->apellido,
      'estado'=>$objeto->estado
    );
  }
  $jsonstring = json_encode($json);
  echo $jsonstring;
}
else if($_POST['funcion'] == 'mostrar_consultas'){
  $cuenta-> ingreso_diaria();
  foreach ($cuenta->objetos as $objeto) {
    if(!empty($objeto->ingreso_diaria)){
      $ingreso_diaria = $objeto->ingreso_diaria;
    }else{
      $ingreso_diaria = 'S/0.00';
    }
  }

  $cuenta-> ingreso_mensual();
  foreach ($cuenta->objetos as $objeto) {
    $ingreso_mensual = $objeto->ingreso_mensual;
  }

  $cuenta-> ingreso_anual();
  $json = array();
  foreach ($cuenta->objetos as $objeto) {
    $json[] = array(
      'ingreso_diaria' => $ingreso_diaria,
      'ingreso_mensual' => $ingreso_mensual,
      'ingreso_anual' => $objeto->ingreso_anual
    );
  }
  $jsonstring = json_encode($json[0]);
  echo $jsonstring;
}
else if($_POST['funcion'] == 'medios_mas_utilizada'){
  $cuenta-> medios_mas_utilizada();
  $json = array();
  foreach ($cuenta->objetos as $objeto) {
    $json[] = $objeto;
  }
  $jsonstring = json_encode($json);
  echo $jsonstring;
}
else if($_POST['funcion'] == 'Cliente_mes_anual'){
  $cuenta-> Cliente_mes_anual();
  $json = array();
  foreach ($cuenta->objetos as $objeto) {
    $json[] = $objeto;
  }
  $jsonstring = json_encode($json);
  echo $jsonstring;
}
else if($_POST['funcion'] == 'Cliente_mes'){
  $cuenta-> cliente_mes();
  $json = array();
  foreach ($cuenta->objetos as $objeto) {
    $json[] = $objeto;
  }
  $jsonstring = json_encode($json);
  echo $jsonstring;
}






























/*************************************************** */




if($_POST['funcion'] == 'Usuario_mes_pago'){
  $cuota-> Usuario_mes_pago();
  $json = array();
  foreach ($cuota->objetos as $objeto) {
    $json[] = $objeto;
  }
  $jsonstring = json_encode($json);
  echo $jsonstring;
}





