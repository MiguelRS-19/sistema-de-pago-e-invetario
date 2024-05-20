<?php 
include_once '../model/Historial.php';
$historial = new Historial();


if($_POST['funcion'] == 'ver'){
  $id = $_POST['id'];
  $historial-> ver($id);
  $json = array();
  foreach ($historial->objetos as $objeto) {
    $json []= array(
      'id'=>$objeto->id,
      'cliente'=>$objeto->cliente,
      'descripcion'=>$objeto->descripcion,
      'consumo'=>$objeto->consumo,
      'fecha_pago'=>$objeto->fecha,
      'deuda'=>$objeto->deuda,
      'abono'=>$objeto->abono,
      'saldo'=>$objeto->saldo,
      'vuelto'=>$objeto->vuelto,
      'medios'=>$objeto->medios,
      'usuario'=>$objeto->usuario,
      'estado'=>$objeto->estado,
      'opcion'=>$objeto->opcion,
    );
  }
  $jsonstring = json_encode($json);
  echo $jsonstring;
}
else if($_POST['funcion'] == 'calculo') {
  $id = $_POST['id'];
  $historial-> calculo($id);
  $json = array();
  foreach ($historial->objetos as $objeto) {
    $json []= array(
      'importeTotal'=>$objeto->importe,
      'abonoTotal'=>$objeto->abono,
      'saldoTotal'=>$objeto->saldo,
      'vueltoTotal'=>$objeto->vuelto,
    );
  }
  $jsonstring = json_encode($json);
  echo $jsonstring;
}







