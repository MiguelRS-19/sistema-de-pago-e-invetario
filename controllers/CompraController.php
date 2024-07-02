<?php 
include_once '../model/Compra.php';
include_once '../util/config/config.php';
require_once('../vendor/autoload.php');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
session_start();
$compra = new Compra();
date_default_timezone_set('America/Lima');

if($_POST['funcion'] == 'obtener_compras'){
  $json = array();
  $compra-> obtener_compras();
  //var_dump($cliente->objetos);
  foreach ($compra->objetos as $objeto) {
    $json []= array(
      'id'=>$objeto->idcompra,
      'nombre'=>$objeto->nombre,
      'producto'=>$objeto->producto,
      'descripcion'=>$objeto->descripcion,
      'presentacion'=>$objeto->presentacion,
      'fecha'=>$objeto->fecha,
      'medios'=>$objeto->medios,
      'cantidad'=>$objeto->cantidad,
      'precio_unitario'=>$objeto->precio_unitario,
      'total'=>$objeto->total,
      'comprobante'=>$objeto->comprobante,
      'usuario'=>'Comprador',
      'estado'=>$objeto->estado
    );
  }
  $jsonstring = json_encode($json);
  echo $jsonstring;
}
else if($_POST['funcion'] == 'obtener_tipo'){
  $compra-> rellenar_tipo();
  $json = array();
  foreach ($compra->objetos as $objeto) {
    $json [] = array(
      'id'=>$objeto->id,
      'nombre'=>$objeto->nombre
    );
  }
  $jsonstring = json_encode($json);
  echo $jsonstring;
}
else if($_POST['funcion'] == 'encontrar_producto'){
  $json = array();
  $id = $_POST['id'];
  $formateado = str_replace(" ","+",$id);
  $id = openssl_decrypt($formateado,CODE,KEY);
  if(is_numeric($id)){
    $compra-> encontrar_producto($id);
    foreach ($compra->objetos as $objeto) {
      $json [] = array(
        'precio'=>$objeto->precio_compra
      );
    }
  }
  $jsonstring = json_encode($json);
  echo $jsonstring;
}
else if($_POST['funcion'] == 'fecha'){
  $json = date('Y-m-d H:i:s');
  $jsonstring = json_encode($json);
  echo $jsonstring;
}
else if($_POST['funcion'] == 'registro_compra'){
  $mensaje = '';
  if(!empty($_SESSION['id'])){
    $idusuario = $_SESSION['id'];
    $nota = $_POST['nota'];
    $cantidad = $_POST['cantidad'];
    $precio = $_POST['precio_compra'];
    $tp_pago = $_POST['tp_pago'];
    $idprovee = $_POST['codprovee'];
    $idcomp = $_POST['tp_compra'];
    $idprod = $_POST['producto'];
    $formateado = str_replace(" ","+",$idprod);
    $idprod = openssl_decrypt($formateado,CODE,KEY);
    $formateados = str_replace(" ","+",$tp_pago);
    $tp_pago = openssl_decrypt($formateados,CODE,KEY);
    $formateados = str_replace(" ","+",$idprovee);
    $idprovee = openssl_decrypt($formateados,CODE,KEY);
    if(is_numeric($idprod) && is_numeric($tp_pago) && is_numeric($idprovee)){
      $compra-> Registrar($nota,$cantidad,$precio,$tp_pago,$idprovee,$idcomp,$idprod);
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





