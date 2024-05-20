<?php 
include_once '../model/MediosPago.php';
include_once '../util/config/config.php';
$mediosPago = new MediosPago();
session_start();
if($_POST['funcion'] == 'obtener_MediosPagos'){
  $json = array();
  $mediosPago-> obtener_MediosPagos();
  //var_dump($usuario->objetos);
  foreach ($mediosPago->objetos as $objeto) {
    $json []= array(
      'id'=>openssl_encrypt($objeto->idpago,CODE,KEY),
      'nombre'=>$objeto->nombre,
      'avatar'=>$objeto->avatar,
      'estado'=>$objeto->estado,
    );
  }
  $jsonstring = json_encode($json);
  echo $jsonstring;
}
else if($_POST['funcion'] == 'registro_MediosPagos'){
  $mensaje = '';
  if(!empty($_SESSION['id'])){
    $id_usuario = $_SESSION['id'];
    $nombre = $_POST['nombre'];
    $mediosPago-> encontrar_MediosPago($nombre);
    if(empty($mediosPago->objetos)){
      $mediosPago-> Registrar($nombre);
      $mensaje = 'success';
    }else{
      $mensaje = 'error_pago';
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
else if($_POST['funcion'] == 'editar_avatar'){
  $mensaje = '';
  if(!empty($_SESSION['id'])){
    $id = $_POST['id'];
    $avatar = $_POST['avatar1'];
    $formateado = str_replace(" ","+",$id);
    $id_pago = openssl_decrypt($formateado,CODE,KEY);
    if(is_numeric($id_pago)){
      //editar medios de pago
      $nombre = uniqid().'-'. $_FILES['avatar_mod']['name'];
      $ruta = '../util/img/'.$nombre;
      move_uploaded_file($_FILES['avatar_mod']['tmp_name'],$ruta);
      if($avatar != 'pago_default.png'){
        unlink('../util/img/'.$avatar);
      }
      $mediosPago-> editar_avatar($id_pago,$nombre);
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
    $id_pago = openssl_decrypt($formateado,CODE,KEY);
    if(is_numeric($id_pago)){
      //eliminar el usuario
      $mediosPago->borrar($id_pago);
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
    $id_pago = openssl_decrypt($formateado,CODE,KEY);
    if(is_numeric($id_pago)){
      //activar medios de pago
      $mediosPago->activar($id_pago);
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
else if($_POST['funcion'] == 'editar_MediosPagos'){
  $mensaje = '';
  if(!empty($_SESSION['id'])){
    $id_usuario = $_SESSION['id'];
    $id_pago = $_POST['id_pago'];
    $nombre_mod = $_POST['nombre_mod'];
    $formateado = str_replace(" ","+",$id_pago);
    $id_mod = openssl_decrypt($formateado,CODE,KEY);
    if(is_numeric($id_mod)){
      //editar medios de pago
      $mediosPago-> editar_MediosPago($id_mod,$nombre_mod);
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
else if($_POST['funcion'] == 'obtener_mediosPago'){
  $json = array();
  $mediosPago-> obtener_MediosPagos();
  //var_dump($usuario->objetos);
  foreach ($mediosPago->objetos as $objeto) {
    $json []= array(
      'id'=>openssl_encrypt($objeto->idpago,CODE,KEY),
      'nombre'=>$objeto->nombre,
      'estado'=>$objeto->estado
    );
  }
  $jsonstring = json_encode($json);
  echo $jsonstring;
}
