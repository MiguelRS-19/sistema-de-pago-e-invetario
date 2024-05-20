<?php 
include_once 'Conexion.php';
class Usuario{
  var $objetos;
  var $acceso;
  public function __construct() {
    $db = new Conexion();
    $this->acceso = $db->pdo;
  }

  //Funcion de loguearse
  function login($dni){
    $sql = "SELECT 
    u.idusuario as id,
    u.nombre as nombre,
    u.apellido as apellido,
    u.numero as dni,
    u.avatar as avatar,
    u.idtipo as idtipo,
    tp.cargo as cargo,
    u.clave as pass,
    u.estado as estado
    from usuario u 
    inner join tipo_usuario tp on tp.id=u.idtipo 
    where estado='A' and u.numero=:dni";
    $variables = array(
      ':dni'=>$dni
    );
    $query = $this->acceso->prepare($sql);
    $query->execute($variables);
    $this->objetos = $query->fetchAll();
    return $this->objetos;
  }


  //Funcion de listar usuario a la vista del perfil
  function obtener_datos($id_usuario){
    $sql = "SELECT * FROM usuario u inner join tipo_usuario tp on tp.id=u.idtipo where idusuario=:id";
    $variables = array(
      ':id'=>$id_usuario
    );
    $query = $this->acceso->prepare($sql);
    $query->execute($variables);
    $this->objetos = $query->fetchAll();
    return $this->objetos;
  }


  //Funcion editar perfil de usuario
  function editar_perfil($id_usuario,$direccion,$telefono,$correo){
    $sql = "UPDATE usuario SET telefono=:telefono, direccion=:direccion, email=:correo where idusuario=:id";
    $variables = array(
      ':id'=>$id_usuario,
      ':telefono'=>$telefono,
      ':direccion'=>$direccion,
      ':correo'=>$correo
    );
    $query = $this->acceso->prepare($sql);
    $query->execute($variables);
  }


  //Funcion de editar imagen de usuario
  function editar_avatar($id_usuario,$nombre){
    $sql = "UPDATE usuario SET avatar=:nombre where idusuario=:id";
    $variables = array(
      ':id'=>$id_usuario,
      ':nombre'=>$nombre
    );
    $query = $this->acceso->prepare($sql);
    $query->execute($variables);
    return $this->objetos;
  }
  
  //Funcion de cambiar contrasña
  function editar_contra($id_usuario,$nueva_pass){
    $sql = "UPDATE usuario SET clave=:newpass where idusuario=:id";
    $variables = array(
      ':id'=>$id_usuario,
      ':newpass'=>$nueva_pass
    );
    $query = $this->acceso->prepare($sql);
    $query->execute($variables);
    $this->objetos = $query->fetchAll();
    
  }

  //Funcion de listar usuario a la vista del gestion usuario
  function obtener_usuarios(){
    $sql = "SELECT * FROM usuario u inner join tipo_usuario tp on tp.id=u.idtipo ORDER BY u.idusuario";
    $query = $this->acceso->prepare($sql);
    $query->execute();
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

   //Funcion de registrar usuario
  function Registrar($nombre,$apellido,$tipo,$dni,$direccion,$telefono,$correo,$login,$clave){
      $sql = "INSERT INTO usuario(nombre,apellido,documento,numero,direccion,telefono,email,clave,login,idtipo) VALUES(:nombre,:apellido,:docum,:dni,:direccion,:telefono,:correo,:clave,:logi,:idtipo)" ;
      $variables = array(
        ':nombre'=>$nombre,
        ':apellido'=>$apellido,
        ':docum'=>$tipo,
        ':dni'=>$dni,
        ':direccion'=>$direccion,
        ':telefono'=>$telefono,
        ':correo'=>$correo,
        ':clave'=>$clave,
        ':logi'=>$login,
        ':idtipo'=>3,
      );
      $query = $this->acceso->prepare($sql);
      $query->execute($variables);
  }


   //Funcion de eliminar de forma logica
  function borrar($id){
    $sql = "UPDATE usuario SET estado=:estado WHERE idusuario=:id";
    $query = $this->acceso->prepare($sql);
    $variables = array(
      ':id'=>$id,
      ':estado'=>'I',
    );
    $query->execute($variables);
    
  }

   //Funcion de activar usuario, osea verifica si esta el estado Inactivo vuelve activar
  function activar($id){
    $sql = "UPDATE usuario SET estado=:estado WHERE idusuario=:id";
    $query = $this->acceso->prepare($sql);
    $variables = array(
      ':id'=>$id,
      ':estado'=>'A',
    );
    $query->execute($variables);
    
  }

   //Funcion actualizar tipo de usuario ascender y descender
  function actualizar_tipo_usuario($id_usuario,$tipo_usuario){
    $sql = "UPDATE usuario SET idtipo=:idtipo WHERE idusuario=:id";
    $query = $this->acceso->prepare($sql);
    $variables = array(
      ':id'=>$id_usuario,
      ':idtipo'=>$tipo_usuario,
    );
    $query->execute($variables);
    
  }

  //Funcion Editar usuario
  function editar_usuarios($id_mod,$nombre_mod,$apellido_mod,$tipo_mod,$dni_mod,$login_mod){
    $sql = "UPDATE usuario SET nombre=:nombre,apellido=:apellido,documento=:docum,numero=:dni,login=:logi where idusuario=:id";
    $query = $this->acceso->prepare($sql);
    $variables =array(
      ':id'=>$id_mod,
      ':nombre'=>$nombre_mod,
      ':apellido'=>$apellido_mod,
      ':docum'=>$tipo_mod,
      ':dni'=>$dni_mod,
      ':logi'=>$login_mod
      );
    $query->execute($variables);
  }


  /************************************************** */


  //UPDATE usuario set user = 'CESAR', pass = '123455' WHERE nombre = 'CESAR';
  
  /*function borrar($id){
    $sql = "SELECT * FROM cuenta where idusuario=:id";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':id'=>$id));
    $lote = $query->fetchAll();
    if(!empty($lote)){
      echo "noborrado";
    }else{
      $sql = "UPDATE usuario SET estado='I' where iduser=:id";
      $query = $this->acceso->prepare($sql);
      $query->execute(array(':id'=>$id));
      if(!empty($query->execute(array(':id'=>$id)))){
        echo "borrado";
      }else{
        echo "noborrado";
      }
    }
    
  }*/


  /*function mensaje_usuario(){
    $sql = "SELECT iduser,concat(u.nombre,' ',u.apellidos) as nombre,telefono,ct.cant_dinero as cancelar, date(ct.fecha_pago) as fecha FROM usuario u join cuota ct on ct.idusuario = u.iduser where u.estado='A';";
    $query = $this->acceso->prepare($sql);
    $query->execute();
    $this->objetos = $query->fetchAll();
    return $this->objetos;
  }*/


  



  function verificar($dni,$email){
    $sql = "SELECT * FROM usuario where correo=:email and dni=:dni" ;
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':dni'=>$dni,':email'=>$email));
    $this->objetos = $query->fetchAll();
    if(!empty($this->objetos)){
      if($query->rowCount()==1){
        echo 'encontrado';
      }else{
        echo 'noencontrado';
      }
    }else{
      echo 'noencontrado';
    }
  }

  function remplazar($codigo,$dni,$email){
    $sql = "UPDATE usuario SET pass=:codigo where correo=:email and dni=:dni" ;
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':codigo'=>$codigo,':dni'=>$dni,':email'=>$email));
    
    //echo 'remplazado';
  }



}