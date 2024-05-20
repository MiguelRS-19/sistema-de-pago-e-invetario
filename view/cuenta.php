<?php
session_start();
include_once 'layout/header.php';
?>

<!-- Modal -->
<div class="modal fade" id="modal_cuota" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="card">
        <div class="card-header bg-primary">
          <h3 class="card-title text-white">Agregar Cuota
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
            <span><i class="fas fa-times m-1"></i>El cuota ya exite en otro usuario</span>
          </div>
          <form id="form_cuota">
            <div class="form-group">
              <label class="small mb-1" for="ingreso">(*) Ingreso</label>
              <input id="ingreso" type="text" class="form-control" placeholder="Ingrese ingreso" required>
            </div>
            <div class="form-group">
              <label class="small mb-1" for="consumo">(*) Fecha Consumo</label>
              <input id="consumo" type="date" class="form-control" placeholder="Ingrese Fecha consumo">
            </div>
            <div class="form-group">
              <label class="small mb-1" for="fecha">(*) Fecha pago</label>
              <input id="fecha" type="date" class="form-control" placeholder="Ingrese Fecha pago">
            </div>
            <div class="form-group">
              <label class="small mb-1" for="plazo">(Opcional) Fecha plazo</label>
              <input id="plazo" type="date" class="form-control" placeholder="Ingrese Fecha plazo">
            </div>
            <div class="form-group">
              <label class="small mb-1" for="id_pag">pagador</label>
              <select name="id_pag" id="id_pag" class="form-control select2" style="width: 100%;">

              </select>
            </div>
            <div class="form-group">
              <label class="small mb-1" for="id_metod">Metodo de pago</label>
              <select name="id_metod" id="id_metod" class="form-control select2" style="width: 100%;">

              </select>
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
<div class="modal fade" id="modal_edit_cuota" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Cuota</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <div class="alert alert-success text-center" id="edit" style="display:none">
              <span><i class="fas fa-check m-1"></i>se edito correctamente</span>
              </div>
              <div class="alert alert-danger text-center" id="noedit" style="display:none">
                <span><i class="fas fa-times m-1"></i>No se edito correctamente</span>
              </div>
              <form id="form_edit_cuota">
                <div class="form-group">
                  <label class="small mb-1" for="ingreso_mod">(*) Ingreso</label>
                  <input id="ingreso_mod" type="text" class="form-control" placeholder="Ingrese ingreso" required>
                </div>
                <div class="form-group">
                  <label class="small mb-1" for="consumo_mod">(*) Fecha Consumo</label>
                  <input id="consumo_mod" type="date" class="form-control" placeholder="Ingrese Fecha consumo">
                </div>
                <div class="form-group">
                  <label class="small mb-1" for="fecha_mod">(*) Fecha pago</label>
                  <input id="fecha_mod" type="date" class="form-control" placeholder="Ingrese Fecha pago">
                </div>
                <div class="form-group">
                  <label class="small mb-1" for="plazo_mod">(Opcional) Fecha plazo</label>
                  <input id="plazo_mod" type="date" class="form-control" placeholder="Ingrese Fecha plazo">
                </div>
                <div class="form-group">
                  <label class="small mb-1" for="id_pag_mod">pagador</label>
                  <select name="id_pag_mod" id="id_pag_mod" class="form-control select2" style="width: 100%;">

                  </select>
                </div>
                <div class="form-group">
                  <label class="small mb-1" for="id_metod_mod">Metodo de pago</label>
                  <select name="id_metod_mod" id="id_metod_mod" class="form-control select2" style="width: 100%;">

                  </select>
                </div>
                <input id="idcuota_mod" type="hidden" class="form-control">
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary float-right m-1">Guardar</button>
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
              </form>
            </div>
        </div>
    </div>
