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
        'precio_compra' => $objeto->precio_compra,
        'precio_venta' => $objeto->precio_venta,
        'stock' => $objeto->stock,
        'stock_minimo' => $objeto->stock_minimo,
        'imagen' => $objeto->imagen,
        'marca' => $objeto->marca,
        'idmarca' => openssl_encrypt($objeto->idmarca,CODE,KEY),
        'categoria' => $objeto->categoria,
        'idcat' => openssl_encrypt($objeto->idcat,CODE,KEY),
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
else if($_POST['funcion'] == 'editar_productos'){
  $mensaje = '';
  if(!empty($_SESSION['id'])){
    $idusuario = $_SESSION['id'];
    $id = $_POST['id'];
    $nombre_mod = $_POST['nombre_mod'];
    $descripcion_mod = $_POST['descripcion_mod'];
    $presentacion_mod = $_POST['presentacion_mod'];
    $precio_compra_mod = $_POST['precio_compra_mod'];
    $precio_venta_mod = $_POST['precio_venta_mod'];
    $stock_mod = $_POST['stock_mod'];
    $stock_minimo_mod = $_POST['stock_minimo_mod'];
    $marca_mod = $_POST['marca_mod'];
    $categoria_mod = $_POST['categoria_mod'];
    $formateado = str_replace(" ","+",$id);
    $id_prod = openssl_decrypt($formateado,CODE,KEY);
    $formateado = str_replace(" ","+",$marca_mod);
    $id_marca = openssl_decrypt($formateado,CODE,KEY);
    $formateado = str_replace(" ","+",$categoria_mod);
    $id_cat = openssl_decrypt($formateado,CODE,KEY);
    if(is_numeric($id_marca) && is_numeric($id_cat) && is_numeric($id_prod)){
      $producto-> editar_productos($id_prod,$nombre_mod,$descripcion_mod,$presentacion_mod,$precio_compra_mod,$precio_venta_mod,$stock_mod,$stock_minimo_mod,$id_marca,$id_cat);
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
else if($_POST['funcion'] == 'editar_imagen'){
  $mensaje = '';
  if(!empty($_SESSION['id'])){
    $id = $_POST['avatar_id'];
    $avatar = $_POST['avatar1'];
    $formateado = str_replace(" ","+",$id);
    $id_prod = openssl_decrypt($formateado,CODE,KEY);
    if(is_numeric($id_prod)){
      //editar imagen de producto
      $nombre = uniqid().'-'. $_FILES['avatar_mod']['name'];
      $ruta = '../util/img/suministro/'.$nombre;
      move_uploaded_file($_FILES['avatar_mod']['tmp_name'],$ruta);
      if($avatar != 'prod_default.png'){
        unlink('../util/img/suministro/'.$avatar);
      }
      $producto-> editar_imagen($id_prod,$nombre);
      $mensaje = 'success';
    }else{
      $mensaje = 'error_decrypt';
    }
  }else{
    $mensaje = 'error_sesion';
  }
  $json = array(
    'mensaje'=>$mensaje
  );
  $jsonstring = json_encode($json);
  echo $jsonstring;
}
else if($_POST['funcion'] == 'eliminar'){
  $mensaje = '';
  if(!empty($_SESSION['id'])){
    $id = $_POST['id'];
    $formateado = str_replace(" ","+",$id);
    $id_prod = openssl_decrypt($formateado,CODE,KEY);
    if(is_numeric($id_prod)){
      //eliminar el producto
      $producto->borrar($id_prod);
      $mensaje = 'success';
    }else{
      $mensaje = 'error_decrypt';
    }

  }else{
    $mensaje = 'error_sesion';
  }
  $json = array(
    'mensaje'=>$mensaje
  );
  $jsonstring = json_encode($json);
  echo $jsonstring;
}
else if($_POST['funcion'] == 'activar'){
  $mensaje = '';
  if(!empty($_SESSION['id'])){
    $id = $_POST['id'];
    $formateado = str_replace(" ","+",$id);
    $id_prod = openssl_decrypt($formateado,CODE,KEY);
    if(is_numeric($id_prod)){
      //activar producto
      $producto->activar($id_prod);
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
else if($_POST['funcion'] == 'carrito_id'){
  $id = $_POST['id_producto'];
  $formateado = str_replace(" ","+",$id);
  $id = openssl_decrypt($formateado,CODE,KEY);
  $producto-> carrito_id($id);
  //var_dump($producto->objetos);
  $json = array();
  foreach ($producto->objetos as $objeto) {
    $json[]= array(
        'id' =>openssl_encrypt($objeto->id,CODE,KEY),
        'codigo' => $objeto->codigo,
        'producto' => $objeto->producto,
        'descripcion' => $objeto->descripcion,
        'presentacion' => $objeto->presentacion,
        'precio_venta' => $objeto->precio_venta,
        'stock' => $objeto->stock,
        'stock_minimo' => $objeto->stock_minimo,
        'marca' => $objeto->marca,
        'categoria' => $objeto->categoria,
        'estado' => $objeto->estado,
    );
  }
  $jsonstring = json_encode($json[0]);
  echo $jsonstring;
}
else if($_POST['funcion'] == 'verificar_stock'){
  $error = 0;
  $productos = json_decode($_POST['productos']);
  foreach ($productos as $objeto) {
    $formateado = str_replace(" ","+",$objeto->id);
    $id = openssl_decrypt($formateado,CODE,KEY);
    $producto->carrito_id($id);
    foreach ($producto->objetos as $obj) {
      $total = $obj->stock;
    }
    if($total >= $objeto->cantidad && $objeto-> cantidad>0){
      $error = $error + 0;
    }else{
      $error = $error + 1;
    }
  }
  echo $error;
}
else if($_POST['funcion'] == 'agregar_productos'){
  $html = "";
  $productos = json_decode($_POST['productos']);
  foreach ($productos as $resultado) {
    $formateado = str_replace(" ","+",$resultado->id);
    $id = openssl_decrypt($formateado,CODE,KEY);
    echo $id;
    /*$producto-> carrito_id($id);
    foreach ($producto->objetos as $objeto) {
      $subtotal= $objeto->precio_venta * $resultado->cantidad;
      $html.="
      <tr prodId='$objeto->id' prodPrecio='$objeto->precio_venta'>
      <td>$objeto->producto</td>
      <td>$objeto->stock</td>
      <td class='precio'>$objeto->precio_venta</td>
      <td>$objeto->descripcion</td>
      <td>$objeto->presentacion</td>
      <td><input type='number' min='1' class='form-control cantidad_producto' value='$resultado->cantidad'></td>
      <td class='subtotales'><h5>$subtotal</h5></td>
      <td><button class='borrar-producto btn btn-danger'><i class='fas fa-times-circle'></i></button></td>
      </tr>
    ";
    }
    echo $html;*/
  }
}
