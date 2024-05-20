<?php
session_start();
include_once 'layout/header.php';
?>

<!-- Modal -->
<div class="modal fade" id="mensaje_cli" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
				<div class="modal-content">
						<div class="modal-header" style="background:#25D366;">
								<h5 class="modal-title text-white" id="exampleModalLabel">Enviar una notificacion al whatsapp</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
						</div>
						<div class="modal-body">
						<div class="alert alert-success text-center" id="men" style="display:none">
							<span><i class="fas fa-check m-1"></i>se agrego correctamente</span>
						</div>
							<form id="form_mensaje" class="needs-validation" novalidate>
							<div class="row g-3">
									<div class="col-lg-12 md-3">
											<div class="form-group">
												<label class="small mb-1" for="fecha_mensaje">Fecha</label>
												<select name="fecha_mensaje" id="fecha_mensaje" class="form-control select2" style="width: 100%;">
													<option value="" disabled selected>Seleciona el día...</option>
													<option value="23">23</option>
													<option value="24">24</option>
												</select>
												<div class="valid-feedback">
													Correcto.
												</div>
												<div class="invalid-feedback">
													Porfavor,Ingrese el día.
												</div>
											</div>
									</div>
							</div>
								<input id="nombre_mensaje" name="nombre_mensaje" type="hidden" class="form-control" placeholder="cliente" required>
								<input id="telefono_mensaje" name="telefono_mensaje" type="hidden" class="form-control" placeholder="telefono" required>

								<input type="hidden" class="form-control">
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-primary float-right m-1"><i class="fas fa-sms m-1"></i> Enviar</button>
							<button class="btn btn-secondary" type="button" data-dismiss="modal"><i class="fas fa-times-circle m-1"></i>Cerrar</button>
							</form>
						</div>
				</div>
		</div>
</div>


<!-- Modal -->
<div class="modal fade" id="crear_cliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
		<div class="modal-content">
				<div class="modal-header bg-primary">
					<h3 class="modal-title text-white">Crear cliente
						</h3>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
				</div>
				<div class="modal-body">
					<div class="alert alert-success text-center" id="add" style="display:none">
						<span><i class="fas fa-check m-1"></i>se agrego correctamente</span>
					</div>
					<div class="alert alert-danger text-center" id="noadd" style="display:none">
						<span><i class="fas fa-times m-1"></i>El dni ya exite en otro cliente</span>
					</div>
					<form id="form-crear" class="needs-validation" novalidate>
						<div class="row g-3">
							<div class="col-lg-4 md-3">
								<div class="form-group">
									<label class="small mb-1" for="dni">(*) DNI</label>
									<input id="dni" name="dni" type="text" class="form-control" placeholder="Ingrese dni" required >
									<div class="valid-feedback">
										Correcto
									</div>
									<div class="invalid-feedback">
										Porfavor,Ingrese su dni!
									</div>
								</div>
							</div>
							<div class="col-lg-4 md-3">
								<div class="form-group">
									<label class="small mb-1" for="nombre">(*) Nombre</label>
									<input id="nombre" name="nombre" type="text" class="form-control" placeholder="Ingrese nombre" required>
									<div class="valid-feedback">
										Correcto.
									</div>
									<div class="invalid-feedback">
										Porfavor,Ingrese su nombre.
									</div>
								</div>
							</div>
							<div class="col-lg-4 md-3">
								<div class="form-group">
									<label class="small mb-1" for="apellido">(*) Apellidos</label>
									<input id="apellido" name="apellido" type="text" class="form-control" placeholder="Ingrese apellido" required>
									<div class="valid-feedback">
										Correcto.
									</div>
									<div class="invalid-feedback">
										Porfavor,Ingrese su apellidos.
									</div>
								</div>
							</div>
							<div class="col-lg-4 md-3">
								<div class="form-group">
									<label class="small mb-1" for="docum">(*) Documento</label>
									<select name="docum" id="docum" class="form-control select2" style="width: 100%;" required>
										<option value="DNI">DNI</option>
										<option value="RUC">RUC</option>
									</select>
									<div class="valid-feedback">
										Correcto.
									</div>
									<div class="invalid-feedback">
										Porfavor,Ingrese su tipo documento.
									</div>
								</div>
							</div>
							<div class="col-lg-4 md-3">
								<div class="form-group">
									<label class="small mb-1" for="num">(*) Número</label>
									<input id="num" type="text" class="form-control" placeholder="Ingrese DNI" required>
									<div class="valid-feedback">
										Correcto.
									</div>
									<div class="invalid-feedback">
										Porfavor,Ingrese su numero dni.
									</div>
								</div>
							</div>
							<div class="col-lg-4 md-3">
								<div class="form-group">
									<label class="small mb-1" for="telefono">(Opcional) Telefono</label>
									<input id="telefono" type="text" class="form-control" placeholder="Ingrese Telefono" required>
									<div class="valid-feedback">
										Correcto.
									</div>
									<div class="invalid-feedback">
										Porfavor,Ingrese su numero de telefono.
									</div>
								</div>
							</div>
							
							<div class="col-lg-12 md-3">
								<div class="form-group">
								<label class="small mb-1" for="direccion">(Opcional) Dirección</label>
								<input id="direccion" type="text" class="form-control" placeholder="Ingrese Dirección" required>
									<div class="valid-feedback">
										Correcto.
									</div>
									<div class="invalid-feedback">
										Porfavor,Ingrese su dirección.
									</div>
								</div>
							</div>

						</div>
					
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary float-right m-1">Guardar</button>
					<button type="button" class="btn btn-outline-secondary float-right m-1" data-dismiss="modal">Cerrar</button>
					</form>
			  </div>
		</div>
	</div>
