<?php 
include_once 'Conexion.php';
class MediosPago{
  var $objetos;
  var $acceso;
  public function __construct() {
    $db = new Conexion();
    $this->acceso = $db->pdo;
  }

  //Funcion de listar usuario a la vista del gestion usuario
  function obtener_MediosPagos(){
    $sql = "SELECT * FROM tipo_pago tp ORDER BY tp.idpago";
    $query = $this->acceso->prepare($sql);
    $query->execute();
    $this->objetos = $query->fetchAll();
    return $this->objetos;
  }

  //Funcion de llenar al select de tipo documento
  function encontrar_MediosPago($nombre){
    $sql = "SELECT * FROM tipo_pago WHERE nombre=:nombre;";
    $query = $this->acceso->prepare($sql);
    $variables = array(
      ':nombre'=> $nombre
    );
    $query->execute($variables);
    $this->objetos = $query->fetchAll();
    return $this->objetos;
  }

   //Funcion de registrar usuario
  function Registrar($nombre){
    $sql = "INSERT INTO tipo_pago(nombre) VALUES(:nombre)" ;
    $variables = array(
      ':nombre'=>$nombre
    );
    $query = $this->acceso->prepare($sql);
    $query->execute($variables);
  }


   //Funcion de eliminar de forma logica
  function borrar($id){
    $sql = "UPDATE tipo_pago SET estado=:estado WHERE idpago=:id";
    $query = $this->acceso->prepare($sql);
    $variables = array(
      ':id'=>$id,
      ':estado'=>'I',
    );
    $query->execute($variables);
    
  }

   //Funcion de activar medios de pago, osea verifica si esta el estado Inactivo vuelve activar
  function activar($id){
    $sql = "UPDATE tipo_pago SET estado=:estado WHERE idpago=:id";
    $query = $this->acceso->prepare($sql);
    $variables = array(
      ':id'=>$id,
      ':estado'=>'A',
    );
    $query->execute($variables);
    
  }

  //Funcion Editar Medios pago
  function editar_MediosPago($id_mod,$nombre_mod){
    $sql = "UPDATE tipo_pago SET nombre=:nombre where idpago=:id";
    $query = $this->acceso->prepare($sql);
    $variables =array(
      ':id'=>$id_mod,
      ':nombre'=>$nombre_mod,
      );
    $query->execute($variables);
  }

  //Funcion de editar imagen de modios de pago
  function editar_avatar($id_pago,$nombre){
    $sql = "UPDATE tipo_pago SET avatar=:nombre where idpago=:id";
    $variables = array(
      ':id'=>$id_pago,
      ':nombre'=>$nombre
    );
    $query = $this->acceso->prepare($sql);
    $query->execute($variables);
    return $this->objetos;
  }


  /************************************************** */

}