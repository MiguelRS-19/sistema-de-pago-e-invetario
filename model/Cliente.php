<?php 
include_once 'Conexion.php';
class Cliente{
  var $objetos;
  var $acceso;
  public function __construct() {
    $db = new Conexion();
    $this->acceso = $db->pdo;
  }

  //Funcion de listar usuario a la vista del gestion usuario
  function obtener_clientes(){
    $sql = "SELECT * FROM cliente c ORDER BY c.idcliente DESC";
    $query = $this->acceso->prepare($sql);
    $query->execute();
    $this->objetos = $query->fetchAll();
    return $this->objetos;
  }

  function encontrar_cliente($dni){
    $sql = "SELECT * FROM cliente c WHERE numero=:dni";
    $query = $this->acceso->prepare($sql);
    $variables = array(
      ':dni'=>$dni
    );
    $query->execute($variables);
    $this->objetos = $query->fetchAll();
    return $this->objetos;
  }

  //Funcion de llenar al select de tipo documento
  function rellenar_docum(){
    $sql = "SELECT * FROM tipo_documento;";
    $query = $this->acceso->prepare($sql);
    $query->execute();
    $this->objetos = $query->fetchAll();
    return $this->objetos;
  }

   //Funcion de registrar cliente
  function Registrar($nombre,$apellido,$tipo,$dni,$direccion,$telefono,$edad){
      $sql = "INSERT INTO cliente(nombre,apellido,documento,numero,direccion,telefono,edad) VALUES(:nombre,:apellido,:docum,:dni,:direccion,:telefono,:edad)" ;
      $variables = array(
        ':nombre'=>$nombre,
        ':apellido'=>$apellido,
        ':docum'=>$tipo,
        ':dni'=>$dni,
        ':direccion'=>$direccion,
        ':telefono'=>$telefono,
        ':edad'=>$edad
      );
      $query = $this->acceso->prepare($sql);
      $query->execute($variables);
  }


  //Funcion Editar cliente
  function editar_clientes($idcliente_mod,$tipo_mod,$dni_mod,$nombre_mod,$apellido_mod,$direccion_mod,$telefono_mod,$edad_mod){
    $sql = "UPDATE cliente SET nombre=:nombre,apellido=:apellido,documento=:docum,numero=:dni,direccion=:direccion,telefono=:telefono,edad=:edad where idcliente=:id";
    $query = $this->acceso->prepare($sql);
    $variables =array(
      ':id'=>$idcliente_mod,
      ':nombre'=>$nombre_mod,
      ':apellido'=>$apellido_mod,
      ':docum'=>$tipo_mod,
      ':dni'=>$dni_mod,
      ':direccion'=>$direccion_mod,
      ':telefono'=>$telefono_mod,
      ':edad'=>$edad_mod
      );
    $query->execute($variables);
  }


   //Funcion de eliminar de forma logica
  function borrar($id){
    $sql = "UPDATE cliente SET estado=:estado WHERE idcliente=:id";
    $query = $this->acceso->prepare($sql);
    $variables = array(
      ':id'=>$id,
      ':estado'=>'I',
    );
    $query->execute($variables);
    
  }

  //Funcion de activar usuario, osea verifica si esta el estado Inactivo vuelve activar
  function activar($id){
    $sql = "UPDATE cliente SET estado=:estado WHERE idcliente=:id";
    $query = $this->acceso->prepare($sql);
    $variables = array(
      ':id'=>$id,
      ':estado'=>'A',
    );
    $query->execute($variables);
    
  }




























  /**************************************************** */
  /*function editar_cliente($idcli_mod,$nombre_mod,$apellido_mod,$docum_mod,$num_mod,$direccion_mod,$telefono_mod){
    $sql = "UPDATE cliente SET nombre=:nombre,apellidos=:apellido,documento=:docum,numero=:num,direccion=:direccion,telefono=:telefono where idcliente=:id";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':id'=>$idcli_mod,
                          ':nombre'=>$nombre_mod,
                          ':apellido'=>$apellido_mod,
                          ':docum'=>$docum_mod,
                          ':num'=>$num_mod,
                          ':direccion'=>$direccion_mod,
                          ':telefono'=>$telefono_mod,
    ));
  }*/
  //UPDATE usuario set user = 'CESAR', pass = '123455' WHERE nombre = 'CESAR';
  function crear($nombre,$apellido,$docum,$dni,$direccion,$telefono){
    $sql = "SELECT idcliente FROM cliente where numero=:dni" ;
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':dni'=>$dni));
    $this->objetos = $query->fetchAll();
    if(!empty($this->objetos)){
      foreach ($this->objetos as $cliEs) {
        $cli_id = $cliEs->idcliente;
        $cli_estado = $cliEs->estado;
      }
      if($cli_estado == 'A'){
        echo 'noadd';
      }else{
        $sql = "UPDATE cliente SET estado='A' WHERE idcliente=:id" ;
        $query = $this->acceso->prepare($sql);
        $query->execute(array(
          ':id'=>$cli_id,
          ));
        echo 'add';
      }
    }else{
      $sql = "INSERT INTO cliente(nombre,apellidos,documento,numero,direccion,telefono) VALUES(:nombre,:apellido,:docum,:dni,:direccion,:telefono)" ;
      $query = $this->acceso->prepare($sql);
      $query->execute(array(
        ':nombre'=>$nombre,
        ':apellido'=>$apellido,
        ':docum'=>$docum,
        ':dni'=>$dni,
        ':direccion'=>$direccion,
        ':telefono'=>$telefono
        ));
      echo 'add';
    }

  }

  function buscar(){
    $sql = "SELECT idcliente,nombre,apellidos,documento,numero,direccion,telefono FROM cliente where estado ='A' order by idcliente DESC" ;
    $query = $this->acceso->prepare($sql);
    $query->execute();
    $this->objetos = $query->fetchAll();
    return $this->objetos;
  }

  /*function mensaje_usuario(){
    $sql = "SELECT iduser,concat(u.nombre,' ',u.apellidos) as nombre,telefono,ct.cant_dinero as cancelar, date(ct.fecha_pago) as fecha FROM usuario u join cuota ct on ct.idusuario = u.iduser where u.estado='A';";
    $query = $this->acceso->prepare($sql);
    $query->execute();
    $this->objetos = $query->fetchAll();
    return $this->objetos;
  }*/


  /*function borrar($id){
    $sql = "SELECT * FROM detalle_servicio where idcliente=:id";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':id'=>$id));
    $lote = $query->fetchAll();
    if(!empty($lote)){
      echo "noborrado";
    }else{
      $sql = "UPDATE cliente SET estado='I' where idcliente=:id";
      $query = $this->acceso->prepare($sql);
      $query->execute(array(':id'=>$id));
      if(!empty($query->execute(array(':id'=>$id)))){
        echo "borrado";
      }else{
        echo "noborrado";
      }
    }
    
  }*/






}