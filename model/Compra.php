<?php 
include_once 'Conexion.php';
class Compra{
  var $objetos;
  var $acceso;
  public function __construct() {
    $db = new Conexion();
    $this->acceso = $db->pdo;
  }


  //Funcion de listar usuario a la vista del gestion usuario
  function obtener_compras(){
    $sql = "SELECT c.idcompra as idcompra,pv.razon_social as nombre,p.nombre as producto,
    p.descripcion as descripcion,p.presentacion as presentacion,c.fecha_creacion as fecha,
    tp.nombre as medios,dc.cantidad as cantidad,CONCAT('S/',dc.precio_unitario) as precio_unitario,
    CONCAT('S/',c.total) as total,tc.nombre as comprobante,c.estado as estado FROM compra c 
    INNER JOIN detalle_compra dc on dc.idcompra = c.idcompra
    INNER JOIN producto p on p.idprod = dc.idproducto
    INNER JOIN proveedor pv on pv.idprovee = c.idproveedor
    INNER JOIN tipo_comprobante tc on tc.id = c.idcomprobante
    INNER JOIN tipo_pago tp on tp.idpago = c.id_tpago ORDER BY c.fecha_creacion DESC";
    $query = $this->acceso->prepare($sql);
    $query->execute();
    $this->objetos = $query->fetchAll();
    return $this->objetos;
  }

  //Funcion de llenar al select de tipo documento
  function rellenar_tipo(){
    $sql = "SELECT * FROM tipo_comprobante;";
    $query = $this->acceso->prepare($sql);
    $query->execute();
    $this->objetos = $query->fetchAll();
    return $this->objetos;
  }

  function encontrar_producto($id){
    $sql = "SELECT * FROM producto where idprod=:id;";
    $query = $this->acceso->prepare($sql);
    $variables = array(
      'id'=>$id
    );
    $query->execute($variables);
    $this->objetos = $query->fetchAll();
    return $this->objetos;
  }

   //Funcion de registrar compra
  function Registrar($nota,$cantidad,$precio,$tp_pago,$idprovee,$idcomp,$idprod){
      $sql = " CALL agregar_compra(:nota, :cantidad, :precio, :medios, :provee, :comprob, :prod);" ;
      $variables = array(
        ':nota'=>$nota,
        ':cantidad'=>$cantidad,
        ':precio'=>$precio,
        ':medios'=>$tp_pago,
        ':provee'=>$idprovee,
        ':comprob'=>$idcomp,
        ':prod'=>$idprod
      );
      $query = $this->acceso->prepare($sql);
      $query->execute($variables);
  }


}