</div>


<!-- Modal -->
<div class="modal fade" id="modal_edit_cli" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
				<div class="modal-content">
						<div class="modal-header" style="background:#fff44f;">
								<h5 class="modal-title text-white" id="exampleModalLabel">Editar Cliente</h5>
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
							<form id="form-editar_cli" class="needs-validation" novalidate>
								<div class="row g-3">
									<div class="col-lg-4 md-3">
										<div class="form-group">
											<label class="small mb-1" for="dni_mod">(*) DNI</label>
											<input id="dni_mod" type="text" class="form-control" placeholder="Ingrese dni">
											<div class="valid-feedback">
												Correcto
											</div>
											<div class="invalid-feedback">
												Porfavor,Ingrese su dni!
											</div>
										</div>
									</div>
									<div class="col-lg-4 md-3"> 
										<div class="form-group">
											<label class="small mb-1" for="nombre_mod">(*) Nombre</label>
											<input id="nombre_mod" type="text" class="form-control" placeholder="Ingrese nombre" >
											<div class="valid-feedback">
												Correcto.
											</div>
											<div class="invalid-feedback">
												Porfavor,Ingrese su nombre.
											</div>
										</div>
									</div>
									<div class="col-lg-4 md-3">
										<div class="form-group">
											<label class="small mb-1" for="apellido_mod">(*) Apellidos</label>
											<input id="apellido_mod" type="text" class="form-control" placeholder="Ingrese apellido">
											<div class="valid-feedback">
												Correcto.
											</div>
											<div class="invalid-feedback">
												Porfavor,Ingrese su apellidos.
											</div>
										</div>
									</div>
									<div class="col-lg-4 md-3">
										<div class="form-group">
											<label class="small mb-1" for="docum_mod">(*) Documento</label>
											<select name="docum_mod" id="docum_mod" class="form-control select2" style="width: 100%;" required>
												<option value="DNI">DNI</option>
												<option value="RUC">RUC</option>
											</select>
											<div class="valid-feedback">
												Correcto.
											</div>
											<div class="invalid-feedback">
												Porfavor,Ingrese su tipo documento.
											</div>
										</div>
									</div>
									<div class="col-lg-4 md-3">
										<div class="form-group">
											<label class="small mb-1" for="num_mod">(*) Número</label>
											<input id="num_mod" name="num_mod" type="text" class="form-control" placeholder="Ingrese DNI" required>
											<div class="valid-feedback">
												Correcto.
											</div>
											<div class="invalid-feedback">
												Porfavor,Ingrese su numero dni.
											</div>
										</div>
									</div>
									<div class="col-lg-4 md-3">
										<div class="form-group">
											<label class="small mb-1" for="telefono_mod">(Opcional) Telefono</label>
											<input id="telefono_mod" type="text" class="form-control" placeholder="Ingrese Telefono">
											<div class="valid-feedback">
												Correcto.
											</div>
											<div class="invalid-feedback">
												Porfavor,Ingrese su numero de telefono.
											</div>
										</div>
									</div>

								</div>

								<div class="col-lg-12 md-3">
									<div class="form-group">
										<label class="small mb-1" for="direccion_mod">(Opcional) Dirección</label>
										<input id="direccion_mod" type="text" class="form-control" placeholder="Ingrese Dirección">
										<div class="valid-feedback">
											Correcto.
										</div>
										<div class="invalid-feedback">
											Porfavor,Ingrese su dirección.
										</div>
									</div>
								</div>
								<input id="idcli_mod" type="hidden" class="form-control">
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-primary float-right m-1">Guardar</button>
							<button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
						</div>
				</div>
		</div>
</div>


