<?php
include_once 'Conexion.php';
class VentaProducto{
  var $objetos;
  var $acceso;
  public function __construct() {
    $db = new Conexion();
    $this->acceso = $db->pdo;
  }

  function obtener($id){
    $sql = "SELECT vp.precio_venta as precio,cantidad,p.nombre as producto,p.descripcion as descripcion,
    p.presentacion as presentacion, m.nombre as marca,subtotal
    FROM venta_producto as vp
    join producto p on p.idprod=vp.idproducto
    join marca m on m.idmarca=p.idmarca where idventa=:id
    " ;
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':id'=>$id));
    $this->objetos = $query->fetchAll();
    return $this->objetos;
  }

  function borrar($id_venta){
    $sql = "DELETE FROM venta_producto WHERE venta_id_venta=:id_venta" ;
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':id_venta'=>$id_venta));
  }
  
}