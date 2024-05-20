<?php 
include_once '../model/Marca.php';
include_once '../util/config/config.php';
$marca = new Marca();
session_start();

if($_POST['funcion'] == 'obtener_marcas'){
  $json = array();
  $marca-> obtener_marcas();
  //var_dump($cliente->objetos);
  foreach ($marca->objetos as $objeto) {
    $json []= array(
      'id'=>openssl_encrypt($objeto->idmarca,CODE,KEY),
      'nombre'=>$objeto->nombre,
      'estado'=>$objeto->estado
    );
  }
  $jsonstring = json_encode($json);
  echo $jsonstring;
}
else if($_POST['funcion'] == 'registro_marcas'){
  $mensaje = '';
  if(!empty($_SESSION['id'])){
    $nombre = $_POST['nombre'];
    $marca-> encontrar_mar($nombre);
    if(empty($marca->objetos)){
      $marca-> Registrar($nombre);
      $mensaje = 'success';
    }else{
      $mensaje = 'error_marca';
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
else if($_POST['funcion'] == 'editar_marcas'){
  $mensaje = '';
  if(!empty($_SESSION['id'])){
    $id_usuario = $_SESSION['id'];
    $id = $_POST['id'];
    $nombre_mod = $_POST['nombre_mod'];
    $formateado = str_replace(" ","+",$id);
    $idmarca = openssl_decrypt($formateado,CODE,KEY);
    if(is_numeric($idmarca)){
      //editar categoria
      $marca-> editar_marcas($idmarca,$nombre_mod);
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
    $idmarca = openssl_decrypt($formateado,CODE,KEY);
    if(is_numeric($idmarca)){
      $marca->borrar($idmarca);
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
else if($_POST['funcion'] == 'activar_marca'){
  $mensaje = '';
  if(!empty($_SESSION['id'])){
    $id = $_POST['id'];
    $formateado = str_replace(" ","+",$id);
    $idmarca = openssl_decrypt($formateado,CODE,KEY);
    if(is_numeric($idmarca)){
      $marca->activar($idmarca);
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




