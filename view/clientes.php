<?php
session_start();
include_once 'layout/header.php';
?>


<!-- Modal -->
<div class="modal fade animate__animated animate__zoomInLeft" id="mensaje_cli" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
						<div class="modal-header" style="background:#25D366;">
								<h5 class="modal-title text-white">Enviar una notificacion al whatsapp</h5>
						</div>
						<div class="modal-body">
							<form id="form_mensaje" enctype="multipart/form-data">
							<div class="row g-3">
									<div class="col-lg-12 md-3">
											<div class="form-group">
												<label class="small mb-1" for="fecha_mensaje">Fecha</label>
                        <!--<input id="fecha_mensaje" name="fecha_mensaje" type="date" class="form-control" placeholder="Fecha 5 días antes">-->
												<select name="fecha_mensaje" id="fecha_mensaje" class="form-control select2" style="width: 100%;">
													<option value="" disabled selected>Seleciona el día...</option>
													<option value="23">23</option>
													<option value="24">24</option>
												</select>
											</div>
									</div>
							</div>
								<input id="nombre_mensaje" name="nombre_mensaje" type="hidden" class="form-control" placeholder="cliente" required>
								<input id="telefono_mensaje" name="telefono_mensaje" type="hidden" class="form-control" placeholder="telefono" required>

								<input type="hidden" class="form-control">
						</div>
						<div class="modal-footer">
							<button class="btn btn-outline-secondary btn-circle ml-2" title="Salir" type="button" data-dismiss="modal"><i class="fas fa-sign-out-alt m-1"></i></button>
							<button type="submit" class="btn btn-outline-success btn-circle ml-2" title="Enviar"><i class="fas fa-sms m-1"></i></button>
							</form>
						</div>
				</div>
		</div>
</div>

<!-- Modal -->
<div class="modal fade animate__animated animate__bounceInDown" id="crear_cliente" role="dialog">
  <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header bg-dark">
          <h3 class="card-title text-white">Registrar cliente
          </h3>
        </div>
        <div class="modal-body">
          <form id="form-registrar" enctype="multipart/form-data">
            <div class="row g-3">
              <div class="col-lg-4 md-3">
                  <div class="form-group">
                    <label class="mediun mb-1" for="docum">Documento</label>
                    <select name="docum" id="docum" class="form-control select2-dark" data-dropdown-css-class="select2-primary" style="width: 100%;">
                      
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
                  <label class="mediun mb-1" for="nombre">Nombre</label>
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
                  <label class="mediun mb-1" for="fecha_nac">Fecha de nacimiento</label>
                  <input id="fecha_nac" name="fecha_nac" type="date" class="form-control" placeholder="Ingrese fecha nacemiento /Opcional">
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
<div class="modal fade animate__animated animate__bounceInDown" id="editar_cliente" role="dialog">
  <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header bg-dark">
          <h3 class="card-title text-white">Editar cliente
          </h3>
        </div>
        <div class="modal-body">
          <form id="form-editar" enctype="multipart/form-data">
            <input type="hidden" id="idcliente_mod" name="idcliente_mod">
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
                  <label class="mediun mb-1" for="telefono_mod">Telefono</label>
                  <input id="telefono_mod" name="telefono_mod" type="text" class="form-control" placeholder="Ingrese Telefono /Opcional">
                </div>
              </div>
              <div class="col-lg-4 md-3">
                <div class="form-group">
                  <label class="mediun mb-1" for="fecha_nac_mod">Fecha de nacimiento</label>
                  <input id="fecha_nac_mod" name="fecha_nac_mod" type="date" class="form-control" placeholder="Ingrese fecha nacemiento /Opcional">
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

