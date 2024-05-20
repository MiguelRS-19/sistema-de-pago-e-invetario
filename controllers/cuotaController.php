<?php 
include_once '../model/Cuota.php';
require_once('../vendor/autoload.php');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;

$cuota = new Cuota();


if($_POST['funcion'] == 'editar'){
  $idcuota_mod = $_POST['idcuota_mod'];
  $ingreso_mod = $_POST['ingreso_mod'];
  $consumo_mod = $_POST['consumo_mod'];
  $fecha_mod = $_POST['fecha_mod'];
  $plazo_mod = $_POST['plazo_mod'];
  $id_pag_mod = $_POST['id_pag_mod'];
  $id_metod_mod = $_POST['id_metod_mod'];
  $cuota-> editar($idcuota_mod,$ingreso_mod,$consumo_mod,$fecha_mod,$plazo_mod,$id_pag_mod,$id_metod_mod);
  echo "edit";
  
}

if($_POST['funcion'] == 'crear_cuota'){
  $ingreso = $_POST['ingreso'];
  $fecha = $_POST['fecha'];
  $consumo = $_POST['consumo'];
  $plazo = $_POST['plazo'];
  $pagador = $_POST['pagador'];
  $pago = $_POST['pago'];
  $cuota-> crear($ingreso,$fecha,$consumo,$plazo,$pagador,$pago);
}


if($_POST['funcion'] == 'listar'){
  $cuota-> buscar();
  $json = array();
  foreach ($cuota->objetos as $objeto) {
    $json['data'][] = $objeto;
  }
  $jsonstring = json_encode($json);
  echo $jsonstring;
}

if($_POST['funcion'] == 'obtener_fecha'){
  $idcuota = $_POST['id'];
  $cuota-> obtener_fecha($idcuota);
  $json = array();
  foreach ($cuota->objetos as $objeto) {
    $json[] = array(
      'consumo'=>$objeto->fecha_consumo
    );
  }
  $jsonstring = json_encode($json[0]);
  echo $jsonstring;
}

if($_POST['funcion'] == 'nopagado'){
  $idcuota = $_POST['idcuota'];
  //$estado = $_POST['estado'];
  $ingreso = $_POST['ingreso'];
  $cuota-> nopagado($idcuota,$ingreso);
}

if($_POST['funcion'] == 'pagado'){
  $idcuota = $_POST['idcuota'];
  $estado = $_POST['estado'];
  //$cant_dinero = $_POST['cant_dinero'];
  $cuota-> pagado($idcuota,$estado);
}



if($_POST['funcion'] == 'mostrar_consultas'){
  $cuota-> ingreso_diaria();
  foreach ($cuota->objetos as $objeto) {
    $ingreso_diaria = $objeto->ingreso_diaria;
  }

  $cuota-> ingreso_mensual();
  foreach ($cuota->objetos as $objeto) {
    $ingreso_mensual = $objeto->ingreso_mensual;
  }

  $cuota-> ingreso_anual();
  $json = array();
  foreach ($cuota->objetos as $objeto) {
    $json[] = array(
      'ingreso_diaria' => $ingreso_diaria,
      'ingreso_mensual' => $ingreso_mensual,
      'ingreso_anual' => $objeto->ingreso_anual
    );
  }
  $jsonstring = json_encode($json[0]);
  echo $jsonstring;
}

if($_POST['funcion'] == 'Usuario_mes_anual'){
  $cuota-> Usuario_mes_anual();
  $json = array();
  foreach ($cuota->objetos as $objeto) {
    $json[] = $objeto;
  }
  $jsonstring = json_encode($json);
  echo $jsonstring;
}

if($_POST['funcion'] == 'Usuario_mes'){
  $cuota-> usuario_mes();
  $json = array();
  foreach ($cuota->objetos as $objeto) {
    $json[] = $objeto;
  }
  $jsonstring = json_encode($json);
  echo $jsonstring;
}

if($_POST['funcion'] == 'Usuario_mes_pago'){
  $cuota-> Usuario_mes_pago();
  $json = array();
  foreach ($cuota->objetos as $objeto) {
    $json[] = $objeto;
  }
  $jsonstring = json_encode($json);
  echo $jsonstring;
}





