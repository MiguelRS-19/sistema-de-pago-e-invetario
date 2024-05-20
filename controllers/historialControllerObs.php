<?php 
include_once '../model/Historial.php';
$historial = new Historial();


if($_POST['funcion'] == 'ver'){
  $id = $_POST['id'];
  $historial-> ver($id);
  $json = array();
  foreach ($historial->objetos as $objeto) {
    $json[] = $objeto;
  }
  $jsonstring = json_encode($json);
  echo $jsonstring;
}

if($_POST['funcion'] == 'calcular_ingreso') {
  $id = $_POST['id'];
  $historial-> calcular_ingreso($id);
  $json = array();
  foreach ($historial->objetos as $objeto) {
    $json[] = $objeto;
  }
  $jsonstring = json_encode($json);
  echo $jsonstring;
}







