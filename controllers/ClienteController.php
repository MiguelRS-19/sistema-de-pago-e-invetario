<?php 
include_once '../model/Cliente.php';
include_once '../util/config/config.php';
session_start();
$cliente = new Cliente();
date_default_timezone_set('America/Lima');
//$fecha_actual = date('d-m-Y');

if($_POST['funcion'] == 'obtener_clientes'){
  $json = array();
  $cliente-> obtener_clientes();
  //var_dump($cliente->objetos);
  foreach ($cliente->objetos as $objeto) {
    $nacimiento = new DateTime($objeto->edad);
    $fecha_actual = date('d-m-Y');
    $fecha_actual1 = new DateTime($fecha_actual);
    $edad = $nacimiento->diff($fecha_actual1);
    $edad_years = $edad->y;
    $json []= array(
      'id'=>$objeto->idcliente,
      'nombre'=>$objeto->nombre,
      'apellido'=>$objeto->apellido,
      'documento'=>$objeto->documento,
      'numero'=>$objeto->numero,
      'direccion'=>$objeto->direccion,
      'telefono'=>$objeto->telefono,
      'edad'=>$edad_years,
      'estado'=>$objeto->estado
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
else if($_POST['funcion'] == 'registro_clientes'){
  $mensaje = '';
  if(!empty($_SESSION['id'])){
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $tipo = $_POST['docum'];
    $dni = $_POST['num'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $edad = $_POST['fecha_nac'];
    $cliente-> encontrar_cliente($dni);
    if(empty($cliente->objetos && $cliente->objetos[0]->numero !='C/N')){
      $cliente-> Registrar($nombre,$apellido,$tipo,$dni,$direccion,$telefono,$edad);
      $mensaje = 'success';
    }else{
      $mensaje = 'error_cliente';
    }

  }else{
    $mensaje = 'error_sesion';
  }
  $json = array(
    'mensaje'=>$mensaje,
  );
  $jsonstring = json_encode($json);
  echo $jsonstring;
}else if($_POST['funcion'] == 'editar_clientes'){
  $mensaje = '';
  if(!empty($_SESSION['id'])){
    $idcliente_mod = $_POST['idcliente_mod'];
    $tipo_mod = $_POST['docum_mod'];
    $dni_mod = $_POST['num_mod'];
    $nombre_mod = $_POST['nombre_mod'];
    $apellido_mod = $_POST['apellido_mod'];
    $direccion_mod = $_POST['direccion_mod'];
    $telefono_mod = $_POST['telefono_mod'];
    $edad_mod = $_POST['fecha_nac_mod'];
    //editar usuario
    $cliente-> editar_clientes($idcliente_mod,$tipo_mod,$dni_mod,$nombre_mod,$apellido_mod,$direccion_mod,$telefono_mod,$edad_mod);
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
else if($_POST['funcion'] == 'enviar_mensajes'){
  require_once ('../vendor/autoload.php');
  $mensaje = '';
  if(!empty($_SESSION['id'])){
    $nombre = $_POST['nombre_mensaje'];
    $telefono = $_POST['telefono_mensaje'];
    if($telefono  != 'null'){
      $dia = $_POST['fecha_mensaje'];
      //date_default_timezone_set('America/Lima');
      //$fecha_actual = date('d-m-Y');
      $dia_antes = (28-5);
      if($dia_antes == $dia){
        $ultramsg_token="uptc5mzi99dqpy84";//"sic3sl8d8bwekcsl"; // Ultramsg.com token
        $instance_id="instance83324";//"instance75900"; // Ultramsg.com instance id
        $client = new UltraMsg\WhatsAppApi($ultramsg_token,$instance_id);
        $to= $telefono;
        $body="Estimado: $nombre, está próximo a cumplírse la fecha de pago de su servicio."; 
        $api=$client->sendChatMessage($to,$body);
        $mensaje = 'success';
      }else{
        $mensaje = 'error_mensaje';
      }
    }else{
      $mensaje = 'vacio_telefono';
    }
  }else{
    $mensaje = 'error_sesion';
  }
  $json = array(
    'mensaje'=>$mensaje
  );
  $jsonstring = json_encode($json);
  echo $jsonstring;
  //print_r($api);
  //echo $api;

}
else if($_POST['funcion'] == 'obtener_cliente'){
  $json = array();
  $cliente-> obtener_clientes();
  //var_dump($cliente->objetos);
  foreach ($cliente->objetos as $objeto) {
    $json []= array(
      'id'=>openssl_encrypt($objeto->idcliente,CODE,KEY),
      'nombre'=>$objeto->nombre.' '.$objeto->apellido,
      'estado'=>$objeto->estado
    );
  }
  $jsonstring = json_encode($json);
  echo $jsonstring;
}





