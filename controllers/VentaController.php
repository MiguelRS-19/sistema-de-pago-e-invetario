<?php 
include_once '../model/Venta.php';
include_once '../model/Conexion.php';
include_once '../util/config/config.php';
require_once('../vendor/autoload.php');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
session_start();
$venta = new Venta();
date_default_timezone_set('America/Lima');
$vendedor =  $_SESSION['id'];

if($_POST['funcion'] == 'registrar_venta'){
  $total = $_POST['total'];
  $id = $_POST['id'];
  $formateado = str_replace(" ","+",$id);
  $id = openssl_decrypt($formateado,CODE,KEY);
  $productos = json_decode($_POST['json']);
  date_default_timezone_set('America/Lima');
  $fecha = date('Y-m-d H:i:s');
  //print_r($productos);
  $venta-> crear($id,$total,$fecha,$vendedor);
  $venta-> ultima_venta();
  foreach ($venta->objetos as $objecto) {
    $idventa = $objecto->ultima_venta;
    echo $idventa;
  }

  try {
    $db = new Conexion();
    $conexion = $db->pdo;
    $conexion->beginTransaction();
    foreach ($productos as $prod) {
      $cantidad = $prod->cantidad;
      $formateado = str_replace(" ","+",$prod->id);
      $id_prod = openssl_decrypt($formateado,CODE,KEY);
      while ($cantidad !=0) {
        $sql = "SELECT
        p.idprod as id,
        p.stock as stock,
        p.stock_minimo as stock_minimo
        FROM producto p WHERE idprod=:id";
        $query = $conexion->prepare($sql);
        $query->execute(array(':id'=>$id_prod));
        $products = $query->fetchAll();
        foreach ($products as $product) {
          if($cantidad < $product->stock){
            $sql = "INSERT INTO detalle_venta(cantidad,lote,idventa,idproducto) VALUES('$prod->cantidad','123','$idventa','$id_prod') ";
            $conexion->exec($sql);
            $conexion->exec("UPDATE producto SET stock = stock - '$cantidad' WHERE idprod='$id_prod'");
            $cantidad = 0;
            
          }
          
        }
      }
      $subtotal = $prod->cantidad * $prod->precioVenta;
      $conexion->exec("INSERT INTO venta_producto(precio_venta,cantidad,subtotal,idproducto,idventa) VALUES('$prod->precioVenta','$prod->cantidad','$subtotal','$id_prod','$idventa') ");
    }
    $conexion->commit();
  } catch (Exception $error) {
    $conexion->rollBack();
    $venta-> borrar($idventa);
    echo $error->getMessage();
  }
}
if($_POST['funcion'] == 'obtener_venta'){
  $json = array();
  $venta-> obtener_venta();
  foreach ($venta->objetos as $objeto) {
    $json []= array(
      'id'=>$objeto->id,
      'fecha'=>$objeto->fecha,
      'dni'=>$objeto->dni,
      'cliente'=>$objeto->cliente,
      'total'=>$objeto->total,
      'vendedor'=>$objeto->vendedor
    );
  }
  $jsonstring = json_encode($json);
  echo $jsonstring;
}
/*else if($_POST['funcion'] == 'obtener_tipo'){
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
}*/
else if($_POST['funcion'] == 'encontrar_cliente'){
  $json = array();
  $id = $_POST['id'];
  $formateado = str_replace(" ","+",$id);
  $id = openssl_decrypt($formateado,CODE,KEY);
  if(is_numeric($id)){
    $venta-> encontrar_cliente($id);
    foreach ($venta->objetos as $objeto) {
      $json [] = array(
        'dni'=>$objeto->numero
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