<!-- Modal -->
<div class="modal fade" id="vista_cliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
		<div class="modal-content">
				<div class="modal-header bg-success">
					<h3 class="modal-title text-white">Ver Historial del cliente</h3>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="codigo_cli">Codigo: </label>
						<span id="codigo_cli"></span>
					</div>
					<div class="form-group">
						<label for="dni_ver">DNI: </label>
						<span id="dni_ver"></span>
					</div>
					<div class="form-group">
						<label for="nombre_ver">Nombre: </label>
						<span id="nombre_ver"></span>
					</div>
					<div class="form-group">
						<label for="apellido_ver">Apellidos: </label>
						<span id="apellido_ver"></span>
					</div>
					<div class="form-group">
						<label for="direccion_ver">Direccion: </label>
						<span id="direccion_ver"></span>
					</div>
					<div class="form-group">
						<label for="telefono_ver">Telefono: </label>
						<span id="telefono_ver"></span>
					</div>
					<table class="table table-bordered"  width="100%" cellspacing="0">
						<thead class="table-success">
							<tr>
								<th>N°</th>
								<th>Cliente</th>
								<th>Articulo</th>
								<th>Consumo</th>
								<th>Cancelar</th>
								<th>Saldo</th>
								<th>Vueldo</th>
							</tr>
						</thead>
						<tbody class="table-warning" id="clientes">
							
						</tbody>
					</table>
					<div class="float-right input-group-append">
						<h3 class="m-3">Total: </h3>
						<h3 class="m-3" id="total"></h3>
						<h3 class="m-3">Saldo Total: </h3>
						<h3 class="m-3" id="saldo_total"></h3>
						<h3 class="m-3">Vueldo Total: </h3>
						<h3 class="m-3" id="vueldo_total"></h3>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-outline-secondary float-right m-1" data-dismiss="modal">Cerrar</button>
				</div>
		</div>
	</div>
</div>



		<!-- Begin Page Content -->
		<div class="container-fluid">

				<!-- Page Heading -->
				<h1 class="h3 mb-4 text-gray-800 d-sm-flex align-items-center justify-content-between">Cliente
				</h1>

				<!-- DataTales Example -->
				<div class="card shadow mb-4">
						<div class="card-header py-3">
								<h6 class="m-0 font-weight-bold text-primary ">Gestion cliente
								<button id="boton-crear" data-toggle="modal" data-target="#crear_cliente" type="button" class="btn btn-primary btn-circle ml-2" title="Agregar cliente"><i class="fas fa-plus"></i></button>
								</h6>
						</div>
						<div class="card-body">
								<div class="table-responsive">
										<table id="tabla_cli" class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
											<thead>
													<tr>
															<th>N°</th>
															<th>Tipo</th>
															<th>DNI</th>
															<th>Nombre</th>
															<th>Apellidos</th>
															<th>Direccion</th>
															<th>Telefono</th>
															<th>Opcion</th>
													</tr>
											</thead>
											<tbody >
													<tr>
															<td>1</td>
															<td>DNI</td>
															<td>77277373</td>
															<td>Juan</td>
															<td>Rinza</td>
															<td>Call. san jose </td>
															<td>99999947</td>
															<td><button class="btn btn-circle btn-sm btn-success ml-2"><i class="fas fa-pen-alt"></i></button>
															<button class="btn btn-circle btn-sm btn-danger ml-2 mr-2"><i class="fas fa-trash"></i></button>
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

<script src="../util/js/cliente.js"></script>

<script>

$('#dni').keyup(function(e){
		e.preventDefault();
		dni=$('#dni').val();
		console.log(dni);
		$.ajax({
			url: '../controllers/consultaDNI/consultaDni.php',
			type: 'POST',
			data: 'dni='+dni,
			dataType: 'json',
			success: function(consult){
				if(consult.body.nuDni== dni){
					$('#nombre').val(consult.body.preNombres);
					$('#apellido').val(consult.body.apePaterno+' '+consult.body.apeMaterno);
					$('#num').val(consult.body.nuDni);
					$('#direccion').val(consult.body.desDireccion);
				}
			}
		});
		e.preventDefault();
	});

	$('#dni_mod').keyup(function(e){
		e.preventDefault();
		dni=$('#dni_mod').val();
		console.log(dni);
		$.ajax({
			url: '../controllers/consultaDNI/consultaDni.php',
			type: 'POST',
			data: 'dni='+dni,
			dataType: 'json',
			success: function(consult){
				if(consult.body.nuDni== dni){
					$('#nombre_mod').val(consult.body.preNombres);
					$('#apellido_mod').val(consult.body.apePaterno+' '+consult.body.apeMaterno);
					$('#num_mod').val(consult.body.nuDni);
					$('#direccion_mod').val(consult.body.desDireccion);
				}
			}
		});
		e.preventDefault();

	});
</script>