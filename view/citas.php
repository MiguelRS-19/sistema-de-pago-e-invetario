<?php
session_start();
include_once 'layout/header.php';
?>

<!-- Modal -->
<div class="modal fade animate__animated animate__zoomInDown" id="asignar_cita" role="dialog">
  <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header bg-dark">
          <h3 class="card-title text-white">Asignar citas
          </h3>
        </div>
        <div class="modal-body">
          <form id="form-asignar" enctype="multipart/form-data">
            <div class="row g-3">
              <div class="col-lg-4 md-3">
                  <div class="form-group">
                    <label class="mediun mb-1" for="clientes">Cliente</label>
                    <select name="clientes" id="clientes" class="form-control select2-dark" data-dropdown-css-class="select2-primary" style="width: 100%;">
                      
                    </select>
                  </div>
                </div>
              <div class="col-lg-4 md-3">
                <div class="form-group">
                  <label class="mediun mb-1" for="color">Color evento</label>
                  <input id="color" name="color" type="color" class="form-control" placeholder="Ingrese color *">
                </div>
              </div>
              <div class="col-lg-4 md-3">
                <div class="form-group">
                  <label class="mediun mb-1" for="inicio">Fecha inicio</label>
                  <input id="inicio" name="inicio" type="DateTime-local" class="form-control" placeholder="Ingrese Fecha inicio">
                </div>
              </div>
              <div class="col-lg-4 md-3">
                <div class="form-group">
                  <label class="mediun mb-1" for="final">Fecha final</label>
                  <input id="final" name="final" type="DateTime-local" class="form-control" placeholder="Ingrese Fecha final">
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
                  <label class="mediun mb-1" for="saldo">Saldo</label>
                  <input id="saldo" name="saldo" type="text" class="form-control" placeholder="Ingrese saldo *">
                </div>
              </div>
              <div class="col-lg-12 md-3">
                <div class="form-group">
                  <label class="mediun mb-1" for="motivo">Motivo</label>
                  <textarea class="form-control" id="motivo" name="motivo" cols="30" rows="5" style="max-height: 100px; overflow-y: auto;"></textarea>
                </div>
              </div>
            </div>
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary btn-circle ml-2" title="Salir" data-dismiss="modal"><i class="fas fa-sign-out-alt"></i></button>
          <button type="submit" class="btn btn-outline-success btn-circle ml-2" title="Asignar cita"><i class="fas fa-check"></i></button>
          </form>
        </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade animate__animated animate__zoomInDown" id="editar_cita" role="dialog">
  <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header bg-dark">
          <h3 class="card-title text-white">Editar citas
          </h3>
        </div>
        <div class="modal-body">
          <form id="form-editar" enctype="multipart/form-data">
            <div class="row g-3">
              <input id="id" name="id" type="hidden" class="form-control">
              <div class="col-lg-4 md-3">
                  <div class="form-group">
                    <label class="mediun mb-1" for="cliente_mod">Cliente</label>
                    <input type="text" name="cliente_mod" id="cliente_mod" class="form-control" disabled placeholder="Ingrese cliente *" >
                  </div>
                </div>
              <div class="col-lg-4 md-3">
                <div class="form-group">
                  <label class="mediun mb-1" for="color_mod">Color evento</label>
                  <input id="color_mod" name="color_mod" type="color" class="form-control" placeholder="Ingrese color *">
                </div>
              </div>
              <div class="col-lg-4 md-3">
                <div class="form-group">
                  <label class="mediun mb-1" for="inicio_mod">Fecha inicio</label>
                  <input id="inicio_mod" name="inicio_mod" type="DateTime-local" class="form-control" placeholder="Ingrese Fecha inicio">
                </div>
              </div>
              <div class="col-lg-4 md-3">
                <div class="form-group">
                  <label class="mediun mb-1" for="final_mod">Fecha final</label>
                  <input id="final_mod" name="final_mod" type="DateTime-local" class="form-control" placeholder="Ingrese Fecha final">
                </div>
              </div>
              <div class="col-lg-4 md-3">
                <div class="form-group">
                  <label class="mediun mb-1" for="saldo_mod">Saldo</label>
                  <input id="saldo_mod" name="saldo_mod" type="text" class="form-control" placeholder="Ingrese saldo *">
                </div>
              </div>
              <div class="col-lg-12 md-3">
                <div class="form-group">
                  <label class="mediun mb-1" for="motivo_mod">Motivo</label>
                  <textarea class="form-control" id="motivo_mod" name="motivo_mod" cols="30" rows="5" style="max-height: 100px; overflow-y: auto;"></textarea>
                </div>
              </div>
            </div>
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary btn-circle ml-2" title="Salir" data-dismiss="modal"><i class="fas fa-sign-out-alt"></i></button>
          <button type="button" class="borrar btn btn-outline-danger btn-circle ml-2" idcita="" cli="" title="Eliminar cita"><i class="fas fa-trash-alt"></i></button>
          <button type="submit" class="btn btn-outline-success btn-circle ml-2" title="Editar cita"><i class="fas fa-check"></i></button>
          </form>
        </div>
    </div>
  </div>
</div>




<title>DIGITALTEI S.A.C - Citas</title>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="animate__animated animate__bounce h3 mb-4 text-gray-800 d-sm-flex align-items-center justify-content-between">Asignar Citas
        </h1>

        <div class="card shadow mb-4">
          <div class="card-header py-3">Gestión citas
          </div>
          <div class="card-body">

            <div class="row">
            <div class="col-md-8">
                <div class="card shadow">
                  <div class="card-header"></div>
                  <div class="card-body">
                  <div id='calendar'></div>
                  </div>
                </div>
              </div>
              <div class="col-md-4 mt-4">
                <div class="card shadow">
                  <div class="card-header"></div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table id="citas" class="table  table-bordered table-hover" width="100%" cellspacing="0">
                        <thead class="table-dark">
                          <th width="100%">Citas</th>
                        </thead>
                        <tbody>
                          
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
    </div>
    <!-- /.container-fluid -->


</div>
<!-- End of Main Content -->

<?php include_once 'layout/footer.php';?>

<script src="../util/js/citas.js"></script>

<!--<tr>
  <th>N°</th>
  <th>Fecha citas</th>
  <th>Hora</th>
  <th>Cliente</th>
  <th>Descripcion</th>
  <th>Deuda</th>
  <th>Saldo</th>
  <th>Encargado</th>
  <th>Estado</th>
  <th>Opcion</th>
</tr>-->