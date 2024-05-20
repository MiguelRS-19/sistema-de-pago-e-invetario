<?php 
include '../model/MetodoPago.php';
$metodo = new Metodo();

if($_POST['funcion'] == 'buscar'){
  $metodo-> buscar();
  $json = array();
  foreach ($metodo->objetos as $objeto) {
    $json [] = array(
      'id'=>$objeto->idpago,
      'nombre'=>$objeto->nombre,
      'avatar'=>'../util/img/'.$objeto->avatar
    );
  }
  $jsonstring = json_encode($json);
  echo $jsonstring;
}


if($_POST['funcion'] == 'editar'){
  $id = $_POST['id'];
  $nombre_mod = $_POST['nombre_mod'];
  $metodo-> editar($id,$nombre_mod);
}

if($_POST['funcion'] == 'agregar_pago'){
  $nombre = $_POST['nombre'];
  $metodo-> crear($nombre);
}

if($_POST['funcion'] == 'cambiar_logo'){
  $id = $_POST['id-logo_pago'];
  $avatar = $_POST['avatar'];
  if(($_FILES['photo']['type']== 'image/jpg') || ($_FILES['photo']['type']== 'image/png')){
    $nombre = uniqid().'-'. $_FILES['photo']['name'];
    $ruta = '../util/img/'.$nombre;
    move_uploaded_file($_FILES['photo']['tmp_name'],$ruta);
    $metodo-> cambiar_logo($id,$nombre);
    if($avatar != '../util/img/pago_default.png'){
      unlink($avatar);
    }

    $json = array();
    $json [] = array(
      'ruta'=> $ruta,
      'alert'=>'edit'
    );
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
  }else{
    $json = array();
    $json [] = array(
      'alert'=>'noedit'
    );
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
  }
}


if($_POST['funcion'] == 'borrar'){
  $id = $_POST['id'];
  $metodo-> borrar($id);
}

if($_POST['funcion'] == 'rellenar_pagos'){
  $metodo-> rellenar_pago();
  $json = array();
  foreach ($metodo->objetos as $objeto) {
    $json [] = array(
      'id'=>$objeto->idpago,
      'nombre'=>$objeto->nombre
    );
  }
  $jsonstring = json_encode($json);
  echo $jsonstring;
}