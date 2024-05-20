<?php
session_start();
include_once 'layout/header.php';
?>


<!-- Modal -->
<div class="modal fade" id="Crear_pago" role="dialog">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
        <div class="modal-header bg-dark">
          <h3 class="card-title text-white">Registrar Medios de pago
          </h3>
        </div>
        <div class="modal-body">
          <form id="form-registrar" enctype="multipart/form-data">
            <div class="form-group">
              <label class="mediun mb-1" for="nombre">Medios de pago</label>
              <input id="nombre" name="nombre" type="text" class="form-control" placeholder="Ingrese Medios de pago *">
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
<div class="modal fade" id="editar_MediosPago" role="dialog">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
        <div class="modal-header bg-dark">
          <h3 class="card-title text-white">Editar Medios de pago
          </h3>
        </div>
        <div class="modal-body">
          <form id="form-editar" enctype="multipart/form-data">
            <input type="hidden" id="id_pago" name="id_pago">
            <div class="form-group">
              <label class="mediun mb-1" for="nombre_mod">Medios de pago</label>
              <input id="nombre_mod" name="nombre_mod" type="text" class="form-control" placeholder="Ingrese Medios de pago *">
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


<!-- Modal avatar-->
<div class="modal fade" id="editar_avatar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="exampleModalLabel">Cambiar Foto</h5>
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
                                <input type="hidden" id="id" name="id">
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
<title>DIGITALTEI S.A.C - Medios de pago</title>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Medios de pago</h1>

        <div class="card shadow card-header-actions mb-4">
          <div class="card-header">
              Medios de pago
              <button data-toggle="modal" data-target="#Crear_pago" type="button" class="btn btn-outline-dark btn-circle ml-2" title="Registrar Método de pago"><i class="fas fa-plus"></i></button>
          </div>
          <div class="card-body">
            <table id="medios_pago" class="table table-hover">
              <thead class="table-dark">
                <tr><th width="100%">Medios de pago</th></tr>
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

<script src="../util/js/medios_pago.js"></script>