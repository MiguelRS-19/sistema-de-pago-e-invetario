<?php 
include_once 'Conexion.php';
class Marca{
  var $objetos;
  var $acceso;
  public function __construct() {
    $db = new Conexion();
    $this->acceso = $db->pdo;
  }

  //Funcion de listar usuario a la vista del gestion usuario
  function obtener_marcas(){
    $sql = "SELECT * FROM marca m ORDER BY m.idmarca";
    $query = $this->acceso->prepare($sql);
    $query->execute();
    $this->objetos = $query->fetchAll();
    return $this->objetos;
  }

  function encontrar_mar($nombre){
    $sql = "SELECT * FROM marca m WHERE nombre=:nombre";
    $query = $this->acceso->prepare($sql);
    $variables = array(
      ':nombre'=>$nombre
    );
    $query->execute($variables);
    $this->objetos = $query->fetchAll();
    return $this->objetos;
  }


   //Funcion de registrar marca
  function Registrar($nombre){
      $sql = "INSERT INTO marca(nombre) VALUES(:nombre)" ;
      $variables = array(
        ':nombre'=>$nombre,
      );
      $query = $this->acceso->prepare($sql);
      $query->execute($variables);
  }


  //Funcion Editar marca
  function editar_marcas($idmarca,$nombre_mod){
    $sql = "UPDATE marca SET nombre=:nombre where idmarca=:id";
    $query = $this->acceso->prepare($sql);
    $variables =array(
      ':id'=>$idmarca,
      ':nombre'=>$nombre_mod
      );
    $query->execute($variables);
  }


   //Funcion de eliminar de forma logica
  function borrar($id){
    $sql = "UPDATE marca SET estado=:estado WHERE idmarca=:id";
    $query = $this->acceso->prepare($sql);
    $variables = array(
      ':id'=>$id,
      ':estado'=>'I',
    );
    $query->execute($variables);
    
  }

  //Funcion de activar marca, osea verifica si esta el estado Inactivo vuelve activar
  function activar($id){
    $sql = "UPDATE marca SET estado=:estado WHERE idmarca=:id";
    $query = $this->acceso->prepare($sql);
    $variables = array(
      ':id'=>$id,
      ':estado'=>'A',
    );
    $query->execute($variables);
    
  }

}