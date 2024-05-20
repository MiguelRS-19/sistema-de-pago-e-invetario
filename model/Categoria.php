<?php 
include_once 'Conexion.php';
class Categoria{
  var $objetos;
  var $acceso;
  public function __construct() {
    $db = new Conexion();
    $this->acceso = $db->pdo;
  }

  //Funcion de listar usuario a la vista del gestion usuario
  function obtener_categorias(){
    $sql = "SELECT * FROM categoria c ORDER BY c.idcat";
    $query = $this->acceso->prepare($sql);
    $query->execute();
    $this->objetos = $query->fetchAll();
    return $this->objetos;
  }

  function encontrar_cat($nombre){
    $sql = "SELECT * FROM categoria c WHERE nombre=:nombre";
    $query = $this->acceso->prepare($sql);
    $variables = array(
      ':nombre'=>$nombre
    );
    $query->execute($variables);
    $this->objetos = $query->fetchAll();
    return $this->objetos;
  }


   //Funcion de registrar categoria
  function Registrar($nombre){
      $sql = "INSERT INTO categoria(nombre) VALUES(:nombre)" ;
      $variables = array(
        ':nombre'=>$nombre,
      );
      $query = $this->acceso->prepare($sql);
      $query->execute($variables);
  }


  //Funcion Editar categoria
  function editar_categorias($idcat_mod,$nombre_mod){
    $sql = "UPDATE categoria SET nombre=:nombre where idcat=:id";
    $query = $this->acceso->prepare($sql);
    $variables =array(
      ':id'=>$idcat_mod,
      ':nombre'=>$nombre_mod
      );
    $query->execute($variables);
  }


   //Funcion de eliminar de forma logica
  function borrar($id){
    $sql = "UPDATE categoria SET estado=:estado WHERE idcat=:id";
    $query = $this->acceso->prepare($sql);
    $variables = array(
      ':id'=>$id,
      ':estado'=>'I',
    );
    $query->execute($variables);
    
  }

  //Funcion de activar usuario, osea verifica si esta el estado Inactivo vuelve activar
  function activar($id){
    $sql = "UPDATE categoria SET estado=:estado WHERE idcat=:id";
    $query = $this->acceso->prepare($sql);
    $variables = array(
      ':id'=>$id,
      ':estado'=>'A',
    );
    $query->execute($variables);
    
  }


}