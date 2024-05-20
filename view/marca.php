<?php
session_start();
include_once 'layout/header.php';
?>

<!-- Modal -->
<div class="modal fade" id="crear_marca" role="dialog">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
        <div class="modal-header bg-dark">
          <h3 class="card-title text-white">Registrar marca
          </h3>
        </div>
        <div class="modal-body">
          <form id="form-registrar" enctype="multipart/form-data">
            <div class="form-group">
              <label class="mediun mb-1" for="nombre">Marca</label>
              <input id="nombre" name="nombre" type="text" class="form-control" placeholder="Ingrese marca *">
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
<div class="modal fade" id="editar_marca" role="dialog">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
        <div class="modal-header bg-dark">
          <h3 class="card-title text-white">Editar marca
          </h3>
        </div>
        <div class="modal-body">
          <form id="form-editar" enctype="multipart/form-data">
            <input type="hidden" id="id" name="id">
            <div class="form-group">
              <label class="mediun mb-1" for="nombre_mod">Marca</label>
              <input id="nombre_mod" name="nombre_mod" type="text" class="form-control" placeholder="Ingrese marca *">
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


<title>DIGITALTEI S.A.C - Marca</title>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800 d-sm-flex align-items-center justify-content-between">Marca
        </h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-dark ">Gestion Marca
                <button data-toggle="modal" data-target="#crear_marca" type="button" class="btn btn-outline-dark btn-circle ml-2" title="Registrar usuario"><i class="fas fa-plus"></i></button>
                </h6>
            </div>
            <div class="card-body">
              <table id="marcas" class="table table-hover">
                <thead class="table-dark">
                    <tr><th width="100%">Marcas</th></tr>
                </thead>
                <tbody>

                </tbody>
              </table>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->


</div>
<!-- End of Main Content -->

<?php include_once 'layout/footer.php';?>

<script src="../util/js/marca.js"></script>
