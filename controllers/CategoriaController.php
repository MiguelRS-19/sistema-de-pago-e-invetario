<?php 
include_once '../model/Categoria.php';
include_once '../util/config/config.php';
$categoria = new Categoria();
session_start();

if($_POST['funcion'] == 'obtener_categorias'){
  $json = array();
  $categoria-> obtener_categorias();
  //var_dump($cliente->objetos);
  foreach ($categoria->objetos as $objeto) {
    $json []= array(
      'id'=>openssl_encrypt($objeto->idcat,CODE,KEY),
      'nombre'=>$objeto->nombre,
      'estado'=>$objeto->estado
    );
  }
  $jsonstring = json_encode($json);
  echo $jsonstring;
}
else if($_POST['funcion'] == 'registro_categorias'){
  $mensaje = '';
  if(!empty($_SESSION['id'])){
    $nombre = $_POST['nombre'];
    $categoria-> encontrar_cat($nombre);
    if(empty($categoria->objetos)){
      $categoria-> Registrar($nombre);
      $mensaje = 'success';
    }else{
      $mensaje = 'error_categoria';
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
else if($_POST['funcion'] == 'editar_categorias'){
  $mensaje = '';
  if(!empty($_SESSION['id'])){
    $id_usuario = $_SESSION['id'];
    $idcat = $_POST['id'];
    $nombre_mod = $_POST['nombre_mod'];
    $formateado = str_replace(" ","+",$idcat);
    $idcat_mod = openssl_decrypt($formateado,CODE,KEY);
    if(is_numeric($idcat_mod)){
      //editar categoria
      $categoria-> editar_categorias($idcat_mod,$nombre_mod);
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
    $idcat = openssl_decrypt($formateado,CODE,KEY);
    if(is_numeric($idcat)){
      $categoria->borrar($idcat);
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
else if($_POST['funcion'] == 'activar_categoria'){
  $mensaje = '';
  if(!empty($_SESSION['id'])){
    $id = $_POST['id'];
    $formateado = str_replace(" ","+",$id);
    $idcat = openssl_decrypt($formateado,CODE,KEY);
    if(is_numeric($idcat)){
      $categoria->activar($idcat);
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




