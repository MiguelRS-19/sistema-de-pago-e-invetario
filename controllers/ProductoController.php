<?php 
include_once '../model/Producto.php';
include_once '../util/config/config.php';
session_start();
$producto = new Producto();


if($_POST['funcion'] == 'obtener_productos'){
  
  $producto-> obtener_productos();
  //var_dump($producto->objetos);
  $json = array();
  foreach ($producto->objetos as $objeto) {
    $json[] = array(
        'id' =>openssl_encrypt($objeto->id,CODE,KEY),
        'codigo' => $objeto->codigo,
        'producto' => $objeto->producto,
        'descripcion' => $objeto->descripcion,
        'presentacion' => $objeto->presentacion,
        'precio_venta' => $objeto->precio_venta,
        'stock' => $objeto->stock,
        'stock_minimo' => $objeto->stock_minimo,
        'imagen' => $objeto->imagen,
        'marca' => $objeto->marca,
        'categoria' => $objeto->categoria,
        'estado' => $objeto->estado,
    );
  }
  $jsonstring = json_encode($json);
  echo $jsonstring;
}
else if($_POST['funcion'] == 'traer_productos'){
  
  $producto-> traer_productos();
  //var_dump($producto->objetos);
  $json = array();
  foreach ($producto->objetos as $objeto) {
    $json[] = array(
        'id' =>openssl_encrypt($objeto->id,CODE,KEY),
        'codigo' => $objeto->codigo,
        'producto' => $objeto->producto,
        'descripcion' => $objeto->descripcion,
        'presentacion' => $objeto->presentacion,
        'precio_venta' => $objeto->precio_venta,
        'stock' => $objeto->stock,
        'stock_minimo' => $objeto->stock_minimo,
        'imagen' => $objeto->imagen,
        'marca' => $objeto->marca,
        'idmarca' => $objeto->idmarca,
        'categoria' => $objeto->categoria,
        'idcat' => $objeto->idcat,
        'estado' => $objeto->estado,
    );
  }
  $jsonstring = json_encode($json);
  echo $jsonstring;
}
else if(!empty($_POST['funcion']=='generar')){
  $producto-> generar();
  $json = array();
  foreach ($producto->objetos as $objeto) {
    $json[] = array(
      'codigo'=>$objeto->id_correlativo,
    );
  }
  $jsonstring = json_encode($json[0]);
  echo $jsonstring;
}
else if($_POST['funcion'] == 'obtener_categoria'){
  $producto-> obtener_categoria();
  $json = array();
  foreach ($producto->objetos as $objeto) {
    $json [] = array(
      'id'=>openssl_encrypt($objeto->idcat,CODE,KEY),
      'nombre'=>$objeto->nombre,
      'estado'=>$objeto->estado
    );
  }
  $jsonstring = json_encode($json);
  echo $jsonstring;
}
else if($_POST['funcion'] == 'obtener_marca'){
  $producto-> obtener_marca();
  $json = array();
  foreach ($producto->objetos as $objeto) {
    $json [] = array(
      'id'=>openssl_encrypt($objeto->idmarca,CODE,KEY),
      'nombre'=>$objeto->nombre,
      'estado'=>$objeto->estado
    );
  }
  $jsonstring = json_encode($json);
  echo $jsonstring;
}
else if($_POST['funcion'] == 'registro_productos'){
  $mensaje = '';
  if(!empty($_SESSION['id'])){
    $codigo = $_POST['codigo'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $presentacion = $_POST['presentacion'];
    $precio_compra = $_POST['precio_compra'];
    $precio_venta = $_POST['precio_venta'];
    $stock = $_POST['stock'];
    $stock_minimo = $_POST['stock_minimo'];
    $marca = $_POST['marca'];
    $categoria = $_POST['categoria'];
    $formateado = str_replace(" ","+",$marca);
    $idmarca = openssl_decrypt($formateado,CODE,KEY);
    $formateados = str_replace(" ","+",$categoria);
    $idcat = openssl_decrypt($formateados,CODE,KEY);
    if(is_numeric($idmarca)){
      if(is_numeric($idcat)){
        $producto-> encontrar_producto($codigo);
        if(empty($producto->objetos)){
          $producto-> Registrar($codigo,$nombre,$descripcion,$presentacion,$precio_compra,$precio_venta,$stock,$stock_minimo,$idmarca,$idcat);
          $mensaje = 'success';
        }else{
          $mensaje = 'error_producto';
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
}

