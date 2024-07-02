<?php
session_start();
  include_once 'layout/header.php';
?>


<!-- Modal -->
<div class="modal fade animate__animated animate__bounceInDown" id="crear_producto" role="dialog">
  <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header bg-dark">
          <h3 class="card-title text-white">Registrar producto
          </h3>
        </div>
        <div class="modal-body">
          <form id="form-registrar" enctype="multipart/form-data">
            <div class="row g-3">
              <div class="col-lg-4 md-3">
                <div class="form-group">
                  <label class="meduin mb-1" for="codigo">Codigo</label>
                  <div class="input-group">
                    <input id="codigo" name="codigo" type="text" class="form-control" placeholder="Ingrese codigo">
                    <button class="btn btn-outline-dark" type="button" title="GenerarId" id="generar_id"><i class="fas fa-barcode"></i></button>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 md-3">
                <div class="form-group">
                  <label class="mediun mb-1" for="nombre">Producto</label>
                  <input id="nombre" name="nombre" type="text" class="form-control" placeholder="Ingrese nombre *">
                </div>
              </div>
              <div class="col-lg-4 md-3">
                <div class="form-group">
                  <label class="mediun mb-1" for="descripcion">Descripcion</label>
                  <input id="descripcion" name="descripcion" type="text" class="form-control" placeholder="Ingrese descripción *">
                </div>
              </div>
              <div class="col-lg-4 md-3">
                <div class="form-group">
                  <label class="mediun mb-1" for="presentacion">Precentación</label>
                  <input id="presentacion" name="presentacion" type="text" class="form-control" placeholder="Ingrese Presentación *">
                </div>
              </div>
              <div class="col-lg-4 md-3">
                <div class="form-group">
                  <label class="mediun mb-1" for="precio_compra">Precio compra</label>
                  <input id="precio_compra" name="precio_compra" type="text" class="form-control" placeholder="Ingrese precio compra *">
                </div>
              </div>
              <div class="col-lg-4 md-3">
                <div class="form-group">
                  <label class="mediun mb-1" for="precio_venta">Precio venta</label>
                  <input id="precio_venta" name="precio_venta" type="text" class="form-control" placeholder="Ingrese precio venta *">
                </div>
              </div>
              <div class="col-lg-4 md-3">
                <div class="form-group">
                  <label class="mediun mb-1" for="stock">Stock</label>
                  <input id="stock" name="stock" type="number" min="1" value="1" class="form-control" placeholder="Ingrese stock *">
                </div>
              </div>
              <div class="col-lg-4 md-3">
                <div class="form-group">
                  <label class="mediun mb-1" for="stock_minimo">Stock minimo</label>
                  <input id="stock_minimo" name="stock_minimo" type="number" class="form-control"  value="6" placeholder="Ingrese stock minimo *">
                </div>
              </div>
              <div class="col-lg-4 md-3">
                <div class="form-group">
                  <label class="mediun mb-1" for="marca">Marca</label>
                  <select name="marca" id="marca" class="form-control select2-dark" data-dropdown-css-class="select2-primary" style="width: 100%;">
                    
                  </select>
                </div>
              </div>
              <div class="col-lg-4 md-3">
                <div class="form-group">
                  <label class="mediun mb-1" for="categoria">Categoria</label>
                  <select name="categoria" id="categoria" class="form-control select2-dark" data-dropdown-css-class="select2-primary" style="width: 100%;">
                    
                  </select>
                </div>
              </div>

            </div>
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary btn-circle ml-2" title="Salir" data-dismiss="modal"><i class="fas fa-sign-out-alt"></i></button>
          <button type="submit" class="btn btn-outline-success btn-circle ml-2" title="Registrar dato"><i class="fas fa-check"></i></button>
          </form>
        </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade animate__animated animate__bounceInDown" id="editar_producto" role="dialog">
  <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header bg-dark">
          <h3 class="card-title text-white">Editar producto
          </h3>
        </div>
        <div class="modal-body">
          <form id="form-editar" enctype="multipart/form-data">
            <input type="hidden" id="id" name="id">
            <div class="row g-3">
              <div class="col-lg-4 md-3">
                <div class="form-group">
                  <label class="mediun mb-1" for="nombre_mod">Producto</label>
                  <input id="nombre_mod" name="nombre_mod" type="text" class="form-control" placeholder="Ingrese nombre *">
                </div>
              </div>
              <div class="col-lg-4 md-3">
                <div class="form-group">
                  <label class="mediun mb-1" for="descripcion_mod">Descripcion</label>
                  <input id="descripcion_mod" name="descripcion_mod" type="text" class="form-control" placeholder="Ingrese descripción *">
                </div>
              </div>
              <div class="col-lg-4 md-3">
                <div class="form-group">
                  <label class="mediun mb-1" for="presentacion_mod">Precentación</label>
                  <input id="presentacion_mod" name="presentacion_mod" type="text" class="form-control" placeholder="Ingrese Presentación *">
                </div>
              </div>
              <div class="col-lg-4 md-3">
                <div class="form-group">
                  <label class="mediun mb-1" for="precio_compra_mod">Precio compra</label>
                  <input id="precio_compra_mod" name="precio_compra_mod" type="text" class="form-control" placeholder="Ingrese precio compra *">
                </div>
              </div>
              <div class="col-lg-4 md-3">
                <div class="form-group">
                  <label class="mediun mb-1" for="precio_venta_mod">Precio venta</label>
                  <input id="precio_venta_mod" name="precio_venta_mod" type="text" class="form-control" placeholder="Ingrese precio venta *">
                </div>
              </div>
              <div class="col-lg-4 md-3">
                <div class="form-group">
                  <label class="mediun mb-1" for="stock_mod">Stock</label>
                  <input id="stock_mod" name="stock_mod" type="number" min="1" value="1" class="form-control" placeholder="Ingrese stock *">
                </div>
              </div>
              <div class="col-lg-4 md-3">
                <div class="form-group">
                  <label class="mediun mb-1" for="stock_minimo_mod">Stock minimo</label>
                  <input id="stock_minimo_mod" name="stock_minimo_mod" type="number" class="form-control" value="6" placeholder="Ingrese stock minimo *">
                </div>
              </div>
              <div class="col-lg-4 md-3">
                <div class="form-group">
                  <label class="mediun mb-1" for="marca_mod">Marca</label>
                  <select name="marca_mod" id="marca_mod" class="form-control select2-dark" data-dropdown-css-class="select2-primary" style="width: 100%;">
                    
                  </select>
                </div>
              </div>
              <div class="col-lg-4 md-3">
                <div class="form-group">
                  <label class="mediun mb-1" for="categoria_mod">Categoria</label>
                  <select name="categoria_mod" id="categoria_mod" class="form-control select2-dark" data-dropdown-css-class="select2-primary" style="width: 100%;">
                    
                  </select>
                </div>
              </div>

            </div>
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary btn-circle ml-2" title="Salir" data-dismiss="modal"><i class="fas fa-sign-out-alt"></i></button>
          <button type="submit" class="btn btn-outline-success btn-circle ml-2" title="Editar dato"><i class="fas fa-check"></i></button>
          </form>
        </div>
    </div>
  </div>
