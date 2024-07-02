<?php
session_start();
include_once 'layout/header.php';
?>

<!-- Modal -->
<div class="modal fade animate__animated animate__bounceInDown" id="crear_cuenta" role="dialog">
  <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header bg-dark">
          <h3 class="card-title text-white">Registrar cuenta
          </h3>
        </div>
        <div class="modal-body">
          <form id="form-registrar" enctype="multipart/form-data">
            <div class="row g-3">
              <div class="col-lg-4 md-3">
                  <div class="form-group">
                    <label class="mediun mb-1" for="cliente">Cliente</label>
                    <select name="cliente" id="cliente" class="form-control select2-dark" data-dropdown-css-class="select2-primary" style="width: 100%;">
                      
                    </select>
                  </div>
                </div>
              <div class="col-lg-4 md-3">
                <div class="form-group">
                  <label class="mediun mb-1" for="nombre">Descripción</label>
                  <input id="nombre" name="nombre" type="text" class="form-control" placeholder="Ingrese descripción *">
                </div>
              </div>
              <div class="col-lg-4 md-3">
                <div class="form-group">
                  <label class="mediun mb-1" for="consumo">Fecha Consumo</label>
                  <input id="consumo" name="consumo" type="date" class="form-control" placeholder="Ingrese Fecha consumo *">
                </div>
              </div>
              <div class="col-lg-4 md-3">
                <div class="form-group">
                  <label class="mediun mb-1" for="fecha">Fecha pago</label>
                  <input id="fecha" name="fecha" type="date" class="form-control" placeholder="Ingrese Fecha pago *">
                </div>
              </div>
              <div class="col-lg-4 md-3">
                <div class="form-group">
                  <label class="mediun mb-1" for="plazo">Fecha plazo</label>
                  <input id="plazo" name="plazo" type="date" class="form-control" placeholder="Ingrese Fecha plazo /Opcional">
                </div>
              </div>
              <div class="col-lg-4 md-3">
                <div class="form-group">
                  <label class="mediun mb-1" for="deuda">Deuda</label>
                  <input id="deuda" name="deuda" type="text" class="form-control" placeholder="Ingrese deuda *">
                </div>
              </div>
              <div class="col-lg-4 md-3">
                <div class="form-group">
                  <label class="mediun mb-1" for="monto">Monto</label>
                  <input id="monto" name="monto" type="text" class="form-control" placeholder="Ingrese monto *">
                </div>
              </div>
              <div class="col-lg-8 md-3">
                <div class="form-group">
                  <label class="meduin mb-1" for="id_medios">Medios de pago</label>
                  <select name="id_medios" id="id_medios" class="form-control select2-dark" data-dropdown-css-class="select2-dark" style="width: 100%;">

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
<div class="modal fade animate__animated animate__bounceInDown" id="editar_cuenta" role="dialog">
  <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header bg-dark">
          <h3 class="card-title text-white">Editar cuenta
          </h3>
        </div>
        <div class="modal-body">
          <form id="form-editar" enctype="multipart/form-data">
            <input id="id" name="id" type="hidden" class="form-control">
            <input id="deuda_mod" name="deuda_mod" type="hidden" class="form-control">
            <input id="monto_mod" name="monto_mod" type="hidden" class="form-control">
            <div class="row g-3">
              <div class="col-lg-4 md-3">
                <div class="form-group">
                  <label class="mediun mb-1" for="fecha_mod">Fecha pago</label>
                  <input id="fecha_mod" name="fecha_mod" type="date" class="form-control" placeholder="Ingrese Fecha pago *">
                </div>
              </div>
              <div class="col-lg-4 md-3">
                <div class="form-group">
                  <label class="mediun mb-1" for="plazo_mod">Fecha plazo</label>
                  <input id="plazo_mod" name="plazo_mod" type="date" class="form-control" placeholder="Ingrese Fecha plazo /Opcional">
                </div>
              </div>
              <div class="col-lg-4 md-3">
                <div class="form-group">
                  <label class="mediun mb-1" for="monto_nuevo">Monto</label>
                  <input id="monto_nuevo" name="monto_nuevo" type="text" class="form-control" placeholder="Ingrese monto *">
                </div>
              </div>
              <div class="col-lg-12 md-3">
                <div class="form-group">
                  <label class="meduin mb-1" for="medios">Medios de pago</label>
                  <select name="medios" id="medios" class="form-control select2-dark" data-dropdown-css-class="select2-dark" style="width: 100%;">

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


<title>DIGITALTEI S.A.C - Cuenta</title>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="animate__animated animate__bounce h3 mb-4 text-gray-800 d-sm-flex align-items-center justify-content-between">Cuenta
        </h1>

        <div class="card shadow mb-4">
          <div class="card-header py-3">Gestión cuenta
          <button id="boton-crear" data-toggle="modal" data-target="#crear_cuenta" type="button" class="btn btn-outline-dark btn-circle ml-2" title="Registrar cuenta"><i class="fas fa-plus"></i></button>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="cuentas" class="table  table-bordered table-hover" width="100%" cellspacing="0">
                <thead>
                    <tr>
                      <th>N°</th>
                      <th>Fecha Pago</th>
                      <th>Cliente</th>
                      <th>Descripcion</th>
                      <th>Mes consumo</th>
                      <th>Deuda</th>
                      <th>abono</th>
                      <th>Saldo</th>
                      <th>vuelto</th>
                      <th>M.pago</th>
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

<script src="../util/js/cuentas.js"></script>