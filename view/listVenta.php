<?php
session_start();
include_once 'layout/header.php';
?>


<title>DIGITALTEI S.A.C - Listar Venta</title>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="animate__animated animate__bounce h3 mb-4 text-gray-800 d-sm-flex align-items-center justify-content-between">Gestion Ventas
        </h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-dark ">Listar ventas
                </h6>
            </div>
            <div class="card-body">
								<div class="table-responsive">
										<table id="listVentas" class="table table-hover" width="100%" cellspacing="0">
											<thead>
													<tr>
															<th>N°</th>
															<th>Fecha</th>
															<th>DNI</th>
															<th>Cliente</th>
															<th>Total</th>
															<th>Vendedor</th>
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

<script src="../util/js/venta.js"></script>