</div>


<!-- Modal avatar-->
<div class="modal fade animate__animated animate__zoomInDown" id="editar_imagen" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="exampleModalLabel">Cambiar imagen</h5>
            </div>
            <div class="modal-body p-0">
                <div class="card">
                    <div class="bg-dark">
                        <!--Se quedo aqui agregando id-->
                        <h3 id="nombre_avatar" class="text-center text-white"></h3>
                    </div>
                    <div class="m-2 image text-center">
                        <img id="avatar" class="img-account-profile rounded-circle mb-2" src="" width="100px" height="100px" alt="usuario avatar">
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-12">
                                <form id="form_avatar" enctype="multipart/form-data">
                                <input type="hidden" id="avatar_id" name="avatar_id">
                                <input type="hidden" id="avatar1" name="avatar1">
                                <div class="form-group">
                                    <label for="exampleInputFile">Avatar: </label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="avatar_mod" name="avatar_mod">
                                            <label class="custom-file-label" for="avatar_mod">selecione una imagen</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary btn-circle ml-2" title="Salir" data-dismiss="modal"><i class="fas fa-sign-out-alt"></i></button>
                    <button type="submit" class="btn btn-outline-success btn-circle ml-2" title="Editar foto"><i class="fas fa-check"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>


<title>DIGITALTEI S.A.C - Productos</title>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="animate__animated animate__bounce h3 mb-4 text-gray-800">Productos</h1>
        <div class="card mb-4">
            <div class="card-header">
              <h3 class="card-title">Productos
              <button  data-toggle="modal" data-target="#crear_producto" type="button" class="btn btn-outline-dark btn-circle ml-2" title="Registrar producto"><i class="fas fa-plus"></i></button>
              </h3>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="productos" class="table table-hover">
                  <thead class="table-dark">
                      <tr><th width="100%">Productos</th></tr>
                  </thead>
                  <tbody>
  
                  </tbody>
                </table>
              </div>
            </div>
        </div>



    </div>
    <!-- /.container-fluid -->


</div>
<!-- End of Main Content -->
<?php
include_once 'layout/footer.php';
?>

<script src="../util/js/productos.js"></script>