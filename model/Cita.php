<?php 
include_once 'Conexion.php';
class Cita{
  var $objetos;
  var $acceso;
  public function __construct() {
    $db = new Conexion();
    $this->acceso = $db->pdo;
  }


  //Funcion de listar usuario a la vista del gestion usuario
  function obtener_citas(){
    $sql = "SELECT ct.id as id,ct.motivo as motivo,ct.fecha_inicio as inicio,ct.fecha_final as final,
    ct.color as color,ct.saldo as saldo,CONCAT(c.nombre,' ',c.apellido) as cliente,
    CONCAT(u.nombre,' ',u.apellido) as usuario FROM cita ct
    INNER JOIN cliente c on c.idcliente = ct.idcliente
    INNER JOIN usuario u on u.idusuario = ct.idusuario";
    $query = $this->acceso->prepare($sql);
    $query->execute();
    $this->objetos = $query->fetchAll();
    return $this->objetos;
  }


  function encontrar($id){
    $sql = "SELECT c.descripcion as descri, c.fecha_consumo as consumo, 
            c.fecha_pago as fecha_pago, c.fecha_plazo as fecha_plazo, 
            c.deuda as deuda, c.saldo as saldo FROM cliente cl
            inner join cuenta c on c.idcliente = cl.idcliente
            where cl.idcliente=:id;";
    $query = $this->acceso->prepare($sql);
    $variables = array(
      'id'=>$id
    );
    $query->execute($variables);
    $this->objetos = $query->fetchAll();
    return $this->objetos;
  }

   //Funcion de registrar compra
  function Registrar($motivo,$inicio,$final,$saldo,$color,$idcli,$idusuario){
      $sql = "INSERT INTO cita(motivo,fecha_inicio, fecha_final, saldo, color,idcliente, idusuario) values(:motivo, :inicio, :final, :saldo, :color, :idcli, :idusuario);" ;
      $variables = array(
        ':motivo'=>$motivo,
        ':inicio'=>$inicio,
        ':final'=>$final,
        ':saldo'=>$saldo,
        ':color'=>$color,
        ':idcli'=>$idcli,
        ':idusuario'=>$idusuario
      );
      $query = $this->acceso->prepare($sql);
      $query->execute($variables);
  }

  //Funcion Editar citas
  function editar($motivo_mod,$inicio_mod,$final_mod,$saldo_mod,$color_mod,$id,$idusuario){
    $sql = "UPDATE cita SET motivo=:motivo,fecha_inicio=:inicio,fecha_final=:final,saldo=:saldo,color=:color,idusuario=:idusuario where id=:id";
    $query = $this->acceso->prepare($sql);
    $variables =array(
      ':id'=>$id,
      ':motivo'=>$motivo_mod,
      ':inicio'=>$inicio_mod,
      ':final'=>$final_mod,
      ':saldo'=>$saldo_mod,
      ':color'=>$color_mod,
      ':idusuario'=>$idusuario
      );
    $query->execute($variables);
  }

  //Funcion de eliminar de forma fisica
  function borrar($id){
    $sql = "DELETE FROM cita WHERE id=:id";
    $query = $this->acceso->prepare($sql);
    $variables = array(
      ':id'=>$id
    );
    $query->execute($variables);
    
  }


}