<?php
session_start();
include_once 'layout/header.php';
?>
<title>Adm | Compra</title>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="animate__animated animate__bounce h3 mb-4 text-gray-800 d-sm-flex align-items-center justify-content-between">Venta
    </h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-dark">
            <h6 class="m-0 font-weight-bold text-white ">Gestion Ventas
            </h6>
        </div>
        <div class="card-body p-0">
            <header>
            <div class="logo_cp">
                <img src="../util/img/logo.png" width="100" height="100">
            </div>
            <h1 class="titulo_cp">SOLICITUD DE VENTA</h1>
            <div class="datos_cp">
                <div class="fila">
                    <label class="label">Cliente: </label>
                    <div class="col-lg-6 md-6 col-sm-6">
                        <div class="form-group">
                            <select name="cliente" id="cliente" class="form-control select2-dark" data-dropdown-css-class="select2-dark" style="width: 100%;">
                                
                            </select>
                        </div>
                    </div>
                </div>
                <div class="fila">
                    <label class="label">DNI: </label>
                    <div class="col-lg-6 md-6 col-sm-6">
                        <div class="form-group">
                            <div class="input-group-append">
                                <input type="text" class="form-control" id="dni" name="dni" placeholder="Ingresa DNI">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="label" for="vendedor">Vendedor:</label>
                    <span class="Vendedor">u</span>
                </div>
            </div>
            </header>
            <button id="actualizar"class="btn btn-outline-dark mb-2 ml-2 btn-circle" title="Actualizar"><i class="fas fa-undo"></i></button>
        
            <div id="cp"class="card-body p-0">
                <table class="compra table table-hover text-nowrap">
                    <thead class='table-dark'>
                        <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">Stock</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Descripcion</th>
                            <th scope="col">Presentacion</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Sub Total</th>
                            <th scope="col">Eliminar</th>
                        </tr>
                    </thead>
                    <tbody id="lista-venta" class='table-active'>
                        
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card card-default">
                            <div class="card-header">
                                <h3 class="card-title">
                                <i class="fas fa-strikethrough"></i>
                                Calculo 1
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="info-box mb-3 shadow-sm rounded p-2" style="color: #ffff; background:#010300 ;">
                                    <span class="info-box-icon ml-4"><i class="fas fa-tag"></i></span>
                                    <div class="info-box-content ml-4">
                                        <span class="info-box-text text-left ">SUB TOTAL</span>
                                        <span class="info-box-number" id="subtotal">0.00</span>
                                    </div>
                                </div>
                                <div class="info-box mb-3 shadow-sm rounded p-2" style="color: #ffff; background:#010300 ;">
                                    <span class="info-box-icon ml-4"><i class="fas fa-tag"></i></span>
                                    <div class="info-box-content ml-4">
                                        <span class="info-box-text text-left ">IGV</span>
                                        <span class="info-box-number"id="con_igv">0.00</span>
                                    </div>
                                </div>
                                <div class="info-box mb-3 shadow-sm rounded p-2" style="color: #ffff; background:#2a6e78;">
                                    <span class="info-box-icon ml-4"><i class="fas fa-tag"></i></span>
                                    <div class="info-box-content ml-4">
                                        <span class="info-box-text text-left">SIN DESCUENTO</span>
                                        <span class="info-box-number" id="total_sin_descuento">0.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-default">
                            <div class="card-header">
                                <h3 class="card-title">
                                <i class="fas fa-bullhorn"></i>
                                Calculo 2
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="info-box mb-3 shadow-sm rounded p-2" style="color: #ffff; background:#be0001;">
                                    <span class="info-box-icon ml-4"><i class="fas fa-comment-dollar"></i></span>
                                    <div class="info-box-content ml-4">
                                        <span class="info-box-text text-left ">DESCUENTO</span>
                                        <input id="descuento"type="number" min="1" placeholder="Ingrese descuento" class="form-control">
                                    </div>
                                </div>
                                <div class="info-box mb-3 shadow-sm rounded p-2" style="color: #ffff; background:#0047aa;">
                                    <span class="info-box-icon ml-4"><i class="ion ion-ios-cart-outline"></i></span>
                                    <div class="info-box-content ml-4">
                                        <span class="info-box-text text-left ">TOTAL</span>
                                        <span class="info-box-number" id="total">0.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-default">
                            <div class="card-header">
                                <h3 class="card-title">
                                <i class="fas fa-cash-register"></i>
                                Cambio
                                </h3>
                            </div>
                            <div class="card-body">
                            <div class="info-box mb-3 shadow-sm rounded p-2" style="color: #ffff; background:#0ef02f;">
                                <span class="info-box-icon ml-4"><i class="fas fa-money-bill-alt"></i></span>
                                <div class="info-box-content ml-4">
                                    <span class="info-box-text text-left ">INGRESO</span>
                                    <input type="number" id="pago" min="1" placeholder="Ingresa Dinero" class="form-control">
                                </div>
                            </div>
                            <div class="info-box mb-3 shadow-sm rounded p-2" style="color: #ffff; background:#2a6e78;">
                                <span class="info-box-icon ml-4"><i class="fas fa-money-bill-wave"></i></span>
                                <div class="info-box-content ml-4">
                                    <span class="info-box-text text-left ">VUELTO</span>
                                    <span class="info-box-number" id="vuelto">0.00</span>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-between">
                <div class="col-md-4 mb-2 mt-1">
                    <a href="catalogo" class="btn btn-outline-dark btn-circle" title="Seguir comprando"><i class="fas fa-arrow-left"></i></a>
                </div>
                <div class="col-xs-12 col-md-4">
                    <a href="#" class="btn btn-outline-success btn-circle" title="Realizar venta" id="procesar-venta"><i class="fas fa-check"></i></a>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</div>
<!-- End of Main Content -->

<?php
include_once 'layout/footer.php';
?>
<script src="../util/js/venta.js"></script>
<script src="../util/js/catalogo.js"></script>
