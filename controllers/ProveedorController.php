<?php 
include_once '../model/Proveedor.php';
include_once '../util/config/config.php';
$proveedor = new Proveedor();
session_start();
if($_POST['funcion'] == 'obtener_proveedores'){
  $json = array();
  $proveedor-> obtener_proveedores();
  //var_dump($usuario->objetos);
  foreach ($proveedor->objetos as $objeto) {
    $json []= array(
      'id'=>openssl_encrypt($objeto->idprovee,CODE,KEY),
      'documento'=>$objeto->documento,
      'ruc'=>$objeto->ruc,
      'nombre'=>$objeto->nombre,
      'direccion'=>$objeto->direccion,
      'telefono'=>$objeto->telefono,
      'correo'=>$objeto->correo,
      'avatar'=>$objeto->avatar,
      'estado'=>$objeto->estado,
    );
  }
  $jsonstring = json_encode($json);
  echo $jsonstring;
}
else if($_POST['funcion'] == 'registro_proveedores'){
  $mensaje = '';
  if(!empty($_SESSION['id'])){
    $documento = $_POST['docum'];
    $ruc = $_POST['ruc'];
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $proveedor-> encontrar_proveedor($ruc);
    if(empty($proveedor->objetos)){
      $proveedor-> Registrar($documento,$ruc,$nombre,$direccion,$telefono,$correo);
      $mensaje = 'success';
    }else{
      $mensaje = 'error_provee';
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
else if($_POST['funcion'] == 'editar_proveedores'){
  $mensaje = '';
  if(!empty($_SESSION['id'])){
    $id = $_POST['id'];
    $ruc_mod = $_POST['ruc_mod'];
    $nombre_mod = $_POST['nombre_mod'];
    $direccion_mod = $_POST['direccion_mod'];
    $telefono_mod = $_POST['telefono_mod'];
    $correo_mod = $_POST['correo_mod'];
    $formateado = str_replace(" ","+",$id);
    $id_provee = openssl_decrypt($formateado,CODE,KEY);
    if(is_numeric($id_provee)){
      //editar proveedor
      $proveedor-> editar_proveedor($id_provee,$ruc_mod,$nombre_mod,$direccion_mod,$telefono_mod,$correo_mod);
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
else if($_POST['funcion'] == 'editar_avatar'){
  $mensaje = '';
  if(!empty($_SESSION['id'])){
    $id = $_POST['idprovee'];
    $avatar = $_POST['avatar1'];
    $formateado = str_replace(" ","+",$id);
    $idprovee = openssl_decrypt($formateado,CODE,KEY);
    if(is_numeric($idprovee)){
      //editar avatar
      $nombre = uniqid().'-'. $_FILES['avatar_mod']['name'];
      $ruta = '../util/img/proveedor/'.$nombre;
      move_uploaded_file($_FILES['avatar_mod']['tmp_name'],$ruta);
      if($avatar != 'provee_default.png'){
        unlink('../util/img/proveedor/'.$avatar);
      }
      $proveedor-> editar_avatar($idprovee,$nombre);
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
    $id_provee = openssl_decrypt($formateado,CODE,KEY);
    if(is_numeric($id_provee)){
      //eliminar proveedor
      $proveedor->borrar($id_provee);
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
    $id_provee = openssl_decrypt($formateado,CODE,KEY);
    if(is_numeric($id_provee)){
      //activar proveedor
      $proveedor->activar($id_provee);
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

