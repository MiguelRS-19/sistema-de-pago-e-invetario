<?php 
include '../model/Backup.php';
$backup = new Backup();

if($_POST['funcion'] == 'backup'){
  $servidor = "localhost";
  $dbname = "dbservicio1"; //"u395705038_servicio_telec";
  $puerto = 3306;
  $charset = 'utf8';
  $usuario = "root"; //"u395705038_servicio_telec";
  $contrasena = ""; //"Telecomunicacion123@";
  $backup-> backupDatabase($servidor,$usuario,$contrasena,$dbname,$tables = '*');
}
