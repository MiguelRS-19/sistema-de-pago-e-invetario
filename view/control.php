<?php
session_start();
  include_once 'layout/header.php';
?>
<style>
  .table_scroll{
    overflow: scroll;
    height: 400px;
    overflow-x: hidden;
  }
  #carrito_compras td{
    padding: 0px !important;
    margin: 0px !important;
  }
</style>
<!-- Modal -->
<div class="modal fade" id="abrir_carrito" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Carrito de compra</h5>
      </div>
      <div class="modal-body p-0 table_scroll">
        <table id="carrito_compras" class="table table-hover table-borderless table-secondary p-0">
            <thead class="bg-success">
              <tr>
                  <th class="text-white">Productos</th>
              </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary btn-circle ml-2" title="Salir de carrito" data-dismiss="modal"><i class="fas fa-sign-out-alt"></i></button>
        <button type="button" class=" vaciar_carrito btn btn-outline-danger btn-circle ml-2" title="Eliminar carrito"><i class="fas fa-trash-alt"></i></button>
        <button type="button" class="btn btn-outline-success btn-circle ml-2" title="agregar compra"><i class="fas fa-check"></i></button>
      </div>
    </div>
  </div>
</div>

<title>DIGITALTEI S.A.C - Catalogo</title>
<!-- Modal -->
<div class="modal fade" id="modal_pago" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="card">
        <div class="card-header bg-primary">
          <h3 class="card-title text-white">Agregar Metodo de pago
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          </h3>
        </div>
        <div class="card-body">
          <div class="alert alert-success text-center" id="add" style="display:none">
            <span><i class="fas fa-check m-1"></i>se agrego correctamente</span>
          </div>
          <div class="alert alert-danger text-center" id="noadd" style="display:none">
            <span><i class="fas fa-times m-1"></i>El pago ya exite en otro usuario</span>
          </div>
          <form id="form_Metodo_pago">
            <div class="form-group">
              <label class="small mb-1" for="nombre">Metodo de pago</label>
              <input id="nombre" type="text" class="form-control" placeholder="Ingrese Metodo de pago" required>
            </div>
            <div class="form-group">
              <label class="small mb-1" for="vencimiento">Fecha vencimiento</label>
              <input id="vencimiento" type="date" class="form-control" placeholder="Ingrese Fecha vencimiento" required>
            </div>
          
        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-primary float-right m-1">Guardar</button>
          <button type="button" class="btn btn-outline-secondary float-right m-1" data-dismiss="modal">Cerrar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="modal_edit_pago" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Metodo de pago</h5>
                <button class="btn-close" type="button" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="alert alert-success text-center" id="edit" style="display:none">
              <span><i class="fas fa-check m-1"></i>se edito correctamente</span>
              </div>
              <div class="alert alert-danger text-center" id="noedit" style="display:none">
                <span><i class="fas fa-times m-1"></i>No se edito correctamente</span>
              </div>
              <form id="form_pago">
                <div class="form-group">
                <label class="small mb-1" for="nombre_mod">Metodo de pago</label>
                <input id="nombre_mod" type="text" class="form-control" placeholder="Ingrese Metodo de pago" required>
                </div>
                <div class="form-group">
                  <label class="small mb-1" for="vencimiento_mod">Fecha vencimiento</label>
                  <input id="vencimiento_mod" type="date" class="form-control" placeholder="Ingrese Fecha vencimiento" required>
                </div>
                <input id="idpago_mod" type="hidden" class="form-control">
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary float-right m-1">Guardar</button>
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">ANÁLISIS DE DATOS</h1>
        <div class="row">
          <div class="col-lg-4 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-muted text-uppercase mb-1">
                        Ingreso Diaria</div>
                        <div id="ingreso_diaria" class="h3 d-flex align-items-center"></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar-day fa-2x text-gray-300"></i>
                    </div>
                  </div>
                  <!--<a class="text-arrow-icon small text-primary" href="#!">
                    Ver mas
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                  </a>-->
              </div>
            </div>
          </div>
          <div class="col-lg-4 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-muted text-uppercase mb-1">
                        Ingreso Mensual</div>
                      <div id="ingreso_mensual" class="h3 d-flex align-items-center"></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-muted text-uppercase mb-1">
                        Ingreso Anual</div>
                        <div id="ingreso_anual" class="h3 d-flex align-items-center"></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
              </div>
            </div>
          </div>

          <div class="col-xl-4 col-lg-5">
              <div class="card shadow mb-4">
                  <!-- Card Header - Dropdown -->
                  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                      <h6 class="m-0 font-weight-bold text-primary">Medios de pago más utilizado</h6>
                  </div>
                  <!-- Card Body -->
                  <div class="card-body">
                      <div class="chart-responsive pt-4 pb-2">
                          <canvas id="Grafico1" width="1052" height="490" style="display: block; height: 245px; width: 526px;" class="chartjs-render-monitor"></canvas>
                      </div>
                  </div>
              </div>
          </div>

          <div class="col-xl-8 col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Comprativa de meses con el año anterior</h6>
                </div>
                <div class="card-body">
                    <div class="chart-responsive">
                        <canvas id="Grafico2" width="1052" height="640" style="display: block; height: 320px; width: 526px;" class="chartjs-render-monitor"></canvas>
                    </div>
                </div>
            </div>
          </div>

          <!--<div class="col-xl-12 col-lg-10">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Comprativa de mes diaria, mensual y anual</h6>
                </div>
                <div class="card-body">
                    <div class="chart-responsive">
                        <canvas id="Grafico3" style="min-height: 250px; height: 250px; max-height: 250px; max-width:100%;"></canvas>
                    </div>
                </div>
            </div>
          </div>-->

        </div>



    </div>
    <!-- /.container-fluid -->


</div>
<!-- End of Main Content -->
<?php
include_once 'layout/footer.php';
?>

<script src="../util/js/control.js"></script>