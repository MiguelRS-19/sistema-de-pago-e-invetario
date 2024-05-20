<?php 
include_once('../model/ingresoMensual.php');
require_once('../vendor/autoload.php');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
$ingresoMensual = new IngresoMensual();
if($_POST['funcion'] == 'reporte_mensual'){
  date_default_timezone_set('America/Lima');
  $fecha = date('Y-m-d H:i:s');
  $html = '
  <header>
    <div id="logo">
      <img src="../util/img/avatarlogo.png" width="60" height="60"> 
    </div>
    <h1>REPORTE DE EFECTOS DE PAGOS</h1>
    <div id="project">
      <div>
        <span>Fecha y Hora: </span> '.$fecha.'
      </div>
    </div>
  </header>
  <table>
    <thead>
      <tr>
        <th>N°</th>
        <th>DNI</th>
        <th>CLIENTE</th>
        <th>MES</th>
        <th>FECHA PAGO</th>
        <th>DEUDA</th>
        <th>SALDO</th>
        <th>M.PAGO</th>
        <th>USUARIO</th>
        <th>ESTADO</th>
      </tr>
    </thead>
    <tbody>
  ';

  $fecha_mes = $_POST['mes'];
  $fecha_year = $_POST['fyear'];
  $ingresoMensual->reporte_mensual($fecha_mes, $fecha_year);
  $contador = 0;
  foreach ($ingresoMensual->objetos as $objeto) {
    $contador++;
    if($objeto->estado == 'Cancelado'){
      $html.='
      <tr class="pagado">
        <td>'.$contador.'</td>
        <td>'.$objeto->dni.'</td>
        <td>'.$objeto->cliente.'</td>
        <td>'.$objeto->mes.'</td>
        <td>'.$objeto->fecha.'</td>
        <td>'.$objeto->deuda.'</td>
        <td>'.$objeto->saldo.'</td>
        <td>'.$objeto->pago.'</td>
        <td>'.$objeto->usuario.'</td>
        <td>'.$objeto->estado.'</td>
      </tr>
    ';
    }else{
      $html.='
      <tr class="Pendiente">
        <td>'.$contador.'</td>
        <td>'.$objeto->dni.'</td>
        <td>'.$objeto->cliente.'</td>
        <td>'.$objeto->mes.'</td>
        <td>'.$objeto->fecha.'</td>
        <td>'.$objeto->deuda.'</td>
        <td>'.$objeto->saldo.'</td>
        <td>'.$objeto->pago.'</td>
        <td>'.$objeto->usuario.'</td>
        <td>'.$objeto->estado.'</td>
      </tr>
    ';
    }
  }
  $html.='
    </tbody>
  </table>
  ';
  $css = file_get_contents('../util/css/pdf.css');
  $mpdf = new \Mpdf\Mpdf();
  $mpdf->WriteHTML($css,\Mpdf\HTMLParserMode::HEADER_CSS);
  $mpdf->WriteHTML($html,\Mpdf\HTMLParserMode::HTML_BODY);
  $mpdf->Output("../pdf/pdf-".$_POST['funcion'].".pdf","F");
}
