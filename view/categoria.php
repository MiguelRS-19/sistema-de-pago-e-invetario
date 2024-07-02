<?php
session_start();
include_once 'layout/header.php';
?>

<!-- Modal cambiar contraseña-->
<div class="modal fade" id="confirmar" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title">Ingrese su contraseña para confirmar</h5>
            </div>
            <div class="modal-body p-0">
                <div class="card">
                    <div class="bg-dark">
                        <h3 id="nombre_confirmar" class="text-center text-white"></h3>
                        <h5 id="apellido_confirmar" class="text-center text-white"></h5>
                    </div>
                    <div class="m-2 image text-center">
                        <img id="avatar_confirmar" class="img-account-profile rounded-circle mb-2" src="" width="100px" height="100px" alt="usuario avatar">
                    </div>
                    <div class="card-footer">
                      <div class="row">
                        <div class="col-md-12">
                          <form id="form_confirmar" enctype="multipart/form-data">
                                    <input type="hidden" id="funcion" name="funcion">
                                    <input type="hidden" id="id_usuario" name="id_usuario">
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-unlock-alt"></i></span>
                                            </div>
                                            <input id="pass" name="pass" type="password" class="form-control"
                                                placeholder="Ingrese contraseña actual">
                                        </div>
                                    </div>
                                    
                            </div>
                            
                        </div>
                    </div>
                </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary btn-circle ml-2" title="Salir" data-dismiss="modal"><i class="fas fa-sign-out-alt"></i></button>
                    <button type="submit" class="btn btn-outline-success btn-circle ml-2" title="Cambiar password"><i class="fas fa-check"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade animate__animated animate__bounceInDown" id="crear_categoria" role="dialog">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
        <div class="modal-header bg-dark">
          <h3 class="card-title text-white">Registrar categoria
          </h3>
        </div>
        <div class="modal-body">
          <form id="form-registrar" enctype="multipart/form-data">
            <div class="form-group">
              <label class="mediun mb-1" for="nombre">Categoria</label>
              <input id="nombre" name="nombre" type="text" class="form-control" placeholder="Ingrese categoria *">
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
<div class="modal fade animate__animated animate__bounceInDown" id="editar_categoria" role="dialog">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
        <div class="modal-header bg-dark">
          <h3 class="card-title text-white">Editar categoria
          </h3>
        </div>
        <div class="modal-body">
          <form id="form-editar" enctype="multipart/form-data">
            <input type="hidden" id="id" name="id">
            <div class="form-group">
              <label class="mediun mb-1" for="nombre_mod">Categoria</label>
              <input id="nombre_mod" name="nombre_mod" type="text" class="form-control" placeholder="Ingrese categoria *">
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


<title>DIGITALTEI S.A.C - Categoria</title>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="animate__animated animate__bounce h3 mb-4 text-gray-800 d-sm-flex align-items-center justify-content-between">Categoria
        </h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-dark ">Gestion Categoria
                <button data-toggle="modal" data-target="#crear_categoria" type="button" class="btn btn-outline-dark btn-circle ml-2" title="Registrar usuario"><i class="fas fa-plus"></i></button>
                </h6>
            </div>
            <div class="card-body">
              <table id="categorias" class="table table-hover">
                <thead class="table-dark">
                    <tr><th width="100%">Categorias</th></tr>
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

<script src="../util/js/categoria.js"></script>