<!-- Modal -->
<div class="modal fade animate__animated animate__zoomInDown" id="ver_historial" role="dialog">
  <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header bg-dark">
          <h3 class="card-title text-white">Ver Historial de cuenta cliente
          </h3>
        </div>
        <div class="modal-body">
          <div class="card p-2 mb-2">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="codigo_cli">ID: </label>
                  <span id="codigo_cli"></span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="dni_ver">DNI: </label>
                  <span id="dni_ver"></span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="nombre_ver">Nombres: </label>
                  <span id="nombre_ver"></span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="direccion_ver">Direccion: </label>
                  <span id="direccion_ver"></span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="telefono_ver">Telefono: </label>
                  <span id="telefono_ver"></span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="estado_ver">Estado: </label>
                  <span id="estado_ver"></span>
                </div>
              </div>
            </div>
          </div>
          <div class="table-responsive">
            <table class="table  table-bordered table-hover display nowrap" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>N°</th>
                  <th>Cliente</th>
                  <th>Descripcion</th>
                  <th>Consumo</th>
                  <th>Fecha pago</th>
                  <th>Deuda</th>
                  <th>Monto</th>
                  <th>Saldo</th>
                  <th>Vueldo</th>
                  <th>M.pago</th>
                  <th>Encargado</th>
                  <th>Estado</th>
                  <th>Opcion</th>
                </tr>
              </thead>
              <tbody id="historial">
                
              </tbody>
            </table>
          </div>
          <div class="text-center">
            <div class="row">
              <div class="col-md-6">
                <div class="input-group-append">
                  <h3 class="m-3 small">Importe total: </h3>
                  <h3 class="m-3 small" id="total"></h3>
                </div>
                <hr>
              </div>
              <div class="col-md-6">
                <div class="input-group-append">
                  <h3 class="m-3 small">Abono total: </h3>
                  <h3 class="m-3 small" id="abono_total"></h3>
                </div>
                <hr>
              </div>
              <div class="col-md-6">
                <div class="input-group-append">
                  <h3 class="m-3 small">Saldo Total: </h3>
                  <h3 class="m-3 small" id="saldo_total"></h3>
                </div>
                <hr>
              </div>
              <div class="col-md-6">
                <div class="input-group-append">
                  <h3 class="m-3 small">Vueldo Total: </h3>
                  <h3 class="m-3 small" id="vuelto_total"></h3>
                </div>
                <hr>
              </div>
            </div>
					</div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary btn-circle ml-2" title="Salir" data-dismiss="modal"><i class="fas fa-sign-out-alt"></i></button>
        </div>
    </div>
  </div>
</div>

<title>DIGITALTEI S.A.C - Cliente</title>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="animate__animated animate__bounce h3 mb-4 text-gray-800 d-sm-flex align-items-center justify-content-between">Cliente
        </h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-dark ">Gestion cliente
                <button  data-toggle="modal" data-target="#crear_cliente" type="button" class="btn btn-outline-dark btn-circle ml-2" title="Registrar cliente"><i class="fas fa-plus"></i></button>
                </h6>
            </div>
            <div class="card-body">
								<div class="table-responsive">
										<table id="clientes" class="table  table-bordered table-condensed table-hover" width="100%" cellspacing="0">
											<thead>
													<tr>
															<th>N°</th>
															<th>Tipo</th>
															<th>DNI</th>
															<th>Nombre</th>
															<th>Apellidos</th>
															<th>Direccion</th>
															<th>Telefono</th>
															<th>Edad</th>
															<th>Estado</th>
															<th>Opcion</th>
													</tr>
											</thead>
											<tbody >
                        
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

<script src="../util/js/clientes.js"></script>

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
          // Obtener la fecha en formato "dd/mm/yyyy"
          var fecha = consult.body.feNacimiento ;
            
            // Convertir la fecha al formato "yyyy-MM-dd"
            var fechaFormat = fecha.split('/').reverse().join('-');
          $('#fecha_nac').val(fechaFormat);
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
          $('#direccion_mod').val(consult.body.desDireccion);
          // Obtener la fecha en formato "dd/mm/yyyy"
          var fecha = consult.body.feNacimiento ;
            
            // Convertir la fecha al formato "yyyy-MM-dd"
            var fechaFormat = fecha.split('/').reverse().join('-');
          $('#fecha_nac_mod').val(fechaFormat);
        }
      }
    });
    e.preventDefault();
  });

</script>