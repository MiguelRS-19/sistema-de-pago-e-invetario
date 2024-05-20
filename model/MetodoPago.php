<?php 
include_once 'Conexion.php';
class Metodo{
  var $objetos;
  var $acceso;
  public function __construct() {
    $db = new Conexion();
    $this->acceso = $db->pdo;
  }

  function buscar(){
    if(!empty($_POST['consulta'])){
      $consulta = $_POST['consulta'];
      $sql = "SELECT * FROM tipo_pago  where estado='A' and nombre like :consulta" ;
      $query = $this->acceso->prepare($sql);
      $query->execute(array(':consulta'=>"%$consulta%"));
      $this->objetos = $query->fetchAll();
      return $this->objetos;
    }else{
      $sql = "SELECT * FROM tipo_pago  where estado='A' and nombre not like '' order by idpago desc limit 25";
      $query = $this->acceso->prepare($sql);
      $query->execute();
      $this->objetos = $query->fetchAll();
      return $this->objetos;
    }
  }



  function editar($id,$nombre_mod){
    $sql = "SELECT idpago FROM tipo_pago where idpago !=:id and nombre=:nombre " ;
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':id'=>$id,
                          ':nombre'=>$nombre_mod
                          ));
    $this->objetos = $query->fetchAll();
    if(!empty($this->objetos)){
      echo 'noedit';
    }else{
      $sql = "UPDATE tipo_pago SET nombre=:nombre where idpago=:id";
      $query = $this->acceso->prepare($sql);
      $query->execute(array(':id'=>$id,
                            ':nombre'=>$nombre_mod
      ));
      echo 'edit';
    }
    
  }

  function crear($nombre){
    $sql = "SELECT idpago FROM tipo_pago where nombre=:nombre" ;
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':nombre'=>$nombre));
    $this->objetos = $query->fetchAll();
    if(!empty($this->objetos)){
      echo 'noadd';
    }else{
      $sql = "INSERT INTO tipo_pago(nombre) VALUES(:nombre)" ;
      $query = $this->acceso->prepare($sql);
      $query->execute(array(
        ':nombre'=>$nombre
        ));
      echo 'add';
    }
  }

  function cambiar_logo($id,$nombre){

    $sql = "UPDATE tipo_pago SET avatar=:nombre where idpago=:id";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':id'=>$id,':nombre'=>$nombre));
    return $this->objetos;
  }


  function borrar($id){
    $sql = "SELECT * FROM cuota where idpago=:id";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':id'=>$id));
    $lote = $query->fetchAll();
    if(!empty($lote)){
      echo "noborrado";
    }else{
      $sql = "UPDATE tipo_pago SET estado='I' where idpago=:id";
      $query = $this->acceso->prepare($sql);
      $query->execute(array(':id'=>$id));
      if(!empty($query->execute(array(':id'=>$id)))){
        echo "borrado";
      }else{
        echo "noborrado";
      }
    }
    
  }

  function rellenar_pago(){
    $sql = "SELECT * FROM tipo_pago where estado = 'A' order by nombre asc";
    $query = $this->acceso->prepare($sql);
    $query->execute();
    $this->objetos = $query->fetchAll();
    return $this->objetos;
  }
}