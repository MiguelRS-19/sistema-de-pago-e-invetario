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
    p.precio_compra as precio_compra,
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

  //Funcion de editar imagen de producto
  function editar_imagen($id_prod,$nombre){
    $sql = "UPDATE producto SET imagen=:nombre where idprod=:id";
    $variables = array(
      ':id'=>$id_prod,
      ':nombre'=>$nombre
    );
    $query = $this->acceso->prepare($sql);
    $query->execute($variables);
    return $this->objetos;
  }

  //Funcion Editar producto
  function editar_productos($id_prod,$nombre_mod,$descripcion_mod,$presentacion_mod,$precio_compra_mod,$precio_venta_mod,$stock_mod,$stock_minimo_mod,$id_marca,$id_cat){
    $sql = "UPDATE producto SET nombre=:nombre,descripcion=:descrip,presentacion=:present,precio_compra=:compra,precio_venta=:venta,stock=:stock,stock_minimo=:minimo, idmarca=:idmarca, idcat=:idcat where idprod=:id";
    $query = $this->acceso->prepare($sql);
    $variables =array(
      ':id'=>$id_prod,
      ':nombre'=>$nombre_mod,
      ':descrip'=>$descripcion_mod,
      ':present'=>$presentacion_mod,
      ':compra'=>$precio_compra_mod,
      ':venta'=>$precio_venta_mod,
      ':stock'=>$stock_mod,
      ':minimo'=>$stock_minimo_mod,
      ':idmarca'=>$id_marca,
      ':idcat'=>$id_cat
      );
    $query->execute($variables);
  }

   //Funcion de eliminar de forma logica
  function borrar($id_prod){
    $sql = "UPDATE producto SET estado=:estado WHERE idprod=:id";
    $query = $this->acceso->prepare($sql);
    $variables = array(
      ':id'=>$id_prod,
      ':estado'=>'I',
    );
    $query->execute($variables);
    
  }

  //Funcion de activar producto, osea verifica si esta el estado Inactivo vuelve activar
  function activar($id_prod){
    $sql = "UPDATE producto SET estado=:estado WHERE idprod=:id";
    $query = $this->acceso->prepare($sql);
    $variables = array(
      ':id'=>$id_prod,
      ':estado'=>'A',
    );
    $query->execute($variables);
    
  }

  function carrito_id($id){
    $sql = "SELECT 
    p.idprod as id,
    p.codigo as codigo,
    p.nombre as producto,
    p.descripcion as descripcion,
    p.presentacion as presentacion,
    p.precio_venta as precio_venta,
    p.stock as stock,
    p.stock_minimo as stock_minimo,
    m.nombre as marca,
    c.nombre as categoria,
    p.estado as estado
    FROM producto p
    inner join marca m on p.idmarca = m.idmarca
    inner join categoria c on c.idcat = p.idcat 
    where idprod=:id;";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':id'=>$id));
    $this->objetos = $query->fetchAll();
    return $this->objetos;
  }

}