</div>


    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800 d-sm-flex align-items-center justify-content-between">Cuota
          <!--<div class="dropdown no-arrow">
            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"  type="button"><i class="fas fa-download fa-sm text-white-50"></i> Generar Reporte
            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
            </button>
                
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                aria-labelledby="dropdownMenuLink">
                <div class="dropdown-header">REPORTES DE EFECTIVOS PAGOS:</div>
                <button id="reporte_diaria" class="btn btn-outline-primary btn-block" type="button">DIARIA<i class="fas fa-file-pdf ml-2"></i></button>
                <button id="reporte_mensual" class="btn btn-outline-primary btn-block">MENSUAL<i class="fas fa-file-pdf ml-2"></i></button>
                <button id="reporte_anual" class="btn btn-outline-primary btn-block">ANUAL<i class="fas fa-file-pdf ml-2"></i></b>
            </div>
          </div>-->
        </h1>

        <div class="card shadow mb-4">
          <div class="card-header py-3">Gestion cuota
          <button id="boton-crear" data-toggle="modal" data-target="#modal_cuota" type="button" class="btn btn-primary btn-circle ml-2" title="Crear cuota"><i class="fas fa-plus"></i></button>
          </div>
          <div class="card-body">
              <div class="table-responsive ">
                  <table id="tabla_cuota" class="table "  width="100%" cellspacing="0">
                      <thead>
                          <tr>
                              <th class="border-gray-200" scope="col">N°</th>
                              <th class="border-gray-200" scope="col">Mes consumo</th>
                              <th class="border-gray-200" scope="col">Fecha Pago</th>
                              <th class="border-gray-200" scope="col">Pagador</th>
                              <th class="border-gray-200" scope="col">Cancelar</th>
                              <th class="border-gray-200" scope="col">Metodo de pago</th>
                              <th class="border-gray-200" scope="col">Opcion</th>
                              <th class="border-gray-200" scope="col">Estado</th>
                          </tr>
                      </thead>
                      <tbody>
                          <tr>
                              <td>#39201</td>
                              <td>06/15/2021</td>
                              <td>Juan</td>
                              <td>$29.99</td>
                              <td>BCP</td>
                              <td><button class="editar btn btn-circle btn-sm btn-success ml-2" data-toggle="modal" data-target="#modal_edit_pago"><i class="fas fa-pen-alt"></i></button></td>
                              <td> <div class="dropdown no-arrow">
                                      <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                          data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          <span class="badge bg-danger text-light">No pagado</span>
                                          <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                      </a>
                                      <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                          aria-labelledby="dropdownMenuLink">
                                          <div class="dropdown-header">Estado:</div>
                                          <a class="dropdown-item" href="#">No pagado</a>
                                          <a class="dropdown-item" href="#">Pagado</a>
                                          <div class="dropdown-divider"></div>
                                          <a class="dropdown-item" href="#">Enviado</a>
                                      </div>
                                    </div>
                              </td>
                          </tr>
                          <tr>
                              <td>#38594</td>
                              <td>05/15/2021</td>
                              <td>Juan</td>
                              <td>$29.99</td>
                              <td>BCP</td>
                              <td><button class="editar btn btn-circle btn-sm btn-success ml-2" data-toggle="modal" data-target="#modal_edit_pago"><i class="fas fa-pen-alt"></i></button></td>
                              <td> <div class="dropdown no-arrow">
                                      <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                          data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          <span class="badge bg-success text-light">pagado</span>
                                          <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                      </a>
                                      <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                          aria-labelledby="dropdownMenuLink">
                                          <div class="dropdown-header">Estado:</div>
                                          <a class="dropdown-item" href="#">No pagado</a>
                                          <a class="dropdown-item" href="#">Pagado</a>
                                          <div class="dropdown-divider"></div>
                                          <a class="dropdown-item" href="#">Enviado</a>
                                      </div>
                                    </div>
                              </td>
                              
                          </tr>
                          <tr>
                              <td>#38223</td>
                              <td>04/15/2021</td>
                              <td>Juan</td>
                              <td>$29.99</td>
                              <td>BCP</td>
                              <td><button class="editar btn btn-circle btn-sm btn-success ml-2" data-toggle="modal" data-target="#modal_edit_pago"><i class="fas fa-pen-alt"></i></button></td>
                              <td> <div class="dropdown no-arrow">
                                      <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                          data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          <span class="badge bg-success text-light">pagado</span>
                                          <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                      </a>
                                      <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                          aria-labelledby="dropdownMenuLink">
                                          <div class="dropdown-header">Estado:</div>
                                          <a class="dropdown-item" href="#">No pagado</a>
                                          <a class="dropdown-item" href="#">Pagado</a>
                                          <div class="dropdown-divider"></div>
                                          <a class="dropdown-item" href="#">Enviado</a>
                                      </div>
                                    </div>
                              </td>
                          </tr>
                          <tr>
                              <td>#38125</td>
                              <td>03/15/2021</td>
                              <td>Juan</td>
                              <td>$29.99</td>
                              <td>BCP</td>
                              <td><button class="editar btn btn-circle btn-sm btn-success ml-2" data-toggle="modal" data-target="#modal_edit_pago"><i class="fas fa-pen-alt"></i></button></td>
                              <td> <div class="dropdown no-arrow">
                                      <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                          data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          <span class="badge bg-success text-light">pagado</span>
                                          <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                      </a>
                                      <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                          aria-labelledby="dropdownMenuLink">
                                          <div class="dropdown-header">Estado:</div>
                                          <a class="dropdown-item" href="#">No pagado</a>
                                          <a class="dropdown-item" href="#">Pagado</a>
                                          <div class="dropdown-divider"></div>
                                          <a class="dropdown-item" href="#">Enviado</a>
                                      </div>
                                    </div>
                              </td>
                          </tr>
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

<script src="../util/js/cuota.js"></script>