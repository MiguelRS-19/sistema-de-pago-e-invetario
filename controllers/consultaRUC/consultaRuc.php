<?php
// Datos
//$token = 'apis-token-1.aTSI1U7KEuT-6bbbCguH-4Y8TI6KS73N';
$token = 'YQzXMjHjQdvjMV5hmmwfYbf9MEL7h0NZxhbsOioahSrY7N09Dsy3nTxirvypkOEZ';
$ruc = $_REQUEST['ruc'];

// Iniciar llamada a API
$curl = curl_init();

// Buscar ruc sunat
curl_setopt_array($curl, array(
  // para user api versión 2
  //CURLOPT_URL => 'https://api.apis.net.pe/v2/reniec/dni?numero=' . $dni,
  // para user api versión 1
  CURLOPT_URL => 'https://api.sunat.dev/ruc/'. $ruc.'?apikey=' . $token,
  //CURLOPT_URL => 'https://api.apis.net.pe/v1/dni?numero=' . $dni,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_SSL_VERIFYPEER => 0,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_CUSTOMREQUEST => 'GET',
  /*CURLOPT_HTTPHEADER => array(
    'Referer: https://apis.net.pe/consulta-dni-api',
    'Authorization: Bearer ' . $token
  ),*/
));

$response = curl_exec($curl);
echo $response;
//curl_close($curl);
// Datos listos para usar
//$persona = json_decode($response);
//var_dump($empresa);

