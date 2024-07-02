<?php 
include_once 'Conexion.php';
class Proveedor{
  var $objetos;
  var $acceso;
  public function __construct() {
    $db = new Conexion();
    $this->acceso = $db->pdo;
  }

  //Funcion de listar proveedor a la vista del gestion proveedor
  function obtener_Proveedores(){
    $sql = "SELECT pv.idprovee as idprovee, pv.documento as documento,
    pv.ruc as ruc, pv.razon_social as nombre, pv.direccion as direccion,
    pv.telefono as telefono, pv.correo as correo, pv.avatar as avatar,
    pv.estado as estado
    FROM proveedor pv ORDER BY pv.idprovee";
    $query = $this->acceso->prepare($sql);
    $query->execute();
    $this->objetos = $query->fetchAll();
    return $this->objetos;
  }

  //Funcion de encontrar proveedor si ya existe
  function encontrar_proveedor($ruc){
    $sql = "SELECT * FROM proveedor WHERE ruc=:ruc;";
    $query = $this->acceso->prepare($sql);
    $variables = array(
      ':ruc'=> $ruc
    );
    $query->execute($variables);
    $this->objetos = $query->fetchAll();
    return $this->objetos;
  }

   //Funcion de registrar proveedor
  function Registrar($documento,$ruc,$nombre,$direccion,$telefono,$correo){
    $sql = "INSERT INTO proveedor(documento,ruc,razon_social,direccion,telefono,correo) VALUES(:docum,:ruc,:nombre,:direccion,:telefono,:correo)" ;
    $variables = array(
      ':docum'=>$documento,
      ':ruc'=>$ruc,
      ':nombre'=>$nombre,
      ':direccion'=>$direccion,
      ':telefono'=>$telefono,
      ':correo'=>$correo
    );
    $query = $this->acceso->prepare($sql);
    $query->execute($variables);
  }

  //Funcion Editar proveedor
  function editar_proveedor($id_provee,$ruc_mod,$nombre_mod,$direccion_mod,$telefono_mod,$correo_mod){
    $sql = "UPDATE proveedor SET ruc=:ruc,razon_social=:nombre,direccion=:direccion,telefono=:telefono,correo=:correo where idprovee=:id";
    $query = $this->acceso->prepare($sql);
    $variables =array(
      ':id'=>$id_provee,
      ':ruc'=>$ruc_mod,
      ':nombre'=>$nombre_mod,
      ':direccion'=>$direccion_mod,
      ':telefono'=>$telefono_mod,
      ':correo'=>$correo_mod
      );
    $query->execute($variables);
  }

  //Funcion de editar avatar de proveedor
  function editar_avatar($idprovee,$nombre){
    $sql = "UPDATE proveedor SET avatar=:nombre where idprovee=:id";
    $variables = array(
      ':id'=>$idprovee,
      ':nombre'=>$nombre
    );
    $query = $this->acceso->prepare($sql);
    $query->execute($variables);
    return $this->objetos;
  }

   //Funcion de eliminar de forma logica
  function borrar($id){
    $sql = "UPDATE proveedor SET estado=:estado WHERE idprovee=:id";
    $query = $this->acceso->prepare($sql);
    $variables = array(
      ':id'=>$id,
      ':estado'=>'I',
    );
    $query->execute($variables);
    
  }

   //Funcion de activar proveedor, osea verifica si esta el estado Inactivo vuelve activar
  function activar($id){
    $sql = "UPDATE proveedor SET estado=:estado WHERE idprovee=:id";
    $query = $this->acceso->prepare($sql);
    $variables = array(
      ':id'=>$id,
      ':estado'=>'A',
    );
    $query->execute($variables);
    
  }


}