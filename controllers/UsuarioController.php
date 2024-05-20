<?php 
include_once '../model/Usuario.php';
include_once '../util/config/config.php';
$usuario = new Usuario();
session_start();

if($_POST['funcion'] == 'login'){
  $dni = $_POST['dni'];
  $pass = $_POST['pass'];
  $usuario-> login($dni);
  $mensaje = '';
  if(!empty($usuario->objetos)){
    $pass_base = openssl_decrypt($usuario->objetos[0]->pass,CODE,KEY);
    if($pass_base != ''){
      //password de la base encriptado
      if($pass == $pass_base){
        //cambio de password 
        $_SESSION['id']= $usuario->objetos[0]->id;
        $_SESSION['nombre']= $usuario->objetos[0]->nombre;
        $_SESSION['apellido']= $usuario->objetos[0]->apellido;
        $_SESSION['dni']= $usuario->objetos[0]->dni;
        $_SESSION['idtipo']= $usuario->objetos[0]->idtipo;
        $_SESSION['cargo']= $usuario->objetos[0]->cargo;
        $_SESSION['avatar']= '../util/img/user/'.$usuario->objetos[0]->avatar;
        $mensaje = 'success';
      }else{
        $mensaje = 'error_pass';
      }
    }else{
      //password de la base no encriptado 
      if($pass == $usuario->objetos[0]->pass){
        //cambio de password 
        $_SESSION['id']= $usuario->objetos[0]->id;
        $_SESSION['nombre']= $usuario->objetos[0]->nombre;
        $_SESSION['apellido']= $usuario->objetos[0]->apellido;
        $_SESSION['dni']= $usuario->objetos[0]->dni;
        $_SESSION['idtipo']= $usuario->objetos[0]->idtipo;
        $_SESSION['cargo']= $usuario->objetos[0]->cargo;
        $_SESSION['avatar']= '../util/img/user/'.$usuario->objetos[0]->avatar;
        $mensaje = 'success';
      }else{
        $mensaje = 'error_pass';
      }

    }
  }else{
    $mensaje = 'error';
  }
  //var_dump($usuario->objetos);
  //echo $user.' '.$pass;
  $json = array(
    'mensaje'=>$mensaje
  );
  $jsonstring = json_encode($json);
  echo $jsonstring;
  
}else if($_POST['funcion'] == 'verificar_sesion'){
  if(!empty($_SESSION['id'])){
    $usuario-> login($_SESSION['dni']);
    if(!empty($usuario->objetos[0]->estado)){
      $json = array(
        'id'=>$_SESSION['id'],
        'nombre'=>$_SESSION['nombre'],
        'apellido'=>$_SESSION['apellido'],
        'dni'=>$_SESSION['dni'],
        'idtipo'=>$_SESSION['idtipo'],
        'cargo'=>$_SESSION['cargo'],
        'avatar'=>$_SESSION['avatar'],
      );
    }else{
      $json = array();
    }
  }else{
    $json = array();
  }
  $jsonstring = json_encode($json);
  echo $jsonstring;
  
}
else if($_POST['funcion'] == 'obtener_usuario'){
  $id_usuario = $_SESSION['id'];
  $usuario-> obtener_datos($id_usuario);
  //var_dump($usuario->objetos);
  $json = array();
  if(!empty($usuario->objetos)){
    $json= array(
      'id'=>openssl_encrypt($usuario->objetos[0]->id,CODE,KEY),
      'nombre'=>$usuario->objetos[0]->nombre,
      'apellido'=>$usuario->objetos[0]->apellido,
      'numero'=>$usuario->objetos[0]->numero,
      'telefono'=>$usuario->objetos[0]->telefono,
      'id_tipo'=>$usuario->objetos[0]->idtipo,
      'cargo'=>$usuario->objetos[0]->cargo,
      'direccion'=>$usuario->objetos[0]->direccion,
      'correo'=>$usuario->objetos[0]->email,
      'avatar'=>$usuario->objetos[0]->avatar
    );
    $jsonstring = json_encode($json);
    echo $jsonstring;

  }else{
    echo 'error';
  }
}
else if($_POST['funcion'] == 'editar_perfil'){
  //editar perfil
  $mensaje = '';
  if(!empty($_SESSION['id'])){
    $id_usuario = $_SESSION['id'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $usuario-> editar_perfil($id_usuario,$direccion,$telefono,$correo);
    $mensaje = 'success';
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
    $id_usuario = $_SESSION['id'];
    $nombre = uniqid().'-'. $_FILES['avatar_mod']['name'];
    $ruta = '../util/img/user/'.$nombre;
    move_uploaded_file($_FILES['avatar_mod']['tmp_name'],$ruta);
    $avatar = $_SESSION['avatar'];
    if($avatar != 'user_default.jpg'){
      unlink('../util/img/user/'.$avatar);
    }
    $_SESSION['avatar'] = $nombre;
    $usuario-> editar_avatar($id_usuario,$nombre);
    $mensaje = 'success';
  }else{
    $mensaje = 'error_sesion';
  }
  $json = array(
    'mensaje'=>$mensaje,
    'img'=>$nombre
  );
  $jsonstring = json_encode($json);
  echo $jsonstring;
}
else if($_POST['funcion'] == 'editar_password'){
  $mensaje = '';
  if(!empty($_SESSION['id'])){
    $id_usuario = $_SESSION['id'];
    $oldpass = $_POST['oldpass'];
    $newpass = $_POST['newpass'];
    $usuario-> obtener_datos($id_usuario);
    $pass_base = openssl_decrypt($usuario->objetos[0]->clave,CODE,KEY);
    if($pass_base != ''){
      //password de la base encriptado
      if($oldpass == $pass_base){
        //cambio de password 
        $nueva_pass = openssl_encrypt($newpass,CODE,KEY);
        $usuario-> editar_contra($id_usuario,$nueva_pass);
        $mensaje = 'success';
      }else{
        $mensaje = 'error_pass';
      }
    }else{
      //password de la base no encriptado 
      if($oldpass == $usuario->objetos[0]->clave){
        //cambio de password 
        $nueva_pass = openssl_encrypt($newpass,CODE,KEY);
        $usuario-> editar_contra($id_usuario,$nueva_pass);
        $mensaje = 'success';
      }else{
        $mensaje = 'error_pass';
      }

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
else if($_POST['funcion'] == 'obtener_usuarios'){
  $json = array();
  $usuario-> obtener_usuarios();
  //var_dump($usuario->objetos);
  foreach ($usuario->objetos as $objeto) {
    $json []= array(
      'id'=>openssl_encrypt($objeto->idusuario,CODE,KEY),
      'nombre'=>$objeto->nombre,
      'apellido'=>$objeto->apellido,
      'documento'=>$objeto->documento,
      'numero'=>$objeto->numero,
      'telefono'=>$objeto->telefono,
      'login'=>$objeto->login,
      'id_tipo'=>$objeto->idtipo,
      'cargo'=>$objeto->cargo,
      'direccion'=>$objeto->direccion,
      'correo'=>$objeto->email,
      'avatar'=>$objeto->avatar,
      'estado'=>$objeto->estado,
      'idtipo'=>$_SESSION['idtipo']
    );
  }
  $jsonstring = json_encode($json);
  echo $jsonstring;
}
else if($_POST['funcion'] == 'obtener_docum'){
  $usuario-> rellenar_docum();
  $json = array();
  foreach ($usuario->objetos as $objeto) {
    $json [] = array(
      'id'=>$objeto->idtipo_doc,
      'nombre'=>$objeto->nombre
    );
  }
  $jsonstring = json_encode($json);
  echo $jsonstring;
}
else if($_POST['funcion'] == 'registro_usuarios'){
  $mensaje = '';
  if(!empty($_SESSION['id'])){
    $id_usuario = $_SESSION['id'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $tipo = $_POST['docum'];
    $dni = $_POST['num'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $login = $_POST['login'];
    $clave = $_POST['clave'];
    $usuario-> login($dni);
    if(empty($usuario->objetos)){
      $usuario-> Registrar($nombre,$apellido,$tipo,$dni,$direccion,$telefono,$correo,$login,$clave);
      $mensaje = 'success';
    }else{
      $mensaje = 'error_usuario';
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
else if($_POST['funcion'] == 'eliminar_usuario'){
  $mensaje = '';
  if(!empty($_SESSION['id'])){
    $id_sesion = $_SESSION['id'];
    $id = $_POST['id_usuario'];
    $password = $_POST['pass'];
    $formateado = str_replace(" ","+",$id);
    $id_usuario = openssl_decrypt($formateado,CODE,KEY);
    if(is_numeric($id_usuario)){
      $usuario-> obtener_datos($id_sesion);
      $pass_base = openssl_decrypt($usuario->objetos[0]->clave,CODE,KEY);
      if($pass_base != ''){
        //password de la base encriptado
        if($password == $pass_base){
          //eliminar el usuario
          $usuario->borrar($id_usuario);
          $mensaje = 'success';
        }else{
          $mensaje = 'error_pass';
        }
      }else{
        //password de la base no encriptado 
        if($password == $usuario->objetos[0]->clave){
          //eliminar usuario
          $usuario->borrar($id_usuario);
          $mensaje = 'success';
        }else{
          $mensaje = 'error_pass';
        }

      }

    }else{
      $mensaje = 'error_decrypt';
    }

  }else{
    $mensaje = 'error_sesion';
  }
  $json = array(
    'mensaje'=>$mensaje,
    'funcion'=>"eliminar usuario"
  );
  $jsonstring = json_encode($json);
  echo $jsonstring;
}
else if($_POST['funcion'] == 'activar_usuario'){
  $mensaje = '';
  if(!empty($_SESSION['id'])){
    $id_sesion = $_SESSION['id'];
    $id = $_POST['id_usuario'];
    $password = $_POST['pass'];
    $formateado = str_replace(" ","+",$id);
    $id_usuario = openssl_decrypt($formateado,CODE,KEY);
    if(is_numeric($id_usuario)){
      $usuario-> obtener_datos($id_sesion);
      $pass_base = openssl_decrypt($usuario->objetos[0]->clave,CODE,KEY);
      if($pass_base != ''){
        //password de la base encriptado
        if($password == $pass_base){
          //eliminar el usuario
          $usuario->activar($id_usuario);
          $mensaje = 'success';
        }else{
          $mensaje = 'error_pass';
        }
      }else{
        //password de la base no encriptado 
        if($password == $usuario->objetos[0]->clave){
          //eliminar usuario
          $usuario->activar($id_usuario);
          $mensaje = 'success';
        }else{
          $mensaje = 'error_pass';
        }

      }

    }else{
      $mensaje = 'error_decrypt';
    }

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
else if($_POST['funcion'] == 'ascender_usuario'){
  $mensaje = '';
  if(!empty($_SESSION['id'])){
    $id_sesion = $_SESSION['id'];
    $id = $_POST['id_usuario'];
    $password = $_POST['pass'];
    $formateado = str_replace(" ","+",$id);
    $id_usuario = openssl_decrypt($formateado,CODE,KEY);
    $tipo_usuario = 2;
    if(is_numeric($id_usuario)){
      $usuario-> obtener_datos($id_sesion);
      $pass_base = openssl_decrypt($usuario->objetos[0]->clave,CODE,KEY);
      if($pass_base != ''){
        //password de la base encriptado
        if($password == $pass_base){
          //eliminar el usuario
          $usuario->actualizar_tipo_usuario($id_usuario,$tipo_usuario);
          $mensaje = 'success';
        }else{
          $mensaje = 'error_pass';
        }
      }else{
        //password de la base no encriptado 
        if($password == $usuario->objetos[0]->clave){
          //eliminar usuario
          $usuario->actualizar_tipo_usuario($id_usuario,$tipo_usuario);
          $mensaje = 'success';
        }else{
          $mensaje = 'error_pass';
        }

      }

    }else{
      $mensaje = 'error_decrypt';
    }

  }else{
    $mensaje = 'error_sesion';
  }
  $json = array(
    'mensaje'=>$mensaje,
    'funcion'=>"ascender usuario"
  );
  $jsonstring = json_encode($json);
  echo $jsonstring;
}
else if($_POST['funcion'] == 'descender_usuario'){
  $mensaje = '';
  if(!empty($_SESSION['id'])){
    $id_sesion = $_SESSION['id'];
    $id = $_POST['id_usuario'];
    $password = $_POST['pass'];
    $formateado = str_replace(" ","+",$id);
    $id_usuario = openssl_decrypt($formateado,CODE,KEY);
    $tipo_usuario = 3;
    if(is_numeric($id_usuario)){
      $usuario-> obtener_datos($id_sesion);
      $pass_base = openssl_decrypt($usuario->objetos[0]->clave,CODE,KEY);
      if($pass_base != ''){
        //password de la base encriptado
        if($password == $pass_base){
          //eliminar el usuario
          $usuario->actualizar_tipo_usuario($id_usuario,$tipo_usuario);
          $mensaje = 'success';
        }else{
          $mensaje = 'error_pass';
        }
      }else{
        //password de la base no encriptado 
        if($password == $usuario->objetos[0]->clave){
          //eliminar usuario
          $usuario->actualizar_tipo_usuario($id_usuario,$tipo_usuario);
          $mensaje = 'success';
        }else{
          $mensaje = 'error_pass';
        }

      }

    }else{
      $mensaje = 'error_decrypt';
    }

  }else{
    $mensaje = 'error_sesion';
  }
  $json = array(
    'mensaje'=>$mensaje,
    'funcion'=>"descender usuario"
  );
  $jsonstring = json_encode($json);
  echo $jsonstring;
}
else if($_POST['funcion'] == 'editar_usuarios'){
  $mensaje = '';
  if(!empty($_SESSION['id'])){
    $id_usuario = $_SESSION['id'];
    $idusuario_mod = $_POST['idusuario_mod'];
    $nombre_mod = $_POST['nombre_mod'];
    $apellido_mod = $_POST['apellido_mod'];
    $tipo_mod = $_POST['docum_mod'];
    $dni_mod = $_POST['num_mod'];
    $login_mod = $_POST['login_mod'];
    $formateado = str_replace(" ","+",$idusuario_mod);
    $id_mod = openssl_decrypt($formateado,CODE,KEY);
    if(is_numeric($id_mod)){
      //editar usuario
      $usuario-> editar_usuarios($id_mod,$nombre_mod,$apellido_mod,$tipo_mod,$dni_mod,$login_mod);
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




/************************************************************ */





/*if($_POST['funcion'] == 'obtener_dato_mensaje'){
  $usuario-> mensaje_usuario();
  $json = array();
  foreach ($usuario->objetos as $objeto) {
    $json [] = array(
      'id'=>$objeto->iduser,
      'nombre'=>$objeto->nombre,
      'telefono'=>$objeto->telefono,
      'cancelar'=>$objeto->cancelar,
      'fecha'=>$objeto->fecha,
    );
  }
  $jsonstring = json_encode($json);
  echo $jsonstring;
  
}*/


if($_POST['funcion'] == 'mensaje_movil'){
  require_once ('../vendor/autoload.php'); 
  $nombre = $_POST['nombre'];
  $telefono = $_POST['telefono'];
  $ultramsg_token="sic3sl8d8bwekcsl"; // Ultramsg.com token
  $instance_id="instance75900"; // Ultramsg.com instance id
  $client = new UltraMsg\WhatsAppApi($ultramsg_token,$instance_id);

  $to= $telefono; 
  $body="Estimado: $nombre, está próximo a complirce la fecha de pago de su servicio."; 
  $api=$client->sendChatMessage($to,$body);
  //print_r($api);
  //echo $api;
}




