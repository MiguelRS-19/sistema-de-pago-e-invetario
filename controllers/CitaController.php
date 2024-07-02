<?php 
include_once '../model/Cita.php';
include_once '../util/config/config.php';
require_once('../vendor/autoload.php');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
session_start();
$cita = new Cita();
date_default_timezone_set('America/Lima');

if($_POST['funcion'] == 'obtener_citas'){
  $json = array();
  $cita-> obtener_citas();
  //var_dump($cliente->objetos);
  foreach ($cita->objetos as $objeto) {
    $json []= array(
      'id'=>openssl_encrypt($objeto->id,CODE,KEY),
      'motivo'=>$objeto->motivo,
      'inicio'=>$objeto->inicio,
      'final'=>$objeto->final,
      'saldo'=>$objeto->saldo,
      'color'=>$objeto->color,
      'cliente'=>$objeto->cliente,
      'usuario'=>$objeto->usuario
    );
  }
  $jsonstring = json_encode($json);
  echo $jsonstring;
}
else if($_POST['funcion'] == 'encontrar'){
  $json = array();
  $id = $_POST['id'];
  $formateado = str_replace(" ","+",$id);
  $id = openssl_decrypt($formateado,CODE,KEY);
  if(is_numeric($id)){
    $cita-> encontrar($id);
    foreach ($cita->objetos as $objeto) {
      $json [] = array(
        'descri'=>$objeto->descri,
        'consumo'=>$objeto->consumo,
        'fecha_pago'=>$objeto->fecha_pago,
        'fecha_plazo'=>$objeto->fecha_plazo,
        'deuda'=>$objeto->deuda,
        'saldo'=>$objeto->saldo
      );
    }
  }
  $jsonstring = json_encode($json);
  echo $jsonstring;
}
else if($_POST['funcion'] == 'registro_citas'){
  $mensaje = '';
  if(!empty($_SESSION['id'])){
    $idusuario = $_SESSION['id'];
    $motivo = $_POST['motivo'];
    $color = $_POST['color'];
    $inicio = $_POST['inicio'];
    $final = $_POST['final'];
    $saldo = $_POST['saldo'];
    $idcli = $_POST['clientes'];
    $formateado = str_replace(" ","+",$idcli);
    $idcli = openssl_decrypt($formateado,CODE,KEY);
    if(is_numeric($idcli)){
      $cita-> Registrar($motivo,$inicio,$final,$saldo,$color,$idcli,$idusuario);
      $mensaje = 'success';
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
else if($_POST['funcion'] == 'editar_citas'){
  $mensaje = '';
  if(!empty($_SESSION['id'])){
    $idusuario = $_SESSION['id'];
    $motivo_mod = $_POST['motivo_mod'];
    $color_mod = $_POST['color_mod'];
    $inicio_mod = $_POST['inicio_mod'];
    $final_mod = $_POST['final_mod'];
    $saldo_mod = $_POST['saldo_mod'];
    $id = $_POST['id'];
    $formateado = str_replace(" ","+",$id);
    $id = openssl_decrypt($formateado,CODE,KEY);
    if(is_numeric($id)){
      $cita-> editar($motivo_mod,$inicio_mod,$final_mod,$saldo_mod,$color_mod,$id,$idusuario);
      $mensaje = 'success';
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
    $formateado = str_replace(" ","+",$id);
    $id = openssl_decrypt($formateado,CODE,KEY);
    if(is_numeric($id)){
      //eliminar citas
      $cita->borrar($id);
      $mensaje = 'success';
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






