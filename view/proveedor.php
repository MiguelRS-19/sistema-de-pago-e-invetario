<?php
session_start();
include_once 'layout/header.php';
?>


<!-- Modal -->
<div class="modal fade animate__animated animate__bounceInDown" id="crear_proveedor" role="dialog">
  <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header bg-dark">
          <h3 class="card-title text-white">Registrar proveedor
          </h3>
        </div>
        <div class="modal-body">
          <form id="form-registrar" enctype="multipart/form-data">
            <div class="row g-3">
              <div class="col-lg-4 md-3">
                <div class="form-group">
                  <label class="mediun mb-1" for="docum">Documento</label>
                  <select name="docum" id="docum" class="form-control select2-dark" data-dropdown-css-class="select2-dark" style="width: 100%;">
                    
                  </select>
                </div>
              </div>
              <div class="col-lg-4 md-3">
                <div class="form-group">
                  <label class="mediun mb-1" for="ruc">RUC</label>
                  <input id="ruc" name="ruc" type="text" class="form-control" placeholder="Ingrese ruc *">
                </div>
              </div>
              <div class="col-lg-4 md-3">
                <div class="form-group">
                  <label class="mediun mb-1" for="telefono">Telefono</label>
                  <input id="telefono" name="telefono" type="text" class="form-control" placeholder="Ingrese Telefono /Opcional">
                </div>
              </div>
              <div class="col-lg-4 md-3">
                <div class="form-group">
                  <label class="mediun mb-1" for="correo">Correo</label>
                  <input id="correo" name="correo" type="text" class="form-control" placeholder="Ingrese Correo /Opcional">
                </div>
              </div>
              <div class="col-lg-8 md-3">
                <div class="form-group">
                  <label class="mediun mb-1" for="nombre">Razon social</label>
                  <input id="nombre" name="nombre" type="text" class="form-control" placeholder="Ingrese Razon social *">
                </div>
              </div>
              <div class="col-lg-12 md-3">
                <div class="form-group">
                  <label class="mediun mb-1" for="direccion">Dirección</label>
                  <input id="direccion" name="direccion" type="text" class="form-control" placeholder="Ingrese Dirección /Opcional">
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
<div class="modal fade animate__animated animate__bounceInDown" id="editar_proveedor" role="dialog">
  <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header bg-dark">
          <h3 class="card-title text-white">Editar proveedor
          </h3>
        </div>
        <div class="modal-body">
          <form id="form-editar" enctype="multipart/form-data">
            <input id="id" name="id" type="hidden" class="form-control">
            <div class="row g-3">
              <div class="col-lg-4 md-3">
                <div class="form-group">
                  <label class="mediun mb-1" for="ruc_mod">RUC</label>
                  <input id="ruc_mod" name="ruc_mod" type="text" class="form-control" placeholder="Ingrese ruc *">
                </div>
              </div>
              <div class="col-lg-4 md-3">
                <div class="form-group">
                  <label class="mediun mb-1" for="telefono_mod">Telefono</label>
                  <input id="telefono_mod" name="telefono_mod" type="text" class="form-control" placeholder="Ingrese Telefono /Opcional">
                </div>
              </div>
              <div class="col-lg-4 md-3">
                <div class="form-group">
                  <label class="mediun mb-1" for="correo_mod">Correo</label>
                  <input id="correo_mod" name="correo_mod" type="text" class="form-control" placeholder="Ingrese Correo /Opcional">
                </div>
              </div>
              <div class="col-lg-12 md-3">
                <div class="form-group">
                  <label class="mediun mb-1" for="nombre_mod">Razon social</label>
                  <input id="nombre_mod" name="nombre_mod" type="text" class="form-control" placeholder="Ingrese Razon social *">
                </div>
              </div>
              <div class="col-lg-12 md-3">
                <div class="form-group">
                  <label class="mediun mb-1" for="direccion_mod">Dirección</label>
                  <input id="direccion_mod" name="direccion_mod" type="text" class="form-control" placeholder="Ingrese Dirección /Opcional">
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
<div class="modal fade animate__animated animate__zoomInDown" id="editar_avatar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="exampleModalLabel">Cambiar avatar</h5>
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
                                <input type="hidden" id="idprovee" name="idprovee">
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
<title>DIGITALTEI S.A.C - Proveedor</title>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="animate__animated animate__bounce h3 mb-4 text-gray-800">Proveedor</h1>

        <div class="card shadow card-header-actions mb-4">
          <div class="card-header">
              Proveedor
              <button data-toggle="modal" data-target="#crear_proveedor" type="button" class="btn btn-outline-dark btn-circle ml-2" title="Registrar proveedor"><i class="fas fa-plus"></i></button>
          </div>
          <div class="card-body">
            <table id="proveedores" class="table table-hover">
              <thead class="table-dark">
                <tr><th width="100%">Proveedor</th></tr>
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

<script src="../util/js/proveedor.js"></script>

<script>
$('#ruc').keyup(function(e){
    e.preventDefault();
    ruc=$('#ruc').val();
    $.ajax({
      url: '../controllers/consultaRUC/consultaRuc.php',
      type: 'POST',
      data: 'ruc='+ruc,
      dataType: 'json',
      success: function(consult){
        if(consult.body.numeroRuc==ruc){
          $('#nombre').val(consult.body.datosContribuyente.desRazonSocial);
          $('#direccion').val(consult.body.datosContribuyente.desDireccion);
        }
      }
    });
    e.preventDefault();
  });

  $('#ruc_mod').keyup(function(e){
    e.preventDefault();
    ruc=$('#ruc_mod').val();
    $.ajax({
      url: '../controllers/consultaRUC/consultaRuc.php',
      type: 'POST',
      data: 'ruc='+ruc,
      dataType: 'json',
      success: function(consult){
        if(consult.body.numeroRuc==ruc){
          $('#nombre_mod').val(consult.body.datosContribuyente.desRazonSocial);
          $('#direccion_mod').val(consult.body.datosContribuyente.desDireccion);
        }
      }
    });
  });
</script>