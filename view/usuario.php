<?php
session_start();
include_once 'layout/header.php';
?>

<!-- Modal cambiar contraseña-->
<div class="modal fade animate__animated animate__zoomInDown" id="confirmar" tabindex="-1" aria-hidden="true">
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
<div class="modal fade animate__animated animate__bounceInDown" id="crear_usuario" role="dialog">
  <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header bg-dark">
          <h3 class="card-title text-white">Registrar usuario
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
                    <label class="mediun mb-1" for="num">Número</label>
                    <input id="num" name="num" type="text" class="form-control" placeholder="Ingrese DNI *">
                  </div>
                </div>
              <div class="col-lg-4 md-3">
                <div class="form-group">
                  <label class="mediun mb-1" for="nombre">Nombres</label>
                  <input id="nombre" name="nombre" type="text" class="form-control" placeholder="Ingrese nombre *">
                </div>
              </div>
              <div class="col-lg-4 md-3">
                <div class="form-group">
                  <label class="mediun mb-1" for="apellido">Apellidos</label>
                  <input id="apellido" name="apellido" type="text" class="form-control" placeholder="Ingrese apellido *">
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
              <div class="col-lg-4 md-3">
                <div class="form-group">
                  <label class="mediun mb-1" for="login">Login</label>
                  <input id="login" name="login" type="text" class="form-control" placeholder="Ingrese login *">
                </div>
              </div>
              <div class="col-lg-4 md-3">
                <div class="form-group">
                  <label class="mediun mb-1" for="clave">Contraseña</label>
                  <input id="clave" name="clave" type="password" class="form-control" placeholder="Ingrese contraseña *">
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
<div class="modal fade animate__animated animate__bounceInDown" id="editar_usuario" role="dialog">
  <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header bg-dark">
          <h3 class="card-title text-white">Editar usuario
          </h3>
        </div>
        <div class="modal-body">
          <form id="form-editar">
            <input type="hidden" id="idusuario_mod" name="idusuario_mod">
            <div class="row g-3">
              <div class="col-lg-4 md-3">
                  <div class="form-group">
                    <label class="mediun mb-1" for="docum_mod">Documento</label>
                    <select name="docum_mod" id="docum_mod" class="form-control select2-dark" data-dropdown-css-class="select2-primary" style="width: 100%;">
                      
                    </select>
                  </div>
                </div>
                <div class="col-lg-4 md-3">
                  <div class="form-group">
                    <label class="mediun mb-1" for="num_mod">Número</label>
                    <input id="num_mod" name="num_mod" type="text" class="form-control" placeholder="Ingrese DNI *">
                  </div>
                </div>
              <div class="col-lg-4 md-3">
                <div class="form-group">
                  <label class="mediun mb-1" for="nombre_mod">Nombres</label>
                  <input id="nombre_mod" name="nombre_mod" type="text" class="form-control" placeholder="Ingrese nombre *">
                </div>
              </div>
              <div class="col-lg-4 md-3">
                <div class="form-group">
                  <label class="mediun mb-1" for="apellido_mod">Apellidos</label>
                  <input id="apellido_mod" name="apellido_mod" type="text" class="form-control" placeholder="Ingrese apellido *">
                </div>
              </div>
              <div class="col-lg-4 md-3">
                <div class="form-group">
                  <label class="mediun mb-1" for="login_mod">Login</label>
                  <input id="login_mod" name="login_mod" type="text" class="form-control" placeholder="Ingrese login *">
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


<title>DIGITALTEI S.A.C - Usuario</title>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="animate__animated animate__bounce h3 mb-4 text-gray-800 d-sm-flex align-items-center justify-content-between">Usuario
        </h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-dark ">Gestion usuario
                <button id="boton-crear" data-toggle="modal" data-target="#crear_usuario" type="button" class="btn btn-outline-dark btn-circle ml-2" title="Registrar usuario"><i class="fas fa-plus"></i></button>
                </h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="usuarios" class="table table-hover">
                  <thead class="table-dark">
                      <tr><th width="100%">usuarios</th></tr>
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

<script src="../util/js/usuario.js"></script>

<script>

$('#num').keyup(function(e){
    e.preventDefault();
    dni=$('#num').val();
    $.ajax({
      url: '../controllers/consultaDNI/consultaDni.php',
      type: 'POST',
      data: 'dni='+dni,
      dataType: 'json',
      success: function(consult){
        if(consult.body.nuDni== dni){
          $('#nombre').val(consult.body.preNombres);
          $('#apellido').val(consult.body.apePaterno+' '+consult.body.apeMaterno);
          $('#direccion').val(consult.body.desDireccion);
        }
      }
    });
    e.preventDefault();
  });

  $('#num_mod').keyup(function(e){
    e.preventDefault();
    dni=$('#num_mod').val();
    $.ajax({
      url: '../controllers/consultaDNI/consultaDni.php',
      type: 'POST',
      data: 'dni='+dni,
      dataType: 'json',
      success: function(consult){
        if(consult.body.nuDni== dni){
          $('#nombre_mod').val(consult.body.preNombres);
          $('#apellido_mod').val(consult.body.apePaterno+' '+consult.body.apeMaterno);
        }
      }
    });
    e.preventDefault();
  });

  
</script>