<?php
session_start();
include_once 'layout/header.php';
?>

<!-- Modal -->
<div class="modal fade animate__animated animate__bounceInDown" id="crear_compra" role="dialog">
  <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header bg-dark">
          <h3 class="card-title text-white">Nueva compra
          </h3>
        </div>
        <div class="modal-body">
          <form id="form-registrar" enctype="multipart/form-data">
            <div class="row g-3">
              <div class="col-lg-4 md-3">
                <div class="form-group">
                  <label class="mediun mb-1" for="producto">Producto</label>
                  <select name="producto" id="producto" class="form-control select2-dark" data-dropdown-css-class="select2-primary" style="width: 100%;">
                    
                  </select>
                </div>
              </div>
              <div class="col-lg-4 md-3">
                <div class="form-group">
                  <label class="mediun mb-1" for="cantidad">Cantidad</label>
                  <input id="cantidad" name="cantidad" step="1" type="number" class="form-control" placeholder="Ingrese cantidad *">
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
                  <label class="mediun mb-1" for="precio_compra">Nota</label>
                  <input type="text" class="form-control" name="nota" id="nota" placeholder="Ingrese una nota">
                </div>
              </div>
              <div class="col-lg-4 md-3">
                <div class="form-group">
                  <label class="mediun mb-1" for="precio_compra">M.pago</label>
                  <select class="form-control select2-dark" data-dropdown-css-class="select2-primary" style="width: 100%;" name="tp_pago" id="tp_pago">
                        
                  </select>
                </div>
              </div>
              <div class="col-lg-4 md-3">
                <div class="form-group">
                  <label class="mediun mb-1" for="precio_compra">Comprobante</label>
                  <select class="form-control select2-dark" data-dropdown-css-class="select2-primary" style="width: 100%;" name="tp_compra" id="tp_compra">
                        
                  </select>
                </div>
              </div>
              <div class="col-lg-4 md-3">
                <div class="form-group">
                  <label class="mediun mb-1" for="precio_compra">Proveedor</label>
                  <select class="form-control select2-dark" data-dropdown-css-class="select2-primary" style="width: 100%;" name="codprovee" id="codprovee">
                        
                  </select>
                </div>
              </div>

            </div>
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary btn-circle ml-2" title="Salir" data-dismiss="modal"><i class="fas fa-sign-out-alt"></i></button>
          <button type="submit" class="btn btn-outline-success btn-circle ml-2" title="Registrar dato"><i class="fas fa-check"></i></button>
          <!--<button class="btn btn-outline-danger btn-circle ml-2" type="button" title="Anular"><i class="fa fa-ban"></i></button>-->
          </form>
        </div>
    </div>
  </div>
</div>


<title>DIGITALTEI S.A.C - Compras</title>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="animate__animated animate__bounce h3 mb-4 text-gray-800 d-sm-flex align-items-center justify-content-between">Compra
        </h1>

        <div class="card shadow mb-4">
          <div class="card-header py-3">Gestión compra
          <button id="boton-crear" data-toggle="modal" data-target="#crear_compra" type="button" class="btn btn-outline-dark btn-circle ml-2" title="Registrar cuenta"><i class="fas fa-plus"></i></button>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="compras" class="table  table-bordered table-hover" width="100%" cellspacing="0">
                <thead>
                    <tr>
                      <th>N°</th>
                      <th>Proveedor</th>
                      <th>Producto</th>
                      <th>Descripcion</th>
                      <th>Presentacion</th>
                      <th>Fecha</th>
                      <th>M.pago</th>
                      <th>Cantidad</th>
                      <th>Costo</th>
                      <th>Total</th>
                      <th>Comprobante</th>
                      <th>Encargado</th>
                      <th>Estado</th>
                      <th>Opcion</th>
                    </tr>
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


<?php include_once 'layout/footer.php';?>

<script src="../util/js/Compras.js"></script>

