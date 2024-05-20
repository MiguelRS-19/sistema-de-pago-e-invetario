<?php 
include_once 'Conexion.php';
class Producto{
  var $objetos;
  var $acceso;
  public function __construct() {
    $db = new Conexion();
    $this->acceso = $db->pdo;
  }

  //Funcion para obtener producto al carreito
  function obtener_productos(){
    $sql = "SELECT 
    p.idprod as id,
    p.codigo as codigo,
    p.nombre as producto,
    p.descripcion as descripcion,
    p.presentacion as presentacion,
    p.precio_venta as precio_venta,
    p.stock as stock,
    p.stock_minimo as stock_minimo,
    p.imagen as imagen,
    m.nombre as marca,
    c.nombre as categoria,
    p.estado as estado
    FROM producto p
    inner join marca m on p.idmarca = m.idmarca
    inner join categoria c on c.idcat = p.idcat 
    where p.estado = 'A' order by p.nombre;";
    $query = $this->acceso->prepare($sql);
    $query->execute();
    $this->objetos = $query->fetchAll();
    return $this->objetos;
  }


  //Funcion para traer producto
  function traer_productos(){
    $sql = "SELECT 
    p.idprod as id,
    p.codigo as codigo,
    p.nombre as producto,
    p.descripcion as descripcion,
    p.presentacion as presentacion,
    p.precio_venta as precio_venta,
    p.stock as stock,
    p.stock_minimo as stock_minimo,
    p.imagen as imagen,
    m.nombre as marca,
    m.idmarca as idmarca,
    c.nombre as categoria,
    c.idcat as idcat,
    p.estado as estado
    FROM producto p
    inner join marca m on p.idmarca = m.idmarca
    inner join categoria c on c.idcat = p.idcat order by p.nombre;";
    $query = $this->acceso->prepare($sql);
    $query->execute();
    $this->objetos = $query->fetchAll();
    return $this->objetos;
  }

  function generar(){
    $sql = "CALL sp_Generar_Codigo(@p0)" ;
    $query = $this->acceso->prepare($sql);
    $query->execute();
    $this->objetos = $query->fetchAll();
    if(!empty($this->objetos)){
      return 0;
    }else{
      $sql = "SELECT @p0 AS id_correlativo;" ;
      $query = $this->acceso->prepare($sql);
      $query->execute();
      $this->objetos = $query->fetchAll();
      return $this->objetos;
    }
  }

  //Funcion de llenar al select de categoria
  function obtener_categoria(){
    $sql = "SELECT * FROM categoria;";
    $query = $this->acceso->prepare($sql);
    $query->execute();
    $this->objetos = $query->fetchAll();
    return $this->objetos;
  }

  //Funcion de llenar al select de marca
  function obtener_marca(){
    $sql = "SELECT * FROM marca;";
    $query = $this->acceso->prepare($sql);
    $query->execute();
    $this->objetos = $query->fetchAll();
    return $this->objetos;
  }

  function encontrar_producto($codigo){
    $sql = "SELECT * FROM producto p WHERE codigo=:cod";
    $query = $this->acceso->prepare($sql);
    $variables = array(
      ':cod'=>$codigo
    );
    $query->execute($variables);
    $this->objetos = $query->fetchAll();
    return $this->objetos;
  }

  //Funcion de registrar producto
  function Registrar($codigo,$nombre,$descripcion,$presentacion,$precio_compra,$precio_venta,$stock,$stock_minimo,$idmarca,$idcat){
    $sql = "INSERT INTO producto(codigo,nombre,descripcion,presentacion,precio_compra,precio_venta,stock,stock_minimo,idmarca,idcat) VALUES(:cod,:nombre,:descripcion,:presentacion,:compra,:venta,:stock,:minimo,:marca,:cat)" ;
    $variables = array(
      ':cod'=>$codigo,
      ':nombre'=>$nombre,
      ':descripcion'=>$descripcion,
      ':presentacion'=>$presentacion,
      ':compra'=>$precio_compra,
      ':venta'=>$precio_venta,
      ':stock'=>$stock,
      ':minimo'=>$stock_minimo,
      ':marca'=>$idmarca,
      ':cat'=>$idcat
    );
    $query = $this->acceso->prepare($sql);
    $query->execute($variables);
}

}